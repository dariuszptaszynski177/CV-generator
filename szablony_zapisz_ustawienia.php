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
		
		<?php
		
		$data=$_POST['data'];
		$nazwa_szablonu=$_POST['nazwa_szablonu'];
		$zdjecie=$_POST['zdjecie'];
		$ustawienie_danych_osobowych=$_POST['ustawienie_danych_osobowych'];
		$kolor_naglowkow=$_POST['kolor_naglowkow'];
		$ustawienie_naglowkow=$_POST['ustawienie_naglowkow'];
		
		
		
	 
	 
	 $update_szablonu=$db->query("UPDATE szablony_wlasne SET zdjecie='$zdjecie', ustawienie_danych_osobowych='$ustawienie_danych_osobowych', kolor_naglowkow='$kolor_naglowkow', ustawienie_naglowkow='$ustawienie_naglowkow'  WHERE dodano='$data' and konto='$jakie_konto' and nazwa='$nazwa_szablonu'");
		
		
		if($update_szablonu==true)
		{
		echo "<h2 style='text-align:center'>Twój szablon został dodany do listy szablonów</h2>";
		echo "<h3 style='text-align:center;'>Kliknij <a href='szablony.php'>TUTAJ</a>, aby przejść do szablonów</h3>";
		
		}
		
		?>
		
		<div>
		
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
