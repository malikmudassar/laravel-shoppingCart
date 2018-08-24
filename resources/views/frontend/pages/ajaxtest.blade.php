@extends('frontend.layouts.app')

@section('htmlheader_css')
@endsection

@section('htmlheader_title')

@endsection

@section('main-content')

<form action="" method="POST">  
    <input type="text" name='data1' value="value1">  
    <input type="text" name='data2' value="value2">
    {{csrf_field()}}
    <button id="btn-ok"> Submit</button>
</form>

    <script type="text/javascript">
        

        $('#btn-ok').click(function(){

            $.ajax({
                type: 'POST',
                url: {{route('test.ajax')}},
                data: {
                    '_token': $('input[name=_token]').val(),
                    'data1': $('input[name=data1]').val(),
                    'data2': $('input[name=data2]').val()
                },
                success: function(data) {
                    console.log(data);
                }

            });
        });
        	
    </script>     
                
                
@endsection

<!-- 'card_type':'master',
                    'card_number':'4242',
                    // 'expiry':$('#expiry').val(),
                    // 'cvv':$('#cvv').val(),
                    // 'name':$('#name').val(),
                    // 'surname':$('#surname').val(),
                    // 'address1':$('#address1').val(),
                    // 'address2':$('#address2').val(),
                    // 'province':$('#province').val(),
                    // 'city':$('#city').val(),
                    // 'country':'Italia',                
                    // 'box_id':$('#sub_box_id').val(),
                    // '_token':$('#token').val() -->