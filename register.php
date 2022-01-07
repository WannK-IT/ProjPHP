<?php include_once "head.php";
require_once "config/db.class.php";
require_once "functions.php";
?>
<?php
if (isset($_POST['register'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $userName = $_POST['user_name'];
    $email = $_POST['email'];
    $passWord = md5($_POST['pass_word']);
    if (isset($firstName) && isset($lastName) && isset($userName) && isset($email) && isset($passWord)) {
        // kiểm tra chiều dài First Name, Last Name


        // connect database
        $db = new Database();
        // $query = "INSERT INTO `user`(`firstname`, `lastname`, `username`, `email`, `password`) VALUES ('$firstName', '$lastName', '$userName', '$email', '$passWord')";
        // if(!$db->query($query)){
        //     echo '<script type="text/javascript">alert("Fail to create an account!")</script>';
        // }else{
        //     echo '<script type="text/javascript">alert("Account Created Successfully!")</script>';
        // }
    }

    //sau khi query => reset tất cả giá trị biến $_POST
    // echo "<meta http-equiv='refresh' content='0'>";
    // mysqli_close($db);
}
?>
<!-- Register form -->
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="login-form bg-light mt-5 p-4">
                <form action="#" method="POST" class="row g-3">
                    <h1 class="text-center font-monospace fw-bold">Quizz App</h1>
                    <h5 class="text-center font-arial text-muted">Let's create an account !</h5>

                    <div class="col-12">
                        <input type="text" name="first_name" class="form-control mt-1 rounded-pill border border-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="First Name is not include symbols or special characters" placeholder="First Name" />
                    </div>
                    <!-- data-bs-toggle="tooltip" data-bs-placement="bottom" title="First Name is not include symbols or special characters" -->
                    <div class="col-12">
                        <input type="text" name="last_name" class="form-control mt-1 rounded-pill border border-2" placeholder="Last Name" />
                    </div>

                    <div class="col-12">
                        <input type="text" name="user_name" class="form-control mt-1 rounded-pill border border-2" placeholder="User Name" />
                    </div>

                    <div class="col-12">
                        <input type="text" name="email" class="form-control mt-1 rounded-pill border border-2" placeholder="Email" />
                    </div>

                    <div class="col-12">
                        <input type="text" name="pass_word" class="form-control mt-1 rounded-pill border border-2" placeholder="Password" />
                    </div>

                    <div class="col-12">
                        <input type="text" name="re_pass" class="form-control mt-1 rounded-pill border border-2" placeholder="Repeat your password" />
                    </div>

                    <div class="d-grid gap-2 col-12 mt-4">
                        <input type="submit" name="register" class="btn btn-dark rounded" value="Register">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- script Tooltip bootstrap 5 -->
<script type="text/javascript">
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>