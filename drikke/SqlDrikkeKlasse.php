<?php

	class SqlDrikkeKlasse
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

		// Insert drikke data inn i drikke tabbel
		public function insertData($post){
			$drikkeVare = $this->con->real_escape_string($_POST['drikkevare']);
			$drikkePris = $this->con->real_escape_string($_POST['drikkepris']);
			$query="INSERT INTO drikke(Drikke_vare,Drikke_pris) VALUES('$drikkeVare','$drikkePris')";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:../index.php?mld1=insertert");
			}else{
			    echo "Registrasjon mislyktes";
			}
		}

        // Spørring på drikkedokumenter
		public function utstillData(){
		    $query = "SELECT * FROM drikke";
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

        // Spørring på på enkeltdata for redigering av drikke tabell
		public function visDokumentEtterId($id){
		    $query = "SELECT * FROM drikke WHERE Drikke_ID = '$id'";
		    $result = $this->con->query($query);
		    if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
		    }else{
			    echo "Dokument ikke funnet";
		    }
		}

        // Oppdater drikke-data inn i drikke-tabell
		public function oppdaterDokument($postData){
		    $drikkeVare = $this->con->real_escape_string($_POST['drikkevare']);
		    $drikkePris = $this->con->real_escape_string($_POST['drikkepris']);
		    $id = $this->con->real_escape_string($_POST['id']);
		    if (!empty($id) && !empty($postData)) {
                $query = "UPDATE drikke SET Drikke_vare = '$drikkeVare', Drikke_pris = '$drikkePris' WHERE Drikke_ID = '$id'";
                $sql = $this->con->query($query);
                if ($sql==true) {
                    header("Location:../index.php?mld2=oppdatert");
                }else{
                    echo "Oppdatering mislyktes";
                }
            }
        }

        // Slett drikke-data fra drikke-tabell
		public function slettDokument($id){
		    $query = "DELETE FROM drikke WHERE Drikke_ID = '$id'";
		    $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:index.php?mld3=slettet");
            }else{
                echo "Dokumentet ble ikke slettet";
            }
		}
	}
?>
