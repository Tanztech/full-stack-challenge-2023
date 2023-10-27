@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Users</h1></div>

                    <livewire:users.user-list/>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade open_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center" id="exampleModalLabel"  >Create New User</h5>
                    <button type="button" class="close btn btn-default" data-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-octagon-fill"></i>
                    </button>
                </div>
                <livewire:users.user-create/>

            </div>
        </div>
    </div>


@endsection
