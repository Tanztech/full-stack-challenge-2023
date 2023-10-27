<?php

namespace App\Http\Livewire\Users;

use App\User;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $role;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required|string|min:6',
    ];

    public function render()
    {
        return view('livewire.users.user-create');
    }

    public function add_user(){
         $this->validate();

        if (User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'status' => 'active',
            'password' => bcrypt($this->password),
        ])){
            session()->flash('success',  ' user added successfully!');
            $this->emit('reload');
            $this->name = $this->email = $this->role = $this -> password = $this->password_confirmation = '';
        }else{
            session()->flash('error',  ' Failed to add user');
        }

    }
}
