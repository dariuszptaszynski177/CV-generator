
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

$ustawienie_danych_osobowych=$_POST['ustawienie_danych_osobowych'];
$kolor_naglowkow=$_POST['kolor_naglowkow'];
$ustawienie_naglowkow=$_POST['ustawienie_naglowkow'];


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
<h1 style='text-align:center;'>Curriculum vitae</h1><br />
<div style='text-align:$ustawienie_danych_osobowych;'>

Imię : $imie<br />
Nazwisko : $nazwisko<br />
Data urodzenia : $data_ur<br />
Miasto : $miasto<br />
E-mail : $email<br />
Telefon : $telefon<br />
</div>

<div>
<h3 style='text-align:center'>Motto : $motto</h3><br />


<h2 style='color:$kolor_naglowkow;text-align:$ustawienie_naglowkow';>Doświadczenie</h2>

$doswiadczenie


<h2 style='color:$kolor_naglowkow;text-align:$ustawienie_naglowkow';>Wykształcenie</h2>
$wyksztalcenie


<h2 style='color:$kolor_naglowkow;text-align:$ustawienie_naglowkow';>Języki</h2>
$jezyki


<h2 style='color:$kolor_naglowkow;text-align:$ustawienie_naglowkow';>Zainteresowania</h2>
$zainteresowania


<h2 style='color:$kolor_naglowkow;text-align:$ustawienie_naglowkow';>Umiejętności</h2>
$umiejetnosci

</div><br>

<div style='text-align:justify;'>
Wyrażam zgodę na przetwarzanie moich danych osobowych w celu rekrutacji zgodnie z art. 6 ust. 1 lit. a Rozporządzenia Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE (ogólne rozporządzenie o ochronie danych).
</div>

</body>
</html>
";



$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');

$mpdf->Output();

?>