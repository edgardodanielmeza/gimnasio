<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sucursal;
use Livewire\WithPagination;

class SucursalManagement extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $sucursal_id, $nombre, $direccion, $telefono;

    public function render()
    {
        $sucursales = Sucursal::paginate(10);
        return view('livewire.sucursal-management', [
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
        $this->sucursal_id = null;
        $this->nombre = '';
        $this->direccion = '';
        $this->telefono = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        Sucursal::updateOrCreate(['id' => $this->sucursal_id], [
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
        ]);

        session()->flash('message',
            $this->sucursal_id ? 'Sucursal actualizada exitosamente.' : 'Sucursal creada exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $this->sucursal_id = $id;
        $this->nombre = $sucursal->nombre;
        $this->direccion = $sucursal->direccion;
        $this->telefono = $sucursal->telefono;

        $this->openModal();
    }

    public function delete($id)
    {
        Sucursal::find($id)->delete();
        session()->flash('message', 'Sucursal eliminada exitosamente.');
    }
}
