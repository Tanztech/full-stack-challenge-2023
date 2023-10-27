@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Referrals</h1></div>

                <livewire:referrals.referral-list  :country="$country" :city="$city" />


            </div>
        </div>
    </div>
</div>
@endsection
