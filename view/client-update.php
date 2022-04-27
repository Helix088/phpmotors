<?php
if (!isset($_SESSION['loggedin'])) {
  header('Location: /phpmotors/index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors Account Management</title>
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
    <h1>Manage Account</h1>
    <h2>Update Account</h2>
    <?php
    if (isset($_SESSION['smessage'])) {
      echo $_SESSION['smessage'];
    }
    ?>
    <form action="/phpmotors/accounts/index.php" method="post">
      <div class="container">
        <label for="clientFirstname">First Name</label>
        <input type="text" name="clientFirstname" id="clientFirstname" required <?php echo "value='" . $_SESSION['clientData']['clientFirstname'] . "'"; ?>>
        <br>
        <label for="clientLastname">Last Name</label>
        <input type="text" name="clientLastname" id="clientLastname" required <?php echo "value='" . $_SESSION['clientData']['clientLastname'] . "'"; ?>>
        <br>
        <label for="email">Email</label>
        <input type="email" name="clientEmail" id="email" required <?php echo "value='" . $_SESSION['clientData']['clientEmail'] . "'"; ?>>
        <br>
      </div>
      <button type="submit" name="submit" id="upinfo" value="Update_Info">Update Info</button>
      <input type="hidden" name="action" value="updateInfo">
      <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                    echo $_SESSION['clientData']['clientId'];
                                                  } ?>">
      <br>
    </form>
    <h2>Update Password</h2>
    <?php
    if (isset($_SESSION['pmessage'])) {
      echo $_SESSION['pmessage'];
    }
    ?>
    <form action="/phpmotors/accounts/index.php" method="post">
      <div class="container">
        <span class="pass">Passwords must be at least 8 characters and contain at least 1 number, 1 captial letter and 1 special character</span>
        <br>
        <br>
        <span class="pass">*note your original password will be changed.</span>
        <br>
        <br>
        <label for="password">Password</label>
        <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
      </div>
      <br>
      <button type="submit" name="submit" id="uppass" value="Update_Password">Update Password</button>
      <input type="hidden" name="action" value="updatePass">
      <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                    echo $_SESSION['clientData']['clientId'];
                                                  } ?>">
      <br>
    </form>
  </main>
  <div class="space"></div>
  <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
  </footer>
</body>

</html>
<?php unset($_SESSION['smessage']); ?>
<?php unset($_SESSION['pmessage']); ?>