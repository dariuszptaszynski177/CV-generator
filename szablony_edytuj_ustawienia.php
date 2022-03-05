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
		$db = DB::getInstance();
		?>
		
		<?php
		
		
		
		//echo $data;
		//echo $nazwa;
		
		?>
		
		<div>
		
				<?php
				
				$wyswietl_wlasne_szablony=$db->query("SELECT * FROM szablony_wlasne WHERE konto='$jakie_konto'");
				
				echo "<table border=1>";
				echo "<tr><td>Id.</td><td>Nazwa szablonu</td><td>Data dodania</td><td>Ustawienie danych osobowych</td><td>Kolor nagłówków</td><td>Ustawienie nagłówków</td><td>Edycja</td></tr>";
				
				$id_temp=1;
				
				foreach ($db->results() as $record)
				{
					$id=$record->id;
					echo "<tr>";
					echo "<td>$id_temp</td>";
					echo "<td>$record->nazwa</td>";
					echo "<td>$record->dodano</td>";
					echo "<td>$record->ustawienie_danych_osobowych</td>";
					echo "<td>$record->kolor_naglowkow</td>";
					echo "<td>$record->ustawienie_naglowkow</td>";
					echo "<td><a href='szablony_edytuj_ustawienia_szablonu.php?id=$id'>Edytuj</a></td>";
					
					echo "</tr>";
					$id_temp++;
					
				}
				
				echo "</table>";
				?>
				
				
		
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
