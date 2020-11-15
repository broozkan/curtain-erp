<?php

/**
*
*/
class StockProduct extends Controller
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

  /* STOCK PRODUCT LIST */
  public function stockProductList()
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
      if ($data["filters"]["txtStockProductName"] != "") {
        $sql .= " AND tbl_stock_products.stock_product_name LIKE :stock_product_name";
        $params["stock_product_name"] = "%".$data["filters"]["txtStockProductName"]."%";
      }
      if ($data["filters"]["txtStockProductCategoryId"] != "") {
        $sql .= " AND tbl_stock_products.stock_product_category_id=:stock_product_category_id";
        $params["stock_product_category_id"] = $data["filters"]["txtStockProductCategoryId"];
      }
      /* adding filter */


      $model = new Model();
      //
      // print_r($params);
      //
      // echo "SELECT tbl_stock_products.stock_product_id,tbl_stock_products.stock_product_name,tbl_categories.category_name
      // FROM tbl_stock_products
      // INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_stock_products.stock_product_category_id
      // WHERE tbl_stock_products.stock_product_id IS NOT NULL
      // $sql
      // LIMIT $limit OFFSET $offset";

      /*selecting stockProducts*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_stock_products.stock_product_id,tbl_stock_products.stock_product_name,tbl_categories.category_name,tbl_stores.store_name
        FROM tbl_stock_products
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_stock_products.stock_product_category_id
        INNER JOIN tbl_stores ON tbl_stores.store_id=tbl_stock_products.stock_product_store_id
        WHERE tbl_stock_products.stock_product_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $stockProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting stockProducts*/


      /* total stockProduct number */
      $stmt = $model->dbh->prepare("SELECT COUNT(stock_product_id) AS total_stock_product_number FROM tbl_stock_products WHERE stock_product_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalStockProductNumber = $stmt->fetch()["total_stock_product_number"];
      /* total stockProduct number */

      /* total page number */
      $totalPageNumber = $totalStockProductNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$stockProducts,
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
      $this->view->render('units/stock-product/stock-product-list');
    }

  }
  /* STOCK PRODUCT LIST */

  /* NEW STOCK PRODUCT */
  public function newStockProduct()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* photo file control, upload */
      if (isset($_FILES["photo"])) {
        if(file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
          $photoName = $_FILES["photo"]["name"];
          $uploadFolder = $this->pathPhp."app-assets/images/products/".$photoName;
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
          $photoName = "profile.png";
        }
      }else {
        $photoName = "profile.png";
      }
      /* photo file control, upload */

      $model = new Model();

      /*inserting stock product*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_stock_products SET
        stock_product_name=:stock_product_name,
        stock_product_barcode=:stock_product_barcode,
        stock_product_size=:stock_product_size,
        stock_product_color=:stock_product_color,
        stock_product_quality=:stock_product_quality,
        stock_product_stock_piece=:stock_product_stock_piece,
        stock_product_unit_purchase_price=:stock_product_unit_purchase_price,
        stock_product_unit_selling_price=:stock_product_unit_selling_price,
        stock_product_purchase_tax_id=:stock_product_purchase_tax_id,
        stock_product_selling_tax_id=:stock_product_selling_tax_id,
        stock_product_unit_id=:stock_product_unit_id,
        stock_product_category_id=:stock_product_category_id,
        stock_product_store_id=:stock_product_store_id
        "
      );
      $response = $stmt->execute([
        "stock_product_name"=>$data["txtStockProductName"],
        "stock_product_barcode"=>$data["txtStockProductBarcode"],
        "stock_product_size"=>$data["txtStockProductSize"],
        "stock_product_color"=>$data["txtStockProductColor"],
        "stock_product_quality"=>$data["txtStockProductQuality"],
        "stock_product_stock_piece"=>$data["txtStockProductStockPiece"],
        "stock_product_unit_purchase_price"=>$data["txtStockProductUnitPurchasePrice"],
        "stock_product_unit_selling_price"=>$data["txtStockProductUnitSellingPrice"],
        "stock_product_purchase_tax_id"=>$data["txtStockProductPurchaseTaxId"],
        "stock_product_selling_tax_id"=>$data["txtStockProductSellingTaxId"],
        "stock_product_unit_id"=>$data["txtStockProductUnitId"],
        "stock_product_category_id"=>$data["txtStockProductCategoryId"],
        "stock_product_store_id"=>$data["txtStockProductStoreId"]
      ]);
      /*inserting stock product*/


      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*units*/
      $stmt = $model->dbh->prepare("SELECT unit_id,unit_name FROM tbl_units");
      $stmt->execute();
      $units = $stmt->fetchAll();
      /*units*/

      /*taxes*/
      $stmt = $model->dbh->prepare("SELECT tax_id,tax_name,tax_percentage FROM tbl_taxes");
      $stmt->execute();
      $taxes = $stmt->fetchAll();
      /*taxes*/

      /*categories*/
      $stmt = $model->dbh->prepare("SELECT category_id,category_name FROM tbl_categories");
      $stmt->execute();
      $categories = $stmt->fetchAll();
      /*categories*/

      /*stores*/
      $stmt = $model->dbh->prepare("SELECT store_id,store_name FROM tbl_stores");
      $stmt->execute();
      $stores = $stmt->fetchAll();
      /*stores*/

      $model = null;

      $this->view->stores = $stores;
      $this->view->categories = $categories;
      $this->view->taxes = $taxes;
      $this->view->units = $units;
      $this->view->render('units/stock-product/new-stock-product');
    }

  }
  /* NEW STOCK PRODUCT */

  /* UPDATE STOCK PRODUCT */
  public function updateStockProduct($stockProductId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting stock product*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_stock_products SET
        stock_product_name=:stock_product_name
        WHERE stock_product_id=:stock_product_id
        "
      );
      $response = $stmt->execute([
        "stock_product_name"=>$data["txtStockProductName"],
        "stock_product_id"=>$data["txtStockProductId"]
      ]);
      /*inserting stock product*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*stockProduct informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_stock_products WHERE stock_product_id=:stock_product_id");
      $stmt->execute(["stock_product_id"=>$stockProductId]);
      $stockProductInformations = $stmt->fetch();
      /*stockProduct informations*/


      /*units*/
      $stmt = $model->dbh->prepare("SELECT unit_id,unit_name FROM tbl_units");
      $stmt->execute();
      $units = $stmt->fetchAll();
      /*units*/

      /*taxes*/
      $stmt = $model->dbh->prepare("SELECT tax_id,tax_name,tax_percentage FROM tbl_taxes");
      $stmt->execute();
      $taxes = $stmt->fetchAll();
      /*taxes*/

      /*categories*/
      $stmt = $model->dbh->prepare("SELECT category_id,category_name FROM tbl_categories");
      $stmt->execute();
      $categories = $stmt->fetchAll();
      /*categories*/

      $model = null;



      $this->view->categories = $categories;
      $this->view->taxes = $taxes;
      $this->view->units = $units;
      $this->view->stockProductInformations = $stockProductInformations;
      $this->view->render('units/stock-product/update-stock-product');
    }

  }
  /* UPDATE STOCK PRODUCT */


  /* DELETE STOCK PRODUCT */
  public function deleteStockProduct($stockProductId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting stock product*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_stock_products WHERE stock_product_id=:stock_product_id");
      $response = $stmt->execute(["stock_product_id"=>$stockProductId]);
      /*deleting stock product*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE STOCK PRODUCT */

  /* GET STOCK PRODUCT INFORMATIONS */
  public function getStockProductInformations($stockProductId)
  {
    if (isset($_POST["post"])) {

      $model = new Model();

      /*deleting stock product*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_stock_products.*,tbl_units.unit_name,tbl_taxes.tax_name
        FROM tbl_stock_products
        INNER JOIN tbl_units ON tbl_units.unit_id=tbl_stock_products.stock_product_unit_id
        LEFT JOIN tbl_taxes ON tbl_taxes.tax_id=tbl_stock_products.stock_product_purchase_tax_id
        WHERE tbl_stock_products.stock_product_id=:stock_product_id"
      );
      $stmt->execute(["stock_product_id"=>$stockProductId]);
      $stockProductInformations = $stmt->fetch();
      /*deleting stock product*/

      $model = null;


      echo json_encode(array(
        "stockProductInformations"=>$stockProductInformations
      ));
    }
  }
  /* GET STOCK PRODUCT INFORMATIONS */


}
