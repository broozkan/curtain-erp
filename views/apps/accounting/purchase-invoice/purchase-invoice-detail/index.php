<!DOCTYPE html>
<html lang="en">


<?php require $this->pathPhp."arayuz/head.php"; ?>


<body>

  <!-- Begin page -->
  <div id="layout-wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

      <div data-simplebar class="h-100">

        <!-- LOGO -->
        <div class="navbar-brand-box">
          <a href="index.html" class="logo">
            <span>
              <img src="<?php echo $this->pathHtml; ?>assets/images/logo-light.png" alt="" height="15">
            </span>
            <i>
              <img src="<?php echo $this->pathHtml; ?>assets/images/logo-small.png" alt="" height="24">
            </i>
          </a>
        </div>

        <!--- Sidemenu -->
        <?php require $this->pathPhp."arayuz/sidebar.php"; ?>

        <!-- Sidebar -->
      </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      <?php require $this->pathPhp."arayuz/header.php"; ?>


      <div class="page-content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <img src="<?php echo $this->pathHtml; ?>assets/images/logo-dark.png" alt="" height="16">
                    </div>
                    <div class="float-right">
                      <h4 class="m-0 d-print-none">Invoice</h4>
                    </div>
                  </div>


                  <div class="row mt-4">
                    <div class="col-6">
                      <h6 class="font-weight-bold">TO:</h6>

                      <address class="line-h-24">
                        <b>Stella Worgan</b><br>
                        3443 Ridge Road<br>
                        Hutchinson, KS 67501<br>
                        <abbr title="Phone">P:</abbr> 620-802-9649
                      </address>
                    </div><!-- end col -->
                    <div class="col-6">
                      <div class="mt-3 float-right">
                        <p class="mb-2"><strong>Order Date: </strong> Jan 17, 2016</p>
                        <p class="mb-2"><strong>Order Status: </strong> <span class="badge badge-soft-success">Paid</span></p>
                        <p class="m-b-10"><strong>Order ID: </strong> #123456</p>
                      </div>
                    </div><!-- end col -->
                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table mt-4">
                          <thead>
                            <tr><th>#</th>
                              <th>Item</th>
                              <th>Quantity</th>
                              <th>Unit Cost</th>
                              <th class="text-right">Total</th>
                            </tr></thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>
                                  <b>HP 21.5 inch Full HD LED Backlit IPS Panel Monitor (22es)</b>
                                  <br/>
                                  Brand Model VGN-TXN27N/B
                                  11.1" Notebook PC
                                </td>
                                <td>1</td>
                                <td>$1799</td>
                                <td class="text-right">$1799</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>
                                  <b>Lenovo Ideapad L340 Core i5 9th Gen</b> <br/>
                                  Two Year Extended Warranty -
                                  Parts and Labor
                                </td>
                                <td>3</td>
                                <td>$499</td>
                                <td class="text-right">$1497</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>
                                  <b>LG 260 L Frost Free Double Door 4 Star</b> <br/>
                                  Shiny Steel Refrigerator, GL-I292RPZL
                                </td>
                                <td>2</td>
                                <td>$412</td>
                                <td class="text-right">$824</td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="clearfix pt-5">
                          <h6 class="text-muted">Notes:</h6>

                          <small>
                            All accounts are to be paid within 7 days from receipt of
                            invoice. To be paid by cheque or credit card or direct payment
                            online. If account is not paid within 7 days the credits details
                            supplied as confirmation of work undertaken will be charged the
                            agreed quoted fee noted above.
                          </small>
                        </div>

                      </div>
                      <div class="col-6">
                        <div class="float-right">
                          <p><b>Sub-total:</b> $4120.00</p>
                          <p><b>VAT (12.5):</b> $515</p>
                          <h3>$4635.00 USD</h3>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>

                    <div class="hidden-print mt-4 mb-4">
                      <div class="text-right">
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                        <a href="#" class="btn btn-info waves-effect waves-light">Submit</a>
                      </div>
                    </div>
                  </div>
                </div> <!-- end card-->
              </div> <!-- end col -->
            </div>
            <!-- end row -->

          </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php require $this->pathPhp."arayuz/footer.php"; ?>


      </div>
      <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <?php require $this->pathPhp."arayuz/script.php"; ?>

  </body>


  </html>
