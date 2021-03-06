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
		$db = DB::getInstance();
		?>
		
		<?php
		
		$data=$_REQUEST['data'];
		$nazwa=$_REQUEST['nazwa'];
		
		//echo $data;
		//echo $nazwa;
		
		?>
		
		<div>
		
				<form action="szablony_zapisz_ustawienia.php" method="post">
				
					<div style="display:none">
					<input type="text" name="data" value="<?php echo $data ?>">
					<input type="text" name="nazwa_szablonu" value="<?php echo $nazwa ?>">
					</div>
					
					<div style="display:none;">
					Czy chcesz do????czy?? zdjecie?<br />
					<input type="radio" name="zdjecie" value="tak">Tak<br />
					<input type="radio" name="zdjecie" value="nie">Nie<br /><br />
					</div>
					
					Wybierz ustawienie danych osobowych<br />
					<input type="radio" name="ustawienie_danych_osobowych" value="left" />Lewo<br />
					<input type="radio" name="ustawienie_danych_osobowych" value="right"/>Prawo<br /><br />
					
					Wpisz nazw?? koloru nag????wk??w (po angielsku)<br />
					<input type="text" name="kolor_naglowkow"><br /><br />
					
					Wybierz ustawienie nag????wk??w<br />
					<input type="radio" name="ustawienie_naglowkow" value="left" />Lewo<br />
					<input type="radio" name="ustawienie_naglowkow" value="center" />??rodek<br /><br />
					
					<input class="btn btn-success" type="submit" value="Zapisz ustawienia szablonu" name="submit">
					
				</form>
				
				
		
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
