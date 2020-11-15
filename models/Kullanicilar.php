<?php


/**
 *
 */
class Kullanicilar extends DugunSalonu
{

  public $kullaniciIdsi;
  public $kullaniciAdiSoyadi;
  public $kullaniciKullaniciAdi;
  public $kullaniciParolasi;
  public $kullaniciYetkileri;

  function __construct()
  {

  }


  /*KULLANICI IDSİ GET SET START*/
  public function getKullaniciIdsi($veriKolonArray)
  {
    return $this->kullaniciIdsi;
  }
  public function setKullaniciIdsi($yeniDeger)
  {
    $this->kullaniciIdsi = $yeniDeger;
  }
  /*KULLANICI IDSİ GET SET END*/


  /*KULLANICI ADI SOYADI GET SET START*/
  public function getKullaniciAdiSoyadi($veriKolonArray)
  {
    return $this->kullaniciAdiSoyadi;
  }
  public function setKullaniciAdiSoyadi($yeniDeger)
  {
    $this->kullaniciAdiSoyadi = $yeniDeger;
  }
  /*KULLANICI ADI SOYADI GET SET END*/


  /*KULLANICI KULLANICI ADI GET SET START*/
  public function getKullaniciKullaniciAdi($veriKolonArray)
  {
    return $this->kullaniciKullaniciAdi;
  }
  public function setKullaniciKullaniciAdi($yeniDeger)
  {
    $this->kullaniciKullaniciAdi = $yeniDeger;
  }
  /*KULLANICI KULLANICI ADI GET SET END*/


  /*KULLANICI PAROLASI GET SET START*/
  public function getKullaniciParolasi($veriKolonArray)
  {
    return $this->kullaniciParolasi;
  }
  public function setKullaniciParolasi($yeniDeger)
  {
    $this->kullaniciParolasi = $yeniDeger;
  }
  /*KULLANICI PAROLASI GET SET END*/


  /*KULLANICI YETKİLERİ GET SET START*/
  public function getKullaniciYetkileri($veriKolonArray)
  {
    return $this->kullaniciYetkileri;
  }
  public function setKullaniciYetkileri($yeniDeger)
  {
    $this->kullaniciYetkileri = $yeniDeger;
  }
  /*KULLANICI YETKİLERİ GET SET END*/

}

?>
