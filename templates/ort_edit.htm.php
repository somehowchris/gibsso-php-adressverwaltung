<form name="land"
  action="<?= getValue('phpmodule')?>"
  method="post">
  <div class="form-group row">
    <label for="plz" class="col-sm-2 col-form-label">Plz</label>
    <div class="col-sm-10">
      <input placeholder="Plz"
        class="form-control <?= getCssClass('invalid_input')?>"
        type="number" id="plz" name="plz" min="1000"
        value="<?= getParameter('plz') != null ? getParameter('plz') : (getValue('selected') !== null ? getValue('selected')['plz'] : '')?>">
      <div
        class="<?= getValue('errors')['plz'] != null ? 'is-invalid' : 'hidden'?>">
        Please check your input</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="ort" class="col-sm-2 col-form-label">Ort(*)</label>
    <div class="col-sm-10">
      <input placeholder="Ort"
        class="form-control <?= getCssClass('invalid_input')?>"
        minlength="2" type="text" id="ort" name="ort"
        value="<?= getParameter('ort') != null ? getParameter('ort') : (getValue('selected') !== null ? getValue('selected')['ort'] : '')?>">
      <div
        class="<?= getValue('errors')['name'] != null ? 'is-invalid' : 'hidden'?>">
        Please check your input</div>
    </div>
  </div>
  <div class="row">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="save" value="Speichern">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="delete" value="Löschen" <?= getValue('selected') !== null ? '' : 'disabled' ?>>
    <a class="btn btn-outline-secondary mr-md-3"
      href="<?= $_REQUEST['SCRIPT_NAME'].'?id=ort'?>">Abbrechen</a>
  </div>
</form>
