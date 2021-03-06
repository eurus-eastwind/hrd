<?php
session_start();

# This is for an user trying to access login.php
# but still trying to access the file 
if(isset($_SESSION["auth"]))
{
    $_SESSION["message"] = "You are already logged in!";
    header("Location: index.php");
    exit(0);
}
include("includes/header.php");
include("includes/navbar.php");
?>

<div id="intro" class="bg-image shadow-2-strong">
    <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container w-100 p-3 h-75 d-inline-block">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <?php include("message.php"); ?>

                    <div class="card">
                        <div class="card-header"><h3 class="text-center font-weight-light my-3">Register</h3>
                        </div>

                        <div class="card-body">
                            <form  class="row g-2" action="register_code.php" method="POST">
                            
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control"  name="fname" id="inputFirstName" required type="text" placeholder="Enter your first name" />
                                        <label for="inputFirstName">First name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="lname" id="inputLastName" required type="text" placeholder="Enter your last name" />
                                        <label for="inputLastName">Last name</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="email" id="inputEmail" required type="email" placeholder="name@example.com" />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="phone" id="inputPhone" required type="tel" placeholder="Enter your Phone Number" />
                                        <label for="inputPhone">Phone Number</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="password" id="inputPassword" required type="password" placeholder="Create a password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="confirm_password" id="inputPasswordConfirm" required type="password" placeholder="Confirm password" />
                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="g-recaptcha" data-sitekey="6LcFHIMeAAAAAI89xQ1-Cf2qGskDmANU8ROJsFBD"></div>
                                    <br>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" name="register_btn" class="btn btn-primary btn-block">Register Now</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                        </div>          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

include("includes/footer.php");

?>