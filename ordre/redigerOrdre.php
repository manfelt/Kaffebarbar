<?php
  
  // Inkluderer DB fil
  require('SqlOrdreKlasse.php');

  $nyttObjekt = new SqlOrdreKlasse();

  // Redigerer dokumenter
  if(isset($_GET['editOrdreId']) && !empty($_GET['editOrdreId'])) {
    $editId = $_GET['editOrdreId'];
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
  <title>Rediger ordre</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <h4>Rediger ordre</h4>

    <div class="container">
    <form action="redigerOrdre.php" method="POST">
        <div class="form-gruppe">
        <label for="navn">Ordrevare:</label>
        <input type="text" name="ordrevare" value="<?php echo $redigerObjekt['Ordre_vare']; ?>" required="">
        </div>
        <div class="form-gruppe">
        <label>kvanta</label>
        <input type="number" name="ordrekvantum" value="<?php echo $redigerObjekt['Ordre_kvantum']; ?>" required="">
        </div>
        <div class="form-gruppe">
        <input type="hidden" name="id" value="<?php echo $redigerObjekt['Ordre_ID']; ?>">
        <br>
        <div class="form-gruppe">
        <label for="navn">Tillegg:</label>
        <input type="text" name="ordrevare" value="<?php echo $redigerObjekt['Ordre_tillegg']; ?>" required="">
        </div>
        <input type="submit" name="oppdatering" value="oppdater">
        </div>
    </form>
    </div>

</body>
</html>
