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
        	<pre>
           <?php 
           foreach($cart->items as $item)
	        {
	            $itemDetail=[
	                'name'  => $item['item']->name,
	                'price' => $item['item']->price,
	                'qty'   => $item['qty']
	            ];
	            $data['items'][]=$itemDetail;
	        }
	        print_r($data);
           ?>
       		</pre>
        </div>
            
            
        <!-- Slick -->
      
        
        
    <style type="text/css">
        .card-body {
            min-height: 150px !important;
        }
    </style>
             
                
                
@endsection

