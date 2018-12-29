<?php require('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); exit(); }

require('includes/db/database.php');

//define page title
$title = 'Members Page';

//include header template
require('layout/header.php');
require('layout/navbar.html');
echo('
<div style="height: 40px;">
<h2> Explorer </h2>
</div>
');

echo'
<div class="searchbar">
<form method="get">
<table class="invis">
<tr class="invis">
<td class="invis" style="padding-left: 5px;">
<input class="quickmove" style="border-radius: 8px 8px 8px 8px;"  type="text" name="value" placeholder="search term" required autofocus>
</td>
<td class="invis" style="width: 5%;
padding-left: 10px;">
  <select name="by">
    <option value="UID">ID</option>
    <option value="NAME">name</option>
    <option value="PID">stored in</option>
    <option value="PRICE">Preis</option>
    <option value="EXTRA">Extra</option>
  </select>
  </td>
<td class="invis" style="width: 7%;">
  <input type="submit" value="search" class="button">
  </td>
    </tr>
  </table>
</form>
</div>




';

$usname = htmlspecialchars($_SESSION['username'], ENT_QUOTES);
$sql = "SELECT UID, NAME, PID FROM $usname WHERE {$_GET[by]} LIKE '%{$_GET[value]}%'";


$result = $conn->query($sql);

if ($result->num_rows > 0) {

 //output data of each row
 echo '<table id="table1">';

 echo '<tr class="print"><th class="print">Name</th><th class="print">Unique ID</th><th class="print"> Storage-ID</tr></tr>';

 while($row = $result->fetch_assoc()) {

 echo '

 <tr class="print"><td class="print"><a href="edit.php?FROMURL='.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]. '&UID='.$row["UID"].'&by='.$_GET[by].'&value='.$_GET[value].'">'.$row["NAME"].
 '</a></td><td class = "print">'.$row["UID"].
 '</td><td class = "print"><a href="edit.php?FROMURL='.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]. '&UID='.$row["PID"].'&by='.$_GET[by].'&value='.$_GET[value].'">'.$row["PID"].
 '</a></td></tr>';


}
}


?>
<!--
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

				<h2>Member only page - Welcome <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>
				<p><a href='logout.php'>Logout</a></p>
				<hr>

		</div>
	</div>


</div>
-->



<?php
//include header template
require('layout/footer.php');
?>
