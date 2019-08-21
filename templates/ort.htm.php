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
    <input class="btn btn-outline-secondary" type="submit" name="search" value="Suchen">
    <input class="btn btn-outline-secondary" type="submit" name="new" value="Neu">
    <input class="btn btn-outline-secondary" type="submit" name="save" value="Speichern">
    <input class="btn btn-outline-secondary" type="submit" name="delete" value="Löschen">
  </div>
</form>

<div class="row">
  <div class="col-2">
    <button class="btn btn-outline-secondary">Neu</button>
  </div>
</div>
<table id="ortTable"
  class="table table-bordered table-hover <?= count(getValue('data')) > 0 ? '' : 'hidden'?>">
  <thead class="table-secondary">
    <td scope="col">
      <b>Plz</b>
    </td>
    <td scope="col">
      <b>Ort</b>
    </td>
  </thead>
  <tbody>
    <?php
      foreach (getValue('data') as $ort) {
          echo "<tr>
                <td>
                  ".$ort['plz']."
                </td>
                <td>
                ".$ort['ort']."
                </td>
              </tr>";
      }
    ?>
  </tbody>
</table>

<script language="javascript">
  $(document).ready(function() {
    $('#ortTable').DataTable({
      // Sprache "Deutsch" setzen
      language: {
        url: "datatables/German.json",
      }
    });
  });
</script>
