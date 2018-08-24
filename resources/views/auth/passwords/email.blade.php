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
            <div><b>Resetta la password</b></div>
        </div>

        <div class="d-flex flex-row justify-content-center text-center mt-3 mb-3">
            <div class="d-flex flex-column col-lg-4 col-12 col-md-4">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Indirizzo email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btnGreen mt-4 mb-5" style="width:100%;">Invia il link per reimpostare la password</button>
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