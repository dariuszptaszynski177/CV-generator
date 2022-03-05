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
		
		$id=$_REQUEST['id'];
		//echo $id;
		
		?>
		
		
		<?php
		
		$pobierz_ustawienia=$db->query("SELECT * FROM szablony_wlasne WHERE id='$id'");

		foreach ($db->results() as $record)
				{
				
				$ustawienie_danych_osobowych_temp=$record->ustawienie_danych_osobowych;
				$kolor_naglowkow_temp=$record->kolor_naglowkow;
				$ustawienie_naglowkow_temp=$record->ustawienie_naglowkow;
				
				}
				
				if($ustawienie_danych_osobowych_temp=="left")
				{
				$checked="checked";
				}
				if($ustawienie_danych_osobowych_temp=="right")
				{
				$checked_1="checked";
				}
				
				
				if($ustawienie_naglowkow_temp=="left")
				{
				$checked1="checked";
				}
				if($ustawienie_naglowkow_temp=="center")
				{
				$checked_2="checked";
				}
				
		?>
		
		<div>
		
				<form method="post">
				
					
					Wybierz ustawienie danych osobowych<br />
					<input type="radio" name="ustawienie_danych_osobowych" value="left" <?php echo $checked ?>/>Lewo<br />
					<input type="radio" name="ustawienie_danych_osobowych" value="right" <?php echo $checked_1 ?>/>Prawo<br /><br />
					
					Wpisz nazwę koloru nagłówków (po angielsku)<br />
					<input type="text" name="kolor_naglowkow" value="<?php echo $kolor_naglowkow_temp ?>"><br /><br />
					
					Wybierz ustawienie nagłówków<br />
					<input type="radio" name="ustawienie_naglowkow" value="left" <?php echo $checked1 ?>/>Lewo<br />
					<input type="radio" name="ustawienie_naglowkow" value="center" <?php echo $checked_2 ?>/>Środek<br /><br />
					
					<input class="btn btn-success" type="submit" value="Zapisz ustawienia szablonu" name="submit">
					
				</form>
				
				<?php
				
				if(isset($_POST['submit']))
				{
						
						$ustawienie_danych_osobowych=$_POST['ustawienie_danych_osobowych'];
						$kolor_naglowkow=$_POST['kolor_naglowkow'];
						$ustawienie_naglowkow=$_POST['ustawienie_naglowkow'];
						
						
						
						$aktualizacja_ustawien_szabonu=$db->query("UPDATE szablony_wlasne SET ustawienie_danych_osobowych='$ustawienie_danych_osobowych', kolor_naglowkow='$kolor_naglowkow', ustawienie_naglowkow='$ustawienie_naglowkow'  WHERE id='$id'");
						
						if($aktualizacja_ustawien_szabonu==true)
						{
								header("Location: szablony.php");
						}
						
				}
				
				?>
				
				
		
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
