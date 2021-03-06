<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Metrics</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link ‎href="https://fonts.googleapis.com/css?family=europa:200600" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

  </head>

  <style>
    .sidebar li > a  {
      color: #ffffff;
    }

    a{
        color: #333333;
    }
  </style>
  <body>
      <main class="wholeContent">

        <section class="header">
          <!-- <div class="dropdownIcon">
            <a href="javascript:void(0);" onclick="dropdownMenu()">&#9776;</a>
          </div> -->
          <div style="width:100%">
            <div class="rep">Metrics</div>

            <button class="btn btn-secondary " data-toggle="modal" data-target="#addSpreadSheet" style="width:auto;margin-top:auto;float:right"> Add Google Spreadsheet</button>
          </div>

          <div class="modal fade" id="addSpreadSheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Google Spreadsheet</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/submit/spreadsheet" method="post" id="sheet_form">
                @csrf
                <div class="modal-body">
                  <div class="form-group align-form  ">
                    <input type="text" name="name" id="sheet_name" placeholder="Enter spreadsheet name" class="p-3 form-control" >
                  </div>

                  <div class="form-group align-form  ">
                    <input type="text" name="link" id="sheet_link" placeholder="Enter spreadsheet link" class="p-3 form-control" >
                  </div>

                  <div class="form-group align-form  ">
                    <input type="text" name="desc" id="sheet_desc" placeholder="Enter spreadsheet description" class="p-3 form-control" >
                  </div>

                </div>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary "  data-dismiss="modal" aria-label="Close">Close</button>
                  <button type="button" class="btn btn-primary "  data-dismiss="modal" aria-label="Close" onclick="submitSheet()">Add</button>
                </div>
              </div>
            </div>
          </div>

          <form class="searchReport" action="" method="post">
            <input type="text" class="form-control form-group" placeholder="Search for metric">
            <button type="button" name="button" style="border:none"><img src={{ asset('css/icons/grsearch.svg') }} /></button>
          </form>


        <section class="newMetr">
            <div class="">
                <ul class="nav  fund-tabs  nav-tabs">
                    <li class="nav-item ">
                      <a class="nav-link "  href="/metrics">New data source</a>

                    </li>

                    <li class="nav-item ">
                        <a class="nav-link"  href="/user_provided_sheets">User provided</a>

                    </li>

                    @foreach($all_sheets as $sheet)
                    <li class="nav-item ">
                       <a class="nav-link {{ $sheetId == $sheet->name ? 'active' : '' }}"  href="/fetch-sheet-data/{{$sheet->name}}?type=google&spreadsheet={{$sheet->spread_sheet_id}}">
                         <img src="/css/icons/sheet.svg" />
                        <span >
                            <!-- <small>Google Sheet</small> -->
                            <small>{{$sheet->name}}</small>
                        </span>
                      </a>

                    </li>
                    @endforeach

                    @for($m=0; $m<count($all_tools); $m++)
                    <li class="nav-item ">
                       <a class="nav-link"  href="/selected-metric/{{ $all_tools[$m]->tool_id }}" role="button" aria-haspopup="true" aria-expanded="false">
                         <img src="/css/icons/{{$all_tools[$m]->name == 'google' ? 'sheet' : $all_tools[$m]->name}}.{{$all_tools[$m]->name == 'excel' ? 'png' : 'svg' }}" />
                        <span >
                            <!-- <small>{{ ucfirst($all_tools[$m]->name) }}</small> -->
                            <small>{{ $all_tools[$m]->document }}</small>
                        </span>
                        </a>

                    </li>
                    @endfor

                  </ul>
            </div>

            <hr class="mt-0">

            <div class="row ml-n5">
                <div class="d-flex justify-content-start">
                    <label for="checkbox"></label>
                    <input type="checkbox" style="width: 20px; height: 20px" onclick='selectAllParams(this)' name="" id="select_all_param">
                </div>

                <div class="d-flex justify-content-end">
                    <p> </p>
                </div>
            </div>

            <div class="container-fluid mt-n5" >
                <div class="row">

                    <table class="table table-borderless ">
                        <thead class="thead">
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">NAME</th>
                          </tr>
                        </thead>
                        <tbody >
                          @foreach($all_metrics as $metric)
                          <tr>
                            <th scope="row">
                                <input class='metrics_param' type="checkbox" style="width: 15px; height: 15px" id="">
                            </th>
                            <td onclick="selectMetric('{{$metric->name}}', '{{$metric->index}}', '{{$metric->column}}', '{{ $spreadsheetId }}', '{{ $toolId }}', '{{$sheetId}}', '{{$row_length}}')">{{ $metric->name }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>

        </section>


        </section>
      </main>

      <div class="wrapper">

        @include('layouts.sidebar')
      </div>

    <script src='/js/addMetricParam.js'></script>
    <script src='/js/submitSheet.js'></script>
  </body>
</html>
