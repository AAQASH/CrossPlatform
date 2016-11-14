<?php
include_once('../bootstrap.php');
	
	if((int)$_SESSION['admin_user_id'] > 0){
		redirect(SITEROOT ."/admin/welcome.php");
	}

	if(is_array($_POST) && sizeof($_POST) > 0){
		
		if($T->Check()) {
			$txt_username = $input->post('txt_username');
			$txt_password = $input->post('txt_password');
			$error = "";
			
			if(strlen($txt_username) < 1 && strlen($txt_password) < 1){
				$error = "Invalid Email-Id or Password.";
			}//if
			//echo '<pre>'; print_r($_POST); exit;
			if(strlen(trim($txt_username)) > 0 && strlen(trim($txt_password)) > 0){
				$sqlLogin = 'SELECT user.UID, user.email, user.username, user.firstname, user.lastname, user.account_type_id_fk, account_type.accounttype
							FROM mts_user as user
							LEFT JOIN mts_account_type as account_type
							ON (account_type.account_type_id=user.account_type_id_fk)
							WHERE user.email=? and user.password=? and user.is_verified=1 AND user.is_active=1';
				$dbLogin = $db->fetchRow($sqlLogin, array($txt_username, md5($txt_password)));
				//echo '<pre>'; print_r($dbLogin); exit;
				if(is_array($dbLogin) && sizeof($dbLogin) > 0){
					$_SESSION['admin_user_id'] 		= $dbLogin['UID'];
					$_SESSION['admin_username']		= $dbLogin['username'];
					$_SESSION['admin_firstname']	= $dbLogin['firstname'];
					$_SESSION['admin_lastname']		= $dbLogin['lastname'];
					$_SESSION['admin_email']		= $dbLogin['email'];
					$_SESSION['account_type_id_fk'] = $dbLogin['account_type_id_fk'];
					$_SESSION['accounttype'] 		= $dbLogin['accounttype'];
					redirect(SITEROOTADMIN);
					exit;
				}else{
					$error = "Invalid Email-Id or Password.";
				}//if
			}else{
				$error = "Invalid Email-Id or Password.";
			}//if
		}//if token
	}//if

?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php include_once("admin/templates/header-end.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#txt_username").focus();
});
</script>
<?php //include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->

<div id="maincont" class="ovfl-hidden">
  <div id="loginwrapper" style="padding-top:50px;">
    <?php 
if(strlen($error) > 0){ 
	echo '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" id="loginbox"><div class="'.($classname == 'alert alert-success' ? $success : 'alert alert-danger').'">'. $error .'</div></div>'; 
}?>
    <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" id="loginbox">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">Sign In</div>
          <!--<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>-->
        </div>
        <div class="panel-body" style="padding-top:30px">
          <div class="alert alert-danger col-sm-12" id="login-alert" style="display:none"></div>
          <form enctype="multipart/form-data" name="loginForm" method="post">

            <?php echo $T->protectForm(); ?>
            <div class="input-group" style="margin-bottom: 25px"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input type="text" placeholder="Email-Id" value="" name="txt_username" class="form-control" id="txt_username">
            </div>
            <div class="input-group" style="margin-bottom: 25px"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" placeholder="Password" name="txt_password" class="form-control" id="txt_password">
            </div>
            <!--<div class="input-group">
              <div class="checkbox">
                <label>
                <input type="checkbox" value="1" name="remember" id="login-remember">
                Remember me </label>
              </div>
            </div>-->
            <div class="form-group" style="margin-top:10px">
              <!-- Button -->
              <div class="controls pull-right">
                <input type="submit" class="btn btn-default" name="btn_submit" value="Sign In" tabindex="5"  />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/templates/footer.php"); ?>
