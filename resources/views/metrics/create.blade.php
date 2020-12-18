<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Metrics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

    <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <!-- Scripts -->
    <script src="/js/app.js/" defer></script>
    <style>

      .btn-excel {
        margin-top: -0.5rem;
        font-size: 0.9rem;
        color: #666;
      }

      .btn-excel:focus, .btn:focus {
        box-shadow: 0 0 0 0 rgba(0,0,0,0)!important;
      }
      thead {
        background: #fff;
      }

      td {
        padding: 0;
        border: 1px solid #dee2e6!important;
      }

      input {
        border: 0;
      }

      tr {
        line-height: 1rem;
      }
      .formMett{
          cursor: pointer;
      }
    </style>
  </head>
  <body>

      <main class="wholeContent">
        <div class="">
          @include('inc.messages')
        </div>
        <section class="header">
          <div class="rep">Metrics</div>
        </section>
        <form class="searchReport" action="" method="post">
          @csrf
          <input type="text" class="form-control form-group" placeholder="Search for metric">
          <button type="button" name="button" style="border:none"><img src="/css/icons/grsearch.svg" /></button>
        </form>
        <section class="newMetr">
          <!-- <ul class="nav nav-tabs nav-lg newData" role="tablist">
            <li class="active" role="presentation">
              <a href="/add_metrics" class="">+ New data source</a>
            </li>
          </ul> -->
          <div class=" mb-5">
            <ul class="nav  fund-tabs  nav-tabs">
                <li class="nav-item">
                  <a class="nav-link btn active" data-tooltip="New data source"  href="/metrics" role="button" aria-haspopup="true" aria-expanded="false"> &#43; New data source</a>

                </li>


               <li class="nav-item"><a class="nav-link text-black-50" data-tooltip="User Provided Metrics"  href="/user_provided_sheets">User provided</a> </li>
            </ul>
          </div>
          <label for="">Custom</label>
          <div class="formMett custom"  style="cursor: pointer"  data-tooltip="Create custom user provided metric">
              User provided metric
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#excelModal" id="open">Create</button>
              <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" id="open">Create</button> -->
          </div>
          <label for="">Link</label>
          <div class="formG">
            <div class="formMett " data-tooltip="Use Google Sheets" >
              <img src="/css/icons/sheet.svg" />
              Google Sheets <span></span>
              <a href="/google/connect"class="btn btn-default" >Link</a>
            </div>
            <div class="formMett " data-tooltip="Use Xero">
              <img src="/css/icons/xero.svg" />
              Xero
              <a href="#"class="btn btn-default">Link</a>
            </div>
            <div class="formMett" data-tooltip="Use Airtable">
              <img src="/css/icons/airtable.svg" />
              Airtable
              <a href="#"class="btn btn-default">Link</a>
            </div>
            <div class="formMett " data-tooltip="Use Trello">
              <img src="/css/icons/trello.svg" />
              Trello
              <a href="#" class="btn btn-default">Link</a>
            </div>
          </div>
        </section>

      </main>

      <!-- Modal to create new metrics -->
          <!-- <div class="modal" tabindex="-1" role="dialog" id="myModal" aria-labelledby="details-l" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form method="post" action="{{ route('metrics.store') }}">
                @csrf
                <div class="modal-content">
                  <div class="modal-header modalHeader">
                    <h5 class="modal-title">Create Metric</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div class="row mr-2">
                        <div class="form-group col-md-12 ml-2">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                      </div>
                      <div class="row mr-2">
                        <div class="form-group col-md-12 ml-2">
                          <label for="desc">Description</label>
                          <input type="text" class="form-control" name="desc" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-bordered table-responsive" style="margin-top:-5rem">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Value</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <th><input type="text" name="aaa" value=""></th>
                                <th><input type="number" name="aaa1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <th><input type="text" name="bbb" value=""></th>
                                <th><input type="number" name="bbb1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <th><input type="text" name="ccc" value=""></th>
                                <th><input type="number" name="ccc1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">4</th>
                                <th><input type="text" name="ddd" value=""></th>
                                <th><input type="number" name="ddd1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">5</th>
                                <th><input type="text" name="eee" value=""></th>
                                <th><input type="number" name="eee1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">6</th>
                                <th><input type="text" name="fff" value=""></th>
                                <th><input type="number" name="fff1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">7</th>
                                <th><input type="text" name="ggg" value=""></th>
                                <th><input type="number" name="ggg1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">8</th>
                                <th><input type="text" name="hhh" value=""></th>
                                <th><input type="number" name="hhh1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">9</th>
                                <th><input type="text" name="iii" value=""></th>
                                <th><input type="number" name="iii1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">10</th>
                                <th><input type="text" name="jjj" value=""></th>
                                <th><input type="number" name="jjj1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">11</th>
                                <th><input type="text" name="kkk" value=""></th>
                                <th><input type="number" name="kkk1" value=""></th>
                              </tr>
                              <tr>
                                <th scope="row">12</th>
                                <th><input type="text" name="lll" value=""></th>
                                <th><input type="number" name="lll1" value=""></th>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="row mt-5">
                        <div class="d-flex col-md-12 mr-2 ml-2 mt-3 btnModalme">
                          <div class="mt-2 mr-4">Unit:</div>
                          <p class="mt-2">Percent</p> <input type="radio" name="percent" value="%" class="btn btnModalmetr mt-3 ml-2" />
                          <p class="mt-2 ml-3">Number</p> <input type="radio" name="numb" value="Number" class="btn btnModalmetr mt-3 ml-2" />
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer modalFooter">
                    <button type="submit" class="btn btn-save" style="background:#ddd; float:left!important">Save</button>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div> -->


      <!-- Excel modal -->
          <div class="modal" tabindex="-1" role="dialog" id="excelModal" aria-labelledby="details-l" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form action="{{ route('import') }}" method="POST" name="importform" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                  <div class="modal-header modalHeader">
                    <h5 class="modal-title">Add an Excel File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div class="row mr-2">
                        <div class="form-group col-md-12 ml-2">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name">
                        </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-md-12 ml-2">
                           <label for="desc">Description</label>
                           <input type="text" class="form-control" name="desc">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mb-2 d-flex btnModalme">
                          <label for="">Upload Source:</label>
                          <!-- <input type="file" class="ml-4" name="tags"> -->
                          <input type="file" name="file" id="myFile" class="ml-4" style="width: 85px;" onchange="this.style.width = '100%';" required/>
                        </div>
                      </div>
                      <!-- <div class="row">
                        <div class="d-flex col-md-12 mr-2 ml-2 mt-3 btnModalme">
                          <div class="mt-2">Unit:</div>
                          <button type="button" value="percent1" class="btn btnModalmetr ml-4 mr-2">Percent</button>
                          <button type="submit" class="btn btnModalmetr">Number</button>
                          <input type="" name="percent" value="percent" class="btn btnModalmetr" placeholder="Percent"/>
                        </div>
                      </div> -->
                    </div>
                  </div>
                  <div class="modal-footer modalFooter">
                    <button class="btn btn-save" style="background:#ddd; float:left!important">Save</button>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

      <div class="wrapper">
        @include('layouts.sidebar')
      </div>

      <script src="/js/airtable.browser.js"></script>
      <script type="text/javascript">
          // $("#contain").on('click-row.bs.table', function (e, row, $element) {
          //   window.location = $element.data('href');
          // });
          jQuery(document).ready(function($) {
              $('*[data-href]').on('click', function() {
                  window.location = $(this).data("href");
              });
          });
      </script>
  </body>
</html>
