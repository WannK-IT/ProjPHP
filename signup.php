<?php   include_once "layout/head.php";
        require_once "config/db.class.php";
        require_once "functions.php";
?>
<?php 
    if(isset($_POST['signup'])){
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $userName = $_POST['user_name'];
        $email = $_POST['email'];
        $passWord = md5($_POST['pass_word']);
        if(isset($firstName) && isset($lastName) && isset($userName) && isset($email) && isset($passWord)){
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
        echo "<meta http-equiv='refresh' content='0'>";
        mysqli_close($db);
    }
?>
<!-- Sign up form -->
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form action="#" method="POST" class="register-form" id="register-form">
                    <div class="form-group">
                        <label for="first_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="first_name" id="first_name" placeholder="First Name" required/>
                    </div>

                    <div class="form-group">
                        <label for="last_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" required/>
                    </div>

                    <div class="form-group">
                        <label for="user_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="user_name" id="user_name" placeholder="User Name" required/>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Email" required/>
                    </div>

                    <div class="form-group">
                        <label for="pass_word"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass_word" id="pass_word" placeholder="Password" required/>
                    </div>

                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required/>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                    </div>

                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                <a href="signin.php" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>


