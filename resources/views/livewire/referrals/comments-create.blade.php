<div>
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error')}}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
    @endif
    <form class="form-horizontal" wire:submit.prevent="add_comment">
        <div class="modal-body">

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">

                <div class="col-md-12">
                    <textarea  id="comment"   rows="4"  wire:model.defer="comment" type="text" class="form-control @error('comment') is-invalid @enderror" comment="comment" value="{{ old('comment') }}"  placeholder="{{$comment?:'Type your comment here .. '}}"   autofocus   >
                    </textarea >

                    @error('comment')
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
