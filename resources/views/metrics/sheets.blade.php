<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Sheets of Spreadsheet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <!-- Styles -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    <link href="{{ asset('css/metricsTable.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">
    <!-- Scripts -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <script src="{{ asset('js/jquery.metrics.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style media="screen">
      .btnDelAll {
        top: 11.5rem;
      }

      .display {
        margin-top: 3.5rem;
      }

      .inputSearch {
        top: 8.9rem;
        left: 33.6rem;
      }
    </style>
</head>
<body>

    <div class="wrapper">
      @include('layouts.sidebar')
    </div>
    <div class="" style="margin-left:12rem">
      @include('inc.messages')
    </div>
    <main class="wholeContent">
      <section class="header searchContact">
        <div class="rep" style="width:auto">{{ $spread_sheet->title}} Spreadsheet</div>

      </section>

      <section class="contactMain">
        <!-- <h6 class="sheetsTop" onclick="window.location='/metrics_sheets'">
          {{ $spread_sheet->title}}
        </h6> -->
        <div class="widget-wrapper container-fluid" style="padding:0; margin:0">
          <div class="section-wrap-b table-responsive">

            <!-- <div class="d-flex justify-content-flex-start btnDelAll">
              <button class="delete-all mr-3 btnConTable" data-url=""><img src="{{ asset('css/icons/metricdel.svg') }}"/></button>
              <button class="pr-4 btnConTable1" data-url=""></button>
              <div class=""></div>
            </div> -->

            <table id="mySearchableData" class="display contact_table table-hover table-responsive">
              <thead class="tdHead">
                <tr>
                  <td class="tdt"><input type="checkbox" id="check_all"></td>
                  <td class="" style="min-width:74vw!important; padding-top: 0.8rem;">NAME</td>
                </tr>
              </thead>
              <tbody class="tdBody">
                  @foreach($all_sheets as $sheet)
                  <tr id="tr_{{$sheet}}">
                    <td class="tdt"><input type="checkbox" class="checkbox"></td>
                    <td data-search="{{$sheet}}" class="" onclick="selectExcelSheet('{{$sheet}}', '{{ $spread_sheet->id}}')">{{ $sheet }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </section><br><br>

    </main>
    <div class="inputSearch">
      <img src="{{ asset('css/icons/grsearch.svg') }}" >
    </div>
</body>


  <!--searchable table start -->
  <script type="text/javascript" language="javascript" class="init">
  //	$('#mydata').dataTable();
  $(document).ready(function() {
      $('#mySearchableData').DataTable();
  } );
  </script>
  <!--able table END -->

  <script>

    $(document).ready(function() {
    $('#filterOptions li').click(function() {
      // fetch the class of the clicked item
      var ourClass = $(this).attr('class');

      // reset the active class on all the buttons
      $('#filterOptions li').removeClass('active');
      // update the active state on our clicked button
      $(this).parent().addClass('active');

      if(ourClass == 'all') {
        // show all our items
        $('#ourHolder').children('div').show();
      }
      else {
        // hide all elements that don't share ourClass
        $('#ourHolder').children('div:not(.' + ourClass + ')').hide();
        // show all elements that do share ourClass
        $('#ourHolder').children('div.' + ourClass).show();
      }
      return false;
    });
  });

  function Iforgot()
  {
  str = "lg.pw.php?eml=" + login.eml.value;
  document.location=str;
  }

  function FilterClear() {
  ShipmentFilter.txtRefOt.value="";
  ShipmentFilter.ddStatus.value=null;
  ShipmentFilter.ddMode.value=null;
  ShipmentFilter.ddCountryOrig.value=null;
  ShipmentFilter.ddCountryDest.value=null;
  ShipmentFilter.txtCityOrig.value="";
  ShipmentFilter.txtCityDest.value="";
  ShipmentFilter.txtPortLoad.value="";
  ShipmentFilter.txtPortDischarge.value="";
  ShipmentFilter.txtClient.value=null;
  ShipmentFilter.txtShipper.value=null;
  ShipmentFilter.txtConsignee.value=null;
  }

  function FilterReset() {
  FilterClear();
  ShipmentFilter.ddStatus.value=99;
  }

</script>

<script src="/js/submitSheet.js"></script>

</html>
