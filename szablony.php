<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
 <link rel="stylesheet" href="style.css" type="text/css">
 
 
</head>
<body>
<div id="page-wrapper">
	<div class="container-fluid">
		
		
				
					<?php
		if($settings->twofa == 1){
		$twoQ = $db->query("select twoKey from users where id = ? and twoEnabled = 0", [$userdetails->id]);
		if($twoQ->count() > 0){ ?>
			<p><a class="btn btn-primary " href="enable2fa.php" role="button">Manage 2 Factor Auth</a></p>
	<?php	} else { ?>
			<p><a class="btn btn-primary " href="disable2fa.php" role="button">Manage 2 Factor Auth</a></p>
	<?php }}
	if(isset($_SESSION['cloak_to'])){ ?>
		<form class="" action="account.php" method="post">
			<input type="submit" name="uncloak" value="Uncloak!" class='btn btn-danger'>
		</form><br>
		<?php }
		?>
	
	
		<?//=echousername($user->data()->id)?>
		<?php  
		$jakie_konto=echousername($user->data()->id);
		//echo $konto;
		?>
		
		<div>
		
			<h2 align="center">Wybierz szablon, aby stworzyć CV</h2>
		
			<?php
			//zapytanie sprawdzające czy w bazie istnieje już jakieś cv użytkownika
				$zapytanie=$db->query("SELECT * FROM szablony");
				
				$licznik=0;
				
				
				echo "<table border=0 style='margin-left:auto; margin-right:auto; border-collapse: separate; border-spacing: 15px;'>";
						 foreach ($db->results() as $record)
						 {
							if($licznik%3==0)
							{
							echo "<tr>";
							}
							
							
							
							echo "<td style='width:200px;height:250px;'>";
							//echo $record->nazwa_szablonu;
							echo "<a href='nowe_cv.php?id=$record->id'><img src='image/$record->grafika' alt='szablon' style='max-width:200px; max-height:250px;'/></a>";
							echo "</td>";
							
							
							$licznik++;
							if($licznik%3==0)
							{
							echo "</tr>";
							}
							
							
							}
				echo "</table>";
				
			?><br /><br />
			
		
			<h2 align="center">Własne szablony</h2>
			
			
			<?php
			//zapytanie sprawdzające czy w bazie istnieje już jakieś cv użytkownika
				$zapytanie1=$db->query("SELECT * FROM szablony_wlasne WHERE konto='$jakie_konto'");
				
				$licznik1=0;
				$licznik2=1;
				
				
				echo "<table border=0 style='margin-left:auto; margin-right:auto; border-collapse: separate; border-spacing: 15px;'>";
						 foreach ($db->results() as $record1)
						 {
							if($licznik1%3==0)
							{
							echo "<tr>";
							}
							
							
							$idw=$record1->id;
							echo "<td style='width:200px;height:250px;'>";
							//echo $record->nazwa_szablonu;
							echo "<a style='text-decoration:none;' href='nowe_cv_wlasne.php?idw=$idw'><div style='width:200px; height:250px; background-color:grey'><h3 style='color:black; text-align:center;'><br />Custom Template   <br /><br />$record1->nazwa</h3></div>";
							echo "</td>";
							
							
							$licznik1++;
							$licznik2++;
							if($licznik%3==0)
							{
							echo "</tr>";
							}
							
							
							}
							
							echo "<tr>";
							echo "<td style='width:200px;height:250px;'><a href='szablony_dodaj.php'><img style='max-width:200px; max-height:250px;' src='image/template_add.jpg'></a></td>";
							
							echo "<td style='width:200px;height:250px;'><a href='szablony_edytuj_ustawienia.php'><img style='max-width:200px; max-height:250px;' src='image/template_edit.jpg'></a></td>";
							
							echo "</tr>";
							
				echo "</table>";
				
			?><br /><br />
			
			
		
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
