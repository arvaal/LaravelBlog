@extends('common.html')
@section('title', __('Список всех постов'))
@section('content')
    <div id="content">
        {{ session('success') }}
        <form action="{{ $action_delete }}" method="post">
            @method('delete')
            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><input id="ckbCheckAllAccess" type="checkbox" class="form-check-input" /></th>
                    <th scope="col">{{ __('Изображение') }}</th>
                    <th scope="col">{{ __('Название') }}</th>
                    <th scope="col">{{ __('Действие') }}</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($posts))
                @foreach($posts as $post)
                    <tr>
                        <td><input name="id[]" class="form-check-input check-access" type="checkbox" value="{{ $post['id'] }}" /></td>
                        <td><img src="{{ $post['thumb'] }}" class="img-thumbnail" alt="{{ $post['title'] }}"></td>
                        <td>{{ $post['title'] }}</td>
                        <td>
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
                        <td colspan="4">{{ __('Тут сейчас пусто') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ $action_add }}" class="btn btn-primary">{{ __('Добавить') }}</a>
                <button class="btn btn-danger" type="submit">{{ __('Удалить') }}</button>
            </div>
        </form>
        <script>
            document.getElementById('ckbCheckAllAccess').addEventListener('change', function () {

                    for(var item of document.getElementsByClassName('check-access')) {
                        if (this.checked) {
                            item.setAttribute('checked', 'checked');
                        } else {
                            item.removeAttribute('checked');
                        }
                    }

            });
        </script>
    </div>
@endsection
