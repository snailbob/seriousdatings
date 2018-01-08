<div style="margin-left: 38%">

    <img src="{!! url() !!}/images/ajax-loader.gif"/>
   
    <img src="{!! url() !!}/images/processing_animation.gif"/>

</div>
   
    <form name = "myform" action = "{!! $data['success_return'] !!}" method = "post" target = "_top">
        {{ csrf_field() }}
       <input type = "hidden" name = "custom" value = "{!! $data['user_id'] !!},{!! $data['planID'] !!}">
       <input type = "hidden" name = "subscr_id" value = "{!! Auth::user() -> email !!}">
       <input type = "hidden" name = "payer_email" value = "{!! Auth::user() -> email !!}">
       <input type = "hidden" name = "payer_id" value = "{!! Auth::user() -> email !!}">
       <input type = "hidden" name = "subscr_date" value = "{!! $data['date_now'] !!}">
       <input type = "hidden" name = "auth" value = "Free">
    </form>
    
    <script type="text/javascript">
    
        document.myform.submit();
    </script>