<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta http-equiv='x-ua-compatible' content='ie=edge'>
    <!-- IMPORTANT: No CSS link needed as of v1 Beta (@next) - It's all inlined -->
    <!-- Pre v1.0.0 versions need the minified css -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel='stylesheet' href='https://unpkg.com/v-calendar/lib/v-calendar.min.css'> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sample.css') }}" rel="stylesheet">
  </head>
  <style>
      body{
          background: #ffffff;
      }
      .vc-rounded-full:hover{
        background: #19B9FD;
        border: 1px solid #19B9FD;
      }

      .events{
          position: relative;
          top: 5rem;
      }

      input.form-control{
          width: 5rem;
      }

  </style>
  <body>

    <div class="container col-md-6 events">

        <div class="nav">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="#">One-time</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/recurring_event">Recurring</a>
                  </li>
              </ul>
        </div>
        <div id='app' class="mt-5">
            <p> Choose dates</p>
            <v-calendar></v-calendar>
        </div>

        <div class="row mt-5">
            <p class="ml-3"> At: </p>
             <input type="number" class="form-control ml-3" placeholder="12">
            <p class="ml-3"> : </p>
            <input type="number" class="ml-3 form-control" placeholder="00">
            <div class="mt-2">
                <input  type="radio" class="ml-3" value="am" checked>
                <label > am </label>
                <input type="radio" class="ml-3"  value="pm" > <label> pm </label>
            </div>
        </div>
        <p class="mt-3">  Summary: <span class="font-weight-bold">On the 15th at 12:00am </span></p>

        <div class="mt-3">
            <p> Choose contacts</p>

            <div >

                <select name="" id="" class="form-control" >
                <option value="" selected disabled> Type in email address or add persons or tags from your contacts</option>
                </select>
            </div>
        </div>

        <hr>

        <div class="d-flex footer justify-content-end">
            <button class="btn btn-default mr-3"> Cancel </button>
            <button class="btn btn-primary"> Schedule send</button>
        </div>

    <div style="height: 2rem"></div>
    </div>
    <script src='https://unpkg.com/vue/dist/vue.js'></script>

    <script src='https://unpkg.com/v-calendar@next'></script>
    <script>
      new Vue({
        el: '#app',
        data: {
          // Data used by the date picker
          mode: 'single',
          selectedDate: null,
        }
      })
    </script>


  </body>
</html>
