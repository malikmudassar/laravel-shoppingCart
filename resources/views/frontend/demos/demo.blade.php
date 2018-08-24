@extends('frontend.layouts.app')
@php
    $page = \App\Page::where('template',$viewName)->first();
    $fields = $page->fields;
@endphp

@section('htmlheader_css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('htmlheader_title')
@endsection

@section('contentheader_title')
    <img src="" class="img-circle" style="height: 40px;" />
@endsection

@section('breadcrumb')
@endsection

@section('main-content')
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Features</a>
            <a class="p-2 text-dark" href="#">Enterprise</a>
            <a class="p-2 text-dark" href="#">Support</a>
            <a class="p-2 text-dark" href="#">Pricing</a>
        </nav>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>
    @include('frontend.demos.comunicato-stampa')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Pricing</h1>
      <div id="Paragrafo" data-editable="yes" data-type="html" data-label="Riassunto Argomenti" data-order="4">
            {!! $c_fields['Paragrafo']->value['Paragrafo'] !!}
      </div>
    </div>

    <div id="0-id-demo-1" data-editable="yes" data-type="string" data-label="Demo 1" data-order="2"></div>

    <div id="1-id-demo-2" data-editable="yes" data-type="date" data-label="Demo 2" data-order="3"></div>

    <div id="2-titolo-principale" data-editable="yes" data-type="string" data-label="Main Tilte" data-order="0"></div>

    <div id="home-slider" data-editable="yes" data-type="easyslider" data-label="Home Page Slider" data-order="1"></div>


@endsection

@section('script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection