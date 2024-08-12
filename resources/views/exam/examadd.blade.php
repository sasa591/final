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
    <!-- <link rel="stylesheet" href="CSS/quizzes.css" /> -->


        <!-- New Css File -->
        <link rel="stylesheet" href="/CSS/addQuizze.css">


    <!-- CSS Const File -->
    <link rel="stylesheet" href="/CSS/const.css" />
    <title>Vision-Quizzes</title>



    <!-- <link rel="stylesheet" href="/CSS/app.css"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
            <h2>Add Quizze</h2>

          </div>
          <div class="quizzes">
            <form id="quizForm" dir="rtl" autocomplete = "off">
                @if($id=='1')
                <input type="text" name="year" value="1" hidden>
                <select class="main-input" name="name">
                    <optgroup>
                        <option class="op" value="برمجة 1">برمجة 1</option>
                        <option value="برمجة 2">برمجة 2</option>
                        <option value="جبر لاخطي">جبر لاخطي</option>
                        <option value="تحليل رياضي 1">تحليل رياضي 1</option>
                        <option value="فيزياء كهربائية">فيزياء كهربائية</option>
                        <option value="مبادئ حاسوب">مبادئ حاسوب</option>
                        <option value="لغة عربية">لغة عربية</option>
                        <option value="انكليزي 1">انكليزي 1</option>
                        <option value="تحليل رياضي 2">تحليل رياضي 2</option>
                        <option value="أنصاف نواقل">أنصاف نواقل</option>
                        <option value="ثقافة">ثقافة</option>
                        <option value="انكليزي 2">انكليزي 2</option>
                        <option value="جبر خطي">جبر خطي</option>
                    </optgroup>
                </select>
                @endif

                @if($id=='2')
                <input type="text" name="year" value="2" hidden>
                <select class="main-input" name="name">
                    <optgroup>
                        <option class="op" value=" برمجة متقدمة 1 "> برمجة متقدمة 1 </option>
                        <option value="رياضيات متقطعة">رياضيات متقطعة</option>
                        <option value="احصاء واحتمالات">احصاء واحتمالات</option>
                        <option value="دارات كهربائية">دارات كهربائية</option>
                        <option value="تحليل 3">تحليل 3</option>
                        <option value=" انكليزية معلوماتية 2"> انكليزية معلوماتية 2</option>
                        <option value="برمجة متقدمة 2">برمجة متقدمة 2</option>
                        <option value="قواعد معطيات 1">قواعد معطيات 1</option>
                        <option value="بحوث عمليات">بحوث عمليات</option>
                        <option value="تحليل عددي">تحليل عددي</option>
                        <option value="اشارات ونظم">اشارات ونظم</option>
                        <option value="انكليزي معلوماتية 2">انكليزي معلوماتية 2</option>
                    </optgroup>
                </select>
                @endif

                @if($id=='3')
                <input type="text" name="year" value="3" hidden>
                <select class="main-input" name="name">
                    <optgroup>
                        <option class="op" value="خوارزميات وبنى المعطيات">خوارزميات وبنى المعطيات</option>
                        <option  value="نظرية الحوسبة">نظرية الحوسبة</option>
                        <option  value="نظم تشغيل 1">نظم تشغيل 1</option>
                        <option  value="اتصالات رقمية">اتصالات رقمية</option>
                        <option  value="دارات منطقية">دارات منطقية</option>
                        <option  value="مهارات وتواصل">مهارات وتواصل</option>
                        <option  value="نظرية التعقيد">نظرية التعقيد</option>
                        <option  value="هندسة برمجيات 1 ">هندسة برمجيات 1 </option>
                        <option  value="بنيان حواسيب 1">بنيان حواسيب 1</option>
                        <option  value="مبادئ الذكاء">مبادئ الذكاء</option>
                        <option  value=" شبكات حاسوب 1"> شبكات حاسوب 1</option>
                        <option  value="نظرية المعلومات">نظرية المعلومات</option>
                    </optgroup>
                </select>
                @endif



                @if($id=='4')
                <input type="text" name="year" value="4" hidden>
                <select class="main-input" name="name">
                    <optgroup>
                        <option class="op" value="هندسة برمجيات 2">هندسة برمجيات 2</option>
                        <option  value="قواعد معطيات 2">قواعد معطيات 2</option>
                        <option  value="شبكات حاسوبية 2">شبكات حاسوبية 2</option>
                        <option  value="نظم تشغيل 2 ">نظم تشغيل 2 </option>
                        <option  value="لغات برمجة">لغات برمجة</option>
                        <option  value="شبكات عصبونية">شبكات عصبونية</option>
                        <option  value="خوارزميات بحث ذكية">خوارزميات بحث ذكية</option>
                        <option  value="نظم موزعة">نظم موزعة</option>
                        <option  value=" تصميم تجارب"> تصميم تجارب</option>
                        <option  value="نمذجة ومحاكاة ">نمذجة ومحاكاة </option>
                        <option  value="بناء مترجمات">بناء مترجمات</option>
                        <option  value="تحليل نظم مالية">تحليل نظم مالية</option>
                        <option  value="نمذجة و محاكاة">نمذجة و محاكاة</option>
                        <option  value="بروتوكلات شبكية">بروتوكلات شبكية</option>
                        <option  value="بنيان حواسيب">بنيان حواسيب</option>
                        <option  value="تعلم الالة">تعلم الالة</option>
                        <option  value="رؤية حاسوبية">رؤية حاسوبية</option>
                        <option  value="نظم قاعد معرفة">نظم قاعد معرفة</option>


                    </optgroup>
                </select>
                @endif



                @if($id=='5')
                <input type="text" name="year" value="5" hidden>
                <select class="main-input" name="name">
                    <optgroup>
                        <option class="op" value="أمن المعلومات">أمن المعلومات</option>
                        <option  value=" تعليم ألكتروني"> تعليم ألكتروني</option>
                        <option  value="تطبيقات إنترنت">تطبيقات إنترنت</option>
                        <option  value="خوارزميات بحث ذكية">خوارزميات بحث ذكية</option>
                        <option  value="قواعد معطيات 3">قواعد معطيات 3</option>
                        <option  value="نظم زمن حقيقي">نظم زمن حقيقي</option>
                        <option  value="نظم رقمية مبرمجة">نظم رقمية مبرمجة</option>
                        <option  value="الروبوتية">الروبوتية</option>
                        <option  value="المنطق الترجيحي">المنطق الترجيحي</option>
                        <option  value="الحقائق الافتراضية">الحقائق الافتراضية</option>
                        <option  value="إدارة المشاريع">إدارة المشاريع</option>
                        <option  value=" تسويق وجودة"> تسويق وجودة</option>
                        <option  value="هندسة برمجيات 3">هندسة برمجيات 3</option>
                        <option  value="هندسة نظم معلومات">هندسة نظم معلومات</option>
                        <option  value="تطبيقات شبكية">تطبيقات شبكية</option>
                        <option  value="إدارة شبكات">إدارة شبكات</option>
                        <option  value="استكشاف المعرفة">استكشاف المعرفة</option>
                        <option  value="معالجات اللغات الطبيعية">  معالجات اللغات الطبيعية</option>
                        <option  value="التعلم التلقائي">التعلم التلقائي</option>
                        <option  value=""></option>
                    </optgroup>
                </select>
                @endif

                <input class="main-input" type="text" name="title" placeholder="عنوان الاختبار" required>
                <div id="questionsContainer">
                    <!-- الأسئلة ستضاف هنا -->
                </div>
                <div class="footInput">
                    <button class="btnn" type="button" id="addQuestionButton">إضافة سؤال</button>
                    <button class="btnn" type="submit">حفظ الاختبار</button>
                </div>
            </form>
          </div>
        </div>
        <!-- End Home-contnet -->
      </div>
    </div>
    <script src="/JAVA/java.js"></script>
    <script src="/JAVA/lectures.js"></script>
</body>
</html>
