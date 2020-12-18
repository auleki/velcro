<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Backup</title>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
      {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"> --}}
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
      <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
      
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

      <!-- Scripts -->
      <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>

      {{--  <script src="{{ asset('js/app.js') }}" defer></script>  --}}
      
  </head>

  <style>
      .btn-auth{
          width: 40ch;
          background: #0F894C;
      }
  </style>
  <body>
   
    <div class="wrapper">
        @include('layouts.sidebar')     
      </div>
      
      <main class="wholeContent mt-2  ">    
        
        <section class="main-section">
            <div class="wholeContent">
                <div class="heading row mt-3 mb-5">
                    <div class="mr-auto"> <h3>Backup</h3></div>
                </div>
                 @if (session('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
            {{ session('success') }}
          </div>
        @endif

           @if (session('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                {!! session('error') !!}
                            </div>
                        @endif

                <div class="body  mt-4">
                   <div class="row align">
                        <h5> Backup & Sync </h5>
                        @if ($setting)
                            <div class="" style="position:relative; top: .76px; left: 2em">
                            <small class="text-muted"> off</small>
                            <label class="switch  ml-2">
                               <input type="checkbox" data-id="1" name="status" class="js-switch" name="status" {{ $setting->status ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                            <small class="font-weight-bold"> on</small>
                        </div>
                        @else
                            <div class="" style="position:relative; top: .76px; left: 2em">
                              <p>Create a backup schedule to enable backup status<p>
                            </div>
                        @endif
                        
                   </div>    

                     {{--  <div class="mt-4 align">
                         <h5> Authentication</h5>
                         <p class="text-wrap col-7 ml-n3">
                            The Google drive integration is present on this software but you must configure it 
                            if you would like to import and sync files from Google Drive
                         </p>

                         <button class="btn btn-lg btn-auth col-7 btn-success"> Authenticate your Google Drive Account </button>
                     </div>  --}}
                </div>

               <form action="{{url('/')}}/admin/backup/save" method="post">
                 @csrf
                  @if ($setting)
                  <div class="mt-5 align">
                      <h5> Schedule</h5>
                      <div class="ml-0 mt-4 row">
                          <p class="mt-2"> Frequency</p>
                          <select name="interval" id="" class="form-control col-2 ml-3">
                               @foreach($frequencies as $key => $value)
                                  <option value="{{$key}}" {{($setting->interval == $key) ? 'selected' : ''}}>{{$value}}</option>
                               @endforeach
                          </select>

                          <p class="ml-4 mt-2"> Every</p>
                          <input type="number" name="day" value="{{$setting->day}}" placeholder="4" class="form-control ml-3 col-2">
                          <p class="ml-4 mt-2"> Months</p>
                      </div>
                      <div class="ml-0 mt-4 row">
                          <p class="mt-2"> At</p>
                          <input type="number" value="{{$setting->hour}}"  min="00"  max="24" name="hour" maxlength="2" placeholder="12" class="form-control ml-3 col-1">    

                          <h2 class="ml-4"> : </h2>
                          
                          <input type="number"  maxlength="2"  min="00"  max="60" placeholder="00" class="form-control ml-3 col-1">
                          
                          <div class="custom-control custom-radio ml-4 custom-control-inline mt-2">
                              <input type="radio" id="customRadioInline1" name="daylight" class="custom-control-input" value="am" {{($setting->daylight == 'am') ? 'checked' : ''}} >
                              <label class="custom-control-label" for="customRadioInline1"> am </label>
                            </div>
                            <div class="custom-control mt-2 custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInline2" name="daylight" class="custom-control-input" value="pm">
                              <label class="custom-control-label" for="customRadioInline2"> pm </label>
                            </div>
                          </div>


                          <button type="submit" class="btn btn-primary mt-5"> Save </button>
                  </div>
                      
                  @else
                      <div class="mt-5 align">
                      <h5> Schedule</h5>
                      <div class="ml-0 mt-4 row">
                          <p class="mt-2"> Frequency</p>
                          <select name="interval" id="" class="form-control col-2 ml-3">
                               @foreach($frequencies as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                               @endforeach
                          </select>

                          <p class="ml-4 mt-2"> Every</p>
                          <input type="number" name="day" placeholder="4" class="form-control ml-3 col-2">
                          <p class="ml-4 mt-2"> Months</p>
                      </div>
                      <div class="ml-0 mt-4 row">
                          <p class="mt-2"> At</p>
                          <input type="number"   min="00"  max="12"  maxlength="2" placeholder="12" class="form-control ml-3 col-1">    

                          <h2 class="ml-4"> : </h2>
                          
                          <input type="number"  maxlength="2"  min="00"  max="60" placeholder="00" class="form-control ml-3 col-1">
                          
                          <div class="custom-control custom-radio ml-4 custom-control-inline mt-2">
                              <input type="radio" id="customRadioInline1" name="daylight" class="custom-control-input" value="am">
                              <label class="custom-control-label" for="customRadioInline1"> am </label>
                            </div>
                            <div class="custom-control mt-2 custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInline2" name="daylight" class="custom-control-input" value="pm">
                              <label class="custom-control-label" for="customRadioInline2"> pm </label>
                            </div>
                          </div>


                          <button type="submit" class="btn btn-primary mt-5"> Save </button>
                  </div>
                  @endif
               </form>

                <div class="mt-5 mb-5 align card p-2">
                    <h5> Backup history </h5>
                     @if(!$backups)<p>No backups available</p> @endif
                  @if($backups)
                    <table class="table mt-3 table-borderless table-hover table-lg table-sm bg-white p-3" style="top: 0rem;">
                        <thead>
                          <tr class="table-active text-uppercase">
                            <th scope="col">Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Createdat</th>
                            <th scope="col">Status</th>
                            {{--  <th scope="col"> Action</th>  --}}
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($backups as $backup)
                              <tr>
                              <td>Google Drive</td>
                              <td>{{$backup['size']}}</td>
                              <td>{{$backup['date']}}</td>
                              <td class="text-success"> Succesful</td>
                               {{--  <td>{{$backup['path']}}</td>  --}}
                                {{--  <td class="text-right pr-3 text-center">
                                    <a href="/backups/api/download-backup?disk=local&amp;path={{$backup['path']}}" target="_blank" rel="noopener nofollow" class="mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path  d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z" class="heroicon-ui"></path>
                                        </svg>
                                    </a>
                                    <a onclick="event.preventDefault();
                                      document.getElementById('backup-form').submit();" href="{{ url('/')}}/admin/backup/local/delete"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path  d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z" class="heroicon-ui"></path>
                                        </svg>
                                    </a>

                                    <form id="backup-form" action="{{ url('/')}}/admin/backup/local/delete" method="POST" style="display: none;">
                                        @csrf
                                        <input type="text" name="disk" value="local">
                                        <input type="text" name="path" value="{{$backup['path']}}">
                                    </form>
                                </td>  --}}
                            </tr>
                          @empty
                              <tr>
                              No backups available
                              </tr>
                          @endforelse
                          
                          
                        </tbody>
                    </table>
                  @endif
                </div>
            </div>
        </section>
      </main>

 

      <script>



    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('/admin/backup/status')}}',
            data: {'status': status},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script>

  </body>
</html>