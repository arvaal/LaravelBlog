@extends('common.html')
@section('title', __('Регистрация'))
    @section('content')
        <div class="content">
            <div class="card form-card">
                <div class="card-header">{{ __('Регистрация') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('account.register.store') }}" class="form">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Электронная почта') }}</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $email ?? '' }}" />
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Имя') }}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $name ?? '' }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Пароль') }}</label>
                            <input type="password" name="password" class="form-control" id="password" value="{{ $password ?? '' }}" />
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Подтвердить пароль') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" />
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="form_check" class="form-check-input" id="form_check" {{ isset($form_check) ? 'checked': '' }} />
                            <label class="form-check-label" for="form-check">{{ __('Подписаться на рассылки') }}</label>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
