@include('email.email_header')
<div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:120%;color:#555555; padding-right: 10px; padding-left: 30px; padding-top: 10px; padding-bottom: 5px;">
    <div style="font-size:12px;line-height:14px;color:#555555;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">
        <p style="margin: 0;font-size: 14px;line-height: 17px">
            <strong>
                    <span style="font-size: 20px; line-height: 28px;">Hello

                    </span>
            </strong>
        </p>
        <p style="margin: 0;font-size: 14px;line-height: 17px">
                <span style="font-size: 14px; line-height: 16px;">
                    <span style="line-height: 16px; font-size: 14px;">
                        @if(isset($content))
                            $content
                        @else
                            You've been disapproved by the admin.
                        @endif
                    </span>
                </span>
        </p>
    </div>
</div>
@include('email.email_footer')