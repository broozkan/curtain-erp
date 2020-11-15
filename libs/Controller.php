<?php
/**
*
*/



// require_once $_SERVER["DOCUMENT_ROOT"].'/'.$kurulumBilgileri["txtVersiyonNo"].'/dompdf/autoload.inc.php';
//
// use Dompdf\Dompdf;


class Controller
{
  public $pathPhp;
  public $pathHtml;
  public $values;
  public $permissions;

  

  function __construct()
  {
    $this->view = new View();
    @session_start();


    /*grup veritabanı ve diğer bilgileri*/
    $kurulumBilgileri = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json");
    /*grup veritabanı ve diğer bilgileri*/

    if ($kurulumBilgileri) {
      $kurulumBilgileri = json_decode($kurulumBilgileri,true);

      /*php constant yol*/
      $this->view->pathPhp = $_SERVER["DOCUMENT_ROOT"]."/";
      /*php constant yol*/

      /*html constant yol*/
      $this->view->pathHtml = $kurulumBilgileri["txtKokDizin"];
      /*html constant yol*/



      spl_autoload_register(function ($class_name) {
        if (file_exists($this->pathPhp."models/".$class_name . '.php')) {
          include $this->pathPhp."models/".$class_name . '.php';
        }
      });

    }


  }


  /*KULLANICI YETKİ SORGULAMA KODLARI*/
  public function checkPermission($permission)
  {
    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT employee_permissions FROM tbl_employees WHERE employee_id=:employee_id");
    $stmt->execute(["employee_id"=>$_SESSION["employee_id"]]);
    $userPermissions = $stmt->fetch()["employee_permissions"];
    $userPermissions = json_decode($userPermissions,true);

    if (in_array($permission,$userPermissions)) {
      return true;
    }else {
      return false;
    }

  }
  /*KULLANICI YETKİ SORGULAMA KODLARI*/


  public function fixDate($date)
  {
    $date = explode("-",$date);
    $date = $date[2]."-".$date[1]."-".$date[0];
    return $date;
  }

  public function fixDateTime($dateTime)
  {
    $dateTime = explode(" ",$dateTime);
    $date = explode("-",$dateTime[0]);
    $date = $date[2]."-".$date[1]."-".$date[0];
    $dateTime = $date." ".$dateTime[1];

    return $dateTime;
  }






  public function passwordControl($password,$passwordRepeat)
  {

    $model = new Model();

    if ($password == $passwordRepeat) {
      if (strlen($password) > 6) {
        if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))
        {
          return "true";
        }else {
          return "Parola nümerik (sayısal) ve metinsel ifade içermelidir!";
        }
      }else {
        return "Parola 6 karakterden uzun olmalıdır!";
      }
    }else {
      return "Parolalar uyuşmuyor!";
    }
  }


  public function usernameControl($username,$isUpdating = false)
  {
    $model = new Model();



    $stmt = $model->dbh->prepare(
      "SELECT employee_username FROM tbl_employees
       WHERE employee_username=:employee_username
       "
    );

    $stmt->execute(['employee_username'=>$username]);
    $matchedUsername = $stmt->fetchAll();

    if (count($matchedUsername) > 0) {

      if ($isUpdating == true) {
        return "true";
      }else {
        return "Kullanıcı adı başka bir kullanıcı tarafından kullanılmaktadır. Lütfen başka bir kullanıcı adı belirleyiniz!";
      }
    }else {
      return "true";
    }


    $model = null;
  }



}
