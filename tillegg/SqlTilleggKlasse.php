<?php

	class SqlTilleggKlasse
	{
		private $vert = "localhost";
		private $bruker = "root";
		private $passord = "";
		private $database = "kaffebar";
		public  $con;


		// Forbindelse til database
		public function __construct(){
		    $this->con = new mysqli($this->vert, $this->bruker,$this->passord,$this->database);
		    if(mysqli_connect_error()) {
                trigger_error("Feilet forbindelse til MySQL: " . mysqli_connect_error());
		    }else{
                return $this->con;
		    }
		}

		// Inserter data inn i tabbel
		public function insertData($post){
			$tilleggVare = $this->con->real_escape_string($_POST['tilleggvare']);
			$tilleggPris = $this->con->real_escape_string($_POST['tilleggpris']);
			$query="INSERT INTO tillegg(Tillegg_vare,Tillegg_pris) VALUES('$tilleggVare','$tilleggPris')";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:../index.php?mld1=insertert");
			}else{
			    echo "Registrasjon mislyktes";
			}
		}

        // Spørring på dokumenter
		public function utstillData(){
		    $query = "SELECT * FROM tillegg";
		    $result = $this->con->query($query);
		    if ($result->num_rows > 0) {
		        $data = array();
		        while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			    return $data;
		    }else{
			    echo "Ingen dokumenter funnet";
		    }
		}

        // Spørring på på enkeltdata for redigering av data i tabell
		public function visDokumentEtterId($id){
		    $query = "SELECT * FROM tillegg WHERE tillegg_ID = '$id'";
		    $result = $this->con->query($query);
		    if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
		    }else{
			    echo "Dokument ikke funnet";
		    }
		}

        // Oppdater tillegg-data inn i tabell
		public function oppdaterDokument($postData){
		    $tilleggVare = $this->con->real_escape_string($_POST['tilleggvare']);
		    $tilleggPris = $this->con->real_escape_string($_POST['tilleggpris']);
		    $id = $this->con->real_escape_string($_POST['id']);
		    if (!empty($id) && !empty($postData)) {
                $query = "UPDATE tillegg SET tillegg_vare = '$tilleggVare', tillegg_pris = '$tilleggPris' WHERE tillegg_ID = '$id'";
                $sql = $this->con->query($query);
                if ($sql==true) {
                    header("Location:../index.php?mld2=oppdatert");
                }else{
                    echo "Oppdatering mislyktes";
                }
            }
        }

        // Slett data fra tabell
		public function slettDokument($id){
		    $query = "DELETE FROM tillegg WHERE tillegg_ID = '$id'";
		    $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:index.php?mld3=slettet");
            }else{
                echo "Dokumentet ble ikke slettet";
            }
		}
	}
?>
