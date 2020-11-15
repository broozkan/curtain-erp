<?php

/**
*
*/
class Customer extends Controller
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

  /* EMPLOYEE LIST */
  public function customerList()
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
      if ($data["filters"]["txtCustomerName"] != "") {
        $sql .= "AND customer_name LIKE :customer_name";
        $params["customer_name"] = "%".$data["filters"]["txtCustomerName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting customers*/
      $stmt = $model->dbh->prepare(
        "SELECT customer_id,customer_name,customer_address,customer_email,customer_phone_number
        FROM tbl_customers
        WHERE customer_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting customers*/

      /* total customer number */
      $stmt = $model->dbh->prepare("SELECT COUNT(customer_id) AS total_customer_number FROM tbl_customers WHERE customer_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalCustomerNumber = $stmt->fetch()["total_customer_number"];
      /* total customer number */

      /* total page number */
      $totalPageNumber = $totalCustomerNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$customers,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));

    }else {
      $this->view->render('units/customer/customer-list');
    }

  }
  /* EMPLOYEE LIST */

  /* NEW EMPLOYEE */
  public function newCustomer()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting customer*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_customers SET
        customer_name=:customer_name,
        customer_address=:customer_address,
        customer_phone_number=:customer_phone_number,
        customer_email=:customer_email,
        customer_tax_number=:customer_tax_number,
        customer_tax_department=:customer_tax_department
        "
      );
      $response = $stmt->execute([
        "customer_name"=>$data["txtCustomerName"],
        "customer_address"=>$data["txtCustomerAddress"],
        "customer_phone_number"=>$data["txtCustomerPhoneNumber"],
        "customer_email"=>$data["txtCustomerEmail"],
        "customer_tax_number"=>$data["txtCustomerTaxNumber"],
        "customer_tax_department"=>$data["txtCustomerTaxDepartment"]
      ]);
      $lastInsertId = $model->dbh->lastInsertId();
      /*inserting customer*/

      $model = null;


      echo json_encode(array(
        "response"=>$response,
        "lastInsertId"=>$lastInsertId
      ));

    }else {
      $this->view->render('units/customer/new-customer');
    }

  }
  /* NEW EMPLOYEE */

  /* UPDATE EMPLOYEE */
  public function updateCustomer($customerId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



        $model = new Model();

        /*updating customer*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_customers SET
          customer_name=:customer_name,
          customer_address=:customer_address,
          customer_phone_number=:customer_phone_number,
          customer_email=:customer_email,
          customer_tax_number=:customer_tax_number,
          customer_tax_department=:customer_tax_department
          WHERE customer_id=:customer_id
          "
        );
        $response = $stmt->execute([
          "customer_name"=>$data["txtCustomerName"],
          "customer_address"=>$data["txtCustomerAddress"],
          "customer_phone_number"=>$data["txtCustomerPhoneNumber"],
          "customer_email"=>$data["txtCustomerEmail"],
          "customer_tax_number"=>$data["txtCustomerTaxNumber"],
          "customer_tax_department"=>$data["txtCustomerTaxDepartment"],
          "customer_id"=>$data["txtCustomerId"]
        ]);
        /*updating customer*/

        $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*customer informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_customers WHERE customer_id=:customer_id");
      $stmt->execute(["customer_id"=>$customerId]);
      $customerInformations = $stmt->fetch();
      /*customer informations*/

      $model = null;

      $this->view->customerInformations = $customerInformations;
      $this->view->render('units/customer/update-customer');
    }

  }
  /* UPDATE EMPLOYEE */


  /* DELETE EMPLOYEE */
  public function deleteCustomer($customerId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting customer*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_customers WHERE customer_id=:customer_id");
      $response = $stmt->execute(["customer_id"=>$customerId]);
      /*deleting customer*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE EMPLOYEE */


  /* EMPLOYEE PROFILE */
  public function customerProfile($customerId)
  {
    $model = new Model();

    /*customer informations*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_customers WHERE customer_id=:customer_id");
    $stmt->execute(["customer_id"=>$customerId]);
    $customerInformations = $stmt->fetch();
    /*customer informations*/


    /* customer's sale cost total  */
    $productPurchasePricesTotal = 0;

    /* from sale list */
    $stmt = $model->dbh->prepare(
      "SELECT tbl_sale_informations.sale_information_product_purchase_prices,tbl_sale_informations.sale_information_product_pieces
      FROM tbl_sale_informations
      INNER JOIN tbl_sales ON tbl_sales.sale_id=tbl_sale_informations.sale_information_sale_id
      WHERE tbl_sales.sale_customer_id=:customer_id"
    );
    $stmt->execute(["customer_id"=>$customerId]);
    $saleInformations = $stmt->fetchAll();

    for ($i=0; $i < count($saleInformations); $i++) {
      $customerSalesProductPurchasePrices = json_decode($saleInformations[$i]["sale_information_product_purchase_prices"],true);
      $customerSalesProductPieces = json_decode($saleInformations[$i]["sale_information_product_pieces"],true);

      for ($a=0; $a < count($customerSalesProductPurchasePrices); $a++) {
        $productPurchasePricesTotal += ($customerSalesProductPurchasePrices[$a] * $customerSalesProductPieces[$a]);
      }
    }
    /* from sale list */

    /* from invoices ( which selected to be registered to balance) */
    $stmt = $model->dbh->prepare(
      "SELECT SUM(tbl_sale_invoice_products.sale_invoice_product_product_unit_purchase_price) AS sale_invoice_total_purchase_price
      FROM tbl_sale_invoice_products
      INNER JOIN tbl_sale_invoices ON tbl_sale_invoices.sale_invoice_id=tbl_sale_invoice_products.sale_invoice_product_invoice_id
      WHERE tbl_sale_invoices.sale_invoice_cash_id IS NOT NULL AND tbl_sale_invoices.sale_customer_id=:customer_id");
    $stmt->execute(["customer_id"=>$customerId]);
    $customerInvoicesProductPurchasePrices = $stmt->fetch();
    $productPurchasePricesTotal += $customerInvoicesProductPurchasePrices["sale_invoice_total_purchase_price"];
    /* from invoices ( which selected to be registered to balance) */
    /* customer's sale cost total  */


    /* customer's total sale debt */
    $stmt = $model->dbh->prepare(
      "SELECT SUM(tbl_sales.sale_total) AS sale_total
      FROM tbl_sales
      WHERE tbl_sales.sale_customer_id=:customer_id");
    $stmt->execute(["customer_id"=>$customerId]);
    $saleTotal = $stmt->fetch()["sale_total"];


    $totalDebt = $saleTotal;
    /* customer's total sale debt */


    /* total collection */
    /*sale collection total*/
    $stmt = $model->dbh->prepare(
      "SELECT SUM(tbl_sale_collections.sale_collection_amount) AS sale_collection_total
      FROM tbl_sale_collections
      INNER JOIN tbl_sales ON tbl_sales.sale_id=tbl_sale_collections.sale_collection_sale_id
      WHERE tbl_sales.sale_customer_id=:customer_id"
    );
    $stmt->execute(["customer_id"=>$customerId]);
    $saleCollectionTotal = $stmt->fetch()["sale_collection_total"];

    $totalCollection = 0;
    $totalCollection += $saleCollectionTotal;
    /*sale collection total*/


    /* tbl_collections total */
    $stmt = $model->dbh->prepare(
      "SELECT SUM(tbl_collections.collection_amount) AS collection_amount
      FROM tbl_collections
      WHERE tbl_collections.collection_customer_id=:customer_id");
    $stmt->execute(["customer_id"=>$customerId]);
    $collectionTotal = $stmt->fetch()["collection_amount"];

    $totalCollection += $collectionTotal;
    /* tbl_collections total */
    /* total collection */

    /*balance*/
    $balance = $totalDebt - $totalCollection;
    /*balance*/


    /* total profit */
    $totalProfit = $totalDebt - $productPurchasePricesTotal;
    /* total profit */

    $model = null;



    $this->view->totalProfit = $totalProfit;
    $this->view->balance = $balance;
    $this->view->totalCollection = $totalCollection;
    $this->view->totalDebt = $totalDebt;
    $this->view->productPurchasePricesTotal = $productPurchasePricesTotal;
    $this->view->customerInformations = $customerInformations;
    $this->view->render("units/customer/customer-profile");
  }
  /* EMPLOYEE PROFILE */


}
