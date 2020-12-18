<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Metrics</title>
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

            <!-- <button class="btn btn-secondary " data-toggle="modal" data-target="#addSpreadSheet" style="width:auto;margin-top:auto;float:right"> Add Google Spreadsheet</button> -->
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
                      <a class="nav-link "  href="/metrics" role="button" aria-haspopup="true" aria-expanded="false">New data source</a>

                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ $current[1] == 'user_provided' ? 'active' : '' }}"  href="#user_provided" role="button" aria-haspopup="true" aria-expanded="false">User provided</a>
                    </li>

                    @for($m=0; $m<count($all_metrics); $m++)
                    <li class="nav-item ">
                       <a class="nav-link {{ $current[1] == $all_metrics[$m]->name ? 'active' : '' }}"  href="/selected-metric/{{ $all_metrics[$m]->tool_id }}" role="button" aria-haspopup="true" aria-expanded="false">
                         <img src="/css/icons/{{$all_metrics[$m]->name == 'google' ? 'sheet' : $all_metrics[$m]->name}}.{{$all_metrics[$m]->name == 'excel' ? 'png' : 'svg' }}" />
                        <span >
                            <!-- <small>{{ ucfirst($all_metrics[$m]->name) }}</small> -->
                            <small>{{ $all_metrics[$m]->document }}</small>
                        </span>
                        </a>

                    </li>
                    @endfor
                    @foreach($google_sheets as $g_sheet)
                    <li class="nav-item ">
                       <a class="nav-link"  href="/fetch-sheet-data/{{$g_sheet->name}}?type=google&spreadsheet={{$g_sheet->spread_sheet_id}}">
                         <img src="/css/icons/sheet.svg" />
                        <span >
                            <small>{{$g_sheet->name}}</small>
                        </span>
                        </a>

                    </li>
                    @endforeach

                  </ul>
            </div>


            <hr class="mt-0">

            <div class="row ml-n5">
                <div class="d-flex justify-content-start">
                    <label for="checkbox"></label>
                    <input type="checkbox" style="width: 20px; height: 20px" onclick='selectAllParams(this, "{{ $current[1] }}")' name="{{ $current[1] }}" id="select_all_param">
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
                            <th scope="col" style='{{ $current[1] == "xero" || $current[1] == "trello" || $current[1] == "sheets" ? "display:none" : "" }}'>DESCRIPTION</th>
                            {{-- <th scope="col">Handle</th> --}}
                          </tr>
                        </thead>
                        <tbody >
                          @if($current[1] == "google")
                            @for($i=0; $i < count($current[2]); $i++)
                            <tr key="{{ $i }}">
                              <th scope="row">
                                  <input class='metrics_param' type="checkbox" onclick='selectSpreadSheet(this, "{{ $current[2][$i]->spread_sheet_id }}", "{{ $tool_id }}")' style="width: 15px; height: 15px" name="{{ $current[2][$i]->title }}" id="">
                              </th>
                              <td>{{ $current[2][$i]->title }}</td>
                              <td>{{ $current[2][$i]->description }}</td>
                            </tr>
                            @endfor
                          @elseif($current[1] == "user_provided")
                            @for($i=0; $i < count($spreadsheets); $i++)
                            <tr key="{{ $i }}">
                              <th scope="row">
                                  <input class='metrics_param' type="checkbox" style="width: 15px; height: 15px" id="">
                              </th>
                              <td onclick="selectExcel({{$spreadsheets[$i]->id}})">{{ $spreadsheets[$i]->name }}</td>
                              <td>{{ $spreadsheets[$i]->description }}</td>
                            </tr>
                            @endfor
                          @else
                            @for($i=2; $i < count($current); $i++)
                          <tr key="{{ $i }}">
                            <th scope="row">
                                <input class='metrics_param' type="checkbox" {{ $checked && $checked[$current[$i]] == 1 ? 'checked' : '' }} onclick='addMetricParam(this, "{{ $current[$i] }}", "{{ $current[1] }}")' style="width: 15px; height: 15px" name="{{ $current[$i] }}" id="">
                            </th>
                            <td> <?php
                            $col_name_array = explode('_', $current[$i]);
                            $col_name = '';
                            for ($j=0; $j < count($col_name_array); $j++) {
                              $col_name .= ucfirst($col_name_array[$j]) . ' ';
                            }
                            echo $col_name;
                            ?>
                            </td>
                            <td style='{{ $current[1] == "xero" ? "display:none" : "" }}'></td>
                          </tr>
                            @endfor
                          @endif
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
