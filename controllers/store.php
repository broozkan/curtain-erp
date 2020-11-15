<?php

/**
*
*/
class Store extends Controller
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

  /* STORE LIST */
  public function storeList()
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
      if ($data["filters"]["txtStoreName"] != "") {
        $sql .= "AND store_name LIKE :store_name";
        $params["store_name"] = "%".$data["filters"]["txtStoreName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting stores*/
      $stmt = $model->dbh->prepare(
        "SELECT store_id,store_name
        FROM tbl_stores
        WHERE store_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting stores*/

      /* total store number */
      $stmt = $model->dbh->prepare("SELECT COUNT(store_id) AS total_store_number FROM tbl_stores WHERE store_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalStoreNumber = $stmt->fetch()["total_store_number"];
      /* total store number */

      /* total page number */
      $totalPageNumber = $totalStoreNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$stores,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/store/store-list');
    }

  }
  /* STORE LIST */

  /* NEW STORE */
  public function newStore()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting store*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_stores SET
        store_name=:store_name
        "
      );
      $response = $stmt->execute([
        "store_name"=>$data["txtStoreName"]
      ]);
      /*inserting store*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/store/new-store');
    }

  }
  /* NEW STORE */

  /* UPDATE STORE */
  public function updateStore($storeId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting store*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_stores SET
        store_name=:store_name
        WHERE store_id=:store_id
        "
      );
      $response = $stmt->execute([
        "store_name"=>$data["txtStoreName"],
        "store_id"=>$data["txtStoreId"]
      ]);
      /*inserting store*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*store informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_stores WHERE store_id=:store_id");
      $stmt->execute(["store_id"=>$storeId]);
      $storeInformations = $stmt->fetch();
      /*store informations*/

      $model = null;

      $this->view->storeInformations = $storeInformations;
      $this->view->render('units/store/update-store');
    }

  }
  /* UPDATE STORE */


  /* DELETE STORE */
  public function deleteStore($storeId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting store*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_stores WHERE store_id=:store_id");
      $response = $stmt->execute(["store_id"=>$storeId]);
      /*deleting store*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE STORE */




}
