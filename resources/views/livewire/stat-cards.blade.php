<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Tarjeta 1: Ingresos del Día -->
    <div class="stat-card bg-base-200 rounded-xl p-6 border-l-primary">
        <div class="flex justify-between items-start">
            <div>
                <div class="stat-title text-base-content/70 mb-1">Ingresos del Día</div>
                <div class="stat-value text-3xl font-bold text-primary mt-1">{{ $currencySymbol }}{{ number_format($dailyIncome, 2) }}</div>
            </div>
            <div class="stat-figure text-primary">
                <div class="p-3 rounded-full bg-primary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01" /></svg>
                </div>
            </div>
        </div>
        @if($incomeChange != 0)
        <div class="mt-4 flex items-center text-sm @if($incomeChange > 0) text-success @else text-error @endif">
            @if($incomeChange > 0)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                <span>+{{ number_format($incomeChange, 1) }}% desde ayer</span>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                <span>{{ number_format($incomeChange, 1) }}% desde ayer</span>
            @endif
        </div>
        @endif
    </div>

    <!-- Tarjeta 2: Asistencias del Día -->
    <div class="stat-card bg-base-200 rounded-xl p-6 border-l-secondary">
        <div class="flex justify-between items-start">
            <div>
                <div class="stat-title text-base-content/70 mb-1">Asistencias del Día</div>
                <div class="stat-value text-3xl font-bold text-secondary mt-1">{{ $dailyAttendance }}</div>
            </div>
            <div class="stat-figure text-secondary">
                 <div class="p-3 rounded-full bg-secondary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
        </div>
        @if($attendanceChange != 0)
        <div class="mt-4 flex items-center text-sm @if($attendanceChange > 0) text-success @else text-error @endif">
            @if($attendanceChange > 0)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                <span>+{{ number_format($attendanceChange, 1) }}% desde ayer</span>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                <span>{{ number_format($attendanceChange, 1) }}% desde ayer</span>
            @endif
        </div>
        @endif
    </div>

    <!-- Tarjeta 3: Nuevos Miembros -->
    <div class="stat-card bg-base-200 rounded-xl p-6 border-l-accent">
        <div class="flex justify-between items-start">
            <div>
                <div class="stat-title text-base-content/70 mb-1">Nuevos Miembros</div>
                <div class="stat-value text-3xl font-bold text-accent mt-1">{{ $newMembers }}</div>
            </div>
            <div class="stat-figure text-accent">
                <div class="p-3 rounded-full bg-accent/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                </div>
            </div>
        </div>
        @if($newMembersChange != 0)
        <div class="mt-4 flex items-center text-sm @if($newMembersChange > 0) text-success @else text-error @endif">
             @if($newMembersChange > 0)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                <span>+{{ number_format($newMembersChange, 1) }}% desde ayer</span>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                <span>{{ number_format($newMembersChange, 1) }}% desde ayer</span>
            @endif
        </div>
        @endif
    </div>

</div>
