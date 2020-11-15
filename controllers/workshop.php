<?php

/**
*
*/
class Workshop extends Controller
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


  /* WORKSHOP APP WORKSHOP LIST */
  public function workshopWorkshopList()
  {
    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT workshop_id,workshop_name,workshop_address FROM tbl_workshops");
    $stmt->execute();
    $workshops = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $this->view->workshops = $workshops;
    $this->view->render("apps/workshop/workshop-workshop-list");
  }
  /* WORKSHOP APP WORKSHOP LIST */


  /* WORKSHOP APP QUEUE LIST */
  public function workshopQueue($workshopId = '')
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
      if ($data["filters"]["txtSearchWorkshopId"] != "") {
        $sql .= " AND tbl_sales.sale_workshop_id=:sale_workshop_id";
        $params["sale_workshop_id"] = $data["filters"]["txtSearchWorkshopId"];
      }
      /* adding filter */

      $works = array();
      $model = new Model();

      /*selecting workshops*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_customers.customer_name,tbl_sales.sale_delivery_date,tbl_sales.sale_id,tbl_sales.sale_barcode
        FROM tbl_sales
        LEFT JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
        WHERE tbl_sales.sale_workshop_verify_employee_id IS NULL $sql LIMIT $limit OFFSET $offset
        "
      );
      $stmt->execute($params);
      $workshopQueue = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $today = date('Y-m-d');
      $tomorrow = date("Y-m-d", strtotime("+1 day"));

      for ($i=0; $i < count($workshopQueue); $i++) {

        $workshopQueue[$i]["sale_delivery_date"] = $this->fixDate($workshopQueue[$i]["sale_delivery_date"]);

        if (strtotime($workshopQueue[$i]["sale_delivery_date"]) == strtotime($today)) {
          $works[] = array(
            "todaysWorks"=>$workshopQueue[$i]
          );
        }elseif (strtotime($workshopQueue[$i]["sale_delivery_date"]) == strtotime($tomorrow)) {
          $works[] = array(
            "tomorrowsWorks"=>$workshopQueue[$i]
          );
        }else {
          $works[] = array(
            "otherWorks"=>$workshopQueue[$i]
          );
        }

      }
      /*selecting workshops*/

      /* total workshop number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tbl_sales.sale_id) AS total_workshop_count
      FROM tbl_sales
      LEFT JOIN tbl_customers ON tbl_customers.customer_id=tbl_sales.sale_customer_id
      WHERE tbl_sales.sale_workshop_verify_employee_id IS NULL $sql LIMIT $limit OFFSET $offset");
      $stmt->execute($params);
      $totalWorkshopCount = $stmt->fetch()["total_workshop_count"];
      /* total workshop number */

      /* total page number */
      $totalPageNumber = $totalWorkshopCount / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$works,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));
    }else {
      $model = new Model();

      /* workshop informations */
      $stmt = $model->dbh->prepare("SELECT workshop_id,workshop_name FROM tbl_workshops WHERE workshop_id=:workshop_id");
      $stmt->execute(["workshop_id"=>$workshopId]);
      $workshopInformations = $stmt->fetch();
      /* workshop informations */

      /* employees */
      $stmt = $model->dbh->prepare("SELECT employee_id,employee_name FROM tbl_employees");
      $stmt->execute();
      $employees = $stmt->fetchAll();
      /* employees */


      $this->view->workshopInformations = $workshopInformations;
      $this->view->employees = $employees;
      $this->view->render("apps/workshop/workshop-queue");
    }
  }
  /* WORKSHOP APP QUEUE LIST */


  /* VERIFY SALE WORKSHOP */
  public function verifySaleWorkshop()
  {
    if (isset($_POST["post"])) {
      $data = json_decode($_POST["post"],true);

      $model = new Model();

      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sales SET
        sale_workshop_verify_employee_id=:employee_id,
        sale_workshop_verify_date=current_date(),
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


        $response = $sms->sendSmsToCustomer($receivers,$text,false);
      }



      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* VERIFY SALE WORKSHOP */

  /* WORKSHOP LIST */
  public function workshopList()
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
      if ($data["filters"]["txtWorkshopName"] != "") {
        $sql .= "AND workshop_name LIKE :workshop_name";
        $params["workshop_name"] = "%".$data["filters"]["txtWorkshopName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting workshops*/
      $stmt = $model->dbh->prepare(
        "SELECT workshop_id,workshop_name,workshop_address,workshop_phone_number,workshop_email
        FROM tbl_workshops
        WHERE workshop_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $workshops = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting workshops*/

      /* total workshop number */
      $stmt = $model->dbh->prepare("SELECT COUNT(workshop_id) AS total_workshop_number FROM tbl_workshops WHERE workshop_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalWorkshopNumber = $stmt->fetch()["total_workshop_number"];
      /* total workshop number */

      /* total page number */
      $totalPageNumber = $totalWorkshopNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$workshops,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/workshop/workshop-list');
    }

  }
  /* WORKSHOP LIST */

  /* NEW WORKSHOP */
  public function newWorkshop()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting workshop*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_workshops SET
        workshop_name=:workshop_name,
        workshop_address=:workshop_address,
        workshop_phone_number=:workshop_phone_number,
        workshop_email=:workshop_email
        "
      );
      $response = $stmt->execute([
        "workshop_name"=>$data["txtWorkshopName"],
        "workshop_address"=>$data["txtWorkshopAddress"],
        "workshop_phone_number"=>$data["txtWorkshopPhoneNumber"],
        "workshop_email"=>$data["txtWorkshopEmail"]
      ]);
      /*inserting workshop*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/workshop/new-workshop');
    }

  }
  /* NEW WORKSHOP */

  /* UPDATE WORKSHOP */
  public function updateWorkshop($workshopId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*updating workshop*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_workshops SET
        workshop_name=:workshop_name,
        workshop_address=:workshop_address,
        workshop_phone_number=:workshop_phone_number,
        workshop_email=:workshop_email
        WHERE workshop_id=:workshop_id
        "
      );
      $response = $stmt->execute([
        "workshop_name"=>$data["txtWorkshopName"],
        "workshop_address"=>$data["txtWorkshopAddress"],
        "workshop_phone_number"=>$data["txtWorkshopPhoneNumber"],
        "workshop_email"=>$data["txtWorkshopEmail"],
        "workshop_id"=>$data["txtWorkshopId"]
      ]);
      /*updating workshop*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*workshop informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_workshops WHERE workshop_id=:workshop_id");
      $stmt->execute(["workshop_id"=>$workshopId]);
      $workshopInformations = $stmt->fetch();
      /*workshop informations*/

      $model = null;

      $this->view->workshopInformations = $workshopInformations;
      $this->view->render('units/workshop/update-workshop');
    }

  }
  /* UPDATE WORKSHOP */


  /* DELETE WORKSHOP */
  public function deleteWorkshop($workshopId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting workshop*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_workshops WHERE workshop_id=:workshop_id");
      $response = $stmt->execute(["workshop_id"=>$workshopId]);
      /*deleting workshop*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE WORKSHOP */




}
