<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 p-4">
        <div class="w-full max-w-md">
            <!-- Login Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 hover:shadow-xl">
                <!-- Header dengan gradien -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-center">
                    <h1 class="text-2xl font-bold text-white">Welcome Back</h1>
                    <p class="text-indigo-100 mt-2">Sign in to your account</p>
                </div>

                <!-- Form Area -->
                <div class="p-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300" />
                            </div>
                            <x-text-input 
                                id="email" 
                                class="block w-full pl-10 py-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg transition duration-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autofocus 
                                autocomplete="username"
                                placeholder="you@example.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                            </div>
                            <x-text-input 
                                id="password" 
                                class="block w-full pl-10 py-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg transition duration-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                type="password"
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input id="remember_me" type="checkbox" class="sr-only" name="remember">
                                    <div class="w-10 h-6 bg-gray-300 dark:bg-gray-700 rounded-full shadow-inner transition duration-300 ease-in-out"></div>
                                    <div class="dot absolute w-4 h-4 bg-white rounded-full shadow left-1 top-1 transition duration-300 ease-in-out"></div>
                                </div>
                                <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition duration-200" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <div class="pt-4">
                            <x-primary-button class="w-full flex justify-center items-center py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Additional Info -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Don't have an account?
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition duration-200 ml-1">
                                    Sign up
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} Your Company. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <style>
        /* Custom checkbox toggle */
        #remember_me:checked ~ .dot {
            transform: translateX(100%);
            background-color: #4f46e5;
        }
        #remember_me:checked ~ div {
            background-color: #4f46e5;
        }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        
        /* Input focus effects */
        input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
    </style>
</x-guest-layout>