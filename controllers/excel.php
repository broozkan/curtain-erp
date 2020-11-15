<?php

/**
*
*/
class Excel extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $page = 1;

  function __construct()
  {
    parent::__construct();

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {

    }
  }


  /* ACCOUNTING QUERY LIST */
  public function includeFromExcel()
  {
    require_once $this->pathPhp.'simplexlsx-master/simplexlsx.class.php';

    $model = new Model();

    if ( $xlsx = SimpleXLSX::parse('perakende-satis-listesi.xlsx')) {
      for ($i=0; $i < count($xlsx->rows()); $i++) {

        $stmt = $model->dbh->prepare(
          "INSERT INTO tbl_sale_products SET
          sale_product_name=:sale_product_name,
          sale_product_barcode=:sale_product_barcode,
          sale_product_photo=:sale_product_photo,
          sale_product_size=:sale_product_size,
          sale_product_color=:sale_product_color,
          sale_product_quality=:sale_product_quality,
          sale_product_stock_piece=:sale_product_stock_piece,
          sale_product_unit_purchase_price=:sale_product_unit_purchase_price,
          sale_product_unit_selling_price=:sale_product_unit_selling_price,
          sale_product_purchase_tax_id=:sale_product_purchase_tax_id,
          sale_product_selling_tax_id=:sale_product_selling_tax_id,
          sale_product_unit_id=:sale_product_unit_id,
          sale_product_category_id=:sale_product_category_id
          "
        );
        $respone = $stmt->execute([
          "sale_product_name"=>$xlsx->rows()[$i][1],
          "sale_product_barcode"=>$xlsx->rows()[$i][2],
          "sale_product_photo"=>$xlsx->rows()[$i][3],
          "sale_product_size"=>$xlsx->rows()[$i][4],
          "sale_product_color"=>$xlsx->rows()[$i][5],
          "sale_product_quality"=>$xlsx->rows()[$i][6],
          "sale_product_stock_piece"=>$xlsx->rows()[$i][7],
          "sale_product_unit_purchase_price"=>$xlsx->rows()[$i][8],
          "sale_product_unit_selling_price"=>$xlsx->rows()[$i][9],
          "sale_product_purchase_tax_id"=>$xlsx->rows()[$i][10],
          "sale_product_selling_tax_id"=>$xlsx->rows()[$i][11],
          "sale_product_unit_id"=>$xlsx->rows()[$i][12],
          "sale_product_category_id"=>$xlsx->rows()[$i][13]
        ]);
        if ($respone == true) {
          echo "Kaydedildi";
          echo "<br>";
        }
      }


    } else {
    	echo SimpleXLSX::parse_error();
    }
  }
  /* ACCOUNTING QUERY LIST */




}
