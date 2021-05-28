<?php
  
  // Inkluderer DB fil
  require('SqlTilleggKlasse.php');

  $nyttObjekt = new SqlTilleggKlasse();

  // Redigerer dokumenter
  if(isset($_GET['editTilleggId']) && !empty($_GET['editTilleggId'])) {
    $editId = $_GET['editTilleggId'];
    $redigerObjekt = $nyttObjekt->visDokumentEtterId($editId);
  }

  // Oppdaterer dokumenter i tabellen
  if(isset($_POST['oppdatering'])) {
    $nyttObjekt->oppdaterDokument($_POST);
  }  
    
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <title>Rediger tillegg</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <h4>Rediger tillegg</h4>

    <div class="container">
    <form action="redigerTillegg.php" method="POST">
        <div class="form-gruppe">
        <label for="navn">Tillegg:</label>
        <input type="text" name="tilleggvare" value="<?php echo $redigerObjekt['Tillegg_vare']; ?>" required="">
        </div>
        <div class="form-gruppe">
        <label>Pris</label>
        <input type="number" name="tilleggpris" value="<?php echo $redigerObjekt['Tillegg_pris']; ?>" required="">
        </div>
        <div class="form-gruppe">
        <input type="hidden" name="id" value="<?php echo $redigerObjekt['Tillegg_ID']; ?>">
        <input type="submit" name="oppdatering" value="oppdater">
        </div>
    </form>
    </div>

</body>
</html>
