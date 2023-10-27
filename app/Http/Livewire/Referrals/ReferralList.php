<?php

namespace App\Http\Livewire\Referrals;

use App\Http\Controllers\Pagination;
use App\Http\Controllers\SearchController;
use App\Referral;
use Livewire\Component;
use stdClass;

class ReferralList extends Component
{
    public  $country_filter = false;
    public  $active_city = false;
    public  $cities = [];
    public   $data = [];
    public $search;
    public $country;
    public $city;
    public  $stringData = '';

    protected $listeners = ['reload'=>'render'];

    public function mount($country = null, $city = null){
        if ($country !==null || $city !== null){
            $this->country_filter = true;
            $this->country = $country;
            $this->city = $city;
            $this->cities = Referral::getCities($this->country);

        }
        if ($this->country == null){
            $this->active_city = false;
        }else{
            $this->active_city = true;
        }

    }


    public function render()
    {
        return view('livewire.referrals.referral-list',['referrals'=>(new Pagination)->paginate(collect(json_decode($this->refferals())),10),'countries'=>Referral::getCountries()]);
    }

    public function Search(): array
    {
        return SearchController::searchData($this->data(),strtolower($this->search));
    }

    private function data():array{
       if ($this->country !== null){
           return $this->filter($this->country,$this->city);
       }
        return  Referral::get()->map(function($item){$item->data = unserialize(decrypt($item->data)); $dt = new stdClass; $dt->id = $item->id; $dt->data = $item->data;  return $dt;})->toArray();

    }

    private function filter($country,$city){
        $data = null;

        if ($country !== null){
            if ($city !== null){
                $data = Referral::get()->map(function($item) use($country,$city){
                    $item->data = unserialize(decrypt($item->data));
                    $dt = new stdClass;
                    if ( strtolower($item->data['country']) == strtolower($country) && strtolower($item->data['city']) == strtolower($city)){
                        $dt->id = $item->id;
                        $dt->data = $item->data;
                        $dt->created_at = $item->created_at;
                        $dt->updated_at = $item->updated_at;
                    }
                    return $dt;

                })->toArray();
            }else{
                $data = Referral::get()->map(function($item) use($country){
                    $item->data = unserialize(decrypt($item->data));
                    $dt = new stdClass;
                    if ( strtolower($item->data['country']) == strtolower($country)){
                        $dt->id = $item->id;
                        $dt->data = $item->data;
                        $dt->created_at = $item->created_at;
                        $dt->updated_at = $item->updated_at;
                    }
                    return $dt;

                })->toArray();
            }

        }else{$data = [];}


        return array_filter($data, function ($item) {
            return !empty($item->data);
        });
    }
    public function filterCountry(){
        return redirect()->route('referrals-view',['country'=>$this->country]);
    }

    public function filterCity(){
        if ($this->country !== null){
            return redirect()->route('referrals-view',['country'=>$this->country,'city'=>$this->city]);
        }
        session()->flash('error','country not selected');
        return back();
    }

    private function refferals($key = null){
        $data = "";
        if ($this->search == null || $this->search == "" ){
            $data = json_encode($this->data());
        }
        else{
            $data = json_encode($this->Search());
        }

        return $data ;
    }

}
