<?php

/**
*
*/
class Bank extends Controller
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

  /* BANK LIST */
  public function bankList()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* limit, offset and sql*/
      $limit = $data["itemPerPage"];
      $offset = ($data["pageNumber"] - 1) * $limit;
      $sql = "";
      $params = array();
      /* limit, offset and sql*/


      /* adding filter */
      if ($data["filters"]["txtBankName"] != "") {
        $sql .= "AND bank_name LIKE :bank_name";
        $params["bank_name"] = "%".$data["filters"]["txtBankName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting banks*/
      $stmt = $model->dbh->prepare(
        "SELECT bank_id,bank_name
        FROM tbl_banks
        WHERE bank_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $banks = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting banks*/

      /* total bank number */
      $stmt = $model->dbh->prepare("SELECT COUNT(bank_id) AS total_bank_number FROM tbl_banks WHERE bank_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalBankNumber = $stmt->fetch()["total_bank_number"];
      /* total bank number */

      /* total page number */
      $totalPageNumber = $totalBankNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$banks,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/bank/bank-list');
    }

  }
  /* BANK LIST */

  /* NEW BANK */
  public function newBank()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting bank*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_banks SET
        bank_name=:bank_name
        "
      );
      $response = $stmt->execute([
        "bank_name"=>$data["txtBankName"]
      ]);
      /*inserting bank*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/bank/new-bank');
    }

  }
  /* NEW BANK */

  /* UPDATE BANK */
  public function updateBank($bankId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting bank*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_banks SET
        bank_name=:bank_name
        WHERE bank_id=:bank_id
        "
      );
      $response = $stmt->execute([
        "bank_name"=>$data["txtBankName"],
        "bank_id"=>$data["txtBankId"]
      ]);
      /*inserting bank*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*bank informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_banks WHERE bank_id=:bank_id");
      $stmt->execute(["bank_id"=>$bankId]);
      $bankInformations = $stmt->fetch();
      /*bank informations*/

      $model = null;

      $this->view->bankInformations = $bankInformations;
      $this->view->render('units/bank/update-bank');
    }

  }
  /* UPDATE BANK */


  /* DELETE BANK */
  public function deleteBank($bankId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting bank*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_banks WHERE bank_id=:bank_id");
      $response = $stmt->execute(["bank_id"=>$bankId]);
      /*deleting bank*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE BANK */




}
