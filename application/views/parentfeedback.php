<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Parent Feedback Management
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Add New</a>
                    -->
                </div>
            </div>
        </div>
        

        
            <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <!--<div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div> -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <!--<th>Name</th> -->
                      <th>FEEDBACK</th>
                      <th>PHONE</th>
                      <th class="text-center">ACTIONS</th>
                    </tr>
                  </thead>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $record->id ?></td>
                      <td><?php echo $record->feedback ?></td>
                      <td><?php echo $record->mob_no ?></td>
                      <td class="text-center">
                         <!-- <a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->id; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                          <a class="btn btn-sm btn-info" href="<?php echo base_url('/parentfeedback/').'editOld/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <!--  <?php echo $this->pagination->create_links(); ?> -->
                </div>
              </div><!-- /.box -->
            </div>
        </div>
                          
                          </div>

                        

                        
                          
                          </div>
                        </div>
                        
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
    </section>
</div>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script> -->
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>
<script>
jQuery(document).ready(function(){
    
    jQuery(document).on("click", ".deleteUser", function(){
        var userId = $(this).attr("data-userid"),
            hitURL = baseURL + "parentfeedback/" + "deleteUser",
            currentRow = $(this);
        
        var confirmation = confirm("Are you sure to delete this user ? ");
        
        if(confirmation)
        {
            jQuery.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { userId : userId } 
            }).done(function(data){
                console.log(data);
                currentRow.parents('tr').remove();
                if(data.status = true) { alert("Paackrent Feedb successfully deleted"); }
                else if(data.status = false) { alert("User deletion failed"); }
                else { alert("Access denied..!"); }
            });
        }
    });
    
    
    jQuery(document).on("click", ".searchList", function(){
        
    });
    
});
</script>

