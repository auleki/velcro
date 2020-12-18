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

      {{-- <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet"> --}}
      <link href="{{ asset('css/investor.css') }}" rel="stylesheet">
      <link href="{{ asset('css/company.css') }}" rel="stylesheet">
      <script src="{{asset('js/sidebar.js')}}" defer></script>

  </head>
  <style>
      select{
          width: 100% !important;
      }
  </style>
  <body>

    <div class="wrapper">
      @include('layouts.sidebar')
    </div>
    <main class="wholeContent">

      <div class="mt-4 ml-5">
          <h2 class="mt-1"> Add Company </h2>
          {{-- <a role="button" href="" class="btn btn-primary ml-auto"> <i class="fas fa-plus"></i> Add Company</i></a> --}}

      </div>

      <div class="d-flex justify-content-center">
        <form action="/add_company" class=" col-md-6 col-sm-12 mb-5" method="post">


          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
          </div>
          {{-- <img src="uploads/{{ Session::get('file') }}"> --}}
          @endif
            @csrf
          <div class="form-group mb-2">
            <label for="c_name"> Company Name</label>
            <input type="text" class="form-control" name="c_name" value="{{old('c_name')}}">
            @error('c_name')
                <span class="invalid-feedback" role="alert">
                    <strong>The company name field is required</strong>
                </span>
            @enderror
          </div>

          <div class="form-group mb-2">
            <label for="website"> Company Website</label>
            <input type="text" class="form-control" name="website" value="{{old('website')}}">
            @error('website')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class=" mb-2">
            <label for="country"> Primary Contact </label>          
            <select name="contact_id" id="contact_id" class="form-control" value="{{old('contact_id')}}">
              <option value=''>Select Contact</option>
              @if (count($contacts) > 0)
               @foreach ($contacts as $contact)
                <option value="{{ $contact->id }}">{{$contact->fname}} {{$contact->lname}}
                </option>
                @endforeach
                @endif
            </select>
             @error('contact_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group mb-2">
            <label for="email"> Company email</label>
            <input type="email" class="form-control" name="email" value="{{old('email')}}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>


          <div class="form-group mb-2">
            <label for="country"> Country </label>
            <select name="country" id="country_id"class="form-control" value="{{old('country')}}">
              <option> </option>
            </select>
            @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group mb-2">
            <label for="tags"> Tags</label>
            <input type="text" class="form-control" name="tags" placeholder="Type in one or more tags to select" value="{{old('tags')}}">
          </div>

          <div class=" row">
            <div class="col-md-6 col-sm-12">
              <label for="stage"> Fund Stage</label>
              <select name="stage" id=""class="form-control" value="{{old('stage')}}">
                <option> Seed </option>
                <option> Series A</option>
                <option> Series B</option>
              </select>
              @error('stage')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-md-6 col-sm-12 mt-2 mt-md-0">
              <label for="status"> Investment status</label>
              <select name="status" id=""class="form-control" value="{{old('status')}}">
                <option> Open </option>
                <option> close</option>
              </select>
              @error('status')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

           <div class="form-group mb-2">
            <label for="lead"> Lead</label>
            <input type="text" class="form-control" name="lead" placeholder="Enter lead" value="{{old('lead')}}">
          </div>

           <div class="form-group mb-2">
            <label for="analyst"> Analyst</label>
            <input type="text" class="form-control" name="analyst" placeholder="Enter lead" value="{{old('analyst')}}">
          </div>


          <div class="row ml-1 mt-3">
            <button class="btn btn-primary"> Save</button>
            <button class="btn ml-3 btn-default"> Cancel</button>
          </div>

        </form>
      </div>
    </main>
    <script>
      $.ajax({
             url: 'https://restcountries.eu/rest/v2/all'
         }).done(res => {
             let options = `<option  selected disabled> Select Country</option>`
             let countries = res
             for (let i = 0, length = countries.length; i < length; i++) {
                 options += `<option value='${countries[i].name}'> ${countries[i].name } </option>`
             }
             $('#country_id').html(options)

         }).fail(err => {
             console.log(err)
         })

    </script>

  </body>
</html>







