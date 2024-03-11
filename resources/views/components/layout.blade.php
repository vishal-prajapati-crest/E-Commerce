<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>

    @vite('resources/css/app.css')
        @vite('resources/js/app.js')
</head>

<body class="font-poppins">
    <nav class="bg-blue-500 min-h-16 flex justify-between items-center text-white hover:cursor-pointer">
        <a class="ml-20 text-2xl " href="/">E-Commerce</a>
        <div class="min-w-96 ">

            <form method="get" action="{{ route('products.index') }}" class="max-w-lg mx-auto ">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" name="search"
                        value="{{ request('search') }}"
                        class="h-8 block w-full p-4 pr-20 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-1 focus:outline-slate-400 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0"
                        placeholder="Search Sony, Samsung..." />
                    <button type="submit"
                        class="absolute inset-y-1 end-2 text-white bg-blue-500 hover:bg-blue-600 focus:ring-1 focus:outline-slate-400 font-medium rounded-lg text-sm px-4 py-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

        </div>
        <div class="flex gap-5 items-center mr-20">
            <div class="relative">
                @if(
                    session()->has('cart') && count(session('cart')) > 0
                    )
                    @php
                        $totalQty =0
                    @endphp
                    @foreach(session('cart') as $productId => $product)
                        @php
                            $totalQty += $product['quantity'];
                        @endphp
                    @endforeach

                    <span
                        class="absolute -top-1 -left-2 w-4 h-4 text-xs bg-red-600 text-center rounded-full">{{ $totalQty }}</span>
                @endif
                <a href="{{ route('cart.show') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </a>
            </div>
            <div class="flex gap-2">
                @if(session('token'))
                    <div>{{ session('user')['name'] }}</div>
                    <div><a href="{{ route('myOrder') }}">My-orders</a></div>
                    <a href="{{ route('auth.logout') }}">Logout</a>

                @else
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                @endif

            </div>
        </div>
    </nav>
    @if(session('success'))
        <div id="alert-box-success" role="alert" class="fixed bottom-0 left-0 my-8 w-full md:w-1/3 mx-auto z-50">
            <div class="relative">
                <div class="bg-green-500 text-white px-4 py-2 flex items-center justify-between">
                    <p class="font-bold">Success!</p>
                    <button type="button" onclick="hideAlert('alert-box-success');"
                        class="text-slate-600 font-medium text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-green-200 p-4">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="bg-green-500 h-1"></div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('alert-box-success').style.display = 'none';
            }, 5000);

        </script>
    @endif

    @if(session('error'))
        <div id="alert-box-error" role="alert" class="fixed bottom-0 left-0 my-8 w-full md:w-1/3 mx-auto z-50">
            <div class="relative">
                <div class="bg-red-500 text-white px-4 py-2 flex items-center justify-between">
                    <p class="font-bold">Error!</p>
                    <button type="button" onclick="hideAlert('alert-box-error');"
                        class="text-slate-600 font-medium text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-red-200 p-4">
                    <p>{{ session('error') }}</p>
                </div>
                <div class="bg-red-500 h-1"></div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('alert-box-error').style.display = 'none';
            }, 5000);

        </script>
    @endif

    <script>
        function hideAlert(alertId) {
            document.getElementById(alertId).style.display = 'none';
        }

    </script>


    <section class="bg-white mx-10 px-10">
        {{ $slot }}
    </section>



    <footer class="bg-white  shadow dark:bg-gray-900 ">
        <div class="w-full max-w-screen-xl mx-auto p-4 pl-0 pr-0 ">
            <div class="sm:flex sm:items-center sm:justify-between mx-10">
                <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Commerce</span>
                </a>
                <ul
                    class="flex flex-wrap items-center mr-20 mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 mr-20 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ now()->year }} <a href="/"
                    class="hover:underline">E-Commerce</a>. All Rights Reserved.</span>
        </div>
    </footer>


    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/holder.min.js"></script>
    @yield('footer-scripts')
</body>

</html>
