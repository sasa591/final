<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Normalize CSS File -->
    <link rel="stylesheet" href="/CSS/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="/CSS/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- CSS Master File -->
    <link rel="stylesheet" href="/CSS/friends-profile.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="/CSS/const.css" />
    <title>Vision-Friends</title>
  </head>
  <body onclick="handleClick3(event)">
    <!-- Container for whole page -->
    <div class="page">
      <!-- Start Notfication Menu -->
      <div class="notification-menu" id="notfi-menu">
        <ul>
          <h4>Notifications</h4>
          <i id="close-notfi-menu" class="fa-solid fa-xmark fa-fw"></i>
          @if(count($nots)==0)
          <div class="no-notfi">There are no Notficationns</div>
          @endif
          @foreach($nots as $not)
          @php
                $unot=DB::table('users')->find($not->notuser_id)
          @endphp
        <a href="#lll_{{$not->notpost_id}}">
        <li>
        @if($unot->img!="")
        <img src="{{asset('profil/'.$unot->img)}}" alt="logo" />
        @elseif(true)
            <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
        @endif

            <div class="txt">
                <p>{{$unot->first_name}} {{$unot->last_name}} posted a new announcement</p>

                @php
                    $currentDatanot =Carbon\Carbon::now();
                    $time_not = $not->created_at;
                    $timecreatenot = Carbon\Carbon::parse($time_not);
                    $diffsec = $currentDatanot->diffInMinutes($timecreatenot);
                @endphp

                @if($diffsec<=59)
                    <p>{{floor($diffsec)}} m</p>

                @elseif($diffsec>=60 &&$diffsec < 1440)
                    <p>{{floor($diffsec/60)}} h</p>

                @elseif($diffsec>=1440 &&$diffsec< 10080)
                    <p>{{floor($diffsec/1440)}} d</p>

                @elseif($diffsec>=10080 &&$diffsec< 40320)
                    <p>{{floor($diffsec/10080)}} w</p>

                @elseif($diffsec>=40320 &&$diffsec< 483840)
                    <p>{{floor($diffsec/40320)}} m</p>

                @elseif($diffsec>=483840)
                    <p>{{floor($diffsec/40320)}} y</p>

                @endif

            </div>
            <span>
                @if($not->type=='post')
                    <i class="fa-solid fa-bullhorn"></i>
                @endif
            </span>
        </li>

        </a>
        @endforeach

          <!-- <li>
            <img src="/images/profile-image.png" alt="logo" />
            <div class="txt">
              <p>hey my name is ali ali</p>
              <p>1m</p>
            </div>
            <span><i class="fa-solid fa-file"></i></span>
          </li> -->




          <!-- <li>
            <img src="/images/profile-image.png" alt="logo" />
            <div class="txt">
              <p>hey my name is ali ali</p>
              <p>1m</p>
            </div>
            <span><i class="fa-solid fa-file"></i></span>
          </li> -->


        </ul>
      </div>
      <!-- End Notfication Menu -->
      <!-- SideBar to the left -->
      <div class="sidebar">
            <div class="con">
                <h3>VISION</h3>
                <ul class="iconspan">
                    <li>
                        <a class="firstA active" href="{{route('home')}}"> <i class="fa-solid fa-house fa-fw"></i> <span>Home</span> </a>
                    </li>
                    @if(auth()->user()->type=="student" || auth()->user()->type=='Professor')
                    <li>
                        <a class="firstA" href="{{route('profile')}}"> <i class="fa-solid fa-user fa-fw"></i> <span>Profile</span> </a>
                    </li>
                    @endif



                    <li>
                        <a class="firstA" href="{{route('homecourses')}}"> <i class="fa-solid fa-graduation-cap fa-fw"></i> <span>Courses</span> </a>
                    </li>
                    @if(auth()->user()->type=="student")
            <li>
                <a class="firstA" href="{{route('services')}}">
                    <i class="fa-solid fa-file-pen fa-fw"></i>
                    <span>Services</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->type=="admin")
            <li>
                <a class="firstA" href="{{route('servicesadmin')}}">
                    <i class="fa-solid fa-file-pen fa-fw"></i>
                    <span>Services</span>
                </a>
            </li>

            <li>
              <a class="firstA" href="{{route('mangement')}}">
                <i class="fa-solid fa-screwdriver-wrench fa-fw"></i>
                <span>Mangement</span>
              </a>
            </li>
            @endif

            @if(auth()->user()->type=="student" || auth()->user()->type=='Professor')
            <li>
              <a class="firstA" href="{{route('homelibrary')}}">
                <i class="fa-solid fa-book fa-fw"></i>
                <span>Library</span>
              </a>
            </li>
            @endif
            @if(auth()->user()->type=="student")
            <li>
              <a class="firstA" href="{{route('inbox')}}">
                <i class="fa-solid fa-inbox fa-fw"></i>
                <span>Inbox</span>
              </a>
            </li>
            @endif
                    <li>
                    <a class="firstA" href="{{route('acty')}}">  <i class="fas fa-history fa-fw"></i>
                <span>Activity Log</span> </a>
                    </li>

                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        @csrf

                        </form>
                        <a class="firstA" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket fa-fw"></i>
                            <span>Log out</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
      <!-- Content to the right -->
      <div class="content">
        <!-- Start Head -->
        <div class="head">
          <div class="icons">
          @if(auth()->user()->img!="")
                <img src="{{asset('profil/'.auth()->user()->img)}}" alt="logo" />
              @elseif(true)
              <img class="avatar" src="/Images/profile-image.png" alt="tttt"/>
              @endif
            <span class="notification">
              <i class="fa-solid fa-bell light-red" id="notfi-icon"></i>
            </span>
          </div>
          <div class="search">
          <form action="{{route('search')}}" method="post" >
            @csrf
              <label for="findsomeone"
                ><i class="fa-solid fa-magnifying-glass"></i
              ></label>
              <input id="findsomeone" type="search"  name="searchname"  />
              <input type="submit" hidden />
            </form>
          </div>
        </div>
        <!-- End Head -->
        <!-- Start All Profile -->
        <div class="Home-content">
          <!-- Start Profile Page -->
          <div class="profile">
            <!-- Start overview -->
            <div class="overview">
              <div class="avatar-box">
              @if($us->img!="")
                <img src="{{asset('profil/'.$us->img)}}" alt="logo" />
              @elseif(true)
              <img class="avatar" src="/Images/profile-image.png" alt="tttt"/>
              @endif
                <h3>{{$us->first_name}} {{$us->last_name}}</h3>
                <p>{{$us->type}}</p>
              </div>
              <!-- Start Info -->
              <div class="info-box">
                <!-- Start Informations Row -->
                <div class="box">
                  <h4>General Informations</h4>
                  <div>
                    <span class="spanOne">First Name : </span>
                    <span class="spanTwo">{{$us->first_name}}</span>
                  </div>
                  <div>
                    <span class="spanOne">Last Name : </span>
                    <span class="spanTwo">{{$us->last_name}}</span>
                  </div>
                  <div>
                    <span class="spanOne">Adress : </span>
                    <span class="spanTwo">{{$us->adress}}</span>
                  </div>
                </div>
                <!-- ---------------------------- -->
                <div class="box">
                  <h4>Personal Information</h4>
                  <div>
                    <span class="spanOne">Email : </span>
                    <span class="spanTwo">{{$us->email}}</span>
                  </div>
                  <div>
                    <span class="spanOne">Phone : </span>
                    <span class="spanTwo">{{$us->phone}}</span>
                  </div>
                  <div>
                    <span class="spanOne">Date Of Birth : </span>
                    <span class="spanTwo">{{$us->birth}}</span>
                  </div>
                </div>
                <!-- ---------------------------- -->
                <div class="box">
                  <h4>Job Information</h4>
                  <div>
                    <span class="spanOne">Title : </span>
                    <span class="spanTwo">{{$us->title}}</span>
                  </div>
                  @if($us->type=='Professor')
                  <div>
                    <span class="spanOne">Section : </span>
                    <span class="spanTwo">{{$us->purview}}</span>
                  </div>
                  @endif

                  @if($us->type=='student')
                  <div>
                    <span class="spanOne">year : </span>
                    <span class="spanTwo">{{$us->year}}</span>
                  </div>
                  @endif
                  <div>
                    <span class="spanOne">Years Of Experience : </span>
                    <span class="spanTwo">{{$us->years_experience}}</span>
                  </div>
                </div>
                <!-- ---------------------------- -->
                <div class="box">
                  <h4>Details</h4>
                  <div>
                    <span class="spanOne">About Me : </span>
                    <span class="spanTwo">{{$us->about_me}}</span>
                  </div>
                </div>
                <!-- ---------------------------- -->
                <!-- End Informations Row -->
              </div>
              <!-- End Info -->
            </div>
            <!-- End overview -->
          </div>
        </div>
        <!-- End Profile Page -->
      </div>
    </div>
    <script src="/JAVA/friends-profile.js"></script>
  </body>
</html>
