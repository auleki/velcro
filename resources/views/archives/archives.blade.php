
@extends('layouts.reports')

<head>
    <title> Archives </title>
</head>

<style>
    .empty{
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: center;
        flex: 0 1 auto;
        margin-top: auto;
        margin-bottom: auto;
        padding-top: 4rem;
        padding-bottom: 4rem;
    }

    @media(max-width: 700px){
        h3{
            font-size: 1.875rem;
            margin: 0 4rem 0 4rem;
        }
    }

</style>
@section('content')
          <style>

          </style>
          <div >
            <div class="row d-flex justify-content-start mr-0 ml-0 mt-4">
              <h3> Archive</h3>
            </div>
          </div>
          <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 mt-5 ">

             <div class="empty text-center">
               {{-- <img src="{{ asset('css/echovc_icons/home.svg') }}" class="mx-auto d-block" /> --}}
               <svg width="400" height="300" viewBox="0 0 169 129" class="bg-cover img-fluid" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0)">
                <path d="M115.157 19.0901C118.672 15.5757 118.672 9.87774 115.157 6.36336C111.642 2.84897 105.943 2.84897 102.428 6.36335L31.5676 77.2088C28.0525 80.7231 28.0525 86.4211 31.5676 89.9355C35.0827 93.4498 40.7819 93.4498 44.297 89.9355L115.157 19.0901Z" fill="#BFEBFE"/>
                <path d="M115.157 43.0877C118.672 39.5734 118.672 33.8754 115.157 30.361C111.642 26.8467 105.943 26.8467 102.428 30.361L22.8623 109.91C19.3472 113.424 19.3472 119.122 22.8623 122.637C26.3774 126.151 32.0765 126.151 35.5916 122.637L115.157 43.0877Z" fill="#BFEBFE"/>
                <path d="M138.864 43.0878C142.379 39.5734 142.379 33.8754 138.864 30.3611C135.349 26.8467 129.65 26.8467 126.135 30.3611L46.5693 109.91C43.0542 113.424 43.0542 119.122 46.5693 122.637C50.0844 126.151 55.7836 126.151 59.2987 122.637L138.864 43.0878Z" fill="#BFEBFE"/>
                <path d="M162.574 43.0878C166.089 39.5734 166.089 33.8754 162.574 30.3611C159.059 26.8467 153.36 26.8467 149.844 30.3611L70.2789 109.91C66.7638 113.424 66.7638 119.122 70.2789 122.637C73.794 126.151 79.4932 126.151 83.0083 122.637L162.574 43.0878Z" fill="#BFEBFE"/>
                <path d="M89.9539 19.0901C93.469 15.5757 93.469 9.87774 89.9539 6.36335C86.4388 2.84897 80.7397 2.84897 77.2245 6.36335L6.36436 77.2087C2.84924 80.7231 2.84924 86.4211 6.36436 89.9354C9.87947 93.4498 15.5786 93.4498 19.0937 89.9354L89.9539 19.0901Z" fill="#BFEBFE"/>
                <path d="M52.4543 39.5431H111.486V54.2979H52.4543V39.5431Z" fill="#D17A00"/>
                <path d="M52.4543 69.0529H44.021V52.1903L52.4543 39.5431V69.0529ZM111.486 69.0529H119.919V52.1903L111.486 39.5431V69.0529Z" fill="#8A5100"/>
                <path d="M115.703 111.21H48.2375C45.9184 111.21 44.021 109.313 44.021 106.994V52.1904H119.919V106.994C119.919 109.313 118.022 111.21 115.703 111.21Z" fill="#FF9800"/>
                <path d="M89.3494 66.9449H74.5912C72.9048 66.9449 71.4288 65.4698 71.4288 63.7832C71.4288 62.0971 72.9048 60.6214 74.5912 60.6214H89.3494C91.0358 60.6214 92.5118 62.0971 92.5118 63.7832C92.5118 65.4698 91.0358 66.9449 89.3494 66.9449Z" fill="#8A5100"/>
                <g filter="url(#filter0_d)">
                <path d="M119.919 49.0706H44.021V54.1294H119.919V49.0706Z" fill="#C4C4C4"/>
                </g>
                <path d="M122.449 38.4471H41.491V54.1294H122.449V38.4471Z" fill="#FF9800"/>
                <path d="M84.9402 25.5629L77.0716 27.4682L74.5705 17.1432L79.98 15.8333L83.0342 17.6962L84.9402 25.5629Z" fill="#1976D2"/>
                <path d="M82.7245 18.0314L80.3888 18.597L79.8232 16.2616L82.7245 18.0314Z" fill="#E3F2FD"/>
                <path d="M80.7891 22.7236L80.6722 20.6636L81.4241 20.4815L81.5182 23.7889L80.7319 23.9793L79.8758 22.288L79.8975 24.1814L79.1132 24.3713L77.6808 21.3876L78.4352 21.205L79.2741 23.0901L79.2286 21.0129L79.8722 20.857L80.7891 22.7236Z" fill="#FAFAFA"/>
                <path d="M32.8012 63.2166L18.0746 66.8964L13.2436 47.5717L23.3682 45.0418L29.1205 48.4929L32.8012 63.2166Z" fill="#FF5722"/>
                <path d="M28.5455 49.1255L24.1735 50.218L23.0807 45.847L28.5455 49.1255Z" fill="#FBE9E7"/>
                <path d="M19.8858 58.8665L20.2884 60.4767L19.3633 60.7079L18.2186 56.1286L19.7791 55.7386C20.2319 55.6253 20.6289 55.6759 20.9682 55.8894C21.3076 56.1028 21.5337 56.4337 21.646 56.8829C21.7582 57.3321 21.7132 57.7191 21.5123 58.0459C21.3114 58.3727 20.9742 58.5948 20.502 58.7127L19.8858 58.8665ZM19.6932 58.096L20.3287 57.9372C20.5049 57.8932 20.6268 57.8016 20.6946 57.662C20.7623 57.5224 20.7683 57.3428 20.7132 57.1222C20.656 56.8935 20.5614 56.7241 20.429 56.6133C20.2968 56.503 20.1476 56.4676 19.9813 56.5065L19.3361 56.6679L19.6932 58.096ZM23.0284 59.7922L21.8836 55.2125L23.0949 54.91C23.6296 54.7764 24.0987 54.8397 24.5007 55.1002C24.9036 55.3602 25.182 55.7852 25.3362 56.375L25.5217 57.1171C25.6722 57.7186 25.6311 58.2311 25.3996 58.6525C25.167 59.0759 24.7722 59.3567 24.2144 59.4958L23.0284 59.7922ZM23.0008 55.7523L23.7611 58.7936L24.0382 58.7243C24.3465 58.6474 24.5434 58.5119 24.6284 58.3181C24.7135 58.1244 24.7097 57.8274 24.6165 57.4272L24.4176 56.6315C24.3106 56.204 24.1763 55.9207 24.0145 55.7821C23.8527 55.643 23.6271 55.6051 23.3378 55.6688L23.0009 55.7528L23.0008 55.7523ZM28.5638 56.4236L27.1261 56.7833L27.5932 58.6515L26.6682 58.8827L25.5234 54.3034L28.0592 53.6696L28.2518 54.44L26.6411 54.8427L26.9344 56.0158L28.3721 55.6567L28.5638 56.4236Z" fill="#FFEBEE"/>
                <path d="M140.415 48.9918L128.548 42.5721L136.976 26.9995L145.134 31.4131L146.836 37.127L140.415 48.9918Z" fill="#388E3C"/>
                <path d="M146.079 37.1968L142.557 35.291L144.463 31.7686L146.079 37.1968Z" fill="#E8F5E9"/>
                <path d="M138.105 38.8542L139.735 37.6966L141.042 38.4035L138.442 40.0389L138.51 43.1678L137.19 42.4536L137.26 40.4151L135.593 41.5898L134.276 40.8774L136.929 39.2208L136.879 36.1521L138.183 36.8574L138.105 38.8542Z" fill="white"/>
                </g>
                <defs>
                <filter id="filter0_d" x="40.021" y="49.0706" width="83.8982" height="13.0588" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                <feOffset dy="4"/>
                <feGaussianBlur stdDeviation="2"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                </filter>
                <clipPath id="clip0">
                <rect width="169" height="129" fill="white"/>
                </clipPath>
                </defs>
                </svg>

              <div class="text-center">
                <p class="mt-5 text-center text-wrap  lead" style="font-weight: 500"> Nothing is in your archive yet</p>
                </div>
             </div>
          </div>


        {{--  --}}
          <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@stop
