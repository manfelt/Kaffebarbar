<?php

require('KaffebarValideringTillegg.php');
require('SqlTilleggKlasse.php');


    //validering går her
    if(isset($_POST['tilfør'])){
        $validering = new KaffebarValideringTillegg($_POST);
        $errors = $validering->validerForm();
        if($errors === []){
            // lagre data til DB

            $nyttObjekt = new SqlTilleggKlasse();
            $nyttObjekt->insertData($_POST);
        }
        // $loggfør = file_put_contents('logg.txt', date("m.d  h:i:s").PHP_EOL , FILE_APPEND | LOCK_EX);
    }

?>
<head>
    <title>Legg til tillegg</title>
    <link rel="stylesheet" type="text/css" href="../stil.css">
</head>


    <div class="input-boks">
        <h3>Legg til nytt tillegg</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <label>Tillegg-navn</label>
            <input type="text" name ="tilleggvare">
            <div class="feilmelding"><?php echo $errors['tilleggvare'] ?? '' ?></div>

            <label>Pris</label>
            <input type="number" name="tilleggpris" value="0">
            <div class="feilmelding"><?php echo $errors['tilleggpris'] ?? '' ?></div>

            <input type="submit" value="Tilfør" name="tilfør">
        </form>
    </div>
