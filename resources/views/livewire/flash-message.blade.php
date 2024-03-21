<div>
    @if(session('success'))
        <div id="alert-box-success" role="alert"
            class="block fixed top-20 right-6 w-80 p-5 text-lg font-semibold text-green-700 bg-white border-2 border-green-300 rounded shadow-lg opacity-80">
            <div
                class="absolute top-1/2 left-0 w-8 h-full px-1 bg-green-300 text-white text-2xl font-light transform -translate-y-1/2">
                <div class="absolute top-1/2 transform -translate-y-1/2">


                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

            </div>
            <p class="pl-6 text-base">
                {{ session('success') }}
            </p>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('alert-box-success').style.display = 'none';
            }, 5000);

        </script>
    @elseif(session('error'))
        <div id="alert-box-error" role="alert"
            class="block fixed top-20 right-6 w-80 p-5 text-lg font-semibold text-red-700 bg-white border-2 border-red-500 rounded shadow-lg opacity-80">
            <div
                class="absolute top-1/2 left-0 w-8 h-full px-1 bg-red-500 text-white text-2xl font-light transform -translate-y-1/2">
                <div class="absolute top-1/2 transform -translate-y-1/2">


                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                </div>

            </div>
            <p class="pl-6 text-base">
                {{ session('error') }}
            </p>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('alert-box-error').style.display = 'none';
            }, 5000);

        </script>
    @endif
</div>
