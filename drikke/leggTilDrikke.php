<?php

require('KaffebarValideringDrikke.php');
require('SqlDrikkeKlasse.php');


    //validering går her
    if(isset($_POST['tilfør'])){
        $validering = new KaffebarValideringDrikke($_POST);
        $errors = $validering->validerForm();
        if($errors === []){
            // lagre data til DB

            $nyttObjekt = new SqlDrikkeKlasse();
            $nyttObjekt->insertData($_POST);
        }
        // $loggfør = file_put_contents('logg.txt', date("m.d  h:i:s").PHP_EOL , FILE_APPEND | LOCK_EX);
    }

?>
<head>
    <title>Legg til drikke</title>
    <link rel="stylesheet" type="text/css" href="../stil.css">
</head>


    <div class="input-boks">
        <h3>Legg til ny drikkevare</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <label>Drikkenavn</label>
            <input type="text" name ="drikkevare">
            <div class="feilmelding"><?php echo $errors['drikkevare'] ?? '' ?></div>

            <label>Pris</label>
            <input type="number" name="drikkepris">
            <div class="feilmelding"><?php echo $errors['drikkepris'] ?? '' ?></div>

            <input type="submit" value="Tilfør" name="tilfør">
        </form>
    </div>
