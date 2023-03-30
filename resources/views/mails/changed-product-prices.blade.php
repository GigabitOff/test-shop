<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Email</title>
    <style>
        @media only screen and (max-width: 640px) {
            table.body .content {
                padding: 0 !important;
            }

            table.body .container {
                padding: 30px 10px !important;
                width: 100% !important;
            }

            table.body .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }
        }

        @media only screen and (max-width: 485px) {
            .product-img {
                width: 40%!important;
            }

            .product-img img {
                height: auto!important;
            }

            .name {
                font-size: 16px!important;
            }
        }

        @media only screen and (max-width: 380px) {
            .btns-row {
                display: block
            }
            .btns-row tr {
                display: block;
                width: 100%;
            }
            .btns-row tbody {
                width: 100%;
                display: block;
            }
            .btns-row td {
                display: block;
                width: 100%;
                margin-bottom: 5px
            }
            .btns-row td:nth-child(2) {
                display: inline-block;
                width: 45px;
            }
            .btns-row td:last-child {
                display: inline-block;
                width: 45px;
            }
            .btns-grop .btn {
                margin-right: 0!important;
                width: 100%!important;
                text-align: center!important;
            }
        }
    </style>

</head>
<body style="background-color: #f6f6f6;font-family: sans-serif;-webkit-font-smoothing: antialiased;font-size: 14px;line-height: 1.4;margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
<table border="0" cellpadding="0" cellspacing="0" cellpadding="0" cellspacing="0" height="100%" style="margin:0 auto;" width="100%">
    <tr>
        <td bgcolor="white" height="50" style="height:50px;width:100%;" align="center">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate;width: 600px; max-width: 600px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background-color: #FFFFFF;">
                <tr>
                    <td align="left" class="container" style="font-family: sans-serif;font-size: 14px;vertical-align: top;display: block;max-width: 600px;padding: 16px 38px;width: 600px;-webkit-box-sizing: border-box;box-sizing: border-box;margin: 0 auto !important;">
                        <table role="presentation" class="main" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background: #ffffff;border-radius: 3px;">
                            <tr>
                                <td class="wrapper" style="font-family: sans-serif;font-size: 14px;vertical-align: top;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 0;">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="header" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;border-bottom: 1px solid #3C3C3B;padding-bottom: 20px;">
                                        <tr>
                                            <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;width:100%"><a href="{{route('main')}}" style="width: 90px;display: block;color: #FFAE00;text-decoration: none;"><img src="{{$message->embed(asset('assets/img/logo.png'))}}" alt="logo" width="90" style="display: block;border: none;max-width: 100%;-ms-interpolation-mode: bicubic;"></a></td>
                                            <td style="text-align: right;font-family: sans-serif;font-size: 14px;vertical-align: top;">
                                                <div style="border: 1.5px solid #FFAE00;height: 45px; width: 93px; -webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;">
                                                    <a href="{{route('main')}}" style="display: inline-block;  font-size: 14px; font-weight: 700; color: #3C3C3B; letter-spacing: 0.03em; padding: 14px 18px 14px; max-width: 100%; line-height: 1; text-decoration: none; box-sizing: border-box">@lang('custom::site.on_project_domain')</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                                        <tr>
                                            <td style="padding-bottom: 17px;font-family: sans-serif;font-size: 14px;vertical-align: top;">
                                                <h2 class="title-main" style="color: #3C3C3B;font-family: sans-serif;font-weight: 700;line-height: 100%;margin: 41px 0 8px 0;margin-bottom: 30px;font-size: 16px;letter-spacing: 0.02em;">@lang('custom::site.hey'), {{$user->name}}</h2>
                                                <p style="font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;">@lang('custom::site.changed_price_message')</p>
                                            </td>
                                        </tr>
                                    </table>
                                    @foreach($categories as $category_id => $products)
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="section-table" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;padding-bottom: 30px;">
                                        <tr>
                                            <td class="section-title" style="font-family: sans-serif;font-size: 16px;vertical-align: top;padding: 12px 12px 8px;background: #F0F1F4;font-weight: 700;line-height: 100%;text-transform: uppercase;color: #3C3C3B;">{{$products[0]->category->name ?? 'n/a'}}</td>
                                        </tr>
                                        @foreach($products as $product)
                                        <tr>
                                            <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="poduct-item" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;padding: 11px 0 3px 0;">
                                                    <tr>
                                                        <td class="product-img" style="font-family: sans-serif;font-size: 14px;vertical-align: top;width: 54%;">
                                                            @if($product->images->isNotEmpty() && file_exists(\Storage::disk('public')->url($product->images[0]->url)))
                                                                <img src="{{$message->embed(\Storage::disk('public')->url($product->images[0]->url))}}"  alt="product" width="262" height="200" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;width: 262px;display: block;" />
                                                            @else
                                                                <img src="{{$message->embed(fallbackBaseImageUrl(asset('assets/img/no-photo.png')))}}" alt="product" width="262" height="200" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;width: 262px;display: block;" />
                                                            @endif
                                                        </td>
                                                        <td class="product-info" style="font-family: sans-serif;font-size: 14px;vertical-align: top;padding-top: 11px;">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                                                                <tr>
                                                                    <td class="label" style="font-family: sans-serif;font-size: 14px;vertical-align: top;font-weight: 400;line-height: 100%;color: #9FA4B0;">{{$product->brand->title ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="name" style="font-family: sans-serif;font-size: 20px;vertical-align: top;font-weight: 700;line-height: 110%;color: #3C3C3B;padding-top: 7px;padding-bottom: 8px;border-bottom: 1px solid #F0F1F4;">{{$product->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="price-item" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;padding-top: 14px;">
                                                                            <tr>
                                                                                <td class="label" style="font-family: sans-serif;font-size: 12px;vertical-align: bottom;font-weight: 400;line-height: 100%;color: #9FA4B0;width: 80px;">@lang('custom::site.old_price')</td>
                                                                                <td class="price-old" style="font-family: sans-serif;font-size: 18px;vertical-align: top;font-weight: 400;line-height: 100%;color: #878C98;"><s>{!! formatNbsp(formatMoney($product->old_price) . ' ₴') !!}</s></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="label" style="font-family: sans-serif;font-size: 12px;vertical-align: bottom;font-weight: 400;line-height: 100%;color: #9FA4B0;width: 80px;">@lang('custom::site.new_price')</td>
                                                                                <td class="price" style="font-family: sans-serif;font-size: 18px;vertical-align: top;font-weight: 700;line-height: 100%;color: #3C3C3B;">{!! formatNbsp(formatMoney($product->new_price) . ' ₴') !!}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btns-grop" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;padding-top: 15px;">
                                                                            <tr>
                                                                                <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">

                                                                                    <table class="btns-row"  role="presentation" cellpadding="0" cellspacing="0" class="btns-grop" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;padding-top: 15px;">
                                                                                        <tr>
                                                                                            <td style="border-right: 10px solid transparent; width: 100%">
                                                                                                <div style="border: 1.5px solid #FFAE00;-webkit-border-radius: 30px;-khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;background: #FFAE00;height: 45px;text-align: center;line-height: 45px">
                                                                                                    <a
                                                                                                        href="{{route('products.show', ['product'=>$product->slug])}}?add-to-cart=true" class="btn"
                                                                                                        style="color: #FFFFFF;text-decoration: none; height: 45px;border: 0;vertical-align: middle;overflow: hidden;font-size: 14px;font-weight: 700;letter-spacing: 0.03em;max-width: 100%;-webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;-webkit-box-sizing: border-box;box-sizing: border-box;background: #FFAE00;">@lang('custom::site.Buy')</a>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="border-right: 10px solid transparent">
                                                                                                <div style="width: 45px; border: 1.5px solid #FFAE00;-webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;height: 45px;">
                                                                                                    <a
                                                                                                        href="{{route('products.show', ['product'=>$product->slug])}}"
                                                                                                        style="display: inline-block;height: 45px;width: 45px;overflow: hidden;padding-top: 8px;font-size: 14px;font-weight: 700;max-width: 100%;line-height: 41px;text-decoration: none;box-sizing: border-box;text-align: center;color: #FFAE00;"><img
                                                                                                            src="{{$message->embed(asset('assets/img/eye.png'))}}" alt="eye" width="25" height="25"
                                                                                                            style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;"></a>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td >
                                                                                                <div style="width: 45px; -webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;    background: #F8F9FA;height: 45px;">
                                                                                                    <a
                                                                                                        href="{{route('products.show', ['product'=>$product->slug])}}?unsubscribe={{$product->unsubscribe_hash}}"
                                                                                                        style="display: inline-block;height: 45px;width: 45px;background: #F8F9FA;overflow: hidden;padding-top: 8px;font-size: 14px;font-weight: 700;max-width: 100%;-webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;line-height: 41px;text-decoration: none;box-sizing: border-box;text-align: center;color: #FFAE00;"><img
                                                                                                            src="{{$message->embed(asset('assets/img/eye-slash.png'))}}" alt="eye" width="25" height="25"
                                                                                                            style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;"></a>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    @endforeach
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="footer" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;border-top: 1px solid #E1E3EA;padding-top: 20px;">
                                        <tr>
                                            <td style="width: 100%;font-family: sans-serif;font-size: 14px;vertical-align: top;"><a href="{{route('main')}}" style="width: 90px;display: inline-block;color: #FFAE00;text-decoration: none;"><img src="{{$message->embed(asset('assets/img/logo.png'))}}" alt="logo" width="90" style="display: block;border: none;max-width: 100%;-ms-interpolation-mode: bicubic;"></a></td>
                                            <td style="text-align: right;font-family: sans-serif;font-size: 14px;vertical-align: top;">
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                                                    <tr>
                                                        @foreach($socials as $social)
                                                        <td style="border-left: 5px solid transparent">
                                                            <div style="width:40px;height:40px;border-radius: 50%;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;line-height: 40px;text-align: center;background: #E1E3EA;">
                                                                <a href="{{$social->value}}"
                                                                   class="socil-item"
                                                                   style="text-decoration: none;vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;background: #E1E3EA;"><img
                                                                        src="{{$message->embed(asset("assets/img/$social->key.png"))}}" alt="{{$social->key}}" width="20" height="20"
                                                                        style="display: block;border: none;max-width: 100%;-ms-interpolation-mode: bicubic;margin: auto;padding-top: 10px;-webkit-box-sizing: border-box;box-sizing: border-box;width: 30px;height: 30px;">
                                                                </a>
                                                            </div>
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
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
