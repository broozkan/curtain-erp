<?php

/**
*
*/
class Cash extends Controller
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

  /* CASH LIST */
  public function cashList()
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
      if ($data["filters"]["txtCashName"] != "") {
        $sql .= "AND cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtCashName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting cashs*/
      $stmt = $model->dbh->prepare(
        "SELECT cash_id,cash_name
        FROM tbl_cashes
        WHERE cash_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $cashs = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting cashs*/

      /* total cash number */
      $stmt = $model->dbh->prepare("SELECT COUNT(cash_id) AS total_cash_number FROM tbl_cashes WHERE cash_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalCashNumber = $stmt->fetch()["total_cash_number"];
      /* total cash number */

      /* total page number */
      $totalPageNumber = $totalCashNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$cashs,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));

    }else {
      $this->view->render('units/cash/cash-list');
    }

  }
  /* CASH LIST */

  /* NEW CASH */
  public function newCash()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*inserting cash*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_cashes SET
        cash_name=:cash_name,
        cash_beginning_balance=:cash_beginning_balance
        "
      );
      $response = $stmt->execute([
        "cash_name"=>$data["txtCashName"],
        "cash_beginning_balance"=>$data["txtCashBeginningBalance"]
      ]);
      /*inserting cash*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/cash/new-cash');
    }

  }
  /* NEW CASH */

  /* UPDATE CASH */
  public function updateCash($cashId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting cash*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_cashes SET
        cash_name=:cash_name,
        cash_beginning_balance=:cash_beginning_balance
        WHERE cash_id=:cash_id
        "
      );
      $response = $stmt->execute([
        "cash_name"=>$data["txtCashName"],
        "cash_beginning_balance"=>$data["txtCashBeginningBalance"],
        "cash_id"=>$data["txtCashId"]
      ]);
      /*inserting cash*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*cash informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_cashes WHERE cash_id=:cash_id");
      $stmt->execute(["cash_id"=>$cashId]);
      $cashInformations = $stmt->fetch();
      /*cash informations*/

      $model = null;

      $this->view->cashInformations = $cashInformations;
      $this->view->render('units/cash/update-cash');
    }

  }
  /* UPDATE CASH */


  /* DELETE CASH */
  public function deleteCash($cashId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting cash*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_cashes WHERE cash_id=:cash_id");
      $response = $stmt->execute(["cash_id"=>$cashId]);
      /*deleting cash*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE CASH */




}
