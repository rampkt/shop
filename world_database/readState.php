<?php
error_reporting(0);
require_once("config/config.php");
//$db_handle = new DBController();
if(!empty($_POST["keyword"])) {

$country=$_REQUEST['country'];
	
$query ="SELECT * FROM states WHERE cid='".$country."' and name like '" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = $db->query($query);
if(!empty($result)) {
?>
<ul id="state-list">
<?php
foreach($result as $state) {
?>
<li onClick="selectstate('<?php echo $state["name"]; ?>','<?php echo $state["id"]; ?>');"><?php echo $state["name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>