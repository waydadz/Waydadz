<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> State Management
        
        <a class="btn btn-primary pull-right" href="<?php echo base_url('/state/'); ?>addState"><i class="fa fa-plus"></i> Add State</a>
      
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-striped dt-responsive nowrap dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                    <thead>
                      <tr role="row">
                       <!-- <th>Id</th>
                        <th>State</th> -->
                        <th style="color: black;">List of States</th>
                        <!--
                        <th>CITY</th>
                        <th style="width:25%">SCHOOL LIST</th>
                        <th class="text-center">ACTIONS</th> -->
                      </tr>
                    </thead>
                    <?php
                    if(!empty($userRecords))
                    {
                      $list_count = 0;
                        foreach($userRecords as $record)
                        {
                          
                          $list_count++;
                    ?>
                    <tr >
                     <!-- <td><?php echo $record->id ?></td>
                      <td><?php echo $record->state_name ?></td> -->
                      <td ><strong><?php echo $list_count. ". ".ucwords($record)?></strong></td>
                      <!--
                      <td><?php echo $record->city ?></td>
                      <td style="word-break: break-all;"><?php echo $record->school_list ?></td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->city_id; ?>" title="Login history"><i class="fa fa-history"></i></a> | 
                          <a class="btn btn-sm btn-info" href="<?php echo base_url('/state/').'editOld/'.$record->city_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->city_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>-->
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
