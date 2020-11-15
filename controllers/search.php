<?php

/**
*
*/
class Search extends Controller
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

  /* INPUT SEARCH */
  public function inputSearch()
  {
    if (isset($_POST["post"])) {
      $data = json_decode($_POST["post"],true);

      $model = new Model();

      $sql = "SELECT ".$data["model"]."_id,".$data["model"]."_".$data["property"]." FROM ".$data["table"]." WHERE ".$data["model"]."_".$data["property"]." LIKE :arg";
      $stmt = $model->dbh->prepare($sql);
      $stmt->execute(["arg"=>"%".$data["arg"]."%"]);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode(array(
        "results"=>$results
      ));
    }

  }
  /* INPUT SEARCH */


}
