<?php
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
    <title>Image Management</title>
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
        <h1>Image Management</h1>
        <p class="choose">Choose one of the options below:</p>
        <h2>Add New Vehicle Image</h2>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <div class="container">
                <label for="invItem" class="veh-lab">Vehicle</label>
                <br>
                <?php echo $prodSelect; ?>
                <fieldset class="image-veh">
                    <label>Is this the main vehicle image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
                <label>Upload Image:</label>
                <br>
                <input type="file" name="file1" class="cfile">
                <br>
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </div>
        </form>

        <h2>Existing Images</h2>
        <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
        <?php
        if (isset($imageDisplay)) {
            echo $imageDisplay;
        }
        ?>
    </main>
    <div class="space"></div>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
</body>

</html>
<?php unset($_SESSION['message']); ?>