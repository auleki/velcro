<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$report->report_title}}</title>
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
            background: #f6f8f1
        }

        /* img {
            height: auto;
        } */

        .content {
            width: 100%;
            /* max-width: 600px; */
            font-family: 'europa';
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 21px;
        }

        /* .innerpadding {
            padding: 30px 30px 30px 30px;
        }

        .borderbottom {
            border-bottom: 1px solid #f2eeed;
        } */

        .header-img{
            margin-bottom: 2em;
            width: 100%;
            text-align: center
        }

        .h2 {
            color: #153643;
            /* font-family: sans-serif; */
            font-family: 'europa';
            padding: 0 0 15px 0;
            font-size: 38px;
            line-height: 28px;
            font-weight: bold;
            text-align:center
        }

        .reqd {
          display: block;
          color: red
        }

        .null {
          display: none
        }

        .margin-left{
            /* margin-left:25% */
        }

    </style>
</head>

<body>
    <div style="margin-top:20px">
        <div class="header-img">
            <img  src="{{$logo}}" alt="echovc">
        </div>
        <div class="h2">
            {{$report->report_title}}
        </div>
        <div class="content margin-left">
            {!! $report->content !!}
        </div>
        <div class="content margin-left">
            @for($i=0;$i<count($texts);$i++)
            <div style="margin-bottom:20px">
                <h5 style="display:block;padding:0px 30px;padding-top:30px">{{ $texts[$i]->title }} <span class="{{$texts[$i]->reqd == 'true' ? 'reqd':'null'}}">&lowast;</span></h5>
                <p style="font-size: 15px;font-weight: lighter;display:block;padding:0px 30px">
                    {{ $texts[$i]->desc }}
                </p>
                <textarea name="" id="" cols="30" rows="5" style="font-size: 15px;font-weight: lighter;display:block;margin:0px 30px;width:80%"></textarea>
            </div>
            <hr style="width:90%">
            @endfor
        </div>
        
        <div class="content margin-left">
            @for($j=0;$j<count($all_metrics);$j++)
            <div style="margin-bottom:20px">
                <h5 style="display:block;padding:0px 30px;padding-top:30px">{{ $all_metrics[$j]->data->title }} <span class="{{$all_metrics[$j]->data->reqd == 'true' ? 'reqd':'null'}}">&lowast;</span></h5>
                <p style="font-size: 15px;font-weight: lighter;display:block;padding:0px 30px">
                    {{ $all_metrics[$j]->data->desc }}
                </p>
                <div>
                    <table style="width: 100%;padding: 0px 30px;">
                        <thead>
                            <tr>
                                <td>KPI Name</td>
                                <td>KPI Format</td>
                                <td>KPI Value</td>
                            </tr>
                        </thead>
                        <tbody>
                            @for($k=0;$k<count($all_metrics[$j]->kpis);$k++)
                            <tr>
                                <td>{{ $all_metrics[$j]->kpis[$k]->name }}</td>
                                <td>{{ $all_metrics[$j]->kpis[$k]->format }}</td>
                                <td><textarea name="" id="" cols="30" rows="10" style="height:30px"></textarea></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <hr style="width:90%">
            @endfor
        </div>
        
        <div class="content margin-left">
            @for($i=0;$i<count($files);$i++)
            <div style="margin-bottom:20px">
                <h5 style="display:block;padding:0px 30px;padding-top:30px">{{ $files[$i]->title }} <span class="{{$files[$i]->reqd == 'true' ? 'reqd':'null'}}">&lowast;</span></h5>
                <p style="font-size: 15px;font-weight: lighter;display:block;padding:0px 30px">
                    {{ $files[$i]->desc }}
                </p>
            </div>
            <hr style="width:90%">
            @endfor
        </div>
    </div>
</body>

</html>
