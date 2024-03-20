<div>
    @if(session('token') && session('admin'))
        dashboard
    @else
        {{ $this->redirect(route('admin.login'), navigate:true) }}
    @endif
</div>
