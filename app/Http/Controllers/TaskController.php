<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function dashbord(){
        return view('dashbord');
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
    }


