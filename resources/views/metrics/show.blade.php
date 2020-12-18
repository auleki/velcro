<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Metrics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <!-- Styles -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link ‎href="https://fonts.googleapis.com/css?family=europa:200600" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>

      thead {
        background: #fff;
      }

      td {
        padding: 0;
        border: 1px solid #dee2e6!important;
      }

      tr {
        line-height: 1rem;
      }
    </style>
</head>
<body>
  <div class="wrapper">
    @include('layouts.sidebar')
  </div>
    <main class="wholeContent">
      <div class="">
        @include('inc.messages')
      </div>
      <section class="rep d-flex">
        <div class="mr-5" onclick="window.location='/create_metrics'" >
          Metrics
        </div>
      </section>

      <div class="container mt-2">
        <div class="row">
          <div class="col-md-9" style="height:20rem">

            {!! $chart->container() !!}
          </div>
          <div class="col-md-3">

          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-9" style="height:12rem">
            {!! $chart1->container() !!}
          </div>
          <div class="col-md-3">

          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-9" style="height:15rem">
            {!! $chart2->container() !!}
          </div>
          <div class="col-md-3">

          </div>
        </div>
      </div>

      <!-- Table for each metric -->
      <!-- @if(count($graphs) > 0)
      <div class="container">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Name</th>
              <th>Description</th>
              <th>Field1</th>
              <th>Value1</th>
              <th>Date Added</th>
            </tr>
          </thead>
          <tbody>
            @foreach($graphs as $graph) -->
            <!-- <tr onClick="window.open('/graph/build/bar');"> -->
            <!-- <tr  class='clickable-row' data-href='http://127.0.0.1:8000/graph/build/bar'> -->
            <!-- <tr id="contain" data-href='/graph/build/bar'> -->
            <!-- <tr data-href='/graph/build/bar'> -->

            <!-- <tr onclick="window.location='/metrics/show/bar/';">
              <th>{{ $graph->id }}</th>
              <td>{{ $graph->name }}</td>
              <td>{{ $graph->desc }}</td>
              <td>{{ $graph->field1 }}</td>
              <td>{{ $graph->value1 }}{{ $graph->percent }}</td>
              <td>{{ $graph->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif -->
      <br><br><br>
    </main>

<script src="https://unpkg.com/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
      {!! $chart->script() !!}
      {!! $chart1->script() !!}
      {!! $chart2->script() !!}
    <script type="text/javascript">

      var original_api_url = {{ $chart->id }}_api_url;
          {{ $chart->id }}_refresh(original_api_url);

    </script>
  </body>
</html>
