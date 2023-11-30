<?php session_start(); ?>
<?php include 'header.php'; ?>
<style>
  .hero-image {
  background-image: url("../assets/images/background/fjbg.jpg");
  background-color: #cccccc;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
</style>
<body class="hold-transition login-page hero-image">

<div class="login-box">
      <div id="banner">
         <?php echo '<image src="../assets/images/jam.jpg" width="350px" height="90px" />'; ?>
     </div>
  	<div class="login-logo">
  		<p id="date" class="bold" style="color:white"></p>
      <p id="time" class="bold" style="color:white"></p>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Enter Employee PIN</h4>

    	<form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">AM Time In</option>
              <option value="out">PM Time Out</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-12">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin" ><i class="fa fa-sign-in"></i> Enter</button>
        		</div>
      		</div>
</br>
          <div class="row">
    			<div class="col-xs-"8>
            <a href="attendance/Attendance">
          			<button type="button"  class="btn btn-primary btn-block btn-flat">Back to Login</button>
          </a>
        		</div>
      		</div>
    	</form>
  	</div>
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span id="divmessage" class="result"><i class="icon fa fa-check"></i> <span id="message" class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span id="divmessage" class="result"><i class="icon fa fa-warning"></i> <span  class="message"></span></span>
    </div>
  	
</div>

<?php include 'scripts.php' ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
 
$(function() {
 var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message).close();
                       
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message).close();
          $('#employee').val('');
          
        }
      }
    });
  });
  
    
});
</script>

</body>
</html>