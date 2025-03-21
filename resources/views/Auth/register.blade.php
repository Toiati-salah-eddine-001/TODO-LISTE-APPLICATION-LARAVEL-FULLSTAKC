@extends('Layout')
@section('title', 'Signe up')
@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="max-w-[800px] mx-auto">
            <div class="relative flex flex-col text-gray-700 bg-white shadow-lg w-[420px] rounded-2xl bg-clip-border p-6">
                <div
                    class="relative grid mx-4 mb-6 -mt-8 overflow-hidden text-white shadow-lg h-32 place-items-center rounded-xl bg-gradient-to-tr from-gray-900 to-gray-700 bg-clip-border shadow-gray-900/20">
                    <h3 class="block font-sans text-4xl antialiased font-semibold leading-snug tracking-normal text-white">
                        Sign Up
                    </h3>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-6 p-4">
                        <div class="relative h-14 w-full">
                            <input
                                class="w-full h-full px-4 py-4 font-sans text-sm font-normal transition-all bg-transparent border rounded-lg peer border-gray-300 border-t-transparent text-gray-700 outline outline-0 placeholder-shown:border placeholder-shown:border-gray-300 placeholder-shown:border-t-gray-300 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-gray-100"
                                placeholder=" " name="name" />
                            <label
                                class="absolute left-3 -top-2 text-sm font-medium text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:-top-2 peer-focus:text-gray-900">Full
                                Name</label>
                        </div>
                        {{-- ------------------- Errore name ---------------- --}}
                        @error('name')
                            <div class="flex bg-blue-100 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                        {{-- ------------------------------------------------------ --}}
                        <div class="relative h-14 w-full">
                            <input
                                class="w-full h-full px-4 py-4 font-sans text-sm font-normal transition-all bg-transparent border rounded-lg peer border-gray-300 border-t-transparent text-gray-700 outline outline-0 placeholder-shown:border placeholder-shown:border-gray-300 placeholder-shown:border-t-gray-300 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-gray-100"
                                placeholder=" " name="email" />
                            <label
                                class="absolute left-3 -top-2 text-sm font-medium text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:-top-2 peer-focus:text-gray-900">Email</label>
                        </div>
                        {{-- ------------------- Errore email ---------------- --}}
                        @error('email')
                            <div class="flex bg-blue-100 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                        {{-- ------------------------------------------------------ --}}
                        <div class="relative h-14 w-full">
                            <input
                                class="w-full h-full px-4 py-4 font-sans text-sm font-normal transition-all bg-transparent border rounded-lg peer border-gray-300 border-t-transparent text-gray-700 outline outline-0 placeholder-shown:border placeholder-shown:border-gray-300 placeholder-shown:border-t-gray-300 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-gray-100"
                                placeholder=" " name="password" />
                            <label
                                class="absolute left-3 -top-2 text-sm font-medium text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:-top-2 peer-focus:text-gray-900">Password</label>
                        </div>
                        {{-- ------------------- Errore Password ---------------- --}}
                        @error('Password')
                            <div class="flex bg-blue-100 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                        {{-- ------------------------------------------------------ --}}
                        {{-- --------- alert password incorect ----------- --}}
                        @if (session('error'))
                            <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <span class="font-medium">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- -------------------------------------- --}}
                        <div class="relative h-14 w-full">
                            <input
                                class="w-full h-full px-4 py-4 font-sans text-sm font-normal transition-all bg-transparent border rounded-lg peer border-gray-300 border-t-transparent text-gray-700 outline outline-0 placeholder-shown:border placeholder-shown:border-gray-300 placeholder-shown:border-t-gray-300 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-gray-100"
                                placeholder=" " 
                                name="confirm_password" 
                                {{ old('confirm_password') }} />
                            <label
                                class="absolute left-3 -top-2 text-sm font-medium text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:-top-2 peer-focus:text-gray-900">Confirm
                                Password</label>
                        </div>
                        {{-- ------------------- Errore email ---------------- --}}
                        @error('confirm_password')
                            <div class="flex bg-blue-100 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                        {{-- ------------------------------------------------------ --}}
                    </div>
                    <div class="p-6 pt-0">
                        <button
                            class="block w-full select-none rounded-lg bg-gradient-to-tr from-gray-900 to-gray-700 py-4 px-6 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="submit">
                            Sign Up
                        </button>
                    </div>
                </form>
                <p class="flex justify-center mt-6 font-sans text-sm antialiased font-light leading-normal text-inherit">
                    Already have an account?
                    <a href="/"
                        class="block ml-1 font-sans text-sm antialiased font-bold leading-normal text-gray-900">
                        login
                    </a>
                </p>
            </div>
        </div>
    </div>

@endsection
