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
    <link rel="stylesheet" href="/CSS/objection.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="/CSS/const.css" />
    <title>Vision-Services-university_life.</title>
  </head>
  <body onclick="handleClick3(event)">
    <!-- Start Container for whole page -->
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
                <a class="firstA active" href="{{route('services')}}">
                    <i class="fa-solid fa-file-pen fa-fw"></i>
                    <span>Services</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->type=="admin")
            <li>
                <a class="firstA active" href="{{route('servicesadmin')}}">
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
        <!--  Start Content-->
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
        <!-- Start All Home content -->
        <div class="Home-content">
            <div class="objection" id="objection">
                <div class="container">
                    <div class="main-heading">
                        <h2>كشف علامات</h2>
                    </div>
                <div class="content">
                    <form id="objform" enctype="multipart/form-data" action="{{route('detectingstor')}}" method="post" autocomplete="off">
                        @csrf
                    @if($errors->has('First_Name') || $errors->has('University_id') || $errors->has('Last_Name')|| $errors->has('year') )
                        <div style="    color: red;
    text-align: center;
    margin-bottom: 13px;
    font-size: 20px;
    text-transform: uppercase;">
                            account not found
                        </div>
                    @endif
                    <input class="main-input" type="text" name="First_Name" required placeholder="First Name"/>

                    <input class="main-input" type="text" name="Last_Name" required placeholder="Last Name" />

                    <input class="main-input" type="number" name="University_id" min="1" required placeholder="Student ID" />

                    <select class="main-input" name="year">
                        <option value="First year">First Year</option>
                        <option value="Second year">Second Year</option>
                        <option value="Third year">Third Year</option>
                        <optgroup label="Fourth Year">
                            <option value="Fourth Year-Software">
                                Fourth Year-Software
                            </option>
                            <option value="Fourth Year-AI">Fourth Year-AI</option>
                            <option value="Fourth Year-Networks">
                                Fourth Year-Networks
                            </option>
                        </optgroup>
                        <optgroup label="FiFth Year">
                            <option value="FiFth Year-Software">
                                FiFth Year-Software
                            </option>
                            <option value="FiFth Year-AI">FiFth Year-AI</option>
                            <option value="FiFth Year-Networks">
                                FiFth Year-Networks
                            </option>
                        </optgroup>
                    </select>
                    <div class="main-input radi">
                        <div class="one">
                            <input id="TH" type="radio" value="مستنفذ" required name="sub" />
                            <label for="TH">مستنفذ</label>
                        </div>
                        <div class="two">
                            <input id="PAR" type="radio" value="راسب" name="sub" />
                            <label for="PAR">راسب</label>
                        </div>

                        <div class="two">
                            <input id="mm" type="radio" value="مستجد" name="sub" />
                            <label for="mm">مستجد</label>
                        </div>
                    </div>

                    <input id="picture1" class="main-input" name="image_clearance" type="file" required />
                    <label for="picture1" class="main-input">
                        صورة براءة ذمة مصدقة أصولا  <i class="fa-solid fa-image fa-lg"></i>
                    </label>

                    <input id="picture2" class="main-input" name="photo" type="file" required />
                    <label for="picture2" class="main-input">
                        صورة الهوية<i class="fa-solid fa-image fa-lg"></i>
                    </label>




                    <div class="pay">
                        <input  class="main-input" type="text" placeholder="{{$servic->price}} S.Y.P" readonly/>
                        <input class="main-input" type="button" value="Payement" id="pay"/>
                    </div>

                    <div class="confirm-payemnt" id="confirm">
                        <div class="confirm-text">
                            <h3>
                                You Will Spend <span>{{$servic->price}} S.Y.P</span> For This document!!
                            </h3>
                            <p>Are You Sure?</p>
                        </div>

                        <div class="confirm-btn">
                            <input type="button" value="Cancel" id="cls" />
                            <input type="submit" value="Confirm" />
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <div class="enough-money" id="money">
            <img src="/Images/xcross.png" alt="logo" />
            <div class="info">
            <h3>You do not have enough credit</h3>
            <p>Please top up your balance to make payemnts</p>
            </div>
            <a href="{{route('object',$servic->id)}}" style="color:white"><button id="ok">Okay</button></a>
        </div>

        <div class="okob" id="okayobject">
            <img src="/Images/truecross.png" alt="logo" />
            <div class="info">
            <h3>تم تقديم وثيقة كشف العلامات بنجاح</h3>
            <p>سوف نقوم بإرسال الرد عندما يتم معالجة طلبك،شكرا</p>
            </div>
            <a href="{{route('object',$servic->id)}}" style="color:white"><button id="oky">Okay</button></a>
        </div>
        </div>
        <!-- End All Home content -->
      </div>
      <!--  End Content-->
    </div>
    <!-- End Container for whole page -->

    <script src="/JAVA/univercity.js"></script>
    <script>
        let t= {!! json_encode($mon) !!};
        let money = document.getElementById("money");
        let obj = document.getElementById("objection");
        if(t=='bbb')
        {
            console.log('dsokmds');
            money.classList.add("open-popup");
            obj.style.opacity = "0.4";
        }
        let okk = document.getElementById("ok");
        okk.onclick = function () {
        money.classList.remove("open-popup");
        obj.style.opacity = "1";
        };
    </script>
    <script>
        let g= {!! json_encode($mon) !!};
        let moneyy = document.getElementById("okayobject");
        let objj = document.getElementById("objection");
        if(g=='ooo')
        {
            console.log('dsokmds');
            moneyy.classList.add("open-popup");
            objj.style.opacity = "0.4";
        }
        let okkk = document.getElementById("oky");
        okkk.onclick = function () {
        moneyy.classList.remove("open-popup");
        objj.style.opacity = "1";
        };
    </script>
</body>
</html>
