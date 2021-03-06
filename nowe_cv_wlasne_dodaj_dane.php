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
		
		<div>
		
		<?php
		
		$sprawdzenie=$db->query("SELECT * FROM nazwa_cv_wlasne WHERE konto='$jakie_konto'  and nazwa='$nazwa_cv' and dodano='$data'");
		
		foreach ($db->results() as $record)
						 {
						 //echo $record->id;
						 }
		
		?>
		
		
		<form method="post">
		        
                <div class="form-group">
                    <label for="imie"> Imie:</label>
                    <input type="text" class="form-control" name="imie">
                </div>
                <div class="form-group">
                    <label for="nazwisko"> Nazwisko:</label>
                    <input type="text" class="form-control" name="nazwisko">
                </div>
                <div class="form-group">
                    <label for="data_ur"> Data urodzenia:</label>
                    <input type="text" class="form-control" name="data_ur">
                </div>
                <div class="form-group">
                    <label for="miasto"> Miasto:</label>
                    <input type="text" class="form-control" name="miasto">
                </div>
                <div class="form-group">
                    <label for="email"> Email:</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="telefon"> Nr. telefonu:</label>
                    <input type="text" class="form-control" name="telefon">
                </div>
                <div class="form-group">
                    <label for="motto"> Motto:</label>
                    <input type="text" class="form-control" name="motto">
                </div>
                <div class="form-group">
                    <label for="doswiadczenie"> Do??wiadczenie zawodowe:</label>
                    <input type="text" class="form-control" name="doswiadczenie">
                </div>
                <div class="form-group">
                    <label for="wyksztalcenie"> Wykszta??cenie:</label>
                    <input type="text" class="form-control" name="wyksztalcenie">
                </div>
                <div class="form-group">
                    <label for="jezyki"> Znane j??zyki:</label>
                    <input type="text" class="form-control" name="jezyki">
                </div>
                <div class="form-group">
                    <label for="email"> Zainteresowania:</label>
                    <input type="text" class="form-control" name="zainteresowania">
                </div>
                
                <div id="skill" class="form-group">
                    <label for="umiejetnosci"> Umiej??tno??ci:</label>
                    <input type="text" class="form-control" name="umiejetnosci">
                </div>
				<input type="submit" name="submit" value="Dalej" class='btn btn-danger'>
            </form>
						
						
						<?php
						
							if(isset($_POST['submit']))
							{
									
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
							
									$wstaw_dane=$db->query("UPDATE nazwa_cv_wlasne SET imie='$imie', nazwisko='$nazwisko', data_ur='$data_ur', miasto='$miasto', email='$email', telefon='$telefon', motto='$motto', doswiadczenie='$doswiadczenie', wyksztalcenie='$wyksztalcenie', jezyki='$jezyki', zainteresowania='$zainteresowania', umiejetnosci='$umiejetnosci' WHERE konto='$jakie_konto' and dodano='$data' ");
									
									if($wstaw_dane==true)
									{
										header("Location: nowe_cv_wlasne_wyswietl_dane.php?nazwa_cv=$nazwa_cv&id_szablonu=$id_szablonu&data=$data");
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
