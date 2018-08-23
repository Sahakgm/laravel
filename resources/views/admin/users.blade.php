@extends('admin.layauts')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div id="message"></div>
                <div id="comment_message"></div>
                <div class="col_nav col-md-1">id</div>
                <div class="col_nav col-md-2">Name</div>
                <div class="col_nav col-md-3">Email</div>
                <div class="col_nav col-md-2">created at</div>

                @forelse($users as $user)
                    <div class="row" data-id="{{ $user->id }}">
                        <div class="col_id  col col-md-1">{{ $loop->iteration }}</div>
                        <div class="col_id col col-md-2">{{ $user->name }}</div>
                        <div class="col col-md-3">{{ $user->email }}</div>
                        <div class="col col-md-2">{{ $user->created_at->format('d-F-Y') }}</div>
                        <div class="col col-md-2 btn_click">
                            <button class=" btn btn-primary _tasks">Tasks</button>
                        </div>
                        <div class="col col-md-2 btn_click">
                            <button class="btn btn-warning btn_delete" type="submit">Delete</button>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger">
                        <h2>No tasks...</h2>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="tasks col-md-6" data-id="{{ $user->id }}"></div>
    </div>



    <p>
        <a class="btn btn-primary show-comment" data-toggle="collapse" href="#multiCollapseExample1">Toggle</a>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">

                    <div data="1">
                        <img class='delete-comment' src='../images/del-com.png'>
                        <p id='task-comment'>comment 1</p>
                    </div>
                    <div data="2">
                        <img class='delete-comment' src='../images/del-com.png'>
                        <p id='task-comment'>comment 2</p>
                    </div>
                    <div data="3">
                        <img class='delete-comment' src='../images/del-com.png'>
                        <p id='task-comment'>comment 3</p>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')

<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>

@endsection