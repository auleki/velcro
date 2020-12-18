<?php
use Carbon\Carbon;

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>All Reports</title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <!-- Styles -->
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/reportTable.css') }}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>

  </head>
  <body>
  <div class="wrapper">
    @include('layouts.sidebar')
  </div>

      <main class="wholeContent">
        <section class="header searchContact">
          <div class="rep">Reports</div>
          <a href="/new_report" class="btn btn-primary searchContact repTopBtn">New Report</a>
        </section>

        <section class="message">
          <!-- Main screen tags -->
          @include('reports.search_field')
          <!-- Mobile view tags -->
          <div class="repMobParent">
            <ul class="navbar-nav repStatus repMobile">
              <li class="nav-item dropdown repMobActive">
                <a id="navbarDropdown" class="nav-link dropdown-toggle repTitle" href="/reports" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>ALL
                </a>
                <div class="dropdown-menu repMobDropdown" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item repTitle" href="/sent_report">SENT</a>
                  <a class="dropdown-item repTitle" href="/received_report">RECEIVED</a>
                  <a class="dropdown-item repTitle" href="/scheduled_report">SCHEDULED</a>
                  <a class="dropdown-item repTitle" href="#">DRAFT</a>
                </div>
              </li>
            </ul>
            <a href="/new_report" ><img src="{{ asset('css/icons/repMobCreate.png') }}" /></a>
          </div>

          <table id="mySearchableData" class="display table table-hover table-responsive" cellspacing="0">
            <thead style="background:transparent; color:transparent">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </thead>
            <tbody class="repMainTable" style="width:100vw">
            @if(count($reports) > 0)
            @foreach ($reports as $report)
              <tr>
                <td class="tdt"><input type="checkbox" name="" value=""></td>
                <td data-search="Tiger Nixon" class="tdDept">{{ $report->user_id }}</td>
                <td class="tdName">System Architect</td>
                <td class="tdMsg">{{ $report->content }}</td>
                <td class="tdTime">{{ Carbon::parse($report->created_at)->diffForHumans() }}</td>
              </tr>
            @endforeach
            @endif
            </tbody>
            <tbody class="repMobTable" style="width:100vw">
              <tr style="display:flex!important; justify-content:flex-start;">
                <td class="tdt" style="display:flex!important; justify-content:flex-start; margin-top:1rem">
                  <input type="checkbox" name="" value=""></td>
                <td data-search="Tiger Nixon" class="tdDept" style="display:flex!important; flex-direction:column; width:90vw; margin-right:0.5rem">
                  <div class="" style="display:flex!important; justify-content:space-between">
                    <div class="conEmailPhone">T. Nixon</div>
                    <div class="">Timestamp</div>
                  </div>
                  <div class="">System Arc</div>
                  <div class="">Message.... Message.... Message....</div>
                </td>
              </tr>
            </tbody>
          </table>
        </section>

      </main>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/report.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>





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


  function validateForm()
  {
  formObj = document.login;
      if (formObj.eml.value == "") {
      alert("You have not filled in the User Name field.");
  formObj.eml.focus();
      return false;
      }
      else if (formObj.pwd.value == "") {
      alert("You have not filled in the Password field.");
  formObj.pwd.focus();
      return false;
      }
  formObj.btnLogin.innerHTML='Wait..';
  formObj.btnLogin.disabled=true;
  }


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


  </body>
  </html>
