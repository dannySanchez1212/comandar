@extends('layouts.default')

@section('content')
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="grid-container">
            <div class="grid-x grid-padding-y">
                <div class="medium-6 medium-offset-3 cell email">
                    <h4 class="text-center">Inicio de Seccion</h4>

                    @if (!empty($errors) && $errors->has('email'))
                        <div class="callout small alert text-center" id="emailHelpText">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif

                    <label for="email">
                        E-Mail
                        <input id="email" type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelpText" required autofocus>
                    </label>

                    @if (!empty($errors) && $errors->has('password'))
                        <div class="callout small alert text-center" id="passwordHelpText">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    @endif

                    <label for="password">
                        Contraseña
                        <input id="password" type="password" name="password" aria-describedby="passwordHelpText" required>
                    </label>

                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
                    </label>

                    <button type="submit" class="button expanded">Acceder</button>

                    <p class="text-center"><a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a></p>
                </div>
            </div>
        </div>
    </form>
@endsection
