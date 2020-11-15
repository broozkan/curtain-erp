<!-- Modal -->
<div class="modal fade" id="modalSaleCollections" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Satışa Ait Yapılan Tahsilatlar Listesi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <form class="form-inline d-none frmCustomTableSearch" model="sale" action="" method="post">
            <div class="form-group">
              <label for="txtSearchSaleId">Satış Idsi : </label>
              <input type="text" class="form-control" name="txtSearchSaleId" id="txtSearchSaleId" value="">
            </div>
          </form>
          <table class="table" id="sale-collection-list" function="sale-collection-list" model="sale-collection" is-override="true" page-number="1" item-per-page="5" override-function="overrideSaleCollectionList" >
            <thead>
              <tr>
                <th>Tahsilat Ödeme Türü</th>
                <th>Tahsilat Tutarı</th>
                <th>Tahsilat Tarihi</th>
                <th>Tahsilatı Yapan Kişi</th>
                <th>İşlem</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <div class="card-footer ">
            <div class="row">
              <div class="col-lg-12">
                <div class="custom-pagination">
                  <?php
                  // for ($i=1; $i < ($this->totalPageNumber + 1); $i++) {
                  //   echo '<a href="#" value="'.$i.'">'.$i.'</a>';
                  // }
                  ?>
                </div>
                <div class="itemPerPage display-inline-block float-right">
                  Sayfa başı
                  <select class="form-control form-control-sm txtCustomItemPerPage" data-value="5">
                    <option value="5" selected>5</option>
                    <option value="7">7</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                  </select>
                  satır göster
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
