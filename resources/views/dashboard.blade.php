<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-base-content">Dashboard</h2>
            <p class="text-base-content/70">Resumen de actividades y estadísticas del gimnasio</p>
        </div>

        <livewire:stat-cards />

        {{--
            Aquí es donde, en el futuro, podremos añadir
            las otras tarjetas y el gráfico de barras.
        --}}

    </main>
</x-app-layout>
