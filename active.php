<?php
  include("connection.php");
  include("tables_active.php");
  include("updatePAS.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Active Tags</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Bootstrap -->
    <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <style>
    </style>
  </head>
  <body>
    <?php include("header.php"); ?>

    <div class="container">
      <div class="heading" id="header">
        <h1>Active Tags</h1>
      </div>
    </div>
    <div class="tableContainer" id="table">
      <table class="cell-border" id="datatables">
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
            <th>Edit Tag</th>
            <th>Archive Tag</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($row = mysqli_fetch_array($result)){
          ?>
          <tr>
            <td class="name"><?php echo $row['tagname']; ?></td>
            <td class="hidden"><?php echo $row['unique_id']; ?></td>
            <td class="type"><?php echo $row['tagtype']; ?></td>
            <td class="id"><?php echo $row['identifier']; ?></td>
            <td class="url"><?php echo chunk_split($row['url'], 40, "</br>"); ?></td>
            <td class="publisher"><?php echo $row['publisher']; ?></td>
            <td class="advertiser"><?php echo $row['advertiser']; ?></td>
            <td class="ecpm"><?php echo $row['ecpm']; ?></td>
            <td class="ccpm"><?php echo $row['ccpm']; ?></td>
            <td class="date"><?php echo $row['datebrokered']; ?></td>
            <td style="cursor:pointer;color:blue" onClick="editModal();">Edit</td>
            <td style="cursor:pointer;color:blue" onClick="archiveModal();">Archive</td>
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
                      <option value="<?php echo $row['sources']; ?>"><?php echo $row['sources']; ?></option>
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
                    <select class="form-control" id="publisherModal" name="publisherModal" placeholder="Publisher" value="<?php echo addslashes($_POST['publisherModal']); ?>">
                      <option value="">Publisher</option>
                      <?php
                      foreach ($partners as $row) {
                      ?>
                      <option value="<?php echo $row['partner']; ?>"><?php echo $row['partner']; ?></option>
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
                      <option value="<?php echo $row['partner']; ?>"><?php echo $row['partner']; ?></option>
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
      <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="archiveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="model-content">
            <form method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  &times;
                </button>
                <h4 class="modal-title" id="archiveModalLabel">
                  Archive Tag
                </h4>
              </div>
              <div class="modal-body">
                <p>
                </P>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Date Ended</span>
                    <input type="date" class="form-control" id="dateEndedModal" name="dateEndedModal" placeholder="Date Ended" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" value="" name="uniqueidArchive" id="uniqueidArchive">
                <input type="hidden" value="" name="nameArchive" id="nameArchive">
                <button type = "button" class = "btn btn-default" data-dismiss = "modal">
                  Close
                </button>
                <input type="submit" class="btn btn-primary" name="archiveTag" value="Archive Tag." />
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php include("updatePubAd.php"); ?>

      <div class="container" id="addTagBottom">
        <div class="row">
          <?php
            if($error) {
              echo '<div class="alert alert-danger">'.addslashes($error).'</div>';
            }
          ?>
          <div class="col-md-6 collapse-group panel pull-left">
            <input type="submit" class="btn btn-success addtag" name="addtag" value="Add a tag &raquo;" />
            <form class="marginTop center form-horizontal collapse" method="post">
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">Tag Name</span>
                  <input type="text" class="form-control" name="tagname" placeholder="Tag Name" value="<?php echo addslashes($_POST['tagname']); ?>" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">Tag Source</span>
                  <select class="form-control" name="tagtype" value="<?php echo addslashes($_POST['tagtype']); ?>">
                    <option value="">Tag Source</option>
                    <?php
                    foreach ($sources as $row) {
                    ?>
                    <option value="<?php echo $row['sources']; ?>"><?php echo $row['sources']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">Tag ID</span>
                  <input type="text" class="form-control" name="identifier" placeholder="Tag ID" value="<?php echo addslashes($_POST['identifier']); ?>" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">Tag URL</span>
                  <input type="text" class="form-control" name="url" placeholder="Tag URL" value="<?php echo addslashes($_POST['url']); ?>" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">Publisher</span>
                  <select class="form-control" name="publisher" value="<?php echo addslashes($_POST['publisher']); ?>">
                    <option value="">Publisher</option>
                    <?php
                    foreach ($partners as $row){
                    ?>
                    <option value="<?php echo $row['partner']; ?>"><?php echo $row['partner']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">Advertiser</span>
                  <select class="form-control" name="advertiser" value="<?php echo addslashes($_POST['advertiser']); ?>">
                    <option value="">Advertiser</option>
                    <?php
                    foreach ($partners as $row){
                    ?>
                    <option value="<?php echo $row['partner']; ?>"><?php echo $row['partner']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">eCPM</span>
                  <input type="text" class="form-control" name="ecpm" placeholder="eCPM" value="<?php echo addslashes($_POST['ecpm']); ?>" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">cCPM</span>
                  <input type="text" class="form-control" name="ccpm" placeholder="cCPM" value="<?php echo addslashes($_POST['ccpm']); ?>" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-md-12"><span class="input-group-addon">Date</span>
                  <input type="date" class="form-control" id="datepicker" name="datebrokered" placeholder="Date Brokered" value="<?php echo addslashes($_POST['datebrokered']); ?>" />
                </div>
              </div>
                <input type="submit" class="btn btn-success" name="submit" value="Update Database!" />
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

      $('.row .addtag').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.collapse-group').find('.collapse');
        $collapse.collapse('toggle');
      });

      $('.row .addpartner').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.collapse-group').find('.collapse');
        $collapse.collapse('toggle');
      });

      $('.row .addsource').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.collapse-group').find('.collapse');
        $collapse.collapse('toggle');
      });

      function archiveModal() {

        var par = $(event.target).parent();
        var name = par.find('td.name').text();
        var unique = par.find('td.hidden').text();

        var modalBox = document.getElementById("archiveModalLabel");
        var nameInput = document.getElementById("nameArchive");
        var uniqueInput = document.getElementById("uniqueidArchive");

        nameInput.value = name;
        uniqueInput.value = unique;

        if(name!="") {
          modalBox.innerHTML = "Archive - " + name;
        } else {
          modalBox.innerHTML = "Archive - Tag";
        }

        $("#archiveModal").modal();

      }

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
    </script>
  </body>
</html>
