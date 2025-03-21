@extends('Layout')
@section('title', 'Task Pages')

@section('content')

<body class="bg-gray-100 min-h-screen font-sans">
    <div class="container mx-auto px-4 py-8 max-w-md">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Todo List</h1>
        @if (isset($is_update))
             
        @endif
        <!-- Add Task Form -->
        @if (session('success'))
        <div class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                {{ session('success') }}
            </div>
        </div>
        @elseif (session('error'))
        <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                {{ session('error') }}
            </div>
        </div>
        @endif
        

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Add New Task</h2>
            <form id="todo-form" class="space-y-4" action="{{isset($is_update)? route('update',['id'=>$is_update->id]) :route('AddTask')}}" method="POST">
                @csrf
                <div>
                    <input 
                        type="text" 
                        id="task-input" 
                        placeholder="Enter your task..." 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                        name="task"
                    >
                </div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out"
                >
                    @if (isset($is_update))
                    Update Task
                    @else
                    Add Task
                    @endif
                    
                </button>
            </form>
        </div>
        
        <!-- Task List -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Your Tasks</h2>
            <div id="task-list" class="space-y-3">
                <!-- Tasks will be added here dynamically -->
                
                    @if (session('tasks'))
                    @forelse (session('tasks')->tasks as $task)
                    <li class="flex items-center justify-between bg-gray-100 p-3 rounded-lg shadow-sm">
                        <span class="text-gray-700">{{$task->task}}</span>
                        <div class="flex space-x-2">
                            {{-- <form method="POST" action="">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="p-2 bg-amber-700 text-amber-50 rounded-full hover:bg-amber-800 transition duration-300">
                                    <x-microns-edit class="w-5 h-5"/>
                                </button>                           
                            </form> --}}
                            <a href="{{route('IsUpdate',['id'=>$task->id])}}">Update</a>
                            <form  action="{{route('Delet',$task->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-700 text-red-50 rounded-full hover:bg-red-800 transition duration-300"
                                onclick="return confirm('Are you sure you want to delete this task?')"
                                >
                                    <x-microns-delete class="w-5 h-5"/>
                                </button>                           
                            </form>
                        </div>
                    </li>
                    @empty
                    <p class="text-gray-500 text-center py-4">  
                    No tasks yet. Add a task to get started!
                    </p>
                    @endforelse
                    @endif
                
            </div>
        </div>
    </div>
@endsection

