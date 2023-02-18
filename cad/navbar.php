<header>
        <div class=" d-flex justify-content-between px-4 py-2 text-light">
            <div>CAD BETA</div>
            <div>Zalogowano jako: <?php echo $_SESSION['me'] ?> | <a class='text-light' href='logout.php'>Wyloguj</a></div>
        </div>
        <nav class="ps-3 navbar navbar-expand-sm navbar-dark bg-navbar">
            <button class=" ml-3 navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="home.php">Strona Główna</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="notatnik.php">Notatnik</a>
                </li>
                <li class="nav-item dropdown dmenu">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  Obywatele
                </a>
                <div class="dropdown-menu sm-menu">
                  <a class="dropdown-item" href="bolo.php">Poszukiwani</a>
                  <a class="dropdown-item" href="obywatel.php">Wyszukaj obywatela</a>
                  <a class="dropdown-item" href="pojazd.php">Wyszukaj Pojazd</a>
                </div>
              </li>
               <li class="nav-item dropdown dmenu">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  LAPD
                </a>
                <div class="dropdown-menu sm-menu">
                  <a class="dropdown-item" href="patrole.php">Patrole</a>
                  <a class="dropdown-item" href="patrol.php">Mój Patrol</a>
                  <!--<a class="dropdown-item disabled" href="sluzba.php">Moja służba</a>-->
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="wezwania.php">Dispatch</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="wpis.php">Utwórz wpis</a>
              </li>
              </ul>
            </div>
          </nav>
    </header>