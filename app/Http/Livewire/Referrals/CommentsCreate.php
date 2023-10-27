<?php

namespace App\Http\Livewire\Referrals;

use App\Comments;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentsCreate extends Component
{
    public $comment;
    public $referee_id;
    protected $rules = [
        'comment' => 'required|min:5|max:255'
    ];

    public function mount($id = null){
        $this->referee_id = $id;
    }
    public function render()
    {
        return view('livewire.referrals.comments-create');
    }

    public function add_comment(){
        $data = $this->validate();
        $data['comment'] = $this->comment;
        $data['commented_by'] = Auth::user()->email;
        $data['status'] = 'active';

        if (Comments::create([
            'comment' => $this->comment,
            'data' => encrypt(serialize($data)),
            'user_id' => Auth::id(),
            'referee_id' => $this->referee_id,
        ])){
            session()->flash('success',  ' comment added successfully!');
            $this->emit('reload');
            $this->comment  = '';
        }else{
            session()->flash('error',  ' Failed to add comment');
        }
    }
}
