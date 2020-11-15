<?php

/**
*
*/
class Supplier extends Controller
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

  /* SUPPLIER LIST */
  public function supplierList()
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
      if ($data["filters"]["txtSupplierName"] != "") {
        $sql .= "AND supplier_name LIKE :supplier_name";
        $params["supplier_name"] = "%".$data["filters"]["txtSupplierName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting suppliers*/
      $stmt = $model->dbh->prepare(
        "SELECT supplier_id,supplier_name,supplier_address,supplier_email,supplier_phone_number
        FROM tbl_suppliers
        WHERE supplier_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting suppliers*/

      /* total supplier number */
      $stmt = $model->dbh->prepare("SELECT COUNT(supplier_id) AS total_supplier_number FROM tbl_suppliers WHERE supplier_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalSupplierNumber = $stmt->fetch()["total_supplier_number"];
      /* total supplier number */

      /* total page number */
      $totalPageNumber = $totalSupplierNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$suppliers,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));

    }else {
      $this->view->render('units/supplier/supplier-list');
    }

  }
  /* SUPPLIER LIST */

  /* NEW SUPPLIER */
  public function newSupplier()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting supplier*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_suppliers SET
        supplier_name=:supplier_name,
        supplier_address=:supplier_address,
        supplier_phone_number=:supplier_phone_number,
        supplier_email=:supplier_email,
        supplier_tax_number=:supplier_tax_number,
        supplier_tax_department=:supplier_tax_department
        "
      );
      $response = $stmt->execute([
        "supplier_name"=>$data["txtSupplierName"],
        "supplier_address"=>$data["txtSupplierAddress"],
        "supplier_phone_number"=>$data["txtSupplierPhoneNumber"],
        "supplier_email"=>$data["txtSupplierEmail"],
        "supplier_tax_number"=>$data["txtSupplierTaxNumber"],
        "supplier_tax_department"=>$data["txtSupplierTaxDepartment"]
      ]);
      /*inserting supplier*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/supplier/new-supplier');
    }

  }
  /* NEW SUPPLIER */

  /* UPDATE SUPPLIER */
  public function updateSupplier($supplierId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



        $model = new Model();

        /*updating supplier*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_suppliers SET
          supplier_name=:supplier_name,
          supplier_address=:supplier_address,
          supplier_phone_number=:supplier_phone_number,
          supplier_email=:supplier_email,
          supplier_tax_number=:supplier_tax_number,
          supplier_tax_department=:supplier_tax_department
          WHERE supplier_id=:supplier_id
          "
        );
        $response = $stmt->execute([
          "supplier_name"=>$data["txtSupplierName"],
          "supplier_address"=>$data["txtSupplierAddress"],
          "supplier_phone_number"=>$data["txtSupplierPhoneNumber"],
          "supplier_email"=>$data["txtSupplierEmail"],
          "supplier_tax_number"=>$data["txtSupplierTaxNumber"],
          "supplier_tax_department"=>$data["txtSupplierTaxDepartment"],
          "supplier_id"=>$data["txtSupplierId"]
        ]);
        /*updating supplier*/

        $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*supplier informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_suppliers WHERE supplier_id=:supplier_id");
      $stmt->execute(["supplier_id"=>$supplierId]);
      $supplierInformations = $stmt->fetch();
      /*supplier informations*/

      $model = null;

      $this->view->supplierInformations = $supplierInformations;
      $this->view->render('units/supplier/update-supplier');
    }

  }
  /* UPDATE SUPPLIER */


  /* DELETE SUPPLIER */
  public function deleteSupplier($supplierId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting supplier*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_suppliers WHERE supplier_id=:supplier_id");
      $response = $stmt->execute(["supplier_id"=>$supplierId]);
      /*deleting supplier*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE SUPPLIER */


  /* SUPPLIER PROFILE */
  public function supplierProfile($supplierId)
  {
    $model = new Model();

    /*supplier informations*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_suppliers WHERE supplier_id=:supplier_id");
    $stmt->execute(["supplier_id"=>$supplierId]);
    $supplierInformations = $stmt->fetch();
    /*supplier informations*/

    $model = null;


    $this->view->supplierInformations = $supplierInformations;
    $this->view->render("units/supplier/supplier-profile");
  }
  /* SUPPLIER PROFILE */

  /* SUPPLIER SELECT SEARCH */
  public function supplierSelectSearch()
  {
    $model = new Model();

    /*supplier informations*/
    $stmt = $model->dbh->prepare("SELECT supplier_id,supplier_name FROM tbl_suppliers");
    $stmt->execute();
    $suppliers = $stmt->fetchall();
    /*supplier informations*/

    $model = null;


    echo json_encode(array(
      "data"=>$suppliers
    ));

  }
  /* SUPPLIER SELECT SEARCH */


}
