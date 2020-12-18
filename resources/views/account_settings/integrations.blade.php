<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Integrations</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        {{-- <link ‎href="https://fonts.adobe.com/fonts/europa" rel="stylesheet"> --}}
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:300,600" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/report.css') }}">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="location/to/intl-tel-input/css/intlTelInput.css">
        <script src="location/to/intl-tel-input/js/intlTelInput.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    
    </head>
    <style>
         @media(max-width: 700px){
            .wholeContent{
                width: 96%;
                margin: 2%;
            }   
            .account_header{
                margin: 0rem 2rem 1.5rem 2rem;
            }
          
        }
        .btn-default{
            background: #C4C4C4 !important;
            color: #fff !important;
        }
    </style>
    <body>
        <div class="wrapper">
            @include('layouts.sidebar')
          </div>

        <div class="container-fluid">

                <div class="wholeContent">
                  
                    <div class="row">
                        <div class="col-md-3 mt-5 pt-4 ">
                            <aside>
                                <div class="list-group list-group-flush border">
                                    <a href="/profile" class="list-group-item list-group-item-action permission " style="color: #333333"> My profile</a></li>
                                    <a href="/permissions" class="list-group-item list-group-item-action border-none permission" style="color: #333333"> Permissions</a></li>
                                    <a href="/integrations" class="list-group-item list-group-item-action border-none permission" style="color: #333333"> Integrations</a></li>
                                </ul>
                            </aside>
                        </div>

                        <div class="col-md-9 mt-5">
                            <div class="integrations profile-form">
                                <h3 class="font-weight-bold"> Integrations </h3>

                                <div class="row ml-1 mt-4">
                                    <img src="{{ asset('css/echovc_icons/Group 246.png') }}" style="width: 50px; height: 50px;" alt="">
                                    <div class="col">
                                        <h6> Twitter </h6>
                                        <p> View your timeline on the home page</p>
                                        <div class="row">
                                            <a href="/authorize_twitter" class="btn btn-default ml-3"> Add twitter integration</a>
                                                    
                                            <a  href="" class="text-info ml-3 mt-1"> Disconnect </a>
                                        </div>
                                    </div>                 
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html> 

