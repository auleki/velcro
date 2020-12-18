<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>New Report</title>
      <link href="{{ asset('css/contactTable.css') }}" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <!-- Styles -->
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sample.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">

      <!-- Scripts -->
      <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
<div class="wrapper">

    @include('layouts.sidebar')
      </div>
      <main class="wholeContent">
        <div class="">
          @include('inc.messages')
        </div>
        <h3 class="newRepNav">Reports</h3>
        <form action="{{ route('reports.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <section class="newReport">
            <a href="/reports" class="btn btn-default">Back</a>
            <a href="/reports" class="btn btnClose">Close</a>
            <div class="newRepNavBtns">
              <button type="submit" name="status" class="btn btn-default" value="saved">Save & Close</button>
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="submit" class="btn btn-primary btnNow" name="status" value="sent" data-toggle="tooltip" data-placement="left" title="Send report now">Send now</button>
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="submit" class="btn btn-primary dropdown-toggle" aria-haspopup="true"
                  aria-expanded="false" data-toggle="tooltip" data-placement="top" name="status"  value="scheduled" title="Schedule report"></button>
                </div>
              </div>
            </div>
          </section>
            <div class="repSec">
              <article class="repSec">
                <input class="form-control border mb-3" style="font-size: 2.3em" type="text" name="report_title" placeholder="| Add a subject title" required>
                <input type="text" class="border mt-3" name="subject" required placeholder=" Subject">
                <input type="text" class="border mt-3" name="receiver" required  placeholder=" email">
                <input type="text" name="content" class="border p-4" placeholder="Content" required>
                <input type="file" name="image" value="">
              </article>
            </div>
          </form>

      </main>




  <script type="text/javascript">
  // ***************Script for the tooltip*************
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
  </script>
</body>
</html>
