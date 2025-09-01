<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div class="inline-block align-bottom bg-base-100 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-base-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="name" class="label"><span class="label-text">Nombre</span></label>
                            <input type="text" class="input input-bordered w-full" id="name" placeholder="Ingrese Nombre" wire:model="name">
                            @error('name') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="label"><span class="label-text">Email</span></label>
                            <input type="email" class="input input-bordered w-full" id="email" placeholder="Ingrese Email" wire:model="email">
                            @error('email') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="label"><span class="label-text">Contraseña</span></label>
                            <input type="password" class="input input-bordered w-full" id="password" placeholder="Ingrese Contraseña" wire:model="password">
                            @error('password') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="label"><span class="label-text">Confirmar Contraseña</span></label>
                            <input type="password" class="input input-bordered w-full" id="password_confirmation" placeholder="Confirme Contraseña" wire:model="password_confirmation">
                        </div>
                        <div class="mb-4">
                            <label class="label"><span class="label-text">Roles</span></label>
                            @foreach($roles as $role)
                                <div class="form-control">
                                    <label class="label cursor-pointer">
                                        <span class="label-text">{{ $role->name }}</span>
                                        <input type="checkbox" value="{{ $role->name }}" wire:model="selectedRoles" class="checkbox checkbox-primary" />
                                    </label>
                                </div>
                            @endforeach
                             @error('selectedRoles') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="bg-base-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click.prevent="store()" type="button" class="btn btn-primary">
                        Guardar
                    </button>
                    <button wire:click="closeModal()" type="button" class="btn btn-ghost">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
