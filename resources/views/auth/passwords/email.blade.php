@extends('auth.auth-master')

@section('content')


    <div class=" login-center">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Changement de mot de passe</h2>

            </div>
            <div class="mdl-card__supporting-text">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="email" type="email" name="email" value="{{ old('email') }}">
                        <label class="mdl-textfield__label" for="email">E-Mail</label>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        @if (session('status'))
                            <span class="help-block">
                                <strong>{{ session('status') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-input">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                            Valider
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>


@endsection