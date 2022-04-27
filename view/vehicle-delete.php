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
  <title><?php if (isset($invInfo['invYear']) && isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Delete $invInfo[invYear] $invInfo[invMake] $invInfo[invModel]";
          } ?> | PHP Motors</title>
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
    <h1><?php if (isset($invInfo['invYear']) && isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
          echo "Delete $invInfo[invYear] $invInfo[invMake] $invInfo[invModel]";
        } ?></h1>
    <?php
    if (isset($message)) {
      echo "<strong>" . $message . "</strong>";
    }
    ?>
    <p><strong>Confirm Vehicle Deletion. The delete is permanent.</strong></p>
    <form action="/phpmotors/vehicles/index.php" method="post">
      <div class="container">
        <label for="invYear">Vehicle Year</label>
        <input type="text" readonly name="invYear" id="invYear" <?php
                                                                if (isset($invInfo['invYear'])) {
                                                                  echo "value='$invInfo[invYear]'";
                                                                } ?>>
        <br>
        <label for="invMake">Vehicle Make</label>
        <input type="text" readonly name="invMake" id="invMake" <?php
                                                                if (isset($invInfo['invMake'])) {
                                                                  echo "value='$invInfo[invMake]'";
                                                                } ?>>
        <br>
        <label for="invModel">Vehicle Model</label>
        <input type="text" readonly name="invModel" id="invModel" <?php
                                                                  if (isset($invInfo['invModel'])) {
                                                                    echo "value='$invInfo[invModel]'";
                                                                  } ?>>
        <br>
        <label for="invDescription">Vehicle Description</label>
        <textarea name="invDescription" readonly id="invDescription"><?php
                                                                      if (isset($invInfo['invDescription'])) {
                                                                        echo $invInfo['invDescription'];
                                                                      }
                                                                      ?></textarea>
        <br>
        <br>
        <button type="submit" name="submit" id="modbtn" value="Delete Vehicle" class="register">Delete Vehicle</button>
        <input type="hidden" name="action" value="deleteVehicle">
        <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                    echo $invInfo['invId'];
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