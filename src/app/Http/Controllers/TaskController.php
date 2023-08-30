<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * タスク全権取得
     */
    public function index()
    {
        //DB::enableQueryLog();
        //Task::all();
        //dd(DB::getQueryLog());
        return Task::all()->sortBy('id');
    }

    /**
     * タスク一件取得
     * @param $id
     */
    public function show($id)
    {
        //DB::enableQueryLog();
        $task = Task::find($id);
        //dd(DB::getQueryLog());
        if ($task) {
            return $task;
        } else {
            return response()->json([
                "message" => "Task not found",
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * タスク作成
     * @param Request $request
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //DB::enableQueryLog();
        Task::create($request->all());
        //dd(DB::getQueryLog());
        return response()->json([
            "message" => "created successfully",
        ], Response::HTTP_CREATED);
    }

    /**
     * タスク編集
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if ($task) {
            //DB::enableQueryLog();
            $task->title = is_null($request->title) ? $task->title : $request->title;
            $task->content = is_null($request->content) ? $task->content : $request->content;
            $task->person_in_charge = is_null($request->person_in_charge) ? $task->person_in_charge : $request->person_in_charge;
            $task->save();
            //dd(DB::getQueryLog());
            return response()->json([
                "message" => "updated successfully",
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Task not found",
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * タスク削除
     * @param $id
     */
    public function destroy($id)
    {
        //DB::enableQueryLog();
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            //dd(DB::getQueryLog());
            return response()->json([
                "message" => "deleted successfully",
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Task not found",
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
