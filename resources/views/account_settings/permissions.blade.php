<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Account Settings</title>
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

        .btn-sm{
            height: 40px;
        }
    </style>
    <body>
        <div class="wrapper">
            @include('layouts.sidebar')
          </div>

        <div class="container-fluid">

            <div class="wholeContent">
                <div class="mt-4 ml-3 d-flex justify-content-between">
                    <h3 class="account_header font-weight-bolder"> Account settings</h3>
                    <button class="btn btn-primary btn-sm samll-bnt "  data-toggle="modal" data-target="#exampleModal"> Add user</button>
                </div>
                <div class="row">
                    <div class="col-md-3 mt-5 ">
                        <aside>
                            <div class="list-group list-group-flush border">
                                <a href="/profile" class="list-group-item list-group-item-action permission " style="color: #333333"> My profile</a></li>
                                <a href="/permissions" class="list-group-item list-group-item-action border-none permission" style="color: #333333"> Permissions</a></li>
                                <a href="/integrations" class="list-group-item list-group-item-action border-none permission" style="color: #333333"> Integrations</a></li>
                            </ul>
                        </aside>
                    </div>

                    
                    <div class="col-md-9">
                     {{--  Users Component  --}}
                      @livewire('users')
                      {{--  End users Component  --}}

              
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Invite new user</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fas fa-times "></i>
                  </button>
                </div>
                <div class="modal-body">
                      <div class=" ">
          
          
                          <div class="inputs ml-1 col-12">
                          <form method="post" action="/admin/send/invite">
                              @csrf
                              <div class="row">
                                  <div class="col-md-6 col-sm-6 col-12 mb-3">
                                      <input type="text" name="email" class="form-control" placeholder="enter  email address">
                                  </div>
                                   <div class="col-md-6 col-sm-6 col-12 mb-3">
                                     <select name="permission" id="" class="ml-auto form-control">
                                      <option value="admin">Admin</option>
                                      <option value="edit">Edit</option>
                                      <option value="view">View</option>
                                     </select>
                                  </div>
                                   <button class="btn btn-primary ml-5 btn-invite text-center mx-auto" type="submit"> Invite </button>
                              </div>
          
                          </form>
                          </div>
          
                          <hr class="shadow mt-4">
          
          
                          <div class="pending">
                              <h4> Pending invites</h4>
                               @forelse ($invites as $invite)
                              <div class="row" style="margin-left: 0em">
                                  <p> {{$invite->email}}</p>
                                  <select name="permission" id="permission_select" class="ml-auto form-control selecter">
                                     @foreach($permissions as $key => $value)
                                       <option value="{{url('admin/permission')}}/{{$key}}/{{$invite->id}}" {{($invite->permission == $key) ? 'selected' : ''}}>{{$value}}</option>
                                      @endforeach
                                      {{--  <option value="admin">Admin</option>
                                      <option value="edit">Edit</option>
                                      <option value="view">View</option>  --}}
                                  </select>
                                  <h4 class="mr-4 ml-2 mt-2"> <a class="text-black-50 remove-record" data-toggle="modal" data-url="{{url('/admin/invite/delete/')}}/{{$invite->id}}" data-id="{{$invite->id}}" data-target="#custom-width-modal"> <i class="fas fa-times "></i> </a></h4>
                              </div>
                              @empty
                              <div class="row" style="margin-left: 0em">
                                  <p> No pending invites</p>
                              </div>
                              @endforelse
          
                          </div>
                      </div>
                </div>
          
              </div>
            </div>
          </div>
              {{--  modal here  --}}
              <!-- Delete Model -->
          <form action="" method="POST" class="remove-record-model">
              <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog" style="width:55%;">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="custom-width-modalLabel">Delete Record</h4>
                              <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
                          <div class="modal-body">
                              <h4>You Want You Sure Delete This Record?</h4>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
          
          {{--  Endmodal  --}}
                @livewireScripts
          <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
              @include('sweetalert::alert')
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
             <script src="https://use.fontawesome.com/2c7a93b259.js"></script>
             <script>
              $(document).ready(function(){
                  //Changing invite permission
                  // bind change event to select
                $('#permission_select').on('change', function () {
                    var url = $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                    return false;
                });
          
              // For A Delete Record Popup
              $('.remove-record').click(function() {
                  var id = $(this).attr('data-id');
                  var url = $(this).attr('data-url');
                  var token = '{{ csrf_token() }}';
                  $(".remove-record-model").attr("action",url);
                  $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
                  $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
                  $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
              });
          
              $('.remove-data-from-delete-form').click(function() {
                  $('body').find('.remove-record-model').find( "input" ).remove();
              });
              $('.modal').click(function() {
                  // $('body').find('.remove-record-model').find( "input" ).remove();
              });
          });
          
             </script>
    </body>
</html>