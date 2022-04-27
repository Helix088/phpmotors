<img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo">
<?php
if (isset($_SESSION['clientData'])) {
  echo '<span><a href="/phpmotors/accounts/index.php?action=logout" class="logout-link">Logout</a></span>';
  echo '<span><a href="/phpmotors/accounts/index.php" class="account-name">' . $_SESSION['clientData']['clientFirstname'] . ' | </a></span>';
} elseif (!isset($_SESSION['clientData'])) {
  echo '<span><a href="/phpmotors/accounts/index.php?action=login" class="account" title="Click to register or login">My Account</a></span>';
}
?>
<div class="search">
  <a href="/phpmotors/search/index.php"><img src="/phpmotors/images/mag-glass.png" class="mag-glass" alt="search icon"></a>
</div>