<div id="mySubModal" class="modal-content sub-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:4;">
    <div class="modal-content">
        <div class="modal-body">
		<div class="row">
		<div class="col-sm-6">Status: <strong>Active</strong></div>
		<div class="col-sm-6"><form class="form-horizontal">
                <div class="form-group pull-right">
				<label>Change: </label>
		<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-success btn-sm">
    <input type="radio" name="options" id="active-btn"> Active
  </label>
    <label class="btn btn-warning btn-sm" id="pending-label">
    <input type="radio" name="options" id="pending-btn"> Pending
  </label>
  <label class="btn btn-danger btn-sm">
    <input type="radio" name="options" id="banned-btn"> Banned
  </label>
</div> 
</div>
</div>
        </div>
            <form class="form-horizontal">
                <div class="form-group" style="display: none;">
                    <label class="control-label" for="inputEmail">Reason for Ban: </label>
                    <textarea id="bad_reason" class="form-control" rows="5">Reason...</textarea>
                    <span class="help-block">Length: <span id="length">0</span> Characters <span id="warning-message" class="pull-right"></span></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button>
            <button class="btn btn-sm btn-danger" data-dismiss="submodal">Submit</button>
        </div>
    </div>
</div>