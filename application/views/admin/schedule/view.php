

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Schedule</h1>
      
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  
  <section class="content">
       <!-- Page Heading -->
    <div class="row">
      <div class="col-12">
      
      <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Table With Full Features</h3>
        <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_ScheduleAdd"><span class="fa fa-plus"></span> Add New Schedule</a></div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
      
        
         
                <table class="table table-striped" id="mydata">
                  <thead>
                    <tr>
                      <th>Lab Name</th>
                      <th>Days</th>
                      <th>Opening Times</th>
                      <th>Closing Time</th>
                      <th style="text-align: right;">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="show_scheduledata">
                     
                  </tbody>
                </table>
                </div>
              </div>
              </div>
            </div>
      <!-- /.row -->
    
    
    <!-- MODAL ADD -->
            <form id="addscheduleform">
            <div class="modal fade" id="Modal_ScheduleAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Add New Schedule <br/><span id="error"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          

                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Labs</label>
                            <div class="col-md-10">
                               <select class="form-control" name="lab_id">
                              <?php foreach ($labs as $key => $lab): ?>
                                 <option value="<?php echo $lab->id;?>"><?php echo $lab->name;?></option>
                              <?php endforeach ?>
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Days</label>
                            <div class="col-md-10">
                               <select  class="form-control" multiple name="days[]">
                                  <option value="monday">Monday</option>
                                  <option value="tuesday">Tuesday</option>
                                  <option value="wednesday">Wednesday</option>
                                  <option value="thursday">Thursday</option>
                                  <option value="friday">Friday</option>
                                  <option value="saturday">Saturday</option>
                                  <option value="sunday">Sunday</option>
                               </select>
                            </div>
                         </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Opening Time</label>
                            <div class="col-md-10">
                              <input type="time" name="opening_time" class="form-control" placeholder="Contact" >
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-2 col-form-label">Closing Time</label>
                            <div class="col-md-10">
                              <input type="time" name="closing_time" class="form-control" placeholder="Secondary Contact" >
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  type="submit"  class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
                  
            </div>
            </form>
        <!--END MODAL ADD-->
 
 
 
 
 
 
 
 
 
        <!-- MODAL EDIT -->
        <form>
            <div class="modal fade" id="Modal_ScheduleEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Schedule<br/><span id="edit_error"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <input type="hidden" name="schedule_id_edit" id="schedule_id_edit" class="form-control" readonly>
                       <div class="form-group row">
                            <label class="col-md-2 col-form-label">Labs</label>
                            <div class="col-md-10">
                               <select class="form-control" name="lab_id_edit">
                              <?php foreach ($labs as $key => $lab): ?>
                                 <option value="<?php echo $lab->id;?>"><?php echo $lab->name;?></option>
                              <?php endforeach ?>
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Days</label>
                            <div class="col-md-10">
                               <select  class="form-control" multiple name="days_edit[]">
                                  <option value="monday">Monday</option>
                                  <option value="tuesday">Tuesday</option>
                                  <option value="wednesday">Wednesday</option>
                                  <option value="thursday">Thursday</option>
                                  <option value="friday">Friday</option>
                                  <option value="saturday">Saturday</option>
                                  <option value="sunday">Sunday</option>
                               </select>
                            </div>
                         </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Opening Time</label>
                            <div class="col-md-10">
                              <input type="time" name="opening_time_edit" class="form-control" placeholder="Contact" >
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-2 col-form-label">Closing Time</label>
                            <div class="col-md-10">
                              <input type="time" name="closing_time_edit" class="form-control" placeholder="Secondary Contact" >
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_scheduleupdate" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->
 
        <!--MODAL DELETE-->
         <form>
            <div class="modal fade" id="Modal_ScheduleDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="schedule_id" id="schedule_id" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_scheduledelete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->
    
    
    
    
    
  
    
    
    
    
    
    </section>
  
  
  
  
    
    <!-- /.content -->
  </div>
 <Script>
   function getCheckedValue(radioObj) {
  if(!radioObj)
    return "";
  var radioLength = radioObj.length;
  if(radioLength == undefined)
    if(radioObj.checked)
      return radioObj.value;
    else
      return "";
  for(var i = 0; i < radioLength; i++) {
    if(radioObj[i].checked) {
      return radioObj[i].value;
    }
  }
  return "";
}
 </Script>
  