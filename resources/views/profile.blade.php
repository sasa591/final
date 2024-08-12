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
    <!-- CSS FrameWork File -->
    <link rel="stylesheet" href="/CSS/framework.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="/CSS/const.css" />
    <!-- CSS Master File -->
    <link rel="stylesheet" href="/CSS/profile.css" />
    <title>Vision-Profile</title>
  </head>
  <body onclick="handleClick3(event)">
    <!-- Container for whole page -->
    <div class="page">
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

        </ul>
      </div>
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
                        <a class="firstA active" href="{{route('profile')}}"> <i class="fa-solid fa-user fa-fw"></i> <span>Profile</span> </a>
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
        <!-- Start Profile Page -->
        <div class="profile">
          <!-- Start overview -->
          <div class="overview">
            <div class="avatar-box">
            @if(auth()->user()->img!="")
                <img src="{{asset('profil/'.auth()->user()->img)}}" alt="logo" />
            @elseif(true)
                <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
            @endif
              <h3>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
              <p>{{auth()->user()->type}}</p>
              <div class="btn-edit">
              <form action="{{route('update5')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input id="ima" name="photo" type="file" />
                    <label for="ima"><i class="fas fa-image"></i></label>
                    <input type="submit" value="Change Photo" class="chp">
                </form>
                <button onclick="openPopup5()" title="change your password">
                  <i class="fa-solid fa-key"></i>
                </button>
              </div>
            </div>
            <!-- Start Info -->
            <div class="info-box">
              <!-- Start Informations Row -->
              <div class="box">
                <h4>General Informations</h4>
                <div>
                  <span class="spanOne">First Name : </span>
                  <span class="spanTwo">{{auth()->user()->first_name}}</span>
                </div>
                <div>
                  <span class="spanOne">Last Name : </span>
                  <span class="spanTwo">{{auth()->user()->last_name}}</span>
                </div>
                <div>
                  <span class="spanOne">Adress : </span>
                  <span class="spanTwo">{{auth()->user()->adress}}</span>
                </div>
                <div class="btn-update">
                  <button onclick="openPopup()">
                    <i
                      title="Update Your Information"
                      class="fa-solid fa-pen-to-square"
                    ></i>
                  </button>
                </div>
              </div>
              <!-- ---------------------------- -->
              <div class="box">
                <h4>Personal Information</h4>
                <div>
                  <span class="spanOne">Email : </span>
                  <span class="spanTwo">{{auth()->user()->email}}</span>
                </div>
                <div>
                  <span class="spanOne">Phone : </span>
                  <span class="spanTwo">{{auth()->user()->phone}}</span>
                </div>
                <div>
                  <span class="spanOne">Date Of Birth : </span>
                  <span class="spanTwo">{{auth()->user()->birth}}</span>
                </div>
                <div class="btn-update" onclick="openPopup2()">
                  <button>
                    <i
                      title="Update Your Information"
                      class="fa-solid fa-pen-to-square"
                    ></i>
                  </button>
                </div>
              </div>
              <!-- ---------------------------- -->
              <div class="box">
                <h4>Job Information</h4>
                <div>
                  <span class="spanOne">Title : </span>
                  <span class="spanTwo">{{auth()->user()->title}}</span>
                </div>
                <div>
                @if(auth()->user()->type=="Professor")
                  <span class="spanOne">purview : </span>
                  <span class="spanTwo">{{auth()->user()->purview}}</span>
                @endif

                @if(auth()->user()->type=="student")
                  <span class="spanOne">year : </span>
                  <span class="spanTwo">{{auth()->user()->year}}</span>
                @endif
                </div>
                <div>
                  <span class="spanOne">Years Of Experience : </span>
                  <span class="spanTwo">{{auth()->user()->years_experience}}</span>
                </div>
                <div class="btn-update" onclick="openPopup3()">
                  <button>
                    <i
                      title="Update Your Information"
                      class="fa-solid fa-pen-to-square"
                    ></i>
                  </button>
                </div>
              </div>
              <!-- ---------------------------- -->
              <div class="box">
                <h4>Details</h4>
                <div>
                  <span class="spanOne">About Me : </span>
                  <span class="spanTwo">{{auth()->user()->about_me }}</span>
                </div>
                @if(auth()->user()->type=='student')
                <div>
                  <span class="spanOne">Balance : </span>
                  <span class="spanTwo">{{auth()->user()->balance }}</span>
                </div>
                @endif
                <div class="btn-update" onclick="openPopup4()">
                  <button>
                    <i
                      title="Update Your Information"
                      class="fa-solid fa-pen-to-square"
                    ></i>
                  </button>
                </div>
              </div>
              <!-- ---------------------------- -->
              <!-- End Informations Row -->
            </div>
            <!-- End Info -->
          </div>
          <!-- End overview -->
        </div>
        <!-- End Profile Page -->
      </div>
      <!-- Start Popup Section -->
      <!-- Start Popup for General Information -->
      <div class="conatiner" id="popup">
        <form action="{{route('update')}}" method="POST" autocomplete="off">
          @csrf
          <div class="login-title">
            <h2>General Information</h2>
          </div>
          <div class="page-box">
            <div class="input-box">
              <input name="first_name" type="text" value="{{auth()->user()->first_name}}" maxlength="10" autofocus />
              <label>First name</label>
            </div>
            <div class="input-box">
              <input type="text" name="last_name" value="{{auth()->user()->last_name}}" maxlength="10" />
              <label>Last name</label>
            </div>
            <div class="input-box">
              <input type="text" name="adress" value="{{auth()->user()->adress}}" />
              <label>Adress</label>
            </div>
            <div class="btn">
              <input

                onclick="closePopup()"
                value="Cancel"
                class="form-btn"
              />
              <input type="submit" value="Update" class="form-btn" />
            </div>
          </div>
        </form>
      </div>
      <!-- End Popup for General Information -->
      <!-- ----------------------------------------- -->
      <!-- Start Popup for Personal Information -->
      <div class="conatiner" id="popup2">
        <form action="{{route('update2')}}"  method="POST" autocomplete="off">
          @csrf
          <div class="login-title">
            <h2>Personal Information</h2>
          </div>
          <div class="page-box">
            <div class="input-box">
              <input type="text"  name="email" value="{{auth()->user()->email}}" autofocus readonly />
              <label>Email</label>
            </div>
            <div class="input-box">
              <input type="number" min="1" name="phone" value="{{auth()->user()->phone}}" autofocus maxlength="10" />
              <label>Number</label>
            </div>
            <div class="input-box">
              <input style="width: 193px" type="date" name="birth" value="{{auth()->user()->birth}}" autofocus  class="dateinput" />
              <label>Date Of Birth</label>
            </div>
            <div class="btn">
              <input

                onclick="closePopup2()"
                value="Cancel"
                class="form-btn"
              />
              <input type="submit" value="Update" class="form-btn" />
            </div>
          </div>
        </form>
      </div>
      <!-- End Popup for Personal Information -->
      <!-- ----------------------------------------- -->
      <!-- ----------------------------------------- -->
      <!-- Start Popup for Job Information -->
      <div class="conatiner" id="popup3">
        <form action="{{route('update3')}}" autocomplete="off">
          @csrf
          <div class="login-title">
            <h2>Job Information</h2>
          </div>
          <div class="page-box">
            <div class="input-box">
              <input type="text"  name="title" value="{{auth()->user()->title}}" autofocus />
              <label>Title</label>
            </div>
            @if(auth()->user()->type=="Professor")
            <div class="input-box">
              <input type="text"  name="purview" value="{{auth()->user()->purview}}" autofocus  />
              <label>purview</label>
            </div>
            @endif

            @if(auth()->user()->type=="student")
            <div class="input-box">
              <input type="text"  name="year" value="{{auth()->user()->year}}" autofocus readonly />
              <label>year</label>
            </div>
            @endif
            <div class="input-box">
              <input type="number" name="experience" value="{{auth()->user()->years_experience}}"  autofocus />
              <label>Years Of Experience</label>
            </div>
            <div class="btn">
              <input
                onclick="closePopup3()"
                value="Cancel"
                class="form-btn"
              />
              <input type="submit" value="Update" class="form-btn" />
            </div>
          </div>
        </form>
      </div>
      <!-- End Popup for Job Information -->
      <!-- ----------------------------------------- -->
      <!-- Start Popup for About Me -->
      <div class="conatiner" id="popup4">
        <form action="{{route('update4')}}" autocomplete="off">
          @csrf
          <div class="login-title">
            <h2>Details</h2>
          </div>
          <div class="page-box">
            <div class="input-box">
              <input type="text" required name="about_me" value="{{auth()->user()->about_me}}" />
              <label>About Me</label>
            </div>
            <div class="btn">
              <input
                onclick="closePopup4()"
                value="Cancel"
                class="form-btn"
              />
              <input type="submit" value="Update" class="form-btn" />
            </div>
          </div>
        </form>
      </div>
      <!-- End Popup for About Me -->
      <!-- ----------------------------------------- -->
      <!-- Start Popup for Password -->
      <div class="conatiner" id="popup5">
        <form action="{{route('update6')}}" autocomplete="off">
          @csrf
          <div class="login-title">
            <h2>Change Password</h2>
          </div>
          <div class="page-box">
            @if (session('error'))
                <div class="">
                  {{session('error')}}
                </div>
            @endif
            <div class="input-box">
              <input type="text" name="password_old" required />
              <label>Current Password</label>
            </div>
            <div class="input-box">
              <input type="text" name="password" required/>
              <label>New Password</label>
            </div>
            <div class="input-box">
              <input type="text" name="password_confirmation" required />
              <label>confirm password</label>
            </div>
            @if($errors->has('password_confirmation'))
                <div>
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
            <div class="btn">
              <input

                onclick="closePopup5()"
                value="Cancel"
                class="form-btn"
              />
              <input type="submit" value="Update" class="form-btn" />
            </div>
          </div>
        </form>
      </div>
      <!-- End Popup for password -->
      <!-- ----------------------------------------- -->
      <!-- ----------------------------------------- -->
      <!-- Start Popup for Change Photo -->

      <!-- End Popup for Change Photo -->
      <!-- ----------------------------------------- -->
      <!-- ----------------------------------------- -->
      <!-- End Popup Section -->
    </div>

    <script src="/JAVA/profile.js"></script>

  </body>
</html>
