<?php

namespace App\Http\Controllers;

use App\Referral;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReferralController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($country=null, $city=null)
    {
        return view('referrals.index',['country'=>$country,'city'=>$city]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('referrals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $this->validate(request(), [
                'reference_no' => 'required|unique:referrals',
                'organisation' => 'required',
                'province' => 'required',
                'district' => 'required',
                'provider_name' => 'required',
                'phone' => 'required'
            ]);
        //

        $data = $request->all();
        $data['facility_name'] = null;
        $data['pills_available'] = null;
        $data['code_to_use'] = null;
        $data['type_of_service'] = null;
        $data['note'] = null;
        $data['womens_evaluation'] = null;


        Referral::create(['data'=>encrypt(serialize($data))]);
//        Referral::create([
//
//                "reference_no" => request("reference_no"),
//                "organisation" => request("organisation"),
//                "province" => request("province"),
//                "district" => request("district"),
//                "city" => request("city"),
//                "street_address" => request("street_addr"),
//                "country" => request("country"),
//                "email" => request("email"),
//                "website" => request("website"),
//                "zipcode" => request("zipcode"),
//                "facility_type" => request("facility_type"),
//                "gps_location" => request("gps_location"),
//                "position" => request("position"),
//                "provider_name" => request("provider_name"),
//                "phone" => request("phone")
//            ]);

        return redirect('referrals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        //
    }

    public function upload() {
        return view('referrals.upload');
    }

    public function processUpload(Request $request) {
        $cols = array(
            'country',
            'reference_no',
            'organisation',
            'province',
            'district',
            'city',
            'street_address',
            'gps_location',
            'facility_name',
            'facility_type',
            'provider_name',
            'position',
            'phone',
            'email',
            'website',
            'pills_available',
            'code_to_use',
            'type_of_service',
            'note',
            'womens_evaluation');

        if ($request->file('referral_file')->isValid()) {
            // echo $request->referral_file->extension();
            // echo "<hr />";
            // echo $request->referral_file->path();
            if($request->referral_file->extension() == "csv") {

                $file = fopen($request->referral_file->path(), "r");
                $all_data = array();
                $ctr = 0;
                $failed = array();
                while (($data = fgetcsv($file, 200, ",")) !==FALSE ) {
                    // print_r($cols); 
                    // print_r($data);

                    if(count($cols) === count($data)) {
                        $arr[] = array_combine($cols, $data);

                        $ctr++;

                    }else {
                       if ($data[0] !==null){
                           $failed[] = $data[1];
                           Log::critical("Failed - data c = " . count($data).  " field c = " . count($cols) . " => ".implode(',', $data));
                       }
                    }

                }
                foreach ($arr as $key=>$data){
                    Referral::create(['data'=>encrypt(serialize($data))]);
                }

                if(count($failed)>0) {
                    $request->session()->flash('error', "Reference Nos. " . implode(',', $failed) . ' failed to upload!');
                }else{
                    $request->session()->flash('status', $ctr . ' records uploaded successful!');
                }
            }
            else{
                dd('is file');
            }
        }else{
            dd('invalid');
        }

        return redirect('referrals');
    }
}
