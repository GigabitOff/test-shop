<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email</title>
    <style>
        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }

        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%;
        }

        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
        }

        .body {
            background-color: #FFFFFF;
            width: 100%;
        }

        .container {
            display: block;
            margin: 0 auto !important;
            max-width: 600px;
            padding: 16px 38px;
            width: 600px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box
        }

        .content {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 600px;
            padding: 0;
        }

        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }

        .wrapper {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0;
        }

        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .section-table {
            padding-bottom: 30px
        }

        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }

        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }

        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }

        a {
            color: #FFAE00;
            text-decoration: none;
        }

        .title-main {
            font-weight: 700;
            font-size: 16px;
            line-height: 100%;
            letter-spacing: 0.02em;
            color: #3C3C3B;
            margin: 41px 0 8px 0;
        }

        .product-img {
            width: 54%;
        }

        .product-img img {
            width: 262px;
            display: block;
            max-width: 100%;
        }

        .btn {
            display: inline-block;
            height: 45px;
            border: 0;
            overflow: hidden;
            font-size: 14px;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: 0.03em;
            padding: 14px 18px 14px;
            max-width: 100%;
            border-radius: 30px;
            line-height: 1;
            text-decoration: none;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            background: #FFAE00
        }

        .btn:hover {
            background: #FF8A00;
        }

        .label {
            font-weight: 400;
            font-size: 14px;
            line-height: 100%;
            color: #9FA4B0;
        }

        .poduct-item {
            padding: 11px 0 3px 0;
        }

        .product-info {
            padding-top: 11px
        }

        .section-title {
            padding: 12px 12px 8px;
            background: #F0F1F4;
            font-weight: 700;
            font-size: 16px;
            line-height: 100%;
            text-transform: uppercase;
            color: #3C3C3B;
        }

        .footer {
            border-top: 1px solid #E1E3EA;
            padding-top: 20px;
        }

        .name {
            font-weight: 700;
            font-size: 20px;
            line-height: 110%;
            color: #3C3C3B;
            padding-top: 7px;
            padding-bottom: 8px;
            border-bottom: 1px solid #F0F1F4;
        }

        .btns-grop .btn {
            margin-right: 6px
        }

        .price-item {
            padding-top: 14px
        }

        .price-item tr:last-child td {
            padding-top: 5px
        }

        .price-item td.label {
            width: 80px;
            font-size: 12px;
            vertical-align: bottom;
        }

        .price-old {
            font-weight: 400;
            font-size: 18px;
            line-height: 100%;
            color: #878C98;
        }

        .price {
            font-weight: 700;
            font-size: 18px;
            line-height: 100%;
            color: #3C3C3B;
        }

        .btns-grop {
            padding-top: 15px
        }

        .header {
            border-bottom: 1px solid #3C3C3B;
            padding-bottom: 20px;
        }

        .socil-item {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin-left: 5px;
            border-radius: 50%;
            background: #E1E3EA;
            line-height: 40px;
            text-align: center;
        }

        .socil-item img {
            display: inline-block;
            max-width: 100%;
            margin: auto;
            padding-top: 10px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            width: 30px;
            height: 30px;
        }

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
                width: 40%;
            }

            .product-img img {
                height: auto;
            }

            .name {
                font-size: 16px;
            }
        }

        @media only screen and (max-width: 380px) {
            .btns-grop .btn {
                margin-right: 0;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="container">
            <table role="presentation" class="main" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="wrapper">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="header">
                            <tr>
                                <td><a href="{{route('main')}}" style="
                        width: 90px;
                        display: block;
                        "><img src="{{asset('assets/img/logo.svg')}}" alt="logo" width="90" style="display: block; border: 0; max-width: 100%;" /></a></td>
                                <td style="text-align: right"><a href="{{route('main')}}" style="display: inline-block; height: 45px; width: 93px; border: 1.5px solid #FFAE00; font-size: 14px; font-weight: 700; color: #3C3C3B; letter-spacing: 0.03em; padding: 14px 18px 14px; max-width: 100%; border-radius: 30px; line-height: 1; text-decoration: none; box-sizing: border-box">@lang('custom::site.on_project_domain')</a></td>
                            </tr>
                        </table>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-bottom: 17px">
                                    <h2 class="title-main">@lang('custom::site.nice_day'), {{$user->name}}</h2>
                                    <p>@lang('custom::site.changed_price_message')</p>
                                </td>
                            </tr>
                        </table>
                        @foreach($categories as $category_id => $products)
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="section-table">
                            <tr>
                                <td class="section-title">{{$products[0]->category->name ?? 'n/a'}}</td>
                            </tr>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="poduct-item">
                                        <tr>
                                            <td class="product-img">
                                                @if($product->images->isNotEmpty())
                                                    <img src="{{\Storage::disk('public')->url($product->images[0]->url)}}"  alt="product" width="262" height="200" />
                                                @else
                                                    <img src="{{fallbackBaseImageUrl('')}}" alt="product" width="262" height="200" />
                                                @endif
                                            </td>
                                            <td class="product-info">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td class="label">{{$product->brand->title ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="name">{{$product->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="price-item">
                                                                <tr>
                                                                    <td class="label">@lang('custom::site.old_price')</td>
                                                                    <td class="price-old"><s>{!! formatNbsp(formatMoney($product->old_price) . ' ₴') !!}</s></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="label">@lang('custom::site.new_price')</td>
                                                                    <td class="price">{!! formatNbsp(formatMoney($product->new_price) . ' ₴') !!}</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btns-grop">
                                                                <tr>
                                                                    <td><a href="{{route('products.show', ['product'=>$product->slug])}}" class="btn">@lang('custom::site.Buy')</a><a href="{{route('products.show', ['product'=>$product->slug])}}" style="display: inline-block; height: 45px; width: 45px; border: 1.5px solid #FFAE00; overflow: hidden; padding-top: 8px; font-size: 14px; font-weight: 700; max-width: 100%; margin-right: 10px; border-radius: 30px; line-height: 41px; text-decoration: none; box-sizing: border-box; text-align: center"><img src="{{asset('assets/img/eye.svg')}}" alt="eye" width="25" height="25" /></a></a><a href="{{route('products.show', ['product'=>$product->slug])}}" style="display: inline-block; height: 45px; width: 45px; background: #F8F9FA; overflow: hidden; padding-top: 8px; font-size: 14px; font-weight: 700; max-width: 100%; border-radius: 30px; line-height: 41px; text-decoration: none; box-sizing: border-box; text-align: center"><img src="{{asset('assets/img/eye-slash.svg')}}" alt="eye" width="25" height="25" /></a></td>
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
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="footer">
                            <tr>
                                <td>
                                    <a href="{{route('main')}}" style="width: 90px; display: block;">
                                        <img src="{{asset('assets/img/logo.svg')}}" alt="logo" width="90" style="display: block; border: 0; max-width: 100%;" />
                                    </a>
                                </td>
                                <td style="text-align: right">
                                    @foreach($socials as $social)
                                    <a href="{{$social->value}}" class="socil-item"><img src="{{asset("assets/img/$social->key")}}.svg" alt="{{$social->key}}" width="20" height="20" style="display: block; border: 0; max-width: 100%;" /></a>
                                    @endforeach
                                </td>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
