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
    <link rel="stylesheet" href="CSS/post.css" />
    <!-- CSS Const File -->
    <link rel="stylesheet" href="CSS/const.css" />
    <title>Vision-Home</title>

</head>
<body onclick="handleClick3(event)">
    <!-- Start Container for whole page -->
    <div div class="page" >
        <!-- Start Popup Section -->
        <!-- Start First Popup -->

        <!-- Start First Popup -->
        <!-- Start Seconde Popup -->

        <!-- End Second Popup -->
        <!-- End Popup Section -->
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

            <!-- Start All Home content -->
            <div class="Home-content">
                <!-- Start Posts -->
                <div class="Posts">
                    <!-- Strat Create Post -->
                    @if(auth()->user()->type=='Professor' ||auth()->user()->type=='admin')
                    <div class="create-post">

                        <div class="post">
                            <div class="cont">
                                <div class="create-top">
                                    <h2>Create Post</h2>
                                </div>

                                <form autocomplete="off" method="POST" action="{{ route('post') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="info-top">
                                        @if(auth()->user()->img!="")
                                        <img class="avatar" src="{{asset('profil/'.auth()->user()->img)}}" alt=""/>
                                        @elseif(true)
                                        <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
                                        @endif
                                        <div class="text">
                                            @if(auth()->user()->type=='admin')
                                            <h2>Admin</h2>
                                            @endif

                                            @if(auth()->user()->type=='Professor')
                                            <h2>{{Auth::user()->first_name}}</h2>
                                            @endif

                                            <div class="option">
                                                <select class="select-box" name="filter">
                                                    <option value="General Annoucement" > General Annoucement</option>
                                                    <option value="First year">First Year</option>
                                                    <option value="Second year">Second Year</option>
                                                    <option value="Third Year">Third Year</option>
                                                    <optgroup label="Fourth Year">
                                                        <option value="Fourth Year-Software"> Fourth Year-Software </option>
                                                        <option value="Fourth Year-AI">Fourth Year-AI</option>
                                                        <option value="Fourth Year-Networks"> Fourth Year-Networks </option>
                                                    </optgroup>

                                                    <optgroup label="FiFth Year">
                                                        <option value="FiFth Year-Software"> FiFth Year-Software </option>
                                                        <option value="FiFth Year-AI">FiFth Year-AI</option>
                                                        <option value="FiFth Year-Networks"> FiFth Year-Networks </option>
                                                    </optgroup>

                                                </select>

                                                <div class="drop">
                                                    <i class="fa-solid fa-caret-down"></i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="create-post-content">

                                        <textarea name="content" placeholder="What's on your mind?" spellcheck="false" id="textareaInput" oninput="toggleRequired('textareaInput', 'fileInput')" required></textarea>
                                        <div class="post-photo" id="in">

                                        </div>
                                        <div class="buttons">
                                            <input type="submit" value="Post" id="post-somthing" />
                                            <input id="fileInput" type="file"  name="photo"  accept="image/*" required oninput="toggleRequired('fileInput', 'textareaInput')" onchange="displayImage(event)"  />
                                            <label for="fileInput">
                                                <img src="Images/gallery.png" alt="logo"/>
                                            </label>

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- End Create Post -->
                    <!-- Start Filter Posts -->
                    <div class="post">
                        <div class="filter-top">
                            <div class="one">
                                <label for="fil">Filter By </label>
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <form autocomplete="off" method="POST" action="{{ route('filtr') }}">
                                @csrf
                                    <input id="fil" list="filters" name="fltr" value="{{session('fltr')}}" class="data" />
                                    <datalist id="filters">
                                        <option value="Posts By Me"></option>
                                        <option value="General Annoucement"></option>
                                        <option value="First Year"></option>
                                        <option value="Second Year"></option>
                                        <option value="Third Year"></option>
                                        <option value="Fourth Year-Software"></option>
                                        <option value="Fourth Year-AI"></option>
                                        <option value="Fourth Year-Networks"></option>
                                        <option value="FiFth Year-Software"></option>
                                        <option value="FiFth Year-AI"></option>
                                        <option value="FiFth Year-Networks"></option>
                                    </datalist>
                                </form>
                            </div>

                            <span>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                            </span>

                        </div>

                        @if(count($posts)==0)
                        <div class="no-post-found">
                            There are no posts
                        </div>
                        @endif
                    </div>
                    <!-- End Filter Posts -->

                    @foreach($posts as $post)
                        @php
                        $uu=DB::table('users')->find($post->u_id)
                        @endphp
                        <div class="post" id='lll_{{$post->id}}'>
                        <!-- Start One Post -->

                        <div class="top">
                        @if($uu->img!="")
                            <img class="avatar" src="{{asset('profil/'.$uu->img)}}" alt="Logo" />
                        @elseif(true)
                            <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
                        @endif


                            <div class="text">
                                <h3>{{$uu->first_name}} {{$uu->last_name}}</h3>
                            </div>

                            <div class="date">
                                <p>
                                <i class="fa-solid fa-clock"></i>
                                </p>
                                @php
                                    $currentData =Carbon\Carbon::now();
                                    $time_post = $post->created_at;
                                    $timecreatepost = Carbon\Carbon::parse($time_post);
                                    $diff = $currentData->diffInDays($timecreatepost);
                                @endphp

                                @if($diff < 1)
                                <p> Today   {{date('H:i',strtotime($post->created_at->addHours(3)))}}</p>

                                @endif

                                @if($diff >= 1 && $diff < 2 )
                                    <p> Yesterday   {{date('H:i',strtotime($post->created_at->addHours(3)))}}</p>
                                @endif

                                @if($diff >= 2 )
                                    <p>{{date('d F - H:i',strtotime($post->created_at->addHours(3)))}}</p>
                                @endif

                            </div>

                            <div class="post-type">
                                <p>{{$post->filter}}</p>
                            </div>

                            @if(Auth::user()->id==$post->u_id)
                                <div class="conatiner" id="delete_confirm_popup_{{ $post->id }}" >
                                    <form id="delete_confirm_form_{{ $post->id }}" action="{{route('post_destroy',['id'=>$post->id])}}" method="post" >
                                    @csrf
                                        <div class="login-title">
                                            <h2>Are you sure?</h2>
                                        </div>

                                        <div class="page-box">
                                            <div class="btn">

                                                <input  onclick="closePopup('delete_confirm_popup_{{ $post->id }}')"  value="Cancel"  class="form-btn"/>
                                                <input type="submit" value="Confirm" class="form-btn" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div id="delete_post_{{$post->id}}" title="Delet_post"  class="icones" >
                                    <i class="fa-solid fa-xmark fa-fw"></i>
                                </div>

                            @endif

                        </div>

                            <div class="post-content">
                                <form  action="{{route('postupdate',$post->id)}}" method="post" enctype="multipart/form-data" autocomplete="off" id="textareaeditpost">
                                @csrf
                                <!-- هون محطوط النص تبع البوست و اذا عدلنا رح يعدل هون -->
                                    <textarea type="text" readonly id="post-text_{{$post->id}}" class="post-text"  name="content">{{$post->content}}</textarea>

                                    <div id="contentA_{{$post->id}}" class="post-text-btn">

                                        <!--  وهوي رح يكون حقل لادخال الصورة كرمال التعديل submit  هون الزر الصورة اللي رح يطلع جنب ال زر ال  -->
                                        <input id="fileInput2_{{$post->id}}" type="file" accept="image/*"  name="photo" oninput="toggleRequired('fileInput', 'textareaInput')"/>

                                        <label for="fileInput2_{{$post->id}}">
                                            <img id="edit-img" src="Images/gallery.png" alt="logo"/>
                                        </label>
                                        <!--submit هون زر التعديل يعني ال-->
                                        <input type="submit" value="Edit" id="edit-btn" />

                                    </div>

                                </form>

                                <!-- هون رح حط الصورة في حال كان في صورة في البوست وقت تم انشاءه -->

                                <div class="post-image" id="content_imag_{{$post->id}}">
                                    <!-- حط الصورة هون -->
                                    @if($post->file !="")
                                    <img src="{{asset('profil/'.$post->file)}}" alt="Logo" />
                                    @endif
                                </div>


                                <!--   وزر الصورة  submit  هون ايقونة التعديل اللي بس انقر عليها رح يطلع عندي زر ال  -->
                                @if(Auth::user()->id==$post->u_id)
                                <div id="Edit-post-icon_{{$post->id }}"  data-post-id="{{ $post->id }}"  class="edit" title="Edit post">
                                    <i id="iconA" class="fa-solid fa-pen-to-square fa-fw"></i>
                                </div>
                                @endif

                            </div>

                            <!-- هون وقت اللي بدو يدخل صورة كرمال التعديل تطلع متل وقت انشأ بوست  -->
                            <div class="post-photo" id="mm_{{$post->id}}"  photo-post-id="{{ $post->id }}">

                            </div>



                            <!-- Start Write Comment -->
                            <div class="write-comment">
                            @if(auth()->user()->img!="")
                                <img class="avatar" src="{{asset('profil/'.auth()->user()->img)}}" alt="Logo" />
                            @elseif(true)
                                <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
                            @endif

                                <div class="write-comment-text">
                                    <h4>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
                                    <form autocomplete="off" method="POST" action="{{ route('comment',$post->id)}}">
                                    @csrf
                                        <textarea required name="content_comment" placeholder="Add a question"></textarea>
                                        <div class="comment-button">
                                            <input type="submit" value="Question" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Write Comment -->






                            <!-- Start Comment -->
                            <!-- هون بينحط التعليقات الموجودة ضمن جدول التعليقات -->

                            <div class="comment">
                                <ul class="com">
                                @foreach($comments as $comment)
                                @php
                                $userc=DB::table('users')->find($comment->u_id)
                            @endphp
                            @if($post->id==$comment->p_id)
                                <li class="one-comment">
                                @if(auth()->user()->img!="")
                                <img class="comment-image" src="{{asset('profil/'.$userc->img)}}" alt="Logo"/>
                @elseif(true)
                    <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
                @endif

                                    <div class="comment-text">
                                        <h4 id="asd">
                                        {{$userc->first_name}} {{$userc->last_name}}
                                        @if($comment->u_id == Auth::user()->id)

                                        <div class="edd" editcomment-post-id='{{$comment->id}}' id="editcom_{{$comment->id}}">
                                            <i style="margin-right: 1px;" id="editCommentIcon_{{$comment->id}}" class="fa-solid fa-pen fa-xs" title="Edit Comment"></i>
                                        </div>

                                        <div id="delete_com_{{$comment->id}}" title="Delet_post"  class="iconescom" >
                                            <i class="fa-solid fa-trash-can fa-xs" title="Delete Comment"></i>
                                        </div>
                                        @endif
                                        </h4>

                                        <!-- هاد منشان الحذف  -->
                                        <div class="conatiner conatinercom" id="delete_confirm_popup_com{{ $comment->id }}">
                                            <form id="delete_confirm_form_com{{ $comment->id }}" action="{{route('comment_destroy',$comment->id)}}" method="post" >
                                                @csrf
                                                <div class="login-title">
                                                    <h2>Are you sure?</h2>
                                                </div>

                                                <div class="page-box">
                                                    <div class="btn">
                                                        <input onclick="closePopupc('delete_confirm_popup_com{{ $comment->id }}')" value="Cancel" class="form-btn"/>
                                                        <input type="submit" value="Confirm" class="form-btn" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--هون التعديل -->
                                        <div class="textarea-comment" id="commentTextArea">
                                        <form  action="{{route('commentupdate',$comment->id)}}" method="post" autocomplete="off">
                                        @csrf
                                        <textarea type="text" name="editcom" readonly class="textare" id="comment-text_{{$comment->id}}">{{$comment->content_comment}}</textarea>
                                        <div id="contentB" class="submit-comment">
                                            <div class="replay" comment-post-id='{{$comment->id}}' id="com_{{$comment->id}}">
                                                <span id="rep">Answer</span>
                                                @php
                    $currentDatanot =Carbon\Carbon::now();
                    $time_not = $comment->created_at;
                    $timecreatenot = Carbon\Carbon::parse($time_not);
                    $diffsec = $currentDatanot->diffInMinutes($timecreatenot);
                @endphp

                @if($diffsec<=59)
                    <p>{{floor($diffsec)}}m</p>

                @elseif($diffsec>=60 &&$diffsec < 1440)
                    <p>{{floor($diffsec/60)}}h</p>

                @elseif($diffsec>=1440 &&$diffsec< 10080)
                    <p>{{floor($diffsec/1440)}}d</p>

                @elseif($diffsec>=10080 &&$diffsec< 40320)
                    <p>{{floor($diffsec/10080)}}w</p>

                @elseif($diffsec>=40320 &&$diffsec< 483840)
                    <p>{{floor($diffsec/40320)}}m</p>

                @elseif($diffsec>=483840)
                    <p>{{floor($diffsec/40320)}}y</p>

                @endif

                                            </div>

                                            <input id="rplayInput_{{$comment->id}}" class="mohammd" type="submit" value="Edit" id="edit-btn"/>
                                        </div>
                                        </form>
                                        </div>

                                        <div class="replayComment" id="comment_{{$comment->id}}">

                                        <form autocomplete="off" method="POST" action="{{route('replay',$comment->id)}}">
                                        @csrf
                                            <input class="OneInput" type="text" name="replay_co" required placeholder="Answer..."/>
                                        </form>
                                        </div>

                                        <!-- هون نهاية التعديل  -->
                                        <!-- End one Comment -->


                                        <!-- هون ببلش الردود على تعليق -->
                                        @foreach($replays as $replay)
                                        @php
                                        $userr=DB::table('users')->find($replay->uu_id)
                                        @endphp
                                        @if($replay->cc_id== $comment->id )
                                        <div class="Second-Comment">
                                            <ul class="com">
                                                <li class="one-comment">
                                                @if(auth()->user()->img!="")
                                                <img class="comment-image" src="{{asset('profil/'.$userr->img)}}" alt="Logo"/>

                                                @elseif(true)
                                                    <img class="avatar" src="Images/profile-image.png" alt="tttt"/>
                                                @endif

                                                    <div class="comment-text">
                                                        <h4 id="asd">
                                                            {{$userr->first_name}}{{$userr->last_name}}
                                                            @if($replay->uu_id == Auth::user()->id)
                                                            <div id="delete_com_rep{{$replay->id}}" title="Delet_post"  class="iconesrep" >
                                                                <i class="fa-solid fa-trash-can fa-xs" title="Delete Comment"></i>
                                                            </div>

                                                            <div class="rep" replay-post-id='{{$replay->id}}' id="ditrep_{{$replay->id}}">
                                                                <i style="margin-right:1px;" id="editCommentIcon" class="fa-solid fa-pen fa-xs" title="Edit Comment"></i>
                                                            </div>
                                                            @endif
                                                        </h4>
                                                        <div class="conatiner conatinerrep" id="delete_confirm_popup_rep{{ $replay->id }}">
                                            <form id="delete_confirm_form_rep{{ $replay->id }}" action="{{route('replay_destroy',$replay->id)}}" method="post" >
                                            @csrf
                                            <div class="login-title">
                                                <h2>Are you sure?</h2>
                                            </div>

                                            <div class="page-box">
                                                <div class="btn">
                                                    <input onclick="closePopupr('delete_confirm_popup_rep{{ $replay->id }}')" value="Cancel" class="form-btn"/>
                                                    <input type="submit" value="Confirm" class="form-btn" />
                                                </div>
                                            </div>
                                            </form>
                                        </div>

                                                        <div  class="textarea-comment" id="commentTextArea">
                                                        <form  action="{{route('replayupdate',$replay->id)}}" method="post" autocomplete="off">
                                                            @csrf
                                                            <textarea class="replaytext" type="text" name="mmm" readonly id="reptext_{{$replay->id}}">{{$replay->replay_comment}}</textarea>
                                                            <div id="contentBB" class="submit-comment">
                                                                <input id="editrep_{{$replay->id}}" class="mod" type="submit" value="Edit" id="edit-btn"/>
                                                            </div>
                                                        </form>

                                                        </div>
                                                        @php
                    $currentDatanot =Carbon\Carbon::now();
                    $time_not = $replay->created_at;
                    $timecreatenot = Carbon\Carbon::parse($time_not);
                    $diffsec = $currentDatanot->diffInMinutes($timecreatenot);
                @endphp

                @if($diffsec<=59)
                    <p>{{floor($diffsec)}}m</p>

                @elseif($diffsec>=60 &&$diffsec < 1440)
                    <p>{{floor($diffsec/60)}}h</p>

                @elseif($diffsec>=1440 &&$diffsec< 10080)
                    <p>{{floor($diffsec/1440)}}d</p>

                @elseif($diffsec>=10080 &&$diffsec< 40320)
                    <p>{{floor($diffsec/10080)}}w</p>

                @elseif($diffsec>=40320 &&$diffsec< 483840)
                    <p>{{floor($diffsec/40320)}}m</p>

                @elseif($diffsec>=483840)
                    <p>{{floor($diffsec/40320)}}y</p>

                @endif

                                                    </div>

                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                        @endforeach
                                        <!-- End Second Comment -->
                                    </div>
                                </li>
                                @endif
                            @endforeach
                                </ul>
                            </div>
                             <!-- End Commen -->



                        </div>
                    @endforeach
                <!-- End One Post -->
                </div>
            <!-- End Posts -->
            </div>
        <!-- End All Home content -->
        </div>
    <!--  End Content-->
    </div>
    <!-- End Container for whole page -->



    <script src="JAVA/post.js">

    </script>
    <script>

        function openPopup(popupId) {
        closeAllPopups(); // إغلاق جميع ال popups
        document.getElementById(popupId).classList.add("open-popup");
    }

    function closePopup(popupId) {
        document.getElementById(popupId).classList.remove("open-popup");;
    }

    function closeAllPopups() {
        var popups = document.querySelectorAll('.conatiner');
        popups.forEach(function(popup) {
            popup.classList.remove("open-popup");;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.icones');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var adId = button.id.split('_')[2]; // استخراج معرف الإعلان من معرف الزر

                var popupId = 'delete_confirm_popup_' + adId; // بناء معرف نافذة التأكيد

                openPopup(popupId); // فتح نافذة التأكيد
            });
        });
    });


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
                var popupId = 'delete_confirm_popup_com' + adId; // بناء معرف نافذة التأكيد

                openPopup1(popupId); // فتح نافذة التأكيد
            });
        });
    });




    function openPopup2(popupId) {
        closeAllPopups(); // إغلاق جميع ال popups
        document.getElementById(popupId).classList.add("open-popup");
    }

    function closePopupr(popupId) {
        document.getElementById(popupId).classList.remove("open-popup");
    }

    function closeAllPopups() {
        var popups = document.querySelectorAll('.conatinerrep');
        popups.forEach(function(popup) {
            popup.classList.remove("open-popup");
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.iconesrep');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var adId = button.id.split('_')[2]; // استخراج معرف الإعلان من معرف الزر
                var popupId = 'delete_confirm_popup_' + adId; // بناء معرف نافذة التأكيد
                console.log(popupId)
                openPopup2(popupId); // فتح نافذة التأكيد
            });
        });
    });
    </script>
</body>
</html>
