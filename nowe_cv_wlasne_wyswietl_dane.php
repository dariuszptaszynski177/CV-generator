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
		$id_szablonu=$_REQUEST['id_szablonu'];
		$nazwa_cv=$_REQUEST['nazwa_cv'];
		$data=$_REQUEST['data'];
		
		//echo $id_szablonu;
		//echo $nazwa_cv;
		//echo $data;
		?>
		
		
		<?php
		
		$pobierz_dane=$db->query("SELECT * FROM nazwa_cv_wlasne WHERE konto='$jakie_konto'  and nazwa='$nazwa_cv' and dodano='$data'");
		
		foreach ($db->results() as $record)
						 {
						 /*
							echo $record->imie;
							echo $record->nazwisko;
							echo $record->data_ur;
							echo $record->miasto;
							echo $record->email;
							echo $record->telefon;
							echo $record->motto;
							echo $record->doswiadczenie;
							echo $record->wyksztalcenie;
							echo $record->jezyki;
							echo $record->zainteresowania;
							echo $record->umiejetnosci;
							*/
						 }
		
		?>
		
		<div>
		
		<?php
		
		$doswiadczenie_zamien="<ul><li>".str_replace(",","</li><li>",$record->doswiadczenie)."</li></ul>";
		$doswiadczenie=$doswiadczenie_zamien;
		
		$wyksztalcenie_zamien="<ul><li>".str_replace(",","</li><li>",$record->wyksztalcenie)."</li></ul>";
		$wyksztalcenie=$wyksztalcenie_zamien;
		
		$jezyki_zamien="<ul><li>".str_replace(",","</li><li>",$record->jezyki)."</li></ul>";
		$jezyki=$jezyki_zamien;
		
		$zainteresowania_zamien="<ul><li>".str_replace(",","</li><li>",$record->zainteresowania)."</li></ul>";
		$zainteresowania=$zainteresowania_zamien;
		
		$umiejetnosci_zamien="<ul><li>".str_replace(",","</li><li>",$record->umiejetnosci)."</li></ul>";
		$umiejetnosci=$umiejetnosci_zamien;
		
		?>
		
		
		<h2>Twoje dane do CV</h2>
		
		Imię : <?php echo $record->imie;?><br />
		Nazwisko : <?php echo $record->nazwisko ?><br />
		Data urodzenia : <?php echo $record->data_ur ?><br />
		Miasto : <?php echo $record->miasto ?><br />
		E-mail : <?php echo $record->email ?><br />
		Telefon : <?php echo $record->telefon ?><br />
		Motto : <?php echo $record->motto ?><br />
		
		<!-- zmiana zmiennych-->
		Doświadczenie : <?php echo $doswiadczenie ?><br />
		Wykształcenie : <?php echo $wyksztalcenie ?><br />
		Języki : <?php echo $jezyki ?><br />
		Zainteresowaie <?php echo $zainteresowania ?><br />
		Umiejętności : <?php echo $umiejetnosci ?><br />
		
		
		<?php
		
		$ustawienia_szablonu=$db->query("SELECT * FROM szablony_wlasne WHERE id='$id_szablonu' ");
		
		
		foreach ($db->results() as $record1)
						 {
						 $ustawienie_danych_osobowych_temp=$record1->ustawienie_danych_osobowych;
						 $kolor_naglowkow_temp=$record1->kolor_naglowkow;
						 $ustawienie_naglowkow_temp=$record1->ustawienie_naglowkow;
						 }
		
		?>
		
		
		
		
		<form action="generator_wlasny.php" method="post" target="_blank">
		
		<div style="display:none;">
		<input type="text" name="imie" value="<?php echo $record->imie ?>">
		<input type="text" name="nazwisko" value="<?php echo $record->nazwisko ?>">
		<input type="text" name="data_ur" value="<?php echo $record->data_ur ?>">
		<input type="text" name="miasto" value="<?php echo $record->miasto ?>">
		<input type="text" name="email" value="<?php echo $record->email ?>">
		<input type="text" name="telefon" value="<?php echo $record->telefon ?>">
		<input type="text" name="motto" value="<?php echo $record->motto ?>">
		<input type="text" name="doswiadczenie" value="<?php echo $doswiadczenie ?>">
		<input type="text" name="wyksztalcenie" value="<?php echo $wyksztalcenie ?>">
		<input type="text" name="jezyki" value="<?php echo $jezyki ?>">
		<input type="text" name="zainteresowania" value="<?php echo $zainteresowania ?>">
		<input type="text" name="umiejetnosci" value="<?php echo $umiejetnosci ?>">
		
		<input type="text" name="ustawienie_danych_osobowych" value="<?php echo $ustawienie_danych_osobowych_temp ?>">
		<input type="text" name="kolor_naglowkow" value="<?php echo $kolor_naglowkow_temp ?>">
		<input type="text" name="ustawienie_naglowkow" value="<?php echo $ustawienie_naglowkow_temp ?>">
		
		</div>
		
		<input class="btn btn-success" type="submit" value="Generuj CV">
		
		</form>
		
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
