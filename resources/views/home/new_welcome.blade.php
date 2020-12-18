@extends('layouts.sidbar')
  @section('content')

  <style>

    .modal-header{
        border-bottom: none !important;
    }

    .modal-footer{
        border-top: none !important;
    }
    @media (max-width: 500px){

       .media-screens{
          width: 80%;
          margin-left: 2rem;
       }
    }

    @media (max-width: 320px){

    .media-screens{
      width: 70%;
      margin-left: 3.3rem;
    }
}
 </style>

            <div class="col-md-12 mt-5 mb-5 p-5 col-xl-12 col-lg-12">

               <div class=" text-center">
                <svg width="400" height="300" viewBox="0 0 151 115" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0)">
                  <path d="M91.4225 2.45239C94.6786 -0.817462 99.9574 -0.817462 103.213 2.45239C106.469 5.72225 106.469 11.0237 103.213 14.2936L37.5776 80.2096C34.3216 83.4791 29.0427 83.4791 25.7867 80.2096C22.5308 76.9397 22.5308 71.638 25.7867 68.3681L91.4225 2.45239Z" fill="#19B9FD" fill-opacity="0.28"/>
                  <path d="M91.4226 24.7803C94.6786 21.5105 99.9574 21.5105 103.213 24.7803C106.469 28.0501 106.469 33.3516 103.213 36.6215L29.514 110.635C26.258 113.905 20.979 113.905 17.7231 110.635C14.4671 107.366 14.4671 102.064 17.7231 98.794L91.4226 24.7803Z" fill="#19B9FD" fill-opacity="0.28"/>
                  <path d="M114.073 25.4741C117.329 22.2042 122.608 22.2043 125.864 25.4741C129.12 28.7439 129.12 34.0454 125.864 37.3153L52.1645 111.329C48.9085 114.599 43.6293 114.599 40.3733 111.329C37.1175 108.059 37.1175 102.758 40.3733 99.4879L114.073 25.4741Z" fill="#19B9FD" fill-opacity="0.28"/>
                  <path d="M136.38 26.5147C139.636 23.2449 144.915 23.2449 148.171 26.5147C151.427 29.7846 151.427 35.0861 148.171 38.3559L74.471 112.37C71.2153 115.64 65.9361 115.64 62.6801 112.37C59.4241 109.1 59.4241 103.799 62.6801 100.529L136.38 26.5147Z" fill="#19B9FD" fill-opacity="0.28"/>
                  <path d="M68.0777 2.45239C71.3337 -0.817462 76.6129 -0.817462 79.8689 2.45239C83.1245 5.72225 83.1245 11.0237 79.8689 14.2936L14.2329 80.2096C10.9769 83.4791 5.69794 83.4791 2.44197 80.2096C-0.81399 76.9397 -0.81399 71.638 2.44197 68.3681L68.0777 2.45239Z" fill="#19B9FD" fill-opacity="0.28"/>
                  <path d="M133.338 18.1271H17.2738V96.483H133.338V18.1271Z" fill="white" stroke="#CCCCCC"/>
                  <path d="M53.5681 30.7966H29.1131C28.6843 30.7966 28.3368 31.1457 28.3368 31.5763C28.3368 32.0069 28.6843 32.3559 29.1131 32.3559H53.5681C53.9969 32.3559 54.3445 32.0069 54.3445 31.5763C54.3445 31.1457 53.9969 30.7966 53.5681 30.7966Z" fill="#C4C4C4"/>
                  <path d="M121.887 30.7966H102.478C102.049 30.7966 101.702 31.1457 101.702 31.5763C101.702 32.0069 102.049 32.3559 102.478 32.3559H121.887C122.316 32.3559 122.663 32.0069 122.663 31.5763C122.663 31.1457 122.316 30.7966 121.887 30.7966Z" fill="#C4C4C4"/>
                  <path d="M121.887 35.4746H102.478C102.049 35.4746 101.702 35.8236 101.702 36.2542C101.702 36.6848 102.049 37.0339 102.478 37.0339H121.887C122.316 37.0339 122.663 36.6848 122.663 36.2542C122.663 35.8236 122.316 35.4746 121.887 35.4746Z" fill="#C4C4C4"/>
                  <path d="M121.887 40.5424H107.913C107.484 40.5424 107.136 40.8914 107.136 41.322C107.136 41.7526 107.484 42.1017 107.913 42.1017H121.887C122.316 42.1017 122.663 41.7526 122.663 41.322C122.663 40.8914 122.316 40.5424 121.887 40.5424Z" fill="#C4C4C4"/>
                  <path d="M104.807 40.5424H102.478C102.049 40.5424 101.702 40.8914 101.702 41.322C101.702 41.7526 102.049 42.1017 102.478 42.1017H104.807C105.236 42.1017 105.584 41.7526 105.584 41.322C105.584 40.8914 105.236 40.5424 104.807 40.5424Z" fill="#C4C4C4"/>
                  <path d="M112.571 45.6102H102.478C102.049 45.6102 101.702 45.9592 101.702 46.3898C101.702 46.8204 102.049 47.1695 102.478 47.1695H112.571C112.999 47.1695 113.347 46.8204 113.347 46.3898C113.347 45.9592 112.999 45.6102 112.571 45.6102Z" fill="#C4C4C4"/>
                  <path d="M121.887 45.6102H115.676C115.247 45.6102 114.9 45.9592 114.9 46.3898C114.9 46.8204 115.247 47.1695 115.676 47.1695H121.887C122.316 47.1695 122.663 46.8204 122.663 46.3898C122.663 45.9592 122.316 45.6102 121.887 45.6102Z" fill="#C4C4C4"/>
                  <path d="M17.4679 21.6356H133.532" stroke="#CCCCCC"/>
                  <path d="M20.5733 20.661C21.002 20.661 21.3496 20.3119 21.3496 19.8813C21.3496 19.4508 21.002 19.1017 20.5733 19.1017C20.1445 19.1017 19.7969 19.4508 19.7969 19.8813C19.7969 20.3119 20.1445 20.661 20.5733 20.661Z" fill="#7AEF1F"/>
                  <path d="M22.9023 20.661C23.3311 20.661 23.6786 20.3119 23.6786 19.8813C23.6786 19.4508 23.3311 19.1017 22.9023 19.1017C22.4735 19.1017 22.1259 19.4508 22.1259 19.8813C22.1259 20.3119 22.4735 20.661 22.9023 20.661Z" fill="#F36A6A"/>
                  <path d="M25.2314 20.661C25.6601 20.661 26.0077 20.3119 26.0077 19.8813C26.0077 19.4508 25.6601 19.1017 25.2314 19.1017C24.8026 19.1017 24.455 19.4508 24.455 19.8813C24.455 20.3119 24.8026 20.661 25.2314 20.661Z" fill="#FFDA44"/>
                  <path d="M32.9949 38.5932H28.3368V58.8644H32.9949V38.5932Z" fill="#7AEF1F"/>
                  <path d="M32.9949 50.0367H28.3368V58.8645H32.9949V50.0367Z" fill="#56AF0F"/>
                  <path d="M43.0874 38.5932H38.4293V58.8644H43.0874V38.5932Z" fill="#7AEF1F"/>
                  <path d="M43.0874 45.7864H38.4293V58.8646H43.0874V45.7864Z" fill="#56AF0F"/>
                  <path d="M53.1799 38.5932H48.5219V58.8644H53.1799V38.5932Z" fill="#7AEF1F"/>
                  <path d="M53.1799 51.3446H48.5219V58.8645H53.1799V51.3446Z" fill="#56AF0F"/>
                  <path d="M62.8843 56.5254L70.7833 48.3187L81.1646 56.5254L86.3553 42.1017L91.9974 48.3187" stroke="#FFDA44" stroke-width="1.5"/>
                  <path d="M64.0488 56.9153L68.4298 43.0108L76.3532 48.1916L86.5246 38.9831L92.2389 45.1108L96.2673 43.1835" stroke="#FFDA44" stroke-width="1.5"/>
                  <path d="M65.7914 86.2028C63.8241 87.0133 61.646 87.1528 59.5922 86.5989C57.5384 86.0453 55.7225 84.8298 54.4237 83.1387C53.1252 81.4477 52.4152 79.3749 52.4036 77.2394C52.3923 75.104 53.0794 73.0238 54.3596 71.3187C55.6402 69.6136 57.4425 68.3778 59.4905 67.802C61.5381 67.2259 63.7173 67.3413 65.6935 68.1303C67.6693 68.9193 69.3327 70.3383 70.4273 72.1693C71.5224 74 71.9878 76.1413 71.7529 78.2635L65.966 77.6172C66.06 76.7685 65.8737 75.9117 65.4358 75.1796C64.9979 74.4471 64.3326 73.8795 63.5423 73.5641C62.7516 73.2484 61.8801 73.2024 61.0611 73.4327C60.242 73.6631 59.5208 74.1574 59.0088 74.8393C58.4964 75.5215 58.2216 76.3534 58.2262 77.2075C58.2309 78.062 58.5146 78.8908 59.0344 79.5675C59.5538 80.2439 60.2801 80.73 61.1018 80.9514C61.9232 81.1728 62.7943 81.1171 63.5815 80.7931L65.7914 86.2028Z" fill="#19B9FD"/>
                  <path d="M67.7322 87.7621C69.3443 87.0979 70.7484 86.0106 71.7972 84.6135C72.8461 83.2167 73.5013 81.5619 73.6938 79.8229L67.9069 79.1765C67.8297 79.8724 67.5677 80.5343 67.148 81.0929C66.7284 81.6515 66.1671 82.0866 65.5224 82.3525L67.7322 87.7621Z" fill="#E3F2FD"/>
                  </g>
                  <defs>
                  <clipPath id="clip0">
                  <rect width="151" height="115" fill="white"/>
                  </clipPath>
                  </defs>
                  </svg>

                     <div class="text-center">
                      <h3>Build your fund dashboard</h3>
                      <p class=" media-screens" >Put together a fund dashboard consisting of metrics that matter to you</p>
                      <a class="btn btn-primary" href="#!" data-toggle="modal" data-target="#addModal">Create Fund</a>
                   </div>


               </div>
            </div>

            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Name your fund</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="/funds" method="post">
                            @csrf
                            <input type="text" class="form-control" placeholder="" name="name">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"> Create fund </button>
                                <button type="button" class="btn btn-default btn-test "  style="color: #333333" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                         </form>
                    </div>

                  </div>
                </div>
            </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{asset('js/sidebar.js')}}" defer></script>
@stop
