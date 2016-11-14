<?php
error_reporting(E_ALL ^ E_NOTICE);


?>
<style type="text/css">
.mainDiv {
	margin:20px;
}
.heading {
	padding:0px;
	border-bottom:1px solid #CCCCCC;
}
</style>
<div class="mainDiv">
  <div title="Database Connection">
    <h4 class="heading">DATABASE CONNECTION</h4>
    <?php 
highlight_string(
'<?php 
	$db = new Zend_Db_Adapter_Pdo_Mysql(array(
		"host"     => "127.0.0.1",
		"username" => "root",
		"password" => "",
		"dbname"   => "framework"
		)
	);
?>');
?>
  </div>
  <div title="Inserting Data">
    <h4 class="heading">Inserting Data</h4>
    <?php 
highlight_string(
'<?php 
	//INSERT INTO TABLE 
	$userdata["firstname"] = "John Doe";
	$userdata["email"] = "john.doe@gmail.com";
	$userdata["password"] = "123456";
	$db->insert("user", $userdata);
	$id = $db->lastInsertId();
?>');
?>
	<h5>Using Zend_Db_Table_Abstract Example #1</h5>
    <?php 
highlight_string(
'<?php
	// Create a User class and extends Zend_Db_Table_Abstract to your User class
	class User extends Zend_Db_Table_Abstract
	/* INSERT INTO TABLE */
	$user = new Admin_User($db);
	$userdata["firstname"] = "Mohan Ranuse";
	$userdata["email"] = "amol.sananse@gmail.com";
	$userdata["password"] = "123456";
	$user->insert($userdata);
?>');
?>


	<h5>Using Zend_Db_Table_Abstract Example #2 with create row object</h5>
    <?php 
highlight_string(
'<?php
	// Create a User class and extends Zend_Db_Table_Abstract to your User class
	class User extends Zend_Db_Table_Abstract
	/* INSERT INTO TABLE USING ZEND_DB_TABLE_ABSTRACT */
	$user = new Admin_User($db);
	$newRow = $user->createRow();
	$newRow->firstname = "Mukesh";
	$newRow->lastname = "Rane";
	$newRow->email = "amol.sananse@gmail.com";
	$newRow->password = "123456";
	$newRow->save();
?>');
?>

  </div>
  <div title="Updating Data">
    <h4 class="heading">Updating Data</h4>
    <?php 
highlight_string(
'<?php 
	//UPDATE DATA
	$userdata["firstname"] = "John Doe";
	$userdata["email"] = "john.doe@gmail.com";
	$userdata["password"] = "123456";
	$where["UID = ?"] = 5;
	$db->update("user", $userdata, $where);
?>');
?>
	<h5>Using Zend_Db_Table_Abstract</h5>
    <?php 
highlight_string(
'<?php
	// Create a User class and extends Zend_Db_Table_Abstract to your User class
	class User extends Zend_Db_Table_Abstract
	/* Updating Rows in a Table */
	$user = new Admin_User($db);
	$userdata1["firstname"] = "Prakash Shinde";
	$userdata1["email"] = "amol.sananse@gmail.com";
	$where = $user->getAdapter()->quoteInto("UID = ?", 6);
	$user->update($userdata1, $where);
?>');
?>

  </div>
  <div title="Deleting Data">
    <h4 class="heading">Deleting Data</h4>
    <?php 
highlight_string(
'<?php 
	$n = $db->delete("user", "UID = 5");
?>');
?>
	<h5>Using Zend_Db_Table_Abstract</h5>
    <?php 
highlight_string(
'<?php 
	/* Deleting Rows from a Table */
	$user = new Admin_User($db);
	$where = $user->getAdapter()->quoteInto("UID = ?", 6);
	$user->delete($where);
?>');
?>
  </div>
  <div title="Select Example #1">
    <h4 class="heading">SELECT EXAMPLE # 1</h4>
    <?php 
highlight_string(
'<?php 
	/* SELECT EXAMPLE # 1 */
	$sql = "SELECT * FROM user WHERE UID = ?";
	$result = $db->fetchAll($sql, 1);
	//echo "<pre>"; print_r($result); echo "</pre>";
?>');
?>
  </div>
  <div title="Select Example # 2">
    <h4 class="heading">SELECT EXAMPLE # 2 </h4>
    <?php 
highlight_string(
'<?php 
	/* SELECT EXAMPLE # 2 */
    $selectUser = $user->select();
    $selectUser->from("user", array("UID", "firstname"));
    $selectUser->where("user.UID=?", 1);
    $userRow = $user->fetchRow($selectUser);
    echo "<pre>";print_r($userRow);echo "</pre>"; exit;
?>');
echo '<br>';
highlight_string(
'<?php 
	/* SELECT EXAMPLE # 2 */
	$select = $addressbook->select();
	$select->setIntegrityCheck(false);
	$select->from("address", array("address.address_id", "address.UID", "address.firstname"));
	$select->join(array("country", "country"), "country.country_id=address.country_id_fk", array("country.country_name"));
	$select->where("address.address_id=?", 1);
	echo $select->__toString(); exit;
?>');

?>
  </div>
  <div title="Select Example # 3 (Creating a Statement)">
    <h4 class="heading">SELECT EXAMPLE # 3 (Creating a Statement) </h4>
<?php 
highlight_string(
'<?php 
	/* SELECT EXAMPLE # 3 */
	$stmt = $db->query("select * from product where name like ? and urlkey like ?", array("%sony%", "%sony%"));
	$row = $stmt->fetchAll();
	echo "<pre>"; print_r($row);
?>');
?>
<?php 
echo '<br>';
highlight_string(
'<?php 
	/* SELECT EXAMPLE # 3 FETCH SINGLE ROW */
	$deal_stmt = $db->query("select * from fd_deal where deal_id=?", $edit_id);
	$deal_row = $deal_stmt->fetch();
	echo "<pre>"; print_r($row);
?>');
?>
<?php 
echo '<br>';
highlight_string(
'<?php 
	/* SELECT EXAMPLE # 3 FETCH SINGLE ROW WITH SELECT STMT */
	/* Reference url: http://framework.zend.com/manual/1.12/en/zend.db.select.html */
	$select = $db->select()->from("mts_user")->where("UID=?",1);
	$stmt = $select->query();
	$row = $stmt->fetch();
	echo "<pre>"; print_r($row); exit;
?>');
?>



  </div>
  <div title="Select Examples Using Zend_Db_Table_Abstract">
    <h4 class="heading">Select Examples Using Zend_Db_Table_Abstract</h4>
    <?php 
highlight_string(
'<?php 
	/* Finding Rows by Primary Key */
	$user = new Admin_User($db);
	// Find a single row
	// Returns a Rowset
	$rows = $user->find(2);
	$rowArray = $rows->toArray();
	//echo "<pre>"; print_r($rowArray);exit; echo "</pre>";
	
	
	/* ------------------------------------------------------------ */
	
	
	// Find multiple rows
	// Also returns a Rowset
	$user = new Admin_User($db);
	$rows = $user->find(array(4, 2, 3));
	$rowArray = $rows->toArray();
	//echo "<pre>"; print_r($rowArray);exit; echo "</pre>";
	
	
	/* ------------------------------------------------------------ */
	
	
	$user = new Admin_User($db);
	$rows = $user->fetchAll($user->select()->where("ID=?", "2"));
	$rowArray = $rows->toArray();
	//echo "<pre>"; print_r($rowArray[0]["fullname"]);exit; echo "</pre>";
	
	
	/* ------------------------------------------------------------ */
	
	//Write a function in user class
	public function findByEmailid($emailid) {
		$where = $this->getAdapter()->quoteInto("email = ?", $emailid);
		return $this->fetchAll($where, "email");
	}
	
	//Create object and call function
	$user = new Admin_User($db);
	$rows = $user->findByEmailid("amol.sananse@gmail.com");
	$rowArray = $rows->toArray();
	//echo "<pre>"; print_r($rowArray[0]["fullname"]);exit; echo "</pre>";
	
?>');
?>
  </div>
  <div title="Zend pagination">
    <h4 class="heading">ZEND PAGINATION</h4>
    <?php 
highlight_string(
'<?php 
	$pageNo = (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;
	$select = $db->select()
				 ->from("product")
				 ->where("1");
	
	$paginator = Zend_Paginator::factory($select);
	$paginator->setCurrentPageNumber($pageNo);
	$paginator->setItemCountPerPage(30);
	$paginator->setPageRange(10);
	
	?><ul><?php
	foreach ($paginator as $item) {
		echo "<li>" . $item["name"] . "</li>";
	}
	?></ul>
	
	/* paginationcontrol.php */	
	<?php if ($paginator->getPages()->pageCount): ?>
	<div class="paginationControl">
	
	<!-- Previous page link -->
	<?php if (isset($paginator->getPages()->previous)): ?>
	<a href="?page=<?php echo $paginator->getPages()->previous; ?>">
	&lt; Previous
	</a> |
	<?php else: ?>
	<span class="disabled">&lt; Previous</span> |
	<?php endif; ?>
	<!-- Numbered page links -->
	<?php foreach ($paginator->getPages()->pagesInRange as $page): ?>
	<?php if ($page != $paginator->getPages()->current): ?>
	<a href="?page=<?php echo $page; ?>">
	<?php echo $page; ?>
	</a> |
	<?php else: ?>
	<?php echo $page; ?> |
	<?php endif; ?>
	<?php endforeach; ?>
	<!-- Next page link -->
	<?php if (isset($paginator->getPages()->next)): ?>
	<a href="?page=<?php echo $paginator->getPages()->next; ?>">
	Next &gt;
	</a>
	<?php else: ?>
	<span class="disabled">Next &gt;</span>
	<?php endif; ?>
	</div>
	<?php endif; ?>
');
?>
  </div>
  <div title="Try Catch Block">
    <h4 class="heading">Try Catch Block</h4>
    <?php 
highlight_string(
'<?php 
	try {
		## write your code here if there is any issue then error msg will be handeled in catch statement ##
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());}
?>
');
?>
  </div>
  <div title="Send Email With Attachment">
    <h4 class="heading">Send email with attachment</h4>
    <?php 
highlight_string(
'<?php 
		/*
			- send email to user
			- attach pdf to that email
		*/
		$mail = new Zend_Mail();
		$mail->setBodyHtml("email body");
		$mail->setFrom("mindtrickssoftware@gmail.com", "Mindtricks Software");
		$mail->addTo("To Email", "To Name");
		$mail->setSubject("email subject");
		
		$filecontent = file_get_contents("your file path"); // e.g. ("attachment/abc.pdf")
		$attachment = new Zend_Mime_Part($filecontent);
		$attachment->type = "application/pdf";
		$attachment->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
		$attachment->encoding = Zend_Mime::ENCODING_BASE64;
		$attachment->filename = "your file name"; // name of file
		
		$mail->addAttachment($attachment);                  
		
		$mail->send(); 
		
		/*
			- jQuery how to add more parameters in serialize array
		*/
		
		var data = $("#myForm").serializeArray();
		data.push({name: "wordlist", value: wordlist});
		
?>
');
?>
  </div>

</div>