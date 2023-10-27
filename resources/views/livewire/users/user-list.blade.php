<div>
    <div class="panel-body px-2 py-3" style="overflow: auto ">

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <button class="btn btn-info px-3 py-2" data-toggle="modal" data-target=".open_modal" ><i class="bi bi-person-plus"></i> Add user </button>
        <table class="table table-responsive table-striped">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>email</th>
                <th>Role</th>
                <th>status</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Actions</th>
            </tr>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }} </td>
                    <td>{{ $user->name }} </td>
                    <td>{{ $user->email }} </td>
                    <td>
                        <span  class="btn px-3 {{ $user->role == 'admin'? 'btn-primary' : 'btn-info' }}   " >{{ $user->role }} </span>
                    </td>
                    <td> <span style="border-radius: 20px!important" class="btn px-3 {{ $user->status == 'active'?'btn-success' : 'btn-danger' }} " >{{ $user->status }}</span> </td>
                    <td>{{ $user->created_at }} </td>
                    <td>{{ $user->updated_at }} </td>
                    <td style="display: flex">
                        <button {{$user->id == Auth::id()?'disabled': ''}} wire:click.prevent="ban_user('{{ $user->id  }}')" href="" data-toggle="tooltip" data-placement="top" title="Ban user" class="btn btn-warning p-1 mx-1 "><i class="bi bi-eye-slash"></i></button>
{{--                        <button {{$user->id == Auth::id()?'disabled': ''}}   href="" data-toggle="tooltip" data-placement="top" title="Edit user" class="btn btn-info p-1 mx-1 "><i class="bi bi-pencil-square"></i></button>--}}
                        <button {{$user->id == Auth::id()?'disabled': ''}} wire:click.prevent="delete_user('{{ $user->id  }}')" href="" data-toggle="tooltip" data-placement="top" title="Delete User" class="btn btn-danger p-1 mx-1 "><i class="bi bi-trash3"></i></button>
                    </td>

                </tr>
            @endforeach
        </table>
    </div>

    <div class="panel-footer">
        {{ $users->links() }}
    </div>

</div>
