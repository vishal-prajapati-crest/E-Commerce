<!-- resources/views/livewire/product-form.blade.php -->
<div class="mx-10 px-10 py-4 bg-white dark:bg-gray-900 rounded-lg border shadow">
    <form wire:submit.prevent="save" class="space-y-4 md:space-y-6">
        @error('error')
            <div class="mt-1 px-2 text-sm text-red-500">{{ $message }}</div>
        @enderror
        @if(session('success'))
            <livewire:flash-message />
        @endif
        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input wire:model.blur="title" type="text" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Title" required>
            @error('title')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
            <input wire:model.blur="price" type="text" id="price" name="price"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Price" required>
            @error('price')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea wire:model.blur="description" id="description" name="description"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Description" required></textarea>
            @error('description')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <input wire:model.blur="category" type="text" id="category" name="category"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Category" required>
            @error('category')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image URL</label>
            <input wire:model.blur="image" type="url" id="image" name="image"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Image URL" required>
            @error('image')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="min-h-6">
            <div class="" wire:loading wire:target="save">
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
        <div>
            <button type="submit"
                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
        </div>
    </form>

</div>
