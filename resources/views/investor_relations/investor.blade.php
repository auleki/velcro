@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INVESTOR RELATIONS</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
      <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('css/welcome.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

  </head>

  <style>
    .sidebar li > a  {
      color: #ffffff;
    }

    a{
        color: #333333;
    }

    .searchForm{
        width: 35%;
        margin-left: 1.4rem;
    }

    .clicked {
        background: #2E7CFF !important;
        color: #ffffff !important;
    }

    #table_length,#table_filter,#table_info {
        display: none
    }

    #table_paginate {
        top: 2rem;
        position: absolute;
        right: 0px;
        font-size: 12px;
    }

    .paginate_button {
        padding: .2em .4em !important
    }
    .non-desktop-content{
        visibility: hidden;
    }

    @media (max-width: 700px){

        .non-desktop-content{
            position: relative;
            top: 5rem;
            margin: .5rem;
        }

        .non-desktop-content{
            visibility: visible;
        }
        .searchForm{
            width: 65%;
            margin-left: 1rem;
        }

        .wholeContent{
            position: relative;
            left: -0.9 !important;
        }

        .notForMobile{
            display: none;
        }

        #mob-600{
            margin-top: 1.7rem !important;
            margin-left: 3.4rem !important;
        }

        #mob-600-btn{
            margin-right: 1.3rem;
        }
           .selectTable{
            position: absolute;
            top: 3rem !important;
            margin-left: 1rem !important;
        }
    }

    @media (max-width: 500px){
        .selectTable{
            position: absolute;
            top: 3rem !important;
            margin-left: 1rem !important;
        }
    }




  </style>
  <body>


    <main class="wholeContent">

        <div class="row d-flex justify-content-between" id="mob-600" style="  margin-top: 2rem; margin-left: 1.5rem;">
            <h3> Investor relations</h3>
            <button class="btn btn-primary " id="mob-600-btn" data-toggle="modal" data-target="#newNote"> New note</button>
        </div>
        <div>
            <input type="text" id="inputSearch" class="form-control searchForm" placeholder="Search notes" style="float:left" autocomplete="off">
            <!-- <button type="button" name="button" style="border:none" style="float:left"><img src={{ asset('css/icons/grsearch.svg') }} style="width:2rem" /></button> -->
        </div>

          <div class="row selectTable  mt-5" style="  margin-left: 2rem;position:absolute;top:6rem">
            <input type="checkbox" style="width: 20px; height: 20px" name="" id="">
            <a href="" class="ml-4 mr-4" data-toggle="modal"  data-tooltip="Delete" data-target="#deleteModal"> <i class="fas fa-trash-alt "></i> </a>
            &#05;
            <p class="ml-2"> {{count($investors)}} selected</p>
          </div>

          <div class="table-align notForMobile" style="" >
                    <table id="table" class="table contact_table table-hover table_id">
                        <thead class="thead-light" style="background:#f4f3f3">
                            <tr>
                                <th></th>
                                <th >Investor</th>
                                <th >Fund</th>
                                <th >Company Investment</th>
                                <th >Recently active</th>
                                <th > Stage </th>
                                <th > Ticket size</th>
                                <th ></th>
                                <th></th>
                            </tr>
                        </thead>
                        @for($j=0;$j<count($investors);$j++)
                        <tbody class="tableBody">
                            <tr class="clickable text-dark" onclick="showMore('investor_{{$j}}')" id="investor_{{$j}}" style="{{ $j % 2 == 0 ? 'background:#F6F6F6':'background:#FFFFFF' }}" data-toggle="collapse" data-target="#group-of-rows-{{$j}}" aria-expanded="false" aria-controls="group-of-rows-{{$j}}">
                                <td scope="row">
                                    <input type="checkbox" style="width: 20px; height: 20px" class="p-1 outline-none" >
                                </td>
                                <td >{{ $investors[$j]->investor }}</td>
                                <td >{{ $investors[$j]->fund }}</td>
                                <td >{{ $investors[$j]->company_invested }}</td>
                                <td >{{ $investors[$j]->recently_active }}</td>
                                <td > {{ $investors[$j]->stage }}% </td>
                                <td  class="">{{ $investors[$j]->ticket_size }}</td>
                                <td >
                                    <a href="#" class="ml-3 text-white mr-3" data-target="#editInvestor{{$j}}" data-toggle="modal" style="color:#333 !important"> <i class="fas fa-pen"></i></a>

                                </td>
                                <td>   <a href=""></a><i class="fas fa-chevron-down"></i> </td>
                            </tr>
                        </tbody>

                        <tbody id="group-of-rows-{{$j}}" class="collapse tableBody">
                            <tr class="table-primary font-weight-600 " style="color: #666666">
                                <td></td>
                                <td></td>
                                <td> Market focus </td>
                                <td>Companies discussed </td>
                                <td>Declined companies  </td>
                                <td> </td>
                                <td> Location </td>
                                <td> </td>
                                <td></td>
                            </tr>

                            <tr class="" style="color: #333333">
                                <td></td>
                                <td></td>
                                <td> {{ $investors[$j]->market_focus }} </td>
                                <td>{{ $investors[$j]->company_discussed }} </td>
                                <td>{{ $investors[$j]->declined_company }}  </td>
                                <td> </td>
                                <td> {{ $investors[$j]->location }} </td>
                                <td> </td>
                                <td></td>
                            </tr>
                        </tbody>
                        @endfor
                    </table>
                </div>
          </div>
        </div>

          {{-- Mobile Investor relations --}}
          <div class=" mt-4 non-desktop-content" style="position:relative; top: 5rem">
            <table class="table table-hover table-borderless table-striped">
              <thead style="background: #1E223A;" class="text-white">
                <tr>
                  <th></th>
                  <th style="font-size: 12px;">Investor</th>
                  <th style="font-size: 12px;"> Share</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                <tr class="activity-summary-table " data-toggle="collapse"" data-target="#mobileInvestor" aria-expanded="false" >
                  <th scope="col">
                    <input type="checkbox" class="form-control mt-1" style="width: 15px; height: 15px">
                  </th>
                  <td style="font-size: 10px;">Newest Investor </td>
                  <td style="font-size: 10px;"> 5 </td>
                  <td>
                    <a href="" class="text-dark" data-target="#mobileInvestor" data-toggle="modal">
                      <img src="/css/icons/expand.png" alt="" style="height:1rem;width:1rem;border-radius: 0px;">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
    </main>

    <!-- Modals -->

    <!-- New Note Modal -->
    <div class="modal fade" id="newNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New Note </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="/investor.create" method="post" id="create_investor">
                @csrf
                    <div class="form-group">
                        <label for=""> Investor </label>
                        <input type="text" class="form-control" placeholder="Enter investor" name="investor" id="">
                    </div>

                    <div class="form-group">
                        <label for=""> Company invested </label>
                        <input type="text" class="form-control" placeholder="Enter company invested" name="company_invested" id="">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for=""> Market focus </label>
                            <input type="text" class="form-control" placeholder="Enter market focus" name="market_focus" id="">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="fund">Fund </label>
                            <input type="text" class="form-control" placeholder="Enter fund" name="fund" id="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="stage">Stage </label>
                            <input type="number" class="form-control" min="0" placeholder="Enter stage" name="stage" id="">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ticket_size"> Ticket size </label>
                            <input type="number" min="0" class="form-control" placeholder="Enter ticket size" name="ticket_size" id="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="recently_active">Recently active </label>
                            <input type="text" class="form-control" placeholder="Enter recent activity" name="recently_active" id="">
                        </div>

                        <div class="form-group row col-md-6 col-sm-12">
                            <label for="location"> Location </label>
                            <input type="text" class="form-control" placeholder="Enter location"  name="location" id="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="companies_discusses"> Companies discussed <small class="text-muted"> (seperate with a comma) </small> </label>
                        <input type="text" class="form-control" placeholder="Enter companies discussed" name="company_discussed" id="">
                    </div>

                    <div class="form-group">
                        <label for="declined_companies"> Declined companies <small class="text-muted"> (seperate with a comma) </small> </label>
                        <input type="text" class="form-control" placeholder="Enter declined companies" name="declined_company" id="">
                    </div>
                </form>
            </div>
            <div class="modal-footer mr-auto">
              <button type="button" class="btn btn-primary" onclick="submitForm('create_investor')"> Save </button>
              <button type="button" class="btn btn-default"  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </div>
        </div>
    </div>

    <!-- Edit Note Modal form-->
    @for($k=0;$k<count($investors);$k++)
    <div class="modal fade" id="editInvestor{{$k}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Note </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="/investors/{{$investors[$k]->id}}" method="post" id="edit{{$k}}">
                @csrf
                    <div class="form-group">
                        <label for=""> Investor </label>
                        <input type="text" value="{{ $investors[$k]->investor }}" class="form-control" placeholder="Enter investor " name="investor" id="">
                    </div>

                    <div class="form-group">
                        <label for=""> Company invested </label>
                        <input type="text" value="{{ $investors[$k]->company_invested}}" class="form-control" placeholder="Enter company invested" name="company_invested" id="">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for=""> Market focus </label>
                            <input type="text" value="{{ $investors[$k]->market_focus}}" class="form-control" placeholder="Enter market focus" name="market_focus" id="">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Fund </label>
                            <input type="text" value="{{ $investors[$k]->fund}}"  class="form-control" placeholder="Enter fund" name="fund" id="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Stage </label>
                            <input type="number" value="{{ $investors[$k]->stage}}" min="0" class="form-control" placeholder="Enter stage" name="stage" id="">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for=""> Ticket size </label>
                            <input type="number" min="0" value="{{ $investors[$k]->ticket_size}}"class="form-control" placeholder="Enter ticket size" name="ticket_size" id="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Recently active </label>
                            <input type="text" value="{{ $investors[$k]->recently_active}}" class="form-control" placeholder="Enter recent activity" name="recently_active" id="">
                        </div>

                        <div class="form-group row col-md-6 col-sm-12">
                            <label for=""> Location </label>
                            <input type="text"value="{{ $investors[$k]->location}}"  class="form-control" placeholder="Enter location"  name="location" id="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for=""> Companies discussed <small class="text-muted"> (seperate with a comma) </small> </label>
                        <input type="text" value="{{ $investors[$k]->company_discussed}}" class="form-control" placeholder="Enter companies discussed" name="company_discussed" id="">
                    </div>

                    <div class="form-group">
                        <label for=""> Declined companies <small class="text-muted"> (seperate with a comma) </small> </label>
                        <input type="text" value="{{ $investors[$k]->declined_company}}" class="form-control" placeholder="Enter declined companies" name="declined_company" id="">
                    </div>
                </form>
            </div>
            <div class="modal-footer mr-auto">
                <button type="button" class="btn btn-primary" onclick="submitForm('edit{{$k}}')"> Save </button>
              <button type="button" class="btn btn-default"  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </div>
        </div>
    </div>
    @endfor

      <!-- Investor relations mobile fullcontent -->

      <div class="modal fade" id="mobileInvestor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Investor Relations</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <ul class="list-unstyled ">
                <li class="row d-flex justify-content-between p-3">
                  <p> Investor</p>
                  <p>Dummy</p>
                </li>

                <li class="row mt-n4 d-flex justify-content-between p-3">
                  <p>Company Invested</p>
                  <p> Dummy </p>
                </li>


                <li class="row mt-n4 d-flex justify-content-between p-3">
                  <p>Market Focus</p>
                  <p>Dummy</p>
                </li>


                <li class="row mt-n4 d-flex justify-content-between p-3">
                  <p> Fund</p>
                  <p>Dummy</p>
                </li>

                <li class="row mt-n4 d-flex justify-content-between p-3">
                  <p>Stage</p>
                  <p>Dummy</p>
                </li>

                <li class="row mt-n4 d-flex justify-content-between p-3">
                  <p>Ticket Size</p>
                  <p>Dummy</p>
                </li>

                <li class="row mt-n4 d-flex justify-content-between p-3">
                  <p>Recently active</p>
                  <p>Dummy</p>
                </li>

                <li class="row mt-n4 d-flex justify-content-between p-3">
                  <p>Location</p>
                  <p>Dummy</p>
                </li>

                <li class="row mt-n4 d-flex justify-content-between p-3">
                    <p>Company Discussed </p>
                    <p>Dummy</p>
                </li>

                <li class="row mt-n4 d-flex justify-content-between p-3">
                    <p>Declined Companies</p>
                    <p>Dummy</p>
                </li>


              </ul>
            </div>

          </div>
        </div>
      </div>
{{-- End of mobile investor relations table --}}


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="/js/investor.js"></script>

    <script>
      $(document).ready( function () {
        $('.table_id').DataTable();
      });
    </script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
  @include('vendor.lara-izitoast.toast')
  </body>
</html>
