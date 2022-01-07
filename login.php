<?php include_once("head.php") ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="login-form bg-light mt-5 p-4">
                <form action="#" method="POST" class="row g-3">
                    <h1 class="text-center font-monospace fw-bold">Quizz App</h1>
                    <h5 class="text-center font-arial text-muted">Welcome Back !</h5>

                    <div class="col-12"> 
                        <input type="text" name="username" class="form-control mt-1 rounded-pill border border-2" placeholder="User Name" required />
                    </div>
                    <div class="col-12">
                        <input type="password" name="password" class="form-control mt-1 rounded-pill border border-2" placeholder="Password" required />
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" />
                            <label class="form-check-label" for="rememberMe"> Remember me</label>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-12 mt-4">
                        <input type="submit" class="btn btn-dark rounded" value="Login">
                        <p class="text-center">Don't have an account yet?&nbsp;
                            <a href="register.php" class="text-decoration-underline">Register</a>
                        </p>
                    </div> 

                </form>
            </div>
        </div>
    </div>
</div>
