@extends('common.html')
@section('title', $title)
@section('meta_description', $meta_description)
@section('content')
    <div id="content" class="content container py-4 px-3 mx-auto">
        <h1 class="h2">{{ __($title) }}</h1>
        <figure class="figure">
            <img src="{{ $image }}" class="figure-img img-fluid rounded" alt="{{ $title }}">
            <figcaption class="figure-caption">{{ $name }}</figcaption>
        </figure>
        <p>{{ __($description) }}</p>

        <h2 class="h3">{{ __('Коментарии') }}</h2>
        <div class="comments">
            @foreach($comments as $comment)
                <span>{{ $comment['user'] }}</span>
                <span>{{ $comment['created_at'] }}</span>
                <p>{{ $comment['comment'] }}</p>
            @endforeach
        </div>
        <div class="write-comment">
            @if ($user)
                @if ($success)
                    <div class="alert alert-warning">{{ $success }}</div>
                @endif
                <form action="{{ $action }}" id="write-comment" method="post">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Имя') }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user ?? '' }}" />
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">{{ __('Комментарий') }}</label>
                        <textarea type="text" name="comment" class="form-control" id="comment"></textarea>
                        @error('comment')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('Отправить') }}</button>
                </form>
            @else
                <div class="alert alert-warning" role="alert"><a href="{{ $login }}">Вход</a>\<a href="{{ $register }}">Регистрация</a> для публикации коментариев.</div>
            @endif
        </div>
    </div>
@endsection
