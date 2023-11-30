<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<?php $this->load->view('backend/timezone'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-braille" style="color:maroon"></i>&nbsp Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-primary"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                    <?php 
                                        $this->db->where('status','ACTIVE');
                                        $this->db->from("employee");
                                        echo $this->db->count_all_results();
                                    ?>  Employees</h3>
                                        <a href="<?php echo base_url(); ?>employee/Employees" class="text-muted m-b-0">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-map-alt"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                         <?php 
                                               // $this->db->where('status','Granted');
                                                $this->db->from("branch");
                                                echo $this->db->count_all_results();
                                            ?> Branches 
                                        </h3>
                                        <a href="<?php echo base_url(); ?>organization/Branch" class="text-muted m-b-0">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-id-badge"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                         <?php 
                                                
                                                $this->db->from("department");
                                                echo $this->db->count_all_results(); 
                                            ?> Departments
                                        </h3>
                                        <a href="<?php echo base_url(); ?>organization/Department" class="text-muted m-b-0">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-file"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             <?php 
                                                    /*$this->db->where('leave_status','Approve');*/
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> Leaves
                                        </h3>
                                        <a href="<?php echo base_url(); ?>leave/Leave_report" class="text-muted m-b-0">View Details</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-file"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             <?php 
                                                    /*$this->db->where('desciplinary','Suspension');
                                                    $this->db->from("desciplinary");
                                                    echo $this->db->count_all_results();*/
                                                ?> Disciplinary
                                        </h3>
                                        <a href="<?php echo base_url(); ?>employee/Disciplinary" class="text-muted m-b-0">View Details</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!--<div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             <?php 
                                                    //$this->db->where('status','INACTIVE');
                                                    //$this->db->from("employee");
                                                    //echo $this->db->count_all_results();
                                                    ?> Former Employees
                                        </h3>
                                        <a href="<?php echo base_url(); ?>employee/Inactive_Employee" class="text-muted m-b-0">View Details</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                
                <div class="row ">
                    <!-- Column -->
                    <!--<div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-info">
                            <div class="box bg-primary text-center">
                                <h1 class="font-light text-white">
                                    <?php /*
                                        $this->db->where('status','INACTIVE');
                                        $this->db->from("employee");
                                        echo $this->db->count_all_results();
										*/
                                    ?>
                                </h1>
                                <h6 class="text-white">Former Employees</h6>
                            </div>
                        </div>
                    </div> -->
                    <!-- Column -->
                    <div class="col-md-7 col-lg-4 col-xlg-4">
                        <div class="card card-info card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                             <?php 
                                                    $this->db->where('leave_status','Not Approve');
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> 
                                </h1>
                                <h6 class="text-white">Pending Leave Application</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-7 col-lg-4 col-xlg-4">
                        <div class="card card-info card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                             <?php 
                                                    $this->db->where('leave_status','Approve');
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> 
                                </h1>
                                <h6 class="text-white">Approved Leave Application</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-7 col-lg-4 col-xlg-4">
                        <div class="card card-info card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                             <?php 
                                                    $this->db->where('leave_status','Rejected');
                                                   $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> 
                                </h1>
                                <h6 class="text-white">Rejected Leave Application</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <!--<div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-success">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                         <?php /*
                                                $this->db->where('status','Granted');
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
												*/
                                            ?> 
                                </h1>
                                <h6 class="text-white">Granted Loan Application</h6>
                            </div>
                        </div>
                    </div>-->
                    <!-- Column -->
					<div class="col-md-7 col-lg-4 col-xlg-4">
                        <div class="card card-info card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                         <?php 
                                                $this->db->where('logstatus',1);
                                                $this->db->from("attendance");
                                                echo $this->db->count_all_results()."%";
                                            ?> 
                                </h1>
                                <h6 class="text-white">On Time Percentage</h6>
                            </div>
                        </div>
                    </div>
					
                    <!-- Column -->
                    <div class="col-md-7 col-lg-4 col-xlg-4">
                        <div class="card card-info card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                             <?php 
                                                   $this->db->where('logstatus',1 );
                                                    $this->db->where('atten_date', date('Y-m-d'));
                                                    $this->db->from("attendance");
                                                    echo $this->db->count_all_results();
													
                                                ?> 
                                </h1>
                                <h6 class="text-white">On Time Today</h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                     <div class="col-md-7 col-lg-4 col-xlg-4">
                        <div class="card card-info card-inverse">
                            <div class="box  text-center">
                                <h1 class="font-light text-white">
                                    <?php 
                                        $this->db->where('logstatus',0);
                                        $this->db->where('atten_date', date('Y-m-d'));
                                        $this->db->from("attendance");
                                        echo $this->db->count_all_results();
										
                                    ?>
                                </h1>
                                <h6 class="text-white">Late Today</h6>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                   
                </div>
                <!-- ============================================================== -->
				 <div class="row ">
                   
                    <!-- Column -->
                    <!--<div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-success">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                         <?php /*
                                                $this->db->where('status','Deny');
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
												*/
                                            ?> 
                                </h1>
                                <h6 class="text-white">Deny Loan Application</h6>
                            </div>
                        </div>
                    </div>-->
                    <!--Column -->
					<!--<div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-warning">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                         <?php /*
                                                $this->db->where('status','Granted');
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results()."%";
												*/
                                            ?> 
                                </h1>
                                <h6 class="text-white">ON Time Percentage</h6>
                            </div>
                        </div>
                    </div>-->
                </div>
                <!-- ============================================================== -->
            </div> 
            <div class="container-fluid">
                <?php $notice = $this->notice_model->GetNoticelimit(); 
                $running = $this->dashboard_model->GetRunningProject(); 
                $userid = $this->session->userdata('user_login_id');
                $todolist = $this->dashboard_model->GettodoInfo($userid);                 
                $holiday = $this->dashboard_model->GetHolidayInfo();                 
                ?>
                <!-- Row -->
                <div class="row">
                   
                    <!-- Column -->
                    <!--<div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">To Do list</h4>
                                <h6 class="card-subtitle">List of your next task to complete</h6>
                                <div class="to-do-widget m-t-20" style="height:550px;overflow-y:scroll">
                                            <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                               <?php //foreach($todolist as $value): ?>
                                                <li class="list-group-item" data-role="task">
                                                   <?php //if($value->value == '1'){ ?>
                                                    <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="<?php //echo $value->id?>" data-value="0" type="checkbox" id="<?php echo $value->id?>" >
                                                        <label for="<?php //echo $value->id?>"><span><?php //echo $value->to_dodata; ?></span></label>
                                                    </div>
                                                    <?php //} else { ?>
                                                    <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="<?php //echo $value->id?>" data-value="1" type="checkbox" id="<?php echo $value->id?>" checked>
                                                        <label class="task-done" for="<?php // echo $value->id?>"><span><?php echo $value->to_dodata; ?></span></label>
                                                    </div> 
                                                    <?php //} ?>                                                   
                                                </li>

                                                <?php // endforeach; ?>
                                            </ul>                                    
                                </div>
                                <div class="new-todo">
                                   <form method="post" action="add_todo" enctype="multipart/form-data" id="add_todo" >
                                    <div class="input-group">
                                        <input type="text" name="todo_data" class="form-control" style="border: 1px solid #fff !IMPORTANT;" placeholder="Enter New Task...">
                                        <span class="input-group-btn">
                                        <input type="hidden" name="userid" value="<?php //echo $this->session->userdata('user_login_id'); ?>">
                                        <button type="submit" class="btn btn-success todo-submit"><i class="fa fa-plus"></i></button>
                                        </span> 
                                    </div>
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- Row -->
                <div class="row">
                    <!--<div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Notice Board</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive slimScrollDiv" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover table-bordered earning-box ">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>File</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php //foreach($notice AS $value): ?>
                                            <tr class="scrollbar" style="vertical-align:top">
                                                <td><?php //echo $value->title ?></td>
                                                <td><mark><a href="<?php //echo base_url(); ?>assets/images/notice/<?php echo $value->file_url ?>" target="_blank"><?php echo $value->file_url ?></a></mark>
                                                </td>
                                                <td style="width:100px"><?php //echo $value->date ?></td>
                                            </tr>
                                            <?php //endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Holidays
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:400px;overflow-y:scroll">
                                    <table class="table table-hover table-bordered earning-box">
                                       <thead>
                                            <tr>
                                                <th>Holiday Name</th>
                                                <th>Date</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                          <?php foreach($holiday as $value): ?>
                                           <tr style="background-color:skyblue">
                                               <td><?php echo $value->holiday_name ?></td>
                                               <td><?php echo $value->from_date; ?></td>
                                           </tr>
                                           <?php endforeach ?>
                                       </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-8">
						<!--<label class="label label-info">Attendance Report</label>
						 <?php $months = array(); $ontime = array(); $late = array();
						 /*$overalllate = array(); $overallontime = array();
							$chart_data = '';
							for($m =1; $m <=12; $m++){
          
							 //$late = $this->dashboard_model->getAllLateAttendance($m); 
							 //$ontime = $this->dashboard_model->getAllOntimeAttendance($m); 
								$this->db->where('logstatus',0);
								$this->db->where('MONTH(atten_date)', $m);
								$this->db->from("attendance");
								array_push($overalllate,$this->db->count_all_results()); 
								
								$this->db->where('logstatus',1);
								$this->db->where('MONTH(atten_date)', $m);
								$this->db->from("attendance");
								array_push($overallontime,$this->db->count_all_results()); 
							  
							$num = str_pad( $m, 2, 0, STR_PAD_LEFT );
							$month =  date('M', mktime(0, 0, 0, $m, 1));
							array_push($months, $month);
							
							} */
							//$attendances = $this->dashboard_model->getAllAttendances();
							$late = $this->dashboard_model->getAllLateAttendance(); 
							$ontime = $this->dashboard_model->getAllOntimeAttendance();
							$overall = $this->dashboard_model->getOverallAttendance();
							//$late = json_encode($late); 
							//$ontime =json_encode($ontime);
							//$overall = json_encode($overall);
							
							//$months = json_encode($months);
							//$overalllate = json_encode($overalllate);
							//$overallontime = json_encode($overallontime);
							
							
							
                         ?> 
     <div id="bar-chart" ></div>-->
	 
       <label class="label label-info" style="background-color:skyblue"><h3>Attendance Today's Report</h3></label>
       <br>
       <br>
      <div id="pie-chart" style="background-color:skyblue"></div>
    
    
					</div>
                </div> 
				
				<!--<div class="row">
					<div class="col-md-12">
						
					
       <label class="label label-success">Bar Chart</label>
      <div id="bar-chart" ></div>
    
					</div>
				</div>-->
				
				
<script>
  /*$(".to-do").on("click", function(){
      //console.log($(this).attr('data-value'));
      $.ajax({
          url: "Update_Todo",
          type:"POST",
          data:
          {
          'toid': $(this).attr('data-id'),         
          'tovalue': $(this).attr('data-value'),
          },
          success: function(response) {
              location.reload();
          },
          error: function(response) {
            console.error();
          }
      });
  });
*/

$(function () {

Morris.Donut({
  element: 'pie-chart',
  data: [
    {label: "Ontime", value: <?php echo round(($ontime /$overall) * 100,2);?>},
    {label: "Late", value: <?php echo round(($late / $overall) * 100,2);?>}
  
  ],
  formatter: function (value) { return (value) + '%'; }
});


 

  })  
  
</script>                                               
<?php $this->load->view('backend/footer'); ?>