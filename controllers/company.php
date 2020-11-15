<?php

/**
*
*/
class Company extends Controller
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


  /* UPDATE COMPANY */
  public function updateCompany()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);
      $permission = "true";

      /* photo file control, upload */
      if (isset($_FILES["photo"])) {
        if(file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
          $photoName = $_FILES["photo"]["name"];
          $uploadFolder = $this->pathPhp."app-assets/images/users/".$photoName;
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
          $photoName = "profile.png";
        }
      }else {
        $photoName = "profile.png";
      }
      /* photo file control, upload */


      if ($permission == "true") {
        $model = new Model();

        /*inserting company*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_company SET
          company_name=:company_name,
          company_address=:company_address,
          company_phone_number=:company_phone_number,
          company_email=:company_email,
          company_tax_number=:company_tax_number,
          company_tax_department=:company_tax_department,
          company_website=:company_website,
          company_logo=:company_logo
          WHERE company_id=:company_id
          "
        );
        $response = $stmt->execute([
          "company_name"=>$data["txtCompanyName"],
          "company_address"=>$data["txtCompanyAddress"],
          "company_phone_number"=>$data["txtCompanyPhoneNumber"],
          "company_email"=>$data["txtCompanyEmail"],
          "company_tax_number"=>$data["txtCompanyTaxNumber"],
          "company_tax_department"=>$data["txtCompanyTaxDepartment"],
          "company_website"=>$data["txtCompanyWebsite"],
          "company_logo"=>$photoName,
          "company_id"=>$data["txtCompanyId"]
        ]);
        /*inserting company*/

        $model = null;
      }





      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*company informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_company WHERE company_id=(SELECT MAX(company_id) FROM tbl_company)");
      $stmt->execute();
      $companyInformations = $stmt->fetch();
      /*company informations*/

      $model = null;

      $this->view->companyInformations = $companyInformations;
      $this->view->render('informations/company/update-company');
    }

  }
  /* UPDATE COMPANY */





}
