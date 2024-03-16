@extends('common.html')

@section('title', 'Авторизация')

@section('content')
    <div class="content">
        <div class="card form-card">
            <div class="card-header">{{ __('Авторизация') }}</div>
            <div class="card-body">
                <form method="post" action="{{ route('account.login.store') }}" class="form">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Электронная почта') }}</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $email ?? '' }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div id="emailHelp" class="form-text">{{ __('Электронная почта видна только вам.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Пароль') }}</label>
                        <input type="password" name="password" class="form-control" id="password" value="{{ $password ?? '' }}">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="form_check" class="form-check-input" id="form-check" {{ isset($form_check) ? 'checked': '' }} />
                        <label class="form-check-label" for="form-check">{{ __('Запомнить меня') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('вход') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
