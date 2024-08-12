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
    <title>Add user</title>
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
            <div class="add" id="add">
                <div class="main-heading">
                    <h2>Add User</h2>
                </div>
                <div class="content">
                <form action="{{route('rstudent.store')}}" method="post" autocomplete="off">
                    @csrf
                    @error('First_Name')
                <div style="font-size:12px; color:red;" class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <input class="main-input" name="First_Name" type="text" required placeholder="First Name" />
                    @error('Last_Name')
                <div style="font-size:12px; color:red;" class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <input class="main-input"  name="Last_Name" type="text" required placeholder="Last Name" />
                    <div class="main-input radi">
                        <div class="one">
                            <input id="male" type="radio" value="Male" name="sub" />
                            <label for="male">Male</label>
                        </div>
                        <div class="two">
                            <input id="fem" type="radio" value="Female" name="sub" />
                            <label for="fem">Female</label>
                        </div>
                    </div>
                    <input class="main-input" type="date" required name="Birth" placeholder="Date Of Birth"/>
                    @error('University_id')
                <div style="font-size:12px; color:red;" class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <input class="main-input" type="number" min="1"  name="University_id" required placeholder="Student ID"/>
                    <select class="main-input" name="year">
                        <option value="First year">First Year</option>
                        <option value="Second year">Second Year</option>
                        <option value="Third year">Third Year</option>
                        <optgroup label="Fourth Year">
                            <option value="Fourth-Software">Fourth Year-Software</option>
                            <option value="Fourth-AI">Fourth Year-AI</option>
                            <option value="Fourth-Networks">Fourth Year-Networks</option>
                        </optgroup>
                        <optgroup label="FiFth Year">
                            <option value="FiFth-Software">FiFth Year-Software</option>
                            <option value="FiFth-AI">FiFth Year-AI</option>
                            <option value="FiFth-Networks">FiFth Year-Networks</option>
                        </optgroup>
                    </select>
                    <input class="main-input" type="number" min="1"name="phone" required placeholder="Phone"/>
                    <input class="main-input" type="text" name="adress" required placeholder="Adress" />

                    <div class="pay">
                        <input type="submit" value="ADD" id="pay" />
                    </div>
                </form>
            </div>
        </div>
        <div class="enough-money" id="money">
            <img src="images/truecross.png" alt="logo" />
            <div class="info">
                <h3>Done</h3>
                <p>A new user has been added to the database</p>
            </div>
            <a href="{{route('mangement')}}" style="color:white"><button id="ok">okay</button></a>
        </div>
        </div>
    </div>
        <!--  End Content-->
    </div>
    <!-- End Container for whole page -->
    <script>
        let b= {!! json_encode($blan) !!};
        let money = document.getElementById("money");
        let obj = document.getElementById("add");
        if(b=='ook')
        {

            money.classList.add("open-popup");
            obj.style.opacity = "0.4";
        }
        let ok = document.getElementById("ok");
        console.log(ok);
        ok.onclick = function () {
        money.classList.remove("open-popup");
        obj.style.opacity = "1";
        };
    </script>
</body>
</html>
