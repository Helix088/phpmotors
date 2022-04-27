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
    //require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; 
    ?>
  </nav>
  <main>
    <h1>Sign-in</h1>
    <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
    }
    ?>
    <form method="post" action="/phpmotors/accounts/">
      <div class="container">
        <label for="email">Email:</label>
        <input type="email" name="clientEmail" id="email" <?php if (isset($clientEmail)) {
                                                            echo "value='$clientEmail'";
                                                          } ?> required>
        <br>
        <label for="password">Password:</label>
        <span class="pass">Passwords must be at least 8 characters and contain at least 1 number, 1 captial letter and 1 special character</span>
        <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
      </div>
      <button type="submit" class="signin" value="Login">Sign-in</button>
      <input type="hidden" name="action" value="login">
      <br>
      <a href="/phpmotors/accounts/index.php?action=Register" class="notmember">Not a member yet?</a>
    </form>
  </main>
  <div class="space"></div>
  <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
  </footer>
</body>

</html>