<div>
    @if(session('token') && session('admin'))
        {{ $this->redirect(route('admin.dashboard'), navigate:true) }}
    @else
        <div class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Admin Login
                        </h1>
                        @error('error')
                            <div class="mt-4 text-sm text-red-500">{{ $message }}</div>
                        @enderror

                        <form class="space-y-4 md:space-y-6" wire:submit="login">
                            @csrf

                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Admin
                                    E-mail</label>
                                <input wire:model.blur="email" type="email" name="email" id="email"
                                    value='{{ old("email") }}'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="name@company.com" required="">
                                @error('email')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-0 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input wire:model.blur="password" type="password" name="password" id="password"
                                    placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required="">
                                @error('password')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="min-h-6">
                                <div class="" wire:loading wire:target="login">
                                    <div class="container">
                                        <div class="loadingspinner">
                                            <div id="square1"></div>
                                            <div id="square2"></div>
                                            <div id="square3"></div>
                                            <div id="square4"></div>
                                            <div id="square5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
