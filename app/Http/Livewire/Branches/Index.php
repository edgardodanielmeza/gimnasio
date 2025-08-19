<?php

namespace App\Http\Livewire\Branches;

use Livewire\Component;
use App\Models\Branch;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $branch_id, $name, $address, $phone;
    public $searchTerm = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
    ];

    public function render()
    {
        $branches = Branch::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('address', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);

        return view('livewire.branches.index', [
            'branches' => $branches,
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
        $this->branch_id = null;
        $this->name = '';
        $this->address = '';
        $this->phone = '';
    }

    public function store()
    {
        $this->validate();

        Branch::updateOrCreate(['id' => $this->branch_id], [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        session()->flash('message',
            $this->branch_id ? 'Sucursal actualizada correctamente.' : 'Sucursal creada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        $this->branch_id = $id;
        $this->name = $branch->name;
        $this->address = $branch->address;
        $this->phone = $branch->phone;

        $this->openModal();
    }

    public function delete($id)
    {
        Branch::find($id)->delete();
        session()->flash('message', 'Sucursal eliminada correctamente.');
    }
}
