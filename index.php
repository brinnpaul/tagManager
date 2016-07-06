<?php
  include("connection.php");
  include("tables_ps.php");
  include("header.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tag Table</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Bootstrap -->
    <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
    #addTag {
      margin-top: 10px;
    }
    #navigation {
      margin-top: 50px;
    }
    .input-group-addon {
      min-width: 100px;
    }
    .btn {
      margin-bottom: 15px;
    }
    .sidebar-nav .navbar .navbar-collapse {
      padding: 0;
      max-height: none;
    }
    .sidebar-nav .navbar ul {
      float: none;
      display: block;
    }
    .sidebar-nav .navbar li {
      float: none;
      display: block;
    }
    .sidebar-nav .navbar li a {
      padding-top: 12px;
      padding-bottom: 12px;
    }
    </style>
  </head>
  <body>

    <div class="container" id="addTag">
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
              <div class="input-group col-md-12"><span class="input-group-addon">Name</span>
                <input type="text" class="form-control" name="tagname" placeholder="Tag Name" value="<?php echo addslashes($_POST['tagname']); ?>" />
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">Pub</span>
                <select class="form-control" name="tagtype" value="<?php echo addslashes($_POST['tagtype']); ?>">
                  <option value="">Pub</option>
                  <option value="spotxchange">SpotX</option>
                  <option value="tremor">Tremor</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">Company</span>
                <select class="form-control" name="company" value="<?php echo addslashes($_POST['company']); ?>">
                  <option value="">Company</option>
                  <option value="ad.net">Ad.net</option>
                  <option value="engageBDR">EngageBDR</option>
                  <option value="maverick">Maverick</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">Broker</span>
                <select class="form-control" name="brokered" value="<?php echo addslashes($_POST['brokered']); ?>">
                  <option value="">Demand or Supply?</option>
                  <option value="demand">Demand</option>
                  <option value="supply">Supply</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">ID</span>
                <input type="text" class="form-control" name="identifier" placeholder="Identifier" value="<?php echo addslashes($_POST['identifier']); ?>" />
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">Rate</span>
                <input type="text" class="form-control" name="rate" placeholder="CPM Rate" value="<?php echo addslashes($_POST['rate']); ?>" />
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
    <div class="container" id="table">
      <table id="datatables">
        <thead>
          <tr>
            <th>Tag Name</th>
            <th>Tag Type</th>
            <th>Brokered</th>
            <th>Company</th>
            <th>Identifier</th>
            <th>CPM Rate</th>
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
            <td class="hidden"><?php echo $row['uniqueid']; ?></td>
            <td class="type"><?php echo $row['tagtype']?></td>
            <td class="brokered"><?php echo $row['brokered']?></td>
            <td class="company"><?php echo $row['company']?></td>
            <td class="id"><?php echo $row['identifier']?></td>
            <td class="rate"><?php echo $row['rate']?></td>
            <td class="date"><?php echo $row['datebrokered']?></td>
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
                  <div class="input-group col-md-12"><span class="input-group-addon">Name</span>
                    <input type="text" class="form-control" id="nameModal" name="tagnameModal" placeholder="Tag Name" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Pub</span>
                    <select class="form-control" id="typeModal" name="tagtypeModal" value="<?php echo addslashes($_POST['tagtypeModal']); ?>">
                      <option value="">Pub</option>
                      <option value="spotxchange">SpotX</option>
                      <option value="tremor">Tremor</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Company</span>
                    <select class="form-control" id="companyModal" name="companyModal" value="<?php echo addslashes($_POST['companyModal']); ?>">
                      <option value="">Company</option>
                      <option value="ad.net">Ad.net</option>
                      <option value="engageBDR">EngageBDR</option>
                      <option value="maverick">Maverick</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Broker</span>
                    <select class="form-control" id="brokerModal" name="brokeredModal" value="<?php echo addslashes($_POST['brokeredModal']); ?>">
                      <option value="">Demand or Supply?</option>
                      <option value="demand">Demand</option>
                      <option value="supply">Supply</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group col-md-12"><span class="input-group-addon">Rate</span>
                    <input type="text" class="form-control" id="rateModal" name="rateModal" placeholder="CPM Rate" value="<?php echo addslashes($_POST['rateModal']); ?>" />
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
                    <input type="date" class="form-control" id="archiveDateModal" name="dateEndedModal" placeholder="Date Ended" />
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
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#datatables').dataTable();
      })

      $('.row .addtag').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.collapse-group').find('.collapse');
        $collapse.collapse('toggle');
      });

      // $('#datepicker').datepicker({
      //   format: "yyyy-mm-dd",
      //   todayHighlight:true
      // });
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
        var brkrd = par.find('td.brokered').text();
        var cmpny = par.find('td.company').text();
        var id = par.find('td.id').text();
        var rate = par.find('td.rate').text();
        var date = par.find('td.date').text();

        var modalBox = document.getElementById("myModalLabel");
        var nameInput = document.getElementById("nameModal");
        var typeInput = document.getElementById("typeModal");
        var uniqueInput = document.getElementById("uniqueid");
        var brokerInput = document.getElementById("brokerModal");
        var companyInput = document.getElementById("companyModal");
        var rateInput = document.getElementById("rateModal");
        var dateInput = document.getElementById("dateModal");

        if(name!="") {
          modalBox.innerHTML = "Edit - " + name;
        } else {
          modalBox.innerHTML = "Edit - Tag";
        }
        nameInput.value = name;
        typeInput.value = type;
        uniqueInput.value = unique;
        brokerInput.value = brkrd;
        companyInput.value = cmpny;
        rateInput.value =  rate;
        dateInput.value = date;

        $('#myModal').modal();

      }
    </script>
  </body>
</html>
