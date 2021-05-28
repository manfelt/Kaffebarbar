<?php

	class SqlOrdreKlasse
	{
		private $vert = "localhost";
		private $bruker = "root";
		private $passord = "";
		private $database = "kaffebar";
		public  $con;


/* 		Kom på helt til sist at jeg må insertere Ordre_belop. 
		Dette må gjøres om slik at man henter Drikke_pris PÅ Drikke_vare,
		multipliserer på kvanutum, lagrer til sist inn i Ordre_belop.

		INSERT INTO ordre (Ordre_vare,Ordre_kvantum, Ordre_belop)
		VALUES ('Mocca', 2 )
		SELECT Drikke_pris
		FROM drikke
		WHERE Drikke_vare = 'Mocca'; 

		SELECT MAX(Ordre_ID)
		FROM ordre;
		INERT INTO ordre (Ordre_belop) */


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
			$ordreVare = $this->con->real_escape_string($_POST['ordrevare']);
			$ordreKvantum = $this->con->real_escape_string($_POST['ordrekvantum']);
			$query="INSERT INTO ordre(Ordre_vare,Ordre_kvantum) VALUES('$ordreVare','$ordreKvantum')";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:../index.php?mld1=insertert");
			}else{
			    echo "Registrasjon mislyktes";
			}
		}

        // Spørring på dokumenter
		public function utstillData(){
		    $query = "SELECT * FROM ordre";
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
		    $query = "SELECT * FROM ordre WHERE Ordre_ID = '$id'";
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
		    $ordreVare = $this->con->real_escape_string($_POST['ordrevare']);
		    $ordreKvantum = $this->con->real_escape_string($_POST['ordrekvantum']);
		    $id = $this->con->real_escape_string($_POST['id']);
		    if (!empty($id) && !empty($postData)) {
                $query = "UPDATE ordre SET Ordre_vare = '$ordreVare', Ordre_kvantum = '$ordreKvantum' WHERE Ordre_ID = '$id'";
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
		    $query = "DELETE FROM ordre WHERE ordre_ID = '$id'";
		    $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:index.php?mld3=slettet");
            }else{
                echo "Dokumentet ble ikke slettet";
            }
		}
	}
?>
