<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ $report->report_title }}</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      {{-- <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet"> --}}
      {{-- <link href="{{ asset('css/report.css') }}" rel="stylesheet"> --}}
      {{-- <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> --}}
      
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

      <!-- Scripts -->
      <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>

  <style>
      .content{
        background: #FAFAFF;
        border-radius: 4px;
      }

      .wholeContent{
          width: 100%;

      }
      img{
            margin-bottom: 3em;
      }
    
  </style>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light ">
       
           <nav class="navbar navbar-light ">
               <a class="navbar-brand" href="/dashboard">
                   <img src="{{ asset('css/icons/echoVC (dark).png') }}" style=" " class="d-inline align-top"  alt="" />
                 
               </a>
             </nav>
           <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
           </button>
       

    </nav>
   

    <main class="wholeContent   "> 
        <div class="col-12 " >
            <form action="/report/fill-report/{{$recipient->id}}" method="post" enctype="multipart/form-data">
                <div class="mx-auto pt-1 pl-1 col-md-6 " style="background: #FAFAFA">
                    <div class="heading mt-4  " >
                        <h2>{{ $report->report_title }}</h2>
                        <input type="hidden" name="report_title" value="{{ $report->report_title }}">
                    </div>

                    <div>
                        <textarea name="message" placeholder="Enter message here" cols="30" rows="2" style="width: 100%"></textarea>
                    </div>
        
                    <div class="sample-content">
                        {!! $report->content !!}
                    </div> 

                    <hr class="shadow">
                    <small class="text-danger"> &lowast;required</small>
                    @csrf
                        <input type="hidden" name="texts" value="{{count($texts)}}">
                        @for($i=0;$i<count($texts);$i++)
                        <div class="mt-5">
                            <div>
                                <h3> {{ $texts[$i]->title }}<small class="text-danger" style="display:{{$texts[$i]->reqd != 'true' ? 'none':''}}">&lowast;</small></h3>
                                <p class="text-wrap c">{{ $texts[$i]->desc }}</p> 
                            </div>
                            
                            <div>
                            <textarea name="text_{{$i}}" id="" class="form-control text-wrap" placeholder="Start typing here"></textarea>
                            </div>
                        </div>
                        @endfor

                        <input type="hidden" name="metrics" value="{{count($all_metrics)}}">
                        @for($j=0;$j<count($all_metrics);$j++)
                        <div class="mt-5">
                            <div>
                                <h3> {{ $all_metrics[$j]->data->title }}<small class="text-danger" style="display:{{$all_metrics[$j]->data->reqd != 'true' ? 'none':''}}">&lowast;</small></h3>
                                <p class="text-wrap c">{{ $all_metrics[$j]->data->desc }}</p> 
                            </div>
                            
                            <div>
                                <ul class="row list-unstyled col-9">
                                    <li class="col-12 p-2 d-flex justify-content-between">
                                        <p class="col-4">KPI name </p>
                                        <p class="col-4">Format </p>
                                        <p class="col-4">KPI value </p>
                                    </li>
                                    <input type="hidden" name="kpis_{{$j+1}}" value="{{count($all_metrics[$j]->kpis)}}">
                                    @for($k=0;$k<count($all_metrics[$j]->kpis);$k++)
                                    <li class="col-12 p-2 d-flex justify-content-between">
                                        <p class="col-4">{{$all_metrics[$j]->kpis[$k]->name}}</p>
                                        <p class="col-4">{{$all_metrics[$j]->kpis[$k]->format}} </p>
                                        <p class="col-4">
                                            <input type="text" placeholder="Enter value" class="form-control" name="kpi_value_{{$j}}_{{$k}}" id="">
                                        </p>
                                    </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        @endfor
                        
                        <input type="hidden" name="files" value="{{count($files)}}">
                        @for($m=0;$m<count($files);$m++)
                        <div class="pitch container ml-n3 mt-5">
                            <h3>{{ $files[$m]->title }}<small class="text-danger" style="display:{{$files[$m]->reqd != 'true' ? 'none':''}}">&lowast;</small></h3>
                            <p class="text-wrap">{{ $files[$m]->desc }}</p>
                            <button type="button" onclick="openDialog('fileid_{{$m+1}}')" class="btn btn-secondary" id="buttonid_{{$m+1}}">Upload file</button>
                            <input type="file" name="file_{{$m}}" id="fileid_{{$m+1}}" onchange="displayFileName('file_name_{{$m+1}}', 'fileid_{{$m+1}}')" hidden>
                            <span class="ml-3" id="file_name_{{$m+1}}"></span>
                        </div>
                        @endfor
                        
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block col-4"> Send</button>
                        </div>
                </div>
            
            </form>
            <div style="height: 5rem"></div>
        </div>
    </main>

    <script>

        function openDialog(file) {
            document.getElementById(file).click();
            return
        }

        function displayFileName(spanid, fileid) {
            var filename = document.getElementById(fileid).files[0].name;
            document.getElementById(spanid).textContent = filename;

            return
        }
    </script>
    
  </body>
</html>
