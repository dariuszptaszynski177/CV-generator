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
		$konto=echousername($user->data()->id);
		//echo $konto;
		?>
		
		<?php
		
				$imie=$_POST['imie'];
				$nazwisko=$_POST['nazwisko'];
				$data_ur=$_POST['data_ur'];
				$miasto=$_POST['miasto'];
				$email=$_POST['email'];
				$telefon=$_POST['telefon'];
				$motto=$_POST['motto'];
				$doswiadczenie=$_POST['doswiadczenie'];
				$wyksztalcenie=$_POST['wyksztalcenie'];
				$jezyki=$_POST['jezyki'];
				$zainteresowania=$_POST['zainteresowania'];
				$umiejetnosci=$_POST['umiejetnosci'];
		
		
				$doswiadczenie_zamien="<ul><li>".str_replace(",","</li><li>",$doswiadczenie)."</li></ul>";
				$doswiadczenie=$doswiadczenie_zamien;
				
				$wyksztalcenie_zamien="<ul><li>".str_replace(",","</li><li>",$wyksztalcenie)."</li></ul>";
				$wyksztalcenie=$wyksztalcenie_zamien;
				
				$jezyki_zamien="<ul><li>".str_replace(",","</li><li>",$jezyki)."</li></ul>";
				$jezyki=$jezyki_zamien;
				
				$zainteresowania_zamien="<ul><li>".str_replace(",","</li><li>",$zainteresowania)."</li></ul>";
				$zainteresowania=$zainteresowania_zamien;
				
				$umiejetnosci_zamien="<ul><li>".str_replace(",","</li><li>",$umiejetnosci)."</li></ul>";
				$umiejetnosci=$umiejetnosci_zamien;
		?>
		
		<div>
		
		<h2>Twoje dane:</h2>
		
		Imię : <?php echo $imie; ?><br />
		Nazwisko : <?php echo $nazwisko; ?><br />
		Data urodzenia : <?php echo $data_ur; ?><br />
		Miasto : <?php echo $miasto; ?><br />
		E-mail : <?php echo $email; ?><br />
		Telefon : <?php echo $telefon; ?><br />
		Motto : <?php echo $motto; ?><br />
		Doświadczenie : <?php echo $doswiadczenie; ?><br />
		Wykształcenie : <?php echo $wyksztalcenie; ?><br />
		Języki : <?php echo $jezyki; ?><br />
		Zainteresowania : <?php echo $zainteresowania; ?><br />
		Umiejętności : <?php echo $umiejetnosci; ?><br />
		
		
		<form action="generuj_bez_konta.php" method="post" target="_blank">
		
		<div style="display:none;">
		<input type="text" name="imie" value="<?php echo $imie ?>">
		<input type="text" name="nazwisko" value="<?php echo $nazwisko ?>">
		<input type="text" name="data_ur" value="<?php echo $data_ur ?>">
		<input type="text" name="miasto" value="<?php echo $miasto ?>">
		<input type="text" name="email" value="<?php echo $email ?>">
		<input type="text" name="telefon" value="<?php echo $telefon ?>">
		<input type="text" name="motto" value="<?php echo $motto ?>">
		<input type="text" name="doswiadczenie" value="<?php echo $doswiadczenie ?>">
		<input type="text" name="wyksztalcenie" value="<?php echo $wyksztalcenie ?>">
		<input type="text" name="jezyki" value="<?php echo $jezyki ?>">
		<input type="text" name="zainteresowania" value="<?php echo $zainteresowania ?>">
		<input type="text" name="umiejetnosci" value="<?php echo $umiejetnosci ?>">
		</div>
		
		<input type="submit" value="Generuj CV">
		
		</form>
		
		
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
