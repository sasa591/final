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
    <link rel="stylesheet" href="/CSS/inbox.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="/CSS/const.css" />
    <title>Vision-Friends</title>
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
            @if(count($groups)!=0 && ( count($ones)!=0 ||  count($two)!=0 ||  count($three)!=0 ||  count($four)!=0 ||  count($five)!=0))

                <div class="inbox">
                    <ul>
                    @foreach($groups as $group)
                    <!-- objection -->
                        @if($group->name=='objection')
                        @if(count($ones)!=0)
                            @foreach($ones as $one)

                            <div class="email">
                            <li>
                                <div class="logo">
                                    <i class="fa-solid fa-tag fa-fw"></i>
                                    <div class="logo-text">
                                        <h2>Objection</h2>
                                        <h4>Requested for <span>{{$one->subject}}</span></h4>
                                    </div>
                                </div>

                                <div class="tools">
                                    <div id="delete_sport_{{$one->id}}" class="iconescom">
                                        <i class="fa-solid fa-trash fa-fw "></i>
                                    </div>

                                    <div class="rep" show_obj='{{$group->id}}' id="ditrep_{{$group->id}}">
                                        <i id="drop-down_{{$group->id}}" class="fa-solid fa-chevron-down fa-fw ccc"> </i>
                                    </div>

                                </div>
                            </li>

                            <div class="show-email" id="show-email_{{$group->id}}">
                            <h2>Send Date : <span>{{\Carbon\Carbon::parse($one->created_at)->format('y m d')}}</span></h2>

                            @if($one->status!='pending')
                            <h2>Recive Date : <span>{{\Carbon\Carbon::parse($one->updated_at)->format('y m d')}}</span></h2>
                            @endif

                            <h2 style="color: white;" class="label">{{$one->status}}</h2>
                            @if($one->status!='pending')

                                        <p>{{$one->replay}}</p>

                            @endif
                            </div>
                            </div>
                            <div>
                            </div>

                            <div class="cont conatinercom" id="delete_confirm_inbox{{ $group->id }}">
                            <form id="delete_emailbox_form_{{ $group->id }}" action="{{route('deleteinboxemail',$one->id)}}" autocomplete="off">
                                <div class="title">
                                    <h2>Are you sure?</h2>
                                </div>

                                <div class="box">
                                    <div class="btn">
                                        <input onclick="closePopupc('delete_confirm_inbox{{ $group->id }}')" type="button" id="Cancel" value="Cancel" class="form-btn"/>
                                        <input type="submit" value="Confirm" class="form-btn" />
                                    </div>
                                </div>
                            </form>
                            </div>
                            @endforeach
                            @endif
                        @endif
                        <!-- endobjection -->

                        <!-- detectingsignd -->
                        @if($group->name=='detecting signs')
                        @if(count($two)!=0)
                            @foreach($two as $twoo)
                            <div class="email">
                            <li>
                                <div class="logo">
                                    <i class="fa-solid fa-tag fa-fw"></i>
                                    <div class="logo-text">
                                        <h2>Detecting signs</h2>
                                    </div>
                                </div>

                                <div class="tools">
                                    <div id="delete_detecting_{{$group->id}}" class="iconescom">
                                        <i class="fa-solid fa-trash fa-fw "></i>
                                    </div>

                                    <div class="rep" show_obj='{{$group->id}}' id="ditrep_{{$group->id}}">
                                        <i id="drop-down_{{$group->id}}" class="fa-solid fa-chevron-down fa-fw ccc"> </i>
                                    </div>

                                </div>
                            </li>

                            <div class="show-email" id="show-email_{{$group->id}}">
                            <h2>Send Date : <span>{{\Carbon\Carbon::parse($twoo->created_at)->format('y m d')}}</span></h2>

                            @if($twoo->status!='pending')
                            <h2>Recive Date : <span>{{\Carbon\Carbon::parse($twoo->updated_at)->format('y m d')}}</span></h2>
                            @endif

                            <h2 style="color: white;" class="label">{{$twoo->status}}</h2>
                            @if($twoo->status!='pending')

                                        <p>{{$twoo->replay}}</p>

                            @endif
                            </div>
                            </div>
                            <div>
                            </div>

                            <div class="cont conatinercom" id="delete_confirm_inbox{{ $group->id }}">
                            <form id="delete_emailbox_form_{{ $group->id }}"   action="{{route('deleteinboxemaildetecting',$twoo->id)}}"  autocomplete="off">
                                <div class="title">
                                    <h2>Are you sure?</h2>
                                </div>

                                <div class="box">
                                    <div class="btn">
                                        <input onclick="closePopupc('delete_confirm_inbox{{ $group->id }}')" type="button" id="Cancel" value="Cancel" class="form-btn"/>
                                        <input type="submit" value="Confirm" class="form-btn" />
                                    </div>
                                </div>
                            </form>
                            </div>
                            @endforeach
                            @endif
                        @endif
                        <!-- enddetecting -->

                        <!-- download material -->
                        @if($group->name=='download material')
                        @if(count($three)!=0)
                            @foreach($three as $threee)

                            <div class="email">
                            <li>
                                <div class="logo">
                                    <i class="fa-solid fa-tag fa-fw"></i>
                                    <div class="logo-text">
                                        <h2>download material</h2>
                                    </div>
                                </div>

                                <div class="tools">
                                    <div id="delete_detecting_{{$group->id}}" class="iconescom">
                                        <i class="fa-solid fa-trash fa-fw "></i>
                                    </div>

                                    <div class="rep" show_obj='{{$group->id}}' id="ditrep_{{$group->id}}">
                                        <i id="drop-down_{{$group->id}}" class="fa-solid fa-chevron-down fa-fw ccc"> </i>
                                    </div>

                                </div>
                            </li>

                            <div class="show-email" id="show-email_{{$group->id}}">
                            <h2>Send Date : <span>{{\Carbon\Carbon::parse($threee->created_at)->format('y m d')}}</span></h2>

                            @if($threee->status!='pending')
                            <h2>Recive Date : <span>{{\Carbon\Carbon::parse($threee->updated_at)->format('y m d')}}</span></h2>
                            @endif

                            <h2 style="color: white;" class="label">{{$threee->status}}</h2>
                            @if($threee->status!='pending')

                                        <p>{{$threee->replay}}</p>

                            @endif
                            </div>
                            </div>
                            <div>
                            </div>

                            <div class="cont conatinercom" id="delete_confirm_inbox{{ $group->id }}">
                            <form id="delete_emailbox_form_{{ $group->id }}"   action="{{route('deleteinboxemailmaterial',$threee->id)}}"  autocomplete="off">
                                <div class="title">
                                    <h2>Are you sure?</h2>
                                </div>

                                <div class="box">
                                    <div class="btn">
                                        <input onclick="closePopupc('delete_confirm_inbox{{ $group->id }}')" type="button" id="Cancel" value="Cancel" class="form-btn"/>
                                        <input type="submit" value="Confirm" class="form-btn" />
                                    </div>
                                </div>
                            </form>
                            </div>
                            @endforeach
                            @endif
                        @endif
                        <!-- enddownload material -->
                            <!-- permenancy documen -->
                            @if($group->name=='permenancy document')
                            @if(count($four)!=0)
                            @foreach($four as $fourr)

                            <div class="email">
                            <li>
                                <div class="logo">
                                    <i class="fa-solid fa-tag fa-fw"></i>
                                    <div class="logo-text">
                                        <h2>permenancy documens</h2>
                                    </div>
                                </div>

                                <div class="tools">
                                    <div id="delete_detecting_{{$group->id}}" class="iconescom">
                                        <i class="fa-solid fa-trash fa-fw "></i>
                                    </div>

                                    <div class="rep" show_obj='{{$group->id}}' id="ditrep_{{$group->id}}">
                                        <i id="drop-down_{{$group->id}}" class="fa-solid fa-chevron-down fa-fw ccc"> </i>
                                    </div>

                                </div>
                            </li>

                            <div class="show-email" id="show-email_{{$group->id}}">
                            <h2>Send Date : <span>{{\Carbon\Carbon::parse($fourr->created_at)->format('y m d')}}</span></h2>

                            @if($fourr->status!='pending')
                            <h2>Recive Date : <span>{{\Carbon\Carbon::parse($fourr->updated_at)->format('y m d')}}</span></h2>
                            @endif

                            <h2 style="color: white;" class="label">{{$fourr->status}}</h2>
                            @if($fourr->status!='pending')

                                        <p>{{$fourr->replay}}</p>

                            @endif
                            </div>
                            </div>
                            <div>
                            </div>

                            <div class="cont conatinercom" id="delete_confirm_inbox{{ $group->id }}">
                            <form id="delete_emailbox_form_{{ $group->id }}"   action="{{route('deleteinboxemailpermenancy',$fourr->id)}}"  autocomplete="off">
                                <div class="title">
                                    <h2>Are you sure?</h2>
                                </div>

                                <div class="box">
                                    <div class="btn">
                                        <input onclick="closePopupc('delete_confirm_inbox{{ $group->id }}')" type="button" id="Cancel" value="Cancel" class="form-btn"/>
                                        <input type="submit" value="Confirm" class="form-btn" />
                                    </div>
                                </div>
                            </form>
                            </div>
                            @endforeach
                            @endif
                        @endif
                        <!-- endpermenancy documen -->
                            <!-- Univercity life -->
                            @if($group->name=='Univercity life')
                            @if(count($five)!=0)
                            @foreach($five as $fivee)

                            <div class="email">
                            <li>
                                <div class="logo">
                                    <i class="fa-solid fa-tag fa-fw"></i>
                                    <div class="logo-text">
                                        <h2>Univercity life</h2>
                                    </div>
                                </div>

                                <div class="tools">
                                    <div id="delete_detecting_{{$group->id}}" class="iconescom">
                                        <i class="fa-solid fa-trash fa-fw "></i>
                                    </div>

                                    <div class="rep" show_obj='{{$group->id}}' id="ditrep_{{$group->id}}">
                                        <i id="drop-down_{{$group->id}}" class="fa-solid fa-chevron-down fa-fw ccc"> </i>
                                    </div>

                                </div>
                            </li>

                            <div class="show-email" id="show-email_{{$group->id}}">
                            <h2>Send Date : <span>{{\Carbon\Carbon::parse($fivee->created_at)->format('y m d')}}</span></h2>

                            @if($fivee->status!='pending')
                            <h2>Recive Date : <span>{{\Carbon\Carbon::parse($fivee->updated_at)->format('y m d')}}</span></h2>
                            @endif

                            <h2 style="color: white;" class="label">{{$fivee->status}}</h2>
                            @if($fivee->status!='pending')

                                <p>{{$fivee->replay}}</p>

                            @endif
                            </div>
                            </div>
                            <div>
                            </div>

                            <div class="cont conatinercom" id="delete_confirm_inbox{{ $group->id }}">
                            <form id="delete_emailbox_form_{{ $group->id }}"   action="{{route('deleteinboxemailunivercity',$fivee->id)}}"  autocomplete="off">
                                <div class="title">
                                    <h2>Are you sure?</h2>
                                </div>

                                <div class="box">
                                    <div class="btn">
                                        <input onclick="closePopupc('delete_confirm_inbox{{ $group->id }}')" type="button" id="Cancel" value="Cancel" class="form-btn"/>
                                        <input type="submit" value="Confirm" class="form-btn" />
                                    </div>
                                </div>
                            </form>
                            </div>
                            @endforeach
                            @endif
                        @endif
                        <!-- endpermenancy documen -->
                    @endforeach
                    </ul>
                </div>

                <div class="filter">
                    <form action="{{route('filtinbox')}}" method="post" autocomplete="off">
                    @csrf
                        <div class="all">
                            <div class="select-doc">
                                <select name="type">
                                    <option value="Objection">Objection</option>
                                    <option value="detecting signs">Detecting signs </option>
                                    <option value="Univercity life">University Life</option>
                                    <option value="download material">Download material</option>
                                    <option value="permenancy document">Permenancy document</option>
                                </select>
                            </div>

                            <div class="statu">
                                <div class="container selected container-1">
                                    <input id="completed" type="radio" value="Completed" name="statu" required/>
                                    <label for="completed">completed</label>
                                </div>

                                <div class="container selected container-2">
                                    <input id="Pending" type="radio" value="pending" name="statu" />
                                    <label for="Pending">Pending</label>
                                </div>

                                <div class="container selected container-3">
                                    <input id="Rejested" type="radio" value="Rejected" name="statu"/>
                                    <label for="Rejested">Rejected</label>
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Filter" />
                    </form>
                </div>




            @endif



        </div>
        <!-- End Inbox -->
      @if(count($groups)==0 || (count($ones)==0 && count($two)==0 && count($three)==0 && count($four)==0 && count($five)==0) )
      <div class="no-email">
            <img src="/images/user-not-found.png" alt="" />
            <div class="user-text">
                <p>There is no Emails</p>
            </div>
        </div>
        @endif
    </div>




    <script src="/JAVA/inbox.js"></script>
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
                popup.classList.remove("open-popup");;
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

    <!-- detecting signd -->

  </body>
</html>
