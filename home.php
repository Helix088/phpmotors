<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors Template</title>
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
  <script src="js/webfont.js"></script>
</head>

<body class="small-body">
  <header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  </header>
  <nav>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  </nav>
  <main>
    <div>
      <h1>Welcome to PHP Motors!</h1>
      <h2 class="d-header">DMC Delorean</h2>
      <ul class="details">
        <li>3 Cup holders</li>
        <li>Superman doors</li>
        <li>Fuzzy dice!</li>
      </ul>
      <img class="delorean" src="images/delorean.jpg" alt="Delorean">
      <button class="own">Own Today</button>
    </div>
    <section class="content">
      <h2 class="reviews-header">DMC Delorean Reviews</h2>
      <div>
        <ul class="reviews">
          <li>"So fast its almost like traveling in time." (4/5)</li>
          <li>"Coolest ride on the road." (4/5)</li>
          <li>"I'm feeling Marty McFly!" (5/5)</li>
          <li>"The most futristic ride of our day." (4.5/5)</li>
          <li>"80's livin and I love it!" (5/5)</li>
        </ul>
      </div>
      <h2 class="upgrades-header">Delorean Upgrades</h2>
      <div class="upgrades">
        <figure class="car-upgrades">
          <img src="images/upgrades/flux-cap.png" alt="Flux Capacitor">
          <figcaption>
            <a href="#">Flux Capacitor</a>
          </figcaption>
        </figure>
        <figure class="car-upgrades">
          <img src="images/upgrades/flame.jpg" alt="Flame Decals">
          <figcaption>
            <a href="#">Flame Decals</a>
          </figcaption>
        </figure>
        <figure class="car-upgrades">
          <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
          <figcaption>
            <a href="#">Bumper Stickers</a>
          </figcaption>
        </figure>
        <figure class="car-upgrades">
          <img src="images/upgrades/hub-cap.jpg" alt="Hub Caps">
          <figcaption>
            <a href="#">Hub Caps</a>
          </figcaption>
        </figure>
      </div>
    </section>
  </main>
  <div class="space"></div>
  <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>

</html>