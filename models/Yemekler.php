<?php

  /**
   *
   */
  class Yemekler
  {

    public $yemekIdsi;
    public $yemekAdi;

    function __construct()
    {

    }


    /*SALON IDSİ GET SET START*/
    public function getYemekIdsi($veriKolonArray)
    {
      return $this->yemekIdsi;
    }
    public function setYemekIdsi($yeniDeger)
    {
      $this->yemekIdsi = $yeniDeger;
    }
    /*SALON IDSİ GET SET END*/


    /*SALON ADI GET SET START*/
    public function getYemekAdi($veriKolonArray)
    {
      return $this->yemekAdi;
    }
    public function setYemekAdi($yeniDeger)
    {
      $this->yemekAdi = $yeniDeger;
    }
    /*SALON ADI GET SET END*/
  }

?>
