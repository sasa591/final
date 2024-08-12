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
    <link rel="stylesheet" href="CSS/activityLog.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="CSS/const.css" />
    <title>Activity Log</title>
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
                    <a class="firstA active" href="{{route('acty')}}">  <i class="fas fa-history fa-fw"></i>
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
        <!-- Start Inbox -->
        <div class="Home-contnet">
          <ul>
          @foreach($activityLogs as $activityLog)
            <li>
              <div class="activity">
                <div class="logo">
                  <i class="fas fa-history fa-fw"></i>

                  <div class="logo-text">
                    <h2>{{$activityLog->activity_type}}</h2>
                    @if($activityLog->activity_type=='Post')
                        @php
                            $uu=DB::table('posts')->find($activityLog->id)
                        @endphp
                        <h4>{{$uu->content}}</h4>
                    @endif

                    @if($activityLog->activity_type=='Comment')
                        @php
                            $uu=DB::table('comments')->find($activityLog->id)
                        @endphp
                        <h4>{{$uu->content_comment}}</h4>
                    @endif

                    @if($activityLog->activity_type=='Replay')
                        @php
                            $uu=DB::table('replays')->find($activityLog->id)
                        @endphp
                        <h4>{{$uu->replay_comment}}</h4>
                    @endif

                    @if($activityLog->activity_type=='Lecture')
                        @php
                            $uu=DB::table('lectures')->find($activityLog->id)
                        @endphp
                        <h4>{{$uu->name}}</h4>
                    @endif

                    @if($activityLog->activity_type=='Add Quizze')
                        @php
                            $uu=DB::table('quizzes')->find($activityLog->id)
                        @endphp
                        <h4>{{$uu->name}}  {{$uu->title}}</h4>
                    @endif

                    @if($activityLog->activity_type=='Take A Quizze')
                        @php
                            $uu=DB::table('degrees')->find($activityLog->id)
                        @endphp
                        <h4>{{$uu->name}} | Mark:<bdi>{{$uu->degree}}</bdi>  </h4>
                    @endif

                    @if($activityLog->activity_type=='تقديم وثيقة اعتراض')
                        @php
                            $uu=DB::table('objections')->find($activityLog->id)
                        @endphp

                    @endif

                    @if($activityLog->activity_type=='تقديم وثيقة دوام')
                        @php
                            $uu=DB::table('permenancydocuments')->find($activityLog->id)
                        @endphp

                    @endif

                    @if($activityLog->activity_type=='تقديم وثيقة تنزيل مواد')
                        @php
                            $uu=DB::table('downloadmaterials')->find($activityLog->id)
                        @endphp

                    @endif

                    @if($activityLog->activity_type=='تقديم وثيقة كشف علامات')
                        @php
                            $uu=DB::table('detectingsigns')->find($activityLog->id)
                        @endphp

                    @endif

                    @if($activityLog->activity_type=='تقديم وثيقة حياة جامعية ')
                        @php
                            $uu=DB::table('documents')->find($activityLog->id)
                        @endphp

                    @endif
                    <span>{{$activityLog->created_at}}</span>
                  </div>

                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        <!-- End Inbox -->
      </div>
    </div>
    <script src="/JAVA/activityLog.js"></script>
  </body>
</html>
