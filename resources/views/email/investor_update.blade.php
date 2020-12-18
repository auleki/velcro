<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> {{--
    <title>{{$data['report_title']}}</title> --}}
    <style type="text/css">
    @font-face{
        font-family:europa;
        src:url(https://use.typekit.net/af/3e64fb/00000000000000003b9b12fe/27/l?subset_id=2&fvd=n3&v=3) format("woff2"),url(https://use.typekit.net/af/3e64fb/00000000000000003b9b12fe/27/d?subset_id=2&fvd=n3&v=3) format("woff"),url(https://use.typekit.net/af/3e64fb/00000000000000003b9b12fe/27/a?subset_id=2&fvd=n3&v=3) format("opentype");
        font-weight:300;
        font-style:normal;
        }
        @font-face{
        font-family:europa;
        src:url(https://use.typekit.net/af/a386b3/00000000000000003b9b12f9/27/l?subset_id=2&fvd=i3&v=3) format("woff2"),url(https://use.typekit.net/af/a386b3/00000000000000003b9b12f9/27/d?subset_id=2&fvd=i3&v=3) format("woff"),url(https://use.typekit.net/af/a386b3/00000000000000003b9b12f9/27/a?subset_id=2&fvd=i3&v=3) format("opentype");
        font-weight:300;
        font-style:italic;
        }
        @font-face{
        font-family:europa;
        src:url(https://use.typekit.net/af/4eabcf/00000000000000003b9b12fd/27/l?subset_id=2&fvd=n4&v=3) format("woff2"),url(https://use.typekit.net/af/4eabcf/00000000000000003b9b12fd/27/d?subset_id=2&fvd=n4&v=3) format("woff"),url(https://use.typekit.net/af/4eabcf/00000000000000003b9b12fd/27/a?subset_id=2&fvd=n4&v=3) format("opentype");
        font-weight:400;
        font-style:normal;
        }
        @font-face{
        font-family:europa;
        src:url(https://use.typekit.net/af/e32ad9/00000000000000003b9b12fb/27/l?subset_id=2&fvd=i4&v=3) format("woff2"),url(https://use.typekit.net/af/e32ad9/00000000000000003b9b12fb/27/d?subset_id=2&fvd=i4&v=3) format("woff"),url(https://use.typekit.net/af/e32ad9/00000000000000003b9b12fb/27/a?subset_id=2&fvd=i4&v=3) format("opentype");
        font-weight:400;
        font-style:italic;
        }
        @font-face{
        font-family:europa;
        src:url(https://use.typekit.net/af/f3ba4f/00000000000000003b9b12fa/27/l?subset_id=2&fvd=n7&v=3) format("woff2"),url(https://use.typekit.net/af/f3ba4f/00000000000000003b9b12fa/27/d?subset_id=2&fvd=n7&v=3) format("woff"),url(https://use.typekit.net/af/f3ba4f/00000000000000003b9b12fa/27/a?subset_id=2&fvd=n7&v=3) format("opentype");
        font-weight:700;
        font-style:normal;
        }
        @font-face{
        font-family:europa;
        src:url(https://use.typekit.net/af/a6fa4a/00000000000000003b9b12fc/27/l?subset_id=2&fvd=i7&v=3) format("woff2"),url(https://use.typekit.net/af/a6fa4a/00000000000000003b9b12fc/27/d?subset_id=2&fvd=i7&v=3) format("woff"),url(https://use.typekit.net/af/a6fa4a/00000000000000003b9b12fc/27/a?subset_id=2&fvd=i7&v=3) format("opentype");
        font-weight:700;
        font-style:italic;
        }

        body {
            margin: 0;
            padding: 0;
            min-width: 100%!important;
            font-family: 'europa';
        }

        img {
            height: auto;
        }

        .content {
            width: 100%;
            max-width: 600px;
            font-family: 'europa';
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 21px;
        }

        .header {
            padding: 40px 30px 20px 30px;
            font-family: 'europa';
        }

        .innerpadding {
            padding: 30px 30px 30px 30px;
        }

        .borderbottom {
            border-bottom: 1px solid #f2eeed;
        }

        .subhead {
            font-size: 15px;
            color: #ffffff;
            font-family: sans-serif;
            letter-spacing: 10px;
        }

        .h1,
        .h2,
        .bodycopy {
            color: #153643;
            /* font-family: sans-serif; */
            font-family: 'europa';
        }

        .h1 {
            font-size: 33px;
            line-height: 38px;
            font-weight: bold;
        }

        .h2 {
            padding: 0 0 15px 0;
            font-size: 38px;
            line-height: 28px;
            font-weight: bold;
        }

        .bodycopy {
            font-size: 16px;
            line-height: 22px;
        }

        .button {
            text-align: center;
            font-size: 18px;
            font-family: sans-serif;
            font-weight: bold;
            padding: 0 30px 0 30px;
        }

        .button a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer {
            padding: 20px 30px 15px 30px;
        }

        .footercopy {
            font-family: sans-serif;
            font-size: 14px;
            color: #ffffff;
        }

        .footercopy a {
            color: #ffffff;
            text-decoration: underline;
        }
        .text-wrap{
            overflow-wrap: break-word;
        }
        .btn {
            background: linear-gradient(180deg, #2E7CFF 0%, #1B63DC 99.99%, #1B63DC 100%);
            border-radius: 4px;
            width: 101px;
            height: 36px;
            border: none;
            color:#ffffff;
            cursor: pointer;
        }
        .header-img{
            display: flex;
            justify-content: center;
            align-content: center;
            margin-bottom: 2em;
        }

        @media only screen and (max-width: 550px),
        screen and (max-device-width: 550px) {
            body[yahoo] .hide {
                display: none!important;
            }
            body[yahoo] .buttonwrapper {
                background-color: transparent!important;
            }
            body[yahoo] .button {
                padding: 0px!important;
            }
            body[yahoo] .button a {
                background-color: #e05443;
                padding: 15px 15px 13px!important;
            }
            body[yahoo] .unsubscribe {
                display: block;
                margin-top: 20px;
                padding: 10px 50px;
                background: #2f3942;
                border-radius: 5px;
                text-decoration: none!important;
                font-weight: bold;
            }
        }
    </style>
</head>

<body yahoo bgcolor="#f6f8f1">
    <table width="100%" bgcolor="" border="0" cellpadding="0" cellspacing="0"style="margin-top: 5rem">
        <tr>
            <td>

                <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">

                    <tr>
                        <td class="innerpadding borderbottom">
                            <div class="header-img">
                                <img  src="https://user-images.githubusercontent.com/22575481/78081212-eb249f80-73a7-11ea-9389-8c4dd3b13b02.png" alt="echovc">
                            </div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="h2">
                                        <!-- Investor Report Email -->
                                        August Investee Update
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bodycopy">
                                        {{-- {{$data['content']}} --}} Ea sunt reprehenderit eiusmod pariatur aliqua ad esse eiusmod eiusmod irure et. Cupidatat aliquip ipsum aliquip officia ex amet deserunt amet pariatur nisi quis nulla mollit. Ea culpa laborum sunt Lorem in non enim reprehenderit occaecat sunt adipisicing esse. Sunt eiusmod nostrud sint veniam enim officia officia id.Ea sunt reprehenderit eiusmod pariatur aliqua ad esse eiusmod eiusmod irure et. Cupidatat aliquip ipsum aliquip officia ex amet deserunt amet pariatur nisi quis nulla mollit. Ea culpa laborum sunt Lorem in non enim reprehenderit occaecat sunt adipisicing esse. Sunt eiusmod nostrud sint veniam enim officia officia id.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="innerpadding borderbottom">
                            <table width="115" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="115" style="padding: 0 20px 20px 0;">
                                        <img src="https://user-images.githubusercontent.com/22575481/78076737-e0194180-739e-11ea-812c-663e344dd8c5.png" alt="image">
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
            <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
          <![endif]-->
                            <table class="col380" align="left" border="0"  cellpadding="0" cellspacing="0" style="width: 100%; border-bottom: 1px solid #CCCCCC;">
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="bodycopy">
                                                    <h3> Thanks</h3> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, nisi libero ultricies ipsum, in posuere mauris neque at erat.
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table class="col380" align="left"  cellpadding="0" cellspacing="0" style="width: 100%; ">
                                <tr>
                                    <td>
                                        <table width="100%" border="0"  cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="bodycopy">
                                                    <small style="color:#F36A6A;"> required <sup>*</sup></small>

                                                    <div>
                                                        <h3> Meeting summary <sup style="color:#F36A6A">*</sup></h3>
                                                        <p style="overflow-wrap: break-word">
                                                            Please report briefly on your understanding of the issues
                                                            that were raised at our last meeting, especially regarding
                                                            the merge and if you have any concerns.
                                                        </p>
                                                        <textarea name="" id=""style="border-radius: 4px; padding: 1em; width: 100%; box-sizing:border-box" cols="30" placeholder="Start typing here" rows="10"></textarea>
                                                    </div>
                                                </td>


                                            </tr>

                                            <tr>
                                                <td class="bodycopy">
                                                    <div>
                                                        <h3> September 2019 KPIs <sup style="color:#F36A6A">*</sup></h3>
                                                        <p style="overflow-wrap: break-word">
                                                            Please enter the KPI values required below from the month of September 2019
                                                        </p>
                                                        <div>
                                                            {{-- <table>
                                                                <thead>
                                                                    <th> KPI name </th>
                                                                    <th> Format </th>
                                                                    <th> KPI Value </th>
                                                                </thead>

                                                                <tr>
                                                                    <td>Number of Walkins</td>
                                                                    <td> Number </td>
                                                                    <td> <input type="text"></td>
                                                                </tr>
                                                            </table> --}}
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
          </table>
          <![endif]-->
                        </td>
                    </tr>
                    <tr>
                        <td class="innerpadding borderbottom" style="display:flex; justify-content:center">

                            <button class="btn" type="button"> Send </button>
                            <!-- <img class="fix" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/wide.png" width="100%" border="0" alt="" /> -->
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
    </table>
    <![endif]-->
    </td>
    </tr>
    <div style="height: 10rem"></div>
    </table>
</body>

</html>
