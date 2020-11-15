<?php

/**
*
*/
class SaleCollection extends Controller
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


  /* TAKE SALE COLLECTION */
  public function takeSaleCollection()
  {
    if (isset($_POST["post"])) {
      $data = json_decode($_POST["post"],true);


      $model = new Model();


      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_sale_collections SET
        sale_collection_sale_id=:sale_collection_sale_id,
        sale_collection_payment_method_id=:sale_collection_payment_method_id,
        sale_collection_amount=:sale_collection_amount,
        sale_collection_query_user_id=:sale_collection_query_user_id
        "
      );
      $response = $stmt->execute([
        "sale_collection_sale_id"=>$data["txtSaleCollectionSaleId"],
        "sale_collection_payment_method_id"=>$data["txtSaleCollectionPaymentMethodId"],
        "sale_collection_amount"=>$data["txtSaleCollectionAmount"],
        "sale_collection_query_user_id"=>$_SESSION["employee_id"]
      ]);


      echo json_encode(array(
        "response"=>$response
      ));
    }
  }
  /* TAKE SALE COLLECTION */


  /* SALE COLLECTION LIST */
  public function saleCollectionList()
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
      if ($data["filters"]["txtSearchSaleId"] != "") {
        $sql .= "AND tbl_sale_collections.sale_collection_sale_id=:sale_id";
        $params["sale_id"] = $data["filters"]["txtSearchSaleId"];
      }
      /* adding filter */


      $model = new Model();

      /*selecting sales*/
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_sale_collections.sale_collection_id,
        tbl_sale_collections.sale_collection_amount,
        tbl_sale_collections.sale_collection_date,
        tbl_employees.employee_name,
        tbl_payment_methods.payment_method_name
        FROM tbl_sale_collections
        INNER JOIN tbl_employees ON tbl_sale_collections.sale_collection_query_user_id=tbl_employees.employee_id
        INNER JOIN tbl_payment_methods ON tbl_sale_collections.sale_collection_payment_method_id=tbl_payment_methods.payment_method_id
        WHERE tbl_sale_collections.sale_collection_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $saleCollections = $stmt->fetchAll(PDO::FETCH_ASSOC);

      for ($i=0; $i < count($saleCollections); $i++) {
        $saleCollections[$i]["sale_collection_date"] = $this->fixDateTime($saleCollections[$i]["sale_collection_date"]);
      }
      /*selecting sales*/

      /* total sale number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tbl_sale_collections.sale_collection_id) AS total_sale_collection_count
      FROM tbl_sale_collections
      INNER JOIN tbl_employees ON tbl_sale_collections.sale_collection_query_user_id=tbl_employees.employee_id
      INNER JOIN tbl_payment_methods ON tbl_sale_collections.sale_collection_payment_method_id=tbl_payment_methods.payment_method_id
      WHERE tbl_sale_collections.sale_collection_id IS NOT NULL
      $sql");
      $stmt->execute($params);
      $totalSaleCollectionCount = $stmt->fetch()["total_sale_collection_count"];
      /* total sale number */

      /* total page number */
      $totalPageNumber = $totalSaleCollectionCount / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$saleCollections,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));

    }

  }
  /* SALE COLLECTION LIST */


  /* DELETE SALE COLLECTION */
  public function deleteSaleCollection($saleCollectionId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting sale collection*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_sale_collections WHERE sale_collection_id=:sale_collection_id");
      $response = $stmt->execute(["sale_collection_id"=>$saleCollectionId]);
      /*deleting sale collection*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE SALE COLLECTION */

}
