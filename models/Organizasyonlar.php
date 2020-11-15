<?php

  /**
   *
   */
  class OrganizasyonTurleri
  {

    public $organizasyonTuruIdsi;
    public $organizasyonTuruAdi;

    function __construct()
    {

    }


    /*ORGANİZASYON TÜRÜ IDSİ GET SET START*/
    public function getOrganizasyonTuruIdsi($veriKolonArray)
    {
      return $this->organizasyonTuruIdsi;
    }
    public function setOrganizasyonTuruIdsi($yeniDeger)
    {
      $this->organizasyonTuruIdsi = $yeniDeger;
    }
    /*ORGANİZASYON TÜRÜ IDSİ GET SET END*/


    /*ORGANİZASYON TÜRÜ ADI GET SET START*/
    public function getOrganizasyonTuruAdi($veriKolonArray)
    {
      return $this->organizasyonTuruAdi;
    }
    public function setOrganizasyonTuruAdi($yeniDeger)
    {
      $this->organizasyonTuruAdi = $yeniDeger;
    }
    /*ORGANİZASYON TÜRÜ ADI GET SET END*/
  }

?>
