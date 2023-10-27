<div>
    <div class="panel-body px-2 py-3" style="overflow: auto ">
        <div class="pull-right px-3">
            <button class="btn btn-info px-3 py-2" data-toggle="modal" data-target=".open_modal" ><i class="bi bi-person-plus"></i> Add Comment </button>
        </div>

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
        <table class="table table-responsive table-striped my-2" style="margin-top: 8px!important;">
            <tr>
                <th>#</th>
                <th>Commented by</th>
                <th>Comments</th>
                <th>Created Date</th>
                <th>Updated Date</th>

            </tr>
            @if($comments ->isEmpty())
                <tr><td colspan="5">No comments!!</td></tr>
            @else
                @foreach($comments as $key => $comment)
                    <tr>
                        <td>{{ $key+1 }} </td>
                        <td>{{ $comment->data['commented_by'] }} </td>
                        <td>{{ $comment->data['comment'] }} </td>
                        <td>{{ $comment->created_at }} </td>
                        <td>{{ $comment->updated_at }} </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>

    <div class="panel-footer">
        {{ $comments->links() }}
    </div>
</div>
