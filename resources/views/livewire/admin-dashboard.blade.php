<div>
    @if(session('token') && session('admin'))
        <div class="flex h-full border gap-5">
            <section class=" min-h-screen md:min-w-56 bg-primary-500 p-4">left</section>
            <section>right</section>
        </div>
    @endif
</div>
