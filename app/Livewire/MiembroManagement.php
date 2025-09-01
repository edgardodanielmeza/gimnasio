<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Miembro;
use App\Models\Sucursal;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class MiembroManagement extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $isOpen = false;
    public $miembro_id, $documento_identidad, $nombre, $apellido, $telefono, $email, $fecha_nacimiento, $sucursal_registro_id;
    public $tipo_membresia_inicial_id; // For the initial membership
    public $photo;
    public $existing_photo;
    public $search = '';

    public function render()
    {
        $miembros = Miembro::where('nombre', 'like', '%'.$this->search.'%')
                            ->orWhere('apellido', 'like', '%'.$this->search.'%')
                            ->orWhere('documento_identidad', 'like', '%'.$this->search.'%')
                            ->paginate(10);
        $sucursales = Sucursal::all();

        return view('livewire.miembro-management', [
            'miembros' => $miembros,
            'sucursales' => $sucursales,
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->miembro_id = null;
        $this->documento_identidad = '';
        $this->nombre = '';
        $this->apellido = '';
        $this->telefono = '';
        $this->email = '';
        $this->fecha_nacimiento = '';
        $this->sucursal_registro_id = '';
        $this->tipo_membresia_inicial_id = '';
        $this->photo = null;
        $this->existing_photo = null;
    }

    public function store()
    {
        $rules = [
            'documento_identidad' => 'required|string|max:20|unique:miembros,documento_identidad,' . $this->miembro_id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:miembros,email,' . $this->miembro_id,
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'sucursal_registro_id' => 'required|exists:sucursales,id',
            'photo' => 'nullable|image|max:1024',
        ];

        if (!$this->miembro_id) {
            $rules['tipo_membresia_inicial_id'] = 'required|exists:tipos_membresia,id';
        }

        $this->validate($rules);

        $data = [
            'documento_identidad' => $this->documento_identidad,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'sucursal_registro_id' => $this->sucursal_registro_id,
        ];

        if ($this->photo) {
            $data['foto_path'] = $this->photo->store('fotos_miembros', 'public');
        }

        $miembro = Miembro::updateOrCreate(['id' => $this->miembro_id], $data);

        if (!$this->miembro_id && $this->tipo_membresia_inicial_id) {
            $tipoMembresia = \App\Models\TipoMembresia::find($this->tipo_membresia_inicial_id);

            $membresia = $miembro->membresias()->create([
                'tipo_membresia_id' => $tipoMembresia->id,
                'fecha_inicio' => now(),
                'fecha_fin' => now()->addDays($tipoMembresia->duracion_dias),
                'estado' => 'activa',
            ]);

            $membresia->pagos()->create([
                'user_id_receptor' => auth()->id(),
                'monto' => $tipoMembresia->precio,
                'metodo_pago' => 'efectivo',
                'fecha_pago' => now(),
            ]);
        }

        session()->flash('message',
            $this->miembro_id ? 'Miembro actualizado exitosamente.' : 'Miembro creado exitosamente con membresía y pago inicial.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $miembro = Miembro::findOrFail($id);
        $this->miembro_id = $id;
        $this->documento_identidad = $miembro->documento_identidad;
        $this->nombre = $miembro->nombre;
        $this->apellido = $miembro->apellido;
        $this->email = $miembro->email;
        $this->telefono = $miembro->telefono;
        $this->fecha_nacimiento = $miembro->fecha_nacimiento;
        $this->sucursal_registro_id = $miembro->sucursal_registro_id;
        $this->existing_photo = $miembro->foto_path;

        $this->openModal();
    }

    public function delete($id)
    {
        $miembro = Miembro::find($id);
        if ($miembro->foto_path) {
            Storage::disk('public')->delete($miembro->foto_path);
        }
        $miembro->delete();
        session()->flash('message', 'Miembro eliminado exitosamente.');
    }
}
