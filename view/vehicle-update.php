<?php
// Build the classifications option list
$classificationList = '<select name="classificationId" id="classificationList">';
$classificationList .= "<option>Choose a Classification</option>";
foreach ($classifications as $classification) {
  $classificationList .= "<option value='$classification[classificationId]'";
  if (isset($classificationId)) {
    if ($classification['classificationId'] == $classificationId) {
      $classificationList .= ' selected ';
    }
  } elseif (isset($invInfo['classificationId'])) {
    if ($classification['classificationId'] === $invInfo['classificationId']) {
      $classificationList .= ' selected ';
    }
  }
  $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';

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
            echo "Modify $invInfo[invYear] $invInfo[invMake] $invInfo[invModel]";
          } elseif (isset($invYear) && isset($invMake) && isset($invModel)) {
            echo "Modify $invYear $invMake $invModel";
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
          echo "Modify $invInfo[invYear] $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invYear) && isset($invMake) && isset($invModel)) {
          echo "Modify $invYear $invMake $invModel";
        } ?></h1>
    <?php
    if (isset($message)) {
      echo "<strong>" . $message . "</strong>";
    }
    ?>
    <p><strong>*Note all Fields are Required</strong></p>
    <form action="/phpmotors/vehicles/index.php" method="post">
      <div class="container">
        <label for="classificationList">Classification</label><br>
        <?php
        echo $classificationList;
        ?>
        <br>
        <br>
        <label for="invId">Vin</label>
        <input type="text" name="invId" id="invId" <?php if (isset($invId)) {
                                                      echo "value='$invId'";
                                                    } ?> required>
        <br>
        <label for="invYear">Year</label>
        <input type="text" name="invYear" id="invYear" <?php if (isset($invYear)) {
                                                          echo "value='$invYear'";
                                                        } elseif (isset($invInfo['invYear'])) {
                                                          echo "value='$invInfo[invYear]'";
                                                        } ?> required>
        <br>
        <label for="invMake">Make</label>
        <input type="text" name="invMake" id="invMake" <?php if (isset($invMake)) {
                                                          echo "value='$invMake'";
                                                        } elseif (isset($invInfo['invMake'])) {
                                                          echo "value='$invInfo[invMake]'";
                                                        } ?> required>
        <br>
        <label for="invModel">Model</label>
        <input type="text" name="invModel" id="invModel" <?php if (isset($invModel)) {
                                                            echo "value='$invModel'";
                                                          } elseif (isset($invInfo['invModel'])) {
                                                            echo "value='$invInfo[invModel]'";
                                                          } ?> required>
        <br>
        <label for="invDescription">Description</label>
        <textarea name="invDescription" id="invDescription" required>
<?php if (isset($invDescription)) {
  echo $invDescription;
} elseif (isset($invInfo['invDescription'])) {
  echo $invInfo['invDescription'];
} ?></textarea>
        <br>
        <label for="invPrice">Price</label>
        <input type="text" name="invPrice" id="invPrice" <?php if (isset($invPrice)) {
                                                            echo "value='$invPrice'";
                                                          } elseif (isset($invInfo['invPrice'])) {
                                                            echo "value='$invInfo[invPrice]'";
                                                          } ?> required>
        <br>
        <label for="invStock"># In Stock</label>
        <input type="text" name="invStock" id="invStock" <?php if (isset($invStock)) {
                                                            echo "value='$invStock'";
                                                          } elseif (isset($invInfo['invStock'])) {
                                                            echo "value='$invInfo[invStock]'";
                                                          } ?> required>
        <br>
        <label for="invMiles">Miles</label>
        <input type="text" name="invMiles" id="invMiles" <?php if (isset($invMiles)) {
                                                            echo "value='$invMiles'";
                                                          } elseif (isset($invInfo['invMiles'])) {
                                                            echo "value='$invInfo[invMiles]'";
                                                          } ?> required>
        <br>
        <label for="invColor">Color</label>
        <input type="text" name="invColor" id="invColor" <?php if (isset($invColor)) {
                                                            echo "value='$invColor'";
                                                          } elseif (isset($invInfo['invColor'])) {
                                                            echo "value='$invInfo[invColor]'";
                                                          } ?> required>
      </div>
      <br>
      <button type="submit" name="submit" id="modbtn" value="Modify Vehicle" class="register">Modify Vehicle</button>
      <input type="hidden" name="action" value="modifyVehicle">
      <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                  echo $invInfo['invId'];
                                                } elseif (isset($invId)) {
                                                  echo $invId;
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