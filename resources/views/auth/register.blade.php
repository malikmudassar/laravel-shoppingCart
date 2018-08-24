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
            <h3 class="greenText">Registrazione</h3>
        </div>
        
        <div class="d-flex flex-row justify-content-center text-center mt-5">
            <span>Completa i tuoi ordini velocemente ed approfitta delle promozioni dedicate ai clienti registrati</span>
        </div>
        
        <div class="d-flex flex-row justify-content-center text-center mt-5 mb-3">
            <div><b>REGISTRATI CON IL PROFILO SOCIAL CHE PREFERISCI</b></div>
        </div>
        <!--   Facebook Login      -->
        <div class="d-flex flex-row justify-content-center mt-1 mb-2 btnLogin">
            <div class="d-flex flex-column col-12 col-lg-4 col-md-4">
            <button type="button" class="btn btn-fb btn-lg btn-block py-0"><i class="fab fa-facebook fa-2x pt-1"></i></button>
            </div>
        </div>
        <!--   Google Login      -->
        <div class="d-flex flex-row justify-content-center mt-1 mb-2 btnLogin">
            <div class="d-flex flex-column col-lg-4 col-12 col-md-4">
            <button type="button" class="btn btn-ggl btn-lg btn-block py-0"><img src="{{asset('images/google-favicon-logo.png')}}" class="btnImg"</button>
            </div>
        </div>
        <!--    END SOCIAL LOGIN    -->
            
        <!--    form registrazione    -->    
        <div class="d-flex flex-row justify-content-center text-center mt-5">
            <div><b>OPPURE USANDO LA TUA MAIL</b></div>
        </div>
        
        <div class="d-flex flex-row justify-content-center text-center mt-3 mb-3">
            <div class="d-flex flex-column col-lg-4 col-12 col-md-4">
                 <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="NOME*" value="">
                    </div>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="cognome" placeholder="E-Mail*">
                    </div>
                    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <div class="input-group btnLogin mb-3">
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
                    <div class="input-group btnLogin mb-3">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="CONFIRM PASSWORD*">
                        <div class="input-group-append">
                            <span class="input-group-text" id="password_confirmation_addon"><a href="javascript:void(0)" class="col-lg-1 col-2 m-0 p-0"><i id="password_confirmation_icon" class="fa fa-eye fa-fw m-0 p-0"></i></a></span>
                        </div>
                    </div>
                    
                    <div class="form-check termsAndConditions px-0 mx-0 mt-3">
                        <div class="custom-control custom-checkbox ">
                            <input type="checkbox" class=" custom-control-input py-0" name="privacy" id="privacy">
                            <label class="custom-control-label termsAndConditions" for="privacy" >Accetto <b class="underline"><a href="{{ URL::to('/pages/termini-condizioni') }}">Termini e condizioni</a></b> di vendita e l'informativa sulla
                                <b class="underline"><a href="{{ URL::to('/pages/informativa-privacy') }}">Privacy</a></b> (D.Lgs 196/2003) e desidero iscrivermi alla newsletter di CateriSana</label>
                        </div>
                    </div>

                     @if ($errors->has('privacy'))
                         <span class="help-block">
                            <strong>{{ $errors->first('privacy') }}</strong>
                        </span>
                     @endif
                    
                    <div class="form-check termsAndConditions px-0 mx-0 mt-3">
                        <div class="custom-control custom-checkbox ">
                            <input type="checkbox" class=" custom-control-input py-0" name="mktg" id="mktg">
                            <label class="custom-control-label termsAndConditions" for="mktg" >Acconsento all'uso dei miei dati personalu per essere aggiornato sui <a href="#"><b><u>nuovi arrivi e prodotti in esclusiva</u></b></a>, e per le finalit&aacute; di marketing correlate ai servizi offerti</label>
                        </div>
                    </div>

                     @if ($errors->has('mktg'))
                         <span class="help-block">
                            <strong>{{ $errors->first('mktg') }}</strong>
                        </span>
                     @endif

                    <button type="submit" class="btn btnGreen mt-4 mb-5" style="width:100%;">REGISTRATI</button>
                </form>
            </div>
        </div>
            
        <!--    END form registrazione    --> 

    </div>
             
<style type="text/css">
    .help-block {
        color:red;
    }
    .underline {
        text-decoration: underline;
    }

</style>

<script type="text/javascript">
    $(function() {
        $('#password_addon').on('click', function(){
            if($.trim($('#password').val()).length > 0) {
                togglePassword($('#password'), $('#password_icon'));
            }
        });
        $('#password_confirmation_addon').on('click', function(){
            if($.trim($('#password_confirmation').val()).length > 0) {
                togglePassword($('#password_confirmation'), $('#password_confirmation_icon'));
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

