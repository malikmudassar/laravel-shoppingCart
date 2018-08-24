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
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                    
                    <div class="form-group">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                    <div class="input-group btnLogin mb-3 mt-4">
                        <input type="password" id="password" name="password" class="form-control" placeholder="PASSWORD*">
                        <div class="input-group-append">
                            <span class="input-group-text" id="password_addon"><a href="javascript:void(0)" class="col-lg-1 col-2 m-0 p-0"><i id="password_icon" class="fa fa-eye fa-fw m-0 p-0"></i></a></span>
                        </div>
                    </div>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    <div class="text-right">
                        <a href="{{ URL::to('password/reset') }}">Reset Password</a>
                    </div>

                    <button type="submit" class="btn btnGreen mt-4 mb-5" style="width:100%;">Accedi</button>
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