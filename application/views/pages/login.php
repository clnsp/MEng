
<div class="row">
  <div class="col-md-6 div-center text-center">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Please Login</h3>
      </div>
      <div class="panel-body">

        <?php echo validation_errors('<div class="error alert alert-danger">', '</div>'); ?> 
        <?php echo form_open('verifylogin'); ?>

        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
          <input type="text" class="form-control" size="20" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username"/>
        </div>
        
        <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
           <input type="password" class="form-control" size="20" id="passowrd" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password"/>
         </div>
         
         <div>
           <a class="pull-left" href="#">Forgotten Password?</a>
           <button type="submit" class="btn btn-primary btn-lg pull-right">Login</button>
          </div>

       </form>

     </div>
   </div>
 </div>
</div>



