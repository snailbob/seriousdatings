<div style="margin-left: 38%">

    <img src="{!! url() !!}/images/ajax-loader.gif"/>
   
    <img src="{!! url() !!}/images/processing_animation.gif"/>

</div>
   
    <form name = "myform" action = "{!! $data['url'] !!}" method = "post" target = "_top">
        
        <input type="hidden" name="cmd" value="_xclick-subscriptions" />
        <input type="hidden" name="business" value="{!! $data['merchant_email'] !!}" />
        <input type="hidden" name="currency_code" value="USD" />
        <input type="hidden" name="no_shipping" value="1" />

        <input type="hidden" name="item_name" value="{!! $data['product_name'] !!}" />
        <input type="hidden" name="item_number" value="{!! $data['planID'] !!}" />
        <input type="hidden" name="a3" value="{!! $data['cycle_amount'] !!}" />
        <input type="hidden" name="p3" value="{!! $data['total_cycle'] !!}" />
        <input type="hidden" name="t3" value="{!! $data['cycle'] !!}" />
        <input type="hidden" name="src" value="1" />
        <input type="hidden" name="sra" value="1" />
        
        <input type = "hidden" name = "cancel_return" value = "{!! $data['cancel_return'] !!}">

        <input type = "hidden" name = "custom" value = "{!! $data['user_id'] !!},{!! $data['planID'] !!}">
        
        <input type = "hidden" name = "return" value = "{!! url() !!}/profile/datingPlan/succes">

        <input type=  "hidden" name="notify_url" value="{!! $data['success_return'] !!}">

        <input type='hidden' name='rm' value='2'>
        
        <input type="hidden" name="bn" value="PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHostedGuest">
    
    </form>
    
    <script type="text/javascript">
    
        document.myform.submit();
    </script>