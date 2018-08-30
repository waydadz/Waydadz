<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Add Student Management
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
                        <h3 class="box-title">Enter Student Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url('/student/') ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="sid">Student Id</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('sid'); ?>" id="sid" name="sid" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="sname">Student Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('sname'); ?>" id="sname" name="sname" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="sclass">Student Class</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('sclass'); ?>" id="sclass" name="sclass" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ssection">Student Section</label>
                                        <input type="text" class="form-control required" id="ssection" value="<?php echo set_value('ssection'); ?>" name="ssection" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required" id="mobile" name="mobile" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tid">Transport Id</label>
                                        <input type="text" class="form-control required" id="tid" name="tid" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pid">Parent Id</label>
                                        <input type="text" class="form-control required" id="pid" value="<?php echo set_value('pid'); ?>" name="pid" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pname">Parent Name</label>
                                        <input type="text" class="form-control required" id="pname" value="<?php echo set_value('pname'); ?>" name="pname" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ccode">Child Code</label>
                                        <input type="text" class="form-control required" id="ccode" value="<?php echo set_value('ccode'); ?>" name="ccode" maxlength="128">
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
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>