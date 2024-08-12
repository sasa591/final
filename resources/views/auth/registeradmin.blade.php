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
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- CSS Master File -->
    <link rel="stylesheet" href="CSS/reg_master.css" />
  </head>
  <body>
    <div class="log">
      <div class="conatiner">
        <div class="regester-box">
        <form autocomplete="off" method="POST" action="{{ route('radmin.store') }}">
        @csrf
            <div class="login-title">
              <h2>Register Now</h2>
              <p>Rigster as Admin</p>
            </div>
            <div class="page-box">
              <div class="input-box">
                <input type="text" name="First_Name" required autofocus />
                <label>First name</label>
                @error('First_Name')
                <div style="font-size:12px; color:red;" class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="input-box">
                <input type="text" name="Last_Name" required />
                <label>Last name</label>

                @error('Last_Name')
                <div style="font-size:12px; color:red;"  class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="input-box">
                <input name="id" type="number" min="1" required />
                <label>Admin id</label>
                @error('id')
                <div style="font-size:12px; color:red;"  class="alert alert-danger">{{ $message }}</div>
            @enderror
              </div>
              <div class="input-box">
                <input type="text" name="Email" required />
                <label>email</label>
                @error('Email')
                <div style="font-size:12px; color:red;"  class="alert alert-danger">{{ $message }}</div>
            @enderror
              </div>
              <div class="input-box icon">
                <input
                  type="password"
                  name="password"
                  id="paassword"
                  required
                />
                <label>password</label>
                <img src="Images/eye-close.png" id="eyeicon" />
              </div>
              <input
                type="submit"
                type="submit"
                name="submit"
                value="register now"
                class="form-btn"
              />
              <p class="par">already have an account?</p>
              <p class="par">
                <a href="{{ route('login') }}">login now</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="/JAVA/script2.js"></script>
  </body>
</html>
