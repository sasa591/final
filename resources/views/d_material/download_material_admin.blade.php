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
    <link rel="stylesheet" href="/CSS/admin-objections.css" />
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
        <!-- End Head -->
        <!-- Start Objections Table -->
        <div class="objections">
          <div class="main-heading">
            <h2>download material</h2>
          </div>
          <div class="responsive-table">
            <table>
              <thead>
                <tr>
                  <td>Full Name</td>
                  <td>Unibersity ID</td>
                  <td>Sending Date</td>
                  <td>Of the decision</td>
                  <td>Chapter</td>
                  <td>Status</td>
                  <td>Replay</td>
                </tr>
              </thead>
              <tbody>
                @foreach($downloadmaterials as $downloadmaterial)
                @php
                $uu=DB::table('users')->find($downloadmaterial->usr_id)
                @endphp
                <tr>
                  <td> {{$uu->first_name}} {{$uu->last_name}} </td>
                  <td> {{$uu->code}}</td>
                  <td> {{date('Y-m-d',strtotime($downloadmaterial->created_at->addHours(3)))}}</td>
                  <td>{{$downloadmaterial->year_of_the_artical}}</td>
                  <td>{{$downloadmaterial->chapter}}</td>
                  <td>
                    <span class="label">{{$downloadmaterial->status}}</span>
                  </td>
                  <td>
                    <a href="{{route('downloadmaterial_admin_replay',$downloadmaterial->id)}}"><span>Show</span></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Objections Table -->
      </div>
      <!--  End Content-->
    </div>
    <!-- End Container for whole page -->
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
