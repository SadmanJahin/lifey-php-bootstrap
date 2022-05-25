<?php
ob_start();
require_once("Include/Session.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php

if(isset($_POST["Submit"])){

$Email=mysqli_real_escape_string($ConnectingDB,$_POST["Email"]);

if(empty($Email)){
	$_SESSION["message"]="Email Required";
	Redirect_To("Recover_Account.php");
}elseif(!CheckEmailEkistsOrNot($Email)){
		$_SESSION["message"]="Email not Found";
	Redirect_To("User_Registration.php");	
}
else{
	global $ConnectingDB;
	$Query="SELECT * FROM user_registration WHERE email='$Email'";
	$Execute=mysqli_query($ConnectingDB,$Query);
	if($admin=mysqli_fetch_array($Execute)){
		$admin["lastName"];
		$admin["token"];
 $subject="Reset Password";
 $body='Hi ' .$admin["lastName"]. 'Here is the link to Reset you Password'.'
 http://localhost/lifey/pages/Reset_Password.php?token='.$admin["token"];

// Email Headers
				$SenderEmail = "MIME-Version: 1.0" ."\r\n";
				$SenderEmail .="Content-Type:text/html;charset=UTF-8" . "\r\n";        

$SenderEmail.="From: joyultimates@gmail.com". "\r\n";
 if (mail($Email, $subject, $body, $SenderEmail)) {
                $_SESSION["SuccessMessage"]="Check Email for Resetting Password";
		Redirect_To("Login.php");
                    } else {
                $_SESSION["message"]="Something Went Wrong in mail. http://localhost/lifey/pages/Reset_Password.php?token=".$admin["token"];
	Redirect_To("User_Registration.php");
                    }
}else{
		$_SESSION["message"]="Something Went Wrong in server!";
	Redirect_To("User_Registration.php");
	}
	
	
}

	
}

?>
<?php ?>


<?php
// header.php
include ('header.php');
?>
<div>		
<?php echo Message(); ?>
<?php echo SuccessMessage(); ?></div>
<div id="centerpage">

    <!-- Recover Account -->
<section id="login-form">
    <div class="row m-0">
        <div class="col-lg-4 offset-lg-2">
            <div class="text-center pb-5">
                <h1 class="login-title text-dark">Forgot Password!!</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
                <span class="font-ubuntu text-black-50">Create a new <a href="User_Registration.php">account</a></span>
            </div>
            <div class="upload-profile-image d-flex justify-content-center pb-5">
                <div class="text-center">
                    <img src="<?php echo isset($user['profileImage']) ? $user['profileImage'] : '../images/user_default.png' ; ?>" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <form action="Recover_Account.php" method="post" enctype="multipart/form-data" id="log-form">
                        <fieldset>
                        

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="email" value="" required name="Email" id="email" class="form-control" placeholder="Email*">
                            </div>
                        </div>

                        <div class="submit-btn text-center my-5">
                            <button type="Submit" name="Submit" value="Submit" class="btn btn-warning rounded-pill text-dark px-5">Submit</button>
                        </div>

                       </fieldset>	
                    </form>
                </div>
        </div>
    </div>
</section>
<!-- Recover account -->

    
	</div>
	    
	<?php
    // footer.php
    include ('footer.php');
?>