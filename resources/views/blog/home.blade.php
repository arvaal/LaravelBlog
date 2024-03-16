@extends('common.html')
@section('title', __('Главная'))
@section('content')
    <div id="content"  class="container">
        <h2 class="h4">{{  __('Последние посты') }}</h2>
        <div class="row">
            @foreach($posts as $post)
                <a  class="col" href="{{ $post['link'] }}">
                    <figure class="figure">
                        <img src="{{ $post['thumb'] }}" class="figure-img img-fluid rounded" alt="{{ $post['title'] }}">
                        <figcaption class="figure-caption">{{ __($post['title']) }}</figcaption>
                    </figure>
                </a>
            @endforeach
        </div>

        <h2 class="h4">{{  __('Популярные посты') }}</h2>
        <div class="row"></div>
    </div>
@endsection
