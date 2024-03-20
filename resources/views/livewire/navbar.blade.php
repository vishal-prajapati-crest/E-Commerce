<div>
    <nav class="bg-blue-500 min-h-16 flex justify-between items-center text-white hover:cursor-pointer">
        <a class="ml-20 text-2xl " href="/admin" wire:navigate>E-Commerce Admin</a>
        <div class="flex gap-2 mr-20">
            @if(session('token') && session('admin'))
                <div>{{ session('user')['name'] }}</div>
                <div wire:click='AdminLogout'>Logout</div>

            @else
                <a class="mr-20" href="{{ route('admin.Register') }}" wire:navigate>Register</a>
            @endif

        </div>

    </nav>
</div>
