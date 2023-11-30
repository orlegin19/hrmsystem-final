<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-bars" aria-hidden="true" style="color:maroon"></i> Payroll</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><i aria-hidden="true"></i> Payroll</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <!--<button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#TypeModal" data-whatever="@getbootstrap" class="text-white TypeModal"><i class="" aria-hidden="true"></i> Add Payroll </a></button>-->
                <!--<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>Payroll/Generate_salary" class="text-white"><i class="" aria-hidden="true"></i> Generate Payroll</a></button>-->
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"><i class="fa fa-hourglass-start" aria-hidden="true"></i> Payroll List
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="hide">SL </th>
                                        <th>PIN </th>
                                        <th>Employee </th>
                                        <th>Month </th>
                                        <th>Salary </th>
                                        <!--<th>Loan </th>-->
                                        <th>Hours </th>
                                        <th>Deduction</th>
                                        <th>Total Paid</th>
                                        <th>Pay Date</th>
                                        <th>Status</th>
                                        <th class="jsgrid-align-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 0;
                                    foreach ($salary_info as $individual_info) : ?>
                                        <tr>
                                            <td class="hide"><?php $i++;
                                                                echo $i; ?></td>
                                            <td><?php echo $individual_info->em_code; ?></td>
                                            <td><?php echo $individual_info->first_name . ' ' . $individual_info->last_name; ?></td>
                                            <td><?php echo $individual_info->month . ' ' . $individual_info->year; ?></td>
                                            <td><?php echo '₱ ' . number_format($individual_info->basic, 2); ?></td>
                                            <!--<td><?php echo 'Php' . number_format($individual_info->loan, 2); ?></td>-->
                                            <td><?php echo $individual_info->total_days; ?></td>
                                            <!--<td><?php echo $individual_info->addition; ?></td>-->
                                            <td><?php echo '₱ ' . number_format($individual_info->diduction, 2); ?></td>
                                            <td><?php echo '₱ ' . number_format($individual_info->total_pay, 2); ?></td>
                                            <td><?php echo $individual_info->paid_date; ?></td>
                                            <td><?php echo $individual_info->status; ?></td>
                                            <td class="jsgrid-align-center ">
                                                <!--<a data-toggle="modal" data-target="#Salarymodel" data-whatever="@getbootstrap" class="btn btn-sm btn-primary waves-effect waves-light" title="Edit"><i class="fa fa-pencil-square-o"></i></a>-->
                                                <a href="<?php echo base_url(); ?>payroll/invoice?Id=<?php echo $individual_info->pay_id; ?>&em=<?php echo $individual_info->emp_id; ?>" data-id="<?php echo $individual_info->emp_id; ?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light SalarylistModal" id="generatePayrollModal"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="<?php echo base_url(); ?>payroll/invoice?Id=<?php echo $individual_info->pay_id; ?>&em=<?php echo $individual_info->emp_id; ?>" title="Print" class="btn btn-sm btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <a href="DeletPayroll?D=<?php echo $individual_info->pay_id; ?>" onclick="confirm('Are you sure to delete this value?')" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
        <div class="modal fade" id="Salarymodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Salary</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="Update_Salary1" id="salaryform" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row" style="display:none">
                                <label class="control-label text-left col-md-5">
                                </label>
                                <div class="col-md-7">
                                    <input type="hidden" name="hrate" class="form-control hrate" id="hrate" value=''>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Employee PIN</label>
                                <input type="text" name="emid" class="form-control" id="recipient-name1" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Basic Salary</label>
                                <input type="text" name="basic" class="form-control" id="recipient-name1" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hours Worked</label>
                                <input type="text" name="hours_worked" class="form-control hours_worked" id="" value="" readonly>
                                <!-- <span>Work Without Pay:</span><span class="wpay"></span> <span>hrs</span> -->
                            </div>
                            <!--<div class="form-group">
                                <label class="control-label">Deduction</label>
                                <input type="text" name="deduction" class="form-control deduction" id="" value="" readonly>
                            </div>-->
                            <div class="form-group">
                                <label class="control-label">Total Paid</label>
                                <input type="text" name="total_paid" class="form-control total_paid" id="" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pay Date</label>
                                <input type="text" name="paydate" class="form-control mydatetimepickerFull" id="" value="" required>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-left col-md-5">Status</label><br>
                                <div class="col-md-7">
                                    <input name="status" type="radio" id="radio_1" data-value="Paid" class="duration" value="Paid" checked="checked">
                                    <label for="radio_1">Paid</label>
                                    <input name="status" type="radio" id="radio_2" data-value="Process" class="type" value="Process">
                                    <!--<label for="radio_2">Process</label>-->
                                </div>
                            </div>
                            <input type="hidden" name="sid" value="" class="form-control" id="recipient-name1">
                            <input type="hidden" name="aid" value="" class="form-control" id="recipient-name1">
                            <input type="hidden" name="did" value="" class="form-control" id="recipient-name1">
                            <input type="hidden" name="em_code" value="" class="form-control" id="recipient-name1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {

                $(".SalarylistModal").click(function(e) {
                    e.preventDefault(e);
                    // Get the record's ID via attribute  
                    var iid = $(this).attr('data-id');
                    console.log(iid)
                    $('#salaryform').trigger("reset");
                    $('#Salarymodel').modal('show');
                    $.ajax({
                        url: 'GetSallaryById?id=' + iid,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function(response) {
                        console.log(response);
                        // Populate the form fields with the data returned from server
                        $('#salaryform').find('[name="sid"]').val(response.paysalaryvalue.pay_id).end();
                        $('#salaryform').find('[name="aid"]').val(response.paysalaryvalue.addi_id).end();
                        $('#salaryform').find('[name="did"]').val(response.paysalaryvalue.de_id).end();
                        /* $('#salaryform').find('[name="typeid"]').val(response.salaryvalue.type_id).end();*/
                        $('#salaryform').find('[name="emid"]').val(response.paysalaryvalue.emp_id).end();
                        $('#salaryform').find('[name="basic"]').val(response.paysalaryvalue.basic).end();
                        $('#salaryform').find('[name="hours_worked"]').val(response.paysalaryvalue.total_days).end();
                        $('#salaryform').find('[name="deduction"]').val(response.paysalaryvalue.diduction).end();
                        $('#salaryform').find('[name="total_paid"]').val(response.paysalaryvalue.total_pay).end();
                        $('#salaryform').find('[name="paydate"]').val(response.paysalaryvalue.paid_date).end();
                        $('#salaryform').find('[name="provident"]').val(response.paysalaryvalue.provident_fund).end();
                        $('#salaryform').find('[name="bima"]').val(response.paysalaryvalue.bima).end();
                        $('#salaryform').find('[name="tax"]').val(response.paysalaryvalue.tax).end();
                        $('#salaryform').find('[name="others"]').val(response.paysalaryvalue.others).end();
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                /*var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();

                if(dd<10) {
                    dd = '0'+dd
                } 

                if(mm<10) {
                    mm = '0'+mm
                } 

                today = mm + '/' + dd + '/' + yyyy;*/
                var d = new Date();
                var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var m = months[d.getMonth()];
                var y = d.getFullYear();
                //document.write(today);    
                var table = $('#example123').DataTable({
                    "aaSorting": [
                        [9, 'desc']
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'print',
                        title: 'Salary List' + '<br>' + m + ' ' + y,
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '50pt')
                                .prepend(
                                    '<img src="<?php echo base_url() ?>assets/images/wtmark.png" style="position:absolute;background-size:300px 300px; top:35%; left:27%;" />'
                                );
                            $(win.document.body)
                                //.css( 'border', 'inherit' )
                                .prepend(
                                    '<footer class="footer" style="border:inherit"><img src="<?php echo base_url(); ?>assets/images/signature_vice.png" style="position:absolute; top:0; left:0;" /><img src="<?php echo base_url(); ?>assets/images/signature_ceo.png" style="position:absolute; top:0; right:0;height:30px;" /></footer>'
                                );
                            $(win.document.body).find('h1')
                                .addClass('header')
                                .css('display', 'inharit')
                                .css('position', 'relative')
                                .css('float', 'right')
                                .css('font-size', '24px')
                                .css('font-weight', '700')
                                .css('margin-right', '15px');
                            $(win.document.body).find('div')
                                .addClass('header-top')
                                .css('background-position', 'left top')
                                .css('height', '100px')
                                .prepend(
                                    '<img src="<?php echo base_url() ?>assets/images/four.JPG" style="position:absolute;background-size:30%; width:50px; height:80px; top:0; left:0;" />'
                                );
                            $(win.document.body).find('div img')
                                .addClass('header-img')
                                .css('width', '300px');
                            $(win.document.body).find('h1')
                                .addClass('header')
                                .css('font-size', '25px');

                            $(win.document.body).find('table thead')
                                .addClass('compact')
                                .css({
                                    color: '#000',
                                    margin: '20px',
                                    background: '#e8e8e8',

                                });

                            $(win.document.body).find('table thead th')
                                .addClass('compact')
                                .css({
                                    color: '#000',
                                    border: '1px solid #000',
                                    padding: '15px 12px',
                                    width: '8%'
                                });

                            $(win.document.body).find('table tr td')
                                .addClass('compact')
                                .css({
                                    color: '#000',
                                    margin: '20px',
                                    border: '1px solid #000'

                                });

                            $(win.document.body).find('table thead th:nth-child(3)')
                                .addClass('compact')
                                .css({
                                    width: '15%',
                                });

                            $(win.document.body).find('table thead th:nth-child(1)')
                                .addClass('compact')
                                .css({
                                    width: '1%',
                                });

                            $(win.document.body).find('table thead th:nth-child(2)')
                                .addClass('compact')
                                .css({
                                    width: '5%',
                                });

                            $(win.document.body).find('table thead th:last-child')
                                .addClass('compact')
                                .css({
                                    display: 'none',

                                });

                            $(win.document.body).find('table tr td:last-child')
                                .addClass('compact')
                                .css({
                                    display: 'none',

                                });
                        }
                    }]
                });
                /*$("#example123 tfoot th").each( function ( i ) {
                		
                		if ($(this).text() !== '') {
                	        var isStatusColumn = (($(this).text() == 'Status') ? true : false);
                			var select = $('<select><option value=""></option></select>')
                	            .appendTo( $(this).empty() )
                	            .on( 'change', function () {
                	                var val = $(this).val();
                					
                	                table.column( i )
                	                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
                	                    .draw();
                	            } );
                	 		
                			// Get the Status values a specific way since the status is a anchor/image
                			if (isStatusColumn) {
                				var statusItems = [];
                				
                                /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### 
                				table.column( i ).nodes().to$().each( function(d, j){
                					var thisStatus = $(j).attr("data-filter");
                					if($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
                				} );
                				
                				statusItems.sort();
                								
                				$.each( statusItems, function(i, item){
                				    select.append( '<option value="'+item+'">'+item+'</option>' );
                				});

                			}
                            // All other non-Status columns (like the example)
                			else {
                				table.column( i ).data().unique().sort().each( function ( d, j ) {  
                					select.append( '<option value="'+d+'">'+d+'</option>' );
                		        } );	
                			}
                	        
                		}
                    } );*/

            });
        </script>
        <?php $this->load->view('backend/footer'); ?>
        <script>
            $('#salary123').DataTable({
                "aaSorting": [
                    [10, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel', 'print'
                ]
            });
        </script>
        <!-- <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('keyup', '.hours_worked', function() {
                    var finalsalary = 0;
                    //var total;  
                    var deduction = 0;
                    var rows = this.closest('#generatePayrollForm div');

                    var hrate = parseFloat($('.hrate').val());
                    var final = parseFloat($('.total_paid').val());
                    var loan = parseFloat($('.loan').val());
                    var hwork = parseFloat($('.hours_worked').val());
                    var thour = parseFloat($('.thour').val());

                    finalsalary = (hwork * hrate) - loan;
                    $(".total_paid").val(finalsalary.toFixed(2));
                    var total = thour - hwork;
                    var deduction = (total * hrate) + loan;
                    $(".diduction").val(deduction.toFixed(2));
                    $(".wpay").html(total.toFixed(2));

                    console.log(loan);
                    // var returnval;
                    //returnval = payval - payableval;
                    /*            if(returnval<=0){
                                      $(".due").val(Math.abs(returnval).toFixed(2));
                                  }else if(returnval > 0){
                                     $(".due").val(''); 
                                  }
                                  $(".return").val(returnval.toFixed(2));*/

                });
            });
        </script> -->
        <script type="text/javascript">
            // Populate salary data on generate salary click
            $(document).ready(function() {

                $(document).on('click', ".salaryGenerateModal", function(e) {
                    e.preventDefault(e);

                    $('#generatePayrollModal').modal('show');

                    var emid = $(this).data('id');
                    var month = $(this).data('month');
                    var year = $(this).data('year');
                    var has_loan = $(this).data('has_loan');

                    console.log(has_loan);

                    $('#generatePayrollForm').find('[name="emid"]').val(emid).attr('readonly', true).end();
                    $('#generatePayrollForm').find('[name="month"]').val(Math.abs(month)).attr('readonly', true).end();

                    $.ajax({
                        url: 'generate_payroll_for_each_employee?month=' + month + '&year=' + year + '&employeeID=' + emid,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function(response) {
                        console.log(response);

                        if (response.addition == 0) {
                            $('#generatePayrollForm').find('[id="addition"]').val('').hide().end();
                        }
                        if (response.diduction == 0) {
                            $('#generatePayrollForm').find('[id="diduction"]').val('').hide().end();
                        }
                        if (response.loan == 0) {
                            $('#generatePayrollForm').find('[id="loan"]').val('').hide().end();
                        }

                        $('#generatePayrollForm').find('[name="basic"]').val(response.basic_salary).attr('readonly', true).end();
                        $('#generatePayrollForm').find('[name="month_work_hours"]').val(response.total_work_hours).attr('readonly', true).end();
                        $('#generatePayrollForm').find('[name="hours_worked"]').val(response.employee_actually_worked).end();

                        $('#generatePayrollForm').find('[name="addition"]').val(response.addition).end();
                        $('#generatePayrollForm').find('[name="diduction"]').val(response.diduction).end();
                        $('#generatePayrollForm').find('[class="wpay"]').html(response.wpay).end();
                        $('#generatePayrollForm').find('[name="loan"]').val(response.loan_amount).prop('readonly', true).end();
                        $('#generatePayrollForm').find('[name="loan_id"]').val(response.loan_id).end();
                        $('#generatePayrollForm').find('[name="total_paid"]').val(response.final_salary).end();
                        $('#generatePayrollForm').find('[name="year"]').val(year).end();
                        $('#generatePayrollForm').find('[name="hrate"]').val(response.rate).end();
                    });
                });
            });
        </script>