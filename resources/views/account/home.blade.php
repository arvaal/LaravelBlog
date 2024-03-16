@extends('common.html')
@section('title', __('Панель управления аккаунтом'))
@section('content')
    <div id="content">
        <h1 class="h4">{{ count($posts) . ' ' . trans_choice('последний пост|последних поста|последних постов', count($posts)) }}</h1>
        <table class="table">
            <thead>
            <tr>
                <th class="image" scope="col">{{ __('Изображение') }}</th>
                <th class="name" scope="col">{{ __('Название') }}</th>
                <th class="action" scope="col">{{ __('Действие') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($posts))
                @foreach($posts as $post)
                    <tr>
                        <td class="image"><img src="{{ $post['thumb'] }}" class="img-thumbnail" alt="{{ $post['name'] }}"></td>
                        <td class="name">{{ $post['name'] }}</td>
                        <td class="action">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                @foreach($post['actions'] as $action)
                                    <a class="btn {{ $action['btn'] }}" href="{{ $action['link'] }}">{{ $action['text'] }}</a>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">{{ __('Постов пока нет') }}</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
