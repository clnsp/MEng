   <div id="wrapper">

    <div id="page-wrapper">
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Class Types</h3>
        </div>
        <div class="panel-body">            
          
          <div class="manage-panel">
            <table id='class-types-table' class="table table-striped table-hover">
              <tr>
                <th>Title</th>
                <th>Description</th>
              </tr>
              
              <tbody>
                <?php foreach($class_types as $type):  ?>
                  
                  <tr  data-class_type_id="<?php echo $type['class_type_id'] ?>"> 
                    
                    <td class="class_type"><?php echo $type['class_type'] ?></td>
                    <td class="class_description"><?php echo $type['class_description'] ?></td>
                    
                  </tr>
                  
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
      
    </div>

  </div>