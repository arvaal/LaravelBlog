@if($asides)
    <aside id="aside-left">
        <ul class="list-group">
            @foreach($asides as $aside)
                <li class="list-group-item"><a href="{{ $aside['link'] }}">{{ $aside['text'] }}</a></li>
            @endforeach
        </ul>
    </aside>
@endif
