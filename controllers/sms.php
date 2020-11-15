<?php

/**
*
*/
class Sms extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $page = 1;

  function __construct()
  {
    parent::__construct();

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->pathPhp."settings/session-check.php";
    }
  }


  /* UPDATE SMS */
  public function updateSms()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);
      $permission = "true";



      if ($permission == "true") {
        $model = new Model();

        /*inserting sms*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_sms SET
          sms_url=:sms_url,
          sms_username=:sms_username,
          sms_password=:sms_password,
          sms_originator=:sms_originator
          WHERE sms_id=:sms_id
          "
        );
        $response = $stmt->execute([
          "sms_url"=>$data["txtSmsUrl"],
          "sms_username"=>$data["txtSmsUsername"],
          "sms_password"=>$data["txtSmsPassword"],
          "sms_originator"=>$data["txtSmsOriginator"],
          "sms_id"=>$data["txtSmsId"]
        ]);
        /*inserting sms*/

        $model = null;
      }

      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*sms informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_sms WHERE sms_id=(SELECT MAX(sms_id) FROM tbl_sms)");
      $stmt->execute();
      $smsInformations = $stmt->fetch();
      /*sms informations*/

      $model = null;

      $this->view->smsInformations = $smsInformations;
      $this->view->render('informations/sms/update-sms');
    }

  }
  /* UPDATE SMS */

  // old system send sms
  public function sendSms($numbers,$mesaj,$baslik,$user,$pass,$bayi)
  {



    $postUrl = 'http://panel.sivastoplusms.net/xmlapi/sendsms';
    $username = $user; //Panel girişi yaptığınız Kullanıcı Adınız
    $password = $pass; //Panel girişi yaptığınız Şifreniz
    $originator = $baslik; //Buraya Başlık gireceksiniz
    $text = $mesaj;
    $receivers = "";
    for ($i=0; $i < count($numbers); $i++) {
      $receivers .= '<receiver>' . $numbers[$i] . '</receiver>';
    }

    $xmlStr = '
    <?xml version="1.0"?>
    <SMS>
    <authentication>
    <username>' . $username . '</username>
    <password>' . $password . '</password>
    </authentication>
    <message>
    <originator>' . $originator . '</originator>
    <text>' . $text . '</text>
    <unicode></unicode>
    </message>
    <receivers>' . $receivers . '</receivers>
    </SMS>';
    $postFields = 'XML=' . urlencode($xmlStr);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $postUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $yanit = curl_exec($ch);
    $xml=simplexml_load_string($yanit) or die("Error: Cannot create object");

    if($xml->status == "OK"){
      $response = true;
    }else {
      $response = "Mesaj gönderilemedi".$response;
    }
    return $response;
  }


  // new system send sms
  public function sendSmsNew($numbers,$mesaj,$baslik,$user,$pass,$bayi)
  {

    if(!is_array($numbers))
    {
      $numbers = [$numbers];
    }

    $gonderim = [];

    foreach($numbers as $k=>$v)
    {
      $gonderim[] = ['CustomField1' => $v,'Msisdn' => $k,'Name' => '','Surname' => ''];
    }



    $data = ['Credential' => ['Password' => $pass,'Username' => $user,'ResellerID' => $bayi],
    'Sms' => [
      'CanSendSmsToDuplicateMsisdn' => false,
      'DataCoding' => 'Default',
      'IsCreateFromTeplate' => true,
      'Route'=> 0,
      'SenderName' => $baslik,
      'SmsContent' => $mesaj,
      'SmsSendingType' => 'ByNumber',
      'SmsTitle' => date("d-m-Y H:i:s"),
      "ToGroups"	=> [0],
      'ValidityPeriod' => 0,
      'ToMsisdns' => $gonderim

    ]
  ];


  $data_string = json_encode($data);

  $ch = curl_init('http://web.movateksms.com/api/json/syncreply/SendInstantSms');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
  );
  $result = curl_exec($ch);
  $result = json_decode($result, true);
  if(isset($result['Status']['Code']) && $result['Status']['Code'] == 200){
    //Gönderim başarılı
    return true;
  }
  else{
    var_dump($result);
    //Gönderim Başarısız
    return false;
  }
}


/* SEND SMS */
public function sendSmsToCustomer($receivers = "",$text = "", $echo = true)
{

  $model = new Model();

  /*sms informations*/
  $stmt = $model->dbh->prepare("SELECT * FROM tbl_sms WHERE sms_id=(SELECT MAX(sms_id) FROM tbl_sms)");
  $stmt->execute();
  $smsInformations = $stmt->fetch();
  /*sms informations*/


  $postUrl = $smsInformations["sms_url"];
  $username = $smsInformations["sms_username"]; //Panel girişi yaptığınız Kullanıcı Adınız
  $password = $smsInformations["sms_password"]; //Panel girişi yaptığınız Şifreniz
  $originator = $smsInformations["sms_originator"];; //Buraya Başlık gireceksiniz

  if (isset($_POST["post"])) {
    $data = json_decode($_POST["post"],true);

  }

  if (@$data["txtSmsText"] != null) {
    $text = @$data["txtSmsText"];
    $receivers = @$data["txtReceiverCustomerIds"];
  }else {
    $data["txtSmsText"] = $text;
  }



  for ($i=0; $i < count($receivers); $i++) {

    /* customer informations */
    $stmt = $model->dbh->prepare("SELECT customer_name,customer_phone_number FROM tbl_customers WHERE customer_id=:customer_id");
    $stmt->execute(["customer_id"=>$receivers[$i]]);
    $customerInformations = $stmt->fetch();
    /* customer informations */
    // print_r($customerInformations);

    // numbers for new version
    // $numbers = [
    //   $customerInformations["customer_phone_number"] => '[isim]:'.$customerInformations["customer_name"].',[soyisim]:'
    // ];

    // numbers for old version
    $numbers[] = $customerInformations["customer_phone_number"];

    $response = $this->sendSms($numbers,$data["txtSmsText"],$originator,$username,$password,'9925');

  }

  if ($echo == true) {
    echo json_encode(array(
      "response"=>$response
    ));
  }else {
    return $response;
  }
}
/* SEND SMS */





}
