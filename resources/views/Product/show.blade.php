<x-layout>
    <!-- component -->
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 pt-24 pb-10 my-auto mx-auto">
            <div class=" mx-auto max-h-50 flex flex-wrap justify-center">
                <img alt="ecommerce"
                    class="lg:w-1/2 w-full min-h-full object-cover object-center mx-auto my-auto rounded border border-gray-200 hover:scale-110 transition duration-500 "
                    src="{{ $data->image }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 bg-blue-500 bg-opacity-10 px-5">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">TITLE</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $data->title }}</h1>
                    <div class="flex  mb-8">
                        <span class="flex items-center">
                            @for($i=0; $i<5; $i++)
                                @if($data->average_rating<=$i)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-5 w-5 text-red-500"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>

                                @else
                                    <svg aria-hidden="true" class="h-5 w-5 text-red-500" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endif
                            @endfor
                            <span class="text-gray-600 ml-3">{{ number_format($data->average_rating,1) }}
                                out of 5
                            </span>
                        </span>
                        <div class="text-gray-500 pt-0.5 ml-8  text-sm">
                            Total {{ $data->rating_count }} global rating
                        </div>

                    </div>
                    <p class="leading-relaxed lg:min-h-64 my-auto">
                        {{ $data->description }}
                    </p>
                    <hr class=" h-0.5 bg-blue-200">
                    <div class="flex mt-12">
                        <span class="title-font font-medium text-2xl text-gray-900">${{ $data->price }}</span>
                        <a href="#"
                            class="flex ml-auto text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded">Buy
                            Now</a>

                        <button
                            class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4 hover:text-red-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-5 h-5" viewBox="0 0 24 24">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="bg-blue-100 bg-opacity-10 mx-5 px-10 pb-20">
        <div class="text-2xl text-center p-5">Reviews</div>
        @forelse($data->reviews as $reviews)
            <div class="container">
                <div class="flex justify-between">
                    <div class="flex justify-center items-center gap-2 text-md p-4 pb-1 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <div>
                            {{ ['Alice', 'Bob', 'Charlie', 'Devang', 'Vishal'][array_rand(['Alice', 'Bob', 'Charlie', 'Devang', 'Vishal'])] }}
                        </div>
                    </div>
                    <div class="p-4">
                        <span class="flex items-center">
                            @for($i=0; $i<5; $i++)
                                @if($reviews->rating<=$i)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-5 w-5 text-red-500"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>

                                @else
                                    <svg aria-hidden="true" class="h-5 w-5 text-red-500" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endif
                            @endfor
                            <span class="text-gray-600 ml-3">{{ number_format($reviews->rating,1) }}
                                out of 5
                            </span>
                        </span>
                    </div>
                </div>
                <p class="text-gray-500 lg:w-4/5 p-4 pt-1 ">
                    {{ $reviews->review }}
                </p>
            </div>
            <hr>
        @empty
            <div class="text-gray-500 text-center ">No Reviews yet</div>
        @endforelse
    </div>

</x-layout>
