<?php

/**
*
*/
class Collection extends Controller
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
  public function collectionList()
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
      if ($data["filters"]["txtCollectionCustomerId"] != "") {
        $sql .= " AND tbl_customers.customer_name LIKE :customer_name";
        $params["customer_name"] = "%".$data["filters"]["txtCollectionCustomerId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtCollectionCategoryId"] != "") {
        $sql .= " AND tbl_categories.category_name LIKE :category_name";
        $params["category_name"] = "%".$data["filters"]["txtCollectionCategoryId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtCollectionDate"] != "") {
        $sql .= " AND DATE(collection_date)=:collection_date";
        $params["collection_date"] = $data["filters"]["txtCollectionDate"];
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtCollectionCashId"] != "") {
        $sql .= " AND tbl_cashes.cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtCollectionCashId"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting collections*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_collections.collection_id,
        tbl_customers.customer_name,
        tbl_categories.category_name,
        tbl_collections.collection_date,
        tbl_cashes.cash_name,
        tbl_collections.collection_amount
        FROM tbl_collections
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_collections.collection_customer_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_collections.collection_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_collections.collection_cash_id
        WHERE tbl_collections.collection_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $collections = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting collections*/

      /* total collection number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tbl_collections.collection_id) AS total_collection_number
      FROM tbl_collections
      INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_collections.collection_customer_id
      INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_collections.collection_category_id
      INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_collections.collection_cash_id
      WHERE tbl_collections.collection_id IS NOT NULL
      $sql");
      $stmt->execute($params);
      $totalCollectionNumber = $stmt->fetch()["total_collection_number"];
      /* total collection number */

      /* total page number */
      $totalPageNumber = $totalCollectionNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$collections,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('apps/accounting/collection/collection-list');
    }

  }
  /* PAYMENT LIST */

  /* NEW PAYMENT */
  public function newCollection()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting collection*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_collections SET
        collection_customer_id=:collection_customer_id,
        collection_category_id=:collection_category_id,
        collection_date=:collection_date,
        collection_cash_id=:collection_cash_id,
        collection_amount=:collection_amount
        "
      );
      $response = $stmt->execute([
        "collection_customer_id"=>$data["txtCollectionCustomerId"],
        "collection_category_id"=>$data["txtCollectionCategoryId"],
        "collection_date"=>$data["txtCollectionDate"],
        "collection_cash_id"=>$data["txtCollectionCashId"],
        "collection_amount"=>$data["txtCollectionAmount"]
      ]);
      /*inserting collection*/


      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('apps/accounting/collection/new-collection');
    }

  }
  /* NEW PAYMENT */

  /* UPDATE PAYMENT */
  public function updateCollection($collectionId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*update collection*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_collections SET
        collection_customer_id=:collection_customer_id,
        collection_category_id=:collection_category_id,
        collection_date=:collection_date,
        collection_cash_id=:collection_cash_id,
        collection_amount=:collection_amount
        WHERE collection_id=:collection_id
        "
      );
      $response = $stmt->execute([
        "collection_customer_id"=>$data["txtCollectionCustomerId"],
        "collection_category_id"=>$data["txtCollectionCategoryId"],
        "collection_date"=>$data["txtCollectionDate"],
        "collection_cash_id"=>$data["txtCollectionCashId"],
        "collection_amount"=>$data["txtCollectionAmount"],
        "collection_id"=>$data["txtCollectionId"]
      ]);
      /*update collection*/


      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*collection informations*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_collections.*,tbl_customers.customer_name,tbl_categories.category_name,tbl_cashes.cash_name
        FROM tbl_collections
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_collections.collection_customer_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_collections.collection_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_collections.collection_cash_id
        WHERE collection_id=:collection_id"

      );
      $stmt->execute(["collection_id"=>$collectionId]);
      $collectionInformations = $stmt->fetch();
      /*collection informations*/

      $model = null;

      $this->view->collectionInformations = $collectionInformations;
      $this->view->render('apps/accounting/collection/update-collection');
    }

  }
  /* UPDATE PAYMENT */


  /* DELETE PAYMENT */
  public function deleteCollection($collectionId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting collection*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_collections WHERE collection_id=:collection_id");
      $response = $stmt->execute(["collection_id"=>$collectionId]);
      /*deleting collection*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE PAYMENT */




}
