<?php
if (!isset($_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel'] < 2)) {
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
  <title>PHP Motors Add Classification</title>
  <link rel="stylesheet" href="/phpmotors/css/normalize.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="stylesheet" href="/phpmotors/css/styles.css">
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
    <h1>Add Car Classification</h1>
    <?php
    if (isset($message)) {
      echo "<strong>" . $message . "</strong>";
    }
    ?>
    <form action="/phpmotors/vehicles/index.php" method="post">
      <div class="container">
        <label for="classificationName">Classification Name</label>
        <p class="thirty">Classification Name can only contain up to 30 characters between A-Z</p>
        <input type="text" name="classificationName" id="classificationName" required pattern="[A-Za-z]{0,30}">
      </div>
      <br>
      <button type="submit" name="submit" id="addbtn" value="Add_Classification" class="register">Add Classification</button>
      <input type="hidden" name="action" value="add_classification">
      <br>
    </form>
  </main>
  <div class="space"></div>
  <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
  </footer>
</body>

</html>