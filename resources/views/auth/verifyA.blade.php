<!-- <!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <form method="POST" action="/verify-email">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="code" value="{{ $code }}">

        <label for="verification_code">Verification Code:</label>
        <input type="text" name="verification_code" required>

        <button type="submit">Verify Email</button>

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </form>
</body>
</html> -->



<!DOCTYPE html>
<!-- Coding by CodingLab || www.codinglabweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification Email</title>
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
    <link rel="stylesheet" href="/CSS/verfiy.css" />
    <!-- Boxicons CSS -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container">
      <header>
        <i class="bx bxs-check-shield"></i>
      </header>
      <h4>Verify Your Email</h4>
      <p>
        We have sent a verification code on your email
        <span>{{$email}}</span>. Please enter the verificatino code below.
      </p>
      @if(session('alert'))
    <div class="alert alert-warning" style="color:red;">
        {{ session('alert') }}
    </div>
@endif
      <form method="POST" action="/verify-email-A">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="code" value="{{ $code }}">

        <input type="hidden" name="first_name" value="{{ $first_name }}">
        <input type="hidden" name="last_name" value="{{ $last_name }}">
        <input type="hidden" name="password" value="{{ $password }}">

        <div class="input-field">
          <input type="text" name="one"class="in" />
          <input type="text"  name="two" class="in" disabled />
          <input type="text"  name="three"  class="in" disabled />
          <input type="text"  name="four"  class="in" disabled />
        </div>
        <input type="submit" value="Confirm" />
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
      </form>

    </div>

  </body>
  <script src="/JAVA/verfiy_Script.js"></script>
</html>
