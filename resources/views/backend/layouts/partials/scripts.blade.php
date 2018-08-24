<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/js/backend/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/backend/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/backend/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Pusher -->
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>

<!-- icheck -->
<script src="{{ asset('/js/backend/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('/js/backend/inspinia.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/backend/plugins/pace/pace.min.js') }}" type="text/javascript"></script>

<!-- Ladda -->
<script src="{{ asset('/js/backend/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('/js/backend/plugins/ladda/ladda.jquery.min.js') }}"></script>


<script type="text/javascript">
window.csrf_token = '{{ csrf_token() }}';

$(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': csrf_token
      }
  });

   $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_token' value='"+csrf_token+"'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
   })
   .removeAttr('href')
   .attr('style','cursor:pointer;')
   .attr('onclick','$(this).find("form").submit();');

   // Bind normal buttons
  $( '.ladda-button' ).ladda( 'bind', { timeout: 2000 } );

  $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
  });
});
</script>