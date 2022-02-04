<?php
include_once "head.php";
require_once "config/db.class.php";
require_once "functions.php";
require_once "config/validate.class.php";
?>
<?php
session_start();
if (isset($_POST['user_name']) && isset($_POST['pass_word'])) {
    $userName   = $_POST['user_name'];
    $passWord   = $_POST['pass_word'];

    $config = parseFileIni();
    $validate = new Validate($_POST);
    $validate->addElement('user_name', 'string_number', $config['minUser'], $config['maxUser']);
    $validate->addElement('pass_word', 'password', $config['minPass'], $config['maxPass']);
    $validate->run();

    $result = $validate->getResults();
    $error = $validate->getErrors();

    // Config display error
    if (isset($error['user_name'])) {
        $error['user_name'] = "<i style='padding-left:5px; font-size: 13px; color: red'>Tên đăng nhập " . $error['user_name'] . "</i>";
    }
    if (isset($error['pass_word'])) {
        $error['pass_word'] = "<i style='padding-left:5px; font-size: 13px; color: red'>Mật khẩu " . $error['pass_word'] . "</i>";
    }

    // Connect DB, Check info user in DB
    if (checkEmpty($error)) {
        $db = new Database();
        $passWord = md5($passWord);
        $sql = "SELECT * FROM `user` WHERE `username` = '".$userName."' AND `password` = '".$passWord."' ";
        $resultSQL = $db->query($sql);

        if (mysqli_num_rows($resultSQL)) {       // If return resultSQL => redirect to page index.php
            mysqli_free_result($resultSQL);
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['loginFail'] = 'Tên đăng nhập hoặc mật khẩu chưa chính xác!';
            mysqli_free_result($resultSQL);
            header("Location: login.php");
            exit();
        }
    }
    // refresh và xóa các biến $_POST nếu query thành công
    // echo "<meta http-equiv='refresh' content='0'>";
}
?>
<style>
    input[type=text],
    input[type=password] {
        width: 100%;
        box-sizing: border-box;
        border: none;
        border-bottom: 1px solid black;
    }
</style>

<body style="background-image: url('images/bg-login.jpg'); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light mt-5 p-4" style="border-radius: 25px; border: 3px solid rgba(0, 0, 0, .5);">
                    <form method="POST" class="row g-3">
                        <h1 class="text-center font-monospace fw-bold">Quizz App</h1>
                        <h5 class="text-center font-arial text-muted">Welcome Back !</h5>
                        <div class="col-12">
                            <?php
                            //If exist this session => show alert(register_success)
                            if (isset($_SESSION['Register_success'])) {
                                echo '<div style="position: absolute; top: 10px; right: 10px" class="alert alert-success" id="register_success" role="alert">' . $_SESSION['Register_success'] . '</div>';
                            }

                            //If exist this session => show alert(loginFail)
                            if (isset($_SESSION['loginFail'])) {
                                echo '<div style="position: absolute; top: 10px; right: 10px" class="alert alert-danger" id="loginFail" role="alert">' . $_SESSION['loginFail'] . '</div>';
                            }
                            ?>
                            <div class="form-group row">
                                <label for="icon_user" class="col-sm-1 col-form-label"><img style="width: 24px" src="images/icons/user.png" alt="icon_user"></label>
                                <div class="col-sm-10">
                                    <input type="text" name="user_name" class="form-control-plaintext ms-2" autocomplete="off" style="outline: none;" value="<?= @$result['user_name'] ?>" placeholder="Tên đăng nhập" />
                                    <?= @$error['user_name'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <label for="icon_pass" class="col-sm-1 col-form-label"><img style="width: 23px" src="images/icons/locked.png" alt="icon_pass"></label>
                                <div class="col-sm-10">
                                    <input type="password" name="pass_word" class="form-control-plaintext ms-2" autocomplete="off" style="outline: none;" value="<?= @$result['pass_word'] ?>" placeholder="Mật khẩu" />
                                    <?= @$error['pass_word'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mx-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" />
                                <label class="form-check-label font-arial" for="rememberMe" style="font-size: 15px;"> Ghi nhớ đăng nhập</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 col-12 mt-4">
                            <input type="submit" class="btn btn-dark rounded" value="Login">
                            <p class="text-center">Tạo tài khoản ngay?
                                <a href="register.php" class="text-decoration-none">Đăng ký</a>
                            </p>
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
        $("#loginFail, #register_success").fadeTo(3000, 500).slideUp(500, function() {
            $("#loginFail, #register_success").slideUp(500);
        });
    });
</script>