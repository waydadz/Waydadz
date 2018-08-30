<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Student Management
        <a class="btn btn-primary pull-right" href="<?php echo base_url('/student/'); ?>addStudent"><i class="fa fa-plus"></i> Add New</a>
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>NAME</th>
                      <th>CLASS</th>
                      <th>PARENT NAME</th>
                      <th>PARENT PHONE</th>
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
                      <td><?php echo $record->student_id ?></td>
                      <td><?php echo $record->student_name ?></td>
                      <td><?php echo $record->student_class ?></td>
                      <td><?php echo $record->parent_name ?></td>
                      <td><?php echo $record->parent_reg_phone ?></td>
                      <td class="text-center">
                          <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->student_id; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                          <a class="btn btn-sm btn-info" href="<?php echo base_url('/student/').'editStudent/'.$record->student_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->student_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
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
            hitURL = baseURL + "student/" + "deleteUser",
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
                if(data.status = true) { alert("User successfully deleted"); }
                else if(data.status = false) { alert("User deletion failed"); }
                else { alert("Access denied..!"); }
            });
        }
    });
    
    
    jQuery(document).on("click", ".searchList", function(){
        
    });
    
});
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
