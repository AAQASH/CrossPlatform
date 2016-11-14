<?php
include_once('bootstrap.php');

	$total_network_users = 0;
	$sql_total_network_users = 'SELECT count(1) as total FROM mts_user WHERE account_type_id_fk=2';
	$result = $db->fetchRow($sql_total_network_users);
	$total_network_users = $result["total"];
	
	$total_admin_users = 0;
	$sql_user_count_1 = "select count(1) as total from mts_user where account_type_id_fk=1";
	$result = $db->fetchRow($sql_user_count_1);
	$total_admin_users = $result["total"];
	
	
	$total_merchant_users = 0;
	$sql_user_count_3 = "select count(1) as total from mts_user where account_type_id_fk=3";
	$result = $db->fetchRow($sql_user_count_3);
	$total_merchant_users = $result["total"];

?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->

<div id="maincont" class="ovfl-hidden">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="vertcal_top">
    <tr>
      <td><div class="coll">
          <div class="topc">
            <h5 class="head2">Admin Dashboard</h5>
            <div class="topcont">
              <div class="membr">
                <div class="first">
                  <div class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">Network</h5>
                    <a href="<?php echo SITEROOT ?>/admin/network/network-list.php" class="dashboardauser"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                <div class="first">
                  <div  class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">Content</h5>
                    <a href="<?php echo SITEROOT ?>/admin/contents/content-page-list.php" class="dashboardcontent"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                <div class="first">
                  <div class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">Master</h5>
                    <a href="<?PHP echo SITEROOT ?>/admin/master/country-list.php" class="dashboardmaster"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                <div class="first">
                  <div class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">Settings</h5>
                    <a href="<?php echo SITEROOT ?>/admin/setting/systememails-list.php" class="dashboardsetting"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                <div class="first">
                  <div class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">Reports</h5>
                    <a href="<?php echo SITEROOT ?>/admin/reports/login-log-list.php" class="dashboardreports"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                
                <div class="first">
                  <div class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">Subscriptions</h5>
                    <a href="<?php echo SITEROOT ?>/admin/newsletter/newsletter-subscriber-list.php" class="dashboardsubscriptions"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                <div class="first">
                  <div class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">Contact Us</h5>
                    <a href="<?php echo SITEROOT ?>/admin/reports/contact-us-list.php" class="dashboardcontactus"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                
                <div class="first">
                  <div class="top1">
                    <div>&nbsp;</div>
                  </div>
                  <div class="bg1">
                    <h5 class="important">FAQ</h5>
                    <a href="<?php echo SITEROOT ?>/admin/contents/faq-list.php" class="dashboardfaq"></a></div>
                  <div class="end1">
                    <div>&nbsp;</div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div></td>
      <td width="15">&nbsp;</td>
      <td width="237"><div class="colr">
          <div class="">
            <h5 class="head4">Quick Status</h5>
            <div class="frmc">
              <table width="100%" cellpadding="0" cellspacing="0" class="tblformat">
                <tr>
                  <th>Statistics </th>
                  <th>Total</th>
                </tr>
                <tr>
                  <td>Network Users </td>
                  <td><?php echo $total_network_users ?></td>
                </tr>
                
                <tr>
                  <td>Admin Users </td>
                  <td><?php echo $total_admin_users ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div></td>
    </tr>
  </table>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/templates/footer.php"); ?>
