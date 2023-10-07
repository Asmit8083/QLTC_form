<head>
    <style>
        .container {
            max-width: 600px; 
            margin: 0 auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
            background-color: #fff; 
        }

       
        .container table {
            width: 100%; 
            border-collapse: collapse;
        }

        
        .container th {
            background-color: #f2f2f2; 
            text-align: left; 
            padding: 8px; 
        }

        
        .container td {
            padding: 8px; 
            border-bottom: 1px solid #ccc;
        }
		
    .btn-success {
		float:right;
        background-color: #28a745; 
        color: #fff;
		border: none; 
		padding: 10px 20px;
		border-radius: 5px; 
		cursor: pointer; 
		font-weight: bold; 
		text-align: center; 
		text-decoration: none; 
	}


	.btn-success:hover {
		background-color: #218838; 
	}

    </style>

</head>



<body>
<div class="container">

<button class="btn btn-success" onclick="location.href='table.php';" style="margin-bottom:90px" >Create new form</button>
<table>
	<tr>
	<th>DATE</th>
	<th>FORM NUMBER</th>
	</tr>
<?php
require('dbconnection.php');

$query="SELECT * FROM form ORDER BY id DESC";
$fire_query=mysqli_query($conn,$query);

while($data=mysqli_fetch_assoc($fire_query)){
	
	if($data['draft']==1){
		$oneValue = urlencode($data['one']);
		$draft='<a href="table.php?one='.$oneValue.'">'.$oneValue.' - DR4AFT</a>';
	}
	else{
		$draft=$data['one'];
	}
 ?>
	
	
	<tr>
		<td><?php echo $data['date']; ?></td>
		<td><?php echo $draft; ?></td>
		
    </tr>

	
<?php } ?>

</table>

</div>
</body>