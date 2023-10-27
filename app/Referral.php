<?php

namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Referral extends Model
{
    //
    use HasFactory;
    protected $table = 'referrals';

//    protected $fillable =[
//        'country',
//        'reference_no',
//        'organisation',
//        'province',
//        'district',
//        'city',
//        'street_address',
//        'gps_location',
//        'facility_name',
//        'facility_type',
//        'provider_name',
//        'position',
//        'phone',
//        'email',
//        'website',
//        'pills_available',
//        'code_to_use',
//        'type_of_service',
//        'note',
//        'womens_evaluation'
//    ];
    protected $fillable =[
        'data'
    ];

    public static function getCountries(){

        return  DB::table('referrals')->get()->map(function ($item){
            $data  = unserialize(decrypt($item->data));
            if (is_array($data) && array_key_exists('country',$data)){
                return $data['country'];
            }
            return null;
        })->filter() ->unique();

    }

    public static function getCities($country){
//        dd(DB::table('referrals'));
        return  DB::table('referrals')->get()->map(function ($item) use($country){
            $data =  $item-> data = unserialize(decrypt($item->data));
            if (is_array($data)){
                if (strtolower($data['country']) === strtolower($country)){
                    return $data['city'];
                }else{
                    return null;
                }
            }
            return null;
        })->filter();

//    	return DB::table('referrals')->where("country", $country)->pluck('city')->unique();
    }
}
