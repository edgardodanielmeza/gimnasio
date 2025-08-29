<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Miembro;
use App\Models\Asistencia;
use Carbon\Carbon;

class AsistenciaManagement extends Component
{
    public $search = '';
    public $miembro;
    public $activeMembresia;
    public $message = '';
    public $messageType = '';

    public function render()
    {
        return view('livewire.asistencia-management')->layout('layouts.app');
    }

    public function searchMiembro()
    {
        $this->reset(['miembro', 'activeMembresia', 'message', 'messageType']);

        if (empty($this->search)) {
            $this->message = 'Por favor, ingrese un documento de identidad.';
            $this->messageType = 'error';
            return;
        }

        $this->miembro = Miembro::where('documento_identidad', $this->search)->first();

        if ($this->miembro) {
            $this->activeMembresia = $this->miembro->membresias()
                ->where('estado', 'activa')
                ->where('fecha_inicio', '<=', today())
                ->where('fecha_fin', '>=', today())
                ->first();

            if (!$this->activeMembresia) {
                $this->message = 'El miembro no tiene una membresía activa.';
                $this->messageType = 'error';
            }
        } else {
            $this->message = 'Miembro no encontrado.';
            $this->messageType = 'error';
        }
    }

    public function checkIn()
    {
        if (!$this->miembro || !$this->activeMembresia) return;

        // Verificar si ya hay un check-in abierto hoy
        $existingCheckIn = Asistencia::where('miembro_id', $this->miembro->id)
            ->whereNull('fecha_hora_salida')
            ->whereDate('fecha_hora_ingreso', today())
            ->first();

        if ($existingCheckIn) {
            $this->message = 'El miembro ya tiene un ingreso registrado hoy que no ha sido cerrado.';
            $this->messageType = 'warning';
            return;
        }

        Asistencia::create([
            'miembro_id' => $this->miembro->id,
            'sucursal_id' => Auth::user()->sucursal_id ?? Sucursal::first()->id, // Asignar sucursal del recepcionista o la primera
            'fecha_hora_ingreso' => now(),
        ]);

        $this->message = 'Ingreso registrado exitosamente.';
        $this->messageType = 'success';
        $this->reset('search'); // Limpiar búsqueda para el siguiente
    }

    public function checkOut()
    {
        if (!$this->miembro) return;

        $asistencia = Asistencia::where('miembro_id', $this->miembro->id)
            ->whereNull('fecha_hora_salida')
            ->latest('fecha_hora_ingreso')
            ->first();

        if ($asistencia) {
            $asistencia->update(['fecha_hora_salida' => now()]);
            $this->message = 'Salida registrada exitosamente.';
            $this->messageType = 'success';
            $this->reset('search', 'miembro', 'activeMembresia');
        } else {
            $this->message = 'No se encontró un ingreso abierto para este miembro.';
            $this->messageType = 'error';
        }
    }
}
