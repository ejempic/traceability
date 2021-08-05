<li class="{{ (request()->is('home')) ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><i class="fa fa-tachometer"></i> <span class="nav-label">Home</span></a>
</li>

@if(auth()->user()->can('read-spot-market'))
    <li class="{{ (request()->is('spot-market*')) ? 'active' : '' }}">
        <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Spot Market</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="{{ (request()->is('spot-market')) ? 'active' : '' }}"><a href="{!! route('spot-market.index') !!}">My List</a></li>

            @if(auth()->user()->can('add-spot-market'))
            <li class="{{ (request()->is('spot-market/create')) ? 'active' : '' }}"><a href="{!! route('spot-market.create') !!}">Create</a></li>
            @endif
        </ul>
    </li>
@endif
