<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{$report->report_title}}</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="/vendor/chosen/chosen.min.css">
      <!-- Styles -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sample.css') }}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>

      <style>
      .form-control:disabled {
        background: #fff !important
      }
      </style>

  </head>
  <body>
    <div class="wrapper">

  @include('layouts.sidebar')
    </div>
    <main class="wholeContent">

      <section class="page ">
        <form action="/report/send/{{$report->id}}" method="post">
        @csrf
          <div class="d-flex justify-content-end top mobileHide" >
            <button type="button" name="button" onclick="saveReport()" class="btn btn-default mobileHide">Save & Close</button>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="submit" class="btn btn-primary btnNow mobileHide "  data-toggle="tooltip" data-placement="left" title="Send report now">Send now</button>
              <!-- <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" onclick="showCalendar()" class="btn btn-primary  mobileHide  dropdown-toggle" aria-haspopup="true"
                aria-expanded="false" data-toggle="tooltip" data-placement="top" title="Schedule report"></button>
              </div> -->
            </div>
          </div>
          <div class="d-flex justify-content-center ">
            <select name="contacts[]" id="" class="form-control mobileHide mt-5 shadow chosen-select" data-placeholder="Choose recipient emails..." multiple style="width: 50%" required>
              @for($i=0;$i<count($contacts);$i++)
              <option value="{{$contacts[$i]['id']}}">
                {{ $contacts[$i]["fname"] }} {{$contacts[$i]["lname"] }} ({{$contacts[$i]["tags"]}})
              </option>
              @endfor
            </select>
            
          </div>

          <div class="desktopView  col-md-6 mx-auto">

            <div class="heading mt-4 ">
              <h3>{{ $report->report_title }}</h3>
              <p class="not-mobile-content"> To: <span class="text-info "> Jane Magnesys for Netflix</span></p>
              
            </div>
            <hr class="shadow not-mobile-content">  

            <div class="sample-content">
              <p class="text-wrap">
                {!! $report->content !!}
              </p>
            </div>

            <input type="hidden" name="total_files" id="total_files" value="0">
            <div id="doc"></div>

            <hr class="shadow">
            <div class="not-mobile-content">
              <div class=" row recieved ">
                <h5 class="ml-3"> Recieved</h5>
                <h6 class="ml-auto">Year: 
                <select name="" id="">
                  <option value=""> 2019</option>
                  <option value=""> 2019</option>
                </select>
                </h6>
              </div>
              <div class="scrolling-wrapper  container">
                <div class="cal ml-0"><p> Sep 2019</p></div>
                <div class="cal "><p> Jan 2019</p></div>
                <div class="cal "><p> Feb 2019</p></div>
                <div class="cal "><p> Mar 2019</p></div>
                <div class="cal"><p> Apr 2019</p></div>
                <div class="cal"><p> May 2019</p></div>
                <div class="cal"><p> Jun 2019</p></div>
                <div class="cal"><p> Jul 2019</p></div>
                <div class="cal"><p> Aug 2019</p></div>
                <div class="cal"><p> Sep 2019</p></div>
                <div class="cal"><p> Oct 2019</p></div>
                <div class="cal"><p> Nov 2019</p></div>
                <div class="cal"><p> Dec 2019</p></div>
              </div>

              <div class="container  row">
                <div class="sent ml-3">
                  <p> Not sent</p>
                  <p class="text-info"> Send</p>
                </div>

                <div class="view ml-5">
                  <p> View</p>
                </div>

                <div class="view ml-4">
                  <p> View</p>
                </div>
              </div>

              <div class="walk container ml-2">
                <div class="row">
                  <p class="mr-auto">Number of Walkins</p>
                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Number
                  </button>
                  <input type="text" placeholder="Enter Value" class="p-2 ml-auto mr-4 form-control" style="width: 6em">
                </div>
                <div class="row mt-5">
                  <p class="mr-auto">Total Net Profit</p>
                  <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Currency
                  </button>
                  <input type="text" placeholder="Enter Value" class="p-2 ml-auto mr-4 form-control" style="width: 6em; ">
                </div>
              </div>

              <div class="pitch container mt-5">
                <h3> Pitch deck</h3>
                <p class="text-wrap"> Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Cumque non veritatis iusto quo recusandae asperiores esse 
                  libero doloremque aperiam mollitia amet, quis culpa tempora
                    unde veniam. Eum veritatis magni harum!</p>
                <button class="btn btn-secondary"> Upload file</button>
              </div>        
            </div>
            <div class=" mobileHide">
              <div id="text-request">
                <input type="hidden" name="total_texts" id="total_texts" value="{{count($texts)}}">
                @for($i=0;$i<count($texts);$i++)
                <div class="col section mb-5 mt-5 text-request" id="text_{{$i}}">
                  <div class="row">
                    <p>Text Title</p>
                    <p class="ml-auto "> Required </p>
                    <label class="switch mt-1 ml-2">
                      <input type="checkbox" name="text_req_{{$i}}" onclick="return false;" {{ $texts[$i]->reqd == "true" ? 'checked':'' }}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                  <div class="form-group align-form  ">
                    <input type="text" name="text_title_{{$i}}" value="{{ $texts[$i]->title }}" class="p-3 form-control" disabled >
                  </div>

                  <div class="form-group align-form">
                    <p> Description</p>
                    <textarea name="text_desc_{{$i}}" id="" class="form-control text-wrap" disabled>
                      {{ $texts[$i]->desc }}
                    </textarea>
                  </div>
                  <!-- <div class="base-kpi row ml-n3 mt-3">
                    <a href="#!" class="text-info ml-auto" onclick="removeRequest('text', {{$i}})" title="Delete request"> Remove request </a>
                  </div> -->
                </div>
                @endfor
              </div>

              <div id="metric-request">
                <input type="hidden" name="total_metrics" id="total_metrics" value="{{count($all_metrics)}}">
                @for($j=0;$j<count($all_metrics);$j++)
                <div class="col section mb-5 metric-request">
                  <div class="row">
                    <p> Metric title</p>
                    <p class="ml-auto "> Required </p>
                    <label class="switch mt-1 ml-2">
                      <input type="checkbox" name="metric_req_{{$j}}" onclick="return false;" {{ $all_metrics[$j]->data->reqd == "true" ? 'checked':'' }}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                  <div class="form-group align-form  ">
                    <input type="text" name="metric_title_{{$j}}" value="{{ $all_metrics[$j]->data->title }}" class="p-3 form-control" disabled >
                  </div>

                  <div class="form-group align-form">
                    <p> Description</p>
                    <textarea name="metric_desc_{{$j}}" id="" class="form-control text-wrap" disabled>
                      {{ $all_metrics[$j]->data->desc }}
                    </textarea>
                  </div>

                  @if(count($all_metrics[$j]->kpis) > 0)
                  <div class="kpi headed row align-form">
                    <div class="col-12" style="padding-left: 0px">
                      <div class="col-sm-5 float-left" style="padding-left: 0px"><p>KPI name</p></div>
                      <div class="col-sm-4 float-left"><p>Format</p></div>
                      <div class="col-sm-3 float-left text-right" style="padding-right: 0px"><p>KPI Value</p></div>
                    </div>
                    <input type="hidden" name="metric_{{$j}}" id="metric_{{$j}}" value="{{count($all_metrics[$j]->kpis)}}">
                    @for($k=0;$k<count($all_metrics[$j]->kpis);$k++)
                    <div class="col-12 mb-3 kpi_info_main" style="padding-left: 0px">
                      <div class="col-sm-5 float-left" style="padding-left: 0px">
                        <input type="text" class="form-control" name="kpi_name_{{$j}}_{{$k}}" value="{{ $all_metrics[$j]->kpis[$k]->name }}" disabled >
                      </div>
                      <div class="col-sm-3 float-left">
                        <button class="btn btn-secondary dropdown-toggle btn-sm text-dark" type="button" disabled> 
                          {{ $all_metrics[$j]->kpis[$k]->format }}
                        </button>
                        <!-- <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                          {{ $all_metrics[$j]->kpis[$k]->format }}
                        </button> -->
                        <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#!" onclick="changeFormat('Currency', 'kpi_format_1')">Currency</a>
                          <a class="dropdown-item" href="#!" onclick="changeFormat('Number', 'kpi_format_1')">Number</a>
                        </div> -->
                        <!-- <input type="text" class="form-control " value="Number"> -->
                      </div>
                      <div class="col-sm-4 float-left text-right" style="padding-right: 0px">
                        <input type="text" class="form-control " name="kpi_value_{{$k}}" placeholder="Enter KPI value" style="padding-right: 0px" disabled>
                      </div>
                    </div>
                    @endfor
                  </div>
                  @endif

                  <!-- <div class="base-kpi row ml-n3 mt-3">
                    <a href="#!" class="text-info" onclick="addKPI()"> <i class="fas fa-plus"></i> Add KPI</a>
                    <a href="#!" class="text-info ml-auto" onclick="addKPI()"> <i class="fas fa-trash-alt "></i> </a>
                  </div> -->
                </div>
                @endfor
              </div>

              @for ($m=0;$m<count($files);$m++)
              <div class="col section">
                <div class="row">
                  <p> File title</p>
                  <p class="ml-auto"> Required </p>
                  <label class="switch mt-1 ml-2">
                    <input type="checkbox" name="file_req_{{$m}}" onclick="return false;" {{ $files[$m]->reqd == "true" ? 'checked':'' }}>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group align-form  ">
                  <input type="text" placeholder="Pitch deck" name="file_title_{{$m}}" value="{{ $files[$m]->title }}" style="font-size: 1.3rem" class="p-4 form-control" disabled>
                </div>  
                <div class="form-group align-form">
                  <p> Upload prompt</p>
                  <textarea id="" name="file_desc_{{$m}}" class="form-control text-wrap" placeholder="Upload file description" disabled>
                    {{ $files[$m]->desc }}
                  </textarea>
                </div>

                <div class="upload ml-n3 mobileHide">
                  <button type="button" class="btn btn-secondary text-dark" disabled>
                    Upload file
                  </button>
                  <!-- <a href="" class="text-dark" data-toggle="modal" data-target="#deleteModal" ><i class="fas mt-2 fa-trash-alt float-right"></i></a> -->
                </div> 
              </div> 
              @endfor  

            </div>

            <!-- add text request --> 
            <div class="modal fade" id="addText" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Text Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <p> Text title</p>
                      <p class="ml-auto "> Required </p>
                      <label class="switch mt-1 ml-2">
                        <input type="checkbox" id="text_required" name="text_required">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="form-group align-form  ">
                      <input type="text" name="text_title" id="text_title" placeholder="Enter text title" class="p-3 form-control" >
                    </div>

                    <div class="form-group align-form">
                      <p> Description</p>
                      <textarea name="text_description" id="text_desc" class="form-control text-wrap">
                      </textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary "  data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="button" class="btn btn-primary "  data-dismiss="modal" aria-label="Close" onclick="newRequest('text')">Add</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add metrics request -->
            <div class="modal fade" id="addMetrics" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Metric</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <p> Metric title</p>
                      <p class="ml-auto "> Required </p>
                      <label class="switch mt-1 ml-2">
                        <input type="checkbox" id="metric_required" name="metric_required">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="form-group align-form  ">
                      <input type="text" name="metric_subject" id="metric_title" placeholder="Enter metrics subject" class="p-3 form-control" >
                    </div>

                    <div class="form-group align-form">
                      <p> Description</p>
                      <textarea name="metric_description" id="metric_desc" class="form-control text-wrap">
                      </textarea>
                    </div>

                    <div class="kpi headed row align-form">
                      <div class="col-12" style="padding-left: 0px">
                        <div class="col-sm-5 float-left" style="padding-left: 0px"><p>KPI name</p></div>
                        <div class="col-sm-4 float-left"><p>Format</p></div>
                        <div class="col-sm-3 float-left text-right" style="padding-right: 0px"><p>KPI Value</p></div>
                      </div>

                      
                      <div id="kpi_info">
                        <div class="col-12 mb-3 kpi_info" style="padding-left: 0px">
                          <div class="col-sm-5 float-left" style="padding-left: 0px">
                            <input type="text" class="form-control" placeholder="Enter KPI name" >
                          </div>
                          <div class="col-sm-3 float-left">
                            <button class="btn btn-secondary dropdown-toggle btn-sm btn-kpi-format" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                              Currency
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#!" onclick="changeFormat(this)">Currency</a>
                              <a class="dropdown-item" href="#!" onclick="changeFormat(this)">Number</a>
                            </div>
                          </div>
                          <div class="col-sm-4 float-left text-right" style="padding-right: 0px">
                            <input type="text" class="form-control " placeholder="Enter value" style="padding-right: 0px" disabled >
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="base-kpi row ml-n3 mt-3">
                      <a href="#!" class="text-info" onclick="addKPI()"> <i class="fas fa-plus"></i> Add KPI</a>
                      <a href="#!" class="text-info ml-auto" onclick="removeLastKPI()"> <i class="fas fa-trash-alt "></i> </a>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary "  data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="button" class="btn btn-primary "  data-dismiss="modal" aria-label="Close" onclick="newRequest('metric')">Add</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- add file request -->
            <div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete update?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p> 
                      Are you sure you want to delete this update?
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Yes, delete update </button>
                    <button type="button" class="btn btn-default btn-test " class="close" data-dismiss="modal" aria-label="Close">No, keep update</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="row btns-in-row mt-5  mobileHide">
              <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#addText"> Add text request</button>
              <button type="button" class="btn btn-secondary ml-2" data-toggle="modal" data-target="#addMetrics"> Add metrics request</button>
              <button class="btn btn-secondary ml-2"  data-toggle="modal" data-target="#uploadModal"> Add file request</button>
            </div> -->
          </div>
        </form>
      </section>
      <div style="height: 10rem"></div>
    </main>

    <script src="/vendor/chosen/chosen.jquery.min.js"></script>
    <script src="/js/reports.js"></script>
    <script>
    $(".chosen-select").chosen();
    </script>
  </body>
</html>
