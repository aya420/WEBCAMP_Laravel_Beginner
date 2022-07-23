<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRegisterPostRequest;
use App\Models\Task as TaskModel;

class TaskController extends Controller
{
    /**
     * トップページ　を表示する
     * 
     * @return \Illuminate\View\View
     */
     public function list()
     {
         return view('task.list');
     }
     /**
      * タスクの新規登録
      */
      public function register(TaskRegisterPostRequest $request)
      {
          // validate済みのデータの取得
          $datum = $request->validated();
          // 現在認証しているユーザーを取得
          // $user = Auth::id();
          // 現在認証しているユーザーのIDを取得
          //                                                                                      $id = Auth::id();
          // var_dump($datum, $user, $id); exit;
          
          // user_id の追加
          $datum['user_id'] = Auth::id();
          
          // テーブルへのINSERT
          try {
           $r = TaskModel::create($datum);
           var_dump($r); exit;
           }catch(\Throwable $e) {
             // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
              echo $e->getMessage();
            exit;
          }
      
          // タスク登録成功
          $request->session()->flash('front.task_register_success', true);
      
          //
          return redirect('/task/list');
      }
}