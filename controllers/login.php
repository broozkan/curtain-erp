<?php

/**
*
*/
class Login extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $page = 1;

  function __construct()
  {
    parent::__construct();
  }



  /* LOGIN PAGE */
  public function auth()
  {
    if (isset($_POST["auth"])) {
      $data = json_decode($_POST["auth"],true);

      $model = new Model();

      $stmt = $model->dbh->prepare(
        "SELECT employee_id,employee_name,employee_redirect_url FROM tbl_employees WHERE employee_username=:username AND employee_password=:password"
      );
      $stmt->execute([
        "username"=>$data["txtUsername"],
        "password"=>md5($data["txtPassword"]),
      ]);

      $userData = $stmt->fetch();

      if ($userData == false) {

        $response = "Kullanıcı adı veya parola hatalı!";

      }else {
        $response = true;
        $_SESSION["login"] = true;
        $_SESSION["employee_name"] = $userData["employee_name"];
        $_SESSION["employee_id"] = $userData["employee_id"];
      }

      $model = null;

      echo json_encode(array(
        "response"=>$response,
        "employeeRedirectUrl"=>$userData["employee_redirect_url"]
      ));

    }else {
      session_destroy();
      $this->view->render('login/auth');
    }
  }
  /* LOGIN PAGE */


}
