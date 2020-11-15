<?php

/**
*
*/
class Dealer extends Controller
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

  /* FACTORY LIST */
  public function dealerList()
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
      if ($data["filters"]["txtDealerName"] != "") {
        $sql .= "AND dealer_name LIKE :dealer_name";
        $params["dealer_name"] = "%".$data["filters"]["txtDealerName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting dealers*/
      $stmt = $model->dbh->prepare(
        "SELECT dealer_id,dealer_name,dealer_program_unique_id
        FROM tbl_dealers
        WHERE dealer_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $dealers = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting dealers*/

      /* total dealer number */
      $stmt = $model->dbh->prepare("SELECT COUNT(dealer_id) AS total_dealer_number FROM tbl_dealers WHERE dealer_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalDealerNumber = $stmt->fetch()["total_dealer_number"];
      /* total dealer number */

      /* total page number */
      $totalPageNumber = $totalDealerNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$dealers,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/dealer/dealer-list');
    }

  }
  /* FACTORY LIST */

  /* NEW FACTORY */
  public function newDealer()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting dealer*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_dealers SET
        dealer_program_unique_id=:dealer_program_unique_id,
        dealer_name=:dealer_name,
        dealer_address=:dealer_address,
        dealer_phone_number=:dealer_phone_number,
        dealer_email=:dealer_email,
        dealer_db_server=:dealer_db_server,
        dealer_db_name=:dealer_db_name,
        dealer_db_username=:dealer_db_username,
        dealer_db_password=:dealer_db_password
        "
      );
      $response = $stmt->execute([
        "dealer_program_unique_id"=>$data["txtDealerProgramUniqueId"],
        "dealer_name"=>$data["txtDealerName"],
        "dealer_address"=>$data["txtDealerAddress"],
        "dealer_phone_number"=>$data["txtDealerPhoneNumber"],
        "dealer_email"=>$data["txtDealerEmail"],
        "dealer_db_server"=>$data["txtDealerDbServer"],
        "dealer_db_name"=>$data["txtDealerDbName"],
        "dealer_db_username"=>$data["txtDealerDbUsername"],
        "dealer_db_password"=>$data["txtDealerDbPassword"]
      ]);
      /*inserting dealer*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/dealer/new-dealer');
    }

  }
  /* NEW FACTORY */

  /* UPDATE FACTORY */
  public function updateDealer($dealerId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*updating dealer*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_dealers SET
        dealer_program_unique_id=:dealer_program_unique_id,
        dealer_name=:dealer_name,
        dealer_address=:dealer_address,
        dealer_phone_number=:dealer_phone_number,
        dealer_email=:dealer_email,
        dealer_db_server=:dealer_db_server,
        dealer_db_name=:dealer_db_name,
        dealer_db_username=:dealer_db_username,
        dealer_db_password=:dealer_db_password
        WHERE dealer_id=:dealer_id
        "
      );
      $response = $stmt->execute([
        "dealer_program_unique_id"=>$data["txtDealerProgramUniqueId"],
        "dealer_name"=>$data["txtDealerName"],
        "dealer_address"=>$data["txtDealerAddress"],
        "dealer_phone_number"=>$data["txtDealerPhoneNumber"],
        "dealer_email"=>$data["txtDealerEmail"],
        "dealer_db_server"=>$data["txtDealerDbServer"],
        "dealer_db_name"=>$data["txtDealerDbName"],
        "dealer_db_username"=>$data["txtDealerDbUsername"],
        "dealer_db_password"=>$data["txtDealerDbPassword"],
        "dealer_id"=>$data["txtDealerId"]
      ]);
      /*updating dealer*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*dealer informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_dealers WHERE dealer_id=:dealer_id");
      $stmt->execute(["dealer_id"=>$dealerId]);
      $dealerInformations = $stmt->fetch();
      /*dealer informations*/

      $model = null;

      $this->view->dealerInformations = $dealerInformations;
      $this->view->render('units/dealer/update-dealer');
    }

  }
  /* UPDATE FACTORY */


  /* DELETE FACTORY */
  public function deleteDealer($dealerId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting dealer*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_dealers WHERE dealer_id=:dealer_id");
      $response = $stmt->execute(["dealer_id"=>$dealerId]);
      /*deleting dealer*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE FACTORY */




}
