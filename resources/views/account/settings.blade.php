@extends('common.html')
@section('title', __('Настройки'))
@section('content')
    <div id="content">
        {{ session('success') }}
        <div class="card-header">{{ __('Добавление/Редактирования поста') }}</div>
        <div class="card-body">
            <form action="{{ $action }}" class="form" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="avatar" class="form-label"><img src="{{ $avatar }}" id="avatar-preview" class="img-thumbnail" alt="{{ __('Аватарка') }}"></label>
                    <input type="file" name="avatar" class="form-control" id="avatar" value="" />
                    <a id="clear-avatar" class="btn btn-primary mt-3">{{ __('Удалить') }}</a>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">{{ _('Имя') }}</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $name ?? '' }}" />
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
            </form>
        </div>
            <script>
                let imagePreview = document.getElementById('avatar-preview');

                document.getElementById('avatar').addEventListener('change', function (event) {
                    imagePreview.src = URL.createObjectURL(event.target.files[0]);
                    console.log(imagePreview)
                });
                document.getElementById('clear-avatar').addEventListener('click', function (event) {
                    document.getElementById('avatar').value = null;
                    imagePreview.src = '{{ $no_image }}';
                    console.log(imagePreview)
                });
            </script>
    </div>
@endsection
