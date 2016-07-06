<?php
  include("connection.php");
  include("tables_archived.php");
  include("updatePAS.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Archived Tags</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Bootstrap -->
    <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
  </head>

  <body>
  <?php include("header.php"); ?>

    <div class="container">
      <div class="heading" id="header">
        <h1>Archived Tags</h1>
      </div>
    </div>
    <div class="tableContainer" id="table">
      <table class="display" id="datatables">
        <thead>
          <tr>
            <th>Tag Name</th>
            <th class="hidden"></th>
            <th>Tag Source</th>
            <th>Tag ID</th>
            <th>Tag URL</th>
            <th>Publisher</th>
            <th>Advertiser</th>
            <th>eCPM</th>
            <th>cCPM</th>
            <th>Date Brokered</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($row = mysqli_fetch_array($result)){
          ?>
          <tr>
            <td class="name"><?php echo $row['tagname']?></td>
            <td class="hidden"><?php echo $row['unique_id']; ?></td>
            <td class="type"><?php echo $row['tagtype']?></td>
            <td class="id"><?php echo $row['identifier']?></td>
            <td class="url"><?php echo $row['url']?></td>
            <td class="publisher"><?php echo $row['publisher']?></td>
            <td class="advertiser"><?php echo $row['advertiser']?></td>
            <td class="ecpm"><?php echo $row['ecpm']?></td>
            <td class="ccpm"><?php echo $row['ccpm']?></td>
            <td class="date"><?php echo $row['datebrokered']?></td>
            <td style="cursor:pointer;color:blue" onClick="editModal();">Edit</td>
            <td style="cursor:pointer;color:blue" onClick="activateModal();">Activate</td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true">
      <div class = "modal-dialog">
        <div class = "modal-content">
          <form method="post">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                    &times;
                </button>
                <h4 class = "modal-title" id = "myModalLabel">
                </h4>
              </div>
              <div class = "modal-body">
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Tag Name</span>
                    <input type="text" class="form-control" id="tagnameModal" name="tagnameModal" placeholder="Tag Name" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Tag Source</span>
                    <select class="form-control" id="tagtypeModal" name="tagtypeModal" value="<?php echo addslashes($_POST['tagtypeModal']); ?>">
                      <option value="">Source</option>
                      <?php
                      foreach ($sources as $row) {
                      ?>
                      <option value="'".<?php $row['sources']; ?>."'"><?php echo $row['sources']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Tag ID</span>
                    <input type="text" class="form-control" id="identifierModal" name="identifierModal" placeholder="Tag ID" value="<?php echo addslashes($_POST['identifierModal']); ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Tag URL</span>
                    <input type="text" class="form-control" id="urlModal" name="urlModal" placeholder="Tag URL" value="<?php echo addslashes($_POST['tagtypeModal']); ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Publisher</span>
                    <select class="form-control" id="publisherModal" name="publisherModal" value="<?php echo addslashes($_POST['publisherModal']); ?>">
                      <option value="">Publisher</option>
                      <?php
                      foreach ($partners as $row) {
                      ?>
                      <option value="'".<?php $row['partner']; ?>."'"><?php echo $row['partner']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Advertiser</span>
                    <select class="form-control" id="advertiserModal" name="advertiserModal" value="<?php echo addslashes($_POST['advertiserModal']); ?>">
                      <option value="">Advertiser</option>
                      <?php
                      foreach ($partners as $row) {
                      ?>
                      <option value="'".<?php $row['partner']; ?>."'"><?php echo $row['partner']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">eCPM</span>
                    <input type="text" class="form-control" id="ecpmModal" name="ecpmModal" placeholder="eCPM Rate" value="<?php echo addslashes($_POST['ecpmModal']); ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">cCPM</span>
                    <input type="text" class="form-control" id="ccpmModal" name="ccpmModal" placeholder="cCPM Rate" value="<?php echo addslashes($_POST['ccpmModal']); ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Date</span>
                    <input type="date" class="form-control" id="dateModal" name="datebrokeredModal" placeholder="Date Brokered" value="<?php echo addslashes($_POST['datebrokeredModal']); ?>" />
                  </div>
                </div>
              </div>
              <div class = "modal-footer">
                <input type="hidden" value="" name="uniqueid" id="uniqueid">
                <button type = "button" class = "btn btn-default" data-dismiss = "modal">
                 Close
                </button>
                <input type="submit" class="btn btn-primary" name="edit-tag" value="Edit Tag!" />
              </div>
            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="model-content">
            <form method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  &times;
                </button>
                <h4 class="modal-title" id="activateModalLabel">
                  Activate Tag
                </h4>
              </div>
              <div class="modal-body">
                <!-- <p>
                </P>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Date Ended</span>
                    <input type="date" class="form-control" id="archiveDateModal" name="dateEndedModal" placeholder="Date Ended" />
                  </div>
                </div> -->
              </div>
              <div class="modal-footer">
                <input type="hidden" value="" name="uniqueidActivate" id="uniqueidActivate">
                <input type="hidden" value="" name="nameAcativate" id="nameActivate">
                <button type = "button" class = "btn btn-default" data-dismiss = "modal">
                  Close
                </button>
                <input type="submit" class="btn btn-primary" name="activateTag" value="Activate Tag." />
              </div>
            </form>
          </div>
        </div>
      </div>

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <?php include("jsfunc.php"); ?>
  <script>

    function editModal() {

      var par = $(event.target).parent();
      var name = par.find('td.name').text();
      var unique = par.find('td.hidden').text();
      var type = par.find('td.type').text();
      var id = par.find('td.id').text();
      var url = par.find('td.url').text();
      var publisher = par.find('td.publisher').text();
      var advertiser = par.find('td.advertiser').text();
      var ecpm = par.find('td.ecpm').text();
      var ccpm = par.find('td.ccpm').text();
      var date = par.find('td.date').text();

      var modalBox = document.getElementById("myModalLabel");
      var nameInput = document.getElementById("tagnameModal");
      var typeInput = document.getElementById("tagtypeModal");
      var indentifierInput = document.getElementById("identifierModal");
      var urlInput = document.getElementById("urlModal");
      var uniqueInput = document.getElementById("uniqueid");
      var publisherInput = document.getElementById("publisherModal");
      var advertiserInput = document.getElementById("advertiserModal");
      var ecpmInput = document.getElementById("ecpmModal");
      var ccpmInput = document.getElementById("ccpmModal");
      var dateInput = document.getElementById("dateModal");

      if(name!="") {
        modalBox.innerHTML = "Edit - " + name;
      } else {
        modalBox.innerHTML = "Edit - Tag";
      }
      nameInput.value = name;
      typeInput.value = type;
      uniqueInput.value = unique;
      indentifierInput.value = id;
      urlInput.value = url;
      publisherInput.value = publisher;
      advertiserInput.value = advertiser;
      ecpmInput.value =  ecpm;
      ccpmInput.value =  ccpm;
      dateInput.value = date;

      $('#myModal').modal();

    }

    function activateModal() {

      var par = $(event.target).parent();
      var name = par.find('td.name').text();
      var unique = par.find('td.hidden').text();

      var modalBox = document.getElementById("activateModalLabel");
      var nameInput = document.getElementById("nameActivate");
      var uniqueInput = document.getElementById("uniqueidActivate");

      nameInput.value = name;
      uniqueInput.value = unique;

      if(name!="") {
        modalBox.innerHTML = "Activate - " + name;
      } else {
        modalBox.innerHTML = "Activate - Tag";
      }

      $("#activateModal").modal();

    }
    </script>
  </body>
</html>
