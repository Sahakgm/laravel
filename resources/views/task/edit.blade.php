@extends('task.layauts')

@section('content')
    <div class="row">
        <div class="form-group col-lg-6">
            <form action="{{ route('task.update', $data->id) }}" method="POST">
                @csrf
            <label for="task_name">Name</label>
            <input type="text" data-id="{{ $data->id }}" class="task_name form-control" name="task_name" value="{{ $data->task_name }}">

            <label for="body">Body</label>
            <textarea class="body form-control" name="body">{{ $data->body }}</textarea>
            {{ method_field('PATCH') }}
            <input type="submit" value="Save" class="btn btn-success">
                <button class="btn btn-default"><a href="{{ route('task.index') }}">Cancel</a></button>
            </form>
        </div>
        <div class="col col-lg-5">
                <div class="row">
                    <div class="col-md-10">
                        <label for="task_comment">Comment</label>

                        <input type="text" class="task_comment form-control" name="task_comment">
                    </div>
                    <button type="button" class="btn btn-info add-comm" id="add-comment">add</button>
                </div>
                <div>
                    <label for="task_name">Comments</label>
                    <span id="show-success-comment"></span>
                    <div class="body form-control">
                        @forelse($comments as $comment)
                            <p data="{{$comment->id}}">{{$comment->comment}}
                                <img class="delete-image" src="https://cdn1.iconfinder.com/data/icons/feather-2/24/x-16.png">
                                <img class="edit-image" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" src="https://cdn4.iconfinder.com/data/icons/office-tools-mini-set-5/64/change_edit_pencil-16.png">
                            </p>
                        @empty
                            <h1 class="no_comment">No Comment</h1>
                        @endforelse
                    </div>
                </div>
                <span class="alert-save">Do not forget to save!!!</span>
                <input type="submit" class="btn-save btn btn-success" value="Save">
        </div>
    </div>
    @include('task.modal')
@endsection

@section('script')
    <script src="{{ asset('/js/script.js') }}"></script>
@endsection
