<?php
/**
*
*/
class Model extends Controller
{
  public $address;
  public $dbname;
  public $username;
  public $password;
  public $rootDir;
  public $version;
  public $dbh;

  function __construct($kurulumSorgu = false)
  {
    parent::__construct();
    try {
      $programInformation = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Installation.json");
      $programInformation = json_decode($programInformation,true);
      $this->address = $programInformation["txtDatabasePath"];
      $this->dbname = "";
      $this->username = $programInformation["txtDatabaseUsername"];
      $this->password = $programInformation["txtDatabasePassword"];
      $this->rootDir = $programInformation["txtRootDir"];
      $this->dbh = new PDO('mysql:host='.$this->address.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);
    } catch (PDOException $e) {
      echo "Hata! :".$e->getMessage()."";
      die();
    }


  }


  public function selectLikeQuery($tablo,$kolonArray,$veriKolonArray)
  {
    $veriKolonAdi = key($veriKolonArray);
    $veriKolonDegeri = current($veriKolonArray);


    for ($i=0; $i < count($kolonArray); $i++) {
      $kolonArray[$i] = $kolonArray[$i];
    }
    $kolonArray = implode(",",$kolonArray);
    $veriKolonArray = implode(",",$veriKolonArray);
    $stmt = $this->dbh->prepare("SELECT DISTINCT $kolonArray FROM $tablo WHERE $veriKolonAdi LIKE :$veriKolonAdi");

    $stmt->execute([$veriKolonAdi => "%".$veriKolonDegeri."%"]);
    $result = $stmt->fetchAll();
    if ($result) {
      return $result;
    }

  }


}

?>
