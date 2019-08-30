<!--
 * @author Daniel Mosimann
 * @version 2019
 *
 * Haupttemplate.
 *
-->
<!doctype html>
<html>

<head>
  <title>MVC-GIBS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
  <link rel="stylesheet" type="text/css" href="datatables/dataTables.css">
  <script src="jquery/jquery-3.3.1.js"></script>
  <script src="popper/popper.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" charset="utf8" src="datatables/dataTables.js"></script>
</head>

<body>
  <div class="container">
    <div class="card text-left bg-light">
      <div class="row align-items-center">
        <div class="col">
          <h1>MVC GIBS - Kontakte</h1>
        </div>
      </div>
    </div>
    <div class="card text-left">
      <?php menu(getValue('cfg_menu_list'), getValue('cfg_menu'));?>
      <div class="row m-3">
        <div class="col-12" style="overflow: auto">
          <?= getValue('inhalt'); ?>
        </div>
      </div>
    </div>
    <div class="card text-center bg-light">
      <span class="small">&copy; Copyright GIBS Solothurn</span>
    </div>
  </div>
</body>

</html>
