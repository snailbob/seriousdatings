@include('email.email_header')

    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top: 10px; padding-bottom: 5px;"><![endif]-->
    <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:120%;color:#555555; padding-right: 10px; padding-left: 30px; padding-top: 10px; padding-bottom: 5px;">
        <div style="font-size:12px;line-height:14px;color:#555555;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">
            <p style="margin: 0;font-size: 14px;line-height: 17px">
                <strong>
                    <span style="font-size: 20px; line-height: 28px;">Hello 
                    
                        @if(isset($name))
                            {{$name}},
                        @else
                            there,
                        @endif
                    
                    </span>
                </strong>
            </p>
            <div style="margin: 0;font-size: 14px;line-height: 17px">
                {!! $message !!}
            </div>
        </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->


    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="divider" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
        <tbody>
            <tr style="vertical-align: top">
                <td class="divider_inner" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 15px;padding-left: 15px;padding-top: 15px;padding-bottom: 15px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <table class="divider_content" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid transparent;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                        <tbody>
                            <tr style="vertical-align: top">
                                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                    <span></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
                    

@include('email.email_footer')
