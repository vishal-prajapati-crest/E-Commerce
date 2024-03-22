<div class="flex flex-col">
    <div wire:loading.delay.longest
        class="fixed top-0 left-0 w-full ml-56 mt-16 h-full flex items-center justify-center bg-primary-100 bg-opacity-60">
        <div class="spinner">
            <div class="min-h-6">
                <div class="">
                    <div class="container">
                        <div class="loadingspinner loadingspinner-large">
                            <div id="square1"></div>
                            <div id="square2"></div>
                            <div id="square3"></div>
                            <div id="square4"></div>
                            <div id="square5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex">
        <div
            class="{{ $selectedItem === 'addNewProduct'? 'bg-primary-500 rounded-r-md min-w-1' : 'bg-transparent rounded-r-md min-w-1' }}">
        </div>
        <a wire:click.prevent="addProduct" href="{{ route('admin.add-product') }}" wire:navigate.hover
            class="{{ $selectedItem === 'addNewProduct' ? 'px-4 py-4 text-primary-500 items-center rounded flex justify-center gap-4 hover:cursor-pointer' : 'px-4 py-4 text-slate-700 items-center rounded flex justify-center gap-4 hover:text-primary-500 cursor-pointer' }}">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

            </div>
            <div>Add New Product</div>
        </a>
    </div>
    <div class="flex">
        <div
            class="{{ $selectedItem === 'allProduct'? 'bg-primary-500 rounded-r-md min-w-1' : 'bg-transparent rounded-r-md min-w-1' }}">
        </div>
        <a wire:click.prevent="allProduct" href="{{ route('admin.all-product') }}" wire:navigate.hover
            class="{{ $selectedItem === 'allProduct' ? 'px-4 py-4 text-primary-500 items-center rounded flex justify-center gap-4 hover:cursor-pointer' : 'px-4 py-4 text-slate-700 items-center rounded flex justify-center gap-4 hover:text-primary-500 cursor-pointer' }}">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>


            </div>
            <div>Products</div>
        </a>
    </div>
    <div class="flex">
        <div
            class="{{ $selectedItem === 'admin.orders' ? 'bg-primary-500 rounded-r-md min-w-1' : 'bg-transparent rounded-r-md min-w-1' }}">
        </div>
        <a href="{{ route('admin.orders') }}" wire:navigate.hover
            class="{{ $selectedItem === 'admin.orders' ? 'px-4 py-4 text-primary-500 items-center rounded flex justify-center gap-4 hover:cursor-pointer' : 'px-4 py-4 text-slate-700 items-center rounded flex justify-center gap-4 hover:text-primary-500 cursor-pointer' }}">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                </svg>



            </div>
            <div>Orders</div>
        </a>
    </div>
</div>
