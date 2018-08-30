<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Add School Management
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
                        <h3 class="box-title">Enter School Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url('/school/') ?>addNewSchool" method="post" role="form" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">Select State</label>
                                        <!-- <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                                        -->
                                        <select>
                                            <option>Jharkhand</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">Select City</label>
                                        <!-- <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                                        -->
                                        <select>
                                            <option>Ranchi</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="sname">School Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('sname'); ?>" id="sname" name="sname" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="scode">School Code</label>
                                        <input type="text" class="form-control required" id="scode" value="<?php echo set_value('scode'); ?>" name="scode" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control required" id="address" name="address" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pname">Principal Name</label>
                                        <input type="text" class="form-control required" id="pname" name="pname" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pphone">Principal Phone</label>
                                        <input type="text" class="form-control required" id="pphone" value="<?php echo set_value('pphone'); ?>" name="pphone" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tname">Transport In-charge Name</label>
                                        <input type="text" class="form-control required" id="tname" value="<?php echo set_value('tname'); ?>" name="tname" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tphone">Transport In-charge Phone</label>
                                        <input type="text" class="form-control required" id="tphone" value="<?php echo set_value('tphone'); ?>" name="tphone" maxlength="128">
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