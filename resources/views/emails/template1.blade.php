<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @media only screen and (max-width: 600px) {
            .main {
                width: 320px !important;
            }

            .top-image {
                width: 100% !important;
            }

            .inside-footer {
                width: 320px !important;
            }

            table[class="contenttable"] {
                width: 320px !important;
                text-align: left !important;
            }

            td[class="force-col"] {
                display: block !important;
            }

            td[class="rm-col"] {
                display: none !important;
            }

            .mt {
                margin-top: 15px !important;
            }

            *[class].width300 {
                width: 255px !important;
            }

            *[class].block {
                display: block !important;
            }

            *[class].blockcol {
                display: none !important;
            }

            .emailButton {
                width: 100% !important;
            }

            .emailButton a {
                display: block !important;
                font-size: 18px !important;
            }

        }
    </style>
</head>

<body link="#00a5b5" vlink="#00a5b5" alink="#00a5b5" style="background: #fafafa">

    <table class=" main contenttable" align="center"
        style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;width: 600px;">
        <tr>
            <td class="border"
                style="border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                <table
                    style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                    <tr>
                        <td colspan="4" valign="top" class="image-section"
                            style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff;border-bottom: 4px solid #00a5b5">
                            <a href="url('/')">
                                <img class="top-image"
                                    src="{{ url('/images/logo2.png') }}"
                                    style="line-height: 1;width: 600px;" alt="Vauxerp"></a>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="side title"
                            style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
                            <table
                                style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                                <tr>
                                    <td class="head-title"
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 28px;line-height: 34px;font-weight: bold; text-align: center;">
                                        <div class="mktEditable" id="main_title">
                                            {{ $subject }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="sub-title"
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 18px;line-height: 29px;font-weight: bold;text-align: center;">
                                        <div class="mktEditable" id="intro_title">
                                            {{ $sub_subject }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-padding"
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="grey-block"
                                        style="border-collapse: collapse;border: 0;margin: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff; text-align:center;">
                                        <div class="mktEditable" id="cta">
                                            @if ($header_img)
                                            <img class="top-image"
                                                style="border-radius: 10px"
                                                src="{{ $header_img }}"
                                                width="560" /><br><br>
                                            @endif
                                            <strong>Date:</strong> {{ date('Y-m-d') }}<br>
                                            <strong>Time</strong>: {{ date('H:i:s') }}<br>
                                            <br>
                                            <br>
                                            <a style="color:#ffffff; background-color: #45bb96!important;  border: 10px solid #2a8e6e!important; border-radius: 3px; text-decoration:none;"
                                                href="#">Visit Now</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="top-padding"
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;">
                                        <hr size="1" color="#eeeff0">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text"
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                        <div class="mktEditable" id="main_text">
                                            <h2>
                                                Hello {{  $name }},
                                            </h2>
                                            <br><br>

                                            {!! $message !!}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
                                        &nbsp;<br>
                                    </td>
                                </tr> 

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px; font-family: Arial, sans-serif; -webkit-text-size-adjust: none;"
                            align="center">
                            <table>
                                <tr>
                                    <td align="center"
                                        style="font-family: Arial, sans-serif; -webkit-text-size-adjust: none; font-size: 16px;">
                                         
                                        <br />
                                        <span
                                            style="font-size:13px; font-family: Arial, sans-serif; -webkit-text-size-adjust: none;">
                                            {{ $footer }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    
                    <tr>
                        <td valign="top" align="center"
                            style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                            <table
                                style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                                <tr>
                                    <td align="center" valign="middle" class="social"
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;text-align: center;">
                                        <table
                                            style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                                            <tr>
                                                <td
                                                    style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                                    <a href="{{ url('/') }}/blog"><img
                                                            src="https://info.tenable.com/rs/tenable/images/rss-teal.png"></a>
                                                </td>
                                                <td
                                                    style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                                    <a href="https://twitter.com/vauxerp"><img
                                                            src="https://info.tenable.com/rs/tenable/images/twitter-teal.png"></a>
                                                </td>
                                                <td
                                                    style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                                    <a href="https://www.facebook.com/vauxerp"><img
                                                            src="https://info.tenable.com/rs/tenable/images/facebook-teal.png"></a>
                                                </td>
                                                <td
                                                    style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                                    <a href="https://www.youtube.com/vauxerp"><img
                                                            src="https://info.tenable.com/rs/tenable/images/youtube-teal.png"></a>
                                                </td>
                                                <td
                                                    style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                                    <a href="https://www.linkedin.com/vauxerp"><img
                                                            src="https://info.tenable.com/rs/tenable/images/linkedin-teal.png"></a>
                                                </td>
                                                <td
                                                    style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                                                    <a href="https://plus.google.com/vauxerp"><img
                                                            src="https://info.tenable.com/rs/tenable/images/google-teal.png"></a>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr bgcolor="#fff" style="border-top: 4px solid #00a5b5;">
                        <td valign="top" class="footer"
                            style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background: #fff;text-align: center;">
                            <table
                                style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                                <tr>
                                    <td class="inside-footer" align="center" valign="middle"
                                        style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 12px;line-height: 16px;vertical-align: middle;text-align: center;width: 580px;">
                                        <!--
                                        <div id="address" class="mktEditable">
                                            <b>Tenable Network Security</b><br>
                                            7021 Columbia Gateway Drive<br> Suite 500 <br> Columbia, MD 21046<br>
                                            <a style="color: #00a5b5;"
                                                href="{{ url('/') }}contact-tenable">Contact Us</a>
                                        </div>
                                    -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
