<div>
    @if(session('token') && session('admin'))
        <div class="flex h-full border gap-0">
            <!-- <section class=" min-h-screen md:min-w-56 bg-primary-500 p-4">left</section> -->
            <section class=" min-h-screen md:min-w-56 bg-white py-4 rounded-r-md ">
                <livewire:admin-dashboard.sidebar />
            </section>

            <section class="bg-primary-100 bg-opacity-40 w-full py-6 px-4">
                <livewire:admin-dashboard.add-new-product />
            </section>
        </div>
    @endif
</div>
