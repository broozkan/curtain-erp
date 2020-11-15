<?php

/**
*
*/
class Dashboard extends Controller
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

  /* DASHBOARD PAGE */
  public function main()
  {
    $this->view->render('apps/analyse/common-analyse');
  }
  /* DASHBOARD PAGE */


}
