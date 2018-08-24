@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

    <div class="conteiner-fluid topBorder botBorder">

        <!--   va inserito un logo non una scritta     -->
        <div class="d-flex flex-row justify-content-center mt-3">

            <div class="d-inline-flex"><h1 class="display-3 greenText">Cateri</h1></div>
            <div class="d-inline-flex"><h1 class="display-3" style="color:#89c36e;"><strong>Sana</strong></h1></div>
        </div>
        <!--   END va inserito un logo non una scritta     -->

        <!--    SOCIAL LOGIN    -->
        <div class="d-flex flex-row justify-content-center mt-1">
            <h3 class="greenText">Accedi</h3>
        </div>


        <!--    END SOCIAL LOGIN    -->

        <!--    form registrazione    -->
        <div class="d-flex flex-row justify-content-center text-center mt-5">
            <div><b>Si prega di fornire le credenziali</b></div>
        </div>

        <div class="d-flex flex-row justify-content-center text-center mt-3 mb-3">
            <div class="d-flex flex-column col-lg-4 col-12 col-md-4">
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="row">
                            <div class="col-md-12">
                                <input id="email" placeholder="Indirizzo email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                <input id="password" placeholder="Parola d'ordine" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password-confirm" placeholder="conferma password" type="password" class="form-control" name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btnGreen mt-4 mb-5" style="width:100%;">Resetta la password</button>
                </form>
            </div>
        </div>

        <!--    END form registrazione    -->

    </div>

    <style type="text/css">
        .help-block {
            color:red;
        }
    </style>

    <script type="text/javascript">
        $(function() {
            $('#password_addon').on('click', function(){
                if($.trim($('#password').val()).length > 0) {
                    togglePassword($('#password'), $('#password_icon'));
                }
            });
        });

        function togglePassword($element, $icon_elem){
            var newType=$element.prop('type')=='password'?'text':'password';

            if(newType == 'text') {
                $icon_elem.removeClass('fa-eye').addClass('fa-eye-slash');
            }
            else {
                $icon_elem.removeClass('fa-eye-slash').addClass('fa-eye');
            }

            $element.prop('type',newType);
        }

    </script>

@endsection