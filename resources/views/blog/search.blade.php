@extends('common.html')
@section('title', __('Поиск по блогу'))
@section('content')
    <div id="content">
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
        <div class="pagination">{!! $pagination !!}</div>
    </div>
@endsection
