<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private static $selectedTasks = [];
    public function dashbord(){
        // $tasks=Task::all();
        $tasks=Task::paginate(5);
        $taskCompleated=Task::where('status', 'completed')->get();
        $taskPending=Task::where('status', 'pending')->get();
        $users=User::all();
        $usersWithTasks = User::with('tasks')->get();
        return view('dashbord',compact('tasks','taskCompleated','taskPending','users','usersWithTasks'));
    }
    public function userpage(){
        return view('userpage');
    }

    public function AddTask(Request $request){
        $request->validate([
            'task' =>'required | string',  
        ]);

        $add=Task::create([
            'user_id' => $request->user()->id,
            'task' => $request->task,
        ]);
        if(!$add){
            return redirect()->route('userpage')->with('error', 'Failed to add task');
        }
        $tasks=User::with('tasks')->find($request->user()->id);
        session(['tasks'=>$tasks]);
        return redirect()->route('userpage')->with('success', 'Task added successfully');
    }
    public function IsUpdate(Request $request){
        $is_update=null;
        if($request->has('id')){
            $is_update=Task::find($request->id);
        };
        return view('userpage',compact('is_update'));
        // return redirect()->route('userpage',['id'=>'update is here']);
    }
    public function update(Request $request,$id){
        $request->validate([
            'task' =>'required | string',  
        ]);

        $Update=Task::where('id',$request->id)->update([
            'task' => $request->task,
        ]);
        if(!$Update){
            return redirect()->route('userpage')->with('error', 'Failed to Update task');
        }
        $tasks=User::with('tasks')->find($request->user()->id);
        session(['tasks'=>$tasks]);
        return redirect()->route('userpage')->with('success', 'Task update successfully');
    }
    public function Delet(Request $request,$id){

        $Delet=Task::find($id)->delete();
        if(!$Delet){
            return redirect()->route('userpage')->with('error', 'Failed to Delet task');
        }

        $tasks=User::with('tasks')->find($request->user()->id);
        session(['tasks'=>$tasks]);
        return redirect()->route('userpage')->with('success', 'Task deleted successfully');
    }

    public function Progresse(Request $request, $id)
    {
        if($request->progresse == 'done'){
            $update = Task::where('id', $id)->update([
                'status' => 'completed',
            ]);

            if(!$update){
                return redirect()->route('userpage')->with('error', 'Failed to update status');
            }
        }

        // جلب جميع المهام المكتملة
        $completedTasks = Task::where('status', 'completed')->pluck('id')->toArray();

        // تخزين IDs في الجلسة
        session(['completedTasks' => $completedTasks]);

        return redirect()->route('userpage');
    }

    // ___________________ Admine_________________

    public function AdmineAllTask($typeData = 'All')
    {
        $tasks = Task::all();
        // $Totaltask = Task::all();
        $taskCompleated = Task::where('status', 'completed')->get();
        $taskPending = Task::where('status', 'pending')->get();
        $users = User::all();

        // if ($typeData == 'completed') {
        //     $tasks = $taskCompleated;
        // } elseif ($typeData == 'pending') {
        //     $tasks = $taskPending;
        // }
        if ($typeData == 'completed') {
            $tasks = Task::where('status', 'completed')->with('user')->get();
        } elseif ($typeData == 'pending') {
            $tasks = Task::where('status', 'pending')->with('user')->get();
        }

        $usersWithTasks = User::with('tasks')->get();

        return view('dashbord', [
            'tasks' => $tasks,
            'taskCompleated' => $taskCompleated,
            'taskPending' => $taskPending,
            'users' => $users,
            'usersWithTasks' => $usersWithTasks,
            // 'Totaltask' => $Totaltask,
        ]);
    }


}


