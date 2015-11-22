@if(count($menu) === 1)
    <li class="{{ Request::is($pattern) ? 'active' : null }}">
        <a href="{{ route($name) }}">{{ label('route.' . snake_case($menu[0])) }}</a>
    </li>
@elseif(count($menu) > 1)
    <li class="dropdown {{ Request::is($pattern) ? 'active' : null }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ label('menu.' . snake_case($name)) }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            @foreach($menu as $entry)
                <li><a href="{{ route($entry) }}">{{ label('route.' . snake_case($entry)) }}</a></li>
            @endforeach
        </ul>
    </li>
@endif
