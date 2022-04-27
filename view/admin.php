<?php
if (!isset($_SESSION['loggedin'])) {
  header('Location: /phpmotors/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors Sign-in</title>
  <link rel="stylesheet" href="/phpmotors/css/normalize.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="stylesheet" href="/phpmotors/css/styles.css?v=<?php echo time(); ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
  <script src="/phpmotors/js/webfont.js"></script>
</head>

<body class="small-body">
  <header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
  </header>
  <nav>
    <?php echo $navList;
    ?>
  </nav>
  <main>
    <h1><?php echo $_SESSION['clientData']['clientFirstname'], " ",
        $_SESSION['clientData']['clientLastname'] ?></h1>
    <p class="loggedin">You are logged in.</p>
    <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
    }
    ?>
    <ul class="logininfo">
      <li><?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
      <li><?php echo $_SESSION['clientData']['clientLastname']; ?></li>
      <li><?php echo $_SESSION['clientData']['clientEmail']; ?></li>
    </ul>
    <?php
    echo '<h2>Account Managment</h2>';
    echo '<p class="account-man">Use the link to update account information</p>';
    echo '<a href="/phpmotors/accounts/index.php?action=Update_Info" class="account-link">Update Account Information</a>';
    ?>
    <?php
    if ($_SESSION['clientData']['clientLevel'] > '1') {
      echo '<h2>Inventory Managment</h2>';
      echo '<p class="veh-man">Use the link to manage the inventory</p>';
      echo '<a href="/phpmotors/vehicles/index.php" class="veh-link">Vehicle Management</a>';
    }
    ?>
    <?php
    if ($_SESSION['clientData']['clientLevel'] > '1') {
      echo '<h2>Image Managment</h2>';
      echo '<p class="img-man">Use the link to manage the images</p>';
      echo '<a href="/phpmotors/uploads/index.php" class="img-link">Image Management</a>';
    }
    ?>
  </main>
  <br>
  <div class="space"></div>
  <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
  </footer>
</body>

</html>
<?php unset($_SESSION['message']); ?>