<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pago;
use App\Models\Asistencia;
use App\Models\Miembro;
use App\Models\Setting;
use Carbon\Carbon;

class StatCards extends Component
{
    // Estadísticas de hoy
    public $dailyIncome = 0;
    public $dailyAttendance = 0;
    public $newMembers = 0;

    // Porcentajes de cambio
    public $incomeChange = 0;
    public $attendanceChange = 0;
    public $newMembersChange = 0;

    public $currencySymbol = '$';

    public function mount()
    {
        $this->loadStats();
        $setting = Setting::where('key', 'currency_symbol')->first();
        $this->currencySymbol = $setting ? $setting->value : '$';
    }

    private function calculateChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0; // Evitar división por cero
        }
        return (($current - $previous) / $previous) * 100;
    }

    public function loadStats()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // --- Datos de Hoy ---
        // Usamos created_at para estandarizar, ya que ha sido la columna más fiable.
        $this->dailyIncome = Pago::whereDate('created_at', $today)->sum('monto');
        $this->dailyAttendance = Asistencia::whereDate('created_at', $today)->distinct('miembro_id')->count();
        $this->newMembers = Miembro::whereDate('created_at', $today)->count();

        // --- Datos de Ayer ---
        $yesterdayIncome = Pago::whereDate('created_at', $yesterday)->sum('monto');
        $yesterdayAttendance = Asistencia::whereDate('created_at', $yesterday)->distinct('miembro_id')->count();
        $yesterdayNewMembers = Miembro::whereDate('created_at', $yesterday)->count();

        // --- Cálculo de los Porcentajes ---
        $this->incomeChange = $this->calculateChange($this->dailyIncome, $yesterdayIncome);
        $this->attendanceChange = $this->calculateChange($this->dailyAttendance, $yesterdayAttendance);
        $this->newMembersChange = $this->calculateChange($this->newMembers, $yesterdayNewMembers);
    }

    public function render()
    {
        return view('livewire.admin-day-stat-cards');
    }
}
