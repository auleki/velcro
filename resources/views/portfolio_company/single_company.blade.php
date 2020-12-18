
<?php
  use App\Services\Color;
  use Storage as Storage;
  use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$companyData->c_name}}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="/vendor/chosen/chosen.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>

    <link href="{{ asset('css/company.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('css/select2-bs4.css') }}" rel="stylesheet">

    <style>
      html {
        height: 100%;
      }

      body {
        height: 100%;
        margin: 0;
        overflow: hidden;
      }

      .title, .reports-part {
        margin: 0;
        height: 100%;
      }

      .details {
        overflow-y: scroll;
        height: 100%;
        box-sizing: content-box;
        position: absolute;
        width: 94%;
      }

      @media (min-width: 600px){

      .col-md-8{
        flex: 0 0 60.6666666667%;
        max-width: 60.6666666667%;
      }
    }

      @media(max-width: 600px) {
          .details{
              width: auto;
          }
          .page-setup{
            position: relative;
            left: 0;
            z-index: -1;
          }
          body{
              overflow-y: scroll;
          }
          .backText{
              position: absolute;
              left: 4rem;
              top: -1rem;
          }

          .company-logo{
            margin: 1rem;
            min-height: 30vh;
            font-size: 6rem;
          }

          .image-company{
            width: 60vw;
            margin: 2rem 4rem 2rem 4rem;
            border: .7px solid #dddddd;
            height: 30vh;
            border-radius: 4px;
          }
      }

      #kpis_chosen, #company_chosen, #round_chosen, #fund_chosen {
        width: 100% !important
      }

      /* .nav-link {
        padding: .5rem .5rem;
      } */

      .hide-spinner {
      display: none !important;
    }

    </style>

  </head>
  <body style="">
    <div class="wrapper">
      @include('layouts.sidebar')
    </div>


    <section class="title">
      <div class="back page-setup border-bottom  mb-4" >
        <p style="color: #1B63DC;" class="backText" > <i class="fas fa-chevron-left mr-1"> </i><a href="/company_list" style="color: #1B63DC;">Portfolio companies </a></p>
        <div class="col-md-10 mt-1 mb-1 p-1">
          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          {{--  <img src="uploads/{{ Session::get('file') }}">  --}}
          @endif
          @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          {{--  <img src="uploads/{{ Session::get('file') }}">  --}}
          @endif
        </div>

      </div>


      <div class="row page-setup">
        <div class="col-md-8 col-sm-12 ">
          <div class="row ml-n4">
            <div class="col-md-2 col-sm-10 ">
              <img src="https://logo.clearbit.com/{{$companyData->website}}" onerror="showPlaceholder('{{$companyData->id}}')" id="logo_{{$companyData->id}}" class="image-company" alt="">
              <div class="text-center text-white company-logo" id="placeholder_{{$companyData->id}}" style="display:none;background:{{Color::random_color()}};font-size:4rem;font-weight:700">
                {{$companyData->c_name[0]}}
              </div>
            </div>

            <div class="col-10 ">
              <h3> {{$companyData->c_name}}</h3>
              <p>
              {{$companyData->description}}
              </p>
            </div>
          </div>

          <?php
          $is_url = filter_var($companyData->website, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
          if($is_url){
            $url = $companyData->website;
          } else {
            $url = 'https://'.$companyData->website;
          }
          ?>


            <div class="info row  mt-2" >
              <ul class="list-unstyled row p-2" style="background-color:#FAFAFA;">
                <!-- <i class="fas ml-3 fa-toggle-on toggler" style=""></i> -->
                <li class="ml-3 other" data-tooltip="country"><i class="fas fa-map-marker-alt"></i>{{$companyData->country}}</li>
                <li class="ml-3 other" data-tooltip="website"> <a href="{{$url}}" target="_blank"><i class="fas fa-globe"></i> {{$companyData->website}}</a></li>
                <li class="ml-3 other " data-tooltip="email"><i class="far fa-envelope"></i> {{$companyData->email}}</li>
                <li class ="ml-3" data-tooltip="tags"><i class="fas fa-tags"></i> {{$companyData->tags}}</li>

              </ul>
              <div class="row ml-auto mr-0" >
                <p class="other" style="color:#7AEF1F">Open</p>
                <label class="switch mt-1 ml-1">
                  <input type="checkbox" id="{{$companyData->id}}" {{$companyData->status == 'open'? '':'checked'}} name="open_exit" onchange="openExit(this)" autocomplete="off">
                  <span class="slider round" ></span>
                </label>
                <p class="open ml-2 text-muted" >Exit</p>
              </div>
            </div>


          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link company-tab active" href="#description" onclick="setActive(this)">Description</a>
            </li>
            <li class="nav-item">
              <a class="nav-link company-tab" href="#comparison" onclick="setActive(this)">Comparison</a>
            </li>
            <li class="nav-item">
              <a class="nav-link company-tab" href="#performance" onclick="setActive(this)">Performance</a>
            </li>
            <li class="nav-item">
              <a class="nav-link company-tab" href="#funding" onclick="setActive(this)">Funding</a>
            </li>
            <li class="nav-item">
              <a class="nav-link company-tab" href="#contact" onclick="setActive(this)">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link company-tab" href="#files" onclick="setActive(this)">Files</a>
            </li>
            <li class="nav-item">
              <a class="nav-link company-tab" href="#notes" onclick="setActive(this)">Notes</a>
            </li>
            <!-- <li class="nav-item ml-auto">
              <a class="nav-link btn btn-share" href="#">Share</a>
            </li> -->
          </ul>

          <div class="details" ">
            <div class="container" id="container">
              <div class="row" id="description">
                <div style="width:100%">
                  <h5 class="text-uppercase float-left" style="width:90%"> Description </h5>
                  <p class="ml-auto" data-toggle="modal" data-target="#editDesc" data-tooltip="Update {{$companyData->c_name}} description" > Edit <i class="fas fa-pencil-alt"> </i></p>
                </div>
                <div style="width:100%">
                  <p class="text-wrap">
                    {{$companyData->desc}}
                  </p>
                </div>

                <!-- Edit description modal -->
                <div class="modal fade" id="editDesc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addKpi">Update Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/portfolio-company/{{$companyData->id}}?type=desc" method="post" id="update_desc">
                        @csrf
                          <div class="form-group mb-2">
                            <label for=""> Description </label>
                            <textarea name="desc" id="" cols="30" rows="3" style="padding:5px;width:100%">{{$companyData->desc}}</textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> -->
                        <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close" onclick="submit('update_desc')">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="comparison">
                <div class="row mt-5">
                  <h5 class="text-uppercase float-left"> Comparison </h5>
                  <a href="#" class="ml-auto btn btn-info text-white btn-sm  mb-1" data-toggle="modal" data-target="#addCompany" title="Add company">
                    Add Chart
                  </a>
                </div>
                <div class="row">
                  @for($i=0;$i<count($compared_data);$i++)
                  <div class="col-md-6 col-sm-12 ml-n3">
                    <h5 class=" text-capitalize">{{$compared_data[$i]['company']}}</h5>
                    <div class="row ml-1 mt-3">
                      <h5>{{$compared_data[$i]['name']}}</h5>
                      <i class="fas fa-chevron-down ml-auto" id="dropdown_{{$i}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </i>
                      <div class="dropdown-menu" aria-labelledby="dropdown_{{$i}}" style="padding:0rem;min-width:5rem">
                        <!-- <a class="dropdown-item" href="#" onclick="editChart('')">Edit</a> -->
                        <a class="dropdown-item" href="#!" onclick="deleteCompany('{{$compared_data[$i]['chart']}}')" style="padding:.25rem .25rem">Delete</a>
                      </div>
                    </div>
                    <div>
                      <canvas id="myChart{{$i}}" width="400" height="400"></canvas>
                      <script>
                        var ctx = document.getElementById('myChart{{$i}}').getContext('2d');

                        var data = @json($compared_data[$i]['graph']);
                        var colors = @json($compared_data[$i]['colors']);
                        var names = @json($compared_data[$i]['name']);
                        var labels = [];
                        var datasets = [];

                        var name_arr = names.split('/');

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

                            var number = Number(value.split(",").join(""));

                            dataArr.push(number)
                          }

                          var dataset = {
                            minBarLength: 9,
                            label: name_arr[m],
                            data: dataArr,
                            backgroundColor: colors[m],
                            borderWidth: 1
                          }

                          datasets.push(dataset)
                        }
                        var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                            labels: labels,
                            datasets: datasets
                          },
                          options: {
                            scales: {
                              yAxes: [{
                                gridLines: {
                                  display: false,
                                  // drawOnChartArea: false,
                                  // drawTicks: false
                                },
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

                  <!-- <div class="col-6 funding ml-3">
                    <h5 class=" text-capitalize"> Johnson & Johnson</h5>

                    <div class="row ml-1 mt-3">
                      <h5>TVPI</h5>
                      <i class="fas fa-chevron-down ml-auto"> </i>
                    </div>
                    <canvas id="line-chart" height="400" width="400"> </canvas>
                    <script>
                    let ctxc = document.getElementById('line-chart').getContext('2d');

                      let lineChart = new Chart(ctxc, {
                        type: 'line',
                        data: {

                          labels: [2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019],
                          datasets: [{
                            lineTension: 0,
                            label: 'TVPI',
                            data: [0.5, 2, 2.5, 1, 2.5, 3.5, 2, 3.7, 4, 4],
                            backgroundColor: [
                              // RGBA(122,239,31,1)
                              'rgba(122,239, 031, 1)',
                          ],
                          }]
                        },
                        options: {
                          bezierCurve: false
                        }
                      })
                      </script>
                  </div> -->
                </div>

                <!--Add company modal -->
                <div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="d-flex justify-content-center hide-spinner" id="spinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <form action="/portfolio-company/{{$companyData->id}}?type=compare" method="post" id="compare" autocomplete="off">
                        @csrf
                          <div class="form-group mb-2">
                            <label for=""> Select Company </label>
                            <select name="company" id="company" class="form-control shadow  chosen-select" data-placeholder="Select company" single style="width:100%" required>
                              <option value="" selected>Select company</option>
                              @foreach($companies as $company)
                              <option value="{{$company->id}}">{{$company->c_name}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group mb-2 mt-5 kpi_div">
                            <label for=""> Select KPIs </label>
                            <select name="kpis[]" id="kpis" class="form-control chosen-select" data-placeholder="Choose from the following..." multiple required>

                            </select>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> -->
                        <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close" onclick="submit('compare')">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="performance">
                <div class="row mt-5 performance">
                  <h5 class="text-uppercase float-left"> Performance </h5>
                  <a href="#" class="ml-auto btn btn-info text-white btn-sm  mb-1" data-toggle="modal" data-target="#addPerformance" title="Add company">
                    Add Chart
                  </a>
                </div>
                <div class="row other">
                  @for($h=0;$h<count($performances);$h++)
                  <div class="col-6 ml-n3"  >
                    <div class="row mt-3" style="margin-left: .1rem" >
                      <h5>{{$performances[$h]['name']}}</h5>
                      <i class="fas fa-chevron-down ml-auto"> </i>
                    </div>
                    <canvas id="muChart{{$h}}" width="400" height="400"></canvas>
                    <script>
                      var secondCtx = document.getElementById('muChart{{$h}}').getContext('2d');

                      var data = @json($performances[$h]['chart']);
                      var colors = @json($performances[$h]['colors']);
                      var names = @json($performances[$h]['labels']);
                      var labels = [];
                      var datasets = [];

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

                        datasets.push(dataset)
                      }
                      var secondChart = new Chart(secondCtx, {
                        type: 'bar',
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
                  @endfor
                </div>

                <!--Add performance chart modal -->
                <div class="modal fade" id="addPerformance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Performance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/company/add-chart/{{$companyData->id}}" method="post" id="add_performance_chart" autocomplete="off">
                        @csrf
                          <div class="form-group mb-2">
                            <label for=""> Name </label>
                            <input type="text" class="form-control" name="name" placeholder="Enter performance name" required>
                          </div>

                          <div class="form-group mb-2 mt-3 kpi_div">
                            <label for=""> Select KPIs </label>
                            <select name="kpis[]" id="kpis" class="form-control chosen-select" data-placeholder="Choose from the following..." multiple required>

                              @foreach($kpis as $kpi)
                              <optgroup label="{{$kpi->name}}">
                              @if($kpi->name == 'Report')
                              @foreach($kpi->data as $kpi_data)
                              <option value="{{'report_'.$kpi_data}}">{{$kpi_data}}</option>
                              @endforeach
                              @else
                              @foreach($kpi->data as $kpi_data)
                              <option value="{{'google_'.$kpi_data->column_name.'_'.$kpi_data->row}}">{{$kpi_data->name}}</option>
                              @endforeach
                              @endif
                              </optgroup>
                              @endforeach
                            </select>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> -->
                        <button type="button" class="btn btn-primary mr-auto"  aria-label="Close" onclick="submit('add_performance_chart')">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="funding" id="funding">
                <div class=" mt-5 row">
                  <h4 class="text-uppercase"> Funding </h4>
                  <p  class="ml-5 text-muted " style="color: #000000"> Show:
                    <div class="dropdown show">
                      <a class="btn btn-default mt-n2 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All fund
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#" onclick="selectFund('all', '{{$companyData->id}}')">All fund</a>
                        @foreach($funds as $fund)
                        <a class="dropdown-item" href="#" onclick="selectFund('{{$fund->id}}', '{{$companyData->id}}')">{{$fund->name}}</a>
                        @endforeach
                      </div>
                    </div>
                  </p>

                  <div class="col-3 float-right">
                    <div class="d-flex justify-content-center">
                      <a href="" class="text-dark" data-target="#addRound" data-toggle="modal"> <i class="fas fa-plus"></i> Add round </a>
                    </div>
                  </div>
                </div>

                <div class="row other" >
                  @foreach($company_funds as $c_fund)
                  <div class="col-6 ml-n3">
                    <div class="panel-group col-12" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default ">
                        <div class="panel-heading row" role="tab" id="headingActivity">
                          <p class="lead text-muted">
                            <a role="button" data-toggle="collapse" style="color:#333333" data-expanded="true" data-parent="#accordion" href="#collapseActivity{{$c_fund->id}}" aria-expanded="true" aria-controls="collapseOne">
                              {{$c_fund->round}}
                            </a>
                          </p>
                          <!-- <button class="btn  ml-auto mt-n2"> <input type="date" class="form-control" placeholder="2020"></button> -->
                          <!-- <p class="text-info ml-auto"> <i class="fas fa-plus"></i> New note</p> -->
                        </div>
                        <div id="collapseActivity{{$c_fund->id}}" class="panel-collapse collapse show in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body ml-n3 ">

                            <div class="row col-12">
                              <p class="text-capitalize"> Commited</p>
                              <p class="capitalize ml-auto"> {{ $c_fund->committed }} </p>
                            </div>

                            <?php
                            $tranches = $c_fund->tranches()->get();
                            ?>
                            @for($r=0;$r<count($tranches);$r++)
                            <div class="row col-12">
                              <p class="text-capitalize">Tranche{{$r+1}}:</p>
                              <p class="mx-auto">{{date('d M Y', strtotime($tranches[$r]->tranche_date))}}</p>
                              <p class="capitalize ml-auto">{{$tranches[$r]->value}}</p>
                            </div>
                            @endfor
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>

                <!-- Add round modal -->
                <div class="modal fade" id="addRound" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:25%">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addKpi">Add round</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/add-round/{{$companyData->id}}" method="post" id="new_round">
                        @csrf
                          <div class="form-group">
                            <label for=""> Fund round</label>
                            <select name="round" id="round" class="form-control chosen-select" data-placeholder="Select round" single style="width:100%">
                              <option value="Seed">Seed</option>
                              <option  value="Series A">Series A</option>
                              <option  value="Series B">Series B </option>
                              <option  value="Series C">Series C</option>
                              <!-- <option  value="">Custom</option> -->
                            </select>
                          </div>

                          <div class="form-group">
                            <label for=""> Fund group</label>
                            <select name="fund" id="fund" class="form-control chosen-select" data-placeholder="Select fund" single style="width:100%">
                              @foreach($funds as $fund)
                              <option value="{{$fund->id}}">{{$fund->name}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for=""> Commited</label>
                            <div class="input-group">
                              <input type="text" name="committed" class="form-control" >
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <select name="committed_currency" id="">
                                    <option value="$"> USD </option>
                                    <option value="£"> GBP </option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <p class="small"> Tranche 1</p>
                            <label for=""> Tranche value</label>
                            <div class="input-group">
                              <input type="text" name="tranche_value" class="form-control" >
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <select name="tranche_currency" id="">
                                    <option value="$"> USD </option>
                                    <option value="£"> GBP </option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="">Tranche funding date</label>
                            <input type="date" name="tranche_date" class="form-control">
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary mr-auto"  aria-label="Close" onclick="submit('new_round')">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="contact mt-4" id="contact">
                <h4 class="text-uppercase"> contact </h4>
                <div class="row ml-1 mt-5">
                  @foreach($company_contacts as $comp_contact)
                  @if($comp_contact)
                  <div class="col-6" data-toggle="modal" data-target="#removeContact{{$comp_contact->id}}">
                    <div class="row">
                      <div>
                        <button class="btn btn-info rounded-circle p-4"  type="button" style="background:{{Color::random_color()}} !important" >{{$comp_contact->fname[0].$comp_contact->lname[0]}}</button>
                      </div>
                      <div class="col">
                        <p>{{$comp_contact->fname. ' ' .$comp_contact->lname}}</p>
                        <p>{{$comp_contact->title}}</p>
                        <p>{{$comp_contact->email}}</p>
                        <p>{{$comp_contact->phoneNo}}</p>
                      </div>
                    </div>
                  </div>

                  <!-- remove contact modal -->
                  <div class="modal fade" id="removeContact{{$comp_contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addKpi">Remove Contact</h5>
                          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> -->
                        </div>
                        <div class="modal-body">
                          <div class="head">
                            <p style="font-size:1rem">Are you sure you want to remove this contact from this company?</p>
                            <button type="button" class="btn btn-danger mr-auto  "  aria-label="Close" onclick="window.location.href='/company/remove-contact/{{$comp_contact->id}}?company={{$companyData->id}}'">Yes, remove contact</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">No, keep contact</button>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <!-- {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> --}}
                          <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close" onclick="submit('remove_contact{{$comp_contact->id}}')">Save</button> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @endforeach
                </div>
                <a  href="" class="text-black-50" data-toggle="modal" data-target="#addContact"><i class="fas fa-plus ml-2" style="font-size: 1.2rem; color: #666666"></i> Add contact</a>

                <!-- Add contact modal -->
                <div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addKpi">Add contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/portfolio-company/{{$companyData->id}}?type=contact" method="post" id="add_contact">
                        @csrf
                          <div class="form-group mb-2">
                            <label for=""> Contact </label>
                            <select name="contact" id="" class="form-control">
                              @foreach($contacts as $contact)
                              <option value="{{$contact->id}}">{{$contact->fname}} {{$contact->lname}}</option>
                              @endforeach
                            </select>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> --}}
                        <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close" onclick="submit('add_contact')">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              <div>

              <div class="mt-5 files" id="files">
                <h4 class="text-uppercase">files </h4>
                <div class="row   mt-3">
                  <div class="col-8">
                    <p class="lead font-weight-700" >
                    @if ($files->count() > 0)
                      @foreach ($files as $file)
                        @if ($file->type == 'google')
                      <a class="lead font-weight-700 text-black-50" href="{{ Storage::cloud()->url($file->efile()->first()->path) }}" target="_blank"> <i class="fas fa-file" style="font-size: 1.3rem"></i> <span style="font-size:14px">{{ $file->efile()->first()->name }}</span> </a>
                        @else
                      <a download="{{ $file->name }}" title="{{ $file->name }}" class="lead font-weight-700 text-black-50" href="{{$file->efile()->first()->path}}"> <i class="fas fa-file" style="font-size: 1.3rem"></i> <span style="font-size:14px">  {{ $file->efile()->first()->name }}</span></a>
                        @endif
                      <br>
                      @endforeach
                    @else
                      <i class="fas fa-file" style="font-size: 1.3rem"></i> No file uploaded
                    @endif
                    </p>
                  </div>

                  <div class="col-md-4 col-sm-12">
                    <div class="dropdown ml-4">
                      <a href="#" class="btn btn-info text-white btn-sm  mb-1 dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-plus ml-2"></i></li> Add File
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <small class="ml-1 text-secondary">Share file </small>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-toggle="modal" role="button" data-target="#addGoogleFile" style="font-size: 14px;" type="button"><img src="{{ asset('css/icons/fromdrive.png') }}" style="height: 16px; width: 16px; color:#717171; " /> Google Drive</button>
                        <button class="dropdown-item " style="font-size: 14px;" id="addFile" data-target="#addLocalFile" data-toggle="modal"><img src="{{ asset('css/icons/laptop.png') }}" style="height: 16px; width: 16px; color:#717171;"/> Your computer</button>
                        <button class="dropdown-item " style="font-size: 14px;" id="cfilemodal" data-target="#cfilemodal" data-toggle="modal"><img src="{{ asset('css/icons/file.png') }}" style="height: 16px; width: 16px; color:#717171; "/> echoVC PMS files</button>
                        <!-- <button class="dropdown-item" type="button">Something else here</button> -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Add google file modal -->
                <div class="modal fade" id="addGoogleFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addFile">Select File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="/portfolio-company/{{$companyData->id}}?type=google" id="google">
                          @csrf
                          <div class="form-group mb-2">
                            <label for="" aria-label>Select File: </label>
                            <select name="file" id="" class="form-control">
                              @foreach($google_files as $file)
                              <option value="{{$file['name']}}___{{$file['mimetype']}}___{{$file['basename']}}___{{$file['size']}}">{{$file['name']}}</option>
                              @endforeach
                            </select>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn mr-auto btn-primary" onclick="submit('google')">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- End add file -->

                  <!-- Add local file modal -->
                <div class="modal fade" id="addLocalFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addKpi">Add File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/portfolio-company/{{$companyData->id}}?type=local" method="post" id="local" enctype="multipart/form-data">
                        @csrf
                          <div class="form-group mb-2">
                            <label for=""> File </label>
                            <input type="file" name="file" id="" class="class="form-control"">
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> --}}
                        <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close" onclick="submit('local')">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="notes mt-5 " id="notes">
                <h4 class="text-uppercase"> Notes</h4>
                @foreach($notes as $note)
                <div class="col-6 p-1 rounded mt-4" style="background: #F2F3F5;">
                  <p class="ml-3">
                  @if($note->contact()->first())
                  <a href="#" data-toggle="modal" data-target="#viewContact{{$note->contact()->first()->id}}" style="color:#19B9FD">{{$note->contact()->first()->fname}}</a>
                  @endif
                   {{$note->note}}</p>
                  <small class="ml-3">{{date("F jS, Y", strtotime($note->created_at))}} at {{date("h:m:A", strtotime($note->created_at))}}</small>
                </div>
                @if($note->contact()->first())
                <div class="modal fade" id="viewContact{{$note->contact()->first()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addKpi">Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row pl-2">
                          <div>
                            <button class="btn btn-info rounded-circle p-4"  type="button" style="background:{{Color::random_color()}} !important" >{{$note->contact()->first()->fname[0].$note->contact()->first()->lname[0]}}</button>
                          </div>
                          <div class="ml-3">
                            <h4>{{$note->contact()->first()->fname}} {{$note->contact()->first()->lname}}</h4>
                            <p>{{$note->contact()->first()->email}}</p>
                            <p>{{$note->contact()->first()->phoneNo}}</p>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> -->
                        <!-- <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close" onclick="submit('update_desc')">Save</button> -->
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
                <div class="row ml-n2 mt-5 col-9">
                  <table id="contact_table" class="table table-hover" style="position:absolute;margin-bottom:5rem;bottom:1rem;z-index:1000000;background:#fff;display:none; width:200px">
                    <tbody>
                      @foreach($company_contacts as $comp_contact)
                      @if($comp_contact)
                      <tr>
                        <td data-name="{{$comp_contact->fname}}" data-id="{{$comp_contact->id}}" style="padding:.25rem" onclick="selectContact(this)">{{$comp_contact->fname. ' ' .$comp_contact->lname}}</td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                  <form action="/company/send-note/{{$companyData->id}}" method="post" style="width:100%">
                    @csrf
                    <input type="hidden" id="contact_name" name="contact">
                    <input type="text" name="note" class="p-4 form-control rounded" id="note_text"  placeholder="Write note" onkeydown="showContactTable(event)" autocomplete="off" required>
                    <button type="submit" class="btn mt-1 btn-primary"> Save</button>
                  </form>
                </div>
              </div>
              <div style="height: 5rem"></div>
            </div>
          </div>
        </div>
                    </div>
                    </div>

        <div class="col-md-4 col-sm-12 reports-part">

          <div class="col ">
            <div classs="d-flex row justify-content-between mb-4">
                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#shareModal"><i class="fas fa-share-alt"></i> Share </button> -->
                <button class="btn btn-default text-dark " data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"> </i> Edit</button>
                <button  class="btn btn-default text-dark"  data-toggle="modal" data-target="#archiveModal"> <img src="{{ asset('css/echovc_icons/archive.svg') }}" style="margin-top: -.2em" alt="archives"> Archive </button>
            </div>
            <h4 class=" mt-5"> Recent Reports</h4>

            @forelse($reports as $report)
            @if($report['type'] == 'sent')
            <div class="row">
              <p class=""> {{$report['title']}} </p>
              <a href="/report/view/sent?q={{$report['id']}}" class="ml-auto" style="color: #1B63DC;"> View</a>
            </div>
            @else
            <div class="row">
              <p class=""> {{$report['title']}} </p>
              <p class="mx-auto">{{$report['name']}}</p>
              <a href="/received_report/{{$report['id']}}" class="ml-auto" style="color: #1B63DC;"> View</a>
            </div>
            @endif
            @empty
            <p>No history for {{$companyData->c_name}}</p>
            @endforelse

          </div>

          <div class="col mt-5">
            <h4 class=""> History</h4>
            @forelse($histories as $history)
            <p class=""> {{$history->action}} <br>
              <small class="text-muted">{{$history->user()->first()->fname}} <i class="fas fa-circle" style="font-size: .5rem"></i><span> {{Carbon::parse($history->created_at)->diffForHumans()}} </span></small>
            </p>
            @empty
            <p>No history for {{$companyData->c_name}}</p>
            @endforelse
          </div>
        </div>
      </div>
    </section>
       <!-- Share modal -->

       <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Share with others?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form  method="post" id="share_page">
              @csrf
                <input type="text" name="emails" class="form-control" placeholder="Separate multiple emails with a comma">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-data" onclick="submit('share_page')"> Share </button>
              <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End of share modal -->

         <!-- Edit modal -->

         <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form  method="post" action="/update-company-data/{{$companyData->id}}" id="edit_company">
                  @csrf
                    <div class="form-group mb-2">
                        <label for="country"> Country </label>
                        <select name="country" id="country_id"class="form-control" value="{{old('country')}}">
                        <option> </option>
                        </select>
                        @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="website"> Company Website</label>
                        <input type="text" class="form-control" name="website" value="{{$companyData->website}}">
                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                      <div class="form-group mb-2">
                        <label for="email"> Company email</label>
                        <input type="email" class="form-control" name="email" value="{{$companyData->email}}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group mb-2">
                        <label for="tags"> Tags</label>
                        <input type="tags" class="form-control" name="tags" value="{{$companyData->tags}}">
                        @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="submit('edit_company')"> Update </button>
                  <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          <!-- End of edit modal -->


         <!-- Archives modal -->

         <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Archive company? </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form  method="post" id="archive_company" action="/archive-company/{{$companyData->id}}">
                  @csrf
                    <p>
                        This company will no longer show up in your list of components. You can restore it from the Archive
                    </p>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="submit('archive_company')"> Yes, Archive </button>
                  <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          <!-- End of share modal -->

{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>  --}}
{{--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
     <script type="text/javascript" src="{{ asset('js/select2full.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js"></script>
    <script src="/vendor/chosen/chosen.jquery.min.js"></script>
    <script  src="{{ asset('js/share.js') }}"></script>

    <script src="/js/home.js"></script>
    <script>
      if (location.hash) {
        setTimeout(function() {

          window.scrollTo(0, 0);
        }, 1);
      }
    $(".chosen-select").chosen();
    // $('#kpis').selectpicker();

    $.ajax({
             url: 'https://restcountries.eu/rest/v2/all'
         }).done(res => {
             let options = `<option  selected disabled> Select Country</option>`
             let countries = res
             for (let i = 0, length = countries.length; i < length; i++) {
                 options += `<option value='${countries[i].name}'> ${countries[i].name } </option>`
             }
             $('#country_id').html(options)

         }).fail(err => {
             console.log(err)
         })

    </script>

    </body>
</html>
