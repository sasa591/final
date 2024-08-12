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
    <link rel="stylesheet" href="/CSS/one-year-quizze.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="/CSS/const.css" />
    <title>Vision-Lectures</title>
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
                <label for="findsomeone">
                    <i class="fa-solid fa-magnifying-glass"></i></label>
                    <input id="findsomeone" type="search" name="searchname"  />
                    <input type="submit" hidden />
            </form>
             </div>
        </div>
        <!-- End Head -->
        <!-- Start Home-content -->
        <div class="Home-content">
          <div class="main-heading">
            <h2>{{$name}}</h2>
          </div>
          <div class="quizzes">

            <div class="files">
                @foreach($quizzes as $quizze)
                <div class="one-file">
                    <div class="head-q">
                        <h2>{{$quizze->title}}</h2>
                        <i class="fa-solid fa-lightbulb fa-4x"></i>
                    </div>
                    <div class="info">
                    @php
                        $student = \App\Models\degree::where('u_id',auth()->user()->id)->where('quiz_id',$quizze->id)->first();
                        @endphp

                        @if($student!='')
                        <span>Statu : <span>Completed</span></span>
                        @endif
                        <span>Date : <span>{{Carbon\Carbon::parse($quizze->created_at)->format('d / m / Y')}}</span></span>
                        <span>
                        @if($student!='')
                        <span>Degree : </span>{{$student->degree}}<span></span>/<span>{{$student->totalmark}}</span></span>
                        @endif
                    </div>

                    <div class="foot">
                    @if(auth()->user()->id==$quizze->u_id)
                    <div id="delete_detecting_{{$quizze->id}}" class="iconescom">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                    @endif
                    @if($student!='')
                        <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
                    @endif

                    @if($student=='')
                        <a href="{{route('quizshow', $quizze->id)}}"><i class="fa-solid fa-arrow-right"></i></a>
                    @endif

                    </div>
                </div>
                <div class="conatiner conatinercom" id="delete_confirm_inbox{{ $quizze->id }}">
                <form id="delete_programmer_form_{{ $quizze->id }}"  action="{{route('deletequizze',$quizze->id)}}" autocomplete="off">
                    <div class="login-title">
                        <h2>Are you sure?</h2>
                    </div>
                    <div class="page-box">
                        <div class="btn">
                            <input onclick="closePopupc('delete_confirm_inbox{{ $quizze->id }}')" value="Cancel" id="cancel" class="form-btn" />
                            <input type="submit" value="Confirm" class="form-btn" />
                        </div>
                    </div>
                </form>
            </div>
                @endforeach
            </div>
          </div>
          <!-- Start Delete Popup -->

          <!-- End Delete Popup -->
        </div>
        <!-- End Home-contnet -->


      </div>
    </div>
    <script src="/JAVA/one-year-lectures.js"></script>
    <script>
    function openPopup1(popupId) {
            closeAllPopups(); // إغلاق جميع ال popups
            document.getElementById(popupId).classList.add("open-popup");
        }

        function closePopupc(popupId) {
            document.getElementById(popupId).classList.remove("open-popup");;
        }

        function closeAllPopups() {
            var popups = document.querySelectorAll('.conatinercom');
            popups.forEach(function(popup) {
                popup.classList.remove("open-popup");
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.iconescom');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var adId = button.id.split('_')[2]; // استخراج معرف الإعلان من معرف الزر
                    var popupId = 'delete_confirm_inbox' + adId; // بناء معرف نافذة التأكيد

                    openPopup1(popupId); // فتح نافذة التأكيد
                });
            });
        });
    </script>
  </body>
</html>
