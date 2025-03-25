@extends('Layout')
@section('title', 'Dashboard')

@section('content')
    <h1>Admin pannel</h1>
    {{-- @if (session('user'))
    <p>Welcome, {{ session('user')->name}}!</p>
    <a href="{{ route('logout') }}">Logout</a>
@else
    <h1>no users here </h1>
@endif --}}
    @if (auth()->check())
        <p>Welcome, {{ auth()->user()->name }}!</p>
        {{-- <a href="{{ route('logout') }}">Logout</a> --}}
    @else
        <h1>no users here </h1>
    @endif
    {{-- @if (isset($tasks))
        <p>Welcome, {{ $task->user->name }}!</p>
    @else
        <h1>BETA HHHHHHHH</h1>
    @endif --}}



    <body class="bg-gray-100 min-h-screen font-sans">
        <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="bg-gray-800 text-white w-64 flex-shrink-0 hidden md:block">
                <div class="p-4">
                    <h2 class="text-2xl font-bold">Admin Panel</h2>
                    <p class="text-gray-400 text-sm">Task Management System</p>
                </div>
                <nav class="mt-6">
                    <div class="px-4 py-3 bg-gray-900">
                        <a href="#" class="flex items-center text-white">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                    <div class="px-4 py-3">
                        <a href="#" class="flex items-center text-gray-300 hover:text-white">
                            <i class="fas fa-users mr-3"></i>
                            <span>Users</span>
                        </a>
                    </div>
                    <div class="px-4 py-3">
                        <a href="#" class="flex items-center text-gray-300 hover:text-white">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                    <div class="px-4 py-3">
                        <a href="index.html" class="flex items-center text-gray-300 hover:text-white">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Back to App</span>
                        </a>
                    </div>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Header -->
                <header class="bg-white shadow-sm z-10">
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center md:hidden">
                            <button id="menu-button" class="text-gray-500 focus:outline-none">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <div class="relative">
                                <input type="text" placeholder="Search..."
                                    class="border rounded-md py-2 px-3 pl-8 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search text-gray-400 absolute left-3 top-3"></i>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="relative">
                                <button class="flex items-center text-gray-700 focus:outline-none">
                                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Admin"
                                        class="h-8 w-8 rounded-full mr-2">
                                    <span class="hidden md:inline-block">{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Dashboard Content -->
                <main class="flex-1 overflow-y-auto bg-gray-100 p-4">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Task Management Dashboard</h1>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Total Tasks</p>
                                    <p class="text-2xl font-bold" id="total-tasks">{{ count($tasks) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Completed Tasks</p>
                                    <p class="text-2xl font-bold" id="completed-tasks">{{ count($taskCompleated) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                                    <i class="fas fa-spinner"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Pending Tasks</p>
                                    <p class="text-2xl font-bold" id="pending-tasks">{{ count($taskPending) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Total Users</p>
                                    <p class="text-2xl font-bold" id="total-users">{{ count($users) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Task Management Section -->
                    <div class="bg-white rounded-lg shadow-sm mb-6">
                        <div class="p-4 border-b flex justify-between items-center">
                            <h2 class="text-lg font-semibold">All Tasks</h2>
                            <div>
                                <button id="refresh-btn"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                                    <i class="fas fa-sync-alt mr-1"></i> Refresh
                                </button>
                                <button id="add-demo-data"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm ml-2">
                                    <i class="fas fa-plus mr-1"></i> Add Demo Data
                                </button>
                            </div>
                        </div>

                        <!-- Task Filters -->
                        <div class="p-4 bg-gray-50 border-b">
                            <div class="flex flex-wrap items-center gap-4">
                                <div class="flex items-center">
                                    <label for="status-filter" class="mr-2 text-sm text-gray-600">Status:</label>
                                    <select id="status-filter"
                                        class="border rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        onchange="window.location.href=this.value">
                                        <option value="{{ route('AdmineAllTask', 'All') }}">All</option>
                                        <option value="{{ route('AdmineAllTask', 'completed') }}">Completed</option>
                                        <option value="{{ route('AdmineAllTask', 'pending') }}">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Task Table -->
                        <div class="overflow-x-auto">
                            {{-- <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="task-table-body" class="bg-white divide-y divide-gray-200">
                                <!-- Tasks will be added here dynamically -->
                                @if (isset($tasks))
                                @forelse ($tasks as $task)
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                {{$task->task}}
                                    </td>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                {{$task->task}}
                                    </td>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                {{$task->task}}
                                    </td>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                {{$task->task}}
                                    </td>
                                        @empty                                   
                                            No tasks found. Add some demo data to get started.
                                </tr>
                                @endforelse
                                @endif
                            </tbody>
                        </table> --}}
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Task</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            User</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created</th>
                                    </tr>
                                </thead>
                                <tbody id="task-table-body" class="bg-white divide-y divide-gray-200">
                                    @if (isset($tasks) && count($tasks) > 0)
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $task->task }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $task->user->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $task->status }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $task->created_at }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            No tasks found. Add some demo data to get started.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $tasks->links('vendor.pagination.tailwind') }}
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div id="mobile-menu" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
            <div class="bg-gray-800 text-white w-64 h-full">
                <div class="p-4 flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Admin Panel</h2>
                    <button id="close-menu" class="text-white focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="mt-6">
                    <div class="px-4 py-3 bg-gray-900">
                        <a href="#" class="flex items-center text-white">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                    <div class="px-4 py-3">
                        <a href="#" class="flex items-center text-gray-300 hover:text-white">
                            <i class="fas fa-users mr-3"></i>
                            <span>Users</span>
                        </a>
                    </div>
                    <div class="px-4 py-3">
                        <a href="#" class="flex items-center text-gray-300 hover:text-white">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                    <div class="px-4 py-3">
                        <a href="index.html" class="flex items-center text-gray-300 hover:text-white">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Back to App</span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </body>
@endsection
