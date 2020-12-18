
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Share </title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
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
    </style>

   

      <main class="wholeContent" style="width:100%;left:0em">

        <section class="main-section">
          <div class="text-center mt-4 mb-3"><img src="{{$logo}}" alt=""></div>
          <div class="row" style="width: 80%;margin: 0px;margin-left: 10%;margin-right: auto;">
            <div class="col-sm-12  " id="scroll1">
              <div class="funds-list  mt-3">
                <ul class="list-unstyled row funds d-flex justify-content-between">
                  <li class="">
                      <small class="text-muted small"> Number of investments</small>
                      <h4>{{number_format($num_of_investments)}}</h4>
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
                    <small class="text-muted small"> IRR <i class="fas fa-pen"></i></small>
                    <h4>{{$fund->irr}}</h4>
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
                                  <td><input type="checkbox" class="p-1 outline-none" ></td>
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
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </main>

      <!-- MODALS -->

    <script src="/js/home.js"></script>
    </body>


</html>
