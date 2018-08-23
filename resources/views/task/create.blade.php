@extends('task.layauts')

@section('content')
    <form class="form" action="{{ route("task.store") }}" method="post">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="task">Task name:</label>
                    <input type="text" class="form-control" name="task_name"><br>
                <label for="task">Task body:</label>
                    <textarea class="body form-control" name="body"></textarea>
                <button type="submit" class="btn btn-success">Add Task</button>
                <span class="btn__click">
                    <a class="btn btn-primary" href=" {{ route('task.index') }}">Cancel</a>
                </span>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $('.btn-success').on('click', function () {
            $('.btn-success').css("pointer-events", "none");
        });
    </script>
@endsection
