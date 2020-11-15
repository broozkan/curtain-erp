<?php

/**
*
*/
class SoftwareSetting extends Controller
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


  /* UPDATE SOFTWARE */
  public function updateSoftwareSetting()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);


        $model = new Model();

        /*inserting software*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_software_settings SET
          software_setting_cost_secure_amount=:software_setting_cost_secure_amount
          WHERE software_setting_id=:software_setting_id
          "
        );
        $response = $stmt->execute([
          "software_setting_cost_secure_amount"=>$data["txtSoftwareSettingCostSecureAmount"],
          "software_setting_id"=>$data["txtSoftwareSettingId"]
        ]);
        /*inserting software*/

        $model = null;






      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*software informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_software_settings WHERE software_setting_id=(SELECT MAX(software_setting_id) FROM tbl_software_settings)");
      $stmt->execute();
      $softwareInformations = $stmt->fetch();
      /*software informations*/

      $model = null;

      $this->view->softwareInformations = $softwareInformations;
      $this->view->render('informations/software-setting/update-software-setting');
    }

  }
  /* UPDATE SOFTWARE */





}
