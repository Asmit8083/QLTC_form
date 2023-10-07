
<?php
session_start();
require_once('dbconnection.php');

$get_form_number=mysqli_query($conn,"SELECT one FROM form ORDER BY one DESC LIMIT 1");
	
	/* declaration of variable */
    date_default_timezone_set("Asia/Kolkata");
	$date_=date("Y-m-d");
	$two_="";
	$three_="";
	$four_="";
	$six_="";
	$seven_="";
	$eight_="";
	$nine_="";
	$ten_="";
		
	
if (isset($_GET['one'])) {
	// Now, $one_ contains the value of 'one' passed via the GET request.
    $one_ = $_GET['one'];
	$button1 = 'save_update_stay';
	$button2 = 'update_save_exit';
	$button3 = 'update_submit_exit';
	
	$fetch_query="SELECT * FROM form where one=$one_";
	$fire_fetch_query= mysqli_query($conn,$fetch_query);
	$data=mysqli_fetch_array($fire_fetch_query);
	
	$date_=$data['date'];
	$two_=$data['two'];
	$three_=$data['three'];
	$four_=$data['four'];
	$six_=$data['six'];
	$seven_=$data['seven'];
	$eight_=$data['eight'];
	$nine_=$data['nine'];
	$ten_=$data['ten'];
	
} else {
	$one_= mysqli_fetch_assoc($get_form_number)['one'] + 1;
	$button1 = 'save_first_time';
	$button2 = 'save_insert_exit';
	$button3 = 'insert_submit_exit';
}


if(isset($_POST['save_update_stay']) ||isset($_POST['update_save_exit']) || isset($_POST['update_submit_exit']) || isset($_POST['save_first_time']) || isset($_POST['save_insert_exit']) || isset($_POST['insert_submit_exit'])){
	

	$date=$_POST['date'];
	$two=$_POST['two'];
	$three=$_POST['three'];
	$four=$_POST['four'];
	$six=$_POST['six'];
	$seven=$_POST['seven'];
	$eight=$_POST['eight'];
	$nine=$_POST['nine'];
	$ten=$_POST['ten']; 

if(isset($_POST['save_first_time'])) {
	
	/* if data not present in db then insert query and show them in the value of input */
	$insert_query= "INSERT INTO form(date,one,two,three,four,six,seven,eight,nine,ten,draft) VALUES('".$date."','".$one_."','".$two."','".$three."','".$four."','".$six."','".$seven."','".$eight."','".$nine."','".$ten."',1)";
	$fire_insert_query = mysqli_query($conn,$insert_query);
	$redirect_url = "table.php?one=" . urlencode($one_);
	echo $redirect_url ;
	header("Location: " . $redirect_url);
}

 if(isset($_POST['save_update_stay'])){

	$update_query="UPDATE form SET date='$date',two='$two',three='$three',four='$four',six='$six',seven='$seven',eight='$eight',nine='$nine',ten='$ten',draft='1' WHERE one=$one_";
	$fire_update_query= mysqli_query($conn,$update_query);
	$redirect_url = "table.php?one=" . urlencode($one_);
	echo $redirect_url ;
	header("Location: " . $redirect_url);
 } 

if(isset($_POST['save_insert_exit'])){
		$insert_query= "INSERT INTO form(date,one,two,three,four,six,seven,eight,nine,ten,draft) VALUES('".$date."','".$one_."','".$two."','".$three."','".$four."','".$six."','".$seven."','".$eight."','".$nine."','".$ten."',1)";
		$fire_insert_query = mysqli_query($conn,$insert_query);
		header("Location: formReport.php");
	}

if(isset($_POST['update_save_exit'])){
		$update_query="UPDATE form SET date='$date',two='$two',three='$three',four='$four',six='$six',seven='$seven',eight='$eight',nine='$nine',ten='$ten',draft='1' WHERE one=$one_";
		$fire_update_query= mysqli_query($conn,$update_query);
		header("Location: formReport.php");
	}
	
if(isset($_POST['insert_submit_exit'])){
		$insert_query= "INSERT INTO form(date,one,two,three,four,six,seven,eight,nine,ten,draft) VALUES('".$date."','".$one_."','".$two."','".$three."','".$four."','".$six."','".$seven."','".$eight."','".$nine."','".$ten."',0)";
	   $fire_insert_query = mysqli_query($conn,$insert_query);
	 header("Location: formReport.php");
	}
	 
if(isset($_POST['update_submit_exit'])){
		$update_query="UPDATE form SET date='$date',two='$two',three='$three',four='$four',six='$six',seven='$seven',eight='$eight',nine='$nine',ten='$ten',draft='0' WHERE one=$one_";
		$fire_update_query= mysqli_query($conn,$update_query);
		header("Location: formReport.php");
	}

 
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
<title>Table</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body{
	background-color:#C1D8C3;
}
.modal-form{
	padding:50px 200px;
}
table, th, td {
  border: 1px solid black;
}
.button-container {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.button-container button {
  flex-grow: 1;
  margin: 0 5px; 
}

</style>
</head>


<body>
<div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
  <div class="modal-content">
	
		
		<div class="modal-header" style="text-align:center;">
		<h2>QLTC Form</h2>
		</div>
		
		<form method="post" autocomplete="off" >
		<div class="modal-body">
		<table class="table" >
		
			<tr >
				<td colspan="1"><label class="col-form-label" >Date:</label></td>
				<td colspan="2"><input type="date" name="date" class="form-control"  value="<?php echo $date_; ?>"  ></td>
				<td colspan="1"><label class="col-form-label"  >Form No:</label></td>
				<td colspan="2"><input type="number" name="one" class="form-control" value="<?php echo $one_; ?>" readonly ></td>
			</tr>
			<tr>
				<td colspan="1"><label  class="col-form-label" >Two:</label></td>
				<td colspan="5"><input type="text" name="two" class="form-control" value="<?php echo $two_; ?>"></td>
			</tr>
			<tr>
				<td colspan="1"><label class="col-form-label" >Three:</label></td>
				<td colspan="2"><input type="text" name="three" class="form-control" value="<?php echo $three_; ?>" ></td>
			
				<td colspan="1"><label class="col-form-label" >Four:</label></td>
				<td colspan="2"><input type="text" name="four" class="form-control" value="<?php echo $four_; ?>" ></td>
			
			</tr>
			<tr>
				<td colspan="1"><label class="col-form-label" >Six:</label></td>
				<td colspan="3"><input type="text" name="six" class="form-control" value="<?php echo $six_; ?>"></td>
			
				<td colspan="1"><label class="col-form-label" >Seven:</label></td>
				<td colspan="1"><input type="text" name="seven" class="form-control" value="<?php echo $seven_; ?>" ></td>
			</tr>
			<tr>
				<td colspan="1"><label class="col-form-label" >Eight:</label></td>
				<td colspan="5"><input type="text" name="eight" class="form-control" value="<?php echo $eight_; ?>"></td>
			</tr>
			<tr>
				<td colspan="1"><label class="col-form-label" >Nine:</label></td>
				<td colspan="2"><input type="text" name="nine" class="form-control" value="<?php echo $nine_; ?>" ></td>
			
				<td colspan="1"><label class="col-form-label" >Ten:</label></td>
				<td colspan="2"><input type="text" name="ten" class="form-control" value="<?php echo $ten_; ?>"></td>
			</tr>
			
		</table>
		</div>
		<div class=" modal-footer button-container">
			<button class="btn btn-primary" type="submit" name="<?php echo $button1; ?>">Save and Continue</button>
			<button class="btn btn-primary" type="submit" name="<?php echo $button2; ?>">Save and Exit</button>
			<button class="btn btn-primary" type="submit" name="<?php echo $button3; ?>">Submit</button>
		</div>
	</form>
	</div>
	</div>
  </div>
	
	<script>
// Use JavaScript to open the modal on page load
$(document).ready(function() {
    $('#myModal').modal('show');
});
</script>
</body>

</html>