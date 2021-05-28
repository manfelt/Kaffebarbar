<?php
  
  // Inkluderer DB fil
  require('SqlDrikkeKlasse.php');

  $nyttObjekt = new SqlDrikkeKlasse();

  // Redigerer dokumenter
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
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
  <title>Rediger drikkevare</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <h4>Rediger drikkevare</h4>

    <div class="container">
    <form action="redigerDrikke.php" method="POST">
        <div class="form-gruppe">
        <label for="navn">Drikkevare:</label>
        <input type="text" name="drikkevare" value="<?php echo $redigerObjekt['Drikke_vare']; ?>" required="">
        </div>
        <div class="form-gruppe">
        <label>Pris</label>
        <input type="number" name="drikkepris" value="<?php echo $redigerObjekt['Drikke_pris']; ?>" required="">
        </div>
        <div class="form-gruppe">
        <input type="hidden" name="id" value="<?php echo $redigerObjekt['Drikke_ID']; ?>">
        <input type="submit" name="oppdatering" value="oppdater">
        </div>
    </form>
    </div>

</body>
</html>
