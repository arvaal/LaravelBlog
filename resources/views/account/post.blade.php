@extends('common.html')
@section('title', __('Добавление/Редактирования поста'))
@section('content')
    <div id="content">
        <div class="card-header">{{ __('Добавление/Редактирования поста') }}</div>
        <div class="card-body">
            <form method="post" action="{{ $action }}" enctype="multipart/form-data" class="form">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Название поста') }}</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" value="{{ $name ?? '' }}" />
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Заголовок поста') }}</label>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" value="{{ $title ?? '' }}" />
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div id="titleHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="meta_description" class="form-label">{{ __('Мета описание') }}</label>
                    <textarea name="meta_description" class="form-control" id="meta_description" cols="5">{{ $meta_description ?? '' }}</textarea>
                    @error('meta_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Текст поста') }}</label>
                    <textarea type="text" name="description" class="form-control" id="description" cols="15">{{ $description ?? '' }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">{{ __('Теги поста') }}</label>
                    <input type="text" name="tags" class="form-control" id="tags" value="{{ $tags ?? '' }}" />
                    @error('tags')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">

                    <label for="image" class="form-label"><img src="{{ $image ?? $no_image }}" id="image-preview" class="img-thumbnail" alt="{{ __('Изображение поста') }}"></label>
                    <input type="file" name="image" class="form-control" id="image" value="" />
                    <a id="clear-image" class="btn btn-primary mt-3">{{ __('Удалить') }}</a>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
            </form>
        </div>
        <script>
            let imagePreview = document.getElementById('image-preview');

            document.getElementById('image').addEventListener('change', function (event) {
                imagePreview.src = URL.createObjectURL(event.target.files[0]);
                console.log(imagePreview)
            });
            document.getElementById('clear-image').addEventListener('click', function (event) {
                document.getElementById('image').value = null;
                imagePreview.src = '{{ $no_image }}';
                console.log(imagePreview)
            });
        </script>
    </div>
@endsection
