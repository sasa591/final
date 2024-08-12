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
    rel="stylesheet"/>

    <!-- CSS Master File -->
    <link rel="stylesheet" href="CSS/services-admin.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="CSS/const.css" />
    <title>Services</title>
  </head>
<body>

<div class="page">
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



            <div class="services" id="HC">
                <!-- هون ببلش الاب اللي بيحتوي على الخدمات  -->
                <div class="servics-content">
                    @foreach($services as $service)

                        <div class="one-service">
                        @if($service->name_service=='Objection')
                        @php
                        $count=DB::table('objections')->where('status','pending')->count();
                        @endphp

                        <div class="number-of">
                            {{$count}}
                        </div>

                        @endif

                        @if($service->name_service=='Univercity life')
                        @php
                        $count=DB::table('documents')->where('status','pending')->count();
                        @endphp
                        <div class="number-of">
                            {{$count}}
                        </div>
                        @endif

                        @if($service->name_service=='Detecting signs')
                        @php
                        $count=DB::table('detectingsigns')->where('status','pending')->count();
                        @endphp
                        <div class="number-of">
                            {{$count}}
                        </div>
                        @endif

                        @if($service->name_service=='Permanency document')
                        @php
                        $count=DB::table('permenancydocuments')->where('status','pending')->count();
                        @endphp
                        <div class="number-of">
                            {{$count}}
                        </div>
                        @endif

                        @if($service->name_service=='Download materials')
                        @php
                        $count=DB::table('downloadmaterials')->where('status','pending')->count();
                        @endphp
                        <div class="number-of">
                            {{$count}}
                        </div>
                        @endif

                        <a href="{{route('object_admin',$service->id)}}">
                        <div class="icon">
                            <img src="Images/file.png" alt="logo" />
                        </div>
                        </a>
                        <div class="services-name">
                            {{$service->name_service}}
                        </div>

                        <div class="info">
                            <span class="pric">{{$service->price}} S.Y.P</span>
                            <div  class="editservice" id="service_edit_{{$service->id}}">
                                <span class="editprice">Edit Price</span>
                            </div>

                        </div>
                        </div>


                    <!-- هون فورم تعديل السعر -->
                    <div class="price " id="editpriceservice{{$service->id}}" >
                        <i id="close-price{{$service->id}}" onclick="closePopupr('editpriceservice{{$service->id}}')"  class="fa-solid fa-xmark fa-fw"></i>
                        <form  id="editpriceservice{{$service->id}}"  action="{{route('updateprice',['id'=>$service->id])}}" method="post" >
                            @csrf
                            <input type="number" name="price" min="1" placeholder="document's price" required/>
                            <input type="submit" value="Confirm" />
                        </form>
                    </div>
                    <!-- نهاية فورم تعديل السعر -->
                    @endforeach
                </div>
                <!-- هون انتهت الخدمات -->
            </div>


        </div>
        <!-- end content -->
</div>
    <!-- End Container for whole page -->
    <script>
        function openPopup2(popupId) {
        closeAllPopups(); // إغلاق جميع ال popups
        document.getElementById(popupId).classList.add("open-popup");
    }

    function closePopupr(popupId) {
        document.getElementById(popupId).classList.remove("open-popup");
    }

    function closeAllPopups() {
        var popups = document.querySelectorAll('.price');
        popups.forEach(function(popup) {
            popup.classList.remove("open-popup");
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.editservice');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var adId = button.id.split('_')[2]; // استخراج معرف الإعلان من معرف الزر
                var popupId = 'editpriceservice' + adId; // بناء معرف نافذة التأكيد
                openPopup2(popupId); // فتح نافذة التأكيد
            });
        });
    });
    </script>

</body>
</html>
