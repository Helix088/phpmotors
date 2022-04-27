<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | PHP Motors Template</title>
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
        <h1>Search</h1>
        <?php if (isset($e_message)) {
            echo $e_message;
        } ?>
        <div class="search-page">
            <form action="/phpmotors/search/index.php" method="get">
                <label for="search" class="look search-left">What are you looking for today?</label>
                <input type="text" name="search" id="search" value="<?php
                                                                                if (isset($_GET['search']) && $_GET['submit'] != '') {
                                                                                    $search = trim($_GET['search']);
                                                                                } ?>" class="search-bar" required>
                <br>
                <button type="submit" name="submit" id="addbtn" value="Search" class="search-btn search-left">Search</button>
                <input type="hidden" name="action" value="search">
            </form>
        </div>
        <?php if (isset($searchInfo)) {
            echo $searchInfo;
        } ?>
        <?php if (isset($n_message)) {
            echo $n_message;
        } ?>
    </main>
    <div class="space"></div>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
</body>

</html>
<?php unset($_SESSION['e_message']); ?>
<?php unset($_SESSION['n_message']); ?>