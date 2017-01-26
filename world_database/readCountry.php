<?php
error_reporting(0);
require_once("config/config.php");
//$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM countries WHERE name like '" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = $db->query($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["name"]; ?>','<?php echo $country["id"]; ?>');"><img src="flags/<?php echo $country["name"].".png"; ?>">&nbsp;<?php echo $country["name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>