<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php
    // đặt tên title page
    $url_name = basename($_SERVER['PHP_SELF'], '.php');
    switch ($url_name) {
        case 'signup':
            echo '<title>Sign Up</title>';
            break;

        case 'signin':
            echo '<title>Sign In</title>';
            break;

        default:
            echo '<title>Index</title>';
            break;
    }
    ?>

    <!-- Font Icon -->
    <link rel="stylesheet" href="libs/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="libs/css/style.css">

    <!-- Javascript & Jquery -->
    <script type="text/javascript" src="libs/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="libs/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="libs/js/main.js"></script>
    
</head>