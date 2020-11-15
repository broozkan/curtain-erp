<form id="frmVerifySaleFactory" method="post">

  <!-- form group -->
  <div class="form-group">
    <label for="txtEmployeeId">Onay Veren Çalışan (*)</label>
    <select class="form-control" name="txtEmployeeId">
      <option value="" selected disabled>-Çalışan Seçiniz-</option>
      <?php
        for ($i=0; $i < count($this->employees); $i++) {
          echo '<option value="'.$this->employees[$i]["employee_id"].'" >'.$this->employees[$i]["employee_name"].'</option>';
        }
      ?>
    </select>
    <input type="hidden" class="txtSaleId" name="txtSaleId">
  </div>
  <!-- form group -->



  <button type="submit" class="btn btn-primary btnLoadingNewPayment">Kaydet</button>
</form>
