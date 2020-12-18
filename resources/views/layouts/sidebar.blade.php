<style>
  .active{
    background-color: #293059;

  }
  .active:hover{
    color: #FFF;
  }

   a.sidebar-li{
      color: #cccccc !important;
      margin-bottom: 10px;
  }
  a.sidebar-li:hover{
      color: #ffffff !important;
  }
  .sidebar-li a {
      font-size: 12px !important;
  }

  .badge {

  padding: 5px 5px;
  position: relative;
  top: -5px;
  left: -9px;
  /* border-radius: 100%; */
  background: #FD0606;
  /* color: white; */
}
.pulse {
  width: 10px;
  height: 10px;
  background: #FD0606;
  border-radius: 50%;
  /* color: #fff; */
  font-size: 0px;

  animation: animate 2s linear infinite;
}

.dropdown-item{
  font-size: 1.7ch !important;
}


  .search-btn{
    margin-left: 15px;
    padding-right: 30px;
    margin-top: px;
    position: relative;
    top: 45px;
    margin-bottom: 20px;
    margin-top: 15px;
  }


@keyframes animate {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 0, 64, 0.7), 0 0 0 0 rgba(255, 0, 64, 0.7);
    }

    40% {
        box-shadow: 0 0 0 50px rgba(255, 0, 64, 0), 0 0 0 0 rgba(255, 0, 64, 0.7);
    }

    80% {
        box-shadow: 0 0 0 50px rgba(255, 0, 64, 0), 0 0 0 30px rgba(255, 0, 64, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(255, 0, 64, 0), 0 0 0 30px rgba(255, 0, 64, 0);
    }
}
</style>

  <input type="checkbox" id="mobile-bars-check" />
  <label for="mobile-bars-check" id="mobile-bars">
      <div class="stix" id="stik1"></div>
      <div class="stix" id="stik2"></div>
      <div class="stix" id="stik3"></div>
  </label>

    <section class="sidebar" id="sidebar" style="">
    <nav id="nav">
      <a href="#"><div class="logo"></div></a>
      <!-- <p>Full name</p> -->

      <hr>

        <!-- <input type="text" name="search" placeholder="Search" class="" /> -->



      <div id="sub-header">
        <ul class="sidebar-ul" id="menuLinks">

        <li>

        <!-- <div class="input-group search-btn" >
            <input type="text" class="form-control" placeholder="Search" style="height: 32px; ">
            <div class="input-group-append">
                <a href="" class="btn " style="background-color: white; height: 32px;">
                    <img src="{{ asset('css/echovc_icons/ic-baseline-search.svg')}}" class="mt-n2" alt="">
                </a>
            </div>
        </div> -->
        </li>
        <div class="mt-n5" style="width:12.3rem">

            <li><a href="/home"   class="sidebar-li home"><img src="{{ asset('css/icons/homelogo.png') }}" />HOME</a></li>
            <li><a href="/dashboard"    class="sidebar-li dashboard"><img src="{{ asset('css/icons/dash.png') }}" />DASHBOARD</a></li>
            <li><a href="/company_list" class="sidebar-li port"><img src="{{ asset('css/icons/port.png') }}" />PORTIFOLIO COMPANIES</a></li>
            <li>

                <a href="/reports" class="sidebar-li report"><img src="{{ asset('css/icons/report.png') }}" />
                    <div class="pulse badge" style="display: {{ session('new_submissions') ? '' : 'none' }}">.</div> </span>REPORTS</a>

            </li>
            <li><a href="/metrics" class="sidebar-li metric"><img src="{{ asset('css/icons/metr.png') }}" />METRICS</a></li>
            <li><a href="/contacts" class="sidebar-li contact"><img src="{{ asset('css/icons/contact.png') }}" />CONTACTS</a></li>
            <li><a href="/investors" class="sidebar-li investor"><img style="filter: invert(100%)" src="{{ asset('css/echovc_icons/investor.svg') }}" />INVESTOR RELATIONS</a></li>
            <li><a href="/files" class="sidebar-li file"><img src="{{ asset('css/icons/file.png') }}" />FILES</a></li>
            <li><a href="/archives" class="sidebar-li archive"><img src="{{ asset('css/icons/arch.png') }}" />ARCHIVES</a></li>

        </div>
        </ul>
      </div>

        <ul class="navbar-nav name-section ml-auto" style="cursor:pointer">


            <li class="nav-item dropdown ">
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{Auth::user() ? Auth::user()->fullname : ''}}
                {{-- <span class="caret"></span> --}}
              </a>

              <div class="dropdown-menu bg-white" aria-labelledby="dropdownMenuLink" style="background:#666; font-size:0.7rem">

              <a class="dropdown-item" href="#">
                      Help
                      <svg width="15" class="float-right" height="15" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M7 1.16667C3.78525 1.16667 1.16667 3.78525 1.16667 7C1.16667 10.2148 3.78525 12.8333 7 12.8333C10.2148 12.8333 12.8333 10.2148 12.8333 7C12.8333 3.78525 10.2148 1.16667 7 1.16667ZM7 2.33333C9.58424 2.33333 11.6667 4.41576 11.6667 7C11.6667 9.58424 9.58424 11.6667 7 11.6667C4.41576 11.6667 2.33333 9.58424 2.33333 7C2.33333 4.41576 4.41576 2.33333 7 2.33333ZM7 3.5C5.71083 3.5 4.66667 4.54417 4.66667 5.83333H5.83333C5.83333 5.19167 6.35833 4.66667 7 4.66667C7.64167 4.66667 8.16667 5.19167 8.16667 5.83333C8.16667 7 6.41667 7.21408 6.41667 8.75H7.58333C7.58333 7.78692 9.33333 7.29167 9.33333 5.83333C9.33333 4.54417 8.28917 3.5 7 3.5ZM6.41667 9.33333V10.5H7.58333V9.33333H6.41667Z" fill="#666666"/>
                          </svg>
              </a>
              {{--  <a class="dropdown-item" href="/home">
                  Home
                  <svg width="21" class="float-right" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.2892 8.85714V13.1429C15.2892 13.2976 15.2326 13.4315 15.1195 13.5446C15.0065 13.6577 14.8725 13.7143 14.7178 13.7143H11.2892V10.2857H9.00348V13.7143H5.57491C5.42014 13.7143 5.28622 13.6577 5.17312 13.5446C5.06002 13.4315 5.00348 13.2976 5.00348 13.1429V8.85714C5.00348 8.85119 5.00497 8.84226 5.00794 8.83035C5.01092 8.81845 5.01241 8.80952 5.01241 8.80357L10.1463 4.57143L15.2803 8.80357C15.2862 8.81547 15.2892 8.83333 15.2892 8.85714ZM17.2803 8.24107L16.7267 8.90178C16.6791 8.95535 16.6166 8.98809 16.5392 9H16.5124C16.435 9 16.3725 8.97916 16.3249 8.9375L10.1463 3.78571L3.96776 8.9375C3.89633 8.98512 3.82491 9.00595 3.75348 9C3.6761 8.98809 3.6136 8.95535 3.56598 8.90178L3.01241 8.24107C2.96479 8.18154 2.94395 8.1116 2.94991 8.03125C2.95586 7.95089 2.9886 7.8869 3.04812 7.83928L9.46776 2.49107C9.65824 2.33631 9.88443 2.25893 10.1463 2.25893C10.4082 2.25893 10.6344 2.33631 10.8249 2.49107L13.0035 4.3125V2.57143C13.0035 2.48809 13.0303 2.41964 13.0838 2.36607C13.1374 2.3125 13.2059 2.28571 13.2892 2.28571H15.0035C15.0868 2.28571 15.1553 2.3125 15.2088 2.36607C15.2624 2.41964 15.2892 2.48809 15.2892 2.57143V6.21428L17.2445 7.83928C17.3041 7.8869 17.3368 7.95089 17.3428 8.03125C17.3487 8.1116 17.3279 8.18154 17.2803 8.24107Z" fill="#666666"/>
                      </svg>
              </a>  --}}
              {{--  @if (Auth::user() && Auth::user()->permission === 'admin' && Auth::user()->id === 1 )
                <a class="dropdown-item" href="/permissions">
                  Settings
                  <svg width="15" height="15" class="float-right" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4.83301 1.00001L4.58789 2.26172C4.17581 2.41713 3.79739 2.63497 3.46582 2.90723L2.25391 2.48926L1.08594 4.51075L2.05664 5.3545C2.01932 5.58361 2 5.79593 2 6.00001C2 6.20439 2.0199 6.41632 2.05664 6.64551V6.64649L1.08594 7.49024L2.25391 9.51075L3.46484 9.09376C3.79645 9.36617 4.17572 9.58279 4.58789 9.73829L4.83301 11H7.16699L7.41211 9.73829C7.82446 9.58278 8.20245 9.36529 8.53418 9.09278L9.74609 9.51075L10.9131 7.49024L9.94336 6.64551C9.98068 6.4164 10 6.20408 10 6.00001C10 5.79623 9.98057 5.58419 9.94336 5.35548V5.3545L10.9141 4.50977L9.74609 2.48926L8.53516 2.90626C8.20355 2.63385 7.82428 2.41722 7.41211 2.26172L7.16699 1.00001H4.83301ZM5.65723 2.00001H6.34277L6.53711 3.00001L7.05859 3.19727C7.37293 3.31574 7.65534 3.47838 7.90039 3.67969L8.33203 4.03321L9.29297 3.70313L9.63574 4.2959L8.86816 4.96387L8.95605 5.51368V5.51465C8.98663 5.70212 9 5.85939 9 6.00001C9 6.14062 8.98663 6.29787 8.95605 6.48536L8.86719 7.03516L9.63477 7.70313L9.29199 8.29688L8.33203 7.96583L7.89941 8.32032C7.65436 8.52163 7.37293 8.68427 7.05859 8.80274H7.05762L6.53613 9.00001L6.3418 10H5.65723L5.46289 9.00001L4.94141 8.80274C4.62707 8.68427 4.34466 8.52163 4.09961 8.32032L3.66797 7.9668L2.70703 8.29688L2.36426 7.70411L3.13281 7.03516L3.04395 6.48731V6.48633C3.01381 6.29805 3 6.14034 3 6.00001C3 5.85939 3.01337 5.70215 3.04395 5.51465L3.13281 4.96485L2.36426 4.29688L2.70703 3.70313L3.66797 4.03419L4.09961 3.67969C4.34466 3.47838 4.62707 3.31574 4.94141 3.19727L5.46289 3.00001L5.65723 2.00001ZM6 4.00001C4.90174 4.00001 4 4.90174 4 6.00001C4 7.09827 4.90174 8.00001 6 8.00001C7.09826 8.00001 8 7.09827 8 6.00001C8 4.90174 7.09826 4.00001 6 4.00001ZM6 5.00001C6.55574 5.00001 7 5.44427 7 6.00001C7 6.55575 6.55574 7.00001 6 7.00001C5.44426 7.00001 5 6.55575 5 6.00001C5 5.44427 5.44426 5.00001 6 5.00001Z" fill="#666666"/>
                      </svg>

              </a>
              @endif  --}}
              <a class="dropdown-item" href="/profile">Account Setting
                  <svg width="15" height="15" class="float-right" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4.83301 1.00001L4.58789 2.26172C4.17581 2.41713 3.79739 2.63497 3.46582 2.90723L2.25391 2.48926L1.08594 4.51075L2.05664 5.3545C2.01932 5.58361 2 5.79593 2 6.00001C2 6.20439 2.0199 6.41632 2.05664 6.64551V6.64649L1.08594 7.49024L2.25391 9.51075L3.46484 9.09376C3.79645 9.36617 4.17572 9.58279 4.58789 9.73829L4.83301 11H7.16699L7.41211 9.73829C7.82446 9.58278 8.20245 9.36529 8.53418 9.09278L9.74609 9.51075L10.9131 7.49024L9.94336 6.64551C9.98068 6.4164 10 6.20408 10 6.00001C10 5.79623 9.98057 5.58419 9.94336 5.35548V5.3545L10.9141 4.50977L9.74609 2.48926L8.53516 2.90626C8.20355 2.63385 7.82428 2.41722 7.41211 2.26172L7.16699 1.00001H4.83301ZM5.65723 2.00001H6.34277L6.53711 3.00001L7.05859 3.19727C7.37293 3.31574 7.65534 3.47838 7.90039 3.67969L8.33203 4.03321L9.29297 3.70313L9.63574 4.2959L8.86816 4.96387L8.95605 5.51368V5.51465C8.98663 5.70212 9 5.85939 9 6.00001C9 6.14062 8.98663 6.29787 8.95605 6.48536L8.86719 7.03516L9.63477 7.70313L9.29199 8.29688L8.33203 7.96583L7.89941 8.32032C7.65436 8.52163 7.37293 8.68427 7.05859 8.80274H7.05762L6.53613 9.00001L6.3418 10H5.65723L5.46289 9.00001L4.94141 8.80274C4.62707 8.68427 4.34466 8.52163 4.09961 8.32032L3.66797 7.9668L2.70703 8.29688L2.36426 7.70411L3.13281 7.03516L3.04395 6.48731V6.48633C3.01381 6.29805 3 6.14034 3 6.00001C3 5.85939 3.01337 5.70215 3.04395 5.51465L3.13281 4.96485L2.36426 4.29688L2.70703 3.70313L3.66797 4.03419L4.09961 3.67969C4.34466 3.47838 4.62707 3.31574 4.94141 3.19727L5.46289 3.00001L5.65723 2.00001ZM6 4.00001C4.90174 4.00001 4 4.90174 4 6.00001C4 7.09827 4.90174 8.00001 6 8.00001C7.09826 8.00001 8 7.09827 8 6.00001C8 4.90174 7.09826 4.00001 6 4.00001ZM6 5.00001C6.55574 5.00001 7 5.44427 7 6.00001C7 6.55575 6.55574 7.00001 6 7.00001C5.44426 7.00001 5 6.55575 5 6.00001C5 5.44427 5.44426 5.00001 6 5.00001Z" fill="#666666"/>
                      </svg>

              </a>
              {{-- <a class="dropdown-item" href="/home">Home</a> --}}
              {{--  <a class="dropdown-item"
                onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
                      Signout
              </a>  --}}

              <a class="dropdown-item"
                href="{{ url('/logout') }}">
                      Sign Out
                      <i class="fas fa-sign-out-alt float-right"></i>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>

              @if (Auth::user() && Auth::user()->permission === 'admin' && Auth::user()->id === 1)
                <a class="dropdown-item" href="{{ url('/admin/backup') }}">Backup
                  <svg width="15" height="15" class="float-right" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14 13V17H10V13H7L12 8L17 13H14ZM19.35 10.03C18.67 6.59 15.64 4 12 4C9.11 4 6.6 5.64 5.35 8.03C2.34 8.36 0 10.9 0 14C0 15.5913 0.632141 17.1174 1.75736 18.2426C2.88258 19.3679 4.4087 20 6 20H19C19.6566 20 20.3068 19.8707 20.9134 19.6194C21.52 19.3681 22.0712 18.9998 22.5355 18.5355C22.9998 18.0712 23.3681 17.52 23.6194 16.9134C23.8707 16.3068 24 15.6566 24 15C24 12.36 21.95 10.22 19.35 10.03Z" fill="#666666"/>
                      </svg>

              </a>
              @endif

              </div>
              </li>
          </ul>

    </nav>
    </section>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
  $(function() {
    $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
});

</script>
