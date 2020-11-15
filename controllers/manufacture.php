<?php

/**
*
*/
class Manufacture extends Controller
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


  /* MANUFACTURE ORDER LIST */
  public function manufactureDealerList()
  {
    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT dealer_id,dealer_name,dealer_address FROM tbl_dealers");
    $stmt->execute();
    $dealers = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $this->view->dealers = $dealers;
    $this->view->render("apps/manufacture/manufacture-dealer-list");
  }
  /* MANUFACTURE ORDER LIST */


  /* LIVE ORDER LIST */
  public function liveOrderList($dealerId = "")
  {
    if (isset($_POST["post"])) {

      $model = new Model();


      $data = json_decode($_POST["post"],true);

      /* limit, offset and sql*/
      $limit = $data["itemPerPage"];
      $offset = ($data["pageNumber"] - 1) * $limit;
      $sql = "";
      $params = array();
      /* limit, offset and sql*/

      /* adding filter */
      // if ($data["filters"]["txtDealerId"] != "") {
      //   $sql .= "AND employee_name LIKE :employee_name";
      //   $params["employee_name"] = "%".$data["filters"]["txtDealerId"]."%";
      // }
      /* adding filter */


      /* dealer informations */
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_dealers WHERE dealer_id=:dealer_id");
      $stmt->execute(["dealer_id"=>$data["filters"]["txtSearchDealerId"]]);
      $dealerInformations = $stmt->fetch();
      /* dealer informations */


      /* connecting dealers database */
      try {
        $dealerDbConnection = new PDO('mysql:host='.$dealerInformations["dealer_db_server"].';dbname='.$dealerInformations["dealer_db_name"].';charset=utf8', $dealerInformations["dealer_db_username"], $dealerInformations["dealer_db_password"]);
      } catch (PDOException $e) {
        echo "Hata! :".$e->getMessage()."";
        die();
      }
      /* connecting dealers database */

      /* dealers sale list */
      $stmt = $dealerDbConnection->prepare(
        "SELECT
        tbl_customers.customer_name,
        tbl_customers.customer_address,
        tbl_employees.employee_name,
        tbl_sales.*
        FROM tbl_sales
        INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
        INNER JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
        WHERE tbl_sales.sale_sent_factory_id IS NOT NULL $sql LIMIT $limit OFFSET $offset
        "
      );
      $stmt->execute($params);
      $dealersOrderList = $stmt->fetchAll();
      /* dealers sale list  */


      /* dealers sale informations */
      for ($i=0; $i < count($dealersOrderList); $i++) {
        $stmt = $dealerDbConnection->prepare(
          "SELECT
          tbl_sale_informations.*
          FROM tbl_sale_informations
          WHERE tbl_sale_informations.sale_information_sale_id=:sale_id"
        );
        $stmt->execute(["sale_id"=>@$dealersOrderList[$i]["sale_id"]]);
        $saleInformations = $stmt->fetchAll();
        $dealersOrderList[$i]["sale_informations"] = $saleInformations;
        for ($a=0; $a < count($dealersOrderList[$i]["sale_informations"]); $a++) {
          $dealersOrderList[$i]["sale_informations"][$a]["sale_information_product_pieces"] = json_decode($dealersOrderList[$i]["sale_informations"][$a]["sale_information_product_pieces"],true);
          $dealersOrderList[$i]["sale_informations"][$a]["sale_information_stor_widths"] = json_decode($dealersOrderList[$i]["sale_informations"][$a]["sale_information_stor_widths"],true);
          $dealersOrderList[$i]["sale_informations"][$a]["sale_information_stor_heights"] = json_decode($dealersOrderList[$i]["sale_informations"][$a]["sale_information_stor_heights"],true);
        }
      }
      /* dealers sale informations */




      /* total employee number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tbl_sales.sale_id) AS total_order_count
      FROM tbl_sales
      INNER JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
      INNER JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
      LEFT JOIN tbl_sale_informations ON tbl_sale_informations.sale_information_sale_id=tbl_sales.sale_id
      WHERE tbl_sales.sale_sent_factory_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalOrderCount = $stmt->fetch()["total_order_count"];
      /* total employee number */

      /* total page number */
      $totalPageNumber = $totalOrderCount / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$dealersOrderList,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));


    }else {

      $model = new Model();


      /* dealer informations */
      $stmt = $model->dbh->prepare("SELECT dealer_id,dealer_name FROM tbl_dealers WHERE dealer_id=:dealer_id");
      $stmt->execute(["dealer_id"=>$dealerId]);
      $dealerInformations = $stmt->fetch();
      /* dealer informations */

      /* units */
      $stmt = $model->dbh->prepare("SELECT unit_id,unit_name FROM tbl_units");
      $stmt->execute();
      $units = $stmt->fetchAll();
      /* units */

      $this->view->units = $units;
      $this->view->dealerInformations = $dealerInformations;
      $this->view->render("apps/manufacture/live-order-list");
    }

  }
  /* LIVE ORDER LIST */




}
