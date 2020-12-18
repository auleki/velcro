<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>LifeBank</title>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
      
      <link href="{{ asset('css/company.css') }}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:300,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

  </head>
  <body>
    <style>
        .wholeContent{
            width: 100% !important;
        }
        .funding-form{
            margin-top: 7%;
            left: 0%;
        }
    </style>

   
    <section class="wholeContent ml-3 ">
    
        <div class="funding-form col-8">
            
        <h2> Funding </h2>
            <form action="">
                <div class="row form-group">
                    <div class="col-6">
                        <label for=""> Fund name</label>
                        <input type="text" placeholder="" requierd class="form-control">
                    </div>

                    <div class="col-6">
                        <label for=""> Committed </label>
                        <input type="text" placeholder="" requierd class="form-control">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="text-muted small"> Tranche 1</p>
                        <label for="" > Tranche value </label>
                        <input type="text" placeholder="" requierd class="form-control">
                    </div>

                    <div class="col-6" style="margin-top: 3.2em">
                        <label for=""> Tranche funding date </label>
                        <input type="date" placeholder="" requierd class="form-control">
                    </div>

                </div>

                <div class="float-right">
                    <a href="" class="text-info"> <i class="fas fa-plus"></i> Add tranche</a>
                </div>

                <div class="float-left mt-4">
                    <a href="" class="text-info"> <i class="fas fa-plus"></i> Add fund</a>
                </div>

                <div class="d-flex justify-content-end" style="margin-top: 5.6em">
                    <button class="btn btn-primary" style="width: 97px"> Save</button>
                </div>

            </form>
        </div>
    </section>
  </body>
</html>