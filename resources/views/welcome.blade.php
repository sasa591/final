<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vision-HomePage</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="CSS/all.min.css" />
    <!-- Normalize Css File -->
    <link rel="stylesheet" href="CSS/normalize.css" />
    <!-- Master Css File -->
    <link rel="stylesheet" href="CSS/welcome.css" />
  </head>
  <body>
    <!-- Start Header -->
    <div class="header">
      <div class="container">
        <a href="HomePage.html" class="logo"><h4>VISION</h4></a>
        <ul class="main-nav">
          <li><a href="#Sections">Sections</a></li>
          <li><a href="#Services">Services</a></li>
          <li><a href="#About">About</a></li>
          <li><a href="{{'login'}}">Join Us</a></li>
        </ul>
      </div>
    </div>
    <!-- End Header -->
    <!-- Start Landing -->
    <div class="landing">
      <div class="container">
        <div class="text">
          <h1>Welcom To Our Community</h1>
          <p>
            Vision is a website that provides services to the faculty of IT at
            Tishreen University,such as advertisements,university
            services,lectures,and others
          </p>
        </div>
        <div class="image">
          <img src="images/avatar1.png" alt="" />
        </div>
      </div>
      <a href="#Services" class="go-down">
        <i class="fas fa-angle-double-down fa-2x"></i>
      </a>
    </div>
    <!-- End Landing -->
    <!-- Start Sections -->
    <div class="sections" id="Sections">
      <h2 class="main-title">Sections</h2>
      <div class="container">
        <img src="images/work.png" alt="logo" class="images" />
        <div class="info">
          <div class="box">
            <img src="images/laptop-coding.png" alt="logo" />
            <div class="text">
              <h3>SoftWare</h3>
              <p>
                Software engineers apply engineering principles and knowledge of
                programming languages to build software solutions for end users
              </p>
            </div>
          </div>
          <div class="box">
            <img src="images/AI.png" alt="logo" />
            <div class="text">
              <h3>Artificial intelligence</h3>
              <p>
                Artificial intelligence is the science of making machines that
                can think like humans. It can do things that are considered
                "smart"
              </p>
            </div>
          </div>
          <div class="box">
            <img src="images/Networks.jpg" alt="logo" />
            <div class="text">
              <h3>Networks</h3>
              <p>
                A network consists of two or more computers that are linked in
                order to share resources (such as printers and CDs)
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Sections -->
    <!-- Start Services Section -->
    <div class="services" id="Services">
      <h2 class="main-title">Services</h2>
      <div class="container">
        <div class="box">
          <i class="fa-solid fa-rectangle-ad fa-3x"></i>
          <h3>Advertisements</h3>
          <div class="info">
            <a href="#"></a>
          </div>
        </div>
        <div class="box">
          <i class="fa-solid fa-user-graduate fa-3x"></i>
          <h3>Courses</h3>
          <div class="info"></div>
        </div>
        <div class="box">
          <i class="fas fa-university fa-3x"></i>
          <h3>University services</h3>
          <div class="info"></div>
        </div>
        <div class="box">
          <i class="fa-solid fa-book-open fa-3x"></i>
          <h3>Library</h3>
          <div class="info"></div>
        </div>
        <div class="box">
          <i class="fas fa-money-check fa-3x"></i>
          <h3>Paying off</h3>
          <div class="info"></div>
        </div>
        <div class="box">
          <i class="fas fa-comments fa-3x"></i>
          <h3>Chat</h3>
          <div class="info"></div>
        </div>
      </div>
    </div>
    <!-- End Services Section -->
    <!-- Start About Seciotn -->
    <div class="about" id="About">
      <div class="image">
        <div class="content">
          <h2>Who We Are?</h2>
          <p>
            We are students from the Faculty of Information Engineering at
            Tishreen University, fifth year, software major
          </p>
          <img src="images/Description.png" alt="logo" />
        </div>
      </div>
      <div class="info">
        <div class="content">
          <h2>What is this site?</h2>
          <p>
            This website is for the College of Informatics Engineering at our
            university. Through it, we have tried to facilitate matters for
            students and teaching staff, in addition to employees, where
            teachers can add educational lessons and announcements for the
            college. There is also a special section for university services
            such as objections, attendance documents, etc.
          </p>
        </div>
      </div>
    </div>
    <!-- End About Section -->
    <!-- Start Footer -->
    <div class="footer">
      <div class="container">
        <div class="box">
          <h3>Tishreen University</h3>
          <ul class="social">
            <li>
              <a
                href="https://www.facebook.com/"
                target="_blank"
                class="facebook"
              >
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/" target="_blank" class="twitter">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li>
              <a
                href="https://www.youtube.com/"
                target="_blank"
                class="youtube"
              >
                <i class="fab fa-youtube"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="box">
          <ul class="links">
            <li><a href="#Services">Services</a></li>
            <li><a href="#Sections">Sections</a></li>
            <li><a href="#About">About</a></li>
          </ul>
        </div>
      </div>
      <p class="copyright">&copy; Made By</p>
    </div>
    <!-- End Footer -->
  </body>
</html>
