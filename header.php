<?php

include_once "config.php";

session_start();

$text = "Login/Register";

if (isset($_SESSION['email']))
{
  $text = $_SESSION['email'] . " <br> Logout";
}

echo
(
  "<header class='header'>

  <div class='logo-container'>
  <img src='img/cc_logo_t.png' alt='cc_logo' class='logo'>
  </div>

  <nav>
  <ul class='nav-bar'>
    <li class='nav-item'>
    <a href='index.php' class='nav-item-content nav-cars'>Cars</a>
    </li>

    <li class='nav-item'>
    <a href='brands.php' class='nav-item-content nav-brand'>Brand</a>
    </li>

    <li class='nav-item'>
    <a href='findcar.php' class='nav-item-content nav-find'>Find Me A Car</a>
    </li>

    <li class='nav-item'>
    <a href='compare.php' class='nav-item-content nav-compare'>Compare</a>
    </li>
  </ul>
  </nav>

  <div class='login'>" . $text . "</div>

  </header>"
);

?>