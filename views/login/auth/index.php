<!DOCTYPE html>
<html lang="en">


<?php require $this->pathPhp."arayuz/head.php"; ?>


<body>

  <div class="bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="d-flex align-items-center min-vh-100">
            <div class="w-100 d-block bg-white shadow-lg rounded my-5">
              <div class="row">
                <div class="col-lg-7">
                  <div class="p-5">
                    <div class="text-center">
                      <a href="#" class="d-block mb-5">
                        <img src="<?php echo $this->pathHtml; ?>assets/images/logo-dark.png" alt="app-logo" height="18" />
                      </a>
                    </div>
                    <h1 class="h5 mb-1">Hoşgeldiniz!</h1>
                    <p class="text-muted mb-4">Bilgilerinizi girerek sisteme giriş yapabilirsiniz.</p>
                    <form class="user" id="frmLogin">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="txtUsername" id="txtUsername" placeholder="Kullanıcı Adı">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="txtPassword" id="txtPassword" placeholder="Parola">
                      </div>
                      <button  type="submit" class="btn btn-success btn-block btnLoadingLogin"> Giriş Yap </button>
                    </form>

                    <div class="row mt-4">
                      <div class="col-12 text-center">
                        <p class="text-muted mb-2"><a href="#" class="text-muted font-weight-medium ml-1">Parolanızı mı unuttunuz?</a></p>
                      </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                  </div> <!-- end .padding-5 -->
                </div> <!-- end col -->
              </div> <!-- end row -->
            </div> <!-- end .w-100 -->
          </div> <!-- end .d-flex -->
        </div> <!-- end col-->
      </div> <!-- end row -->
    </div>
    <!-- end container -->
  </div>
  <!-- end page -->

  <!-- jQuery  -->
  <?php require $this->pathPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->pathHtml; ?>views/login/auth/auth.js"></script>
</body>


</html>
