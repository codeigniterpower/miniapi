<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>miniapi</title>
        <link rel="icon" href="icon.png" type="image/x-icon">
        <link rel="stylesheet" href="assets/css/bulma.min.css">
    </head>
    <body>
        <nav class="navbar" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a class="navbar-item">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
          </div>
          <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
              <div class="navbar-item has-dropdown is-hoverable">
                <a href="lists"  class="navbar-link">
                  Start
                </a>
                <div class="navbar-dropdown">
                  <a href="about"  class="navbar-item">
                    About
                  </a>
                  <a href="api/api" class="navbar-item is-selected">
                    API
                  </a>
                  <hr class="navbar-divider">
                  <a href="https://codeberg.org/codeigniter/miniapi/issues"  class="navbar-item">
                    Issues
                  </a>
                </div>
              </div>
            </div>
            <div class="navbar-end">
              <div class="navbar-item">
                  <a href="about" class="button is-primary">
                    About
                  </a>
                </div>
              </div>
            </div>
          </div>
        </nav>
        <br>
            <main class="contain">
            <h1 class="title">Not found</h1>
            <hr>
            <p>
<?php
if(!isset($message)) $message = "System is currently in manteniance, just wait for a moment..";
if(!isset($httpcode)) $httpcode = 412;
if(!isset($currentrequest)) $currentrequest = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo $message.', please report any incident but first try to check if there any previous report at <a href="https://codeberg.org/codeigniter/miniapi/issues">https://codeberg.org/codeigniter/miniapi/issues</a> with code '.$httpcode.' and this link: '.$currentrequest;
?>
</p>
            </main>
        <br>
        <footer class="footer">
            <div class="content has-text-centered">
                <p><strong>miniapi</strong></p>
            </div>
        </footer>
    </body>
</html>
