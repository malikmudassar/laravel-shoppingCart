@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

<div class="container-fluid p-0">

        <!-- Slick -->
        @if(Session::has('success'))
            <div class="container">
                
                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                
            </div>
        @endif    
        <div class="container pt-3">
           <h2>{{$page->name}}</h2>
           <?php echo $page->description;?>
        </div>
            
            
        <!-- Slick -->
      
        
        
    <style type="text/css">
        .card-body {
            min-height: 150px !important;
        }
    </style>
             
                
                
@endsection

