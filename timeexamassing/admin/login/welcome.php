<?php
include_once("../includes.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Website title -->
<title><?php echo SITENAME; ?></title>
<!--Attached css-->
<link href="<?php echo SITEROOT ?>/admin/css/main.css" rel="stylesheet" type="text/css" />
<!--Attached fevicon-->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEROOT ?>/admin/images/favicon.ico" />
</head>
<body>
<!-- main continer of the page -->
<div id="loginwrapper">
  <h1 id="logo1"><a href="#">&nbsp;</a></h1>
  <div class="loginbox">
    <div class="top1">
      <div>&nbsp;</div>
    </div>
    <div class="bg1">
      <form method="post">
        <div class="loginCont">
          <h3 class="mainhead">LOGIN</h3>
          <div class="clr"></div>
          <?php echo '<div>'. $error .'</div>'; ?>
          <ul class="reset listing">
            <li>
              <label class="label fl">Username:</label>
              <div class="field">
                <input value="" name="txt_username" id="txt_username" type="text" />
              </div>
            </li>
            <li>
              <label class="label fl">Password:</label>
              <div class="field">
                <input value="" type="password" name="txt_password" id="txt_password" />
              </div>
            </li>
            <li>
              <label class="label fl">&nbsp;</label>
              <div class="fl ovfl-hidden">
                <label class="fl margiTop">
                  <input type="checkbox" />
                  &nbsp; <a href="#">Remember Me</a></label>
              </div>
            </li>
            <li>
              <label class="label fl">&nbsp;</label>
              <div class="fl ovfl-hidden" style="padding-top:10px;">
                <div class="button fr">
                  <input type="submit" name="btn_submit" value="Login"  />
                </div>
              </div>
            </li>
          </ul>
        </div>
      </form>
      <div class="clr">&nbsp;</div>
    </div>
    <div class="end1">
      <div>&nbsp;</div>
    </div>
  </div>
</div>
</body>
</html>
