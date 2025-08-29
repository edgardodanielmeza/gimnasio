<div class="fixed z-20 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-base-100 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog">
            <form>
                <div class="bg-base-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-base-content">Registrar Nuevo Pago</h3>
                    <p class="text-sm mt-1">Para la membresía que termina el {{ \App\Models\Membresia::find($membresia_a_pagar_id)?->fecha_fin }}</p>
                    <div class="mt-4">
                        <label for="monto" class="label"><span class="label-text">Monto del Pago</span></label>
                        <input type="number" id="monto" wire:model.lazy="monto" class="input input-bordered w-full" placeholder="0.00">
                        @error('monto') <span class="text-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="metodo_pago" class="label"><span class="label-text">Método de Pago</span></label>
                        <select id="metodo_pago" wire:model="metodo_pago" class="select select-bordered w-full">
                            <option value="efectivo">Efectivo</option>
                            <option value="tarjeta">Tarjeta</option>
                            <option value="transferencia">Transferencia</option>
                        </select>
                        @error('metodo_pago') <span class="text-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="bg-base-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click.prevent="savePago()" type="button" class="btn btn-primary">Registrar Pago</button>
                    <button wire:click="$set('showPagoModal', false)" type="button" class="btn btn-ghost">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
