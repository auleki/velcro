<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LifeBank</title>
  
         <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <!-- Styles -->
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
        
        <link href="{{ asset('css/company.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,600" rel="stylesheet">
        <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">  <!-- Scripts -->
     
  
    </head>
  <style>
      .content{
        background: #FAFAFF;
        border-radius: 4px;
      }

      .wholeContent{
          width: 100%;

      }
      img{
            margin-bottom: 3em;
      }
    
  </style>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light ">
       
           <nav class="navbar navbar-light ">
               <a class="navbar-brand" href="#">
                   <img src="{{ asset('css/icons/echoVC (dark).png') }}" style=" " class="d-inline align-top"  alt="" />
                 
               </a>
             </nav>
           <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
           </button>
       

    </nav>
   

    <main class="wholeContent   "> 
        <div class="col-12 " >
            <div class="mx-auto pt-1 pl-1 col-md-6 " style="background: #FAFAFA"> 
                <div class="details " style="margin-top: 6rem">
                    <div class="container">
                      <div class="row">
                        <h5 class="text-uppercase float-left"> Description </h5>
                        <p class="ml-auto "> Edit <i class="fas fa-pencil-alt"> </i></p>
                        <div >
                          <p class="text-wrap">
                            We believe that no African should die from a shortage of
                            essential medical products at the Hospital level, 
                            and we are on a mission to solve it. Our goal is
                             to deliver needed medical products such as blood, 
                             blood products, oxygen, as well as vaccines to hospitals
                              across Africa. We are on a mission to save one million lives.
                          </p>
                        </div>
                      </div>
        
                      <div class="row mt-5">
                        <h5 class="text-uppercase float-left"> Comparison </h5>
                        <p class="ml-auto "> Edit <i class="fas fa-pencil-alt"> </i></p>
                       
                      </div>
                      <div class="row">
                        <div class="col-md-6 col-sm-12 ml-n3">
                          <h5 class=" text-capitalize"> Pizza Hut</h5>
                          <div class="irr">
                            <div class="row col-8 ">
                              <p> IRR</p>
                              <p class="ml-auto"> AVG. HP</p>
              
                            </div>
                            <div class="row col-8">
                              <h5> 21.5%</h5>
                              <h5 class="ml-auto"> 14%</h5>
                            </div>
                          </div>
                          <div class="row ml-1 mt-3">
                            <h5>Investments</h5>
                            <i class="fas fa-chevron-down ml-auto"> </i>
                          </div>
                          <div>
                            <canvas id="myChart" width="400" height="400"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart').getContext('2d');
                              var myChart = new Chart(ctx, {
                                  type: 'bar',
                                  data: {
                                      labels: ['Q1  2018', 'Q2 2018', 'Q3 2018', 'Q4 2018'],
                                      datasets: [{
                                        
                                        minBarLength: 9,
                                          label: 'Exit',
                                          data: [300000, 370000, 370000, 600000],
                                          backgroundColor: [
                                            // RGBA(253,6,6,1)
                                              'rgba(256, 006, 006, 1)',
                                              'rgba(256, 006, 006, 1)',
                                              'rgba(256, 006, 006, 1)',
                                              'rgba(256, 006, 006, 1)'
                                              // 'rgba(256, 46, 36, 1)'
                                            
                                          ],
                                      
                                          borderWidth: 1
                                      },
                                      {
                                        
                                        minBarLength: 9,
                                          label: 'Investment',
                                          data: [100000, 400000, 440000, 780000],
                                          backgroundColor: [
                                              'rgba(041,047, 089, 1)',
                                              'rgba(041,047, 089, 1)',
                                              'rgba(041,047, 089, 1)',
                                              'rgba(041,047, 089, 1)',
                                            
                                          ],
                            
                                          borderWidth: 1
                                      }
                                    ]
                                  },
                                  options: {
                                      scales: {
                                          yAxes: [{
                                              ticks: {
                                                  beginAtZero: true,
                                                  stacked: true
                                              }
                                          }]
                                      }
                                  }
                              });
                              </script> 
                          </div>
                        </div>
        
                        <div class="col-6 funding ml-3">
                          <h5 class=" text-capitalize"> Johnson & Johnson</h5>
                          <div class="row col-8">
                            <p> IRR</p>
                            <p class="ml-auto"> AVG. HP</p>
            
                          </div>
                          <div class="row col-8">
                            <h5> 21.5%</h5>
                            <h5 class="ml-auto"> 14%</h5>
                          </div>
        
                          <div class="row ml-1 mt-3">
                            <h5>TVPI</h5>
                            <i class="fas fa-chevron-down ml-auto"> </i>
                          </div>
                          <canvas id="line-chart" height="400" width="400"> </canvas>
                          <script> 
                          let ctxc = document.getElementById('line-chart').getContext('2d');
        
                            let lineChart = new Chart(ctxc, {
                              type: 'line',
                              data: {
                                
                                labels: [2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019],
                                datasets: [{
                                  lineTension: 0,
                                  label: 'TVPI',
                                  data: [0.5, 2, 2.5, 1, 2.5, 3.5, 2, 3.7, 4, 4],
                                  backgroundColor: [
                                    // RGBA(122,239,31,1)
                                    'rgba(122,239, 031, 1)',
                                ],
                                }]
                              },
                              options: {
                                bezierCurve: false
                              }
                            })
                            </script>
                        </div>
                      </div>
                      <div class="row mt-5 performance">
                        <h5 class="text-uppercase float-left"> Performance </h5>
                        <p class="ml-auto "> Edit <i class="fas fa-pencil-alt"> </i></p>
                       
                      </div>
                      <div class="row other">
                        <div class="col-6 ml-n3"  >
                            <div class="row col-8">
                              <p> IRR</p>
                              <p class="ml-auto"> AVG. HP</p>
                            </div>
                            <div class="row col-8">
                              <h5> 21.5%</h5>
                              <h5 class="ml-auto"> 14%</h5>
                            </div>
        
                            <div class="row mt-3" style="margin-left: .1rem" >
                              <h5>Quarterly Overview</h5>
                              <i class="fas fa-chevron-down ml-auto"> </i>
                            </div>
                            <canvas id="muChart" width="400" height="400"></canvas>
                            <script>
                              var secondCtx = document.getElementById('muChart').getContext('2d');
                              var secondChart = new Chart(secondCtx, {
                                  type: 'bar',
                                  data: {
                                      labels: ['Q1  2018', 'Q2 2018', 'Q3 2018', 'Q4 2018'],
                                      datasets: [{
                                        
                                        minBarLength: 9,
                                          label: 'Exit',
                                          data: [300000, 370000, 370000, 600000],
                                          backgroundColor: [
                                            // RGBA(253,6,6,1)
                                            'rgba(122,239, 031, 1)',
                                            'rgba(122,239, 031, 1)',
                                            'rgba(122,239, 031, 1)',
                                            'rgba(122,239, 031, 1)'
                                              // 'rgba(256, 46, 36, 1)'
                                            
                                          ],
                                      
                                          borderWidth: 1
                                      },
                                      {
                                        
                                        minBarLength: 9,
                                          label: 'Investment',
                                          data: [100000, 400000, 440000, 780000],
                                          backgroundColor: [
                                            // RGBA(25,185,253,1)
        
                                              'rgba(024, 185, 253, 1)',
                                              'rgba(024, 185, 253, 1)',
                                              'rgba(024, 185, 253, 1)',
                                              'rgba(024, 185, 253, 1)'
                                            
                                          ],
                            
                                          borderWidth: 1
                                      }
                                    ]
                                  },
                                  options: {
                                      scales: {
                                          yAxes: [{
                                              ticks: {
                                                  beginAtZero: true,
                                                  stacked: true
                                              }
                                          }]
                                      }
                                  }
                              });
                              </script>  
                        </div>
                        
                        <div class="col-6 mt-5 pt-4">
                          <div class="row ml-1 mt-3">
                            <h5>TVPI</h5>
                            <i class="fas fa-chevron-down ml-auto"> </i>
                          </div>
                          <canvas id="new-line" height="400" width="400"> </canvas>
                          <script> 
                          let ctxcv = document.getElementById('new-line').getContext('2d');
        
                            let newLine = new Chart(ctxcv, {
                              type: 'line',
                              data: {
                                
                                labels: [2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019],
                                datasets: [{
                                  label: 'TVPI',
                                  data: [0.5, 2, 2.5, 1, 2.5, 3.5, 2, 3.7, 4, 4],
                                  backgroundColor: [
                                    // RGBA(122,239,31,1)
                                    'rgba(96, 1, 190, 0.83)',
                                  ],
                                },
                                {
                                  label: 'TVPI',
                                  data: [1.5, 4, 0.5, 1, 0.5, 3.9, 1, 3.7, 4, 4],
                                  backgroundColor: [
                                    // RGBA(122,239,31,1)
                                    // RGBA(253,6,6,1)
                                    'rgba(256, 006, 006, 0.83)',
                                  ],
                                },
                              
                              
                              ]
                              },
                              options: {
                                bezierCurve: false
                              }
                            })
                            </script>
                        </div>
                      </div>
        
                    </div>
        
                    <div class="funding">
                      <div class=" mt-5 row p-3">
                        <h4 class="text-uppercase"> funding </h4>
                        <p  class="ml-5 text-muted " style="color: #000000"> Show: 
                          <div class="dropdown show">
                            <a class="btn btn-default mt-n2 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              All fund
                            </a>
                          
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="#">All fund</a>
                              <a class="dropdown-item" href="">Fund 1</a>
                              <a class="dropdown-item" href="">Fund 2</a>
                              <a class="dropdown-item" href="">Fund 3</a>
                              <a class="dropdown-item" href="">Fund 4</a>
                            </div>
                          </div>
                        </p>      
                      </div>
        
                        <div class="row " >
                            <div class="col-6  ml-1">
                                <div class="panel-group col-12" id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="panel panel-default ">
                                      <div class="panel-heading row" role="tab" id="headingActivity">
                                          <p class="lead text-muted">
                                              <a role="button" data-toggle="collapse" style="color:#333333" data-expanded="true" data-parent="#accordion" href="#collapseActivity" aria-expanded="true" aria-controls="collapseOne">
                                                  SERIES B
                                              </a>
                                            </p>
        
                                      
                                          {{-- <button class="btn  ml-auto mt-n2"> <input type="date" class="form-control" placeholder="2020"></button> --}}
                                          {{-- <p class="text-info ml-auto"> <i class="fas fa-plus"></i> New note</p> --}}
                                      </div>
                                      <div id="collapseActivity" class="panel-collapse collapse show in" role="tabpanel" aria-labelledby="headingOne">
                                          <div class="panel-body ml-n3 "> 
                                            
                                            <div class="row col-12">
                                              <p class="text-capitalize"> Commited</p>
                                              <p class="capitalize ml-auto"> $342,000</p>
                                            </div>
        
                                            <div class="row col-12">
                                              <p class="text-capitalize">Tranche1:</p>
                                              <p class="mx-auto"> 5 Dec 2019</p>
                                              <p class="capitalize ml-auto"> $342,000</p>
                                            </div>    
                                          
                                          </div>
                                      </div>
                                    
                                </div>
        
                                            
                              </div>
                            </div>
        
                            <div class="col-5  ml-2">
                              <div class="panel-group col-12" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default ">
                                    <div class="panel-heading row" role="tab" id="headingActivity1">
                                        <p class="lead text-muted">
                                            <a role="button" data-toggle="collapse" style="color:#333333" data-expanded="true" data-parent="#accordion" href="#collapseActivity1" aria-expanded="true" aria-controls="collapseOne">
                                                SERIESA
                                            </a>
                                          </p>
                                      </div>
                                    <div id="collapseActivity1" class="panel-collapse collapse show in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body ml-n3 "> 
        
                                          <div class="col-12 row">
                                            <p class="text-capitalize"> Commited</p>
                                            <p class="capitalize ml-auto"> $57,000</p>
                                          </div>
                                          <div class="col-12 row">
                                            <p class="text-capitalize">Tranche1:</p>
                                            <p class="mx-auto"> 21 Jul 2019</p>
                                            <p class="capitalize ml-auto"> $25,000</p>
                                          </div>
                                          <div class="col-12 row">
                                            <p class="text-capitalize">Tranche2:</p>
                                            <p class="mx-auto"> 1 Sep 2019</p>
                                            <p class="capitalize ml-auto"> $32,500</p>
                                          </div>
        
                                         </div>
                                    </div>
                                </div>
                              </div>
                            </div>
        
                            <div class="col-6  ml-1">
                              <div class="panel-group col-12" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default ">
                                    <div class="panel-heading row" role="tab" id="headingActivity5">
                                        <p class="lead text-muted">
                                            <a role="button" data-toggle="collapse" style="color:#333333" data-expanded="true" data-parent="#accordion" href="#collapseActivity5" aria-expanded="true" aria-controls="collapseOne">
                                                SEED
                                            </a>
                                          </p>
                                      </div>
                                    <div id="collapseActivity5" class="panel-collapse collapse show in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body ml-n3 "> 
        
                                          <div class="col-12 row">
                                            <p class="text-capitalize"> Commited</p>
                                            <p class="capitalize ml-auto"> $57,000</p>
                                          </div>
                                          <div class="col-12 row">
                                            <p class="text-capitalize">Tranche1:</p>
                                            <p class="mx-auto"> 21 Jul 2019</p>
                                            <p class="capitalize ml-auto"> $25,000</p>
                                          </div>
                                          <div class="col-12 row">
                                            <p class="text-capitalize">Tranche2:</p>
                                            <p class="mx-auto"> 1 Sep 2019</p>
                                            <p class="capitalize ml-auto"> $32,500</p>
                                          </div>
        
                                         </div>
                                    </div>
                                </div>
                              </div>
        
                            </div>
                            
                              <div class="col-5">
                                <div class="mt-3 pt-5 d-flex justify-content-center">
                                 <a href="" class="text-dark" data-target="#addRound" data-toggle="modal"> <i class="fas fa-plus"></i> Add round </a>
                                </div>
                              </div>
                        </div>
                      </div>
        
                      <div class="contact mt-4">
                        <h4 class="text-uppercase"> contact </h4>
                        <div class="row ml-1 mt-5">
                          <div class="col-6">
                            <div class="row">
                              
                              <div> <button class="btn btn-info rounded-circle p-4"  type="button" > UE</button> </div>
                              <div class="col">
                                <p> Uka Eje</p>
                                <p> Product Manager</p>
                                <p> uka.eje@something.com</p>
                                <p>+234 626 618 5564</p>
                              </div>
                            </div>
                            
                          </div>
        
                          <div class="col-6 ">
                            <div class="row">
                              
                              <div> <button class="btn btn-info rounded-circle p-4"  type="button" > AA</button> </div>
                              <div class="col contact">
                                <p> Ayodeji Ariakwe</p>
                                <p> Medical Consultant</p>
                                <p>ayodeji.arikawe@something.com</p>
                                <p>+234 626 618 5564</p>
                              </div>
                            </div>
                            
                          </div>
        
                        </div>
                      <div>
                        <a  href="" class="text-black-50" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus ml-2" style="font-size: 1.2rem; color: #666666"></i> Add contact</a>  
                      </div>   
                        
                      {{-- ALL MODALS --}}
                      <!-- Add contact modal -->
                      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="addKpi">Add contact</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <input type="text" placeholder="Search contact" class="form-control">
                            </div>
                            <div class="modal-footer">
                              {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> --}}
                              <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
        
                      <!-- Add round modal -->
                      <div class="modal fade" id="addRound" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="addKpi">Add round</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for=""> Fund round</label>
                                <select name="" class="form-control" id="">
                                  <option class="active" value="">Seed</option>
                                  <option  value="">Series A</option>
                                  <option  value="">Series B </option>
                                  <option  value="">Series C</option>
                                  <option  value="">Custom</option>
                                </select>
                              </div>
        
                              <div class="form-group">
                                <label for=""> Fund group</label>
                                <select name="" class="form-control" id="">
                                  <option class="active" value="">Fund 1</option>
                                  <option value="">Fund 2</option>
                                  <option value="">Fund 3</option>
                                  <option value="">Fund 4</option>
                                  <option value=""><i class="fas fa-plus"></i>New group</option>
                                </select>
                              </div>
        
                              
                              <div class="form-group">
                                <label for=""> Commited</label>
                                {{-- <label class="sr-only" for="inlineFormInputGroupUsername">Username</label> --}}
                                <div class="input-group">
                                  <input type="text" class="form-control" >
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      <select name="" id="">
                                        <option value=""> USD </option>
                                        <option value=""> GBP </option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                                      
                              <div class="form-group">
                                <p class="small"> Tranche 1</p>
                                <label for=""> Tranche value</label>
                                {{-- <label class="sr-only" for="inlineFormInputGroupUsername">Username</label> --}}
                                <div class="input-group">
                                  <input type="text" class="form-control" >
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      <select name="" id="">
                                        <option value=""> USD </option>
                                        <option value=""> GBP </option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
        
                              
                              <div class="form-group">
                                <label for="">Tranche funding date</label>
                                <input type="date" class="form-control">
                              </div>
        
                            </div>
                            <div class="modal-footer">
                              {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> --}}
                              <button type="button" class="btn btn-primary mr-auto  "  aria-label="Close">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
            
                      <!-- Add file modal -->
                      <div class="modal fade" id="addFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="addFile">Select File</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              {{-- <label for=""> Name:</label> --}}
                              <input type="text" placeholder="Search files" class="form-control">
        
                              {{-- <input type="file" class="form-control mt-4"> --}}
                            </div>
                            <div class="modal-footer">
                              {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button> --}}
                              <button type="button" class="btn mr-auto btn-primary  " class="close" data-dismiss="modal" aria-label="Close">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
        
        
                      </div>
                      <div class="mt-5 files">
                        <h4 class="text-uppercase">files </h4>
                        <div class="row   mt-3">
                          <div class="col-4">
                            <p class="lead font-weight-700" > <i class="fas fa-file" style="font-size: 1.3rem"></i> Updated list of employees</p>
                          </div>
        
                          <div class="col-4">
                           
                              <div class="dropdown ml-4">
                                <a href="#" class="btn btn-info text-white btn-sm  mb-1 dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-plus ml-2" ></i> Add File 
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                  <small class="ml-1 text-secondary">Share file </small>
                                  <div class="dropdown-divider"></div>
                                  <button class="dropdown-item" data-toggle="modal" role="button" style="font-size: 14px;" type="button"><img src="{{ asset('css/icons/fromdrive.png') }}" style="height: 16px; width: 16px; color:#717171; " /> Google Drive</button>
                                  <button class="dropdown-item " style="font-size: 14px;" id="addFile" data-target="#addFile" data-toggle="modal"><img src="{{ asset('css/icons/laptop.png') }}" style="height: 16px; width: 16px; color:#717171;"/> Your computer</button>
                                  <button class="dropdown-item " style="font-size: 14px;" id="computer" data-target="#modalCenter"><img src="{{ asset('css/icons/file.png') }}" style="height: 16px; width: 16px; color:#717171;"/> echoVC PMS files</button>
                                {{-- <button class="dropdown-item" type="button">Something else here</button> --}}
                                </div>
                                
                            
                              </div>
                        </div>
                      </div>
        
                      <div class="notes mt-5 ">
                        <h4 class="text-uppercase"> Notes</h4>
                        <div class="col-6 p-1 rounded mt-4" style="background: #F2F3F5;">
                          <p class="ml-3"> <a href="#" style="color:#19B9FD"> Biodun</a> Please proceed with the next tranche</p>
                          <small class="ml-3">Yesterday at 4:23PM</small>
                        </div>
                        <div class="row ml-n2 mt-5 col-9">
                          <input type="text" class="p-4 form-control rounded"  placeholder="Write note">
                          <button class="btn mt-1 btn-primary"> Save</button>
                        </div>
                      </div>
        
                      <div style="height: 5rem"></div>
                  </div>
                
            
            </div>
        </div>
    </main>
  </body>
</html>