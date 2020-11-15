<?php

/**
*
*/
class SaleInvoice extends Controller
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

  /* SALE INVOICE LIST */
  public function saleInvoiceList()
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
      if (@$data["filters"]["txtSaleInvoiceCustomerId"] != "") {
        $sql .= " AND tbl_customers.customer_name LIKE :customer_name";
        $params["customer_name"] = "%".$data["filters"]["txtSaleInvoiceCustomerId"]."%";
      }
      /* adding filter */


      /* adding filter */
      if (@$data["filters"]["txtSaleInvoiceMaturityDate"] != "") {
        $sql .= " AND DATE(tbl_sale_invoices.sale_invoice_maturity_date)=:maturity_date";
        $params["maturity_date"] = $data["filters"]["txtSaleInvoiceMaturityDate"];
      }
      /* adding filter */

      /* adding filter */
      if (@$data["filters"]["txtSaleInvoiceCashId"] != "") {
        $sql .= " AND tbl_cashes.cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtSaleInvoiceCashId"]."%";
      }
      /* adding filter */




      $model = new Model();


      /*selecting saleInvoices*/
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_sale_invoices.sale_invoice_id,
        tbl_customers.customer_name,
        tbl_sale_invoices.sale_invoice_maturity_date,
        tbl_sale_invoices.sale_invoice_total
        FROM tbl_sale_invoices
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_sale_invoices.sale_invoice_customer_id
        LEFT JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_sale_invoices.sale_invoice_cash_id
        WHERE tbl_sale_invoices.sale_invoice_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $saleInvoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting saleInvoices*/


      /* total saleInvoice number */

      $stmt = $model->dbh->prepare(
        "SELECT
        COUNT(tbl_sale_invoices.sale_invoice_id) AS total_sale_invoice_number
        FROM tbl_sale_invoices
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_sale_invoices.sale_invoice_customer_id
        LEFT JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_sale_invoices.sale_invoice_cash_id
        WHERE tbl_sale_invoices.sale_invoice_id IS NOT NULL
        $sql"
      );
      $stmt->execute($params);
      $totalSaleInvoiceNumber = $stmt->fetch()["total_sale_invoice_number"];
      /* total saleInvoice number */

      /* total page number */
      $totalPageNumber = $totalSaleInvoiceNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$saleInvoices,
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
      $this->view->render('apps/accounting/sale-invoice/sale-invoice-list');
    }

  }
  /* SALE INVOICE LIST */

  /* NEW SALE INVOICE */
  public function newSaleInvoice()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);


      $model = new Model();

      if (!isset($data["txtSaleInvoiceStockAddition"])) {
        $data["txtSaleInvoiceStockAddition"] = 0;
      }

      if ($data["txtSaleInvoiceCashId"] == "") {
        $data["txtSaleInvoiceCashId"] = null;
      }

      /*inserting sale invoice*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_sale_invoices SET
        sale_invoice_customer_id=:sale_invoice_customer_id,
        sale_invoice_category_id=:sale_invoice_category_id,
        sale_invoice_maturity_date=:sale_invoice_maturity_date,
        sale_invoice_cash_id=:sale_invoice_cash_id,
        sale_invoice_note=:sale_invoice_note,
        sale_invoice_sub_total=:sale_invoice_sub_total,
        sale_invoice_tax_total=:sale_invoice_tax_total,
        sale_invoice_total=:sale_invoice_total,
        sale_invoice_stock_addition=:sale_invoice_stock_addition
        "
      );
      $response = $stmt->execute([
        "sale_invoice_customer_id"=>$data["txtSaleInvoiceCustomerId"],
        "sale_invoice_category_id"=>$data["txtSaleInvoiceCategoryId"],
        "sale_invoice_maturity_date"=>$data["txtSaleInvoiceMaturityDate"],
        "sale_invoice_cash_id"=>$data["txtSaleInvoiceCashId"],
        "sale_invoice_note"=>$data["txtSaleInvoiceNote"],
        "sale_invoice_sub_total"=>$data["txtSaleInvoiceSubTotal"],
        "sale_invoice_tax_total"=>$data["txtSaleInvoiceTaxTotal"],
        "sale_invoice_total"=>$data["txtSaleInvoiceTotal"],
        "sale_invoice_stock_addition"=>$data["txtSaleInvoiceStockAddition"]
      ]);
      $invoiceId = $model->dbh->lastInsertId();
      // print_r($stmt->errorInfo());
      /*inserting sale invoice*/

      if ($response == true) {
        for ($i=0; $i < count($data["txtSaleInvoiceItemProductId"]); $i++) {
          $stmt = $model->dbh->prepare(
            "INSERT INTO tbl_sale_invoice_products SET
            sale_invoice_product_invoice_id=:sale_invoice_product_invoice_id,
            sale_invoice_product_product_id=:sale_invoice_product_product_id,
            sale_invoice_product_product_unit_id=:sale_invoice_product_product_unit_id,
            sale_invoice_product_product_piece=:sale_invoice_product_product_piece,
            sale_invoice_product_product_unit_purchase_price=:sale_invoice_product_product_unit_purchase_price,
            sale_invoice_product_product_unit_sale_price=:sale_invoice_product_product_unit_sale_price,
            sale_invoice_product_product_tax_id=:sale_invoice_product_product_tax_id
            "
          );
          $response = $stmt->execute([
            "sale_invoice_product_invoice_id"=>$invoiceId,
            "sale_invoice_product_product_id"=>$data["txtSaleInvoiceItemProductId"][$i],
            "sale_invoice_product_product_unit_id"=>$data["txtSaleInvoiceItemUnitId"][$i],
            "sale_invoice_product_product_piece"=>$data["txtSaleInvoiceItemPiece"][$i],
            "sale_invoice_product_product_unit_purchase_price"=>$data["txtSaleInvoiceItemPurchasePrice"][$i],
            "sale_invoice_product_product_unit_sale_price"=>$data["txtSaleInvoiceItemSalePrice"][$i],
            "sale_invoice_product_product_tax_id"=>$data["txtSaleInvoiceItemTaxId"][$i]
          ]);
          // print_r($stmt->errorInfo());
        }
      }

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {


      $model = new Model();

      /*taxes*/
      $stmt = $model->dbh->prepare("SELECT tax_id,tax_name,tax_percentage FROM tbl_taxes");
      $stmt->execute();
      $taxes = $stmt->fetchAll();
      /*taxes*/

      /*units*/
      $stmt = $model->dbh->prepare("SELECT unit_id,unit_name FROM tbl_units");
      $stmt->execute();
      $units = $stmt->fetchAll();
      /*units*/

      /*cashes*/
      $stmt = $model->dbh->prepare("SELECT cash_id,cash_name FROM tbl_cashes");
      $stmt->execute();
      $cashes = $stmt->fetchAll();
      /*cashes*/

      $this->view->units = $units;
      $this->view->taxes = $taxes;
      $this->view->cashes = $cashes;
      $this->view->render('apps/accounting/sale-invoice/new-sale-invoice');
    }

  }
  /* NEW SALE INVOICE */

  /* UPDATE SALE INVOICE */
  public function updateSaleInvoice($saleInvoiceId = '')
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);


      $model = new Model();

      if (!isset($data["txtUpdateSaleInvoiceStockAddition"])) {
        $data["txtUpdateSaleInvoiceStockAddition"] = 0;
      }

      if ($data["txtUpdateSaleInvoiceCashId"] == "") {
        $data["txtUpdateSaleInvoiceCashId"] = null;
      }

      /*inserting sale invoice*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sale_invoices SET
        sale_invoice_customer_id=:sale_invoice_customer_id,
        sale_invoice_category_id=:sale_invoice_category_id,
        sale_invoice_maturity_date=:sale_invoice_maturity_date,
        sale_invoice_cash_id=:sale_invoice_cash_id,
        sale_invoice_note=:sale_invoice_note,
        sale_invoice_sub_total=:sale_invoice_sub_total,
        sale_invoice_tax_total=:sale_invoice_tax_total,
        sale_invoice_total=:sale_invoice_total,
        sale_invoice_stock_addition=:sale_invoice_stock_addition
        WHERE sale_invoice_id=:sale_invoice_id
        "
      );
      $response = $stmt->execute([
        "sale_invoice_customer_id"=>$data["txtUpdateSaleInvoiceCustomerId"],
        "sale_invoice_category_id"=>$data["txtUpdateSaleInvoiceCategoryId"],
        "sale_invoice_maturity_date"=>$data["txtUpdateSaleInvoiceMaturityDate"],
        "sale_invoice_cash_id"=>$data["txtUpdateSaleInvoiceCashId"],
        "sale_invoice_note"=>$data["txtUpdateSaleInvoiceNote"],
        "sale_invoice_sub_total"=>$data["txtUpdateSaleInvoiceSubTotal"],
        "sale_invoice_tax_total"=>$data["txtUpdateSaleInvoiceTaxTotal"],
        "sale_invoice_total"=>$data["txtUpdateSaleInvoiceTotal"],
        "sale_invoice_stock_addition"=>$data["txtUpdateSaleInvoiceStockAddition"],
        "sale_invoice_id"=>$data["txtUpdateSaleInvoiceId"]
      ]);
      $invoiceId = $data["txtUpdateSaleInvoiceId"];
      // print_r($stmt->errorInfo());
      /*inserting sale invoice*/

      if ($response == true) {
        $stmt = $model->dbh->prepare(
          "DELETE FROM  tbl_sale_invoice_products WHERE sale_invoice_product_invoice_id=:sale_invoice_product_invoice_id
          "
        );
        $response = $stmt->execute([
          "sale_invoice_product_invoice_id"=>$invoiceId
        ]);
      }

      if ($response == true) {

        for ($i=0; $i < count($data["txtUpdateSaleInvoiceItemProductId"]); $i++) {
          $stmt = $model->dbh->prepare(
            "INSERT INTO tbl_sale_invoice_products SET
            sale_invoice_product_invoice_id=:sale_invoice_product_invoice_id,
            sale_invoice_product_product_id=:sale_invoice_product_product_id,
            sale_invoice_product_product_unit_id=:sale_invoice_product_product_unit_id,
            sale_invoice_product_product_piece=:sale_invoice_product_product_piece,
            sale_invoice_product_product_unit_purchase_price=:sale_invoice_product_product_unit_purchase_price,
            sale_invoice_product_product_unit_sale_price=:sale_invoice_product_product_unit_sale_price,
            sale_invoice_product_product_tax_id=:sale_invoice_product_product_tax_id
            "
          );
          $response = $stmt->execute([
            "sale_invoice_product_invoice_id"=>$invoiceId,
            "sale_invoice_product_product_id"=>$data["txtUpdateSaleInvoiceItemProductId"][$i],
            "sale_invoice_product_product_unit_id"=>$data["txtSaleInvoiceItemUnitId"][$i],
            "sale_invoice_product_product_piece"=>$data["txtUpdateSaleInvoiceItemPiece"][$i],
            "sale_invoice_product_product_unit_sale_price"=>$data["txtUpdateSaleInvoiceItemSalePrice"][$i],
            "sale_invoice_product_product_unit_purchase_price"=>$data["txtUpdateSaleInvoiceItemPurchasePrice"][$i],
            "sale_invoice_product_product_tax_id"=>$data["txtSaleInvoiceItemTaxId"][$i]
          ]);

        }
      }

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();


      /*taxes*/
      $stmt = $model->dbh->prepare("SELECT tax_id,tax_name,tax_percentage FROM tbl_taxes");
      $stmt->execute();
      $taxes = $stmt->fetchAll();
      /*taxes*/

      /*units*/
      $stmt = $model->dbh->prepare("SELECT unit_id,unit_name FROM tbl_units");
      $stmt->execute();
      $units = $stmt->fetchAll();
      /*units*/

      /*cashes*/
      $stmt = $model->dbh->prepare("SELECT cash_id,cash_name FROM tbl_cashes");
      $stmt->execute();
      $cashes = $stmt->fetchAll();
      /*cashes*/

      $model = null;

      $this->view->units = $units;
      $this->view->taxes = $taxes;
      $this->view->cashes = $cashes;
      $this->view->saleInvoiceId = $saleInvoiceId;
      $this->view->render('apps/accounting/sale-invoice/update-sale-invoice');
    }

  }
  /* UPDATE SALE INVOICE */


  /* DELETE SALE INVOICE */
  public function deleteSaleInvoice($saleInvoiceId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting sale invoice*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_sale_invoices WHERE sale_invoice_id=:sale_invoice_id");
      $response = $stmt->execute(["sale_invoice_id"=>$saleInvoiceId]);
      /*deleting sale invoice*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE SALE INVOICE */


  /* SALE INVOICE DETAIL */
  public function saleInvoiceDetail()
  {
    $this->view->render("apps/accounting/sale-invoice/sale-invoice-detail");
  }
  /* SALE INVOICE DETAIL */


  /* GET SALE INVOICE INFORMATIONS */
  public function getSaleInvoiceInformations()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*sale invoice informations*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_sale_invoices.*,tbl_sale_invoice_products.*,tbl_sale_products.sale_product_name,tbl_customers.customer_name,
        tbl_categories.category_name,tbl_sale_products.sale_product_unit_id,
        (tbl_sale_invoice_products.sale_invoice_product_product_unit_sale_price * tbl_sale_invoice_products.sale_invoice_product_product_piece) AS row_total
        FROM tbl_sale_invoices
        INNER JOIN tbl_sale_invoice_products ON tbl_sale_invoice_products.sale_invoice_product_invoice_id=tbl_sale_invoices.sale_invoice_id
        LEFT JOIN tbl_sale_products ON  tbl_sale_products.sale_product_id=tbl_sale_invoice_products.sale_invoice_product_product_id
        LEFT JOIN tbl_customers ON tbl_customers.customer_id=tbl_sale_invoices.sale_invoice_customer_id
        LEFT JOIN tbl_categories ON tbl_categories.category_id=tbl_sale_invoices.sale_invoice_category_id
        WHERE tbl_sale_invoices.sale_invoice_id=:sale_invoice_id
        "
      );
      $stmt->execute(["sale_invoice_id"=>$data["txtSaleInvoiceId"]]);
      $saleInvoiceInformations = $stmt->fetchAll();
      /*sale invoice informations*/


      /*taxes*/
      $stmt = $model->dbh->prepare("SELECT tax_id,tax_name,tax_percentage FROM tbl_taxes");
      $stmt->execute();
      $taxes = $stmt->fetchAll();
      /*taxes*/

      /*units*/
      $stmt = $model->dbh->prepare("SELECT unit_id,unit_name FROM tbl_units");
      $stmt->execute();
      $units = $stmt->fetchAll();
      /*units*/

      $model = null;


      echo json_encode(array(
        "saleInvoiceInformations"=>$saleInvoiceInformations,
        "units"=>$units,
        "taxes"=>$taxes
      ));

    }
  }
  /* GET SALE INVOICE INFORMATIONS */
}
