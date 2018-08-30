<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Setting Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    
                </div>
            </div>
        </div>

                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                       
            
            
                        <!-- /.panel-heading -->
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#home">General</a></li>
                          <li><a data-toggle="tab" href="#menu1">Notification</a></li>
                          <li><a data-toggle="tab" href="#menu2">SMS</a></li>
                        </ul>

                        <div class="tab-content">

                          <div id="home" class="tab-pane fade  in active">
                            <h3>General Settings</h3>
                            <hr />
                            <form class="form-horizontal" action="">
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="email">App Name:</label>
                                  <div class="col-sm-5">
                                    <input type="email" class="form-control" id="email" placeholder="Enter App name" name="email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">App Details:</label>
                                  <div class="col-sm-5">          
                                    <input type="text" class="form-control" id="pwd" placeholder="Enter App Details" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">App:</label>
                                  <div class="col-sm-5">          
                                    <input type="text" class="form-control" id="pwd" placeholder="Enter App" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                  </div>
                                </div>
                              </form>
                          
                          </div>

                          <div id="menu2" class="tab-pane fade">
                            <h3>SMS Settings</h3>
                            <hr />
                            <form class="form-horizontal" action="">
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="email">API Link:</label>
                                  <div class="col-sm-5">
                                    <input type="email" class="form-control" id="email" placeholder="Enter api link provided by sms gateway" name="email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">Sender Id:</label>
                                  <div class="col-sm-5">          
                                    <input type="text" class="form-control" id="pwd" placeholder="Enter Sender Id" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">Username:</label>
                                  <div class="col-sm-5">          
                                    <input type="text" class="form-control" id="pwd" placeholder="Enter Sender Id" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">Password:</label>
                                  <div class="col-sm-5">          
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter Sender Id" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                  </div>
                                </div>
                              </form>
                          </div>

                          <div id="menu1" class="tab-pane fade">
                            <h3>Notifications Settings</h3>
                            <hr />
                            <form class="form-horizontal" action="">
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="email">Onesignal App ID:</label>
                                  <div class="col-sm-5">
                                    <input type="email" class="form-control" id="email" placeholder="Enter api link " name="email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">Onsignal Sender ID:</label>
                                  <div class="col-sm-5">          
                                    <input type="text" class="form-control" id="pwd" placeholder="Enter Sender Id" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">Username:</label>
                                  <div class="col-sm-5">          
                                    <input type="text" class="form-control" id="pwd" placeholder="Enter Sender Id" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="pwd">Password:</label>
                                  <div class="col-sm-5">          
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter Sender Id" name="pwd">
                                  </div>
                                </div>
                                <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                  </div>
                                </div>
                              </form>
                          
                          </div>
                          
                          </div>
                        </div>
                        
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                  
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
jQuery(document).ready(function(){
    
    jQuery(document).on("click", ".deleteUser", function(){
        var userId = $(this).attr("data-userid"),
            hitURL = baseURL + "setting/" + "deleteUser",
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
