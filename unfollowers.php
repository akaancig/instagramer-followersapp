<!DOCTYPE html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>instagrammer</title>
  </head>
  <body>

  <script type="text/javascript">
      function toggleButtonState(event) {
          var button = event.target;
          var currentState = button.getAttribute('aria-pressed');
          var newState = 'true';

          // If aria-pressed is set to true, set newState to false
          if (currentState === 'true') {
              newState = 'false';
          }

          // Set the new aria-pressed state on the button
          button.setAttribute('aria-pressed', newState);
      }
      $(function(){ // I use jQuery in this example
          document.getElementById('click_me').onclick =
              function () { alert('Hi'); };
      }
      );
  </script>

  <!-- Image and text -->
      <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand" href="#">
              <img src="/instagram/4.pn" width="60" height="60" class="d-inline-block align-top" alt="">
              instagram-mer
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Dropdown
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                  </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
          </div>
      </nav>

    <div class = "container">

    <?php

        if(isset($_POST["kullanici_adi"])){
            echo print "<br>giris<br>";
        }
    ?>

    <form method="post">

          <div style="padding-top: 50px" class="container">
            Kullanıcı Adı :
            <input type="text" name="kullanici_adi" value=""><br>
          </div>

          <div class="container">
            <br>Parola :
            <input style="margin-left: 41px" type="password" name="sifre" value=""><br>
          </div>

          <div style="padding-top: 35px;padding-left: 15px">
              <!--<button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                  Giriş Yap
              </button>-->
              <input style="" type="submit" name="" value="GİRİŞ YAP">
          </div>

          <div style="padding-top: 50px" class="btn-group btn-group-toggle" data-toggle="buttons">

            <label class="btn btn-secondary active">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> 1.ŞAHIS
            </label>

            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" autocomplete="off"> 2. yada 3. ŞAHIS
            </label>
          </div>

     </form>



    </div>

  <div class="container">
      <br><p>
          --> Kendi takipçileriniz için '1.ŞAHIS' seçilmelidir.<br>
          --> Takip ettiğiniz birisi yada hesabı açık birisinin takipçileri için<br> '2. yada 3. ŞAHIS' seçilmelidir.
      </p><br>
  </div>

    <div class="alert alert-secondary mt-5 text-right" role="alert">

    </div>

  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  </body>
</html>
