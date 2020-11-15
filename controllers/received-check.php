<?php

/**
*
*/
class ReceivedCheck extends Controller
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

  /* RECEIVED CHECK LIST */
  public function receivedCheckList()
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
      if ($data["filters"]["txtReceivedCheckCustomerId"] != "") {
        $sql .= " AND tbl_customers.customer_name LIKE :customer_name";
        $params["customer_name"] = "%".$data["filters"]["txtReceivedCheckCustomerId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtReceivedCheckCategoryId"] != "") {
        $sql .= " AND tbl_categories.category_name LIKE :category_name";
        $params["category_name"] = "%".$data["filters"]["txtReceivedCheckCategoryId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtReceivedCheckMaturityDate"] != "") {
        $sql .= " AND DATE(tbl_received_checks.received_check_maturity_date)=:maturity_date";
        $params["maturity_date"] = $data["filters"]["txtReceivedCheckMaturityDate"];
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtReceivedCheckCashId"] != "") {
        $sql .= " AND tbl_cashes.cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtReceivedCheckCashId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtReceivedCheckBankId"] != "") {
        $sql .= " AND tbl_banks.bank_name LIKE :bank_name";
        $params["bank_name"] = "%".$data["filters"]["txtReceivedCheckBankId"]."%";
      }
      /* adding filter */


      $model = new Model();


      /*selecting receivedChecks*/
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_received_checks.received_check_id,
        tbl_customers.customer_name,
        tbl_categories.category_name,
        tbl_received_checks.received_check_maturity_date,
        tbl_cashes.cash_name,
        tbl_banks.bank_name,
        tbl_received_checks.received_check_amount
        FROM tbl_received_checks
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_received_checks.received_check_customer_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_received_checks.received_check_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_received_checks.received_check_cash_id
        INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_received_checks.received_check_bank_id
        WHERE tbl_received_checks.received_check_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $receivedChecks = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting receivedChecks*/


      /* total receivedCheck number */

      $stmt = $model->dbh->prepare(
        "SELECT
        COUNT(tbl_received_checks.received_check_id) AS total_received_check_number
        FROM tbl_received_checks
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_received_checks.received_check_customer_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_received_checks.received_check_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_received_checks.received_check_cash_id
        INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_received_checks.received_check_bank_id
        WHERE tbl_received_checks.received_check_id IS NOT NULL
        $sql"
      );
      $stmt->execute($params);
      $totalReceivedCheckNumber = $stmt->fetch()["total_received_check_number"];
      /* total receivedCheck number */

      /* total page number */
      $totalPageNumber = $totalReceivedCheckNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$receivedChecks,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $model = new Model();

      /* categories */
      $stmt = $model->dbh->prepare("SELECT category_id,category_name FROM tbl_categories");
      $stmt->execute();
      $categories = $stmt->fetchAll();
      /* categories */

      $model = null;

      $this->view->categories = $categories;
      $this->view->render('apps/accounting/received-check/received-check-list');
    }

  }
  /* RECEIVED CHECK LIST */

  /* NEW RECEIVED CHECK */
  public function newReceivedCheck()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* photo file control, upload */
      if (isset($_FILES["photo"])) {
        if(file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
          $photoName = $_FILES["photo"]["name"];
          $uploadFolder = $this->pathPhp."assets/images/received-checks/".$photoName;
          $photo=$_FILES["photo"]["tmp_name"];

          if ($_FILES["photo"]["size"] > 1048576) {
            $permission = "false";
            $response = "Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }else {
            $permission = "true";
          }

          if(move_uploaded_file($photo,$uploadFolder) && $permission == "true"){
            $permission == "true";
            $response = true;
          }else{
            $response = "Fotoğraf yüklenemediği için hata alındı. Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }
        }else {
          $photoName = null;
        }
      }else {
        $photoName = null;
      }
      /* photo file control, upload */

      $model = new Model();

      /*inserting received check*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_received_checks SET
        received_check_customer_id=:received_check_customer_id,
        received_check_category_id=:received_check_category_id,
        received_check_maturity_date=:received_check_maturity_date,
        received_check_type=:received_check_type,
        received_check_file_number=:received_check_file_number,
        received_check_cash_id=:received_check_cash_id,
        received_check_bank_id=:received_check_bank_id,
        received_check_state=:received_check_state,
        received_check_amount=:received_check_amount,
        received_check_description=:received_check_description,
        received_check_photo=:received_check_photo
        "
      );
      $response = $stmt->execute([
        "received_check_customer_id"=>$data["txtReceivedCheckCustomerId"],
        "received_check_category_id"=>$data["txtReceivedCheckCategoryId"],
        "received_check_maturity_date"=>$data["txtReceivedCheckMaturityDate"],
        "received_check_type"=>$data["txtReceivedCheckType"],
        "received_check_file_number"=>$data["txtReceivedCheckFileNumber"],
        "received_check_cash_id"=>$data["txtReceivedCheckCashId"],
        "received_check_bank_id"=>$data["txtReceivedCheckBankId"],
        "received_check_state"=>$data["txtReceivedCheckState"],
        "received_check_amount"=>$data["txtReceivedCheckAmount"],
        "received_check_description"=>$data["txtReceivedCheckDescription"],
        "received_check_photo"=>$photoName
      ]);
      /*inserting received check*/
      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $this->view->render('apps/accounting/received-check/new-received-check');
    }

  }
  /* NEW RECEIVED CHECK */

  /* UPDATE RECEIVED CHECK */
  public function updateReceivedCheck($receivedCheckId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* photo file control, upload */
      if (isset($_FILES["photo"])) {
        if(file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
          $photoName = $_FILES["photo"]["name"];
          $uploadFolder = $this->pathPhp."assets/images/received-checks/".$photoName;
          $photo=$_FILES["photo"]["tmp_name"];

          if ($_FILES["photo"]["size"] > 1048576) {
            $permission = "false";
            $response = "Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }else {
            $permission = "true";
          }

          if(move_uploaded_file($photo,$uploadFolder) && $permission == "true"){
            $permission == "true";
            $response = true;
          }else{
            $response = "Fotoğraf yüklenemediği için hata alındı. Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }
        }else {
          $photoName = null;
        }
      }else {
        $photoName = null;
      }
      /* photo file control, upload */

      $model = new Model();

      /*inserting received check*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_received_checks SET
        received_check_customer_id=:received_check_customer_id,
        received_check_category_id=:received_check_category_id,
        received_check_maturity_date=:received_check_maturity_date,
        received_check_type=:received_check_type,
        received_check_file_number=:received_check_file_number,
        received_check_cash_id=:received_check_cash_id,
        received_check_bank_id=:received_check_bank_id,
        received_check_state=:received_check_state,
        received_check_amount=:received_check_amount,
        received_check_description=:received_check_description,
        received_check_photo=:received_check_photo
        WHERE received_check_id=:received_check_id
        "
      );
      $response = $stmt->execute([
        "received_check_customer_id"=>$data["txtReceivedCheckCustomerId"],
        "received_check_category_id"=>$data["txtReceivedCheckCategoryId"],
        "received_check_maturity_date"=>$data["txtReceivedCheckMaturityDate"],
        "received_check_type"=>$data["txtReceivedCheckType"],
        "received_check_file_number"=>$data["txtReceivedCheckFileNumber"],
        "received_check_cash_id"=>$data["txtReceivedCheckCashId"],
        "received_check_bank_id"=>$data["txtReceivedCheckBankId"],
        "received_check_state"=>$data["txtReceivedCheckState"],
        "received_check_amount"=>$data["txtReceivedCheckAmount"],
        "received_check_description"=>$data["txtReceivedCheckDescription"],
        "received_check_photo"=>$photoName,
        "received_check_id"=>$receivedCheckId
      ]);
      /*inserting received check*/
      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*receivedCheck informations*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_received_checks.*,tbl_customers.customer_name,tbl_categories.category_name,tbl_cashes.cash_name,tbl_banks.bank_name,
        tbl_suppliers.supplier_name,tbl_received_checks.received_check_vouch_supplier_id
        FROM tbl_received_checks
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_received_checks.received_check_customer_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_received_checks.received_check_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_received_checks.received_check_cash_id
        INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_received_checks.received_check_bank_id
        LEFT JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_received_checks.received_check_vouch_supplier_id
        WHERE received_check_id=:received_check_id"
      );
      $stmt->execute(["received_check_id"=>$receivedCheckId]);
      $receivedCheckInformations = $stmt->fetch();
      /*receivedCheck informations*/

      $this->view->receivedCheckInformations = $receivedCheckInformations;
      $this->view->render('apps/accounting/received-check/update-received-check');
    }

  }
  /* UPDATE RECEIVED CHECK */


  /* DELETE RECEIVED CHECK */
  public function deleteReceivedCheck($receivedCheckId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting received check*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_received_checks WHERE received_check_id=:received_check_id");
      $response = $stmt->execute(["received_check_id"=>$receivedCheckId]);
      /*deleting received check*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE RECEIVED CHECK */

  /* VOUCH RECEIVED CHECK */
  public function vouchReceivedCheck($receivedCheckId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting received check*/
      $stmt = $model->dbh->prepare("UPDATE tbl_received_checks SET received_check_vouch_supplier_id=:received_check_vouch_supplier_id WHERE received_check_id=:received_check_id");
      $response = $stmt->execute([
        "received_check_vouch_supplier_id"=>$data["txtVouchReceivedCheckSupplierId"],
        "received_check_id"=>$receivedCheckId
      ]);
      /*deleting received check*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* VOUCH RECEIVED CHECK */


}
