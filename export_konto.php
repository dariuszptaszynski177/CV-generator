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
		//echo $jakie_konto;
		
		$db = DB::getInstance();
		$id=$_REQUEST['id'];
		//echo $id;
		?>
		
		
		<?php
		
		$zapytanie=$db->query("SELECT * FROM nazwa_cv WHERE konto='$jakie_konto' and id='$id'");
		
		foreach ($db->results() as $record)
				{
				
				
				}
				
				$nazwa=$record->nazwa;
				$id_szablonu=$record->id_szablon;
				$imie=$record->imie;
				$nazwisko=$record->nazwisko;
				$data_ur=$record->data_ur;
				$miasto=$record->miasto;
				$email=$record->email;
				$telefon=$record->telefon;
				$motto=$record->motto;
				$doswiadczenie=$record->doswiadczenie;
				$wyksztalcenie=$record->wyksztalcenie;
				$jezyki=$record->jezyki;
				$zainteresowania=$record->zainteresowania;
				$umiejetnosci=$record->umiejetnosci;
			
		
		?>
		
		
		<div>
		<h2>Dane, które chcesz zaimportować na inne konto</h2>
		
		<?php echo "Nazwa CV : $nazwa" ?><br />
		<?php echo "Id szablonu : $id_szablonu" ?><br />
		<?php echo "Imię : $imie" ?><br />
		<?php echo "Nazwisko : $nazwisko" ?><br />
		<?php echo "Data urodzenia : $data_ur" ?><br />
		<?php echo "Miasto : $miasto" ?><br />
		<?php echo "E-mail : $email" ?><br />
		<?php echo "Telefon : $telefon" ?><br />
		<?php echo "Motto : $motto" ?><br />
		<?php echo "Doświadczenie : $doswiadczenie" ?><br />
		<?php echo "Wykształcenie : $wyksztalcenie" ?><br />
		<?php echo "Języki : $jezyki" ?><br />
		<?php echo "Zainteresowania : $zainteresowania" ?><br />
		<?php echo "Umiejętności : $umiejetnosci" ?><br />
		
		<br /><br />
		<form method="post">
		
		<h3>Podaj nazwę użytkownika dla, którego chcesz zaimportować dane</h3><br />
		<input class="form-control" type="text" name="uzytkownik">
		
		<input class="btn btn-success" type="submit" name="submit" value="Wyeksportuj">
		
		</form>
		
		
		<?php 
		
		if(isset($_POST['submit']))
		{
				
				$uzytkownik=$_POST['uzytkownik'];
				$data=date("M,d,Y h:i:s A");
				
				//echo $uzytkownik;
				
				$sprawdz=$db->query("SELECT * FROM users WHERE username='$uzytkownik' ");
				
				$licznik=0;
				foreach ($db->results() as $record)
				{
				$licznik++;
				}
				
				if($licznik==0)
				{
				echo "<h3 align='center'>Nie ma takiego użytkownika w systemie</h3>";
				}
				
				if($licznik==1)
				{
				$wstaw=$db->query("INSERT INTO nazwa_cv (id, konto, nazwa, id_szablon, dodano, imie, nazwisko, data_ur, miasto, email, telefon, motto, doswiadczenie, wyksztalcenie, jezyki, zainteresowania, umiejetnosci ) values (null, '$uzytkownik', '$nazwa', '$id_szablonu', '$data', '$imie', '$nazwisko', '$data_ur', '$miasto', '$email', '$telefon', '$motto', '$doswiadczenie', '$wyksztalcenie', '$jezyki', '$zainteresowania', '$umiejetnosci') ");
				}
				
				if($wstaw==true)
				{
				echo "<h4>Dane zostały przesłane do konta $uzytkownik</h4>";
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
