<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="Điện thoại, Điện thoại Iphone, Điện thoại Samsung, Smartphone, Điện thoại chính hãng, Điện thoại di động, Điện thoại cao cấp, Điện thoại di động giá rẻ">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="./assets/image/favicon.png" type="image/x-icon">
    <!-- FAVICON -->
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/root.css">
    <link rel="stylesheet" href="./assets/css/common-style.css">
    <link rel="stylesheet" href="./assets/css/header-style.css">
    <link rel="stylesheet" href="./assets/css/banner-style.css">
    <link rel="stylesheet" href="./assets/css/home-style.css">
    <link rel="stylesheet" href="./assets/css/footer-style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/css/loading-style.css">
    <link rel="stylesheet" href="./assets/css/product-details.css">
    <link rel="stylesheet" href="./assets/css/contact.css">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <link rel="stylesheet" href="./assets/css/my-profile-style.css">
    <!-- CSS -->
    <!-- ALERT -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.2/dist/sweetalert2.all.min.js"></script>
    <!-- ALERT -->
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- ICON -->
    <!-- CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- CHART.JS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100..900;1,100..900&family=Cairo:wght@200..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
        *:not(i) {
            font-family: "Cairo", sans-serif !important;
        }
    </style>
    <title>Manga Shop <?= (isset($_GET["page"]) && !empty($_GET["page"])) ? " - " . ucfirst($_GET["page"]) : "" ?></title>
</head>
<body>
    <div id="root">
        <?php include './router.php' ?>
    </div>
    <!-- /* --------------------------------- SCRIPT --------------------------------- */ -->
    <script src="./assets/javascript/alert-condition.js"></script>
    <!-- /* --------------------------------- SCRIPT --------------------------------- */ -->
    <!-- <script src="./assets/javascript/snowfall.js" ></script> -->
</body>
</html>