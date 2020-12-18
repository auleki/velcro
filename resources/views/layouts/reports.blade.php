<?php

use Carbon\Carbon;

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reports</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/DataTables/datatable.min.css">
  <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
  <!-- Styles -->
  <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/report.css') }}" rel="stylesheet">
  <link href="{{ asset('css/reportTable.css') }}" rel="stylesheet">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

  <style>
    #table_id_length {
      display: none !important;
    }


    tbody {
      font-size: 14px;
      font-weight: 300;
    }

    thead,
    th {
      font-size: 16px;
      font-weight: 400;
    }


    #table_id_filter {
      position: absolute;
      top: -4rem
    }

    #table_id_info {
      top: -8rem;
      position: absolute;
      right: 0rem;
    }

    .paginate_button.current {
      background: #2176bd;
      color: #fff !important
    }

    /* thead {
          display: none !important;
        } */
  </style>
  <!-- Scripts -->
  <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

  @yield('styles')
</head>

<body>
  <div class="wrapper">
    @include('layouts.sidebar')
  </div>

  <main class="wholeContent">
    @yield('content')

  </main>



  <!-- report.js line 4940 - 5002 -->


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="/DataTables/datatables.min.js"></script>

  <script src="{{ asset('js/iziToast.js') }}"></script>
  <script src="/js/reports.js"></script>
  <script>
    $(document).ready(function() {
      $('#table_id').DataTable();
    });
  </script>
  @include('vendor.lara-izitoast.toast')

</body>

</html>