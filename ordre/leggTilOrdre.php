<?php

require('KaffebarValideringOrdre.php');
require('SqlOrdreKlasse.php');


    //validering går her
    if(isset($_POST['tilfør'])){
        $validering = new KaffebarValideringOrdre($_POST);
        $errors = $validering->validerForm();
        if($errors === []){
            // lagre data til DB

            $nyttObjekt = new SqlOrdreKlasse();
            $nyttObjekt->insertData($_POST);
        }
        // $loggfør = file_put_contents('logg.txt', date("m.d  h:i:s").PHP_EOL , FILE_APPEND | LOCK_EX);
    }

?>
<head>
    <title>Legg til ordre</title>
    <link rel="stylesheet" type="text/css" href="../stil.css">
</head>


    <div class="input-boks">
        <h3>Legg til ny ordre</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <label>Ordre-vare</label>
            <input type="text" name ="ordrevare">
            <div class="feilmelding"><?php echo $errors['ordrevare'] ?? '' ?></div>

            <label>Kvantum</label>
            <input type="number" name="ordrekvantum">
            <div class="feilmelding"><?php echo $errors['ordrekvantum'] ?? '' ?></div>

            <label>Tillegg</label>
            <input type="text" name ="ordretillegg">
            <div class="feilmelding"><?php echo $errors['ordretillegg'] ?? '' ?></div>

            <input type="submit" value="Tilfør" name="tilfør">
        </form>
    </div>
