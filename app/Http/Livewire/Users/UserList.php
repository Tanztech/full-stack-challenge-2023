<?php

namespace App\Http\Livewire\Users;

use App\Http\Controllers\Pagination;
use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    protected $listeners = ['reload'=>'render'];
    public function render()
    {


        return view('livewire.users.user-list',['users'=>User::paginate(10)]);
    }

    public function ban_user($id){
        $data = User::find($id);
        if ($data !== null){
            if (User::where('id',$id)->update(['status'=>'banned'])){
                session()->flash('success',  ' user banned successfully!');
                $this->emit('reload');
            }else{
                session()->flash('error',  ' failed to ban user');
                $this->emit('added');
            }
        }


    }

    public function delete_user($id){
       User::find($id)->delete();
        session()->flash('success',  ' user deleted successfully!');
        $this->emit('reload');
    }

}
