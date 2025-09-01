<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Miembro;
use App\Models\Membresia;
use App\Models\TipoMembresia;
use App\Models\Pago;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MiembroShow extends Component
{
    public Miembro $miembro;

    // Propiedades para el modal de nueva membresía
    public $showMembresiaModal = false;
    public $tipo_membresia_id;
    public $fecha_inicio;

    // Propiedades para el modal de nuevo pago
    public $showPagoModal = false;
    public $membresia_a_pagar_id;
    public $monto;
    public $metodo_pago = 'efectivo';

    public function mount(Miembro $miembro)
    {
        $this->miembro = $miembro->load('membresias.tipoMembresia', 'membresias.pagos.receptor');
        $this->fecha_inicio = today()->format('Y-m-d');
    }

    public function render()
    {
        $tiposMembresia = TipoMembresia::all();
        return view('livewire.miembro-show', [
            'tiposMembresia' => $tiposMembresia
        ])->layout('layouts.app');
    }

    // --- Lógica para Membresías ---
    public function openMembresiaModal()
    {
        $this->reset(['tipo_membresia_id']);
        $this->fecha_inicio = today()->format('Y-m-d');
        $this->showMembresiaModal = true;
    }

    public function saveMembresia()
    {
        $this->validate([
            'tipo_membresia_id' => 'required|exists:tipos_membresia,id',
            'fecha_inicio' => 'required|date',
        ]);

        $tipoMembresia = TipoMembresia::find($this->tipo_membresia_id);
        $fechaFin = Carbon::parse($this->fecha_inicio)->addDays($tipoMembresia->duracion_dias)->format('Y-m-d');

        $this->miembro->membresias()->create([
            'tipo_membresia_id' => $this->tipo_membresia_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $fechaFin,
            'estado' => 'pendiente',
        ]);

        $this->showMembresiaModal = false;
        $this->mount($this->miembro);
        session()->flash('message', 'Nueva membresía añadida.');
    }

    // --- Lógica para Pagos ---
    public function openPagoModal($membresiaId)
    {
        $this->reset(['monto', 'metodo_pago']);
        $this->membresia_a_pagar_id = $membresiaId;
        $this->showPagoModal = true;
    }

    public function savePago()
    {
        $this->validate([
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string',
            'membresia_a_pagar_id' => 'required|exists:membresias,id',
        ]);

        $membresia = Membresia::find($this->membresia_a_pagar_id);

        $membresia->pagos()->create([
            'user_id_receptor' => Auth::id(),
            'monto' => $this->monto,
            'metodo_pago' => $this->metodo_pago,
            'fecha_pago' => now(),
        ]);

        if ($membresia->estado === 'pendiente' && Carbon::parse($membresia->fecha_inicio)->isToday() || Carbon::parse($membresia->fecha_inicio)->isPast()) {
            $membresia->update(['estado' => 'activa']);
        }

        $this->showPagoModal = false;
        $this->mount($this->miembro);
        session()->flash('message', 'Pago registrado exitosamente.');
    }
}
