<footer>
            <div class="container" id="containerFooter">
                <div class="row" style="text-align: center; margin-bottom: 20px;">
                    <div class="col-md-4 d-none d-md-block">
                    
                        <img class="img-fluid" id="logoFooter" src="{{asset('/images/logo.png')}}">
                        
                    </div>
                    <div class="col-md-2 col-sd-12">
                        <h5>Scopri di pi&ugrave;</h5>
                        <ul class="list-groupid" style="padding:0px; text-align: left">
                          <li class="list-group-item listFooter">
                            <a href="{{URL::to('/pages/chi-siamo')}}">Chi siamo</a></li>
                          <li class="list-group-item listFooter">
                            <a href="{{URL::to('/pages/come-funziona')}}">Come funziona</a></li>
                          
                          <li class="list-group-item listFooter">
                            <a href="{{route('news')}}">Stampa &amp; News</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-2 col-sd-12">
                        <h5>La spesa</h5>
                        <ul class="list-groupid" style="padding:0px; text-align: left">
                          @if(!Auth::user())
                          <li class="list-group-item listFooter">
                            <a href="{{route('register')}}">Iscriviti</a></li>
                          @endif
                          <li class="list-group-item listFooter">
                            <a href="{{route('box.index')}}">I pacchi</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-2 col-sd-12">
                        
                        <h5>Help</h5>
                        <ul class="list-groupid" style="padding:0px; text-align: left">
                          <li class="list-group-item listFooter">
                            <a href="#">Contattaci</a></li>
                          <li class="list-group-item listFooter">
                            <a href="http://18.191.178.175/test.php">FAQ</a></li>                         
                          <li class="list-group-item listFooter">
                            <a href="{{URL::to('/pages/metodi-pagamenti')}}">Metodi di pagamenti</a></li>
                          <li class="list-group-item listFooter">
                            <a href="{{URL::to('/pages/termini-condizioni')}}">Termini e Condizioni</a></li>
                          <li class="list-group-item listFooter">
                            <a href="{{URL::to('/pages/informativa-privacy')}}">Informativa Privacy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sd-12">
                        <h5>Seguici</h5>
                        <ul class="list-groupid" style="padding:0px; text-align: left">
                          <i class="fab fa-facebook"></i> <i class="fab fa-instagram"></i>
                        </ul>
                    </div>
                </div>
                
                <div class="row justify-content-center">
                
                    <p class="text-center" id="companyInfo">Copyright &copy; {{ date('Y') == '2018' ? '2018' : '2018 - ' . date('Y') }} Caterisana - Cap.Soc. € 10.000 - P.IVA 03603110796 | <a href="{{URL::to('/pages/termini-condizioni')}}" >Termini e Condizioni</a> | <a href="{{URL::to('/pages/informativa-privacy')}}">Privacy</a> </p>
                
                </div>
                
            </div>
        
    
        </footer> 

        <style type="text/css">
          .listFooter a {
            color: #669966;
            font-size: 16px;
          }
          #logoFooter {
            width: 120px;
          }
          h5 {
            font-weight: bolder;
          }

        </style>