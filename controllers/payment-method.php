<?php

/**
*
*/
class PaymentMethod extends Controller
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

  /* SALE PRODUCT LIST */
  public function paymentMethodList()
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
      if ($data["filters"]["txtPaymentMethodName"] != "") {
        $sql .= " AND tbl_payment_methods.payment_method_name LIKE :payment_method_name";
        $params["payment_method_name"] = "%".$data["filters"]["txtPaymentMethodName"]."%";
      }
      /* adding filter */


      $model = new Model();
      //
      // print_r($params);
      //
      // echo "SELECT tbl_payment_methods.payment_method_id,tbl_payment_methods.payment_method_name,tbl_categories.category_name
      // FROM tbl_payment_methods
      // INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_payment_methods.payment_method_category_id
      // WHERE tbl_payment_methods.payment_method_id IS NOT NULL
      // $sql
      // LIMIT $limit OFFSET $offset";

      /*selecting paymentMethods*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_payment_methods.payment_method_id,tbl_payment_methods.payment_method_name
        FROM tbl_payment_methods
        WHERE tbl_payment_methods.payment_method_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $paymentMethods = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting paymentMethods*/


      /* total paymentMethod number */
      $stmt = $model->dbh->prepare("SELECT COUNT(payment_method_id) AS total_payment_method_number FROM tbl_payment_methods WHERE payment_method_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalPaymentMethodNumber = $stmt->fetch()["total_payment_method_number"];
      /* total paymentMethod number */

      /* total page number */
      $totalPageNumber = $totalPaymentMethodNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$paymentMethods,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/payment-method/payment-method-list');
    }

  }
  /* SALE PRODUCT LIST */

  /* NEW SALE PRODUCT */
  public function newPaymentMethod()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting sale product*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_payment_methods SET
        payment_method_name=:payment_method_name
        "
      );
      $response = $stmt->execute([
        "payment_method_name"=>$data["txtPaymentMethodName"]
      ]);
      /*inserting sale product*/


      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/payment-method/new-payment-method');
    }

  }
  /* NEW SALE PRODUCT */

  /* UPDATE SALE PRODUCT */
  public function updatePaymentMethod($paymentMethodId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting sale product*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_payment_methods SET
        payment_method_name=:payment_method_name
        WHERE payment_method_id=:payment_method_id
        "
      );
      $response = $stmt->execute([
        "payment_method_name"=>$data["txtPaymentMethodName"],
        "payment_method_id"=>$data["txtPaymentMethodId"]
      ]);
      /*inserting sale product*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*paymentMethod informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_payment_methods WHERE payment_method_id=:payment_method_id");
      $stmt->execute(["payment_method_id"=>$paymentMethodId]);
      $paymentMethodInformations = $stmt->fetch();
      /*paymentMethod informations*/



      $model = null;


      $this->view->paymentMethodInformations = $paymentMethodInformations;
      $this->view->render('units/payment-method/update-payment-method');
    }

  }
  /* UPDATE SALE PRODUCT */


  /* DELETE SALE PRODUCT */
  public function deletePaymentMethod($paymentMethodId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting sale product*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_payment_methods WHERE payment_method_id=:payment_method_id");
      $response = $stmt->execute(["payment_method_id"=>$paymentMethodId]);
      /*deleting sale product*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE SALE PRODUCT */




}
