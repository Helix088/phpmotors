<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $vehicle['invYear'] . " " . $vehicle['invMake'] . " " . $vehicle['invModel'] ?> | PHP Motors, Inc.</title>
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
        <h1><?php echo $vehicle['invYear'] . " " . $vehicle['invMake'] . " " . $vehicle['invModel']; ?></h1>
        <div class="car-info">
            <?php if (isset($message)) {
                echo $message;
            } ?>
            <?php if (isset($vehicleInfo)) {
                echo $vehicleInfo;
            } ?>
            <?php if (isset($thumbDisplay)) {
                echo $thumbDisplay;
            } ?>
        </div>
    </main>
    <div class="space"></div>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
</body>

</html>