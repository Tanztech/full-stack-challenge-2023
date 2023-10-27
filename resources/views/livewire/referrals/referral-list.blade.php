<div>
    <div class="panel-body px-2 py-3" >
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'supervisor' )
            <div  style="padding-bottom: 5px ; display: flex; width: 100%!important; justify-content: space-between!important">

                <div class="filters" style="display: flex;">
                    @if($country_filter )

                        <a class="btn btn-danger" href="{{ url('referrals/') }}">Remove filters</a>
                    @endif
                    <select wire:model="country" wire:change="filterCountry" id="country" {{count($countries) <= 1?'disabled':''}}  style="width: 180px; margin: 0 4px">
                        <option value="">-- filter by country --</option>
                        @if(count($countries) > 1)
                            @foreach($countries as $country)
                                <option value="{{$country}}">{{$country}}</option>
                            @endforeach
                        @endif
                    </select>
                    <select wire:model="city" wire:change="filterCity" id="city" {{!$active_city || count($cities) <= 1 ?'disabled':''}} style="width: 180px; margin: 0 4px">
                        <option value="">-- filter by city --</option>
                        @if(count($cities) > 1)
                            @foreach($cities as $city)
                                <option value="{{$city}}">{{$city}}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="input-group" style="margin: 0 4px" >
                        <input type="search"  wire:model.debounce="search"  wire:keydown.debounce="Search" class="form-control " placeholder="search.." aria-label="search" >
                    </div>
                </div>
                <div class="buttons pull-right">
                    <a href="{{route('add-referral')}}" class="btn btn-info mx-3 ">Add referral</a>
                    <a href="/referrals/upload" class="btn btn-success  " style="margin-left: 5px!important;">Bulk Upload</a>

                </div>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
       <div class="table-section" style="overflow: auto ">
           <table class="table table-responsive table-striped my-2" >
               <thead>
               <tr>
                   <th>#</th>
                   <th>Actions</th>
                   <th>Country</th>
                   <th>Reference No</th>
                   <th>Organisation</th>
                   <th>Province</th>
                   <th>District</th>
                   <th>City</th>
                   <th>Street Address</th>
                   <th>Gps Location</th>
                   <th>Facility Name</th>
                   <th>Facility Type</th>
                   <th>Provider Name</th>
                   <th>Position</th>
                   <th>Phone</th>
                   <th>eMail</th>
                   <th>Website</th>
                   <th>Pills Available</th>
                   <th>Code To Use</th>
                   <th>Type of Service</th>
                   <th>Note</th>
                   <th>Womens Evaluation</th>
               </tr>
               </thead>
               <tbody>
               @if($referrals ->isNotEmpty())
                   @foreach($referrals as $key => $referral)
                       <tr>
                           <td>{{ $key+1 }} </td>
                           <td><a href="{{route('comments',['user'=>$referral->id])}}" class="btn btn-info px-2 py-1"> <i class="bi bi-eye"></i> View comments</a> </td>
                           <td>{{ $referral->data -> country }} </td>
                           <td>{{ $referral->data -> reference_no }} </td>
                           <td>{{ $referral->data -> organisation }} </td>
                           <td>{{ $referral->data -> province }} </td>
                           <td>{{ $referral->data -> district }} </td>
                           <td>{{ $referral->data -> city }} </td>
                           <td>{{ $referral->data -> street_address }} </td>
                           <td>{{ $referral->data -> gps_location }} </td>
                           <td>{{ $referral->data -> facility_name }} </td>
                           <td>{{ $referral->data -> facility_type }} </td>
                           <td>{{ $referral->data -> provider_name }} </td>
                           <td>{{ $referral->data -> position }} </td>
                           <td>{{ $referral->data -> phone }} </td>
                           <td>{{ $referral->data -> email }} </td>
                           <td>{{ $referral->data -> website }} </td>
                           <td>{{ $referral->data -> pills_available }} </td>
                           <td>{{ $referral->data -> code_to_use }} </td>
                           <td>{{ $referral->data -> type_of_service }} </td>
                           <td>{{ $referral->data -> note }} </td>
                           <td>{{ $referral->data -> womens_evaluation }} </td>
                       </tr>
                   @endforeach
               @endif
               </tbody>

           </table>
       </div>
    </div>

    <div class="panel-footer">
        {{ $referrals->links() }}
    </div>
</div>
