//If exist this session => show alert(register_success)
                            if (isset($_SESSION['loginFail'])) {
                                echo '<div style="position: absolute; top: 10px; right: 10px" class="alert alert-danger" id="loginFail" role="alert">' . $_SESSION['loginFail'] . '</div>';
                            }