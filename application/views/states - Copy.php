<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> State Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url('/state/'); ?>addState"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">State List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                    <thead>
                      <tr role="row">
                       <!-- <th>Id</th>
                        <th>State</th> -->
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="City Id: activate to sort column descending" style="color: black;">City Id</th>
                        <th>City</th>
                        <th>School List</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                     <!-- <td><?php echo $record->id ?></td>
                      <td><?php echo $record->state_name ?></td> -->
                      <td><?php echo $record->city_id ?></td>
                      <td><?php echo $record->city ?></td>
                      <td><?php echo $record->school_list ?></td>
                      <td class="text-center">
                          <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->city_id; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                          <a class="btn btn-sm btn-info" href="<?php echo base_url('/state/').'editOld/'.$record->city_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->city_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
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
