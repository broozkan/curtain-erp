<?php

/**
*
*/
class Accounting extends Controller
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


  /* ACCOUNTING QUERY LIST */
  public function accountingQueryList()
  {
    $this->view->render("apps/accounting/accounting-query-list");
  }
  /* ACCOUNTING QUERY LIST */




}
