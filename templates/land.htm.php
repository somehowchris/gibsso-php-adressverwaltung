<form name="land"
  action="<?php echo getValue('phpmodule')?>"
  method="post">
  <div class="form-group row">
    <label for="search_input" class="col-sm-2 col-form-label">Land(*)</label>
    <div class="col-sm-10">
      <input placeholder="Search"
        class="form-control <?php echo getCssClass('invalid_input')?>"
        type="text" id="search_input" name="search_input"
        value="<?= getValue('selected') ? getValue('selected')['land'] : getParameter('search_input')?>">
      <!--
          TODO invalid input
        -->
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <input class="btn btn-outline-secondary" type="submit" name="search" value="Suchen">
    </div>
    <div class="col-3">
      <input class="btn btn-outline-secondary" type="submit" name="new" value="Neu">
    </div>
    <div class="col-3">
      <input class="btn btn-outline-secondary" type="submit" name="save" value="Speichern">
    </div>
    <div class="col-3">
      <input class="btn btn-outline-secondary" type="submit" name="delete" value="Löschen">
    </div>
  </div>
</form>

<script language="javascript">
  function selectLand(lid) {
    const currentLocation =
      "<?php echo getValue('phpmodule')?>";
    var urlParams = new URLSearchParams(window.location.search);
    window.location.href = !urlParams.has('slid') ? `${currentLocation}&slid=${lid}` :
      currentLocation.replace(`slid=${urlParams.get('slid')}`, `slid=${lid}`);
  }
</script>
<table id="ortTable"
  class="table table-bordered table-hover <?= count(getValue('data')) > 0 ? '' : 'hidden'?>"
  style="margin-top: 20px;">
  <thead class="table-secondary">
    <td scope="col">
      <b>Land</b>
    </td>
  </thead>
  <tbody>
    <?php
      if (count(getValue('data')) > 0) {
          foreach (getValue('data') as $land) {
              echo "<tr onClick='selectLand(".$land['lid'].")' ".(getValue('selected') === $land ? 'class="table-active"' : '').">
                  <td>
                  "
                  .($land['land'])."
                  </td>
                </tr>";
          }
      }
    ?>
  </tbody>
</table>

<div
  class="<?= count(getValue('data')) > 0 ? 'hidden' : ''?>">
  <p>
    No items found
  </p>
</div>
