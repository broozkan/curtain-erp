<?php
/**
*
*/
class Smsler 
{

  public $postUrl = "http://panel.sivastoplusms.net/xmlapi/sendsms";
  public $username = "doganbirlik";
  public $password = "doganbirlik";
  public $originator = "DOGANBIRLIK";
  public $text;
  public $number;
  public $receiver;

  function __construct()
  {

  }




  /*SMS TEXT GET VE SET METODLARI*/
  public function getText()
  {
    return $this->text;
  }
  public function setText($yeniDeger)
  {
    $this->text = $yeniDeger;
  }
  /*SMS TEXT GET VE SET METODLARI*/


  /*SMS NUMBER GET VE SET METODLARI*/
  public function getNumber()
  {
    return $this->number;
  }
  public function setNumber($yeniDeger)
  {
    $this->number = $yeniDeger;
  }
  /*SMS NUMBER GET VE SET METODLARI*/


  public function smsGonder()
  {
    $this->receiver = "<receiver>".$this->number."</receiver>";

    $xmlStr = '
    <?xml version="1.0"?>
    <SMS>
    <authentication>
    <username>' . $this->username . '</username>
    <password>' . $this->password . '</password>
    </authentication>
    <message>
    <originator>' . $this->originator . '</originator>
    <text>' . $this->text . '</text>
    <unicode></unicode>
    </message>
    <receivers>' . $this->receiver . '</receivers>
    </SMS>';
    $postFields = 'XML=' . urlencode($xmlStr);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->postUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $yanit = curl_exec($ch);
    $xml=simplexml_load_string($yanit) or die("Error: Cannot create object");
    if($xml->status == "OK"){
      $yanit = true;
    }else {
      $yanit = "Mesaj gönderilemedi".$yanit;
    }

    return $yanit;
  }



}





?>
