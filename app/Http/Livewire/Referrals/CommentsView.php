<?php

namespace App\Http\Livewire\Referrals;

use App\Comments;
use App\Http\Controllers\Pagination;
use Livewire\Component;

class CommentsView extends Component
{
    public $data;

    protected $listeners = ['reload'=>'mount'];

    public function mount($id = null){
        if ($id !== null){
            $this->data = $id;
        }
    }
    public function render()
    {

        $data = Comments::where('referee_id',intval($this->data))->get()->map(function ($item){
            $item->data =  unserialize(decrypt($item->data));
            return $item;
        });

        return view('livewire.referrals.comments-view',['comments'=> (new Pagination)->paginate($data,10) ]);
    }
}
