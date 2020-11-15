<?php

/**
*
*/
class Sale extends Controller
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

  /* CATEGORY LIST */
  public function saleList()
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
      if ($data["filters"]["txtSaleCustomerId"] != "") {
        $sql .= " AND tbl_customers.customer_name LIKE :customer_name";
        $params["customer_name"] = "%".$data["filters"]["txtSaleCustomerId"]."%";
      }
      /* adding filter */


      /* adding filter */
      if ($data["filters"]["txtSaleDate"] != "") {
        $sql .= " AND DATE(tbl_sales.sale_query_date)=:sale_query_date";
        $params["sale_query_date"] = $data["filters"]["txtSaleDate"];
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtWorkshopVerifyBeginningDate"] != "") {
        $sql .= " AND DATE(tbl_sales.sale_workshop_verify_date) BETWEEN :sale_workshop_verify_beginning_date AND :sale_workshop_verify_ending_date";
        $params["sale_workshop_verify_beginning_date"] = $data["filters"]["txtWorkshopVerifyBeginningDate"];
        $params["sale_workshop_verify_ending_date"] = $data["filters"]["txtWorkshopVerifyEndingDate"];
      }
      /* adding filter */


      /* adding filter */
      if ($data["filters"]["txtSaleState"] != "") {
        $sql .= " AND tbl_sales.sale_state LIKE :sale_state";
        $params["sale_state"] = "%".$data["filters"]["txtSaleState"]."%";
      }
      /* adding filter */


      /* adding filter */
      if ($data["filters"]["txtSaleFactoryState"] != "") {
        $sql .= " AND tbl_sales.sale_factory_state LIKE :sale_factory_state";
        $params["sale_factory_state"] = "%".$data["filters"]["txtSaleFactoryState"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting sales*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_sales.sale_id,tbl_customers.customer_name,tbl_employees.employee_name,tbl_sales.sale_total,tbl_sales.sale_query_date,
        tbl_sales.sale_delivery_date,tbl_customers.customer_address,tbl_sales.sale_state,tbl_sales.sale_sent_factory_verify,tbl_sales.sale_workshop_verify_employee_id
        FROM tbl_sales
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
        INNER JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
        WHERE sale_id IS NOT NULL
        $sql
        ORDER BY sale_id DESC
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($sales); $i++) {
        $sales[$i]["sale_query_date"] = $this->fixDate($sales[$i]["sale_query_date"]);
        $sales[$i]["sale_delivery_date"] = $this->fixDate($sales[$i]["sale_delivery_date"]);

        if ($sales[$i]["sale_sent_factory_verify"] == "1") {
          $sales[$i]["sale_sent_factory_verify"] = "Üretildi";
        }else {
          $sales[$i]["sale_sent_factory_verify"] = "Beklemede";
        }

        /* workshop employee name */
        if ($sales[$i]["sale_workshop_verify_employee_id"] != null) {
          $stmt = $model->dbh->prepare("SELECT employee_name FROM tbl_employees WHERE employee_id=:employee_id");
          $stmt->execute(["employee_id"=>$sales[$i]["sale_workshop_verify_employee_id"]]);
          $sales[$i]["sale_workshop_verify_employee_name"] = $stmt->fetch()["employee_name"];
        }else {
          $sales[$i]["sale_workshop_verify_employee_name"] = "-";
        }
        unset($sales[$i]["sale_workshop_verify_employee_id"]);
        /* workshop employee name */



        // if ($sales[$i]["sale_workshop_verify_employee_id"] != null) {
        //   $stmt = $model->dbh->prepare("SELECT employee_name FROM tbl_employees WHERE employee_id=:employee_id");
        //   $stmt->execute(["employee_id"=>$sales[$i]["sale_workshop_verify_employee_id"]]);
        //   $sales[$i]["sale_workshop_verify_employee_name"] = $stmt->fetch()["employee_name"];
        // }else {
        //   $sales[$i]["sale_workshop_verify_employee_name"] = "-";
        // }

      }
      /*selecting sales*/

      /* total sale number */
      $stmt = $model->dbh->prepare(
        "SELECT COUNT(tbl_sales.sale_id) AS total_sale_count
        FROM tbl_sales
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
        INNER JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
        WHERE sale_id IS NOT NULL
        $sql"
      );
      $stmt->execute($params);
      $totalSaleCount = $stmt->fetch()["total_sale_count"];
      /* total sale number */

      /* total page number */
      $totalPageNumber = $totalSaleCount / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$sales,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));

    }else {
      $this->view->render('apps/sale/sale-list');
    }

  }
  /* CATEGORY LIST */

  /* NEW CATEGORY */
  public function newSale()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);
      $permission = "false";

      /* file file control, upload */
      if (isset($_FILES["commonFile"])) {
        if(file_exists($_FILES['commonFile']['tmp_name']) || !is_uploaded_file($_FILES['commonFile']['tmp_name'])) {
          $fileName = $_FILES["commonFile"]["name"];
          $uploadFolder = $this->pathPhp."app-assets/images/sale-files/".$fileName;
          $file=$_FILES["commonFile"]["tmp_name"];

          if ($_FILES["commonFile"]["size"] > 1048576) {
            $permission = "false";
            $response = "Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }else {
            $permission = "true";
          }

          if(move_uploaded_file($file,$uploadFolder) && $permission == "true"){
            $permission == "true";
            $response = true;
          }else{
            $response = "Fotoğraf yüklenemediği için hata alındı. Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }
        }else {
          $fileName = "";
        }
      }else {
        $fileName = "";
      }
      /* file file control, upload */


      $permission = "true";
      if ($permission == "true") {
        $model = new Model();



        $data["txtSaleBarcode"] = rand(1000000000000,9999999999999);

        /*inserting sale*/
        $stmt = $model->dbh->prepare(
          "INSERT INTO tbl_sales SET
          sale_barcode=:sale_barcode,
          sale_customer_id=:sale_customer_id,
          sale_delivery_date=:sale_delivery_date,
          sale_note=:sale_note,
          sale_common_file=:sale_common_file,
          sale_sub_total=:sale_sub_total,
          sale_discount_amount=:sale_discount_amount,
          sale_tax_total=:sale_tax_total,
          sale_total=:sale_total,
          sale_query_date=:sale_query_date,
          sale_query_user_id=:sale_query_user_id
          "
        );
        $response = $stmt->execute([
          "sale_barcode"=>$data["txtSaleBarcode"],
          "sale_customer_id"=>$data["txtSaleCustomerId"],
          "sale_delivery_date"=>$data["txtSaleDeliveryDate"],
          "sale_note"=>$data["txtSaleNote"],
          "sale_common_file"=>$fileName,
          "sale_sub_total"=>$data["txtSaleSubTotal"],
          "sale_discount_amount"=>$data["txtSaleDiscountAmount"],
          "sale_tax_total"=>$data["txtSaleTaxTotal"],
          "sale_total"=>$data["txtSaleTotal"],
          "sale_query_date"=>$data["txtSaleQueryDate"],
          "sale_query_user_id"=>$data["txtSaleQueryUserId"]
        ]);
        $lastSaleId = $model->dbh->lastInsertId();
        /*inserting sale*/

        if ($response == true) {

          for ($i=0; $i < count($data["roomValues"]); $i++) {
            $stmt = $model->dbh->prepare(
              "INSERT INTO tbl_sale_informations SET
              sale_information_sale_id=:sale_information_sale_id,
              sale_information_room_name=:sale_information_room_name,
              sale_information_brillant_widths=:sale_information_brillant_widths,
              sale_information_brillant_heights=:sale_information_brillant_heights,
              sale_information_stor_widths=:sale_information_stor_widths,
              sale_information_stor_heights=:sale_information_stor_heights,
              sale_information_stor_codes=:sale_information_stor_codes,
              sale_information_pile_density=:sale_information_pile_density,
              sale_information_room_description=:sale_information_room_description,
              sale_information_product_category_ids=:sale_information_product_category_ids,
              sale_information_product_ids=:sale_information_product_ids,
              sale_information_product_purchase_prices=:sale_information_product_purchase_prices,
              sale_information_product_pieces=:sale_information_product_pieces,
              sale_information_product_amounts=:sale_information_product_amounts,
              sale_information_product_totals=:sale_information_product_totals
              "
            );
            $response = $stmt->execute([
              "sale_information_sale_id"=>$lastSaleId,
              "sale_information_room_name"=>$data["roomValues"][$i]["roomName"],
              "sale_information_brillant_widths"=>json_encode($data["roomValues"][$i]["brillantWidths"]),
              "sale_information_brillant_heights"=>json_encode($data["roomValues"][$i]["brillantHeights"]),
              "sale_information_stor_widths"=>json_encode($data["roomValues"][$i]["storWidths"]),
              "sale_information_stor_heights"=>json_encode($data["roomValues"][$i]["storHeights"]),
              "sale_information_stor_codes"=>json_encode($data["roomValues"][$i]["storCodes"]),
              "sale_information_pile_density"=>$data["roomValues"][$i]["pileDensity"],
              "sale_information_room_description"=>$data["roomValues"][$i]["roomDescription"],
              "sale_information_product_category_ids"=>json_encode($data["roomValues"][$i]["productCategoryIds"]),
              "sale_information_product_ids"=>json_encode($data["roomValues"][$i]["productIds"]),
              "sale_information_product_purchase_prices"=>json_encode($data["roomValues"][$i]["productPurchasePrices"]),
              "sale_information_product_pieces"=>json_encode($data["roomValues"][$i]["productPieces"]),
              "sale_information_product_amounts"=>json_encode($data["roomValues"][$i]["productAmounts"]),
              "sale_information_product_totals"=>json_encode($data["roomValues"][$i]["productTotals"])
            ]);

          }


        }

        $model = null;
      }




      echo json_encode(array(
        "response"=>$response,
        "lastSaleId"=>$lastSaleId
      ));

    }else {

      $model = new Model();

      /*selecting discounts*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_discounts");
      $stmt->execute();
      $discounts = $stmt->fetchAll();
      /*selecting discounts*/

      /*selecting employees*/
      $stmt = $model->dbh->prepare("SELECT employee_id,employee_name FROM tbl_employees");
      $stmt->execute();
      $employees = $stmt->fetchAll();
      /*selecting employees*/

      /* get current employee permissions */
      $stmt = $model->dbh->prepare("SELECT employee_permissions FROM tbl_employees WHERE employee_id=:employee_id");
      $stmt->execute(["employee_id"=>$_SESSION["employee_id"]]);
      $employeePermissions = $stmt->fetch();
      $employeePermissions = json_decode($employeePermissions["employee_permissions"], true);
      /* get current employee permissions */

      $model = null;

      $this->view->employeePermissions = $employeePermissions;
      $this->view->employees = $employees;
      $this->view->discounts = $discounts;
      $this->view->render('apps/sale/new-sale');
    }

  }
  /* NEW CATEGORY */

  /* UPDATE CATEGORY */
  public function updateSale($saleId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);
      $permission = "false";

      /* file file control, upload */
      if (isset($_FILES["commonFile"])) {
        if(file_exists($_FILES['commonFile']['tmp_name']) || !is_uploaded_file($_FILES['commonFile']['tmp_name'])) {
          $fileName = $_FILES["commonFile"]["name"];
          $uploadFolder = $this->pathPhp."app-assets/images/sale-files/".$fileName;
          $file=$_FILES["commonFile"]["tmp_name"];

          if ($_FILES["commonFile"]["size"] > 1048576) {
            $permission = "false";
            $response = "Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }else {
            $permission = "true";
          }

          if(move_uploaded_file($file,$uploadFolder) && $permission == "true"){
            $permission == "true";
            $response = true;
          }else{
            $response = "Fotoğraf yüklenemediği için hata alındı. Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }
        }else {
          $fileName = "";
        }
      }else {
        $fileName = "";
      }
      /* file file control, upload */


      $permission = "true";
      if ($permission == "true") {
        $model = new Model();



        $data["txtSaleBarcode"] = rand(1000000000000,9999999999999);

        /*updating sale*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_sales SET
          sale_barcode=:sale_barcode,
          sale_customer_id=:sale_customer_id,
          sale_delivery_date=:sale_delivery_date,
          sale_note=:sale_note,
          sale_common_file=:sale_common_file,
          sale_sub_total=:sale_sub_total,
          sale_discount_amount=:sale_discount_amount,
          sale_tax_total=:sale_tax_total,
          sale_total=:sale_total,
          sale_query_date=:sale_query_date,
          sale_query_user_id=:sale_query_user_id
          WHERE sale_id=:sale_id
          "
        );
        $response = $stmt->execute([
          "sale_barcode"=>$data["txtSaleBarcode"],
          "sale_customer_id"=>$data["txtSaleCustomerId"],
          "sale_delivery_date"=>$data["txtSaleDeliveryDate"],
          "sale_note"=>$data["txtSaleNote"],
          "sale_common_file"=>$fileName,
          "sale_sub_total"=>$data["txtSaleSubTotal"],
          "sale_discount_amount"=>$data["txtSaleDiscountAmount"],
          "sale_tax_total"=>$data["txtSaleTaxTotal"],
          "sale_total"=>$data["txtSaleTotal"],
          "sale_query_date"=>$data["txtSaleQueryDate"],
          "sale_query_user_id"=>$data["txtSaleQueryUserId"],
          "sale_id"=>$data["txtSaleId"]
        ]);
        /*updating sale*/

        if ($response == true) {

          for ($i=0; $i < count($data["roomValues"]); $i++) {
            $stmt = $model->dbh->prepare(
              "UPDATE tbl_sale_informations SET
              sale_information_sale_id=:sale_information_sale_id,
              sale_information_room_name=:sale_information_room_name,
              sale_information_brillant_widths=:sale_information_brillant_widths,
              sale_information_brillant_heights=:sale_information_brillant_heights,
              sale_information_stor_widths=:sale_information_stor_widths,
              sale_information_stor_heights=:sale_information_stor_heights,
              sale_information_stor_codes=:sale_information_stor_codes,
              sale_information_pile_density=:sale_information_pile_density,
              sale_information_room_description=:sale_information_room_description,
              sale_information_product_category_ids=:sale_information_product_category_ids,
              sale_information_product_ids=:sale_information_product_ids,
              sale_information_product_purchase_prices=:sale_information_product_purchase_prices,
              sale_information_product_pieces=:sale_information_product_pieces,
              sale_information_product_amounts=:sale_information_product_amounts,
              sale_information_product_totals=:sale_information_product_totals
              WHERE sale_information_id=:sale_information_id
              "
            );
            $response = $stmt->execute([
              "sale_information_sale_id"=>$data["txtSaleId"],
              "sale_information_room_name"=>$data["roomValues"][$i]["roomName"],
              "sale_information_brillant_widths"=>json_encode($data["roomValues"][$i]["brillantWidths"]),
              "sale_information_brillant_heights"=>json_encode($data["roomValues"][$i]["brillantHeights"]),
              "sale_information_stor_widths"=>json_encode($data["roomValues"][$i]["storWidths"]),
              "sale_information_stor_heights"=>json_encode($data["roomValues"][$i]["storHeights"]),
              "sale_information_stor_codes"=>json_encode($data["roomValues"][$i]["storCodes"]),
              "sale_information_pile_density"=>$data["roomValues"][$i]["pileDensity"],
              "sale_information_room_description"=>$data["roomValues"][$i]["roomDescription"],
              "sale_information_product_category_ids"=>json_encode($data["roomValues"][$i]["productCategoryIds"]),
              "sale_information_product_ids"=>json_encode($data["roomValues"][$i]["productIds"]),
              "sale_information_product_purchase_prices"=>json_encode($data["roomValues"][$i]["productPurchasePrices"]),
              "sale_information_product_pieces"=>json_encode($data["roomValues"][$i]["productPieces"]),
              "sale_information_product_amounts"=>json_encode($data["roomValues"][$i]["productAmounts"]),
              "sale_information_product_totals"=>json_encode($data["roomValues"][$i]["productTotals"]),
              "sale_information_id"=>$data["roomValues"][$i]["saleInformationId"]
            ]);
          }


        }

        $model = null;
      }




      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*sale informations*/
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_sales.*,
        tbl_customers.customer_name,
        tbl_customers.customer_address,
        tbl_customers.customer_phone_number,
        tbl_employees.employee_name
        FROM tbl_sales
        LEFT JOIN tbl_customers ON tbl_sales.sale_customer_id=tbl_customers.customer_id
        LEFT JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
        WHERE tbl_sales.sale_id=:sale_id"
      );
      $stmt->execute(["sale_id"=>$saleId]);
      $saleInformations = $stmt->fetch();
      /*sale informations*/


      /* sale collection total */
      $stmt = $model->dbh->prepare("SELECT SUM(sale_collection_amount) AS total_collection FROM tbl_sale_collections WHERE sale_collection_sale_id=:sale_id");
      $stmt->execute(["sale_id"=>$saleId]);
      $saleCollectionTotal = $stmt->fetch()["total_collection"];
      /* sale collection total */

      /* sale room informations */
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_sale_informations.*
        FROM tbl_sale_informations
        WHERE tbl_sale_informations.sale_information_sale_id=:sale_id"
      );
      $stmt->execute(["sale_id"=>$saleId]);
      $saleRoomInformations = $stmt->fetchAll();

      for ($i=0; $i < count($saleRoomInformations); $i++) {
        $products = json_decode($saleRoomInformations[$i]["sale_information_product_ids"],true);
        $categories = json_decode($saleRoomInformations[$i]["sale_information_product_category_ids"],true);


        $saleRoomInformations[$i]["sale_information_product_names"] = array();
        for ($a=0; $a < count($products); $a++) {
          $stmt = $model->dbh->prepare("SELECT sale_product_name FROM tbl_sale_products WHERE sale_product_id=:sale_product_id");
          $stmt->execute(["sale_product_id"=>$products[$a]]);
          $saleProductName = $stmt->fetch()["sale_product_name"];
          array_push($saleRoomInformations[$i]["sale_information_product_names"],$saleProductName);
        }

        $saleRoomInformations[$i]["sale_information_category_names"] = array();
        for ($a=0; $a < count($categories); $a++) {
          $stmt = $model->dbh->prepare("SELECT category_name FROM tbl_categories WHERE category_id=:category_id");
          $stmt->execute(["category_id"=>$categories[$a]]);
          $categoryName = $stmt->fetch()["category_name"];
          array_push($saleRoomInformations[$i]["sale_information_category_names"],$categoryName);
        }
      }
      /* sale room informations */


      /* payment methods */
      $stmt = $model->dbh->prepare("SELECT payment_method_id,payment_method_name FROM tbl_payment_methods");
      $stmt->execute();
      $paymentMethods = $stmt->fetchAll();
      /* payment methods */


      /* employees */
      $stmt = $model->dbh->prepare("SELECT employee_id,employee_name FROM tbl_employees");
      $stmt->execute();
      $employees = $stmt->fetchAll();
      /* employees */

      $model = null;

      $this->view->saleCollectionTotal = $saleCollectionTotal;
      $this->view->paymentMethods = $paymentMethods;
      $this->view->employees = $employees;
      $this->view->saleInformations = $saleInformations;
      $this->view->saleRoomInformations = $saleRoomInformations;
      $this->view->render("apps/sale/update-sale");
    }

  }
  /* UPDATE CATEGORY */


  /* DELETE CATEGORY */
  public function deleteSale($saleId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();
      $permission = true;


      /*check sale has sent*/
      $stmt = $model->dbh->prepare("SELECT sale_sent_factory_id FROM tbl_sales WHERE sale_id=:sale_id");
      $stmt->execute(["sale_id"=>$saleId]);
      $saleInformations = $stmt->fetch();
      if ($saleInformations["sale_sent_factory_id"] != null) {
        $permission = false;
        $response = "Satış fabrikaya gönderildiği için silemezsiniz!";
      }
      /*check sale has sent*/

      if ($permission == true) {
        /*deleting sale*/
        $stmt = $model->dbh->prepare("DELETE FROM tbl_sales WHERE sale_id=:sale_id");
        $response = $stmt->execute(["sale_id"=>$saleId]);
        /*deleting sale*/
      }



      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE CATEGORY */


  /* SALE PROFILE */
  public function saleProfile($saleId)
  {
    $model = new Model();

    /*sale informations*/
    $stmt = $model->dbh->prepare(
      "SELECT
      tbl_sales.*,
      tbl_customers.customer_name,
      tbl_customers.customer_address,
      tbl_customers.customer_phone_number,
      tbl_employees.employee_name
      FROM tbl_sales
      INNER JOIN tbl_customers ON tbl_sales.sale_customer_id=tbl_customers.customer_id
      INNER JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
      WHERE tbl_sales.sale_id=:sale_id"
    );
    $stmt->execute(["sale_id"=>$saleId]);
    $saleInformations = $stmt->fetch();


    $saleInformations["sale_query_date"] = $this->fixDate($saleInformations["sale_query_date"]);
    /*sale informations*/


    /* sale collection total */
    $stmt = $model->dbh->prepare("SELECT SUM(sale_collection_amount) AS total_collection FROM tbl_sale_collections WHERE sale_collection_sale_id=:sale_id");
    $stmt->execute(["sale_id"=>$saleId]);
    $saleCollectionTotal = $stmt->fetch()["total_collection"];
    /* sale collection total */

    /* sale remain amount */
    $saleInformations["sale_remain"] = $saleInformations["sale_total"] - $saleCollectionTotal;
    if ($saleInformations["sale_remain"] == 0) {
      $saleInformations["sale_payment_state"] = 1;
    }elseif ($saleInformations["sale_remain"] < 0) {
      $saleInformations["sale_payment_state"] = 2;
    }else {
      $saleInformations["sale_payment_state"] = 0;
    }
    /* sale remain amount */

    /* sale room informations */
    $stmt = $model->dbh->prepare(
      "SELECT
      tbl_sale_informations.*
      FROM tbl_sale_informations
      WHERE tbl_sale_informations.sale_information_sale_id=:sale_id"
    );
    $stmt->execute(["sale_id"=>$saleId]);
    $saleRoomInformations = $stmt->fetchAll();

    for ($i=0; $i < count($saleRoomInformations); $i++) {
      $products = json_decode($saleRoomInformations[$i]["sale_information_product_ids"],true);
      $categories = json_decode($saleRoomInformations[$i]["sale_information_product_category_ids"],true);


      $saleRoomInformations[$i]["sale_information_product_names"] = array();
      for ($a=0; $a < count($products); $a++) {
        $stmt = $model->dbh->prepare("SELECT sale_product_name FROM tbl_sale_products WHERE sale_product_id=:sale_product_id");
        $stmt->execute(["sale_product_id"=>$products[$a]]);
        $saleProductName = $stmt->fetch()["sale_product_name"];
        array_push($saleRoomInformations[$i]["sale_information_product_names"],$saleProductName);
      }

      $saleRoomInformations[$i]["sale_information_category_names"] = array();
      for ($a=0; $a < count($categories); $a++) {
        $stmt = $model->dbh->prepare("SELECT category_name FROM tbl_categories WHERE category_id=:category_id");
        $stmt->execute(["category_id"=>$categories[$a]]);
        $categoryName = $stmt->fetch()["category_name"];
        array_push($saleRoomInformations[$i]["sale_information_category_names"],$categoryName);
      }
    }
    /* sale room informations */


    /* payment methods */
    $stmt = $model->dbh->prepare("SELECT payment_method_id,payment_method_name FROM tbl_payment_methods");
    $stmt->execute();
    $paymentMethods = $stmt->fetchAll();
    /* payment methods */


    /* get current employee permissions */
    $stmt = $model->dbh->prepare("SELECT employee_permissions FROM tbl_employees WHERE employee_id=:employee_id");
    $stmt->execute(["employee_id"=>$_SESSION["employee_id"]]);
    $employeePermissions = $stmt->fetch();
    $employeePermissions = json_decode($employeePermissions["employee_permissions"], true);
    /* get current employee permissions */

    $model = null;



    $this->view->employeePermissions = $employeePermissions;
    $this->view->saleCollectionTotal = $saleCollectionTotal;
    $this->view->paymentMethods = $paymentMethods;
    $this->view->saleInformations = $saleInformations;
    $this->view->saleRoomInformations = $saleRoomInformations;
    $this->view->render("apps/sale/sale-profile");
  }
  /* SALE PROFILE */


  /* CREATE SALE PDF */
  public function createSalePdf($saleId)
  {
    $model = new Model();

    /*sale informations*/
    $stmt = $model->dbh->prepare(
      "SELECT
      tbl_sales.*,
      tbl_customers.customer_name,
      tbl_customers.customer_address,
      tbl_customers.customer_phone_number,
      tbl_employees.employee_name,
      tbl_discounts.discount_name
      FROM tbl_sales
      INNER JOIN tbl_customers ON tbl_sales.sale_customer_id=tbl_customers.customer_id
      INNER JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
      LEFT JOIN tbl_discounts ON tbl_discounts.discount_id=tbl_sales.sale_discount_id
      WHERE tbl_sales.sale_id=:sale_id"
    );
    $stmt->execute(["sale_id"=>$saleId]);
    $saleInformations = $stmt->fetch();

    if ($saleInformations["discount_name"] == null) {
      $saleInformations["discount_name"] = "İndirim Yapılmamış";
    }

    $saleInformations["sale_query_date"] = $this->fixDate($saleInformations["sale_query_date"]);
    /*sale informations*/

    /* sale room informations */
    $stmt = $model->dbh->prepare(
      "SELECT
      tbl_sale_informations.*
      FROM tbl_sale_informations
      WHERE tbl_sale_informations.sale_information_sale_id=:sale_id"
    );
    $stmt->execute(["sale_id"=>$saleId]);
    $saleRoomInformations = $stmt->fetchAll();

    for ($i=0; $i < count($saleRoomInformations); $i++) {
      $products = json_decode($saleRoomInformations[$i]["sale_information_product_ids"],true);
      $categories = json_decode($saleRoomInformations[$i]["sale_information_product_category_ids"],true);


      $saleRoomInformations[$i]["sale_information_product_names"] = array();
      for ($a=0; $a < count($products); $a++) {
        $stmt = $model->dbh->prepare("SELECT sale_product_name FROM tbl_sale_products WHERE sale_product_id=:sale_product_id");
        $stmt->execute(["sale_product_id"=>$products[$a]]);
        $saleProductName = $stmt->fetch()["sale_product_name"];
        array_push($saleRoomInformations[$i]["sale_information_product_names"],$saleProductName);
      }

      $saleRoomInformations[$i]["sale_information_category_names"] = array();
      for ($a=0; $a < count($categories); $a++) {
        $stmt = $model->dbh->prepare("SELECT category_name FROM tbl_categories WHERE category_id=:category_id");
        $stmt->execute(["category_id"=>$categories[$a]]);
        $categoryName = $stmt->fetch()["category_name"];
        array_push($saleRoomInformations[$i]["sale_information_category_names"],$categoryName);
      }
    }
    /* sale room informations */

    $model = null;




    require_once('/var/www/html/TCPDF-master/examples/tcpdf_include.php');


    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
    }

    $pdf->SetFont('dejavusans', '', 10);
    $pdf->AddPage();

    $html = '<!DOCTYPE html>
    <html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->
    <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>';
    $html .= '<div class="row">
    <div class="col-xl-12">


    <div class="card">
    <div class="card-body">

    <h4 class="card-title">Satış Detayı</h4>

    <div class="row">
    <div class="col-lg-6">
    <div class="table-responsive">
    <table class="table">
    <tbody>
    <tr>
    <td> <strong> Müşteri : </strong></td>
    <td> '.$saleInformations["customer_name"].'</td>
    </tr>
    <tr>
    <td> <strong> Müşteri Adresi : </strong></td>
    <td> '.$saleInformations["customer_address"].' </td>
    </tr>
    <tr>
    <td> <strong> Telefon Numarası : </strong></td>
    <td> '.$saleInformations["customer_phone_number"].' </td>
    </tr>
    <tr>
    <td> <strong> Satışı Gerçekleştiren Kişi : </strong></td>
    <td> '.$saleInformations["employee_name"].' </td>
    </tr>
    <tr>
    <td> <strong> Satış Tarihi : </strong></td>
    <td> '.$saleInformations["sale_query_date"].' </td>
    </tr>
    <tr>
    <td> <strong> Durum : </strong></td>
    <td> <span class="badge badge-danger">Ödenmedi</span> </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    <div class="col-lg-6">
    <div class="table-responsive">
    <table class="table">
    <tbody>
    <tr>
    <td> <strong> Barkod : </strong></td>
    <td>  </td>
    </tr>
    <tr>
    <td> <strong> Görseller : </strong></td>
    <td>  </td>
    </tr>
    <tr>
    <td> <strong>İşlemler :</strong> </td>
    <td>
    <button type="button" class="btn btn-sm btn-primary mb-2 btnModalFactoryList" data-toggle="modal" data-target="#modalFactoryList" name="button">Üretime Gönder</button>
    <button type="button" class="btn btn-sm btn-primary mb-2 btnModalSupplierList" data-toggle="modal" data-target="#modalSupplierList" name="button">Tedarikçiye Gönder</button>
    <button type="button" class="btn btn-sm btn-primary mb-2 btnCreatePdfFile" name="button">Yazdır</button>
    <button type="button" class="btn btn-sm btn-primary mb-2" name="button">Ödeme Al</button>
    <button type="button" class="btn btn-sm btn-primary mb-2 btnSendEmailToCustomer" data-toggle="modal" sale-id="" data-target="#modalSendEmailToCustomer" name="button">Müşteriye E-Posta Gönder</button>
    <button type="button" class="btn btn-sm btn-primary mb-2 btnSendSmsToCustomer" data-toggle="modal" data-target="#modalSendSmsToCustomer" name="button">Müşteriye Sms Gönder</button>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <hr>';

    for ($i=0; $i < count($saleRoomInformations); $i++) {
      $html .= '<h3>'.$saleRoomInformations[$i]["sale_information_room_name"].'</h3>';
      $html .= '<div class="row div-rooms">';
      $html .= '<div class="row">';
      $html .= '<div class="col-md-2 ">';
      $html .= '<div class="form-group">';
      $html .= '<label for=""><strong> TÜL :</strong>  </label>';
      $html .= '<ol class="ol-measurements">';

      $brillantWidths = json_decode($saleRoomInformations[$i]["sale_information_brillant_widths"],true);
      $brillantHeights = json_decode($saleRoomInformations[$i]["sale_information_brillant_heights"],true);

      for ($a=0; $a < count($brillantWidths); $a++) {
        $html .= '<li>'.$brillantWidths[$a].' - '.$brillantHeights[$a].'</li>';
      }

      $html .= '</ol>';
      $html .= '</div>';
      $html .= '</div>';
      $html .= '<div class="col-md-2 ">';
      $html .= '<div class="form-group">';
      $html .= '<label for=""><strong> STOR :</strong>  </label>';
      $html .= '<ol class="ol-measurements">';

      $storWidths = json_decode($saleRoomInformations[$i]["sale_information_stor_widths"],true);
      $storHeights = json_decode($saleRoomInformations[$i]["sale_information_stor_heights"],true);

      for ($a=0; $a < count($storWidths); $a++) {
        $html .= '<li>'.$storWidths[$a].' - '.$storHeights[$a].'</li>';
      }

      $html .= '</ol>';
      $html .= '</div>';
      $html .= '</div>';
      $html .= '<div class="col-md-2 ">';
      $html .= '<div class="form-group">';
      $html .= '<label for=""><strong> STOR KODU:</strong>  </label>';
      $html .= $saleRoomInformations[$i]["sale_information_stor_code"];
      $html .= '</div>';
      $html .= '<div class="form-group">';
      $html .= '<label for=""><strong> PİLE SIKLIĞI:</strong>  </label>';
      $html .= $saleRoomInformations[$i]["sale_information_pile_density"];
      $html .= '</div>';
      $html .= '<div class="form-group">';
      $html .= '<label for=""><strong> ODA AÇIKLAMASI:</strong>  </label>';
      $html .= $saleRoomInformations[$i]["sale_information_room_description"];
      $html .= '</div>';
      $html .= '</div>';
      $html .= '<div class="col-lg-6">';
      $html .= '<div class="table-responsive">';
      $html .= '<table class="table">';
      $html .= '<thead>';
      $html .= '<tr>';
      $html .= '<th>KATEGORİ</th>';
      $html .= '<th>ÜRÜN</th>';
      $html .= '<th>ALIŞ FİYATI</th>';
      $html .= '<th>MİKTAR</th>';
      $html .= '<th>FİYAT </th>';
      $html .= '<th>TOPLAM</th>';
      $html .= '</tr>';
      $html .= '</thead>';
      $html .= '<tbody>';

      $productPurchasePrices = json_decode($saleRoomInformations[$i]["sale_information_product_purchase_prices"],true);
      $productPieces = json_decode($saleRoomInformations[$i]["sale_information_product_pieces"],true);
      $productAmounts = json_decode($saleRoomInformations[$i]["sale_information_product_amounts"],true);
      $productTotals = json_decode($saleRoomInformations[$i]["sale_information_product_totals"],true);

      for ($a=0; $a < count($saleRoomInformations[$i]["sale_information_product_names"]); $a++) {
        $html .= '<tr>';
        $html .= '<td>'.$saleRoomInformations[$i]["sale_information_category_names"][$a].'</td>';
        $html .= '<td>'.$saleRoomInformations[$i]["sale_information_product_names"][$a].'</td>';
        $html .= '<td>'.$productPurchasePrices[$a].' ₺ </td>';
        $html .= '<td>'.$productPieces[$a].' </td>';
        $html .= '<td>'.$productAmounts[$a].' </td>';
        $html .= '<td>'.$productTotals[$a].' ₺ </td>';
        $html .= '</tr>';

      }
      $html .= '</tbody>';
      $html .= '</table>';
      $html .= '</div>';
      $html .= '</div>';
      $html .= '</div>';
      $html .= '</div>';
      $html .= '<hr class="room-seperator">';

    }

    $html .= '
    <hr class="seperator">
    <div class="row row-under-invoice">
    <div class="col-lg-8">

    </div>
    <div class="col-lg-4">
    <div class="table-responsive">
    <table class="table">
    <tbody>
    <tr>
    <td class="float-right font-weight-bold">Ara Toplam :</td>
    <td>'.$saleInformations["sale_sub_total"].' ₺ </td>

    </tr>
    <tr>
    <td class="float-right font-weight-bold">İndirim :</td>
    <td>'.$saleInformations["discount_name"].'  </td>
    </tr>
    <tr>
    <td class="float-right font-weight-bold">Vergi Toplamı :</td>
    <td> '.$saleInformations["sale_tax_total"].' ₺ </td>

    </tr>
    <tr>
    <td class="float-right font-weight-bold">Toplam :</td>
    <td> '.$saleInformations["sale_total"].' ₺ </td>

    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>





    </div> <!-- end card-body-->
    </div> <!-- end card-->



    </div>

    </div>

    </body></html>';
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('/var/www/html/assets/sale-pdfs/deneme.pdf', 'F');
  }
  /* CREATE SALE PDF */

  /* SEND SALE TO FACTORY */
  public function sendSaleToFactory()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();


      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sales SET
        sale_sent_factory_id=:sale_sent_factory_id,
        sale_sent_factory_unique_id=:sale_sent_factory_unique_id
        WHERE sale_id=:sale_id
        "
      );
      $response = $stmt->execute([
        "sale_sent_factory_id"=>$data["txtFactoryId"],
        "sale_sent_factory_unique_id"=>$data["txtFactoryUniqueId"],
        "sale_id"=>$data["txtSaleId"]
      ]);


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* SEND SALE TO FACTORY */

  /* CANCEL SENDING SALE TO FACTORY */
  public function cancelSendingSaleToFactory()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();


      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sales SET
        sale_sent_factory_id=:sale_sent_factory_id,
        sale_sent_factory_unique_id=:sale_sent_factory_unique_id
        WHERE sale_id=:sale_id
        "
      );
      $response = $stmt->execute([
        "sale_sent_factory_id"=>null,
        "sale_sent_factory_unique_id"=>null,
        "sale_id"=>$data["txtSaleId"]
      ]);


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* CANCEL SENDING SALE TO FACTORY */

  /* SEND SALE TO WORKSHOP */
  public function sendSaleToWorkshop()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();


      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sales SET
        sale_workshop_id=:sale_workshop_id
        WHERE sale_id=:sale_id
        "
      );
      $response = $stmt->execute([
        "sale_workshop_id"=>$data["txtWorkshopId"],
        "sale_id"=>$data["txtSaleId"]
      ]);


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* SEND SALE TO WORKSHOP */

  /* CANCEL SENDING SALE TO WORKSHOP */
  public function cancelSendingSaleToWorkshop()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();


      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sales SET
        sale_workshop_id=:sale_workshop_id
        WHERE sale_id=:sale_id
        "
      );
      $response = $stmt->execute([
        "sale_workshop_id"=>null,
        "sale_id"=>$data["txtSaleId"]
      ]);


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* CANCEL SENDING SALE TO WORKSHOP */
}
