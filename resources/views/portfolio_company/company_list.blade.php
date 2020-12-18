<?php
  use App\Services\Color;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Company List</title>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

      <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
      <link href="{{ asset('css/company.css') }}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:300,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

  </head>
  <style>
    .form-control{
      width: 100% !important;
    }
    .searchFilter{
        width: 20% !important;
        float: left;
        padding: 1.2rem 0;
        margin-left: 1%
    }

    .show_filter {
      max-width: 45%;
      float: left;
      padding: 1.2rem 0;
    }

    .clear_all {
      float: right;
      padding: 1.2rem 0;;
    }

    .mobileCon{
      display: none;
    }

    .searchForm{
        width: 30% !important;
        /* margin-left: 2.5rem; */
        padding: 1.2rem 0;
        float:left
    }
    .desktopForm{
        position: relative;
        /* left: -2.4rem; */
    }
    .wholeCon{
        width: 90%;
        position: relative;
        display: flex;
        flex-direction: column;
        left: 6.7rem;
    }

    .display__cards{
        position: absolute;
        width: 100%;
        left: 6rem;
    }

    .hide-company {
      display:none
    }

    .pointer {
      cursor: pointer
    }


  @media (max-width: 600px){
      body{
          width: 100% auto;
      }


      .wholeContent{
          width: 85%;
          position: absolute;
          top: 1rem;
          left: -1rem;
      }
  }

   @media (max-width: 500px){
    .wholeContent{
        position: absolute;
        left: 2.5rem;
     }

     .page-setup{
         z-index: -1;
     }

     .list_header{
         margin-top: -.7rem;
         margin-left: 1rem !important;
     }
    .mobileCon{
        display: block;
    }
    .wholeCon{
         display: none;
     }
    .formy{
      width: 70% !important;
      margin-left: 1rem;
      padding: 1.3rem;
    }

    .display__cards{
        position: relative;
        width: 100%;
        left: 0rem;
    }

    .searchMob{
        position: relative;
        left: -1rem;
    }

 }

 @media (max-width: 350px){
     .wholeCon{
         display: none;
     }

    .go-back{
      display: none;
    }
 }

  </style>
  <body>

    <div class="wrapper">
      @include('layouts.sidebar')
    </div>
    <main class="wholeContent">

     <div class="wholeCon ">
        <div class="row company-header">
            <h3 class="mt-1"> Portfolio Companies <small class="text-muted"> {{count($companies)}} total</small></h3>
            <a role="button" href="/add_company" class="btn btn-primary ml-auto mr-0 company-btn"> <i class="fas fa-plus"></i> Add Company</i></a>

        </div>

        <div class="mt-4 desktopForm" >
          <div class="searchForm">
            <input type="text" class="form-control " placeholder="Search notes" onkeyup="searchCompany(this)" autocomplete="off">
          </div>
                <!-- <button type="button" name="button" style="border:none"><img src={{ asset('css/icons/grsearch.svg') }} /></button> -->
          <div class="searchFilter ">
            <select name="" id="filter_portco" class= "form-control" style="padding:.2rem" onchange="selectFilter(this)" autocomplete="off">
              <option value="">Filters</option>
              <optgroup label="Fund Stage">
                <option value="Seed"> Seed</option>
                <option value="Series A">Series A</option>
                <option value="Series B">Series B</option>
                <option value="Series C">Series C</option>
              </optgroup>
              <optgroup label="Investment Status">
                <option value="open">Open</option>
                <option value="close">Exit</option>
              </optgroup>
              <optgroup label="Country" id="country_id">
              </optgroup>
            </select>
          </div>

          <div id="show_filter" class="show_filter"></div>
          <div class="clear_all">
            <p class="text-info mt-1 ml-5 pointer" id="clear_all" style="display:none" onclick="clearAll()"> Clear all</p>
          </div>


        </div>
     </div>

      <div class="mobileCon" >
        <div class=" row list_header" style="margin-left: 2rem">
          <h2 class="" style="margin-top: .7rem"> Portfolio companies </h2>
          <a href="" class="text-info mt-3 go-back  ml-auto" style="font-size: 1.1rem" > Back</a>
        </div>

        <div class="mb-5    ">
          <form class="" action=""  method="post">
            <div class="row mt-3">
              <input type="text" class="form-control formy" placeholder="Search for a company" >
              <img src={{ asset('css/icons/grsearch.svg') }} />
            </div>
          </form>

        </div>

        <div class="row searchMob">
          <div class="col-sm-6 d-flex justify-content-around">
            <button class="btn btn-primary"> <i class="fas fa-plus"></i> Add company </button>
            <button class="btn btn-outline-dark " style="width: 130px"> Filters </button>
          </div>
        </div>
      </div>

      {{-- cards --}}
      <div class="row mt-5 display__cards">
      @foreach ($companies as $company)
        <div class="col-sm-6 col-md-6 col-lg-3 company_card" data-name="{{$company->c_name}}" data-tags="{{$company->status . '_' . $company->stage . '_' . $company->country}}">
          <div class="card">
            <div class="card-body">
              <a href="/single_company/{{$company->id}}" id="logo_{{$company->id}}">
                <img src="https://logo.clearbit.com/{{$company->website}}" style="height:154px" data-id="{{$company->id}}" onerror="showPlaceholder('{{$company->id}}')" class="card-img-top mt-3" alt="...">
              </a>
              <div onclick="window.location.href='/single_company/{{$company->id}}'" class="text-center text-white" id="placeholder_{{$company->id}}" style="display:none;background:{{Color::random_color()}};height:154px;cursor:pointer">
                <a href="/single_company/{{$company->id}}" style="font-size:4rem;font-weight:700">{{$company->c_name[0]}}</a>
              </div>
              <div class="mt-2" style="height:1rem">
                  <p class="float-left">{{$company->c_name}} </p>
                  @if($company->status == 'open')
                  <p class="float-right" style="color:  #7AEF1F"> Open </p>
                  @else
                  <p class="float-right text-muted"> Exit </p>
                  @endif
              </div>
              <div class="mt-3">
                <p class="float-left" style="width:100%"> Lead: {{$company->lead}}</p>
                <p class="float-left" style="width:100%"> Analyst: {{$company->analyst}}</p>
              </div>

            </div>
          </div>
        </div>
      @endforeach
      </div>

    </main>
    <script>
      function myFunction(evt) {

        if (evt.innerHTML == 'Open') {
          evt.innerHTML = 'Closed';

        evt.style.color = "red";
        } else {
          evt.innerHTML = 'Open';

      evt.style.color = "#7AEF1F";

        }
      }
      </script>
      <script>
      $.ajax({
             url: 'https://restcountries.eu/rest/v2/all'
         }).done(res => {
             let options = '';
             let countries = res
             for (let i = 0, length = countries.length; i < length; i++) {
                 options += `<option value='${countries[i].name}'> ${countries[i].name } </option>`
             }
             $('#country_id').html(options)

         }).fail(err => {
             console.log(err)
         })

         </script>
      <script src="/js/home.js"></script>
      <script src="/js/portco.js"></script>

    </body>
</html>
