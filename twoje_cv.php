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
 
 <style>
 table tr, td
 {
 padding:5px;
 }
 </style>
 
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
		$db = DB::getInstance();
		?>
		
		<div>
		
		
		<!-- chowam dodawanie CV w tym miejscy, przeniesione w inne miejsce -->
		<div style="display:none">
		<form method="post">
		
			<input class="form-control" type="text" name="nazwa" placeholder="Nazwa CV" size="10"><br />
			<input class="btn btn-primary" type="submit" name="submit" value="Dodaj nowe CV">
		
		</form>
		
		
		<?php
		
		if(isset($_POST['submit']))
		{
			$nazwa=$_POST['nazwa'];
			
			
			mysql_query('SET CHARACTER SET utf8'); 
			mysql_query("SET NAMES 'utf8'");
			
			$dodaj=$db->query("INSERT INTO nazwa_cv (id, konto, nazwa) VALUES (NULL, '$jakie_konto', '$nazwa')");
			
			if($dodaj==true)
			{
			header("Location: nowe_cv.php");
			}
		}
		
		?>
		</div>
		
		
		<button class="btn btn-primary" onclick="window.location.href = 'szablony.php';">Stwórz nowe CV</button>
			
			<?php
			
			
				//zapytanie sprawdzające czy w bazie istnieje już jakieś cv użytkownika
				$zapytanie=$db->query("SELECT * FROM nazwa_cv WHERE konto='$jakie_konto' ORDER BY id ASC");
				
				$policz=0;
				foreach ($db->results() as $record)
				{
				$policz++;
				}
				//zliczenie wyników zapytania
				$licz=$policz;
				//echo $licz;

				$id_cv=1;
				if($licz > 0)
				{
				echo "<h3>Twoje CV - standardowe szablony</h3>";
				echo "<table border=1>";
					echo "<tr><td>Id</td><td>Nazwa CV</td><td>Id szablonu</td><td>Data dodania</td><td>Export</td><td>Edycja</td><td>Generuj CV</td><td>Usuń</td></tr>";
						 foreach ($db->results() as $record)
						 {
							echo "<tr>";
								echo "<td>";
									echo $id_cv;
								echo "</td>";
								echo "<td>";
									echo $record->nazwa;
									$nazwa_cv=$record->nazwa;
								echo "</td>";
								echo "<td>";
									echo $record->id_szablon;
									$id_szablonu=$record->id_szablon;
								echo "</td>";
								echo "<td>";
									echo $record->dodano;
									$dodano=$record->dodano;
								echo "</td>";
								echo "<td>";
								$id=$record->id;
								
									echo "<a href='export_konto.php?id=$id'>Wyeksportuj</a>";
								echo "</td>";
								echo "<td>";
									echo "<a href='nowe_cv_edytuj_dane.php?id_szablonu=$id_szablonu&data=$dodano&nazwa_cv=$nazwa_cv'>Edytuj dane</a>";
								echo "</td>";
								echo "<td>";
									echo "<a href='nowe_cv_wyswietl_dane.php?id_szablonu=$id_szablonu&data=$dodano&nazwa_cv=$nazwa_cv'>Generuj CV</a>";
								echo "</td>";
								echo "<td>";
									echo "<a href='usun_cv.php?id=$id'>Usuń CV</a>";
								echo "</td>";
							echo "</tr>";
							$id_cv++;
							}
				echo "</table>";
				}
				else
				{
				echo "<br /><h3 align='center'>Brak CV</h3>";
				}
			?><br /><br />
			
			
			
			<!-- Wyświetlenie customowych CV-->
			<?php
			
			$wlasne_cv=$db->query("SELECT * FROM nazwa_cv_wlasne WHERE konto='$jakie_konto' ORDER BY id ASC");
			
			$id_custom=1;
			
			echo "<table border=1>";
			echo "<tr><td>Id</td><td>Nazwa CV</td><td>Id szablonu</td><td>Data dodania</td></tr>";
			foreach ($db->results() as $record1)
				{
				echo "<tr>";
				echo "<td>";
						$id=$record1->id;
						echo $id_custom;
					echo "</td>";
					echo "<td>";
						$nazwa_cv=$record1->nazwa;
						echo $record1->nazwa;
					echo "</td>";
					echo "<td>";
						$id_szablonu=$record1->id_szablon;
						echo $record1->id_szablon;
					echo "</td>";
					echo "<td>";
						$data=$record1->dodano;
						$dodano=$record1->dodano;
						echo $record1->dodano;
					echo "</td>";
					echo "<td>";
						echo "<a href='nowe_cv_wlasne_edytuj_dane.php?id_szablonu=$id_szablonu&data=$data&nazwa_cv=$nazwa_cv'>Edytuj dane</a>";
					echo "</td>";
					echo "<td>";
						echo "<a href='nowe_cv_wlasne_wyswietl_dane.php?id_szablonu=$id_szablonu&data=$dodano&nazwa_cv=$nazwa_cv'>Generuj CV</a>";
					echo "</td>";
					echo "<td>";
						echo "<a href='usun_cv_wlasne.php?id=$id'>Usuń CV</a>";
					echo "</td>";
				echo "</tr>";
				$id_custom++;
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
