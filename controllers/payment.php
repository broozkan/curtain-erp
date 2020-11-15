<?php

/**
*
*/
class Payment extends Controller
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

  /* PAYMENT LIST */
  public function paymentList()
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
      if ($data["filters"]["txtPaymentSupplierId"] != "") {
        $sql .= " AND tbl_suppliers.supplier_name LIKE :supplier_name";
        $params["supplier_name"] = "%".$data["filters"]["txtPaymentSupplierId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtPaymentCategoryId"] != "") {
        $sql .= " AND tbl_categories.category_name LIKE :category_name";
        $params["category_name"] = "%".$data["filters"]["txtPaymentCategoryId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtPaymentDate"] != "") {
        $sql .= " AND DATE(payment_date)=:payment_date";
        $params["payment_date"] = $data["filters"]["txtPaymentDate"];
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtPaymentCashId"] != "") {
        $sql .= " AND tbl_cashes.cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtPaymentCashId"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting payments*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_payments.payment_id,
        tbl_suppliers.supplier_name,
        tbl_categories.category_name,
        tbl_payments.payment_date,
        tbl_cashes.cash_name,
        tbl_payments.payment_amount
        FROM tbl_payments
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_payments.payment_supplier_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_payments.payment_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_payments.payment_cash_id
        WHERE tbl_payments.payment_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting payments*/

      /* total payment number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tbl_payments.payment_id) AS total_payment_number
      FROM tbl_payments
      INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_payments.payment_supplier_id
      INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_payments.payment_category_id
      INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_payments.payment_cash_id
      WHERE tbl_payments.payment_id IS NOT NULL
      $sql");
      $stmt->execute($params);
      $totalPaymentNumber = $stmt->fetch()["total_payment_number"];
      /* total payment number */

      /* total page number */
      $totalPageNumber = $totalPaymentNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$payments,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('apps/accounting/payment/payment-list');
    }

  }
  /* PAYMENT LIST */

  /* NEW PAYMENT */
  public function newPayment()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);


      if (!isset($data["txtPaymentRepeatPeriod"])) {

      }


      $model = new Model();

      /*inserting payment*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_payments SET
        payment_supplier_id=:payment_supplier_id,
        payment_category_id=:payment_category_id,
        payment_date=:payment_date,
        payment_cash_id=:payment_cash_id,
        payment_amount=:payment_amount,
        is_payment_repeat=:is_payment_repeat,
        payment_repeat_period=:payment_repeat_period
        "
      );
      $response = $stmt->execute([
        "payment_supplier_id"=>$data["txtPaymentSupplierId"],
        "payment_category_id"=>$data["txtPaymentCategoryId"],
        "payment_date"=>$data["txtPaymentDate"],
        "payment_cash_id"=>$data["txtPaymentCashId"],
        "payment_amount"=>$data["txtPaymentAmount"],
        "is_payment_repeat"=>$data["txtIsPaymentRepeat"],
        "payment_repeat_period"=>$data["txtPaymentRepeatPeriod"]
      ]);
      /*inserting payment*/


      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('apps/accounting/payment/new-payment');
    }

  }
  /* NEW PAYMENT */

  /* UPDATE PAYMENT */
  public function updatePayment($paymentId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*update payment*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_payments SET
        payment_supplier_id=:payment_supplier_id,
        payment_category_id=:payment_category_id,
        payment_date=:payment_date,
        payment_cash_id=:payment_cash_id,
        payment_amount=:payment_amount,
        is_payment_repeat=:is_payment_repeat,
        payment_repeat_period=:payment_repeat_period
        WHERE payment_id=:payment_id
        "
      );
      $response = $stmt->execute([
        "payment_supplier_id"=>$data["txtPaymentSupplierId"],
        "payment_category_id"=>$data["txtPaymentCategoryId"],
        "payment_date"=>$data["txtPaymentDate"],
        "payment_cash_id"=>$data["txtPaymentCashId"],
        "payment_amount"=>$data["txtPaymentAmount"],
        "is_payment_repeat"=>$data["txtIsPaymentRepeat"],
        "payment_repeat_period"=>$data["txtPaymentRepeatPeriod"],
        "payment_id"=>$data["txtPaymentId"]
      ]);
      /*update payment*/


      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*payment informations*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_payments.*,tbl_suppliers.supplier_name,tbl_categories.category_name,tbl_cashes.cash_name
        FROM tbl_payments
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_payments.payment_supplier_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_payments.payment_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_payments.payment_cash_id
        WHERE payment_id=:payment_id"

      );
      $stmt->execute(["payment_id"=>$paymentId]);
      $paymentInformations = $stmt->fetch();
      /*payment informations*/

      $model = null;

      $this->view->paymentInformations = $paymentInformations;
      $this->view->render('apps/accounting/payment/update-payment');
    }

  }
  /* UPDATE PAYMENT */


  /* DELETE PAYMENT */
  public function deletePayment($paymentId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting payment*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_payments WHERE payment_id=:payment_id");
      $response = $stmt->execute(["payment_id"=>$paymentId]);
      /*deleting payment*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE PAYMENT */




}
