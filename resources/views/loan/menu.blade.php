<li class="{{ (request()->is('home')) ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>

@if(auth()->user()->hasRole('loan-provider'))




@endif

@if(auth()->user()->hasRole('community-leader'))



@endif
