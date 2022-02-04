<?php
include_once "head.php";
require_once "config/db.class.php";
require_once "functions.php";
require_once "config/validate.class.php";
?>
<?php
session_start();
if (isset($_POST['name']) && isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['pass_word']) && isset($_POST['re_pass'])) {
    $name       = $_POST['name'];
    $userName   = $_POST['user_name'];
    $email      = $_POST['email'];
    $passWord   = $_POST['pass_word'];
    $rePass     = $_POST['re_pass'];

    $config   = parseFileIni();
    $validate = new Validate($_POST);
    $validate->addElement('name', 'string', $config['minName'], $config['maxName']);
    $validate->addElement('user_name', 'string_number', $config['minUser'], $config['maxUser']);
    $validate->addElement('email', 'email');
    $validate->addElement('pass_word', 'password', $config['minPass'], $config['maxPass']);
    $validate->run();

    $error  = $validate->getErrors();
    $result = $validate->getResults();

    // Save value into Session => fill to value Input
    @$_SESSION['name']       = $result['name'];
    @$_SESSION['user_name']  = $result['user_name'];
    @$_SESSION['email']      = $result['email'];
    @$_SESSION['pass_word']  = $result['pass_word'];

    // Config display error
    if (isset($error['name'])) {
        $error['name']      = "<i style='padding-left:5px; font-size: 13px; color: red'>Họ tên " . $error['name'] . "</i>";
    }
    if (isset($error['user_name'])) {
        $error['user_name'] = "<i style='padding-left:5px; font-size: 13px; color: red'>Tên đăng nhập " . $error['user_name'] . "</i>";
    }
    if (isset($error['email'])) {
        $error['email']     = "<i style='padding-left:5px; font-size: 13px; color: red'>" . $error['email'] . "</i>";
    }

    // Check Error Re-Password
    if (!empty($rePass)) {
        if ($rePass != $passWord) {
            $error['re_pass'] = "<i style='padding-left:5px; font-size: 13px; color: red'>Mật khẩu không khớp!</i>";
        }
    } else {
        $error['re_pass']   = "<i style='padding-left:5px; font-size: 13px; color: red'>Vui lòng nhập lại mật khẩu!</i>";
    }

    // Check Error Password
    if (isset($error['pass_word'])) {
        $error['pass_word'] = "<i style='padding-left:5px; font-size: 13px; color: red'>Mật khẩu " . $error['pass_word'] . "</i>";
        $rePass = "";
    }

    if(isset($_POST['g-recaptcha-response'])){
        $secretKey  = '6Lf-j1YeAAAAAAwQIaCoZQ8IYNEPzAit0OLtvvDO';
        $response   = $_POST['g-recaptcha-response'];
        $remoteIP   = $_SERVER['REMOTE_ADDR'];
        $url        = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIP";
        $data       = file_get_contents($url);
        $row        = json_decode($data, true);
        if($row['success'] == false){
            $error['g-recaptcha'] = "<i style='padding-left:5px; font-size: 13px; color: red'>Vui lòng xác thực captcha!</i>";
        }
    }

    // Connect Database
    if (checkEmpty($error)) {
        // Encrypt password before add account
        $db = new Database();
        $sql = "SELECT * FROM `user` WHERE `username` = '" . $userName . "' ";
        $resultSQL = $db->query($sql);
        if (mysqli_num_rows($resultSQL)) {       // If return result => exist Username
            $_SESSION['existUsername'] = 'Tên đăng nhập đã tồn tại!';
            mysqli_free_result($resultSQL);
            header("Location: register.php");
            exit();
        } else {
            $passWord = md5($passWord);
            $query = "INSERT INTO `user`(`name`, `username`, `email`, `password`) VALUES ('".$name."', '".$userName."', '".$email."', '".$passWord."')";
            $db->query($query);
            $_SESSION['Register_success'] = 'Đăng ký thành công!';
            mysqli_free_result($resultSQL);
            header("Location: login.php");
            exit();
        }
    }
}

?>

<!-- Register form -->
<meta charset=utf-8 />
<style>
    input[type=text],
    input[type=password] {
        width: 100%;
        box-sizing: border-box;
        border: none;
        border-bottom: 1px solid black;
    }
</style>

<body style="background-image: url('images/bg-register.jpg'); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light mt-5 p-4" style="border-radius: 25px; border: 3px solid rgba(0, 0, 0, .5);">
                    <form method="POST" class="row g-3">
                        <h1 class="text-center font-monospace fw-bold">Quizz App</h1>
                        <h5 class="text-center font-arial text-muted">Tạo tài khoản Quizz App ngay!</h5>
                        <div class="col-12">
                            <?php
                            //If exist this session => show alert(existUsername)
                            if (isset($_SESSION['existUsername'])) {
                                echo '<div style="position: absolute; top: 10px; right: 10px" class="alert alert-danger" id="exist-alert" role="alert">' . $_SESSION['existUsername'] . '</div>';
                            }
                            ?>
                            <div class="form-group row">
                                <label for="icon_name" class="col-sm-1 col-form-label"><img style="width: 22px" src="images/icons/name.png" alt="icon_name"></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control-plaintext ms-2" autocomplete="off" style="outline: none;" value="<?= @$_SESSION['name'] ?>" placeholder="Họ tên" data-toggle="tooltip" data-placement="right" title="Họ tên phải là chữ" />
                                    <?= @$error['name'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <label for="icon_user" class="col-sm-1 col-form-label"><img style="width: 24px" src="images/icons/user.png" alt="icon_user"></label>
                                <div class="col-sm-10">
                                    <input type="text" name="user_name" class="form-control-plaintext ms-2" autocomplete="off" style="outline: none;" value="<?= @$_SESSION['user_name'] ?>" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="right" title="Tên đăng nhập không được chứ các ký tự đặc biệt như $%&*()}{@#~?><>,|=+" />
                                    <?= @$error['user_name'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <label for="icon_email" class="col-sm-1 col-form-label"><img style="width: 23px" src="images/icons/email.png" alt="icon_email"></label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" class="form-control-plaintext ms-2" autocomplete="off" style="outline: none;" value="<?= @$_SESSION['email'] ?>" placeholder="Email" />
                                    <?= @$error['email'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <label for="icon_pass" class="col-sm-1 col-form-label"><img style="width: 23px" src="images/icons/locked.png" alt="icon_pass"></label>
                                <div class="col-sm-10">
                                    <input type="password" name="pass_word" class="form-control-plaintext ms-2" autocomplete="off" style="outline: none;" value="<?= @$_SESSION['password'] ?>" placeholder="Mật khẩu" />
                                    <?= @$error['pass_word'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <label for="icon_repass" class="col-sm-1 col-form-label"><img style="width: 23px" src="images/icons/unlocked.png" alt="icon_repass"></label>
                                <div class="col-sm-10">
                                    <input type="password" name="re_pass" class="form-control-plaintext ms-2" autocomplete="off" style="outline: none;" value="<?= @$rePass ?>" placeholder="Nhập lại mật khẩu" />
                                    <?= @$error['re_pass']; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Recaptcha -->
                        <div class="col-12">
                            <div class="g-recaptcha" data-sitekey="6Lf-j1YeAAAAAFb3o5-HWAktD9cVyg30Cvpoktka"></div>
                            <?= @$error['g-recaptcha']; ?>
                        </div>

                        <div class="d-grid gap-2 col-12 mt-4">
                            <input type="submit" name="register" class="btn btn-dark rounded-pill border border-1" value="Register">
                            <div class="text-center">Bạn đã có tài khoản?
                                <a href="login.php" class="text-decoration-none">Đăng nhập</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php session_destroy(); ?>

<!-- script Tooltip bootstrap 5 -->
<script type="text/javascript">
    $(document).ready(function() {
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Fade Alert
        $("#exist-alert").fadeTo(3000, 500).slideUp(500, function() {
            $("#exist-alert").slideUp(500);
        });
    });
</script>