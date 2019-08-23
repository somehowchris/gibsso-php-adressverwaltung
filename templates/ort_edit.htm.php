<form name="land"
  action="<?php echo getValue('phpmodule')?>"
  method="post">
  <div class="form-group row">
    <label for="plz" class="col-sm-2 col-form-label">Plz</label>
    <div class="col-sm-10">
      <input placeholder="Plz"
        class="form-control <?php echo getCssClass('invalid_input')?>"
        type="number" id="plz" name="plz"
        value="<?php echo getParameter('plz')?>">
      <!--
          TODO invalid input
        -->
    </div>
  </div>
  <div class="form-group row">
    <label for="ort" class="col-sm-2 col-form-label">Ort(*)</label>
    <div class="col-sm-10">
      <input placeholder="Ort"
        class="form-control <?php echo getCssClass('invalid_input')?>"
        type="text" id="ort" name="ort"
        value="<?php echo getParameter('ort')?>">
      <!--
          TODO invalid input
        -->
    </div>
  </div>
  <div class="row">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="save" value="Speichern">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="delete" value="Löschen">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="new" value="Abbrechen">
  </div>
</form>