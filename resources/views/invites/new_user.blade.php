<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Invite new user</title>
</head>
<style>
    .card{
        width: 45%;
        position: relative;
        left: 25%;
        margin-top: 6%;
        /* height: 25em; */
    }
    .card{
        padding: 2.5em;
    }
    .invite-text{
        width: 70%;
    }
    .btn-invite{
        width: 100px;
    }
    .selecter{
        width: 20%;
    }
</style>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="card ">
        <div class="card-body  row">
          <h3> Invite new user</h3>
          <h3 class="ml-auto "><i class="fas fa-times "></i> </h3>
        </div>

        <div class="inputs ml-1 row">
            <input type="text" class="form-control invite-text" placeholder="enter name or email address">
            <button class="btn btn-primary ml-5 btn-invite "> Invite </button>
        </div>

        <hr class="shadow mt-4">


        <div class="pending">
            <h4> Pending invites</h4>
            <div class="row" style="margin-left: 0em">
                <p> Diane Webb</p>
                <select name="" id="" class="ml-auto form-control selecter">
                    <option value=""> admin</option>
                </select>
                <h4 class="mr-4 ml-2 mt-2"><i class="fas fa-times "></i> </h4>
            </div>

            <div class="row mt-2" style="margin-left: 0em">
                <p> Max Mckinney</p>
                <select name="" id="" class="ml-auto form-control selecter">
                    <option value=""> can view </option>
                </select>
                <h4 class="mr-4 ml-2 mt-2"><i class="fas fa-times "></i> </h4>
            </div>
            <div class="row mt-2" style="margin-left: 0em">
                <p> daisy.watson@example.com</p>
                <select name="" id="" class="ml-auto form-control selecter">
                    <option value=""> can view</option>
                </select>
                <h4 class="mr-4 ml-2 mt-2"><i class="fas fa-times "></i> </h4>
            </div>
            <div class="row mt-2" style="margin-left: 0em">
                <p>  Devon Pena</p>
                <select name="" id="" class="ml-auto form-control selecter">
                    <option value=""> admin</option>
                </select>
                <h4 class="mr-4 ml-2 mt-2"><i class="fas fa-times "></i> </h4>
            </div>
            <div class="row mt-2" style="margin-left: 0em">
                <p> bill.berry@example.com</p>
                <select name="" id="" class="ml-auto form-control selecter">
                    <option value=""> owner</option>
                </select>
                <h4 class="mr-4 ml-2 mt-2"><i class="fas fa-times "></i> </h4>
            </div>
        </div>
    </div>
     </div>
  </div>
</div>
</body>
</html>