<form name="land"
  action="<?= getValue('phpmodule')?>"
  method="post">
  <div class="form-group row">
    <label for="search_input" class="col-sm-2 col-form-label">Land(*)</label>
    <div class="col-sm-10">
      <input placeholder="Search"
        class="form-control <?= getCssClass('invalid_input')?>"
        type="text" id="search_input" name="search_input"
        value="<?= getValue('selected') ? getValue('selected')['land'] : getParameter('search_input')?>">
      <div
        class="<?= getValue('errors')['name'] != null ? 'is-invalid' : 'hidden'?>">
        Please check your input</div>
    </div>
  </div>
  <div class="row ml-md-1">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="search" value="Suchen">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="new" value="Neu">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="save" value="Speichern">
    <input class="btn btn-outline-secondary mr-md-3" type="submit" name="delete" value="Löschen" <?= getValue('selected') !== null ? '' : 'disabled' ?>>
  </div>
</form>

<script language="javascript">
  function selectLand(lid) {
    const currentLocation =
      "<?= getValue('phpmodule')?>";
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
