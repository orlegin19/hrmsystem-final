<!-- https://github.com/eboominathan/Basic-Crud-in-Full-Calendar-Using-Codeigniter-3.0.3/tree/master/fullcalendar
https://www.patchesoft.com/fullcalendar-with-php-and-codeigniter/
 -->
<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

<style>
    .fc-fri {
        background-color: #FFEB3B;
    }

    .fc-event,
    .fc-event-dot {
        background-color: #FF5722;
    }

    .fc-event {
        border: 0;
    }

    .fc-day-grid-event {
        margin: 0;
        padding: 0;
    }

    .dayWithEvent {
        background: #FFEB3B;
        cursor: pointer;
    }
</style>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-bullhorn" style="color:maroon"></i> Holiday</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Holiday</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!--
                <div class="row m-m-10">
                    <div class="col-12">
                        <div class="card-body b-l calender-sidebar">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                 CALENDAR MODAL 
                <div class="modal none-border" id="my-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add Event</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>-->

        <div class="row m-b-10">
            <div class="col-12">
                <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>

                <?php } else { ?>
                    <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#holysmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Holiday </a></button>
                    <!--<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>leave/Application" class="text-white"><i class="" aria-hidden="true"></i> Leave Application</a></button>-->
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="fa fa-bullhorn"> Holidays List </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Start Date </th>
                                        <th>End Date </th>
                                        <th>Days</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($holidays as $value) : ?>
                                        <tr>
                                            <td><?php echo $value->holiday_name ?></td>
                                            <td><?php echo date('jS \of F Y', strtotime($value->from_date)); ?></td>
                                            <td><?php if (!empty($value->to_date)) {
                                                    echo date('jS \of F Y', strtotime($value->to_date));
                                                } ?></td>
                                            <td><?php echo $value->number_of_days; ?></td>
                                            <td><?php echo $value->year; ?></td>
                                            <td class="jsgrid-align-center ">
                                                <a href="" title="Edit" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> hidden <?php } ?> class="btn btn-sm btn-primary waves-effect waves-light holiday" data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                <a onclick="confirm('Are you sure, you want to delete this?')" href="#" title="Delete" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> hidden <?php } ?> class="btn btn-sm btn-danger waves-effect waves-light holidelet" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="holysmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Holidays</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="Add_Holidays" id="holidayform" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label">Name of Holiday</label>
                                <input type="text" name="holiname" class="form-control" id="recipient-name1" minlength="4" maxlength="25" value="" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Start Date</label>
                                <input type="date" name="startdate" id="startDatePicker">
                            </div>
                            <div class="form-group">
                                <label class="control-label">End Date</label>
                                <input type="date" name="enddate" id="endDatePicker">
                            </div>

                            <!--<div class="form-group">
                                                <label class="control-label">Number of Days</label>
                                                <input type="number" name="nofdate" class="form-control" id="recipient-name1" readonly required>
                                            </div>-->
                            <!--<div class="form-group">
                                                <label for="mesage-text" class="control-label"> Year</label>
                                                <input class="form-control mydatetimepicker" name="year" id="message-text1" required>
                                            </div> -->

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Include SweetAlert library via CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {

                // var dtToday = new Date();

                // var month = dtToday.getMonth() + 1;
                // var day = dtToday.getDate();
                // var year = dtToday.getFullYear();
                // if (month < 10)
                //     month = '0' + month.toString();
                // if (day < 10)
                //     day = '0' + day.toString();

                // var maxDate = year + '-' + month + '-' + day;

                // $('#dateControl').attr('min', maxDate);

                // Function to check if a date is in the past
                function isPastDate(dateString) {
                    var currentDate = new Date();
                    var selectedDate = new Date(dateString);
                    currentDate.setHours(0, 0, 0, 0); // Set time to midnight
                    return selectedDate < currentDate;
                }

                // Handle changes in the start date picker
                $("#startDatePicker").on("change", function() {
                    var selectedStartDate = $(this).val();
                    if (isPastDate(selectedStartDate)) {
                        // Display a SweetAlert alert for an invalid start date
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Date',
                            text: 'Please select a future date or today for the start date.',
                        });
                        $(this).val(""); // Clear the input field
                    }
                });

                // Handle changes in the end date picker
                $("#endDatePicker").on("change", function() {
                    var selectedEndDate = $(this).val();
                    if (isPastDate(selectedEndDate)) {
                        // Display a SweetAlert alert for an invalid end date
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Date',
                            text: 'Please select a future date or today for the end date.',
                        });
                        $(this).val(""); // Clear the input field
                    }
                });

            })
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".holiday").click(function(e) {
                    e.preventDefault(e);
                    // Get the record's ID via attribute  
                    var iid = $(this).attr('data-id');
                    $('#holidayform').trigger("reset");
                    $('#holysmodel').modal('show');
                    $.ajax({
                        url: 'Holidaybyib?id=' + iid,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function(response) {
                        console.log(response);
                        // Populate the form fields with the data returned from server
                        $('#holidayform').find('[name="id"]').val(response.holidayvalue.id).end();
                        $('#holidayform').find('[name="holiname"]').val(response.holidayvalue.holiday_name).end();
                        $('#holidayform').find('[name="startdate"]').val(response.holidayvalue.from_date).end();
                        $('#holidayform').find('[name="enddate"]').val(response.holidayvalue.to_date).end();
                        $('#holidayform').find('[name="nofdate"]').val(response.holidayvalue.number_of_days).end();
                        $('#holidayform').find('[name="year"]').val(response.holidayvalue.year).end();
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".holidelet").click(function(e) {
                    e.preventDefault(e);
                    // Get the record's ID via attribute  
                    var iid = $(this).attr('data-id');
                    $.ajax({
                        url: 'HOLIvalueDelet?id=' + iid,
                        method: 'GET',
                        data: 'data',
                    }).done(function(response) {
                        console.log(response);
                        $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
                        window.setTimeout(function() {
                            location.reload()
                        }, 2000)
                        // Populate the form fields with the data returned from server

                    });
                });
            });
        </script>
        <?php $this->load->view('backend/footer'); ?>