
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


include('MPDF57/mpdf.php');

//$name 	= $_POST['name'];
//$email 	= $_POST['email'];
//$msg 	= $_POST['message'];

$html .= "
<html>
<head>

<style>
body {font-family: sans-serif;
    font-size: 10pt;
}
td { vertical-align: top; 
    
	align: center;
}
table thead td { 
    text-align: center;
    
}
td.lastrow {
   
    
    
}

</style>
</head>
<body>

<!--mpdf
<htmlpagefooter name='myfooter'>
<div style='border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; '>
Strona {PAGENO} z {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
<sethtmlpagefooter name='myfooter' value='on' />
mpdf-->

<div>

Imię : $imie<br />
Nazwisko : $nazwisko<br />
Data urodzenia : $data_ur<br />
Miasto : $miasto<br />
E-mail : $email<br />
Telefon : $telefon<br />
Motto : $motto<br />
Doświadczenie : $doswiadczenie<br />
Wykształcenie : $wyksztalcenie<br />
Języki : $jezyki<br />
Zainteresowania : $zainteresowania<br />
Umiejętności : $umiejetnosci<br />

</div><br>

</body>
</html>
";



$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');

$mpdf->Output();

?>