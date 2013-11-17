
<div class="row">
  <div class="col-md-6 div-center text-center"><div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Please Login</h3>
    </div>
    <div class="panel-body">
  
   <?php echo validation_errors(); ?>
     
     
     
     <?php echo form_open('verifylogin'); ?>
       
     
            <div class="input-group">
       
         <span class="input-group-addon">
         <i class="fa fa-envelope-o fa-fw"></i></span>
         <input type="text" class="form-control" size="20" id="username" name="username" placeholder="Username"/>
         </div>
        <div class="input-group">
        
       <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
         <input type="password" class="form-control" size="20" id="passowrd" name="password" placeholder="Password"/>
        
                  </div>
  <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
  
  
     </form>
  
  
  
  
  
    </div>
  </div>
  
  
    </div>
</div>


