<?php

/**
*
*/
class GivenCheck extends Controller
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

  /* GIVEN CHECK LIST */
  public function givenCheckList()
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
      if ($data["filters"]["txtGivenCheckSupplierId"] != "") {
        $sql .= " AND tbl_suppliers.supplier_name LIKE :supplier_name";
        $params["supplier_name"] = "%".$data["filters"]["txtGivenCheckSupplierId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtGivenCheckCategoryId"] != "") {
        $sql .= " AND tbl_categories.category_name LIKE :category_name";
        $params["category_name"] = "%".$data["filters"]["txtGivenCheckCategoryId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtGivenCheckMaturityDate"] != "") {
        $sql .= " AND DATE(tbl_given_checks.given_check_maturity_date)=:maturity_date";
        $params["maturity_date"] = $data["filters"]["txtGivenCheckMaturityDate"];
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtGivenCheckCashId"] != "") {
        $sql .= " AND tbl_cashes.cash_name LIKE :cash_name";
        $params["cash_name"] = "%".$data["filters"]["txtGivenCheckCashId"]."%";
      }
      /* adding filter */

      /* adding filter */
      if ($data["filters"]["txtGivenCheckBankId"] != "") {
        $sql .= " AND tbl_banks.bank_name LIKE :bank_name";
        $params["bank_name"] = "%".$data["filters"]["txtGivenCheckBankId"]."%";
      }
      /* adding filter */


      $model = new Model();


      /*selecting givenChecks*/
      $stmt = $model->dbh->prepare(
        "SELECT
        tbl_given_checks.given_check_id,
        tbl_suppliers.supplier_name,
        tbl_categories.category_name,
        tbl_given_checks.given_check_maturity_date,
        tbl_cashes.cash_name,
        tbl_banks.bank_name,
        tbl_given_checks.given_check_amount
        FROM tbl_given_checks
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_given_checks.given_check_supplier_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_given_checks.given_check_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_given_checks.given_check_cash_id
        INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_given_checks.given_check_bank_id
        WHERE tbl_given_checks.given_check_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $givenChecks = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting givenChecks*/


      /* total givenCheck number */

      $stmt = $model->dbh->prepare(
        "SELECT
        COUNT(tbl_given_checks.given_check_id) AS total_given_check_number
        FROM tbl_given_checks
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_given_checks.given_check_supplier_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_given_checks.given_check_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_given_checks.given_check_cash_id
        INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_given_checks.given_check_bank_id
        WHERE tbl_given_checks.given_check_id IS NOT NULL
        $sql"
      );
      $stmt->execute($params);
      $totalGivenCheckNumber = $stmt->fetch()["total_given_check_number"];
      /* total givenCheck number */

      /* total page number */
      $totalPageNumber = $totalGivenCheckNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$givenChecks,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $model = new Model();

      /* categories */
      $stmt = $model->dbh->prepare("SELECT category_id,category_name FROM tbl_categories");
      $stmt->execute();
      $categories = $stmt->fetchAll();
      /* categories */

      $model = null;

      $this->view->categories = $categories;
      $this->view->render('apps/accounting/given-check/given-check-list');
    }

  }
  /* GIVEN CHECK LIST */

  /* NEW GIVEN CHECK */
  public function newGivenCheck()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* photo file control, upload */
      if (isset($_FILES["photo"])) {
        if(file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
          $photoName = $_FILES["photo"]["name"];
          $uploadFolder = $this->pathPhp."assets/images/given-checks/".$photoName;
          $photo=$_FILES["photo"]["tmp_name"];

          if ($_FILES["photo"]["size"] > 1048576) {
            $permission = "false";
            $response = "Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }else {
            $permission = "true";
          }

          if(move_uploaded_file($photo,$uploadFolder) && $permission == "true"){
            $permission == "true";
            $response = true;
          }else{
            $response = "Fotoğraf yüklenemediği için hata alındı. Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }
        }else {
          $photoName = null;
        }
      }else {
        $photoName = null;
      }
      /* photo file control, upload */

      $model = new Model();

      /*inserting given check*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_given_checks SET
        given_check_supplier_id=:given_check_supplier_id,
        given_check_category_id=:given_check_category_id,
        given_check_maturity_date=:given_check_maturity_date,
        given_check_type=:given_check_type,
        given_check_file_number=:given_check_file_number,
        given_check_cash_id=:given_check_cash_id,
        given_check_bank_id=:given_check_bank_id,
        given_check_state=:given_check_state,
        given_check_amount=:given_check_amount,
        given_check_description=:given_check_description,
        given_check_photo=:given_check_photo
        "
      );
      $response = $stmt->execute([
        "given_check_supplier_id"=>$data["txtGivenCheckSupplierId"],
        "given_check_category_id"=>$data["txtGivenCheckCategoryId"],
        "given_check_maturity_date"=>$data["txtGivenCheckMaturityDate"],
        "given_check_type"=>$data["txtGivenCheckType"],
        "given_check_file_number"=>$data["txtGivenCheckFileNumber"],
        "given_check_cash_id"=>$data["txtGivenCheckCashId"],
        "given_check_bank_id"=>$data["txtGivenCheckBankId"],
        "given_check_state"=>$data["txtGivenCheckState"],
        "given_check_amount"=>$data["txtGivenCheckAmount"],
        "given_check_description"=>$data["txtGivenCheckDescription"],
        "given_check_photo"=>$photoName
      ]);
      /*inserting given check*/
      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $this->view->render('apps/accounting/given-check/new-given-check');
    }

  }
  /* NEW GIVEN CHECK */

  /* UPDATE GIVEN CHECK */
  public function updateGivenCheck($givenCheckId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* photo file control, upload */
      if (isset($_FILES["photo"])) {
        if(file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
          $photoName = $_FILES["photo"]["name"];
          $uploadFolder = $this->pathPhp."assets/images/given-checks/".$photoName;
          $photo=$_FILES["photo"]["tmp_name"];

          if ($_FILES["photo"]["size"] > 1048576) {
            $permission = "false";
            $response = "Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }else {
            $permission = "true";
          }

          if(move_uploaded_file($photo,$uploadFolder) && $permission == "true"){
            $permission == "true";
            $response = true;
          }else{
            $response = "Fotoğraf yüklenemediği için hata alındı. Fotoğraf boyutu 1 MB'den daha düşük olmalıdır!";
          }
        }else {
          $photoName = null;
        }
      }else {
        $photoName = null;
      }
      /* photo file control, upload */

      $model = new Model();

      /*inserting given check*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_given_checks SET
        given_check_supplier_id=:given_check_supplier_id,
        given_check_category_id=:given_check_category_id,
        given_check_maturity_date=:given_check_maturity_date,
        given_check_type=:given_check_type,
        given_check_file_number=:given_check_file_number,
        given_check_cash_id=:given_check_cash_id,
        given_check_bank_id=:given_check_bank_id,
        given_check_state=:given_check_state,
        given_check_amount=:given_check_amount,
        given_check_description=:given_check_description,
        given_check_photo=:given_check_photo
        WHERE given_check_id=:given_check_id
        "
      );
      $response = $stmt->execute([
        "given_check_supplier_id"=>$data["txtGivenCheckSupplierId"],
        "given_check_category_id"=>$data["txtGivenCheckCategoryId"],
        "given_check_maturity_date"=>$data["txtGivenCheckMaturityDate"],
        "given_check_type"=>$data["txtGivenCheckType"],
        "given_check_file_number"=>$data["txtGivenCheckFileNumber"],
        "given_check_cash_id"=>$data["txtGivenCheckCashId"],
        "given_check_bank_id"=>$data["txtGivenCheckBankId"],
        "given_check_state"=>$data["txtGivenCheckState"],
        "given_check_amount"=>$data["txtGivenCheckAmount"],
        "given_check_description"=>$data["txtGivenCheckDescription"],
        "given_check_photo"=>$photoName,
        "given_check_id"=>$givenCheckId
      ]);
      /*inserting given check*/
      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*givenCheck informations*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_given_checks.*,tbl_suppliers.supplier_name,tbl_categories.category_name,tbl_cashes.cash_name,tbl_banks.bank_name
        FROM tbl_given_checks
        INNER JOIN tbl_suppliers ON tbl_suppliers.supplier_id=tbl_given_checks.given_check_supplier_id
        INNER JOIN tbl_categories ON tbl_categories.category_id=tbl_given_checks.given_check_category_id
        INNER JOIN tbl_cashes ON tbl_cashes.cash_id=tbl_given_checks.given_check_cash_id
        INNER JOIN tbl_banks ON tbl_banks.bank_id=tbl_given_checks.given_check_bank_id
        WHERE given_check_id=:given_check_id"
      );
      $stmt->execute(["given_check_id"=>$givenCheckId]);
      $givenCheckInformations = $stmt->fetch();
      /*givenCheck informations*/

      $this->view->givenCheckInformations = $givenCheckInformations;
      $this->view->render('apps/accounting/given-check/update-given-check');
    }

  }
  /* UPDATE GIVEN CHECK */


  /* DELETE GIVEN CHECK */
  public function deleteGivenCheck($givenCheckId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting given check*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_given_checks WHERE given_check_id=:given_check_id");
      $response = $stmt->execute(["given_check_id"=>$givenCheckId]);
      /*deleting given check*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE GIVEN CHECK */




}
