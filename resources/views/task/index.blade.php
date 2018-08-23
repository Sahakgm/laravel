@extends('task.layauts')

@section('content')
    @if(!empty($data))
        <div class="row">
            <div class="col_nav col-md-1">id</div>
            <div class="col_nav col-md-1">Name</div>
            <div class="col_nav col-md-6">body</div>
            <div class="col_nav col-md-1">created at</div>
            <div class="col_nav col-md-1">updated at</div>
            <div class="col_nav col-md-2"></div>
        </div>
    @endif
    @forelse($data as $key)
        <div class="row row1">
            <div class="col_id col col-md-1">{{ $loop->iteration }}</div>
            <div class="col_id col col-md-1">{{ $key->task_name }}</div>
            <div class="col col-md-6">
                <a href="{{ route('task.show', $key->id) }}">{{ $key->body }}</a>
            </div>
            <div class="col col-md-1">{{ $key->created_at->format('d-F-Y') }}</div>
            <div class="col col-md-1">{{ $key->updated_at->format('d-F-Y') }}</div>
            <div class="col col-md-1">
                <div class="btn_click">
                    <a class="btn btn-primary" href="{{ route('task.edit', $key->id) }}">Edit</a>
                </div>
            </div>
            <div class="col col-md-1">
                <div class="btn_click">
                    <form action="{{ route('task.destroy', $key->id) }}" method="post">
                        @csrf
                        {{ method_field('delete') }}
                        <button class="btn btn-warning btn_delete" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-danger">
            <h2>No tasks...</h2>
        </div>
    @endforelse
@endsection

