@extends('task.layauts')

@section('content')
        <div class="col col-sm-3">
            <b><i>Name: </i></b>{{ $data->task_name }}
        </div>
        <div class="col col-sm-5">
            <b><i>Created  at: </i></b> {{ $data->created_at->format('d-F-Y') }}
        </div>
            @if($data->updated_at)
                <div class="col col-sm-5">
                    <b><i class="_name">Changed at: </i></b> {{ $data->updated_at->format('d-F-Y') }}
                </div>
             @endif
        <div class="col col-sm-10">{{ $data->body }}</div>
            <a href="{{ route('task.index') }}">
                <button class="btn btn-default">Back</button>
            </a>
            <a href="{{ action('TaskController@edit', $data->id, $data->body) }}">
                <button class="btn btn-primary">Edit</button>
            </a>
@endsection