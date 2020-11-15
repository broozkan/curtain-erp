<?php

/**
*
*/
class Factory extends Controller
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


  /* FACTORY APP FACTORY LIST */
  public function factoryFactoryList()
  {
    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT factory_id,factory_name,factory_address FROM tbl_factories");
    $stmt->execute();
    $factorys = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $this->view->factorys = $factorys;
    $this->view->render("apps/factory/factory-factory-list");
  }
  /* FACTORY APP FACTORY LIST */


  /* FACTORY APP QUEUE LIST */
  public function factoryQueue($factoryId = '')
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
      if ($data["filters"]["txtSearchSaleBarcode"] != "") {
        $data["filters"]["txtSearchSaleBarcode"] = str_replace(' ', '',  $data["filters"]["txtSearchSaleBarcode"]);
        $sql .= " AND tbl_sales.sale_barcode=:sale_barcode";
        $params["sale_barcode"] = $data["filters"]["txtSearchSaleBarcode"];
      }
      /* adding filter */


      /* adding filter */
      if ($data["filters"]["txtSearchFactoryId"] != "") {
        $sql .= " AND tbl_sales.sale_factory_id=:sale_factory_id";
        $params["sale_factory_id"] = $data["filters"]["txtSearchFactoryId"];
      }
      /* adding filter */

      $works = array();
      $model = new Model();

      /*selecting factorys*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_customers.customer_name,tbl_sales.sale_delivery_date,tbl_sales.sale_id,tbl_sales.sale_barcode
        FROM tbl_sales
        LEFT JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
        WHERE tbl_sales.sale_factory_verify_employee_id IS NULL $sql LIMIT $limit OFFSET $offset
        "
      );
      $stmt->execute($params);
      $factoryQueue = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $today = date('Y-m-d');
      $tomorrow = date("Y-m-d", strtotime("+1 day"));

      for ($i=0; $i < count($factoryQueue); $i++) {

        $factoryQueue[$i]["sale_delivery_date"] = $this->fixDate($factoryQueue[$i]["sale_delivery_date"]);

        if (strtotime($factoryQueue[$i]["sale_delivery_date"]) == strtotime($today)) {
          $works[] = array(
            "todaysWorks"=>$factoryQueue[$i]
          );
        }elseif (strtotime($factoryQueue[$i]["sale_delivery_date"]) == strtotime($tomorrow)) {
          $works[] = array(
            "tomorrowsWorks"=>$factoryQueue[$i]
          );
        }else {
          $works[] = array(
            "otherWorks"=>$factoryQueue[$i]
          );
        }

      }
      /*selecting factorys*/

      /* total factory number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tbl_sales.sale_id) AS total_factory_count
      FROM tbl_sales
      LEFT JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
      WHERE tbl_sales.sale_factory_verify_employee_id IS NULL $sql LIMIT $limit OFFSET $offset");
      $stmt->execute($params);
      $totalFactoryCount = $stmt->fetch()["total_factory_count"];
      /* total factory number */

      /* total page number */
      $totalPageNumber = $totalFactoryCount / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$works,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));
    }else {
      $model = new Model();

      /* factory informations */
      $stmt = $model->dbh->prepare("SELECT factory_id,factory_name FROM tbl_factories WHERE factory_id=:factory_id");
      $stmt->execute(["factory_id"=>$factoryId]);
      $factoryInformations = $stmt->fetch();
      /* factory informations */

      /* employees */
      $stmt = $model->dbh->prepare("SELECT employee_id,employee_name FROM tbl_employees");
      $stmt->execute();
      $employees = $stmt->fetchAll();
      /* employees */


      $this->view->factoryInformations = $factoryInformations;
      $this->view->employees = $employees;
      $this->view->render("apps/factory/factory-queue");
    }
  }
  /* FACTORY APP QUEUE LIST */


  /* VERIFY SALE FACTORY */
  public function verifySaleFactory()
  {
    if (isset($_POST["post"])) {
      $data = json_decode($_POST["post"],true);

      $model = new Model();

      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sales SET
        sale_factory_verify_employee_id=:employee_id,
        sale_factory_verify_date=current_date(),
        sale_state=:sale_state
        WHERE sale_id=:sale_id
        "
      );
      $response = $stmt->execute([
        "employee_id"=>$data["txtEmployeeId"],
        "sale_state"=>"Montaja Hazır",
        "sale_id"=>$data["txtSaleId"]
      ]);

      /* customer phone number*/
      if ($response == true) {
        $stmt = $model->dbh->prepare(
          "SELECT tbl_customers.customer_id
           FROM tbl_sales
           LEFT JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
           WHERE tbl_sales.sale_id=:sale_id"
         );
        $stmt->execute(["sale_id"=>$data["txtSaleId"]]);
        $customerInformations = $stmt->fetch();
        /* customer phone number*/

        require $this->pathPhp."controllers/sms.php";
        $sms = new Sms();
        $receivers = array();
        $receivers[] = $customerInformations["customer_id"];
        $text = "Degerli musterimiz siparisiniz teslimata hazirlanmistir.
Tel:08504201058";


        // $response = $sms->sendSmsToCustomer($receivers,$text,false);
      }



      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* VERIFY SALE FACTORY */

  /* FACTORY LIST */
  public function factoryList()
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
      if ($data["filters"]["txtFactoryName"] != "") {
        $sql .= "AND factory_name LIKE :factory_name";
        $params["factory_name"] = "%".$data["filters"]["txtFactoryName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting factorys*/
      $stmt = $model->dbh->prepare(
        "SELECT factory_id,factory_name,factory_address,factory_phone_number,factory_email
        FROM tbl_factories
        WHERE factory_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $factorys = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting factorys*/

      /* total factory number */
      $stmt = $model->dbh->prepare("SELECT COUNT(factory_id) AS total_factory_number FROM tbl_factories WHERE factory_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalFactoryNumber = $stmt->fetch()["total_factory_number"];
      /* total factory number */

      /* total page number */
      $totalPageNumber = $totalFactoryNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$factorys,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/factory/factory-list');
    }

  }
  /* FACTORY LIST */

  /* NEW FACTORY */
  public function newFactory()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting factory*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_factories SET
        factory_name=:factory_name,
        factory_address=:factory_address,
        factory_phone_number=:factory_phone_number,
        factory_email=:factory_email
        "
      );
      $response = $stmt->execute([
        "factory_name"=>$data["txtFactoryName"],
        "factory_address"=>$data["txtFactoryAddress"],
        "factory_phone_number"=>$data["txtFactoryPhoneNumber"],
        "factory_email"=>$data["txtFactoryEmail"]
      ]);
      /*inserting factory*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/factory/new-factory');
    }

  }
  /* NEW FACTORY */

  /* UPDATE FACTORY */
  public function updateFactory($factoryId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*updating factory*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_factories SET
        factory_name=:factory_name,
        factory_address=:factory_address,
        factory_phone_number=:factory_phone_number,
        factory_email=:factory_email
        WHERE factory_id=:factory_id
        "
      );
      $response = $stmt->execute([
        "factory_name"=>$data["txtFactoryName"],
        "factory_address"=>$data["txtFactoryAddress"],
        "factory_phone_number"=>$data["txtFactoryPhoneNumber"],
        "factory_email"=>$data["txtFactoryEmail"],
        "factory_id"=>$data["txtFactoryId"]
      ]);
      /*updating factory*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*factory informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_factories WHERE factory_id=:factory_id");
      $stmt->execute(["factory_id"=>$factoryId]);
      $factoryInformations = $stmt->fetch();
      /*factory informations*/

      $model = null;

      $this->view->factoryInformations = $factoryInformations;
      $this->view->render('units/factory/update-factory');
    }

  }
  /* UPDATE FACTORY */


  /* DELETE FACTORY */
  public function deleteFactory($factoryId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting factory*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_factories WHERE factory_id=:factory_id");
      $response = $stmt->execute(["factory_id"=>$factoryId]);
      /*deleting factory*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE FACTORY */




}
