<?php

/**
*
*/
class Credit extends Controller
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
  public function creditList()
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
      if ($data["filters"]["txtCreditBankName"] != "") {
        $sql .= " AND tbl_banks.bank_name LIKE :bank_name";
        $params["bank_name"] = "%".$data["filters"]["txtCreditBankName"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtCreditCashId"] != "") {
        $sql .= " AND tbl_cashes.cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtCreditCashId"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting credits*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_credits.credit_id,
        tbl_banks.bank_name,
        tbl_cashes.cash_name,
        tbl_credits.credit_amount,
        tbl_credits.credit_note
        FROM tbl_credits
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_credits.credit_cash_id
        INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_credits.credit_bank_id
        WHERE tbl_credits.credit_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $credits = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting credits*/

      /* total credit number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tbl_credits.credit_id) AS total_credit_number
      FROM tbl_credits
      INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_credits.credit_cash_id
      INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_credits.credit_bank_id
      WHERE tbl_credits.credit_id IS NOT NULL
      $sql");
      $stmt->execute($params);
      $totalCreditNumber = $stmt->fetch()["total_credit_number"];
      /* total credit number */

      /* total page number */
      $totalPageNumber = $totalCreditNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$credits,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));

    }else {
      $this->view->render('apps/accounting/credit/credit-list');
    }

  }
  /* PAYMENT LIST */

  /* NEW PAYMENT */
  public function newCredit()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting credit*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_credits SET
        credit_bank_id=:credit_bank_id,
        credit_cash_id=:credit_cash_id,
        credit_amount=:credit_amount,
        credit_installment_count=:credit_installment_count,
        credit_installment_beginning_date=:credit_installment_beginning_date,
        credit_installment_period=:credit_installment_period,
        credit_note=:credit_note
        "
      );
      $response = $stmt->execute([
        "credit_bank_id"=>$data["txtCreditBankId"],
        "credit_cash_id"=>$data["txtCreditCashId"],
        "credit_amount"=>$data["txtCreditAmount"],
        "credit_installment_count"=>$data["txtCreditInstallmentCount"],
        "credit_installment_beginning_date"=>$data["txtCreditInstallmentBeginningDate"],
        "credit_installment_period"=>$data["txtCreditInstallmentPeriod"],
        "credit_note"=>$data["txtCreditNote"]
      ]);
      $creditId = $model->dbh->lastInsertId();
      /*inserting credit*/


      if ($response == true) {
        for ($i=0; $i < $data["txtCreditInstallmentCount"]; $i++) {
          if ($data["txtCreditInstallmentPeriod"] == 0) {
            $creditPaymentDate = date('Y-m-d', strtotime($data["txtCreditInstallmentBeginningDate"] . "+".$i." months") );
          }else {
            $creditPaymentDate = date('Y-m-d', strtotime($data["txtCreditInstallmentBeginningDate"] . "+".$i." years") );
          }

          $creditInstallmentAmount = $data["txtCreditAmount"] / $data["txtCreditInstallmentCount"];

          /*inserting credit payments*/
          $stmt = $model->dbh->prepare(
            "INSERT INTO tbl_credit_payments SET
            credit_payment_credit_id=:credit_payment_credit_id,
            credit_payment_cash_id=:credit_payment_cash_id,
            credit_payment_date=:credit_payment_date,
            credit_payment_installment_amount=:credit_payment_installment_amount,
            credit_payment_installment_paid_amount=:credit_payment_installment_paid_amount
            "
          );
          $response = $stmt->execute([
            "credit_payment_credit_id"=>$creditId,
            "credit_payment_cash_id"=>$data["txtCreditCashId"],
            "credit_payment_date"=>$creditPaymentDate,
            "credit_payment_installment_amount"=>$creditInstallmentAmount,
            "credit_payment_installment_paid_amount"=>0
          ]);
          /*inserting credit payments*/
        }

      }

      $model = null;

      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('apps/accounting/credit/new-credit');
    }

  }
  /* NEW PAYMENT */

  /* UPDATE PAYMENT */
  public function updateCredit($creditId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*update credit*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_credits SET
        credit_supplier_id=:credit_supplier_id,
        credit_category_id=:credit_category_id,
        credit_date=:credit_date,
        credit_cash_id=:credit_cash_id,
        credit_amount=:credit_amount
        WHERE credit_id=:credit_id
        "
      );
      $response = $stmt->execute([
        "credit_supplier_id"=>$data["txtCreditSupplierId"],
        "credit_category_id"=>$data["txtCreditCategoryId"],
        "credit_date"=>$data["txtCreditDate"],
        "credit_cash_id"=>$data["txtCreditCashId"],
        "credit_amount"=>$data["txtCreditAmount"],
        "credit_id"=>$data["txtCreditId"]
      ]);
      /*update credit*/


      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*credit informations*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_credits.*,tbl_suppliers.supplier_name,tbl_categories.category_name,tbl_cashes.cash_name
        FROM tbl_credits
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_credits.credit_supplier_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_credits.credit_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_credits.credit_cash_id
        WHERE credit_id=:credit_id"

      );
      $stmt->execute(["credit_id"=>$creditId]);
      $creditInformations = $stmt->fetch();
      /*credit informations*/

      $model = null;

      $this->view->creditInformations = $creditInformations;
      $this->view->render('apps/accounting/credit/update-credit');
    }

  }
  /* UPDATE PAYMENT */


  /* DELETE PAYMENT */
  public function deleteCredit($creditId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting credit*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_credits WHERE credit_id=:credit_id");
      $response = $stmt->execute(["credit_id"=>$creditId]);
      /*deleting credit*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE PAYMENT */




}
