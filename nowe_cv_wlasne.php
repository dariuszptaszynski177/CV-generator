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
		</form>
		<?php }
		?>
	
	
		<?//=echousername($user->data()->id)?>
		<?php  
		$konto=echousername($user->data()->id);
		$jakie_konto=echousername($user->data()->id);
		//echo $konto;
		
		$id_szablonu=$_REQUEST['idw'];
		$nazwa_cv=$_REQUEST['nazwa_cv'];
		//echo $id_szablonu;
		//echo $nazwa_cv;
		
		?>
		
		<?php
		
				$zapytanie=$db->query("SELECT * FROM szablony_wlasne WHERE id='$id_szablonu'");
				
				
				foreach ($db->results() as $record)
						 {
						 
						 }
						 
				
				//echo $record->nazwa_szablonu;
				//echo $record->grafika;
		?>
		
		<div>
		
				<?php 
						echo "<h2 align='center'>Wybrano ";
						echo $record->nazwa; 
						echo "</h2>";
						
				?>
		
				<?php 
				
					echo "<center><div style='width:200px; height:250px; background-color:grey'><h3 style='color:black; text-align:center;'><br />Custom Template  <br /><br />$record->nazwa</h3></div></center>"; 
	
				?>
		
				<h3 style="color:blue; text-align:center">Podaj nazwę dla nowego CV</h3>
				
				<div style="text-align: center">
				<form method="post">
					
					<div style="display:none">
					<input type="text" name="id_szablonu" value="<?php echo $id_szablonu ?>">
					</div>
					
					<input class="form-control" type="text" name="nazwa_cv" value="<?php echo $nazwa_cv ?>" placeholder="Nazwa CV" style="width:300px; margin: 0 auto;"><br />
					<input class="btn btn-primary" type="submit" name="submit" value="Dodaj nowe CV">
				
				</form>
				</div>
				
				
				<?php
				
				if(isset($_POST['submit']))
				{
				
						$id_szablonu=$_POST['id_szablonu'];
						$nazwa_cv=$_POST['nazwa_cv'];
						//echo $nazwa_cv;
						$data=date("M,d,Y h:i:s A");
						
						
						$sprawdzenie=$db->query("SELECT * FROM nazwa_cv_wlasne WHERE konto='$jakie_konto' and nazwa='$nazwa_cv'");
						
						$policz=$zapytanie->count();
						//echo $policz;
						
						if($policz==0)
						{
						$dodaj=$db->query("INSERT INTO nazwa_cv_wlasne (id, konto, nazwa, id_szablon, dodano) VALUES (NULL, '$jakie_konto', '$nazwa_cv', '$id_szablonu', '$data')");
						
							if($dodaj==true)
							{
								header("Location: nowe_cv_wlasne_dodaj_dane.php?nazwa_cv=$nazwa_cv&id_szablonu=$id_szablonu&data=$data");
							}
						}
						else
						{
						echo "<h3 style='color:red; text-align:center;'>Podana nazwa CV już istnieje na Twoim koncie. Podaj inną nazwę</h3>";
						}
						
				
				
				//header("Location: http://projekt-cv.cba.pl/nowe_cv.php?id=$id_szablonu&nazwa_cv=false");
				}
				?>
	
	
		</div>
	
	


</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
