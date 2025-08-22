<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $userId, $name, $email, $password, $password_confirmation;
    public $selectedRoles = [];

    protected $listeners = ['delete'];

    public function render()
    {
        // Asegurarse que solo usuarios con permiso puedan ver la página
        abort_if(Gate::denies('read users'), 403);

        $users = User::with('roles')->paginate(10);
        $roles = Role::all();

        return view('livewire.user-management', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function create()
    {
        abort_if(Gate::denies('create users'), 403);
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        abort_if(Gate::denies('create users'), 403);

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'selectedRoles' => 'required|array|min:1',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->syncRoles($this->selectedRoles);

        session()->flash('message', 'Usuario creado exitosamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        abort_if(Gate::denies('update users'), 403);

        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles->pluck('name')->toArray();

        $this->openModal();
    }

    public function update()
    {
        abort_if(Gate::denies('update users'), 403);

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'selectedRoles' => 'required|array|min:1',
        ]);

        if ($this->userId) {
            $user = User::find($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if ($this->password) {
                $this->validate(['password' => 'string|min:8|confirmed']);
                $user->update(['password' => Hash::make($this->password)]);
            }

            $user->syncRoles($this->selectedRoles);
            session()->flash('message', 'Usuario actualizado exitosamente.');
            $this->closeModal();
            $this->resetInputFields();
        }
    }

    public function confirmDelete($id)
    {
        abort_if(Gate::denies('delete users'), 403);

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => '¿Estás seguro?',
            'text' => '¡No podrás revertir esto!',
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        abort_if(Gate::denies('delete users'), 403);

        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado exitosamente.');
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
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedRoles = [];
    }
}
