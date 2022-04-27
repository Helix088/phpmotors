<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors Error Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
  <script src="../js/webfont.js"></script>
</head>

<body class="small-body">
  <header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/error-header.php'; ?>
  </header>
  <nav>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
  </nav>
  <main>
    <h1>Server Error</h1>
    <p style="margin-left: 2rem;">Sorry our server seems to be experiencing some technical difficulties. Please check back later.</p>
  </main>
  <div class="space"></div>
  <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/error-footer.php'; ?>
  </footer>
</body>

</html>