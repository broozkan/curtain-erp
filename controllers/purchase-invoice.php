<?php

/**
*
*/
class PurchaseInvoice extends Controller
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

  /* PURCHASE INVOICE LIST */
  public function purchaseInvoiceList()
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
      if (@$data["filters"]["txtPurchaseInvoiceSupplierId"] != "") {
        $sql .= " AND tbl_suppliers.supplier_name LIKE :supplier_name";
        $params["supplier_name"] = "%".$data["filters"]["txtPurchaseInvoiceSupplierId"]."%";
      }
      /* adding filter */


      /* adding filter */
      if (@$data["filters"]["txtPurchaseInvoiceMaturityDate"] != "") {
        $sql .= " AND DATE(tbl_purchase_invoices.purchase_invoice_maturity_date)=:maturity_date";
        $params["maturity_date"] = $data["filters"]["txtPurchaseInvoiceMaturityDate"];
      }
      /* adding filter */

      /* adding filter */
      if (@$data["filters"]["txtPurchaseInvoiceCashId"] != "") {
        $sql .= " AND tbl_cashes.cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtPurchaseInvoiceCashId"]."%";
      }
      /* adding filter */




      $model = new Model();


      /*selecting purchaseInvoices*/
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_purchase_invoices.purchase_invoice_id,
        tbl_suppliers.supplier_name,
        tbl_purchase_invoices.purchase_invoice_maturity_date,
        tbl_purchase_invoices.purchase_invoice_total
        FROM tbl_purchase_invoices
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_purchase_invoices.purchase_invoice_supplier_id
        LEFT JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_purchase_invoices.purchase_invoice_cash_id
        WHERE tbl_purchase_invoices.purchase_invoice_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $purchaseInvoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting purchaseInvoices*/


      /* total purchaseInvoice number */

      $stmt = $model->dbh->prepare(
        "SELECT
        COUNT(tbl_purchase_invoices.purchase_invoice_id) AS total_purchase_invoice_number
        FROM tbl_purchase_invoices
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_purchase_invoices.purchase_invoice_supplier_id
        LEFT JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_purchase_invoices.purchase_invoice_cash_id
        WHERE tbl_purchase_invoices.purchase_invoice_id IS NOT NULL
        $sql"
      );
      $stmt->execute($params);
      $totalPurchaseInvoiceNumber = $stmt->fetch()["total_purchase_invoice_number"];
      /* total purchaseInvoice number */

      /* total page number */
      $totalPageNumber = $totalPurchaseInvoiceNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$purchaseInvoices,
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
      $this->view->render('apps/accounting/purchase-invoice/purchase-invoice-list');
    }

  }
  /* PURCHASE INVOICE LIST */

  /* NEW PURCHASE INVOICE */
  public function newPurchaseInvoice()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);


      $model = new Model();

      if (!isset($data["txtPurchaseInvoiceStockAddition"])) {
        $data["txtPurchaseInvoiceStockAddition"] = 0;
      }

      if ($data["txtPurchaseInvoiceCashId"] == "") {
        $data["txtPurchaseInvoiceCashId"] = null;
      }

      /*inserting purchase invoice*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_purchase_invoices SET
        purchase_invoice_supplier_id=:purchase_invoice_supplier_id,
        purchase_invoice_category_id=:purchase_invoice_category_id,
        purchase_invoice_maturity_date=:purchase_invoice_maturity_date,
        purchase_invoice_cash_id=:purchase_invoice_cash_id,
        purchase_invoice_note=:purchase_invoice_note,
        purchase_invoice_sub_total=:purchase_invoice_sub_total,
        purchase_invoice_tax_total=:purchase_invoice_tax_total,
        purchase_invoice_total=:purchase_invoice_total,
        purchase_invoice_stock_addition=:purchase_invoice_stock_addition
        "
      );
      $response = $stmt->execute([
        "purchase_invoice_supplier_id"=>$data["txtPurchaseInvoiceSupplierId"],
        "purchase_invoice_category_id"=>$data["txtPurchaseInvoiceCategoryId"],
        "purchase_invoice_maturity_date"=>$data["txtPurchaseInvoiceMaturityDate"],
        "purchase_invoice_cash_id"=>$data["txtPurchaseInvoiceCashId"],
        "purchase_invoice_note"=>$data["txtPurchaseInvoiceNote"],
        "purchase_invoice_sub_total"=>$data["txtPurchaseInvoiceSubTotal"],
        "purchase_invoice_tax_total"=>$data["txtPurchaseInvoiceTaxTotal"],
        "purchase_invoice_total"=>$data["txtPurchaseInvoiceTotal"],
        "purchase_invoice_stock_addition"=>$data["txtPurchaseInvoiceStockAddition"]
      ]);
      $invoiceId = $model->dbh->lastInsertId();
      /*inserting purchase invoice*/

      if ($response == true) {
        for ($i=0; $i < count($data["txtPurchaseInvoiceItemProductId"]); $i++) {
          $stmt = $model->dbh->prepare(
            "INSERT INTO tbl_purchase_invoice_products SET
            purchase_invoice_product_invoice_id=:purchase_invoice_product_invoice_id,
            purchase_invoice_product_product_id=:purchase_invoice_product_product_id,
            purchase_invoice_product_product_unit_id=:purchase_invoice_product_product_unit_id,
            purchase_invoice_product_product_piece=:purchase_invoice_product_product_piece,
            purchase_invoice_product_product_unit_purchase_price=:purchase_invoice_product_product_unit_purchase_price,
            purchase_invoice_product_product_tax_id=:purchase_invoice_product_product_tax_id
            "
          );
          $response = $stmt->execute([
            "purchase_invoice_product_invoice_id"=>$invoiceId,
            "purchase_invoice_product_product_id"=>$data["txtPurchaseInvoiceItemProductId"][$i],
            "purchase_invoice_product_product_unit_id"=>$data["txtPurchaseInvoiceItemUnitId"][$i],
            "purchase_invoice_product_product_piece"=>$data["txtPurchaseInvoiceItemPiece"][$i],
            "purchase_invoice_product_product_unit_purchase_price"=>$data["txtPurchaseInvoiceItemPurchasePrice"][$i],
            "purchase_invoice_product_product_tax_id"=>$data["txtPurchaseInvoiceItemTaxId"][$i]
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

      $this->view->units = $units;
      $this->view->taxes = $taxes;
      $this->view->cashes = $cashes;
      $this->view->render('apps/accounting/purchase-invoice/new-purchase-invoice');
    }

  }
  /* NEW PURCHASE INVOICE */

  /* UPDATE PURCHASE INVOICE */
  public function updatePurchaseInvoice($purchaseInvoiceId = '')
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);


      $model = new Model();

      if (!isset($data["txtUpdatePurchaseInvoiceStockAddition"])) {
        $data["txtUpdatePurchaseInvoiceStockAddition"] = 0;
      }

      if ($data["txtUpdatePurchaseInvoiceCashId"] == "") {
        $data["txtUpdatePurchaseInvoiceCashId"] = null;
      }

      /*inserting purchase invoice*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_purchase_invoices SET
        purchase_invoice_supplier_id=:purchase_invoice_supplier_id,
        purchase_invoice_category_id=:purchase_invoice_category_id,
        purchase_invoice_maturity_date=:purchase_invoice_maturity_date,
        purchase_invoice_cash_id=:purchase_invoice_cash_id,
        purchase_invoice_note=:purchase_invoice_note,
        purchase_invoice_sub_total=:purchase_invoice_sub_total,
        purchase_invoice_tax_total=:purchase_invoice_tax_total,
        purchase_invoice_total=:purchase_invoice_total,
        purchase_invoice_stock_addition=:purchase_invoice_stock_addition
        WHERE purchase_invoice_id=:purchase_invoice_id
        "
      );
      $response = $stmt->execute([
        "purchase_invoice_supplier_id"=>$data["txtUpdatePurchaseInvoiceSupplierId"],
        "purchase_invoice_category_id"=>$data["txtUpdatePurchaseInvoiceCategoryId"],
        "purchase_invoice_maturity_date"=>$data["txtUpdatePurchaseInvoiceMaturityDate"],
        "purchase_invoice_cash_id"=>$data["txtUpdatePurchaseInvoiceCashId"],
        "purchase_invoice_note"=>$data["txtUpdatePurchaseInvoiceNote"],
        "purchase_invoice_sub_total"=>$data["txtUpdatePurchaseInvoiceSubTotal"],
        "purchase_invoice_tax_total"=>$data["txtUpdatePurchaseInvoiceTaxTotal"],
        "purchase_invoice_total"=>$data["txtUpdatePurchaseInvoiceTotal"],
        "purchase_invoice_stock_addition"=>$data["txtUpdatePurchaseInvoiceStockAddition"],
        "purchase_invoice_id"=>$data["txtUpdatePurchaseInvoiceId"]
      ]);
      $invoiceId = $data["txtUpdatePurchaseInvoiceId"];
      /*inserting purchase invoice*/

      if ($response == true) {
        $stmt = $model->dbh->prepare(
          "DELETE FROM  tbl_purchase_invoice_products WHERE purchase_invoice_product_invoice_id=:purchase_invoice_product_invoice_id
          "
        );
        $response = $stmt->execute([
          "purchase_invoice_product_invoice_id"=>$invoiceId
        ]);
      }

      if ($response == true) {

        for ($i=0; $i < count($data["txtUpdatePurchaseInvoiceItemProductId"]); $i++) {
          $stmt = $model->dbh->prepare(
            "INSERT INTO tbl_purchase_invoice_products SET
            purchase_invoice_product_invoice_id=:purchase_invoice_product_invoice_id,
            purchase_invoice_product_product_id=:purchase_invoice_product_product_id,
            purchase_invoice_product_product_unit_id=:purchase_invoice_product_product_unit_id,
            purchase_invoice_product_product_piece=:purchase_invoice_product_product_piece,
            purchase_invoice_product_product_unit_purchase_price=:purchase_invoice_product_product_unit_purchase_price,
            purchase_invoice_product_product_tax_id=:purchase_invoice_product_product_tax_id
            "
          );
          $response = $stmt->execute([
            "purchase_invoice_product_invoice_id"=>$invoiceId,
            "purchase_invoice_product_product_id"=>$data["txtUpdatePurchaseInvoiceItemProductId"][$i],
            "purchase_invoice_product_product_unit_id"=>$data["txtPurchaseInvoiceItemUnitId"][$i],
            "purchase_invoice_product_product_piece"=>$data["txtUpdatePurchaseInvoiceItemPiece"][$i],
            "purchase_invoice_product_product_unit_purchase_price"=>$data["txtUpdatePurchaseInvoiceItemPurchasePrice"][$i],
            "purchase_invoice_product_product_tax_id"=>$data["txtPurchaseInvoiceItemTaxId"][$i]
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
      $this->view->purchaseInvoiceId = $purchaseInvoiceId;
      $this->view->render('apps/accounting/purchase-invoice/update-purchase-invoice');
    }

  }
  /* UPDATE PURCHASE INVOICE */


  /* DELETE PURCHASE INVOICE */
  public function deletePurchaseInvoice($purchaseInvoiceId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting purchase invoice*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_purchase_invoices WHERE purchase_invoice_id=:purchase_invoice_id");
      $response = $stmt->execute(["purchase_invoice_id"=>$purchaseInvoiceId]);
      /*deleting purchase invoice*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE PURCHASE INVOICE */


  /* PURCHASE INVOICE DETAIL */
  public function purchaseInvoiceDetail()
  {
    $this->view->render("apps/accounting/purchase-invoice/purchase-invoice-detail");
  }
  /* PURCHASE INVOICE DETAIL */


  /* GET PURCHASE INVOICE INFORMATIONS */
  public function getPurchaseInvoiceInformations()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*purchase invoice informations*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_purchase_invoices.*,tbl_purchase_invoice_products.*,tbl_stock_products.stock_product_name,tbl_suppliers.supplier_name,
        tbl_categories.category_name,tbl_stock_products.stock_product_unit_id,
        (tbl_purchase_invoice_products.purchase_invoice_product_product_unit_purchase_price * tbl_purchase_invoice_products.purchase_invoice_product_product_piece) AS row_total
        FROM tbl_purchase_invoices
        INNER JOIN tbl_purchase_invoice_products ON tbl_purchase_invoice_products.purchase_invoice_product_invoice_id=tbl_purchase_invoices.purchase_invoice_id
        LEFT JOIN tbl_stock_products ON  tbl_stock_products.stock_product_id=tbl_purchase_invoice_products.purchase_invoice_product_product_id
        LEFT JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_purchase_invoices.purchase_invoice_supplier_id
        LEFT JOIN tbl_categories ON tbl_categories.category_id=tbl_purchase_invoices.purchase_invoice_category_id
        WHERE tbl_purchase_invoices.purchase_invoice_id=:purchase_invoice_id
        "
      );
      $stmt->execute(["purchase_invoice_id"=>$data["txtPurchaseInvoiceId"]]);
      $purchaseInvoiceInformations = $stmt->fetchAll();
      /*purchase invoice informations*/


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
        "purchaseInvoiceInformations"=>$purchaseInvoiceInformations,
        "units"=>$units,
        "taxes"=>$taxes
      ));

    }
  }
  /* GET PURCHASE INVOICE INFORMATIONS */
}
