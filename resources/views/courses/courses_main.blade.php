<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Normalize CSS File -->
    <link rel="stylesheet" href="CSS/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="CSS/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- CSS Master File -->
    <link rel="stylesheet" href="CSS/coursers.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="CSS/const.css" />
    <title>Vision-Coursers</title>
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
        </ul>
      </div>
      <!-- End Notfication Menu -->
      <!-- SideBar to the left -->
      <div class="sidebar">
            <div class="con">
                <h3>VISION</h3>
                <ul class="iconspan">
                    <li>
                        <a class="firstA" href="{{route('home')}}"> <i class="fa-solid fa-house fa-fw"></i> <span>Home</span> </a>
                    </li>
                    @if(auth()->user()->type=="student" || auth()->user()->type=='Professor')
                    <li>
                        <a class="firstA" href="{{route('profile')}}"> <i class="fa-solid fa-user fa-fw"></i> <span>Profile</span> </a>
                    </li>
                    @endif



                    <li>
                        <a class="firstA active" href="{{route('homecourses')}}"> <i class="fa-solid fa-graduation-cap fa-fw"></i> <span>Courses</span> </a>
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
                <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
            @endif
                    <span class="notification">
                        <i class="fa-solid fa-bell light-red" id="notfi-icon"></i>
                    </span>
                </div>
            <div class="search">
            <form action="{{route('search')}}" method="post" >
            @csrf
                <label for="findsomeone">
                    <i class="fa-solid fa-magnifying-glass"></i></label>
                    <input id="findsomeone" type="search" name="searchname"  />
                    <input type="submit" hidden />
            </form>
             </div>
        </div>
        <!-- End Head -->
        <!-- Start All Profile -->
        <div class="Home-content">
          <div class="coursers">
          @if(auth()->user()->type=="student" || auth()->user()->type=='Professor')
                <div class="box" id="lect">
                    <div class="icon">
                        <i class="fa-solid fa-book-open-reader fa-4x"></i>
                    </div>
                    <h3>Lectures</h3>
                    <p>View All lectures at the collage</p>
                </div>
@endif
            <a href="{{route('programmes')}}">
              <div class="box">
                <div class="icon">
                  <i class="fa-solid fa-table fa-4x"></i>
                </div>
                <h3>Programmes</h3>
                <p>Check out the Weekly programmes</p>
              </div>
            </a>
            @if(auth()->user()->type=="student" || auth()->user()->type=='Professor')
            <a href="#">
              <div class="box" id="quizz">
                <div class="icon">
                  <i class="fa-solid fa-lightbulb fa-4x"></i>
                </div>
                <h3>Quizzes</h3>
                <p>Take a test</p>
              </div>
            </a>
            @endif
            <a href="{{route('homegrads')}}">
              <div class="box">
                <div class="icon">
                  <i class="fa-solid fa-a fa-4x"></i>
                  <i class="fa-solid fa-plus fa-2x"></i>
                </div>
                <h3>Grades</h3>
                <p>Upload grades files</p>
              </div>
            </a>
          </div>
          <!-- Start Years Popup -->
          <div class="years" id="years">
            <i id="x-close" class="fa-solid fa-xmark fa-fw"></i>
            <ul>
              <a href="{{route('coursesyear',['id'=>1])}}"><li>First Year</li></a>
              <a href="{{route('coursesyear',['id'=>2])}}"><li>Second Year</li></a>
              <a href="{{route('coursesyear',['id'=>3])}}"><li>Third Year</li></a>
              <a href="{{route('coursesyear',['id'=>4])}}"><li>Fourth Year</li></a>
              <a href="{{route('coursesyear',['id'=>5])}}"><li>Fifth Year</li></a>
            </ul>
          </div>
          <div class="years" id="yearsq">
            <i id="xx-close" class="fa-solid fa-xmark fa-fw"></i>
            <ul>
              <a href="{{route('homequizzes',['id'=>1])}}"><li>First Year</li></a>
              <a href="{{route('homequizzes',['id'=>2])}}"><li>Second Year</li></a>
              <a href="{{route('homequizzes',['id'=>3])}}"><li>Third Year</li></a>
              <a href="{{route('homequizzes',['id'=>4])}}"><li>Fourth Year</li></a>
              <a href="{{route('homequizzes',['id'=>5])}}"><li>Fifth Year</li></a>
            </ul>
          </div>
          <!-- End Years Popup -->
        </div>
        <!-- End Profile Page -->
      </div>
    </div>
    <script src="JAVA/coursers.js"></script>
  </body>
</html>
