<?php

$userId = '';
$sname = '';
$pphone = '';
$pname = '';
$roleId = '';

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->student_id;
        $sname = $uf->student_name;
        $pphone = $uf->parent_reg_phone;
        $pname = $uf->parent_name;
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
                    
                    <form role="form" action="<?php echo base_url('/student/') ?>editUser" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="sname">Student Name</label>
                                        <input type="text" class="form-control" id="sname" placeholder="Student Name" name="sname" value="<?php echo $sname; ?>" maxlength="128">
                                       <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />   
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pphone">Parent Phone No.</label>
                                        <input type="text" class="form-control" id="pphone" placeholder="Parent Phone No" name="pphone" value="<?php echo $pphone; ?>" maxlength="128">
                                    </div>
                                </div>
                          
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pname">Parent Name</label>
                                        <input type="text" class="form-control" id="pname" placeholder="Parent Name" name="pname" value="<?php echo $pname; ?>"maxlength="128">
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