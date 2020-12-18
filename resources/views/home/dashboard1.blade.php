<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dashboard</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
      <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">
      <!-- Scripts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
  <style>
    .dash-board a:hover{
        opacity: 0.6;
        padding-left: 5px;
    }
    .dash-board a{
        color: #333333;
        font-size: 16px;

    }
    .exact-class{
        border-bottom: 2px solid #19B9FD;
    }
    .dashboard-list:hover {
      cursor: pointer
    }
    .dashboard-body {
      display: none
    }
    .metric_side{
        display: flex;
        margin-left: auto;
        position: relative;
        left: 15px;
        top: 10px;
    }
    a{
        color: #333333;
        font-size: 16px;
    }

    a:hover{
        color: #0c0c0c;

    }
    .custom-modal{
      width: 50rem;
      position: absolute;
      left: -5rem;
      padding: 1rem;
    }

    .hide-spinner {
      display: none !important;
    }

  </style>
<body>
    <div class="wrapper">
      @include('layouts.sidebar')
    </div>


    <main class="wholeContent mt-2  ">
     <div class="dashboard-header row mb-4">

        <div class="ml-auto" >
            {{-- href="/add_chart/{{$dashboards[0]->id}}" --}}
            <a id="add_chart"  class="btn btn-primary add_chart text-white" data-toggle="modal" data-target="#addChart">Add Chart </a>
            <!-- <button type="button" class="btn btn-dashboard ml-2" data-toggle="modal" data-target="#exampleModal">Share </button> -->
        </div>
     </div>
      <div class="mobile-dashboard-header not-desktop-content row mt-3 ml-5 d-flex justify-content-between">
        <h3> Dashboard</h3>
        <p class=""><a href="" class="text-info "> Go Back</a></p>
      </div>

      <div class="row">
        <div class="col-md-12 dashboards m col-sm-12  " id="scroll1">
          <ul class="nav notMobileContent ml-n3 mt-md-n4 fund-tabs  nav-tabs">
            @for($i=0; $i<count($dashboards); $i++)
            <li class="nav-item dropdown ml-3 mr-3">
              <a class="dashboard-list {{ $i==0 ? 'activate':'' }}" style="color:#495057;float:left;" href="#" data-id="{{$dashboards[$i]->id}}" data-tab="{{ str_replace(' ', '', $dashboards[$i]->name) }}" onclick="changeDashboard(this)" > {{ $dashboards[$i]->name }}</a>
              <a class=" dropdown-toggle ml-1" style="color:#495057;float:left;" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
              <div class="dropdown-menu">
                <a class="dropdown-item" data-tooltip="Delete Dashboard" href="#" onclick="deleteDashboard('{{$dashboards[$i]->id}}')">Delete</a>
              </div>
            </li>
            @endfor
            <li class="nav-item">
              <a class="nav-link" href="#" data-tooltip="Add Dashboard" data-tooltip-location="bottom" data-toggle="modal" data-target="#addModal" style="color: #000000" ><i class="fas fa-plus font-weight-bold" ></i></a>
            </li>
          </ul>
        </div>
      </div>

      {{-- <div class="dashboards mt-5 ml-2 ">

          <ul class="row list-unstyled dash-board" id="myTab" role="tablist">
            @for($i=0; $i<count($dashboards); $i++)
            <li style="width:auto">
              <a class="{{ $i==0 ? 'activate':'' }} list-inline-item dashboard-list {{ $i>0 ? 'ml-3':'' }}" data-id="{{$dashboards[$i]->id}}" data-tab="{{ str_replace(' ', '', $dashboards[$i]->name) }}" onclick="changeDashboard(this)" > {{ $dashboards[$i]->name }}
              </a>
                <i class="ml-auto dropdown-toggle" id="dashboard_{{$i}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </i>
                <div aria-labelledby="dashboard_{{$i}}">

                   <a class="dropdown-item" href="#" onclick="deleteDashboard('{{$dashboards[$i]->id}}')">Edit</a>

                </div>
            </li>
            @endfor
            <li class="ml-3 list-inline-item"> <a href="" data-toggle="modal" data-target="#addModal"> <i class="fas fa-plus"></i>  </a></li>
          </ul>
      </div> --}}

      <!-- Add Dashboard -->

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="/create-dashboard" method="post">
            @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Name your dashboard</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="text" name="dashboard" class="form-control" placeholder="">
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> Create dashboard </button>
                <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- End of add dashboard modal -->

      <div class="mobile-dashboard-body  mt-3 row ">
        <div class="btn-group ml-4">
            <p class="mr-2" style="margin-bottom:0px;font-size:1.5rem;" id="mobile_dashboard">{{$dashboards[0]->name}}</p>
            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" style="box-shadow:none" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">

            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
              @for($i=0; $i<count($dashboards); $i++)
              <a class="dropdown-item" href="#" data-id="{{$dashboards[$i]->id}}" data-tab="{{ str_replace(' ', '', $dashboards[$i]->name) }}" onclick="changeDashboard(this, 'mobile')">{{ $dashboards[$i]->name }}</a>
              @endfor
            </div>
        </div>
        <!-- <button class="btn btn-share ml-1 float-right"  data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-share-alt"></i></button> -->
          <a role="button" href="#" class="btn btn-primary float-right add_chart" id="add_chart" data-toggle="modal" data-target="#addChart"> Add Chart </a>

      </div>

      {{-- <hr> --}}

      <div class="body">
        @for($j=0; $j<count($result); $j++)
        <div class="col-md-10 col-sm-12 mt-5 pt-5 row justify-content-center {{ $j > 0 ? 'dashboard-body' : '' }}" id="{{ str_replace(' ', '', $dashboards[$j]->name) }}">
          @for($k=0; $k<count($result[$j]); $k++)
          <div class="col-md-5 col-sm-6 ml-5" id="chart_{{$k}}">
            <div class=" ml-1 mt-3">
              <h4>{{$graph_names[$j][$k]->title}}</h4>
              <div class="row " style="margin-left: .1em">
                <p id="sub_title_{{$k}}"></p>
                <i class="ml-auto dropdown-toggle" id="dropdown_{{$k}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </i>
                <div class="dropdown-menu" aria-labelledby="dropdown_{{$k}}">
                  <!-- <a class="dropdown-item" href="#" onclick="editChart('{{$graph_names[$j][$k]->id}}')">Edit</a> -->
                  <a class="dropdown-item" href="#!" onclick="deleteChart('chart_{{$k}}', '{{$graph_names[$j][$k]->id}}')">Delete</a>
                </div>
              </div>
            </div>
          <div>
            <canvas id="{{str_replace(' ', '', $dashboards[$j]->name)}}{{$k}}" width="400" height="400"></canvas>
            <script>
              var data = @json($result[$j][$k]);
              var colors = @json($colors[$j][$k]);
              var names = @json($names[$j][$k]);
              var labels = [];
              var datasets = [];
              var sub_title = "";

              // console.log(data)
              for (let m = 0; m < data.length; m++) {
                const each = data[m];
                const dataArr = [];

                for (let n = 0; n < each.length; n++) {
                    const res = each[n];

                  if (m <= 0) {
                      if (n == 0 || n == 12 || n == 24) {
                          const label = res['date']
                          labels.push(label)
                      } else {
                          const label = res['date'].split(' ')[0]
                          labels.push(label)
                      }
                  }

                  var str = res["value"].toString();
                  var value = str.split("$")[
                      str.split("$").length - 1
                  ];

                  // console.log(value)
                  var number = Number(value.split(",").join(""));

                  // console.log(value)

                  // return;

                  dataArr.push(number)
                }

                var dataset = {
                  minBarLength: 9,
                  label: names[m],
                  data: dataArr,
                  backgroundColor: colors[m],
                  borderWidth: 1
                }

                if (sub_title == "") {
                  sub_title = names[m]
                } else {
                  sub_title += " & " + names[m]
                }

                datasets.push(dataset)
              }

              // console.log(labels,datasets)
              document.getElementById("sub_title_{{$k}}").innerHTML = sub_title;
              var ctx = document.getElementById("{{str_replace(' ', '', $dashboards[$j]->name)}}{{$k}}").getContext('2d');
              var myChart = new Chart(ctx, {
                  type: "{{$chart_type[$j][$k]}}",
                  data: {
                      labels: labels,
                      datasets: datasets
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true,
                                  stacked: true
                              }
                          }]
                      }
                  }
              });
            </script>
          </div>
          </div>
          @endfor
        </div>
        @endfor
      </div>

    </main>

          <!-- Add Chart -->

          <div class="modal fade centered" id="addChart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content custom-modal" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-xl-7 col-md-7 col-sm-12 mobileModal ">

                            <div class="body">
                                <div class="ml-n5 col-sm-12 mt-3 pt-3 row justify-content-center">
                                <div class="col-md-11 col-sm-6 ml-5  ">
                                    <div class=" ml-1 mt-3">
                                    {{-- <h4>Coca-Cola</h4> --}}
                                    <div class="row " style="margin-left: .1em">
                                        <p id='chart_title_p'></p>
                                        <!-- <i class="fas fa-chevron-down ml-auto"> </i> -->
                                    </div>
                                    </div>
                                    <div>
                                      <div class="d-flex justify-content-center hide-spinner" id="spinner">
                                          <div class="spinner-border text-primary" role="status">
                                              <span class="sr-only">Loading...</span>
                                          </div>
                                      </div>
                                      <canvas id="add_chart_canvas" width="400" height="400"></canvas>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 border-left">
                            <div>
                                <div class="row d-flex justify-content-between">
                                    <div class="">
                                       <ul class="list-unstyled row metric_side">
                                            <li class="exact-class"> <a style="cursor: pointer" class="text-dark" id="metric" > Metrics </a></li>
                                            <!-- <li class="ml-3"> <a style="cursor: pointer" class="text-black-50" id="export"> Exports</a></li> -->
                                        </ul>
                                    </div>

                                    <div class="">
                                        <a href="" class="btn btn-default text-dark" class="close" data-dismiss="modal"> Cancel </a>
                                        <a href="#" class="btn btn-primary" id="create_chart" data-dashboard="{{$dashboards[0]->id}}" onclick='createChart(this)'> Save </a>
                                    </div>
                                </div>

                                <div class="form mt-4 modal-split">
                                    <form action="" class="form-group" id='add_metric_form'>
                                        <div class="form-group">
                                            <label for=""> Chart title<small class="text-danger"> &lowast;</small></label>
                                            <input type="text" placeholder="Sales and Exit" class="form-control" id='chart_title'>
                                        </div>

                                        <div class="form-group">
                                            <label for=""> Chart type<small class="text-danger"> &lowast;</small></label>
                                            <select name="" id="chart_type" class="form-control">
                                                <option value="line"> Line</option>
                                                <option value="bar"> Bar</option>
                                                <option value="radar"> Radar</option>
                                                <option value="pie"> Pie</option>
                                            </select>
                                        </div>


                                        <div class="form-group" id='metrics-cont'>
                                            <div class="row ml-1 ">
                                                <p class=""> Metric</p>
                                                <p class="ml-auto mr-3 text-info">New metric</p>
                                            </div>
                                            <select name="metric" id="metric" class="form-control mt-n3" onchange="selectMetric(this)" autocomplete="off">
                                                <option value=""> Select metric source </option>
                                                @foreach($sources as $source)
                                                <optgroup label="{{$source->pre}} {{$source->name}}" data-group='{{$source->id}}_{{$source->tool}}_{{$source->name}}' style="font-size:12px">
                                                @foreach($source->metrics as $metric)
                                                <option value='{{$source->tool == "google"? $metric->column_name."_".$metric->row : $metric}}' data-row="{{$source->tool == 'google'? $metric->row : $metric}}">{{$source->tool == 'google'?$metric->name:$metric}}</option>
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group" id="selected_metric"></div>
                                    </form>
                                </div>


                         </div>
                    </div>
                </div>

              </div>
            </div>
          </div>
          <!-- End of add chart modal -->

           <!-- Edit Chart -->


           <div class="modal fade centered" id="editChart" class="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content custom-modal" >

                <div class="modal-body">
                    <div class="row">


                            <div class="col-xl-7 col-md-7 col-sm-12 mobileModal">

                                <div class="body">
                                    <div class="ml-n5 col-sm-12 mt-3 pt-3 row justify-content-center">
                                    <div class="col-md-11 col-sm-6 ml-5  ">
                                        <div class=" ml-1 mt-3">
                                        {{-- <h4>Coca-Cola</h4> --}}
                                        <div class="row " style="margin-left: .1em">
                                            <p> Sales and Exit</p>
                                            <i class="fas fa-chevron-down ml-auto"> </i>
                                        </div>
                                        </div>
                                        <div>
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 border-left">

                            <div>

                                <div class="row d-flex justify-content-between">
                                    <div class="">
                                        <ul class="list-unstyled row metric_side">
                                            <li class=""> <a style="cursor: pointer" class="text-black-50" id="metric" > Metrics </a></li>
                                            <li class="exact-class ml-3"> <a style="cursor: pointer" class="text-dark" id="export"> Exports</a></li>
                                        </ul>
                                    </div>

                                    <div class="">
                                        <a href="" class="btn btn-default text-dark" class="close" data-dismiss="modal"> Cancel </a>
                                        <a href="" class="btn btn-primary "> Save </a>
                                    </div>
                                </div>

                                <div class="form mt-4 modal-split">
                                    <form action="" class="form-group">
                                        <div class="form-group">
                                            <label for="">Size</label>
                                            <select name="" id="" class="form-control mt-n2">
                                                <option value=""> Powerpoint (16:1) </option>
                                                <option value=""> Standard (600 x 400) </option>
                                            </select>
                                        </div>

                                        <p class="mt-4"> Format</p>
                                        <div class="form-check mt-n2">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                            <label class="form-check-label" for="exampleRadios1">
                                              Microsoft Excel (.xlxs)
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" checked>
                                            <label class="form-check-label" for="exampleRadios2">
                                              PNG
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" >
                                            <label class="form-check-label" for="exampleRadios3">
                                              PDF
                                            </label>
                                          </div>

                                          <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                              Save to Google drive as CSV file
                                            </label>
                                          </div>

                                          <button class="btn btn-dashboard mt-4 "> Export</button>
                                    </form>
                                </div>


                         </div>
                    </div>
                </div>

              </div>
            </div>
          </div>
          <!-- End of edit chart modal -->

    <script>

        if($("#metric").on( "click", function() {
              $('#addChart').modal('hide');
        })) {
            //trigger next modal
            $("#export").on( "click", function() {
                $('#editChart').modal('show');
            });
        }

    </script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
    <script src="/js/dashboard.js"></script>
    <script src='/js/selectMetric.js'></script>
    <script src='/js/createChart.js'></script>
    @include('vendor.lara-izitoast.toast')
</body>
</html>
