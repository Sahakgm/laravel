<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = User::find(Auth::id());
        if (is_null($user)) {
            return redirect(url('/'));
        };

        $data = $user->tasks;
        if (is_null($data)) {
            return redirect(url('/'));
        }
        return view('task.index', compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * @param TaskStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TaskStoreRequest $request)
    {
        if (Auth::check()) {
            $req = [
              'task_name' => $request->task_name,
              'user_id' => Auth::id(),
              'body' => $request->body,
            ];
        }else{
            return redirect(url('/'));
        }

        $data = Task::create($req);
        if ($data) {
            return redirect()->to('task')->withSuccess('Task has been created');
        } else {
            return redirect('task')->withErrors('Task not added');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        if (is_null($user)) {
            return redirect('/');
        }
        $data = $user->tasks->find($id);

        if (is_null($data)) {
            return redirect(404);
        } else {
            return view('task.show', compact('data'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        if (is_null($user)) {
            return redirect('/');
        }
        $data = $user->tasks->find($id);

        if (is_null($data)) {
            return redirect('404');
        }
        $data1 = Task::find($id)->comments;
        if (is_null($data)) {
            return redirect('task');
        } else {
            return view('task.edit', ['data' => $data, 'comments' => $data1]);
        }
    }

    /**
     * @param TaskStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TaskStoreRequest $request, $id)
    {
        $data = Task::find($id);
        if (is_null($data)) {
            return redirect(404);
        }
        if (is_null($data->body == $request->body && $data->task_name == $request->task_name)) {
            return redirect('task');
        } else {
            $update = $data->update($request->all());
            if ($update) {
                return redirect()->back()->withSuccess($data->task_name . ' has been  updated');
            } else {
                return redirect()->back()->withErrors('Task not deleted');
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $data = Task::findOrFail($id);
        if (is_null($data)) {
            return redirect()->back()->withSuccess('Task not deleted');
        }
        $data->comments()->delete();
        $result = $data->delete();
        if ($result) {
            return redirect()->back()->withSuccess('Task has been  deleted');
        } else {
            return redirect('task')->withErrors('Task not deleted');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments ($id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return redirect('task');
        }
        $data = $task->comments;
        if (is_null($data)) {
            return redirect('task');
        } else {
            return view('task.add', ['id'=>$id, 'comments'=>$data]);
        }
    }

    /**
     * @param TaskStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment (TaskStoreRequest $request, $id)
    {
        $comments = $request->comments;
        $collection = [];
        foreach ($comments as $comment) {
            $collection[] = ['comment' => $comment];
        }

        $task = Task::find($id);
        if (is_null($task)) {
            return response([
                'message'=>'incorrect id'
            ]);
        };
        $data = $task->comments()->createMany($collection);
        if ($data) {
            return response([
                'status' => true,
                'message' => 'Comment successfully created'
            ],201);                                        //Created
        } else {
            return response([
                'status' => false,
                'message' => 'comment not created'
            ], 204);                                       //No Content
        }
    }

    /**
     * input task $id, $comment_id
     * update comment
     */
    public function updateComment (Request $request, $id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return response([
                'status'=> false,
                'message'=> 'incorrect task id'
            ], 204);
        };

        $comment = $task->comments()->find($request->comment_id);
        if (is_null($comment) || $comment->comment === $request->comment_edit) {
            return response([
                'status'=> true,
                 'message' => 'not change comment'
            ], 200);
        }

        $update_comment = $comment->update(['comment'=>$request->comment_edit]);
        if ($update_comment) {
            return response([
                'response'=>true,
                'message'=>'comment successfully changed'
            ], 200);
        } else {
            return response([
                'status'=>false,
                'message'=>'comment not updated'
            ], 204);
        }
    }

    /**
     * delete comment
     */
    public function deleteComment (Request $request, $id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return redirect([
                'status'=> false,
                'message'=> 'incorrect task id'
            ], 204);                                       //No Content
        };
        $comment_id = $request->comment_id;

        $comment = $task->comments()->find($comment_id);
        if (is_null($comment)) {
            return response([                                      //??
                'status'=> false,
                'message'=> 'incorrect comment id'
            ], 204);                                       //No Content
        };
        $comment_del = $comment->delete();
        if ($comment_del) {
            return response([
                'response'=>true,
                'message'=>'comment deleted'
            ], 200);                                       //No Content
        } else {
            return response([
                'status'=>false,
                'message'=>'comment not deleted'
            ], 204);
        }
    }
}