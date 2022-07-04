<?php

namespace App\Http\Livewire\Registrar\User;

use App\Models\User;
use Livewire\Component;

class Create extends Component
{

    public string $department = '';
    public string $name = '';
    public string $email = '';

    protected function rules()
    {
        return [
            'name' => 'required|min:6',
            'email' => ['required','email', 'unique:users,email' , function ($attribute, $value, $fail) {
                if (!str($value)->contains('@neu.edu.ph')) {
                    $fail('Only email address under @neu.edu.ph will be allowed.');
                }
            },],
        ];
    }

    public function addNewUser()
    {
        $this->validate();

        $user = User::query()->create([
            'email' => $this->email,
            'name' => $this->name,
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF',
            'department_id' => $this->department
        ]);

        $user->assignRole('registrar');

        $this->reset('name', 'email');

        $this->emit('refresh');
        $this->dispatchBrowserEvent('close-user-add-modal');

    }

    public function render()
    {
        return view('livewire.registrar.user.create');
    }
}
