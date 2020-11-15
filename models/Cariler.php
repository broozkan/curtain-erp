<?php

  /**
   *
   */
  class Cariler
  {

    public $cariIdsi;
    public $cariAdi;

    function __construct()
    {

    }


    /*SALON IDSİ GET SET START*/
    public function getCariIdsi($veriKolonArray)
    {
      return $this->cariIdsi;
    }
    public function setCariIdsi($yeniDeger)
    {
      $this->cariIdsi = $yeniDeger;
    }
    /*SALON IDSİ GET SET END*/


    /*SALON ADI GET SET START*/
    public function getCariAdi($veriKolonArray)
    {
      return $this->cariAdi;
    }
    public function setCariAdi($yeniDeger)
    {
      $this->cariAdi = $yeniDeger;
    }
    /*SALON ADI GET SET END*/
  }

?>
