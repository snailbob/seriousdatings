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
            <p style="margin: 0;font-size: 14px;line-height: 17px">
                <span style="font-size: 14px; line-height: 16px;">
                    <span style="line-height: 16px; font-size: 14px;">You are invited for a Serious Datings event - <strong>{{$event->title}}</strong> at {{$event->eventLocation}}.
                    </span>
                </span>
            </p>
        </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->



    <a href="{{$link}}" style="text-decoration: none;">
        <div align="left" class="button-container left" style="padding-right: 10px; padding-left: 30px; padding-top:10px; padding-bottom:10px;">
            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top:10px; padding-bottom:10px;" align="left"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:25pt; v-text-anchor:middle; width:156pt;" arcsize="9%" strokecolor="#d44457" fillcolor="#d44457"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px;"><![endif]-->
            <div style="color: #ffffff; background-color: #d44457; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; max-width: 208px; width: 168px;width: auto; border-top: 0px solid transparent; border-right: 0px solid transparent; border-bottom: 0px solid transparent; border-left: 0px solid transparent; padding-top: 5px; padding-right: 20px; padding-bottom: 5px; padding-left: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none;">
                <span style="font-size:12px;line-height:24px;">{{$button_text}}</span>
            </div>
            <!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
        </div>
    </a>



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
