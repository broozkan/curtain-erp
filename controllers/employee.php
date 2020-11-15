<?php

/**
*
*/
class Employee extends Controller
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

  /* EMPLOYEE LIST */
  public function employeeList()
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
      if ($data["filters"]["txtEmployeeName"] != "") {
        $sql .= "AND employee_name LIKE :employee_name";
        $params["employee_name"] = "%".$data["filters"]["txtEmployeeName"]."%";
      }
      /* adding filter */


      $model = new Model();

      /*selecting employees*/
      $stmt = $model->dbh->prepare(
        "SELECT employee_id,employee_name,employee_phone_number,employee_email,employee_username
        FROM tbl_employees
        WHERE employee_id IS NOT NULL
        $sql
        LIMIT $limit OFFSET $offset"
      );
      $stmt->execute($params);
      $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /*selecting employees*/

      /* total employee number */
      $stmt = $model->dbh->prepare("SELECT COUNT(employee_id) AS total_employee_number FROM tbl_employees WHERE employee_id IS NOT NULL $sql");
      $stmt->execute($params);
      $totalEmployeeNumber = $stmt->fetch()["total_employee_number"];
      /* total employee number */

      /* total page number */
      $totalPageNumber = $totalEmployeeNumber / $limit;
      /* total page number */

      $model = null;

      echo json_encode(array(
        "data"=>$employees,
        "totalPageNumber"=>$totalPageNumber,
        "doesHaveProfile"=>true
      ));

    }else {
      $this->view->render('units/employee/employee-list');
    }

  }
  /* EMPLOYEE LIST */

  /* NEW EMPLOYEE */
  public function newEmployee()
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* password control */
      if ($data["txtEmployeePassword"] != "" && $data["txtEmployeePasswordRepeat"] != "" && $data["txtEmployeeUsername"] != "") {
        $permission = $this->passwordControl($data["txtEmployeePassword"],$data["txtEmployeePasswordRepeat"]);

        if ($permission != "true") {
          $response = $permission;
        }

      }else {
        $response = "Kullanıcı adı, parola ve parola tekrar alanlarını boş bırakmayınız!";
        $permission = "false";
      }
      /* password control */


      /* username control */
      if ($permission == "true") {
        $permission = $this->usernameControl($data["txtEmployeeUsername"]);

        if ($permission != "true") {
          $response = $permission;
        }
      }
      /* username control */


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

        /*inserting employee*/
        $stmt = $model->dbh->prepare(
          "INSERT INTO tbl_employees SET
          employee_username=:employee_username,
          employee_password=:employee_password,
          employee_name=:employee_name,
          employee_phone_number=:employee_phone_number,
          employee_email=:employee_email,
          employee_photo=:employee_photo,
          employee_permissions=:employee_permissions,
          employee_redirect_url=:employee_redirect_url
          "
        );
        $response = $stmt->execute([
          "employee_username"=>$data["txtEmployeeUsername"],
          "employee_password"=>md5($data["txtEmployeePassword"]),
          "employee_name"=>$data["txtEmployeeName"],
          "employee_phone_number"=>$data["txtEmployeePhoneNumber"],
          "employee_email"=>$data["txtEmployeeEmail"],
          "employee_photo"=>$photoName,
          "employee_permissions"=>json_encode(@$data["txtEmployeePermissions"]),
          "employee_redirect_url"=>$data["txtEmployeeRedirectUrl"]
        ]);
        /*inserting employee*/

        $model = null;

      }


      echo json_encode(array(
        "response"=>$response
      ));

    }else {
      $this->view->render('units/employee/new-employee');
    }

  }
  /* NEW EMPLOYEE */

  /* UPDATE EMPLOYEE */
  public function updateEmployee($employeeId)
  {

    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      /* password control */
      if ($data["txtEmployeePassword"] != "" && $data["txtEmployeePasswordRepeat"] != "" && $data["txtEmployeeUsername"] != "") {
        $permission = $this->passwordControl($data["txtEmployeePassword"],$data["txtEmployeePasswordRepeat"]);

        if ($permission != "true") {
          $response = $permission;
        }

      }else {
        $response = "Kullanıcı adı, parola ve parola tekrar alanlarını boş bırakmayınız!";
        $permission = "false";
      }
      /* password control */


      /* username control */
      if ($permission == "true") {
        $permission = $this->usernameControl($data["txtEmployeeUsername"],true);

        if ($permission != "true") {
          $response = $permission;
        }
      }
      /* username control */


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

        /*updating employee*/
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_employees SET
          employee_username=:employee_username,
          employee_password=:employee_password,
          employee_name=:employee_name,
          employee_phone_number=:employee_phone_number,
          employee_email=:employee_email,
          employee_photo=:employee_photo,
          employee_permissions=:employee_permissions,
          employee_redirect_url=:employee_redirect_url
          WHERE employee_id=:employee_id
          "
        );
        $response = $stmt->execute([
          "employee_username"=>$data["txtEmployeeUsername"],
          "employee_password"=>md5($data["txtEmployeePassword"]),
          "employee_name"=>$data["txtEmployeeName"],
          "employee_phone_number"=>$data["txtEmployeePhoneNumber"],
          "employee_email"=>$data["txtEmployeeEmail"],
          "employee_photo"=>$photoName,
          "employee_permissions"=>json_encode($data["txtEmployeePermissions"]),
          "employee_redirect_url"=>$data["txtEmployeeRedirectUrl"],
          "employee_id"=>$data["txtEmployeeId"]
        ]);
        /*updating employee*/

        $model = null;

      }


      echo json_encode(array(
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /*employee informations*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_employees WHERE employee_id=:employee_id");
      $stmt->execute(["employee_id"=>$employeeId]);
      $employeeInformations = $stmt->fetch();
      $employeeInformations["employee_permissions"] = json_decode($employeeInformations["employee_permissions"],true);
      /*employee informations*/

      $model = null;

      $this->view->employeeInformations = $employeeInformations;
      $this->view->render('units/employee/update-employee');
    }

  }
  /* UPDATE EMPLOYEE */


  /* DELETE EMPLOYEE */
  public function deleteEmployee($employeeId)
  {
    if (isset($_POST["post"])) {

      $data = json_decode($_POST["post"],true);

      $model = new Model();

      /*deleting employee*/
      $stmt = $model->dbh->prepare("DELETE FROM tbl_employees WHERE employee_id=:employee_id");
      $response = $stmt->execute(["employee_id"=>$employeeId]);
      /*deleting employee*/

      $model = null;


      echo json_encode(array(
        "response"=>$response
      ));

    }
  }
  /* DELETE EMPLOYEE */


  /* EMPLOYEE PROFILE */
  public function employeeProfile($employeeId)
  {
    $model = new Model();

    /*employee informations*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_employees WHERE employee_id=:employee_id");
    $stmt->execute(["employee_id"=>$employeeId]);
    $employeeInformations = $stmt->fetch();
    $employeeInformations["employee_permissions"] = json_decode($employeeInformations["employee_permissions"],true);
    /*employee informations*/

    $model = null;


    $this->view->employeeInformations = $employeeInformations;
    $this->view->render("units/employee/employee-profile");
  }
  /* EMPLOYEE PROFILE */


}
