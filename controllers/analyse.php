<?php

/**
*
*/
class Analyse extends Controller
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

  /* COMMON ANALYSES */
  public function commonAnalyse()
  {
    if (isset($_POST["post"])) {
      $data = json_decode($_POST["post"],true);

      $model = new Model();
      $permission = true;

      /* check for permission */
      $permission = $this->checkPermission("txtCanSeeAnalyses");
      /* check for permission */

      if ($permission == true) {
        /* cost secure amount */
        $stmt = $model->dbh->prepare("SELECT software_setting_cost_secure_amount FROM tbl_software_settings WHERE software_setting_id=(SELECT MAX(software_setting_id) FROM tbl_software_settings)");
        $stmt->execute();
        $softwareInformations = $stmt->fetch();
        /* cost secure amount */

        /* sale  analyses*/
        $totalSaleAmount = 0;
        $totalSaleCostAmount = 0;
        $totalPaymentAmount = 0;
        $totalProfit = 0;


        $stmt = $model->dbh->prepare(
          "SELECT SUM(tbl_sales.sale_sub_total) AS total_sale_sub_total,SUM(tbl_sales.sale_discount_amount) AS total_discount_total,SUM(tbl_sales.sale_total) AS total_sale_total,
          tbl_employees.employee_name
          FROM tbl_sales
          LEFT JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
          WHERE tbl_sales.sale_query_date BETWEEN :beginning_date AND :ending_date
          GROUP BY tbl_employees.employee_name
          "
        );
        $stmt->execute([
          "beginning_date"=>$data["txtBeginningDate"],
          "ending_date"=>$data["txtEndingDate"]
        ]);
        $saleAnalyses = $stmt->fetchAll();
        for ($i=0; $i <count($saleAnalyses); $i++) {
          $totalSaleAmount += $saleAnalyses[$i]["total_sale_total"];
          $saleAnalyses[$i]["total_sale_total"] = number_format($saleAnalyses[$i]["total_sale_total"], 2, ',', '.');
          $saleAnalyses[$i]["total_discount_total"] = number_format($saleAnalyses[$i]["total_discount_total"], 2, ',', '.');
          $saleAnalyses[$i]["total_sale_sub_total"] = number_format($saleAnalyses[$i]["total_sale_sub_total"], 2, ',', '.');
        }
        /* sale  analyses*/

        /* sale cost analyses */
        $saleCostAnalyses = array();
        for ($i=0; $i < count($saleAnalyses); $i++) {
          /* get employee id */
          $stmt = $model->dbh->prepare("SELECT employee_id FROM tbl_employees WHERE employee_name=:employee_name");
          $stmt->execute([
            "employee_name"=>$saleAnalyses[$i]["employee_name"]
          ]);
          $employeeInformations = $stmt->fetch();
          /* get employee id */

          $stmt = $model->dbh->prepare(
            "SELECT tbl_sale_informations.sale_information_product_purchase_prices,tbl_sale_informations.sale_information_product_pieces,tbl_employees.employee_name
            FROM tbl_sales
            INNER JOIN tbl_sale_informations ON tbl_sale_informations.sale_information_sale_id=tbl_sales.sale_id
            LEFT JOIN tbl_employees ON tbl_employees.employee_id=tbl_sales.sale_query_user_id
            WHERE tbl_sales.sale_query_user_id=:employee_id AND tbl_sales.sale_query_date BETWEEN :beginning_date AND :ending_date
            "
          );
          $stmt->execute([
            "beginning_date"=>$data["txtBeginningDate"],
            "ending_date"=>$data["txtEndingDate"],
            "employee_id"=>$employeeInformations["employee_id"]
          ]);
          $saleCostAnalysesInformations = $stmt->fetchAll();
          $usersTotalCostAmount = 0;
          for ($a=0; $a < count($saleCostAnalysesInformations); $a++) {
            $saleCostAnalysesInformations[$a]["sale_information_product_purchase_prices"] = json_decode($saleCostAnalysesInformations[$a]["sale_information_product_purchase_prices"],true);
            $saleCostAnalysesInformations[$a]["sale_information_product_pieces"] = json_decode($saleCostAnalysesInformations[$a]["sale_information_product_pieces"],true);
            for ($b=0; $b < count($saleCostAnalysesInformations[$a]["sale_information_product_pieces"]); $b++) {
              $usersTotalCostAmount += $saleCostAnalysesInformations[$a]["sale_information_product_pieces"][$b] * $saleCostAnalysesInformations[$a]["sale_information_product_purchase_prices"][$b];
            }
          }
          $totalSaleCostAmount += $usersTotalCostAmount;

          $saleCostAnalyses[] = array(
            "users_total_cost_amount"=>number_format($usersTotalCostAmount, 2, ',', '.'),
            "employee_name"=>$saleAnalyses[$i]["employee_name"]
          );
        }
        /* sale cost analyses */



        /* payment analyses */
        $stmt = $model->dbh->prepare(
          "SELECT SUM(tbl_payments.payment_amount) AS total_payment_amount,tbl_categories.category_name
          FROM tbl_payments
          LEFT JOIN tbl_categories ON tbl_categories.category_id=tbl_payments.payment_category_id
          WHERE tbl_payments.payment_date BETWEEN :beginning_date AND :ending_date
          GROUP BY tbl_categories.category_name
          "
        );
        $stmt->execute([
          "beginning_date"=>$data["txtBeginningDate"],
          "ending_date"=>$data["txtEndingDate"]
        ]);
        $paymentAnalyses = $stmt->fetchAll();
        for ($i=0; $i < count($paymentAnalyses) ; $i++) {
          $paymentAnalyses[$i]["total_payment_amount"] += (($paymentAnalyses[$i]["total_payment_amount"] * $softwareInformations["software_setting_cost_secure_amount"]) / 100);
          $paymentAnalyses[$i]["total_payment_amount"] = number_format($paymentAnalyses[$i]["total_payment_amount"], 2, ',', '.');
          $totalPaymentAmount += $paymentAnalyses[$i]["total_payment_amount"];
        }
        /* payment analyses */


        /* total profit */
        $totalProfit = $totalSaleAmount - ($totalSaleCostAmount + $totalPaymentAmount);
        /* total profit */

        $response = true;

      }else {
        $response = "Analizleri incelemek için yetkiniz bulunmamaktadır!";
      }

      echo json_encode(array(
        "totalProfit"=>@number_format($totalProfit, 2, ',', '.'),
        "paymentAnalyses"=>@$paymentAnalyses,
        "saleAnalyses"=>@$saleAnalyses,
        "totalSaleAmount"=>@number_format($totalSaleAmount, 2, ',', '.'),
        "totalPaymentAmount"=>@number_format($totalPaymentAmount, 2, ',', '.'),
        "totalSaleCostAmount"=>@number_format($totalSaleCostAmount, 2, ',', '.'),
        "saleCostAnalyses"=>@$saleCostAnalyses,
        "response"=>$response
      ));

    }else {

      $model = new Model();

      /* cost secure amount */
      $stmt = $model->dbh->prepare("SELECT software_setting_cost_secure_amount FROM tbl_software_settings WHERE software_setting_id=(SELECT MAX(software_setting_id) FROM tbl_software_settings)");
      $stmt->execute();
      $softwareInformations = $stmt->fetch();
      /* cost secure amount */

      $model = null;

      $this->view->costSecureAmount = $softwareInformations["software_setting_cost_secure_amount"];
      $this->view->render("apps/analyse/common-analyse");
    }
  }
  /* COMMON ANALYSES */


}
