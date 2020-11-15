<?php

/**
*
*/
class Email extends Controller
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


  /* UPDATE EMAIL */
  public function updateEmail()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);
      $permission = "true";



      if ($permission == "true") {
        $model = new Model();

        /*inserting email*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_email SET
          email_host=:email_host,
          email_username=:email_username,
          email_password=:email_password,
          email_port=:email_port,
          email_from_name=:email_from_name
          WHERE email_id=:email_id
          "
        );
        $response = $stmt->execute([
          "email_host"=>$data["txtEmailHost"],
          "email_username"=>$data["txtEmailUsername"],
          "email_password"=>$data["txtEmailPassword"],
          "email_port"=>$data["txtEmailPort"],
          "email_from_name"=>$data["txtEmailFromName"],
          "email_id"=>$data["txtEmailId"]
        ]);
        /*inserting email*/

        $model = null;
      }

      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*email informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_email WHERE email_id=(SELECT MAX(email_id) FROM tbl_email)");
      $stmt->execute();
      $emailInformations = $stmt->fetch();
      /*email informations*/

      $model = null;

      $this->view->emailInformations = $emailInformations;
      $this->view->render('informations/email/update-email');
    }

  }
  /* UPDATE EMAIL */





}
