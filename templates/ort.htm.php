<div class="row">
  <div class="col-2">
    <a class="btn btn-outline-secondary" name="new"
      href="<?= $_REQUEST['SCRIPT_NAME']."?id=create_ort"?>">Neu</a>
  </div>
</div>
<div class="mb-md-3">
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
          echo "<tr onClick='selectOrt(".$ort['oid'].")'>
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


<script language="javascript">
  function selectOrt(oid) {
    const currentLocation =
      "<?= $_REQUEST['SCRIPT_NAME'].'?id=edit_ort'?>";
    var urlParams = new URLSearchParams(window.location.search);
    window.location.href = !urlParams.has('soid') ? `${currentLocation}&soid=${oid}` :
      currentLocation.replace(`soid=${urlParams.get('soid')}`, `soid=${oid}`);
  }
</script>