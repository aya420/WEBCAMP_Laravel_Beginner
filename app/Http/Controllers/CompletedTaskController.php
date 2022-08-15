<?php
declare(strict_types=1);
/* 型を厳格にするための設定 */
namespace App\Http\Controllers;
/* 名前空間の指定 */

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedTask as CompletedTaskModel;

class CompletedTaskController extends Controller
{
    /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        // 完了タスクの一覧
        $list = CompletedTaskModel::where('user_id', Auth::id())
                                   ->orderBy('priority', 'DESC')
                                   ->orderBy('period')
                                   ->orderBy('updated_at')
                                   ->get();
        return view('task.completed_list', ['list' => $list]);
    }
}