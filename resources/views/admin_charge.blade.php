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
    <link rel="stylesheet" href="CSS/admin-add-user.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="CSS/const.css" />
    <title>Charge</title>
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
                        <a class="firstA " href="{{route('home')}}"> <i class="fa-solid fa-house fa-fw"></i> <span>Home</span> </a>
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
              <a class="firstA active" href="{{route('mangement')}}">
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



        <div class="Home-content">
            <div class="add" id="charge">
                <div class="main-heading">
                    <h2>Charge User balance</h2>
                </div>

                <div class="content">
                    <form action="{{route('updateblane')}}" method="post" autocomplete="off">
                        @csrf
                    @if($errors->has('First_Name') || $errors->has('University_id') || $errors->has('Last_Name') )
                    <div class="eror">
                        account not found
                    </div>
                    @endif
                <div  class="eror">
                    {{$e}}
                </div>
                        <input class="main-input" name="First_Name" type="text" required placeholder="First Name"/>

                        <input class="main-input" name="Last_Name" type="text" required placeholder="Last Name"/>

                        <input class="main-input" name="University_id" type="number" min="1" required placeholder="Student ID" />
                        <input class="main-input" name="mony"type="number" min="1" required placeholder="Enter the amount" />
                        @if($errors->has('monyconfirm'))
                        <div style="color:red;">
                            {{ $errors->first('monyconfirm') }}
                        </div>
                        @endif
                        <input class="main-input" name="monyconfirm"type="number" min="1" required placeholder="Confirm the amount" />
                        <div class="pay">
                            <input type="submit" value="Transfer" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="enough-money" id="money">
                <img src="images/truecross.png" alt="logo" />
                <div class="info">
                    <h3>Done</h3>
                    <p>The balance has been charged to the user</p>
                </div>
                <a href="{{route('mangement')}}" style="color:white"><button id="ok">okay</button></a>
            </div>



        </div>
    </div>

</div>

<script>
        let b= {!! json_encode($blan) !!};
        let money = document.getElementById("money");
        let obj = document.getElementById("charge");
        if(b=='ook')
        {

            money.classList.add("open-popup");
            obj.style.opacity = "0.4";
        }
        let ok = document.getElementById("ok");
        ok.onclick = function () {
        money.classList.remove("open-popup");
        obj.style.opacity = "1";
};
</script>
</body>
</html>
