@foreach($bars as $bar)
    <li class="nav-item">
        <a class="nav-link {{ Route::is($bar['route']) ? 'active' : '' }}" aria-current="page" href="{{ route($bar['route']) }}">{{ $bar['name'] }}</a>
    </li>
@endforeach
