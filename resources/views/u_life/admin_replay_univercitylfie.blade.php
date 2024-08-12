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
    <link rel="stylesheet" href="/CSS/admin-replay-objections.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="/CSS/const.css" />
    <title>Objections</title>
  </head>
  <body>
    <!-- Start Container for whole page -->
    <div class="page">
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
              <a class="firstA active" href="{{route('inbox')}}">
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
      <!--  Start Content-->
      <div class="content">
        <!-- Start Head -->
        <div class="head">
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
        <!-- Start Objections Table -->

        <div class="replay-objection">
          <div class="main-heading">
            <h2>Univercity life Handling</h2>
          </div>
          <div class="content">
            <form action="{{route('store_replay_univercity',$ob->id)}}" method="post" autocomplete="off" id="objform">
            @csrf
            @if($ob->status=='pending')
              <textarea
              name="replay"
                required
                class="main-input"
                placeholder="write your replay"
              ></textarea>
              @endif

              @if($ob->status=='Completed' || $ob->status=='Rejected')
                     <div class="my-replay">
            <h2>Send Date : <span>25/4/2024</span></h2>

            <h2 class="label">{{$ob->status}}</h2>
            <p>{{$ob->replay}}</p>
          </div>
          @endif

              <div class="pay">
                <label>
                  <input class="toggle-checkbox" type="checkbox" id="btn" />
                  <div class="toggle-switch"></div>
                </label>
                @if($ob->status=='pending')
                <div class="radi">
                  <div class="one">
                    <input id="com" required type="radio" value="Completed" name="sub"/>
                    <label for="com">Completed</label>
                  </div>
                  <div class="two">
                    <input id="rej" type="radio" value="Rejected" name="sub" />
                    <label for="rej">Rejected</label>
                  </div>
                </div>
                <input class="main-input" type="submit" value="Answer" />
                @endif
              </div>
            </form>
          </div>
            @php
                $uu=DB::table('users')->find($ob->usr_id)
            @endphp

          <div class="file" id="file">
            <div class="file-head">
              <img src="/images/tishreen-university.png" alt="logo" />
              <div class="info">
                <h3>جامعة تشرين</h3>
                <h3>كلية الهندسة المعلوماتية</h3>
                @if($uu->year =='First year')
                <h3>السنة :<span>الأولى</span></h3>
                @endif
                @if($uu->year =='Second year')
                <h3>السنة :<span>الثانية</span></h3>
                @endif
                @if($uu->year =='Third year')
                <h3>السنة :<span>الثالثة</span></h3>
                @endif
                @if($uu->year =='Fourth-Software' || $uu->year =='FoFourth-AI' ||$uu->year =='Fourth-Networks' )
                <h3>السنة :<span>الرابعة</span></h3>
                @endif
                @if($uu->year =='FiFth-Software' || $uu->year =='FiFth-AI' ||$uu->year =='FiFth-Networks' )
                <h3>السنة :<span>الخامسة</span></h3>
                @endif

                @if($uu->year =='Fourth-Software' || $uu->year =='FiFth-Software')
                <h3>الاختصاص : <span>برمجيات</span></h3>
                @endif

                @if($uu->year =='Fourth-AI' || $uu->year =='FiFth-AI')
                <h3>الاختصاص : <span>ذكاء صنعي</span></h3>
                @endif
                @if($uu->year =='Fourth-Networks' ||$uu->year =='FiFth-Networks')
                <h3>الاختصاص : <span>شبكات</span></h3>
                @endif
                <h3>الرقم الجامعي : <span>{{$uu->code}}</span></h3>
                <h3>التاريخ : <span>{{date('Y-m-d',strtotime($ob->created_at->addHours(3)))}}</span></h3>
              </div>
            </div>
            <h3>وثيقة حياة جامعية</h3>
            <div class="text">
                <p>
               <bdi>{{$uu->first_name}} {{$uu->last_name}}</bdi> انا الطالب

                <br/>
              .أرجو التفضل بالموافقة على منحي وثيقة حياة جامعية كاملة الأركان وموثقة أصولا .
             <br>
             علما أنني ({{$ob->student_type}})
              </p>


            </div>
            <div class="image">
                <img src="{{asset('profil/'.$ob->image_hweya)}}" alt="" />
                <img src="{{asset('profil/'.$ob->image_blood)}}" alt="" />
            </div>


          </div>

        </div>
        <!-- End Objections Table -->
      </div>
      <!--  End Content-->
    </div>
    <!-- End Container for whole page -->
    <script src="/JAVA/admin-objection.js"></script>
    <script>
    let label = document.getElementsByClassName("label");
    for (let i = 0; i < label.length; i++) {
        if(label[i].innerHTML === "pending"){
            label[i].style.backgroundColor = "orange";
        }
        else if(label[i].innerHTML === "Completed"){
            label[i].style.backgroundColor = "green";
        }
        else{
            label[i].style.backgroundColor = "red";
        }
    }

</script>
  </body>
</html>
