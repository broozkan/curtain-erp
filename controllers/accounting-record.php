<?php

/**
*
*/
class AccountingRecord extends Controller
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
  public function accountingRecordList()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* limit, offset and sql*/
      $limit = 100;
      $offset = 0;
      $sql = "";
      $params = array();
      /* limit, offset and sql*/


      /* adding filter */
      if ($data["filters"]["txtAccountingRecordCustomerId"] != "") {
        $sql .= " AND tbl_customers.customer_name LIKE :customer_name";
        $params["customer_name"] = "%".$data["filters"]["txtAccountingRecordCustomerId"]."%";
      }
      /* adding filter */



      $model = new Model();

      $accountingRecords = array();


      /*purchase invoice records */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_purchase_invoices.purchase_invoice_id,
        tbl_purchase_invoices.purchase_invoice_total,
        tbl_purchase_invoices.purchase_invoice_maturity_date,
        tbl_suppliers.supplier_name
        FROM tbl_purchase_invoices
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_purchase_invoices.purchase_invoice_supplier_id
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $purchaseInvoiceRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($purchaseInvoiceRecords); $i++) {
        $accountingRecords[] = array(
          "record_account"=>$purchaseInvoiceRecords[$i]["supplier_name"],
          "record_amount"=>$purchaseInvoiceRecords[$i]["purchase_invoice_total"],
          "record_title"=>"Alış Faturası",
          "record_date"=>$purchaseInvoiceRecords[$i]["purchase_invoice_maturity_date"],
        );
      }
      /*purchase invoice records */


      /*sale invoice records */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_sale_invoices.sale_invoice_id,
        tbl_sale_invoices.sale_invoice_total,
        tbl_sale_invoices.sale_invoice_maturity_date,
        tbl_customers.customer_name
        FROM tbl_sale_invoices
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_sale_invoices.sale_invoice_customer_id
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $saleInvoiceRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($saleInvoiceRecords); $i++) {
        $accountingRecords[] = array(
          "record_account"=>$saleInvoiceRecords[$i]["customer_name"],
          "record_amount"=>$saleInvoiceRecords[$i]["sale_invoice_total"],
          "record_title"=>"Satış Faturası",
          "record_date"=>$saleInvoiceRecords[$i]["sale_invoice_maturity_date"],
        );
      }
      /*sale invoice records */


      /*tbl_payments records */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_payments.payment_id,
        tbl_payments.payment_amount,
        tbl_payments.payment_date,
        tbl_suppliers.supplier_name
        FROM tbl_payments
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_payments.payment_supplier_id
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $paymentRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($paymentRecords); $i++) {
        $accountingRecords[] = array(
          "record_account"=>$paymentRecords[$i]["supplier_name"],
          "record_amount"=>$paymentRecords[$i]["payment_amount"],
          "record_title"=>"Ödemeler",
          "record_date"=>$paymentRecords[$i]["payment_date"],
        );
      }
      /*tbl_payments records */


      /*tbl_collections records */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_collections.collection_id,
        tbl_collections.collection_amount,
        tbl_collections.collection_date,
        tbl_customers.customer_name
        FROM tbl_collections
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_collections.collection_customer_id
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $collectionRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($collectionRecords); $i++) {
        $accountingRecords[] = array(
          "record_account"=>$collectionRecords[$i]["customer_name"],
          "record_amount"=>$collectionRecords[$i]["collection_amount"],
          "record_title"=>"Tahsilatlar",
          "record_date"=>$collectionRecords[$i]["collection_date"],
        );
      }
      /*tbl_collections records */


      /*tbl_received_checks records */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_received_checks.received_check_id,
        tbl_received_checks.received_check_amount,
        tbl_received_checks.received_check_maturity_date,
        tbl_customers.customer_name
        FROM tbl_received_checks
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_received_checks.received_check_customer_id
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $receivedCheckRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($receivedCheckRecords); $i++) {
        $accountingRecords[] = array(
          "record_account"=>$receivedCheckRecords[$i]["customer_name"],
          "record_amount"=>$receivedCheckRecords[$i]["received_check_amount"],
          "record_title"=>"Alınan Çekler",
          "record_date"=>$receivedCheckRecords[$i]["received_check_maturity_date"],
        );
      }
      /*tbl_received_checks records */


      /*tbl_given_checks records */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_given_checks.given_check_id,
        tbl_given_checks.given_check_amount,
        tbl_given_checks.given_check_date,
        tbl_suppliers.supplier_name
        FROM tbl_given_checks
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_given_checks.given_check_supplier_id
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $givenCheckRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($givenCheckRecords); $i++) {
        $accountingRecords[] = array(
          "record_account"=>$receivedCheckRecords[$i]["supplier_name"],
          "record_amount"=>$givenCheckRecords[$i]["given_check_amount"],
          "record_title"=>"Verilen Çekler",
          "record_date"=>$givenCheckRecords[$i]["given_check_maturity_date"],
        );
      }
      /*tbl_given_checks records */


      /*credit installment records */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_credits.credit_id,
        tbl_credits.credit_bank_id,
        tbl_banks.bank_name
        FROM tbl_credits
        LEFT JOIN tbl_banks ON tbl_banks.bank_id=tbl_credits.credit_bank_id
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $creditInformations = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($creditInformations); $i++) {
        $stmt = $model->dbh->prepare("SELECT credit_payment_installment_amount,credit_payment_date FROM tbl_credit_payments WHERE credit_payment_credit_id=:credit_id");
        $stmt->execute(["credit_id"=>$creditInformations[$i]["credit_id"]]);
        $creditInstallments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($a=0; $a < count($creditInstallments); $a++) {
          $creditInstallments[$a]["bank_name"] = $creditInformations[$i]["bank_name"];
        }
        for ($i=0; $i < count($creditInstallments); $i++) {
          $accountingRecords[] = array(
            "record_account"=>$creditInstallments[$i]["bank_name"],
            "record_amount"=>$creditInstallments[$i]["credit_payment_installment_amount"],
            "record_title"=>"Kredi Taksiti",
            "record_date"=>$creditInstallments[$i]["credit_payment_date"],
          );
        }
      }
      /*credit installment records */


      $price = array();
      foreach ($accountingRecords as $key => $row)
      {
          $price[$key] = $row['record_date'];
      }
      array_multisort($price, SORT_DESC, $accountingRecords);



      $model = null;

      echo json_encode(array(
        "data"=>$accountingRecords,
        "totalPageNumber"=>0,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('apps/accounting/accounting-record/accounting-record-list');
    }

  }
  /* RECEIVED CHECK LIST */



}
