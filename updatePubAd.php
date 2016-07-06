<?php

?>

  <div class="container">
    <div class="row">
      <div class="col-md-6 collapse-group panel">
        <input type="submit" class="btn btn-success addtag" name="addpartner" value="Add a Partner &raquo;" />
        <div class="form-group" id="addpubs">
          <form class="marginTop center form-horizontal collapse" method="post">
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">Update Pubs and Advs</span>
                <input type="text" class="form-control" name="addpubs" placeholder="Pub and Ad" value="<?php echo addslashes($_POST['addpubs']); ?>" />
              </div>
            </div>
            <input type="submit" class="btn btn-success" name="submitpubs" value="Update Partners" />
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 collapse-group panel">
        <input type="submit" class="btn btn-success addtag" name="addsource" value="Add a Tag Source &raquo;" />
        <div class="row" id="addsources">
          <form class="marginTop center form-horizontal collapse" method="post">
            <div class="form-group">
              <div class="input-group col-md-12"><span class="input-group-addon">Update Tag Sources</span>
                <input type="text" class="form-control" name="addsources" placeholder="Tag Source" value="<?php echo addslashes($_POST['addsources']); ?>" />
              </div>
            </div>
            <input type="submit" class="btn btn-success" name="submitsources" value="Update Sources" />
          </form>
        </div>
      </div>
    </div>
  </div>
