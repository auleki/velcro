<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Metrics</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

  </head>

  <style>
    .sidebar li > a  {
      color: #ffffff;
    }

    .hide-select {
      display: none
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

        </section>
        <form class="searchReport" action="/add-google-sheet-metrics" method="post">
          <input type="text" class="form-control form-group" placeholder="Search for metric">
          <button type="button" name="button" style="border:none"><img src={{ asset('css/icons/grsearch.svg') }} /></button>
        </form>

        <section class="newMetr">
          <div class="newData">
            <ul class="nav  fund-tabs  nav-tabs">
                <li class="nav-item">
                  <a class="nav-link btn active" data-tooltip="New data source"  href="/metrics" role="button" aria-haspopup="true" aria-expanded="false"> &#43; New data source</a>

                </li>


               <li class="nav-item"><a class="nav-link" data-tooltip="User Provided Metrics"  href="/user_provided_sheets">User provided</a> </li>

                @foreach($google_sheets as $g_sheet)
                <a class="btn btn-excel" href="">
                <img src="{{ asset('css/icons/sheet.svg') }}" />
                {{$g_sheet->name}}
                </a>
                @endforeach
            </ul>
          </div>
          <hr class="mt-0">
          <div>Google Sheets<a class="metricDel" href="#">
            <img src={{ asset('css/icons/metricdel.svg') }} /></a>
          </div>


          <form class="" action="/fetch-sheet-data/{{ $tool->id }}" method="post">
          @csrf

            <div class="forLabel">
              <label for="">Select spreadsheets</label>
              @if($errors->any())
              <span class="alert" style="color:red">{{$errors->first()}}</span>
              @endif
              <select class="form-control bigSe" name="spreadsheet" onchange="selectSpreadSheet(this)">
                <option value="">Select spreadsheet</option>
                @foreach($current as $spread_sheet)
                <option value="{{ $spread_sheet['path'] }}" id="{{ $tool->id }}">{{ $spread_sheet['name'] }}</option>
                @endforeach
              </select>
              <div id="sheet" class="hide-select">
                <label for="">Select sheets</label>
                <select class="form-control bigSe" id="select_sheet" name="sheet" required>
                  <option value="">Select sheet</option>
                </select>
              </div>

              <div class="bigSe hide-select" id="bigSe">
                <div class="">
                  <label for="">Select rows(date and time period)</label>
                  <div>
                    <input type="number" name="row" id="" min="1" value="1">
                  </div>
                </div>
                <div class="">
                  <label for="">Select metrics column (name)</label>
                  <select class="form-control smallSe" name="column" id="select_column">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                    <option value="I">I</option>
                    <option value="J">J</option>
                    <option value="K">K</option>
                    <option value="L">L</option>
                    <option value="M">M</option>
                    <option value="N">N</option>
                    <option value="O">O</option>
                    <option value="P">P</option>
                    <option value="Q">Q</option>
                    <option value="R">R</option>
                    <option value="S">S</option>
                    <option value="T">T</option>
                    <option value="U">U</option>
                    <option value="V">V</option>
                    <option value="W">W</option>
                    <option value="X">X</option>
                    <option value="Y">Y</option>
                    <option value="Z">Z</option>
                  </select>
                </div>
              </div>
            </div>
            <input type="submit" value="Save" class="btn btn-primary btns">
            <!-- <input value="Cancel" class="btn btn-default btns btnCancel"> -->

            <button class="btn btn-default btns btnCancel"><a href="#" id="cancel">Cancel</a></button>
            <!-- <a type="submit" href="/create_metrics" class="btn btn-default btns btnCancel">Cancel</a> -->

          </form>

        </section>
      </main>


            <div class="wrapper">

          @include('layouts.sidebar')
            </div>

    <script src="/js/submitSheet.js"></script>

  </body>
</html>
