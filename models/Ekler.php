<?php

  /**
   *
   */
  class Ekler
  {

    public $ekIdsi;
    public $ekAdi;

    function __construct()
    {

    }


    /*SALON IDSİ GET SET START*/
    public function getEkIdsi($veriKolonArray)
    {
      return $this->ekIdsi;
    }
    public function setEkIdsi($yeniDeger)
    {
      $this->ekIdsi = $yeniDeger;
    }
    /*SALON IDSİ GET SET END*/


    /*SALON ADI GET SET START*/
    public function getEkAdi($veriKolonArray)
    {
      return $this->ekAdi;
    }
    public function setEkAdi($yeniDeger)
    {
      $this->ekAdi = $yeniDeger;
    }
    /*SALON ADI GET SET END*/
  }

?>
