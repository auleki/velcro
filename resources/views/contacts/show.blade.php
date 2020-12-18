<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Update Contact</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <!-- Styles -->
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

      <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
                  <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <style media="screen">

      .btnDelCon:focus, .btnDelCon:focus {
        box-shadow: 0 0 0 0 rgba(0,0,0,0)!important;
        outline: 0px auto -webkit-focus-ring-color;
      }

      </style>
  </head>
  <body>
    <div class="wrapper">
      @include('layouts.sidebar')
    </div>

    <main class="wholeContent">
      @include('inc.messages')

      <section class="header searchContact">
        <div class="rep">Contacts</div>
      </section>
      <section class="eachContact">
        <div class="actionBtn">
          <a href="/contacts" class="btnBack">&times;</a>
          <form action="{{ route('contacts.destroy', $contacts->id) }}" method="POST" class="formDelCon">
            <button type="button" class="btnDelCon" data-toggle="modal" data-target="#myModal" id="open">
              <img src="{{ asset('css/icons/contactEdit.png') }}"/></button>
                 @csrf
                 @method('DELETE')
            <button type="submit" class="btnDelCon"><img src="{{ asset('css/icons/contactDel.png') }}"/></button>
           </form>
        </div>
        <div class="conName">
          <img src="https://via.placeholder.com/150x150/50E3C2/FFFFFF.png?text={{ ucwords($contacts->fname[0]) }}{{ ucwords($contacts->lname[0]) }}" />
          <h4>{{ ucwords($contacts->fname) }} {{ ucwords($contacts->lname) }}</h4>
        </div>
        <div class="">
          <h5>Details</h5>
          <div class="conDetails conEmailPhone"><img src="{{ asset('css/icons/contactMail.png') }}"/> {{ $contacts->email }}</div>
          <div class="conDetails conEmailPhone"><img src="{{ asset('css/icons/contactPhoneNo.png') }}"/> {{ $contacts->phoneNo }}</div>
          <div class="conDetails"><img src="{{ asset('css/icons/contactCompany.png') }}"/> {{ ucwords($contacts->company) }}</div>
          <div class="conDetails"><img src="{{ asset('css/icons/contactTitle.png') }}"/> {{ $contacts->title }}, {{ $contacts->tags }}</div>
          <hr>
          <small>Updated last on {{ $contacts->updated_at }}</small>
          <hr>
        </div>
      </section>
    </main>


    <!-- Modal to update new contact -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal" aria-labelledby="details-l" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('contacts.update', $contacts->id) }}">
              @csrf
              @method('PATCH')
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Create Contact</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <div class="row">
                        <div class="form-group col-md-12 mr-2 ml-2" style="display:flex; justify-content:space-between">
                          <div class="fname">
                            <input type="text" class="form-control conForm" name="fname" value="{{ $contacts->fname }}">
                          </div>
                          <div class="lname">
                            <input type="text" class="form-control conForm" name="lname" required value="{{ $contacts->lname }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12 mr-2 ml-2">
                          <input type="email" class="form-control conForm" name="email" required value="{{ $contacts->email }}">
                        </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-md-12 mr-2 ml-2">
                          <input type="tel" class="form-control conForm" name="phoneNo" value="{{ $contacts->phoneNo }}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12 mr-2 ml-2">
                          <input type="text" class="form-control conForm" name="company" value="{{ $contacts->company }}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12 mr-2 ml-2">
                          <input type="text" class="form-control conForm" name="title" value="{{ $contacts->title }}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12 mr-2 ml-2">
                        <input type="text" class="form-control conForm" name="tags" value="{{ $contacts->tags }}">
                        </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer" style="justify-content:flex-start!important; padding:1.5rem!important">
                  <button type="submit" class="btn btn-save" style="background:#ddd; float:left!important">Save</button>
                  <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>

  </body>
</html>
