<?php

namespace App\Http\Controllers\Admin;
use App\Comment;
use App\User;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index ()
    {
        $users_count = User::all()->where('role_id', '===', 2)->count();
        return view('admin.admin', compact('users_count'));
        return redirect('/admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUsers ()
    {
        $users = User::all()->where('role_id', '===', 2);
        return view('admin.users', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getTasks (Request $request)
    {
        $user = User::find($request->userId);
            if (is_null($user)) {
                return response([
                    'status' => false,
                    'message' => 'incorrect user id',
                ]);
            };
        $tasks = Task::all()->where('user_id', $user->id);
        if (is_null($tasks)) {
            return response([
               'status' => false,
                'message' => "error while getting tasks",
            ]);
        }else {
            return response([
                'status'=> true,
                'message'=> "success",
                'tasks' => $tasks,
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $task_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getComments (Request $request, $task_id)
    {
        $user = User::find($request->user_id);
        if (is_null($user)) {
            return response([
                'status' => false,
                'message' => 'incorrect user id',
            ]);
        }
        $task = Task::find($task_id);
        if (is_null($task)) {
            return response([
                'status' => false,
                'message' => 'incorrect task id',
            ]);
        };

        $comments = $task->comments;
        return response([
            'status' => true,
            'comments' => $comments,
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteUser (Request $request)
    {
        $user = User::find($request->userId);
        if (is_null($user)) {
            return response([
                'status' => false,
                'message' => 'incorrect user id',
            ]);
        }
        $delete = $user->delete();
        if ($delete) {
            return response([
                'status' => true,
                'message' => 'user has been  deleted',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'user not deleted',
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $taskId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteTask (Request $request, $taskId)
    {
        $user = User::find($request->userId);
        if (is_null($user)) {
            return response([
                'status' => false,
                'message' => 'incorrect user id',
            ]);
        }

        $task = $user->tasks()->find($taskId);
        if (is_null($task)) {
            return response([
                'status' => false,
                'message' => 'incorrect task id',
            ]);
        }

        $delete = $task->delete();
        if ($delete) {
            return response([
                'status' => true,
                'message' => 'task deleted',
            ]);
        }
    }

    public function deleteComment (Request $request, $comment_id)
    {
        $user = User::find($request->userId);
        if (is_null($user)) {
            return response([
                'status' => false,
                'message' => 'incorrect user id',
            ]);
        }

        $task = $user->tasks()->find($request->taskId);
        if (is_null($task)) {
            return response([
                'status' => false,
                'message' => 'incorrect task id',
            ]);
        }

        $comment = $task->comments()->find($comment_id);
        if (is_null($comment)) {
            return response([
                'status' => false,
                'message' => 'incorrect comment id',
            ]);
        }

        $delete = $comment->delete();
        if ($delete) {
            return response([
                'status' => true,
                'message' => 'comment deleted',
            ]);
        }
    }

///////////
    public function checkIds ($user_id, $task_id)
    {
        $user = User::find($user_id);
        if (is_null($user)) {
            return response([
                'status' => false,
                'message' => 'incorrect user id',
            ]);
        }

        $task = $user->tasks()->find($task_id);
        if (is_null($task)) {
            return response([
                'status' => false,
                'message' => 'incorrect task id',
            ]);
        }
    }
}