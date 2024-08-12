
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login InterFace</title>
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
    <link rel="stylesheet" href="/CSS/log_master.css" />
  </head>
  <body>
    <!-- Start Login InterFace -->
    <div class="log">
      <div class="container">
        <div class="login-box">
        <form method="POST" autocomplete="off" action="{{ route('login') }}">
            @csrf
            <div class="page-box">
              <div class="login-title">
                <h2>Login</h2>
                <p>Please login to enter Vision</p>
              </div>

              <div class="page">
                <div class="input-box">
                  <input
                    type="text"
                    name="email"
                    class="email"
                    required
                    autofocus
                  />
                  <label>Enter Your email</label>
                </div>
                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 style="color:red">{{ $message }}</h5>
                                    </span>
                    @enderror
                <div class="input-box-2">
                  <input
                    name="password"
                    type="password"
                    id="password"
                    class="password"
                    required
                  />
                  <label class="pass">Enter Your password</label>
                </div>
                @error('email')
                            <span class="invalid-feedback" role="alert">
                                <h5 style="color:red">{{ $message }}</h5>
                            </span>
                    @enderror
                <div class="forgot show">
                  <a href="#">Forgot password?</a>
                  <label
                    ><input type="checkbox" class="checkbox-pass" />Show
                    password</label>
                </div>

                <div class="btn-box">
                  <a href="#" onclick="openPopup()">Create account</a>
                  <button type="submit" class="btn-next">Login</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Start Popup Section student or professor -->
      <div class="popup" id="popup">
        <h2>Rigster as</h2>
        <button class="close-button" onclick="closePopup()">&times;</button>
        <a href="{{route('doctor')}}" onclick="closePopup()">Professor</a>
        <a href="{{route('student')}}" onclick="closePopup()">Student</a>
        <a href="{{route('admin')}}" onclick="closePopup()">Admin</a>
      </div>
      <!-- End Popup Section -->
      <div class="text-box">
        <h2>VISION</h2>
        <br />
        <p>
          Watch the latest university news, communicate with professors, and
          make it easier
        </p>
      </div>
    </div>
    <script src="/JAVA/script.js"></script>
    <!-- End Login InterFace -->
  </body>
</html>
