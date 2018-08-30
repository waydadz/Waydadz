<?php

$userId = '';
$sname = '';
$princPhone = '';
$transPhone = '';
$roleId = '';

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        //$userId = $uf->userId;
        $sname = $uf->school_name;
        $princPhone = $uf->principal_phone_no;
        $transPhone = $uf->transport_incharge_phone;
        $roleId = $uf->roleId;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> User Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url('/school/') ?>editUser" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="sname">School Name</label>
                                        <input type="text" class="form-control" id="sname" placeholder="School Name" name="sname" value="<?php echo $sname; ?>" maxlength="128">
                                       <input type="hidden" value="<?php echo $sname; ?>" name="sname" id="sname" />   
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="princPhone">Principal Phone No.</label>
                                        <input type="text" class="form-control" id="princPhone" placeholder="Principal Phone No" name="princPhone" value="<?php echo $princPhone; ?>" maxlength="128">
                                    </div>
                                </div>
                          
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="transPhone">Transport Incharge Phone No.</label>
                                        <input type="text" class="form-control" id="transPhone" placeholder="Transport Phone No" name="transPhone" value="<?php echo $transPhone; ?>"maxlength="128">
                                    </div>
                                </div>
                            
                                    
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>