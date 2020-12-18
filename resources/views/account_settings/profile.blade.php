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
    <style type="text/css" media="screen">
        .change-email-box{
             display: none;
        }
        img.box-img{
            height: 7.625rem;
            width: 7.625rem;
            padding: 0.5rem;
            background-size: contain;
            object-fit: fill;
        }

        .box{
            background: #FFFFFF;
            height: 7.625rem;
            width: 7.625rem;
            border: 1px solid #AAAAAA;
            box-sizing: border-box;
            border-radius: 4px;
        }

        input[type="checkbox"]{
            width: 15px; 
            height: 15px; 
            margin-right: .5rem;
        }

        .form-check-input{
            position: relative;
            height: 15px;
            width: 15px;
        }

        body{
            color: #666666;
        }

        @media(max-width: 700px){
            .wholeContent{
                width: 96%;
                margin: 2%;
            }   
            .account_header{
                margin: 0rem 2rem 1.5rem 2rem;
            }

            .box{
                margin-right: auto;
                margin-left: auto;
            }

            .btn-save{
                width: 100%;
            }
        }
    </style>

    <body>
        <div class="wrapper">
            @include('layouts.sidebar')
          </div>

        <div class="container-fluid">

            <div class="wholeContent">
                <div class="mt-4 ml-3">
                    <h3 class="account_header font-weight-bolder"> Account settings</h3>
                </div>
                <div class="row">
                    <div class="col-md-3 mt-5">
                        <aside>
                            <div class="list-group list-group-flush border">
                                <a href="#" class="list-group-item list-group-item-action permission " style="color: #333333"> My profile</a></li>
                                <a href="/permissions" class="list-group-item list-group-item-action border-none permission" style="color: #333333"> Permissions</a></li>
                                <a href="/integrations" class="list-group-item list-group-item-action border-none permission" style="color: #333333"> Integrations</a></li>
                            </ul>
                        </aside>
                    </div>

                    <div class="col-md-9">
                        <div class="row mt-5">
                            <div class="col-md-7">

                                <h3> My profile</h3>
                                <form action="{{url('/profile')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="mb-3">
                                        <label for=""> First name </label>
                                       <input id="" class="form-control" type="text" name="" placeholder="Bosun" value="{{$user->fname}}">
                                       @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                       @enderror
                                    </div>

                                    <div class="mb-3 ">
                                        <label for=""> Last name </label>
                                    <input id="" class="form-control" type="text" name="" placeholder="Osamudiamen" value="{{$user->lname}}">
                                        @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for=""> Phone number </label>
                                        <input id="" class="form-control" type="tel" name="" placeholder="+234 ***" value="{{$user->phone_no}}" id="phone" >
                                        @error('phone_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">

                                        <label for="" class="row mr-0 ml-0"> 
                                            <p class="mr-auto"> Email <a href="#email" onclick="hideemail()" class=" " id="emaila" >  </p>
                                            <span class="ml-auto"> 
                                                <input id="change-email" name="change-email" class="ml-auto mt-1"  value="change-email"  type="checkbox"/>
                                                <a href="" class="text-info"> Change email </a>
                                            </span>
                                        </label>

                                        <div id="change-email-box" style="display: none">
                                            <input id="" class="form-control mt-n3" type="email" value="{{$user->email}}"  name="" placeholder="bosunosas@something.com ">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div>
                                    </div>

                                    <div class="mb-3">

                                        <label for="" class="row mr-0 ml-0"> 
                                            <p class="mr-auto"> Current Password <a href="#email" onclick="hidepass()" class=" " id="change-pass" >  </p>
                                            <span class="ml-auto"> 
                                                <input id="change-password" name="change-password" class="ml-auto mt-1 form-check-input"  value="change-email"  type="checkbox"/>
                                                <a href="" class="text-info"> Change password </a>
                                            </span>
                                        </label>
                                            {{-- <input id="" class="form-control mt-n3" type="tel" name="" placeholder="******echo "> --}}
                                            <div id="pass"  style="display: none">
                                                <input type="password" name="current-password" placeholder="********" class="form-control">
            
                                            <label for="">New Password </label>
                                            <input type="password" name="new_password" placeholder="********" class="form-control">
            
                                            <label for="">Confirm Password </label>
                                            <input type="password" name="new_password_confirm" placeholder="********" class="form-control">
                                        </div>
                                    </div>


                                    <div class="mt-3">
                                        <button class="btn btn-save btn-primary"> Save </button>
                                    </div>

                                </form>
                            </div>

                            <div class="col-md-2 mt-4 mb-5 text-center">
                                <h5> Profile Picture</h5>

                                <div class="box">
                                    <img  id="preview_image" class="box-img" src="{{asset('storage/avatars/'.$user->id.'/'.$user->avatar)}}" alt="">
                                    <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
                                </div>

                                <div class="mt-3 text-center">
                                    <button onclick="javascript:changeProfile()" class="btn btn-default text-dark"> Upload Picture </button>
                                    <input type="file" id="file"  accept="image/png, image/jpeg" name="file" title="Upload an image" style="display: none">
                                    <a href="" class="text-info"> Remove picture</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   <script src="https://use.fontawesome.com/2c7a93b259.js"></script>
    <script>

        $("#emaila").click(function(e) {
            if((e.target).tagName == 'INPUT') return true; 
                e.preventDefault();
                $("#change-email").prop("checked", !$("#change-email").prop("checked"));
            });

            $("#change-pass").click(function(e) {
            if((e.target).tagName == 'INPUT') return true; 
                e.preventDefault();
                $("#change-password").prop("checked", !$("#change-password").prop("checked"));
            });

            $(document).ready(function(){
                $("#emaila").click(function(){
                    $(".change-email-box").hide();
                });
             });


        function hideemail() {
            var x = document.getElementById("change-email-box");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }


        function hidepass() {
            var x = document.getElementById("pass");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function changeProfile() {
            $('#file').click();
        }
        $('#file').change(function () {
            if ($(this).val() != '') {
                upload(this);

            }
        });
        function upload(img) {
            var form_data = new FormData();
            form_data.append('file', img.files[0]);
            form_data.append('_token', '{{csrf_token()}}');
            $('#loading').css('display', 'block');
            $.ajax({
                url: "{{url('ajax-profile-upload')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.fail) {
                        $('#preview_image').attr('src', '{{asset('storage/avatars/'.$user->id.'/'.$user->avatar)}}');
                        // alert(data.errors['file']);
                        Swal.fire({
                        title: 'Error!',
                        text: data.errors['file'],
                        icon: 'error',
                        confirmButtonText: 'Cool'
                        });
                    }
                    else {
                        $('#file_name').val(data);
                        $('#preview_image').attr('src', '{{asset('storage/avatars/'.$user->id)}}/' +data);
                        $('#loading').css('display', 'none');
                    const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: 'success',
                    title: 'Your avatar have been updated'
                    });

                    }
                    
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    $('#preview_image').attr('src', '{{asset('storage/avatars/'.$user->id.'/'.$user->avatar)}}');
                }
            });
        }
        function removeFile() {
            if ($('#file_name').val() != '')
                if (confirm('Are you sure want to remove profile picture?')) {
                    $('#loading').css('display', 'block');
                    var form_data = new FormData();
                    form_data.append('_method', 'DELETE');
                    form_data.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url: "ajax-remove-image/" + $('#file_name').val(),
                        data: form_data,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                            $('#file_name').val('');
                            $('#loading').css('display', 'none');
                        },
                        error: function (xhr, status, error) {
                            alert(xhr.responseText);
                        }
                    });
                }
        }
    </script>
    
</html>

