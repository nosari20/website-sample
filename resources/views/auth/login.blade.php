@extends('auth.auth-master')

@section('content')


<div class=" login-center">
    <div class="mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Connexion</h2>
    </div>
    <div class="mdl-card__supporting-text">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="name" type="text" name="name" value="{{ old('name') }}">
                <label class="mdl-textfield__label" for="sample3">Utilisateur</label>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="password" type="password" name="password" value="{{ old('password') }}">
                <label class="mdl-textfield__label" for="password">Mot de passe</label>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            
            
        
            <div class="form-input">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="remember">
                    <input type="checkbox" id="remember" name="remember" class="mdl-switch__input">
                    <span class="mdl-switch__label">Se souvenir de moi</span>
                </label>
            </div>

            
            <div class="form-input">
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                    Connexion
                </button>
            </div>

            <a class="btn btn-link" href="{{ url('/password/email') }}">Mot de passe oublié</a>
        </form>
    </div>
    </div>
</div>


@endsection
