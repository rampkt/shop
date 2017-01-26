<?php
error_reporting(0);
require_once("config/config.php");
//$db_handle = new DBController();
if(!empty($_POST["keyword"])) {

$state=$_REQUEST['state'];
	
$query ="SELECT * FROM cities WHERE sid='".$state."' and name like '" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = $db->query($query);
if(!empty($result)) {
?>
<ul id="city-list">
<?php
foreach($result as $city) {
?>
<li onClick="selectcity('<?php echo $city["name"]; ?>','<?php echo $city["id"]; ?>');"><?php echo $city["name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>