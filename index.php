<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 
    viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>☕</text></svg>">
    <title>Kaffebarbar</title>
    <link rel="stylesheet" href="stil.css?v=<?php echo time(); ?>">
</head>


<?php 

require('drikke/SqlDrikkeKlasse.php');
require('tillegg/SqlTilleggKlasse.php');
require('ordre/SqlOrdreKlasse.php');


$nyttDrikkeObjekt = new SqlDrikkeKlasse();

    // Slett drikke-dokument fra tabell
    if(isset($_GET['slettdrikkeId']) && !empty($_GET['slettdrikkeId'])) {
        $slettDrikkeId = $_GET['slettdrikkeId'];
        $nyttDrikkeObjekt->slettDokument($slettDrikkeId);
}

$nyttTilleggObjekt = new SqlTilleggKlasse();

    // Slett tillegg-dokument fra tabell
    if(isset($_GET['sletttilleggId']) && !empty($_GET['sletttilleggId'])) {
        $slettTilleggId = $_GET['sletttilleggId'];
        $nyttTilleggObjekt->slettDokument($slettTilleggId);
}

$nyttOrdreObjekt = new SqlOrdreKlasse();

    // Slett ordre-dokument fra tabell
    if(isset($_GET['slettordreId']) && !empty($_GET['slettordreId'])) {
        $slettOrdreId = $_GET['slettordreId'];
        $nyttOrdreObjekt->slettDokument($slettOrdreId);
}

?>


<body>
    <main>

        <?php
        // TEKNIKK FOR Å UTVEKSLE DATA MOT FRONTEND
            
        // Spørring på database utføres og resultatet lagres inn i en 'associative array'
        // for at det enkelt skal enkodes til JSON senere.
        $sqlTilJsonData = array(
            'id1' => 'Americano',
            'id2' => 'Mocca',
            'id3' => 'Tors Hammer'
        );

        // Konverterer data til JSON streng
        $jsonStreng = json_encode($sqlTilJsonData);

        ?>
            
        <script>
        // Printer ut JSON streng via PHP, lar JSON.parse parsere.
        var sqlTilJsonData = JSON.parse('<?= addslashes($jsonStreng); ?>');

        // Konsoll-logger data via javascript.
        console.log(sqlTilJsonData.id1);
        </script>

        <div class="innhold">
        <tbody>
            <h3>Drikkevare</h3>

            <?php 
            // Spørring på, og utstilling av drikke-dokumenter
            $drikkeObjekter = $nyttDrikkeObjekt->utstillData(); 
            foreach ($drikkeObjekter as $drikkeobjekt) {
            ?>
            <tr>
                <td><?php echo $drikkeobjekt['Drikke_ID'] ?></td>
                <td><?php echo $drikkeobjekt['Drikke_vare'] ?></td>
                <td><?php echo $drikkeobjekt['Drikke_pris'] ?></td>
                <td>
                    <a href="drikke/redigerDrikke.php?editId=<?php echo $drikkeobjekt['Drikke_ID'] ?>" style="color:limegreen">
                    <sup class="rediger" aria-hidden="true">rediger</sup></a>
                    <a href="index.php?slettdrikkeId=<?php echo $drikkeobjekt['Drikke_ID'] ?>" style="color:coral" onclick="confirm('Sletter du?')">
                    <sup class="slett" aria-hidden="true">slett</sup>
                </a>
                </td>
            </tr>
            <br>
        
            <?php } ?>
        </tbody>

        <br>

        <a href="drikke/leggTilDrikke.php">Legg til ny drikke</a>
        </div>

        <br><br>

        <div class="innhold">
        <tbody>
            <h3>Tillegg</h3>

            <?php 
            // Spørring på, og utstilling av tillegg-dokumenter
            $tilleggObjekter = $nyttTilleggObjekt->utstillData(); 
            foreach ($tilleggObjekter as $tilleggObjekt) {
            ?>
            <tr>
                <td><?php echo $tilleggObjekt['Tillegg_ID'] ?></td>
                <td><?php echo $tilleggObjekt['Tillegg_vare'] ?></td>
                <td><?php echo $tilleggObjekt['Tillegg_pris'] ?></td>
                <td>
                    <a href="tillegg/redigerTillegg.php?editTilleggId=<?php echo $tilleggObjekt['Tillegg_ID'] ?>" style="color:limegreen">
                    <sup class="rediger" aria-hidden="true">rediger</sup></a>
                    <a href="index.php?sletttilleggId=<?php echo $tilleggObjekt['Tillegg_ID'] ?>" style="color:coral" onclick="confirm('Sletter du?')">
                    <sup class="slett" aria-hidden="true">slett</sup>
                </a>
                </td>
            </tr>
            <br>
        

            <?php } ?>
        </tbody>

        <br>

        <a href="tillegg/leggTilTillegg.php">Legg til nytt tillegg</a>
        </div>

        <br><br>

        <div class="innhold">
        <tbody>
            <h3>Ordre</h3>

            <?php 
            // Spørring på, og utstilling av ordre-dokumenter
            $ordreObjekter = $nyttOrdreObjekt->utstillData(); 
            foreach ($ordreObjekter as $ordreObjekt) {
            ?>
            <tr>
                <td><?php echo $ordreObjekt['Ordre_ID'] ?></td>
                <td><?php echo $ordreObjekt['Ordre_vare'] ?></td>
                <td><?php echo $ordreObjekt['Ordre_tillegg'] ?></td>
                <td><?php echo $ordreObjekt['Ordre_belop'] ?></td>
                <td><?php echo '(' . $ordreObjekt['Ordre_tid'] . ')' ?></td>
                <td>
                    <a href="ordre/redigerOrdre.php?editOrdreId=<?php echo $ordreObjekt['Ordre_ID'] ?>" style="color:limegreen">
                    <sup class="rediger" aria-hidden="true">rediger</sup></a>
                    <a href="index.php?slettordreId=<?php echo $ordreObjekt['Ordre_ID'] ?>" style="color:coral" onclick="confirm('Sletter du?')">
                    <sup class="slett" aria-hidden="true">slett</sup>
                </a>
                </td>
            </tr>
            <br>
        
            <?php } ?>
        </tbody>

        <br>

        <a href="ordre/leggTilOrdre.php">Legg til ny ordre</a>
        </div>


    </main>

    <script src="main.js"></script>
</body>
</html>
