<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TipoMembresia;
use Livewire\WithPagination;

class TipoMembresiaManagement extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $tipo_membresia_id, $nombre, $descripcion, $precio, $duracion_dias;

    public function render()
    {
        $tiposMembresia = TipoMembresia::paginate(10);
        return view('livewire.tipo-membresia-management', [
            'tiposMembresia' => $tiposMembresia,
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
        $this->tipo_membresia_id = null;
        $this->nombre = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->duracion_dias = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
        ]);

        TipoMembresia::updateOrCreate(['id' => $this->tipo_membresia_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'duracion_dias' => $this->duracion_dias,
        ]);

        session()->flash('message',
            $this->tipo_membresia_id ? 'Tipo de Membresía actualizado exitosamente.' : 'Tipo de Membresía creado exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $tipo = TipoMembresia::findOrFail($id);
        $this->tipo_membresia_id = $id;
        $this->nombre = $tipo->nombre;
        $this->descripcion = $tipo->descripcion;
        $this->precio = $tipo->precio;
        $this->duracion_dias = $tipo->duracion_dias;

        $this->openModal();
    }

    public function delete($id)
    {
        TipoMembresia::find($id)->delete();
        session()->flash('message', 'Tipo de Membresía eliminado exitosamente.');
    }
}
