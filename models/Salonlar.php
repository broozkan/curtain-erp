<?php

  /**
   *
   */
  class Salonlar
  {

    public $salonIdsi;
    public $salonAdi;

    function __construct()
    {

    }


    /*SALON IDSİ GET SET START*/
    public function getSalonIdsi($veriKolonArray)
    {
      return $this->salonIdsi;
    }
    public function setSalonIdsi($yeniDeger)
    {
      $this->salonIdsi = $yeniDeger;
    }
    /*SALON IDSİ GET SET END*/


    /*SALON ADI GET SET START*/
    public function getSalonAdi($veriKolonArray)
    {
      return $this->salonAdi;
    }
    public function setSalonAdi($yeniDeger)
    {
      $this->salonAdi = $yeniDeger;
    }
    /*SALON ADI GET SET END*/
  }

?>
