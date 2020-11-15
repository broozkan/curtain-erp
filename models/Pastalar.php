<?php

  /**
   *
   */
  class Pastalar
  {

    public $pastaIdsi;
    public $pastaAdi;

    function __construct()
    {

    }


    /*SALON IDSİ GET SET START*/
    public function getPastaIdsi($veriKolonArray)
    {
      return $this->pastaIdsi;
    }
    public function setPastaIdsi($yeniDeger)
    {
      $this->pastaIdsi = $yeniDeger;
    }
    /*SALON IDSİ GET SET END*/


    /*SALON ADI GET SET START*/
    public function getPastaAdi($veriKolonArray)
    {
      return $this->pastaAdi;
    }
    public function setPastaAdi($yeniDeger)
    {
      $this->pastaAdi = $yeniDeger;
    }
    /*SALON ADI GET SET END*/
  }

?>
