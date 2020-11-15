<?php

/**
*
*/
class Unit extends Controller
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

  /* UNIT LIST */
  public function unitList()
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
      if ($data["filters"]["txtUnitName"] != "") {
        $sql .= "AND unit_name LIKE :unit_name";
        $params["unit_name"] = "%".$data["filters"]["txtUnitName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting units*/
      $stmt = $model->dbh->prepare(
        "SELECT unit_id,unit_name
        FROM tbl_units
        WHERE unit_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $units = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting units*/

      /* total unit number */
      $stmt = $model->dbh->prepare("SELECT COUNT(unit_id) AS total_unit_number FROM tbl_units WHERE unit_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalUnitNumber = $stmt->fetch()["total_unit_number"];
      /* total unit number */

      /* total page number */
      $totalPageNumber = $totalUnitNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$units,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/unit/unit-list');
    }

  }
  /* UNIT LIST */

  /* NEW UNIT */
  public function newUnit()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);





      $model = new Model();

      /*inserting unit*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_units SET
        unit_name=:unit_name
        "
      );
      $response = $stmt->execute([
        "unit_name"=>$data["txtUnitName"]
      ]);
      /*inserting unit*/


      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/unit/new-unit');
    }

  }
  /* NEW UNIT */

  /* UPDATE UNIT */
  public function updateUnit($unitId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting unit*/
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_units SET
        unit_name=:unit_name
        WHERE unit_id=:unit_id
        "
      );
      $response = $stmt->execute([
        "unit_name"=>$data["txtUnitName"],
        "unit_id"=>$data["txtUnitId"]
      ]);
      /*inserting unit*/

      $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*unit informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_units WHERE unit_id=:unit_id");
      $stmt->execute(["unit_id"=>$unitId]);
      $unitInformations = $stmt->fetch();
      /*unit informations*/

      $model = null;

      $this->view->unitInformations = $unitInformations;
      $this->view->render('units/unit/update-unit');
    }

  }
  /* UPDATE UNIT */


  /* DELETE UNIT */
  public function deleteUnit($unitId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting unit*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_units WHERE unit_id=:unit_id");
      $response = $stmt->execute(["unit_id"=>$unitId]);
      /*deleting unit*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE UNIT */




}
