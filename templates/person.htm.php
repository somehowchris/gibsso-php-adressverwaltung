<form name="person"
  action="<?= getValue('phpmodule'). (getParameter('pid') != null ? '&pid='.getParameter('pid') : '')?>"
  method="post">
  <div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Name(*)</label>
    <div class="col-sm-9">
      <input placeholder="Name"
        class="form-control <?= getCssClass('invalid_input')?>"
        type="text" id="name" name="name"
        value="<?= getParameter('name') != null ? getParameter('name') : (getValue('selected') !== null ? getValue('selected')['name'] : '')?>">
      <div
        class="<?= getValue('errors')['name'] != null ? 'is-invalid' : 'hidden'?>">
        Please check your input</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="vorname" class="col-sm-3 col-form-label">Vorname</label>
    <div class="col-sm-9">
      <input placeholder="Vorname"
        class="form-control <?= getCssClass('invalid_input')?>"
        type="text" id="vorname" name="vorname"
        value="<?= getParameter('vorname') != null ? getParameter('vorname') :(getValue('selected') !== null ? getValue('selected')['vorname'] : '')?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="strasse" class="col-sm-3 col-form-label">Strasse</label>
    <div class="col-sm-9">

      <input placeholder="Strasse"
        class="form-control <?= getCssClass('invalid_input')?>"
        type="text" id="strasse" name="strasse"
        value="<?= getParameter('strasse') != null ? getParameter('strasse') :(getValue('selected') !== null ? getValue('selected')['strasse'] : '')?>">
      <!--
      // TODO invalid input
      -->
    </div>
  </div>
  <div class="form-group row">
    <label for="vorname" class="col-sm-3 col-form-label">Plz/Ort</label>
    <div class="col-sm-9">
      <select class="custom-select custom-select-md" name="ort">
        <option selected disabled>Please choose a town</option>
        <?php
          if (getValue('data_ort') != null) {
              foreach (getValue('data_ort') as $ort) {
                  echo "<option value='".$ort['oid']."' ".(getParameter('ort') != null ? (getParameter('ort') == $ort['oid'] ? 'selected' : '') : (getValue('selected') ? (getValue('selected')['oid'] == $ort['oid'] ? 'selected' : '') : '')).">".$ort['ort']." ".$ort['plz']."</option>";
              }
          }
        ?>
      </select>
      <!--
          // TODO invalid input
        -->
    </div>
  </div>
  <div class="form-group row">
    <label for="mail" class="col-sm-3 col-form-label">Email(*)</label>
    <div class="col-sm-9">
      <input placeholder="Mail"
        class="form-control <?= getCssClass('invalid_input')?>"
        type="text" id="mail" name="mail"
        value="<?= getParameter('mail') != null ? getParameter('mail') :(getValue('selected') !== null ? getValue('selected')['email'] : '')?>">
      <div
        class="<?= getValue('errors')['mail'] != null ? 'is-invalid' : 'hidden'?>">
        Invalid email</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="tel-priv" class="col-sm-3 col-form-label">Telefon Privat</label>
    <div class="col-sm-9">
      <input placeholder="Telefon privat"
        class="form-control <?= getCssClass('invalid_input')?>"
        type="text" id="tel-priv" name="tel-priv"
        value="<?= getParameter('tel-priv') != null ? getParameter('tel-priv') :(getValue('selected') !== null ? getValue('selected')['tel_priv'] : '')?>">
      <div
        class="<?= getValue('errors')['telPriv'] != null ? 'is-invalid' : 'hidden'?>">
        Invalid phone number</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="tel-comp" class="col-sm-3 col-form-label">Telefon Geschäft</label>
    <div class="col-sm-9">
      <input placeholder="Telefon Geschäft"
        class="form-control <?= getCssClass('invalid_input')?>"
        id="tel-comp" name="tel-comp"
        value="<?= getParameter('tel-comp') != null ? getParameter('tel-comp') :(getValue('selected') !== null ? getValue('selected')['tel_gesch'] : '')?>">
      <div
        class="<?= getValue('errors')['telComp'] != null ? 'is-invalid' : 'hidden'?>">
        Invalid phone number</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="vorname" class="col-sm-3 col-form-label">Land</label>
    <div class="col-sm-9">
      <select class="custom-select custom-select-md" name="land">
        <option selected disabled>Please choose a country</option>
        <?php
          if (getValue('data_land') != null) {
              foreach (getValue('data_land') as $land) {
                  echo "<option value='".$land['lid']."' ".(getParameter('land') != null ? (getParameter('land') === $land['lid'] ? 'selected' : '') : (getValue('selected') ? (getValue('selected')['lid'] == $land['lid'] ? 'selected' : '') : '')).">".$land['land']."</option>";
              }
          }
        ?>
      </select>
    </div>
  </div>
  <div class="row">
    <input class="btn btn-outline-secondary mr-sm-1 mb-1 mb-sm-0 col-12 col-sm-auto align-self-start" type="submit"
      name="search" value="Suchen">
    <input class="btn btn-outline-secondary mr-sm-1 mb-1 mb-sm-0 col-12 col-sm-auto align-self-start" type="submit"
      name="new" value="Neu">
    <input class="btn btn-outline-secondary mr-sm-1 mb-1 mb-sm-0 col-12 col-sm-auto align-self-start" type="submit"
      name="save" value="Speichern">
    <input class="btn btn-outline-secondary mr-sm-1 mb-1 mb-sm-0 col-12 col-sm-auto align-self-start" type="submit"
      name="delete" value="Delete">
    <div class="col-12 col-sm-3 ml-auto" style="padding:0">
      <a class="btn btn-outline-secondary float-right <?= getValue('next') != null ? '' : 'disabled'?>"
        role="button" value=">>" style="may-width: 49.43%" <?= getValue('next') != null ? '' : 'disabled'?>
        href="<?= getValue('next') != null ? getValue('phpmodule').'&pid='.getValue('next')['pid'] : ''?>"
        >>></a>
      <a class="btn mr-1 btn-outline-secondary float-sm-right float-left <?= getValue('previous') != null ? '' : 'disabled'?>"
        role="button" value="<<" style="may-width: 49.43%" <?= getValue('previous') != null ? '' : 'disabled'?>
        href="<?= getValue('previous') != null ? getValue('phpmodule').'&pid='.getValue('previous')['pid'] : ''?>"
        ><<</a> </div> </div> </form>
