<?php

/**
*
*/
class SaleProduct extends Controller
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
  public function saleProductList()
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
      if ($data["filters"]["txtSaleProductName"] != "") {
        $sql .= " AND tbl_sale_products.sale_product_name LIKE :sale_product_name";
        $params["sale_product_name"] = "%".$data["filters"]["txtSaleProductName"]."%";
      }
      if ($data["filters"]["txtSaleProductCategoryId"] != "") {
        $sql .= " AND tbl_sale_products.sale_product_category_id=:sale_product_category_id";
        $params["sale_product_category_id"] = $data["filters"]["txtSaleProductCategoryId"];
      }
      /* adding filter */


      $model = new Model();
      //
      // print_r($params);
      //
      // echo "SELECT tbl_sale_products.sale_product_id,tbl_sale_products.sale_product_name,tbl_categories.category_name
      // FROM tbl_sale_products
      // INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_sale_products.sale_product_category_id
      // WHERE tbl_sale_products.sale_product_id IS NOT NULL
      // $sql
      // LIMIT $limit OFFSET $offset";

      /*selecting saleProducts*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_sale_products.sale_product_id,tbl_sale_products.sale_product_name,tbl_categories.category_name
        FROM tbl_sale_products
        LEFT JOIN tbl_categories ON tbl_categories.category_id=tbl_sale_products.sale_product_category_id
        WHERE tbl_sale_products.sale_product_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $saleProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting saleProducts*/


      /* total saleProduct number */
      $stmt = $model->dbh->prepare("SELECT COUNT(sale_product_id) AS total_sale_product_number FROM tbl_sale_products WHERE sale_product_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalSaleProductNumber = $stmt->fetch()["total_sale_product_number"];
      /* total saleProduct number */

      /* total page number */
      $totalPageNumber = $totalSaleProductNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$saleProducts,
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
      $this->view->render('units/sale-product/sale-product-list');
    }

  }
  /* SALE PRODUCT LIST */

  /* NEW SALE PRODUCT */
  public function newSaleProduct()
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

      if (!isset($data["txtSaleProductStockDecrease"])) {
        $data["txtSaleProductStockDecreaseStockProductIds"] = array();
        $data["txtSaleProductStockDecreaseStockDecreaseAmounts"] = array();
      }

      /*inserting sale product*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_sale_products SET
        sale_product_name=:sale_product_name,
        sale_product_barcode=:sale_product_barcode,
        sale_product_size=:sale_product_size,
        sale_product_color=:sale_product_color,
        sale_product_quality=:sale_product_quality,
        sale_product_stock_piece=:sale_product_stock_piece,
        sale_product_unit_purchase_price=:sale_product_unit_purchase_price,
        sale_product_unit_selling_price=:sale_product_unit_selling_price,
        sale_product_purchase_tax_id=:sale_product_purchase_tax_id,
        sale_product_selling_tax_id=:sale_product_selling_tax_id,
        sale_product_unit_id=:sale_product_unit_id,
        sale_product_category_id=:sale_product_category_id,
        sale_product_stock_decrease_product_ids=:sale_product_stock_decrease_product_ids,
        sale_product_stock_decrease_amounts=:sale_product_stock_decrease_amounts
        "
      );
      $response = $stmt->execute([
        "sale_product_name"=>$data["txtSaleProductName"],
        "sale_product_barcode"=>$data["txtSaleProductBarcode"],
        "sale_product_size"=>$data["txtSaleProductSize"],
        "sale_product_color"=>$data["txtSaleProductColor"],
        "sale_product_quality"=>$data["txtSaleProductQuality"],
        "sale_product_stock_piece"=>$data["txtSaleProductStockPiece"],
        "sale_product_unit_purchase_price"=>$data["txtSaleProductUnitPurchasePrice"],
        "sale_product_unit_selling_price"=>$data["txtSaleProductUnitSellingPrice"],
        "sale_product_purchase_tax_id"=>$data["txtSaleProductPurchaseTaxId"],
        "sale_product_selling_tax_id"=>$data["txtSaleProductSellingTaxId"],
        "sale_product_unit_id"=>$data["txtSaleProductUnitId"],
        "sale_product_category_id"=>$data["txtSaleProductCategoryId"],
        "sale_product_stock_decrease_product_ids"=>json_encode($data["txtSaleProductStockDecreaseStockProductIds"]),
        "sale_product_stock_decrease_amounts"=>json_encode($data["txtSaleProductStockDecreaseStockDecreaseAmounts"]),
      ]);
      /*inserting sale product*/




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

      $model = null;

      $this->view->categories = $categories;
      $this->view->taxes = $taxes;
      $this->view->units = $units;
      $this->view->render('units/sale-product/new-sale-product');
    }

  }
  /* NEW SALE PRODUCT */

  /* UPDATE SALE PRODUCT */
  public function updateSaleProduct($saleProductId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting sale product*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sale_products SET
        sale_product_name=:sale_product_name
        WHERE sale_product_id=:sale_product_id
        "
      );
      $response = $stmt->execute([
        "sale_product_name"=>$data["txtSaleProductName"],
        "sale_product_id"=>$data["txtSaleProductId"]
      ]);
      /*inserting sale product*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*saleProduct informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_sale_products WHERE sale_product_id=:sale_product_id");
      $stmt->execute(["sale_product_id"=>$saleProductId]);
      $saleProductInformations = $stmt->fetch();
      /*saleProduct informations*/


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
      $this->view->saleProductInformations = $saleProductInformations;
      $this->view->render('units/sale-product/update-sale-product');
    }

  }
  /* UPDATE SALE PRODUCT */


  /* DELETE SALE PRODUCT */
  public function deleteSaleProduct($saleProductId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting sale product*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_sale_products WHERE sale_product_id=:sale_product_id");
      $response = $stmt->execute(["sale_product_id"=>$saleProductId]);
      /*deleting sale product*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE SALE PRODUCT */

  /* GET SALE PRODUCT INFORMATIONS */
  public function getSaleProductInformations($saleProductId)
  {
    if (isset($_POST["post"])) {

      $model = new Model();

      /*deleting sale product*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_sale_products.*,tbl_units.unit_name,tbl_taxes.tax_name
        FROM tbl_sale_products
        INNER JOIN tbl_units ON tbl_units.unit_id=tbl_sale_products.sale_product_unit_id
        LEFT JOIN tbl_taxes ON tbl_taxes.tax_id=tbl_sale_products.sale_product_purchase_tax_id
        WHERE tbl_sale_products.sale_product_id=:sale_product_id"
      );
      $stmt->execute(["sale_product_id"=>$saleProductId]);
      $saleProductInformations = $stmt->fetch();
      /*deleting sale product*/

      $model = null;


      echo json_encode(array(
        "saleProductInformations"=>$saleProductInformations
      ));
    }
  }
  /* GET SALE PRODUCT INFORMATIONS */


}
