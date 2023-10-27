<div>
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{  session('success') }}
        </div>
    @endif
    <form class="form-horizontal" wire:submit.prevent="add_user">
        <div class="modal-body">

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autofocus>

                    @error('name')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" >
                    @error('email')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>

            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">User Role</label>

                <div class="col-md-6">

                    <select wire:model.defer="role" class="form-select w-100 @error('role') is-invalid @enderror " style="width: 100%!important; height: 35px" name="role" aria-label="Default select example" >
                        <option value="">-- select role -- </option>
                        <option value="admin">Admin</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="executive">Executive</option>
                    </select>
                    @error('role')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" wire:model.defer="password" class="form-control @error('password') is-invalid @enderror  " name="password" >

                    @error('password')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" wire:model.defer="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror " name="password_confirmation" >
                    @error('password_confirmation')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
