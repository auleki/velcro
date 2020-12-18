
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Welcome Back</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
      <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">
      <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
      <!-- Scripts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>

  <body>

    <style>
      .nav-tabs a{
          color: #333333;
      }

      .fund-tabs{
          font-size: 22px;
      }

      .ml-20{
          margin-left: 5rem;
      }
      .invest .panel-body{
          margin-top: 0rem !important;
      }

      .new{
          background: red;
          width: 100rem;
          height: 100rem;
          margin-top: 13rem;
      }
      .fund-tab-dropdown:hover, .fund-tab-dropdown:focus, .fund-tab-dropdown:active {
        border:none !important;
        background: transparent !important;
      }

      .select-year{
        width: 5rem;

        padding-left: 1rem;

        position: absolute;

        right: 5rem;
      }

    .hide-spinner {
      display: none !important;
    }

    .clicked {
        background: #2E7CFF !important;
        color: #ffffff !important;
    }

    .activityMobile{
      margin: -2rem;
      position: relative;
      left: .5rem;
    }
    </style>

    <div class="wrapper">
        @include('layouts.sidebar')
      </div>

      <main class="wholeContent  ">

        <section class="main-section">
            <div class="wholeContent">
                <div class="heading row mb-3" style="position:relative; top: .5rem">
                    <div class=""> <h3> Welcome back,{{$user->lname}}</h3></div>
                    <div class="ml-auto mt-n1 notMobileContent">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addChart"> Add Chart</button>
                        <!-- <button class="btn btn-dashboard"  data-toggle="modal" data-target="#shareModal"> Share</button> -->
                    </div>


                </div>

                <div class="row non-desktop-content d-flex justify-content-between mt-n2">
                  <div class="dropdown ">
                    <a href="#" id="{{$fund_data->id}}" onclick="changeFund(this)" style="color:#666666 !important">{{$fund_data->name}}</a>
                    <button class="btn btn-dashboard dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      @for($i=0; $i<count($funds); $i++)
                      <?php
                      $fund = $funds[$i];
                      ?>
                      <a class="dropdown-item" href="#" id="{{$fund->id}}" onclick="changeFund(this)">{{$fund->name}}</a>
                      @endfor
                    </div>


                  </div>



                  <div class="mobile-btns">
                    <a href="" id="add_chart"  class="btn btn-primary add_chart text-white" data-toggle="modal" data-target="#addChart">Add Chart </a>
                    <!-- <button class="btn btn-dashboard"  data-toggle="modal" data-target="#shareModal"> <i class="fas fa-share-alt"></i></button> -->
                </div>

                <hr>
              </div>


                <div class="row">
                  <div class="col-md-9 col-sm-12  " id="scroll1">
                    <ul class="nav notMobileContent ml-n4 fund-tabs  nav-tabs" style="border-bottom:none">
                      @for($i=0; $i<count($funds); $i++)
                      <?php
                      $fund = $funds[$i];
                      ?>
                      <li class="nav-item dropdown mr-4">
                        <a class="{{ $active_fund == $fund->id ? 'activate':'' }}" href="#" id="{{$fund->id}}" onclick="changeFund(this)">{{$fund->name}}</a>
                        <a class="dropdown-toggle fund-tab-dropdown" style="padding:0px;width:1rem;float:right" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" data-target="#renameFund{{$fund->id}}" data-toggle="modal" href="#">Rename</a>
                            <!-- <a class="dropdown-item" href="/export-fund/{{$fund->id}}">Export fund to PDF</a> -->
                          <a class="dropdown-item" data-target="#deleteFund{{$fund->id}}" data-toggle="modal" href="#">Delete</a>
                        </div>
                      </li>

                      <!-- RenameFund modal -->
                      <div class="modal fade" id="renameFund{{$fund->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Rename your fund</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="/funds/{{$fund->id}}" method="post" id="edit_fund_{{$fund->id}}">
                              @csrf
                                <input type="text" name="name" class="form-control" placeholder="Previous fund name goes here" value="{{$fund->name}}">
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" onclick="submit('edit_fund_{{$fund->id}}')"> Save </button>
                              <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End of RenameFund modal -->

                      <!-- Delete Fund modal -->
                      <div class="modal fade" id="deleteFund{{$fund->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete fund board?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-wrap">
                                    This fund board will be deleted but all fundamental metrics and data will still be available.
                                </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" onclick="window.location.href='/fund/remove/{{$fund->id}}'"> Yes, delete board </button>
                              <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End of delete fund modal -->
                      @endfor

                      <li class="nav-item mr-4">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#createFund" style="padding:0px"><i class="fas fa-plus font-weight-bold" ></i></a>
                      </li>
                    </ul>

                    <div class="funds-list  mt-3">
                      <ul class="list-unstyled row funds d-flex justify-content-between">
                        <li class="">
                            <small class="text-muted small"> Number of investments</small>
                            <h4> {{number_format($num_of_investments)}}</h4>
                        </li>

                        <li class="">
                            <small class="text-muted small"> Number of exits</small>
                            <h4>{{number_format($num_of_exits)}}</h4>
                        </li>

                        <li class="mr-md-3">
                            <small class="text-muted"> Total invested Fund</small>
                            <h4> ${{number_format($amount_invested)}}</h4>
                        </li>

                        <li class="mr-2">
                          <small class="text-muted small"> {{$fund_data->tag->name}} <i class="fas fa-pen" data-toggle="modal" data-target="#editIRR"></i></small>
                          <h4>{{$fund_data->tag->value}}</h4>
                        </li>
                      </ul>
                    </div>

                    <div class="performance ml-n3  ">
                        <h3 class="notMobileContent"> Performance Synopsis</h3>
                        <div class=" row">
                          @for($k=0; $k<count($charts[0]); $k++)
                            <div class="panel-group col-md-6 col-sm-12 col-xl-6" id="accordion" role="tablist" aria-multiselectable="true">
                              <div class="panel panel-default ">
                                  <div class="panel-heading " role="tab" id="headingOne">
                                    <p class="panel-title mr-auto col-sm-9 float-left">
                                      {{$charts[1][$k]->title}}
                                    </p>
                                    <div class="dropdown ml-auto col-sm-3 float-right" style="text-align:end">
                                      <a class="chart-title" type="button" id="dropdownMenuButton{{$charts[1][$k]->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$charts[1][$k]->id}}">
                                        <a class="dropdown-item" href="/fund-chart/remove/{{$charts[1][$k]->id}}">Remove chart</a>
                                      </div>
                                    </div>
                                  </div>
                                <div id="" class="" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body" >
                                        <div>
                                            <canvas id="myChart{{$charts[1][$k]->id}}" width="400" height="400"></canvas>
                                            <script>
                                              var data = @json($charts[0][$k]);
                                              var colors = @json($charts[3][$k]);
                                              var names = @json($charts[4][$k]);
                                              // console.log(data, colors, names)
                                              var labels = [];
                                              var datasets = [];
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

                                              var ctx = document.getElementById("myChart{{$charts[1][$k]->id}}").getContext('2d');
                                              var myChart = new Chart(ctx, {
                                                  type: "{{$charts[2][$k]}}",
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
                                </div>
                              </div>
                            </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Activity Summary  -->


                    <div class=" invest align mt-5 pt-3  ">
                      <h4> Activity Summary</h4>
                      <div class="panel-group col-12" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default ">
                          <div class="panel-heading row d-flex justify-content-between mb-1" role="tab" id="headingActivity">
                            <select class="form-control" name="quarter" id="quarter-year" style="width:10%" onchange="searchByQuarter(this)" autocomplete="off">
                              <option value="all">All</option>
                              <option value="1">Q1</option>
                              <option value="2">Q2</option>
                              <option value="3">Q3</option>
                            </select>

                            <!-- <button class="btn   mt-n2"> -->
                            <input type="number" class="select-year form-control" min="1900" max="{{date('Y')}}" step="1" value="{{date('Y')}}" onchange="searchTable(this)" autocomplete="off" />
                            <!-- </button> -->
                          </div>
                          <div id="collapseActivity" class="panel-collapse collapse show in " role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body ">
                              <div class="table notMobileContent">
                                <table class="table table-hover ">
                                  <thead class="thead-dark">
                                    <tr>
                                      <th></th>
                                      <th colspan="3">Portfolio Company</th>
                                      <th colspan="3">Round</th>
                                      <th colspan="3">Init. Investment</th>
                                      <th colspan="3">Amount</th>
                                      <th colspan="3"> %owned </th>
                                      <th colspan="3"> No. of Shares</th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                  </thead>

                                  @foreach ($activity_summary as $company)
                                  <?php
                                  //the month number without any leading zeros
                                    $month = date("n", strtotime($company[0]->tranches()->first()->tranche_date));

                                    //Calculate the year quarter.
                                    $yearQuarter = ceil($month / 3);
                                  ?>
                                  <tbody>
                                      <tr class="clickable bg-primary text-white activity-summary-table data-search-{{date('Y', strtotime($company[0]->tranches()->first()->tranche_date))}} data-quarter-{{$yearQuarter}}" data-toggle="collapse" data-search="{{date('Y', strtotime($company[0]->tranches()->first()->tranche_date))}}" data-target="#activity{{$company[0]->id}}" aria-expanded="false" aria-controls="activity{{$company[0]->id}}">
                                        <td> <input type="checkbox" class="p-1 outline-none checkers "name="checkbox1" id="check" ></td>
                                          <td colspan="3">{{$company[0]->company()->first()->c_name}}</td>
                                          <td colspan="3">{{$company[0]->round}}</td>
                                          <td colspan="3">{{date('d M Y', strtotime($company[0]->tranches()->first()->tranche_date))}}</td>
                                          <td colspan="3">{{$company[0]->committed}}</td>
                                          <td colspan="3">{{$company[0]->percent_owned}}</td>
                                          <td colspan="3">{{$company[0]->shares}}</td>
                                          <td class="">
                                              <a href="#" class="ml-3" data-target="#edit-activity-{{$company[0]->id}}" data-toggle="modal"> <i class="fas fa-pen"></i></a>
                                          </td>
                                          <td >
                                              <i class="fas fa-chevron-down"></i>
                                          </td>
                                      </tr>
                                  </tbody>
                                  <tbody id="activity{{$company[0]->id}}" class="collapse ">
                                      <tr class="table-primary ">
                                          <td></td>
                                          <td colspan="3"></td>
                                          <td colspan="4"><small> Investors in round </small></td>
                                          <td colspan="3"><small>Next round timeline </td>
                                          <td colspan="2"><small>Round size </small> </td>
                                          <td colspan="4"><small>Forecasted EchoVC Inv. </small> </td>
                                          <td colspan="2"></td>
                                          <td></td>
                                          <td></td>
                                      </tr>

                                      <tr class="font-weight-bold ">
                                          <td></td>
                                          <td colspan="3"></td>
                                          <td colspan="4">{{$company[0]->investors_in_seed}}</td>
                                          <td colspan="3">{{$company[0]->next_round_timeline}}</td>
                                          <td colspan="2">{{$company[0]->round_size_currency}}{{$company[0]->round_size}}</td>
                                          <td colspan="4">{{$company[0]->forecast_echovc_inv_currency}}{{$company[0]->forecast_echovc_inv}}</td>
                                          <td colspan="2"></td>
                                          <td></td>
                                          <td></td>
                                      </tr>

                                      @for($h=1;$h<count($company);$h++)
                                      <tr class="bg-primary text-white font-weight-bold ">
                                          <td></td>
                                          <td colspan="3"></td>
                                          <td colspan="3">{{$company[$h]->round}}</td>
                                          <td colspan="3">{{date('d M Y', strtotime($company[$h]->tranches()->first()->tranche_date))}}</td>
                                          <td colspan="3"> {{$company[$h]->committed}} </td>
                                          <td colspan="3">{{$company[$h]->percent_owned}}</td>
                                          <td colspan="3">{{$company[$h]->shares}}</td>
                                          <td><a href="#" class="ml-3" data-target="#edit-activity-{{$company[$h]->id}}" data-toggle="modal"> <i class="fas fa-pen"></i></a></td>
                                          <td></td>
                                      </tr>

                                      <tr class="table-primary ">
                                          <td></td>
                                          <td colspan="3"></td>
                                          <td colspan="4"><small> Investors in round </small></td>
                                          <td colspan="3"><small>Next round timeline </td>
                                          <td colspan="2"><small>Round size </small> </td>
                                          <td colspan="4"><small>Forecasted EchoVC Inv. </small> </td>
                                          <td colspan="2"></td>
                                          <td></td>
                                          <td></td>
                                      </tr>

                                      <tr class="font-weight-bold ">
                                          <td></td>
                                          <td colspan="3"></td>
                                          <td colspan="4">{{$company[$h]->investors_in_seed}}</td>
                                          <td colspan="3">{{$company[$h]->next_round_timeline}}</td>
                                          <td colspan="2">{{$company[$h]->round_size_currency}}{{$company[$h]->round_size}}</td>
                                          <td colspan="4">{{$company[$h]->forecast_echovc_inv_currency}}{{$company[$h]->forecast_echovc_inv}}</td>
                                          <td colspan="2"></td>
                                          <td></td>
                                          <td></td>
                                      </tr>
                                      @endfor

                                  </tbody>
                                  @endforeach

                                </table>
                              </div>

                              <div class=" mt-4 activityMobile non-desktop-content" >
                                  <table class="table table-hover table-borderless table-striped">
                                    <thead style="background: #1E223A;" class="text-white">
                                      <tr>
                                        <th></th>
                                        <th style="font-size: 12px;"> Portfolio company</th>
                                        <th style="font-size: 12px;"> Shares</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($activity_summary as $company)
                                    <?php
                                    //the month number without any leading zeros
                                      $month = date("n", strtotime($company[0]->tranches()->first()->tranche_date));

                                      //Calculate the year quarter.
                                      $yearQuarter = ceil($month / 3);
                                    ?>
                                      <tr class="activity-summary-table data-search-{{date('Y', strtotime($company[0]->tranches()->first()->tranche_date))}} data-quarter-{{$yearQuarter}}" data-toggle="collapse" data-search="{{date('Y', strtotime($company[0]->tranches()->first()->tranche_date))}}" data-target="#activity-mobile-{{$company[0]->id}}" aria-expanded="false" aria-controls="activity-mobile-{{$company[0]->id}}">
                                        <th scope="col">
                                          <input type="checkbox" class="form-control mt-1" style="width: 15px; height: 15px">
                                        </th>
                                        <td style="font-size: 10px;">{{$company[0]->company()->first()->c_name}}</td>
                                        <td style="font-size: 10px;">{{$company[0]->shares}}</td>
                                        <td>
                                          <a href="" class="text-dark" data-target="#activity-mobile-{{$company[0]->id}}" data-toggle="modal">
                                            <img src="/css/icons/expand.png" alt="" style="height:1rem;width:1rem;border-radius: 0px;">
                                          </a>
                                        </td>
                                      </tr>
                                    @endforeach
                                    </tbody>
                                  </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="notMobileContent  col-md-3 col-xl-3 col-sm-12">
                        <h3 class=""> Latest Activity</h3>

                        <div class="list">
                            <ul class="list-unstyled ">
                            @forelse($latest_activities as $fund_activity)
                                <ll class="row" style="margin-right:0px;margin-left:0px">
                                    <p class="mr-auto">{{$fund_activity->company()->first()->c_name}}</p>
                                    <p> {{$fund_activity->action}} </p>
                                    <p class="text-success ml-auto">${{number_format($fund_activity->amount)}}</p>
                                    <!-- <p>{{$fund_activity->action}}</p> -->
                                </ll>
                                @empty
                                <p>No latest activity</p>
                                @endforelse

                                <!-- <ll class="row" style="margin-right:0px;margin-left:0px">
                                    <p class="mr-auto"> SquadGo</p>
                                    <p> 1st Exit </p>
                                    <p class="text-success ml-auto"> $420,000</p>
                                </ll> -->
                            </ul>
                        </div>

                        <h3 class="mt-5 "> Latest Reports </h3>

                        <div class="list1">
                            <ul class="list-unstyled">
                                @forelse($latest_reports as $report)
                                @if($report['type'] == 'sent')
                                <li class="row" style="margin-right:0px;margin-left:0px">
                                  <p class=""> {{$report['title']}} </p>
                                  <p class="ml-auto" ><a href="/report/view/sent?q={{$report['id']}}" class="ml-auto" style="color: #1B63DC;"> View</a></p>
                                </li>
                                @elseif($report['type'] == 'received')
                                <li class="row" style="margin-right:0px;margin-left:0px">
                                  <p class=""> {{$report['title']}} <br> {{$report['name']}} </p>
                                  <a href="/received_report/{{$report['id']}}" class="ml-auto" style="color: #1B63DC;"> View</a>
                                </li>
                                @endif
                                @empty
                                <p>No latest report</p>
                                @endforelse
                            </ul>
                        </div>

                            <h3 class="mt-4 "> Twitter feed </h3>
                        <div class="text-center mt-5">
                            <!-- <h5 class=" text-muted ">No tweets to show</h5>
                            <p class="">  <a href="" class="text-info"> Integrate Twitter</a></p> -->
                            <a class="twitter-timeline" href="https://twitter.com/EchoVC?ref_src=twsrc%5Etfw">Tweets by EchoVC</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      </main>

      <!-- MODALS -->

      <!-- Add chart -->


        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <h5 class="modal-title" id="exampleModalLabel">Name your dashboard</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> -->
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal"> Create dashboard </button>
                  <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </div>
            </div>
          </div>

          <!-- End of add dashboard modal -->

          <!-- edit fund -->


        <div class="modal fade" id="editIRR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:25%">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                  <form action="/update-fund-tag/{{$fund_data->tag->id}}" method="post" id="edit_irr" style="width:100%">
                  @csrf
                   <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" placeholder="IRR" name="name" class="form-control" value="{{$fund_data->tag->name}}">
                   </div>
                   <div class="form-group">
                    <label for="">Value</label>
                    <input type="text" placeholder="20%" name="value" class="form-control" value="{{$fund_data->tag->value}}">
                   </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="submit('edit_irr')"> Save </button>
                </div>
              </div>
            </div>
          </div>

          <!-- End of add dashboard modal -->

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
              <form action="/share/{{$fund_data->id}}" method="post" id="share_page">
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

           <!-- Fund modal -->

           <div class="modal fade" id="createFund" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Name your fund</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/funds" method="post" id="new_fund">
                  @csrf
                    <input type="text" class="form-control" name="name">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="submit('new_fund')"> Create fund </button>
                  <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          <!-- End of share modal -->

            <!-- Activity Action-->

            <div class="modal fade" id="activityAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Activity Action</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <h3> Do stuff here ...</h3>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" > Dumb Button </button>
                      <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                  </div>
              </div>
            </div>
            <!-- End of Activity Actiob Modal modal -->


          <!-- Activity Summary mobile fullcontent -->
          @foreach($activity_summary as $company)
          <div class="modal fade" id="activity-mobile-{{$company[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{$company[0]->company()->first()->c_name}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <ul class="list-unstyled ">
                    <li class="row d-flex justify-content-between p-3">
                      <p> Round</p>
                      <p>{{$company[0]->round}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p> Init. investment</p>
                      <p>{{date('d M Y', strtotime($company[0]->tranches()->first()->tranche_date))}}</p>
                    </li>


                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p> Amount</p>
                      <p>{{$company[0]->committed}}</p>
                    </li>


                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p> %owned</p>
                      <p>{{$company[0]->percent_owned}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>No. of shares</p>
                      <p>{{$company[0]->shares}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>Next round timeline</p>
                      <p>{{$company[0]->next_round_timeline}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>Round size</p>
                      <p>{{$company[0]->round_size_currency}}{{$company[0]->round_size}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>Forecasted EchoVC Inv.</p>
                      <p>{{$company[0]->forecast_echovc_inv_currency}}{{$company[0]->forecast_echovc_inv}}</p>
                    </li>

                    @for($h=1;$h<count($company);$h++)
                    <hr>
                    <li class="row d-flex justify-content-between p-3">
                      <p> Round</p>
                      <p>{{$company[$h]->round}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p> Init. investment</p>
                      <p>{{date('d M Y', strtotime($company[$h]->tranches()->first()->tranche_date))}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p> Amount</p>
                      <p>{{$company[$h]->committed}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p> %owned</p>
                      <p>{{$company[$h]->percent_owned}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>No. of shares</p>
                      <p> {{$company[$h]->shares}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>Next round timeline</p>
                      <p>{{$company[$h]->next_round_timeline}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>Round size</p>
                      <p>{{$company[$h]->round_size_currency}}{{$company[$h]->round_size}}</p>
                    </li>

                    <li class="row mt-n4 d-flex justify-content-between p-3">
                      <p>Forecasted EchoVC Inv.</p>
                      <p>{{$company[$h]->forecast_echovc_inv_currency}}{{$company[$h]->forecast_echovc_inv}}</p>
                    </li>
                    @endfor

                  </ul>
                </div>

              </div>
            </div>
          </div>
          @endforeach

    @foreach($activity_summary as $companies)
    @foreach($companies as $company)
    <div class="modal fade" id="edit-activity-{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h3> Edit Activity</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
              <form action="/company-fund/update/{{$company->id}}" method="post">
              @csrf
                <input type="hidden" name="fund_id" value="{{$fund_data->id}}">
                <div>
                    <label for=""> Portfolio company </label>
                    <input type="text" class="form-control" placeholder="Smart Funds" value="{{$company->company()->first()->c_name}}">
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for=""> Initial investment date</label>
                        <input type="date" class="form-control" placeholder="12 Sep 2018" name="tranche_date" value="{{$company->tranches()->first()->tranche_date}}">
                    </div>

                    <div class="col-md-6">
                        <label for=""> Amount invested</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="tranche_value" value="{{$company->tranches()->first()->tranche_value}}" >
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <select name="tranche_currency" id="">
                                      <option value="$" {{$company->tranches()->first()->tranche_currency == '$' ? 'selected' : '' }}> USD </option>
                                      <option value="£" {{$company->tranches()->first()->tranche_currency == '£' ? 'selected' : '' }}> GBP </option>
                                      <option value="₦" {{$company->tranches()->first()->tranche_currency == '₦' ? 'selected' : '' }}> NGN </option>
                                  </select>
                              </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for=""> Round </label>
                        <select name="round" id="" class="form-control">
                            <option value="Seed" {{$company->round == 'Seed' ? 'selected' : '' }}>Seed</option>
                            <option value="Series A" {{$company->round == 'Series A' ? 'selected' : '' }}>Series A</option>
                            <option value="Series B" {{$company->round == 'Series B' ? 'selected' : '' }}>Series B </option>
                            <option value="Series C" {{$company->round == 'Series C' ? 'selected' : '' }}>Series C</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for=""> Number of shares</label>
                        <input type="text" name="shares" class="form-control" value="{{$company->shares}}">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="">Percent owned %</label>
                        <input type="text" name="percent_owned" class="form-control" value="{{$company->percent_owned}}">
                    </div>

                    <div class="col-md-6">
                        <label for=""> Round size</label>
                        <div class="input-group">
                            <input type="text" name="round_size" class="form-control" value="{{$company->round_size}}" >
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <select name="round_size-currency" id="">
                                      <option value="$" {{$company->round_size_currency == '$' ? 'selected' : '' }}> USD </option>
                                      <option value="£" {{$company->round_size_currency == '£' ? 'selected' : '' }}> GBP </option>
                                      <option value="₦" {{$company->round_size_currency == '₦' ? 'selected' : '' }}> NGN </option>
                                  </select>
                              </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="">Next round timeline</label>
                        <input type="text" name="next_round_timeline" value="{{$company->next_round_timeline}}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for=""> Forecasted echoVC investment</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="forecast_echovc_inv" value="{{$company->forecast_echovc_inv}}">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <select name="forecast_echovc_inv_currency" id="">
                                      <option value="$" {{$company->forecast_echovc_inv_currency == '$' ? 'selected' : '' }}> USD </option>
                                      <option value="£" {{$company->forecast_echovc_inv_currency == '£' ? 'selected' : '' }}> GBP </option>
                                      <option value="₦" {{$company->forecast_echovc_inv_currency == '₦' ? 'selected' : '' }}> NGN </option>
                                  </select>
                              </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div>
                    <label for=""> Investors in seed <small class="text-muted"> (seperate with a comma)</small></label>
                    <input type="text" class="form-control" name="investors_in_seed" value="{{$company->investors_in_seed}}">
                </div>


                <div class="mt-4">
                    <button class="btn btn-primary" type="submit"> Save </button>
                    <button class="btn btn-default text-dark"> Cancel</button>
                </div>
                </form>
            </div>

          </div>

        </div>
    </div>
    @endforeach
    @endforeach>

               <!-- Add Chart -->

          <div class="modal fade centered" id="addChart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content custom-modal" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-xl-7 col-md-7 col-sm-12 mobileModal">

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
                                       <ul class="list-unstyled row metric_side ml-3">
                                            <li class="exact-class"> <a style="cursor: pointer" class="text-dark" id="metric" > Metrics </a></li>
                                            <!-- <li class="ml-3"> <a style="cursor: pointer" class="text-black-50" id="export"> Exports</a></li> -->
                                        </ul>
                                    </div>

                                    <div class="">
                                        <a href="" class="btn btn-default text-dark" class="close" data-dismiss="modal"> Cancel </a>
                                        <a href="#" class="btn btn-primary" id="create_chart" data-fund="{{$fund_data->id}}" onclick='createChart(this, "fund")'> Save </a>
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


    <script src="/js/home.js"></script>
    <script src='/js/selectMetric.js'></script>
    <script src='/js/createChart.js'></script>
    <script>
       $('#check').on('change', function(e){
            if(e.target.checked){
                $('#activityAction').modal();
            }
        });


    </script>
    </body>


</html>
