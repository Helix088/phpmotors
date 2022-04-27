<?php
if (!isset($_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel'] < 2)) {
  header('Location: /phpmotors/');
  exit;
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors Template</title>
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
    <h1>Vehicle Management</h1>
    <ul>
      <li><a href="/phpmotors/vehicles/index.php?action=Add_Classification">Add Classification</a></li>
      <li><a href="/phpmotors/vehicles/index.php?action=Add_Vehicle">Add Vehicle</a></li>
    </ul>
    <div class="mod-delete">
      <?php
      if (isset($message)) {
        echo $message;
      }
      if (isset($classificationList)) {
        echo '<h2>Vehicles By Classification</h2>';
        echo '<p>Choose a classification to see those vehicles</p>';
        echo $classificationList;
      }
      ?>
      <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
      </noscript>
      <table id="inventoryDisplay"></table>
    </div>
  </main>
  <div class="space"></div>
  <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
  </footer>
</body>
<script src="/phpmotors/js/inventory.js"></script>

</html>
<?php unset($_SESSION['message']); ?>