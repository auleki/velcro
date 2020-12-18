<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
    {{-- <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <title>Echo CV</title>
</head>
<body>
    {{-- Nav --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
     <div class="container">
        <nav class="navbar navbar-light ">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('css/icons/echoVC (dark).png') }}" style=" " class="d-inline align-top"  alt="" />
              
            </a>
          </nav>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ml-5">
            <a class="nav-link" href="#privacy">Privacy Policy</a>
            </li>
          
            <li class="nav-item ml-5">
                <a class="nav-link btn btn-outline-dark rounded-pill" role="button" href="/login" tabindex="-1" aria-disabled="true">Login</a>
            </li>
        </ul>
        </div>
            </div>
        </nav>

      {{-- End Nav --}}

      {{-- Header / cover area --}}
      <div class="cover-img " >
          <div class=" text-center text-white " style="padding-top: 5rem">
            <h1> EchoVC Portfolio Management System</h1>
            <p class="text-wrap col-md-5 col-xl-4 col-sm-8 mx-auto" > 
                Echo VC Portfolio Management System is a product built to enhance the team’s productivity by providing a platform for tracking investment portfolios,
                 analyze funding to enhance the company’s decision-making on startups in need of seed-funding.
            </p>

            <button class="btn btn-trial "> Start Free Trial Today</button>
          </div>
    

          <div class="landing-img"></div>
             <div class="description text-center">
                <h3> A solution for every need</h3>
                <!-- <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. </p> -->

                <div class="card-deck col-md-10 col-sm-12  mx-auto my-5" >
                    <div class="card">
                        <svg width="60" height="60" class="mx-auto mt-3" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.33333 3.49999H11.6667V9.33333H2.33333V3.49999ZM11.6667 10.5C11.9761 10.5 12.2728 10.3771 12.4916 10.1583C12.7104 9.93949 12.8333 9.64275 12.8333 9.33333V3.49999C12.8333 2.85249 12.3083 2.33333 11.6667 2.33333H2.33333C1.68583 2.33333 1.16667 2.85249 1.16667 3.49999V9.33333C1.16667 9.64275 1.28958 9.93949 1.50838 10.1583C1.72717 10.3771 2.02391 10.5 2.33333 10.5H0V11.6667H14V10.5H11.6667Z" fill="#555555"/>
                            </svg>
                            
                      <div class="card-body">
                        <h5 class="card-title">Portfolio Companies</h5>
                        <p class="card-text">Compare financial performance of each company within your portfolios, based on financial seed investment or revenue over different periods of time.</p>
                        <!-- <a href="" class="text-info"> Learn More</a> -->
                      </div>
                     </div>
                    
                     <div class="card">
                        <svg width="60" height="60" class="mx-auto mt-3" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.33333 3.49999H11.6667V9.33333H2.33333V3.49999ZM11.6667 10.5C11.9761 10.5 12.2728 10.3771 12.4916 10.1583C12.7104 9.93949 12.8333 9.64275 12.8333 9.33333V3.49999C12.8333 2.85249 12.3083 2.33333 11.6667 2.33333H2.33333C1.68583 2.33333 1.16667 2.85249 1.16667 3.49999V9.33333C1.16667 9.64275 1.28958 9.93949 1.50838 10.1583C1.72717 10.3771 2.02391 10.5 2.33333 10.5H0V11.6667H14V10.5H11.6667Z" fill="#555555"/>
                            </svg>
                            
                      <div class="card-body">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">Create blog-like content curated specially to all contact-persons within your investment portfolio directly to their email accounts</p>
                        <!-- <a href="" class="text-info"> Learn More</a> -->
                      </div>
                    </div>

                    <div class="card">
                        <svg width="60" height="60" class="mx-auto mt-3" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.33333 3.49999H11.6667V9.33333H2.33333V3.49999ZM11.6667 10.5C11.9761 10.5 12.2728 10.3771 12.4916 10.1583C12.7104 9.93949 12.8333 9.64275 12.8333 9.33333V3.49999C12.8333 2.85249 12.3083 2.33333 11.6667 2.33333H2.33333C1.68583 2.33333 1.16667 2.85249 1.16667 3.49999V9.33333C1.16667 9.64275 1.28958 9.93949 1.50838 10.1583C1.72717 10.3771 2.02391 10.5 2.33333 10.5H0V11.6667H14V10.5H11.6667Z" fill="#555555"/>
                            </svg>
                            
                      <div class="card-body">
                        <h5 class="card-title">Metrics</h5>
                        <p class="card-text"> Link your PMS account with your Google, Xero, Airtable and Trello accounts; allowing you to work with spreadsheets from your Google Sheet files as well as import data from Trello, Airtable and Xero to the platform seamlessly</p>
                        <!-- <a href="" class="text-info"> Learn More</a> -->
                      </div>
                    </div>
                    
             </div>

        </div>
        <hr>
        <div class="mb-5 row container analy">
            <div class=" mt-5 pt-5 col-md-6 col-sm-12">
                <h1 class="col-12">  EchoVC analyzes your business from every direction.</h1>
                <div class="ml-3 analysis">
                    <p> <i class="fas fa-check-circle" style="color: #5cb85c"></i> Create profiles for startup companies needing investment.</p>
                    <p> <i class="fas fa-check-circle" style="color: #5cb85c"></i> Send and share updates with contacts and end-users.</p>
                    <p> <i class="fas fa-check-circle" style="color: #5cb85c"></i> Analyze data for each of your Portfolio Companies.</p>
                    <button class="btn btn-primary btn-lg"> Get a Free Consultation</button>
                </div>

            </div>

            <div class="   col-md-6 mt-5 pt-5">
                <div class="row ">
                    <img  src="{{ asset('css/echovc_icons/Mask.png') }}" width="500" height="300"  alt="">
                    {{-- <img class="ml-3" src="{{ asset('css/echovc_icons/Mask 2.png') }}" width="200" height="200"  alt=""> --}}
                </div>
            </div>
        </div>
        <hr>
        <div class="mb-5 row container analy" id='privacy'>
            <div class=" mt-5 pt-5 col-sm-12">
                <h1 class="col-12 text-center"> <span> EchoVC Privacy Policy </span></h1>
                <div class="ml-3 analysis">
                    <h3 class='mt-3 mb-3' style="color: #000">Additional Limits on Use of Your Google User Data: If you provide the App access to your Google data, the App's use of that data will be subject to these additional restrictions:</h3>

                    <p> <i class="fas fa-check-circle" style="color: #5cb85c"></i>The App will only use access to read, write, modify, or control Google spreadsheets and will not transfer this Google spreadsheets data to others unless doing so is necessary to provide and improve these features, comply with applicable law, or as part of a merger, acquisition, or sale of assets.</p>
                    <p> <i class="fas fa-check-circle" style="color: #5cb85c"></i>The App will not use this Google spreadsheets data for serving advertisements.</p>
                    <p> <i class="fas fa-check-circle" style="color: #5cb85c"></i>The App will not allow humans to read this data unless we have your affirmative agreement for specific messages, doing so is necessary for security purposes such as investigating abuse, to comply with applicable law, or for the App's internal operations and even then only when the data have been aggregated and anonymized.</p>

                </div>

            </div>
        </div>

        <hr>

        {{-- <div style="height: 10rem"></div> --}}

        <footer class="  p-5 ">
            <div class="footer m-2 row">
                <div class="col-md-3 col-sm-6 ">
                    <ul class="list-unstyled">
                        <p> Resources</p>
                        <li><a href="">Home </a></li>
                        <li><a href="">Dashboard </a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6">
                    <ul class="list-unstyled">
                        <p> Product</p>
                        <li><a href="">Help </a></li>
                        <li><a href="">FAQ </a></li>
                        <li><a href="#privacy">Privacy Policy </a></li>
                        <li><a href="">Terms & Condition </a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6">
                    <ul class="list-unstyled">
                        <p> Get Social</p>
                        <div class="social ml-1  row">
                            <i class="fab fa-facebook-f "></i>
                            <i class="fab fa-twitter ml-2"></i>
                            <i class="fab fa-linkedin ml-2"></i>
                            <i class="fab fa-instagram ml-2"></i>
                        </div>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6">
                    <ul class="list-unstyled">
                        <p> Sign up for Newsletter</p>
                        
                        <input type="text" placeholder="Enter Email Address" class="form-control">  <button class="btn mt-2 btn-primary">Subscribe</button>
                    </ul>
                </div>
                


                

            </div>
            <hr class="bg-white">

            <p class="text-center"> &copy; Copyright EchoVC </p>
        </footer>
        {{-- <div style="height: 10rem"></div> --}}
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      
</body>
</html>