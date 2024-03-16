<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ __('Blog') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(isset($navigation_bar))
                    {!! $navigation_bar['bar'] !!}
                @endif
                @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('account.home') }}">{{ __('Панель управления') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('account.login.out') }}">{{ __('Выход') }}</a>
                        </li>
                @else
                        <li class="nav-item">
                            <a class="nav-link {){ Route::currentRouteName() == 'account.login' ? 'active' : '' }}" aria-current="page" href="{{ route('account.login') }}">{{ __('Вход') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'account.register' ? 'active' : '' }}" aria-current="page" href="{{ route('account.register') }}">{{ __('Регистрация') }}</a>
                        </li>
                @endif
            </ul>
            <form action="{{ $navigation_bar['search'] }}" class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="word" placeholder="{{ __('Поиск') }}" aria-label="{{ __('Поиск') }}" />
                <button class="btn btn-outline-success" type="submit">{{ __('Поиск') }}</button>
            </form>
        </div>
    </div>
</nav>
