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
			</form><br>
		<?php }
		?>
	
		<?//=echousername($user->data()->id)?>
		<?php  
		$konto=echousername($user->data()->id);
		echo $konto;
		?>
		
        <div>
            <form action="">
		        <p>Edytowanie CV<p>
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
                    <label for="doswiadczenie"> Doświadczenie zawodowe:</label>
                    <input type="text" class="form-control" name="doswiadczenie">
                </div>
                <div class="form-group">
                    <label for="wyksztalcenie"> Wykształcenie:</label>
                    <input type="text" class="form-control" name="wyksztalcenie">
                </div>
                <div class="form-group">
                    <label for="jezyki"> Znane języki:</label>
                    <input type="text" class="form-control" name="jezyki">
                </div>
                <div class="form-group">
                    <label for="email"> Zainteresowania:</label>
                    <input type="text" class="form-control" name="zainteresowania">
                </div>
                <button onclick="addSkill()">+</button>
                <div id="skill" class="form-group">
                    <label for="umiejetnosci"> Umiejętności:</label>
                    <input type="text" class="form-control" name="umiejetnosci">
                </div>
				<input type="submit" name="uncloak" value="Zapisz" class='btn btn-danger'>
            </form>
		</div>
	
    </div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script>
function addSkill() {
  var itm = document.getElementById("skill");
  var cln = itm.cloneNode(true);
  document.getElementById("skill").parentNode.appendChild(cln);
  var cln = null;
}
</script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
