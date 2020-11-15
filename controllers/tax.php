<?php

/**
*
*/
class Tax extends Controller
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

  /* TAX LIST */
  public function taxList()
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
      if ($data["filters"]["txtTaxName"] != "") {
        $sql .= "AND tax_name LIKE :tax_name";
        $params["tax_name"] = "%".$data["filters"]["txtTaxName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting taxes*/
      $stmt = $model->dbh->prepare(
        "SELECT tax_id,tax_name,tax_percentage
        FROM tbl_taxes
        WHERE tax_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $taxes = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting taxes*/

      /* total tax number */
      $stmt = $model->dbh->prepare("SELECT COUNT(tax_id) AS total_tax_number FROM tbl_taxes WHERE tax_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalTaxNumber = $stmt->fetch()["total_tax_number"];
      /* total tax number */

      /* total page number */
      $totalPageNumber = $totalTaxNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$taxes,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>false
      ));

    }else {
      $this->view->render('units/tax/tax-list');
    }

  }
  /* TAX LIST */

  /* NEW TAX */
  public function newTax()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



      $model = new Model();

      /*inserting tax*/
      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_taxes SET
        tax_name=:tax_name,
        tax_percentage=:tax_percentage
        "
      );
      $response = $stmt->execute([
        "tax_name"=>$data["txtTaxName"],
        "tax_percentage"=>$data["txtTaxPercentage"]
      ]);
      /*inserting tax*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/tax/new-tax');
    }

  }
  /* NEW TAX */

  /* UPDATE TAX */
  public function updateTax($taxId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);



        $model = new Model();

        /*updating tax*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_taxes SET
          tax_name=:tax_name,
          tax_percentage=:tax_percentage
          WHERE tax_id=:tax_id
          "
        );
        $response = $stmt->execute([
          "tax_name"=>$data["txtTaxName"],
          "tax_percentage"=>$data["txtTaxPercentage"],
          "tax_id"=>$data["txtTaxId"]
        ]);
        /*updating tax*/

        $model = null;



      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*tax informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_taxes WHERE tax_id=:tax_id");
      $stmt->execute(["tax_id"=>$taxId]);
      $taxInformations = $stmt->fetch();
      /*tax informations*/

      $model = null;

      $this->view->taxInformations = $taxInformations;
      $this->view->render('units/tax/update-tax');
    }

  }
  /* UPDATE TAX */


  /* DELETE TAX */
  public function deleteTax($taxId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting tax*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_taxes WHERE tax_id=:tax_id");
      $response = $stmt->execute(["tax_id"=>$taxId]);
      /*deleting tax*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE TAX */


  /* GET TAX INFORMATIONS */
  public function getTaxInformations()
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      $taxInformations = array();
      for ($i=0; $i < count($data["tax_ids"]); $i++) {

        /*deleting tax*/
        $stmt = $model->dbh->prepare("SELECT * FROM tbl_taxes WHERE tax_id=:tax_id");
        $stmt->execute(["tax_id"=>$data["tax_ids"][$i]]);
        $tax = $stmt->fetch();
        /*deleting tax*/


        $taxInformations[$tax["tax_percentage"]][] = $tax["tax_percentage"];

      }

      print_r($taxInformations);
      $model = null;
    }
  }
  /* GET TAX INFORMATIONS */


}
