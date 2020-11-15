<?php

/**
*
*/
class Category extends Controller
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
  public function categoryList()
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
      if ($data["filters"]["txtCategoryName"] != "") {
        $sql .= "AND category_name LIKE :category_name";
        $params["category_name"] = "%".$data["filters"]["txtCategoryName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting categorys*/
      $stmt = $model->dbh->prepare(
        "SELECT category_id,category_name
        FROM tbl_categories
        WHERE category_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $categorys = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting categorys*/

      /* total category number */
      $stmt = $model->dbh->prepare("SELECT COUNT(category_id) AS total_category_number FROM tbl_categories WHERE category_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalCategoryNumber = $stmt->fetch()["total_category_number"];
      /* total category number */

      /* total page number */
      $totalPageNumber = $totalCategoryNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$categorys,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/category/category-list');
    }

  }
  /* CATEGORY LIST */

  /* NEW CATEGORY */
  public function newCategory()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting category*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_categories SET
        category_name=:category_name
        "
      );
      $response = $stmt->execute([
        "category_name"=>$data["txtCategoryName"]
      ]);
      /*inserting category*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/category/new-category');
    }

  }
  /* NEW CATEGORY */

  /* UPDATE CATEGORY */
  public function updateCategory($categoryId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting category*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_categories SET
        category_name=:category_name
        WHERE category_id=:category_id
        "
      );
      $response = $stmt->execute([
        "category_name"=>$data["txtCategoryName"],
        "category_id"=>$data["txtCategoryId"]
      ]);
      /*inserting category*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*category informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_categories WHERE category_id=:category_id");
      $stmt->execute(["category_id"=>$categoryId]);
      $categoryInformations = $stmt->fetch();
      /*category informations*/

      $model = null;

      $this->view->categoryInformations = $categoryInformations;
      $this->view->render('units/category/update-category');
    }

  }
  /* UPDATE CATEGORY */


  /* DELETE CATEGORY */
  public function deleteCategory($categoryId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting category*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_categories WHERE category_id=:category_id");
      $response = $stmt->execute(["category_id"=>$categoryId]);
      /*deleting category*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE CATEGORY */




}
