<?php
if ($_SESSION["login"] == false) {
  header("Location: ".$this->view->pathHtml."login/auth/");
  die();
}
?>
