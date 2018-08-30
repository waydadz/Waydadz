<?php

$userId = '';
$cid = '';
$city = '';
$slist = '';
$roleId = '';

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        //$userId = $uf->userId;
        $cid = $uf->city_id;
        $city = $uf->city;
        $slist = $uf->school_list;
        //$roleId = $uf->roleId;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> State Management
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter State Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url('/state/') ?>editUser" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <!--
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="cid">City Id</label>
                                        <input type="text" class="form-control" id="cid" placeholder="City Id" name="cid" value="<?php echo $cid; ?>" maxlength="128">
                                       <input type="hidden" value="<?php echo $cid; ?>" name="cid" id="cid" />   
                                    </div>
                                    
                                </div> -->
                                <input type="hidden" value="<?php echo $cid; ?>" name="cid" id="cid" /> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" placeholder="Cnter City" name="city" value="<?php echo $city; ?>" maxlength="128">
                                    </div>
                                </div>
                          
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="slist">School List</label>
                                        <textarea type="text" class="form-control" id="slist" placeholder="School List" name="slist" maxlength="500"><?php echo $slist; ?>
                                        </textarea>
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