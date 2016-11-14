<?php
include_once('../includes.php');
include_once('admin/setting/combobox/Role.php');
include_once("admin/menu/functions.php");

	define('MODULE_NAME', 'Role_Resource_Management');
	
	if(isAccessable(MODULE_NAME) == FALSE){
		redirectUser();
	}

?>
<?php include_once("admin/commonfiles/header-start.php"); ?>
<link href="<?php echo SITEROOT ?>/templates/<?php echo TEMPLATEDIR ?>/admin/css/adminleftmenu.css" rel="stylesheet" type="text/css" />
<?php
$javascript[] = SITEROOT. "/jquery/jstree/_lib/jquery.cookie.js";
$javascript[] = SITEROOT. "/admin/js/custom_grid_plugin.1.0.js";
$javascript[] = SITEROOT. "/admin/setting/js/role-resource-management.js";

$javascript[] = SITEROOT. "/jquery/jstree/jquery.jstree.js";
?>
<?php include_once("admin/commonfiles/header-end.php"); ?>
<?php include_once("admin/commonfiles/navigation.php"); ?>
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Role/Resource Management</h3>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">
      <div>
        <div class="">
          <table width="100%" border="0" class="form">
            <tr>
              <td><div>
                  <div class="fl">
                    <select name="role" id="role" onchange="javascript:loadRoleResources(this.value);" style="width:250px;">
                      <option value="">--- Select Role ---</option>
                      <?php 
                $options = array("VALUE"=>"account_type_id", "TEXT"=>"accounttype", "SELECTED"=>$account_type_id_fk, "CONDITION"=>" is_active=1 ", "OB"=>"ASC");
                echo RoleCombo::getAllRole($options);
                ?>
                    </select>
                  </div>
                  <div class="fr">
                    <input type="button" name="btnSave" id="btnSave" value="  Save  " class="submitbutton" />
                  </div>
                  <div class="clr"></div>
                </div></td>
            </tr>
          </table>
          <div id="role_resource_management"></div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
  </div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/commonfiles/footer.php"); ?>
