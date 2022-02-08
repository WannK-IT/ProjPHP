<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <?php
    // đặt tên title page
    $url_name = basename($_SERVER['PHP_SELF'], '.php');
    switch ($url_name) {
        case 'register':
            echo '<title>Register</title>';
            break;

        case 'login':
            echo '<title>Login</title>';
            break;

        default:
            echo '<title>Index</title>';
            break;
    }
    ?>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/bootstrap/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- -- Script -- -->
    <script type="text/javascript" src="libs/bootstrap/js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
</body>