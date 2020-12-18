<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <m    eta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Chart</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
      
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

      <!-- Scripts -->
      <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
<style>
    <style>
    .add-header a{
        color: #333333; 
        font-size: 18px;
      
    }
  .exact-class{
        border-bottom: 2px solid #19B9FD;
    }
    .card-header{
        border-bottom: none;
        background: #EEEEEE;
    }

    .side-section{
        
        height: 100vh;
    }

    .wholeContent{
        width: 85%;
    }

    @media (max-width: 500px){
        .wholeContent{
            width: 100% !important;
        }

        select{
            width: 100% !important;
        }
    }

    .add-header a:hover{
        opacity: 0.6;
        padding-left: 5px;
    }
</style>
   
</style>
<body>
    <div class="wrapper">
      @include('layouts.sidebar')
    </div>
    
    <main class="wholeContent mt-2"> 
        <div class="row">
            <div class="col-xl-7 col-md-7 col-sm-12">
                <div class="heading mt-4 ml-5 float-left">
                    <a class="text-info lead    text-wrap" href="/dashboard1"> <i class="fas fa-chevron-left"></i> Back to Dashboard </a>
                </div>
                <div class="body">
                    <div class="ml-n5 col-sm-12 mt-3 pt-3 row justify-content-center">
                    <div class="col-md-11 col-sm-6 ml-5  ">
                        <div class=" ml-1 mt-3">
                        {{-- <h4>Coca-Cola</h4> --}}
                        <div class="row " style="margin-left: .1em">
                            <p> Sales and Exit</p>
                            <i class="fas fa-chevron-down ml-auto"> </i>
                        </div>
                        </div>
                        <div>
                        <canvas id="myChart" width="400" height="400"></canvas>
                        <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Q1  2018', 'Q2 2018', 'Q3 2018', 'Q4 2018'],
                                    datasets: [{
                                    
                                    minBarLength: 9,
                                        label: 'Exit',
                                        data: [300000, 370000, 370000, 600000],
                                        backgroundColor: [
                                        // RGBA(253,6,6,1)
                                            'rgba(122, 239, 31, 1)',
                                            'rgba(122, 239, 31, 1)',
                                            'rgba(122, 239, 31, 1)',
                                            'rgba(122, 239, 31, 1)'
                                            
                                            // 'rgba(256, 46, 36, 1)'
                                        
                                        ],
                                    
                                        borderWidth: 1
                                    },
                                    {
                                    
                                    minBarLength: 9,
                                        label: 'Investment',
                                        data: [100000, 400000, 440000, 780000],
                                        backgroundColor: [
                                            'RGB(25,185,253, 1)',
                                            'RGB(25,185,253, 1)',
                                            'RGB(25,185,253, 1)',
                                            'RGB(25,185,253, 1)',
                                        
                                        ],
                        
                                        borderWidth: 1
                                    }
                                ]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true,
                                                stacked: true
                                            }
                                        }]
                                    }
                                }
                            });
                            </script>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            {{-- <div class="verticalLine"></div>             --}}
            <div class="col-md-5 col-xl-5 col-sm-12 ml-md-n3 pl-md-2 m-3 pt-4 mt-md-n2 side-section">
                <div class="add-header d-flex justify-content-between" >  
                    <div>
                     <a href="/add_chart" class="exact-class text-black-50 lead" >Metric </a>
                     <a href="/export_report" class="ml-3 text-black-50 lead" >Export </a>
                    </div>
                     <div class=""> 
                        <button class="btn btn-default"> Cancel</button>
                         <button class="btn btn-primary"> Save</button>
                     </div>
 
                 </div>

                <div class="form mt-4">
                    <form action="" class="form-group">
                        <div class="form-group">
                            <label for="">Size</label>
                            <select name="" id="" class="form-control mt-n2">
                                <option value=""> Powerpoint (16:1) </option>
                                <option value=""> Standard (600 x 400) </option>
                            </select>
                        </div>

                        <p class="mt-4"> Format</p>
                        <div class="form-check mt-n2">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                            <label class="form-check-label" for="exampleRadios1">
                              Microsoft Excel (.xlxs)
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" checked>
                            <label class="form-check-label" for="exampleRadios2">
                              PNG
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" >
                            <label class="form-check-label" for="exampleRadios3">
                              PDF
                            </label>
                          </div>

                          <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                              Save to Google drive as CSV file
                            </label>
                          </div>

                          <button class="btn btn-dashboard mt-4 "> Export</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>