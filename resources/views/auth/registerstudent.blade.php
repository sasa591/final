<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rigster InterFace</title>
    <!-- Normalize CSS File -->
    <link rel="stylesheet" href="CSS/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="CSS/all.min.css" />
    <!-- Google Fonts "Work Sans" -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- CSS Master File -->
    <link rel="stylesheet" href="CSS/reg_master.css" />
  </head>
  <body>
    <div class="log">
      <div class="conatiner">
        <div class="regester-box">
        <form action="{{route('gret')}}" method="post" autocomplete="off">
        @csrf
            <div class="login-title">
              <h2>Register Now</h2>
              <p>Rigster as a student</p>
            </div>
            <div class="page-box">

              <div class="input-box">

                <input type="number" min="1" name="University_id" required />
                <label>university id</label>
                <div style="font-size:12px; color:red;"  class="alert alert-danger">{{$dd}}</div>


              </div>

              <div class="input-box">
                <input type="email" name="Email" unique required />
                <label>email</label>
              </div>
              <div class="input-box icon">
                <input
                  type="password"
                  name="password"
                  required
                  id="paassword"
                  class="password"
                />
                <label>password</label>
                <img src="Images/eye-close.png" id="eyeicon" />
              </div>
              <input
                type="submit"
                name="submit"
                value="register now"
                class="form-btn"
              />
              <p class="par">
                already have an account? <a href="{{ route('login') }}">login now</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="JAVA/script2.js"></script>
  </body>
</html>
