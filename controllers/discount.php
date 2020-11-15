<?php

/**
*
*/
class Discount extends Controller
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

  /* DISCOUNT LIST */
  public function discountList()
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
      if ($data["filters"]["txtDiscountName"] != "") {
        $sql .= "AND discount_name LIKE :discount_name";
        $params["discount_name"] = "%".$data["filters"]["txtDiscountName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting discountes*/
      $stmt = $model->dbh->prepare(
        "SELECT discount_id,discount_name,discount_amount
        FROM tbl_discounts
        WHERE discount_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $discountes = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting discountes*/

      /* total discount number */
      $stmt = $model->dbh->prepare("SELECT COUNT(discount_id) AS total_discount_number FROM tbl_discounts WHERE discount_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalDiscountNumber = $stmt->fetch()["total_discount_number"];
      /* total discount number */

      /* total page number */
      $totalPageNumber = $totalDiscountNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$discountes,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/discount/discount-list');
    }

  }
  /* DISCOUNT LIST */

  /* NEW DISCOUNT */
  public function newDiscount()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting discount*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_discounts SET
        discount_name=:discount_name,
        discount_type=:discount_type,
        discount_amount=:discount_amount
        "
      );
      $response = $stmt->execute([
        "discount_name"=>$data["txtDiscountName"],
        "discount_type"=>$data["txtDiscountType"],
        "discount_amount"=>$data["txtDiscountAmount"]
      ]);
      /*inserting discount*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/discount/new-discount');
    }

  }
  /* NEW DISCOUNT */

  /* UPDATE DISCOUNT */
  public function updateDiscount($discountId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



        $model = new Model();

        /*updating discount*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_discounts SET
          discount_name=:discount_name,
          discount_type=:discount_type,
          discount_amount=:discount_amount
          WHERE discount_id=:discount_id
          "
        );
        $response = $stmt->execute([
          "discount_name"=>$data["txtDiscountName"],
          "discount_type"=>$data["txtDiscountType"],
          "discount_amount"=>$data["txtDiscountAmount"],
          "discount_id"=>$data["txtDiscountId"]
        ]);
        /*updating discount*/

        $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*discount informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_discounts WHERE discount_id=:discount_id");
      $stmt->execute(["discount_id"=>$discountId]);
      $discountInformations = $stmt->fetch();
      /*discount informations*/

      $model = null;

      $this->view->discountInformations = $discountInformations;
      $this->view->render('units/discount/update-discount');
    }

  }
  /* UPDATE DISCOUNT */


  /* DELETE DISCOUNT */
  public function deleteDiscount($discountId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting discount*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_discounts WHERE discount_id=:discount_id");
      $response = $stmt->execute(["discount_id"=>$discountId]);
      /*deleting discount*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE DISCOUNT */


  /* GET DISCOUNT INFORMATIONS */
  public function getDiscountInformations()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      $discountInformations = array();
      for ($i=0; $i < count($data["discount_ids"]); $i++) {

        /*deleting discount*/
        $stmt = $model->dbh->prepare("SELECT * FROM tbl_discounts WHERE discount_id=:discount_id");
        $stmt->execute(["discount_id"=>$data["discount_ids"][$i]]);
        $discount = $stmt->fetch();
        /*deleting discount*/


        $discountInformations[$discount["discount_percentage"]][] = $discount["discount_percentage"];

      }

      $model = null;
    }
  }
  /* GET DISCOUNT INFORMATIONS */

  /* GET DISCOUNTS */
  public function getDiscounts()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*discounts*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_discounts");
      $stmt->execute();
      $discounts = $stmt->fetchAll();
      /*discounts*/


      $model = null;


      echo json_encode(array(
        "data"=>$discounts
      ));
    }
  }
  /* GET DISCOUNTS */


}
