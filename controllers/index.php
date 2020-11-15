<?php

/**
*
*/
class Index extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $page = 1;

  function __construct()
  {
    parent::__construct();

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      header("Location: http://perakende.doganbirlik.xyz/login/auth/");
    }
  }




}
