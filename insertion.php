<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bank</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
</head>
<body  bgcolor="#A9A9A9">
<div class="container-fluid text-center">
  <h1 align="center" style="font-size:30px; color:black; align:center;">B A N K</h1>
      <br><br>
	<div class="jumbotron">
		<br><br>
	  <br><br>
	  <a href =#emp_deets><h2>Add new employee</h2></a>     
	  <br><br>

	  <a href =#cust_deets><h2>Add new customer</h2></a>  
	  <br><br>
    </div>
	  <br><br>
	  <br><br>
	  <br><br>
	  <br><br>
	  <br><br>
	  <br><br>
	  <br><br>
	  
      

      
      <div id = "emp_deets" class="jumbotron">
        <br><br>
        <h2>Add new Employee</h2>
      <br><br>
      	<form name ="add_emp" action ="insertion.php" method="POST">
      	<label for="cfn" style="font-size:20px; color:black;"><b>Employee First Name</b></label>
      	<br>
      	<input type="text" placeholder="Enter first name" name="empfname" required>
      	<br><br>
      	<label for="cln" style="font-size:20px; color:black;"><b>Employee Last Name</b></label>
      	<br>
      	<input type="text" placeholder="Enter last name" name="emplname" required>
      	<br><br>
      	<br><br>
      	<input type="submit" name="submit_emp" class="btn" value="Save employee Details" />
      	<br><br>
      	<br><br>
            </div>

  </form> 
	  <br><br><br><br>
	  <br><br><br><br>
	  <br><br><br><br>
	  <br><br><br><br>
	  <br><br>
   

<?php 
    $host='localhost';
    $db = 'bankdb';
    $username = 'postgres';
    $password = 'postgres';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
    $conn = new PDO($dsn);
  
    function get_emp_id()
    {
    	$rand="";
    	for($i =1 ;$i<=3 ; $i++)
    	{
    		$rand.= mt_rand(0,9);
    	}
    	return $rand;
    }
    if($conn)
    {
       if(isset($_POST['submit_emp']))
       {
       	$emp_id = get_emp_id();
       	array_push($emp_ids, $emp_id);
       	$emp_fname = $_POST['empfname'];
       	$emp_lname = $_POST['emplname'];
       	//$city = $_POST[pick];
       	//$str = $_POST[empstr];
       	//$emp_id = "9999";
       	//$acc_fkey = "0000000000";

       	$insert_emp = 
       	"INSERT INTO employee( employee_id, employee_fname, employee_lname)
       	VALUES ('" . $emp_id . "',  '" . $emp_fname . "', '" . $emp_lname . "');";
       	//, '" . $city . "', '" . $str . "', '" . $emp_id . "', '" . $acc_fkey . "');";
       	$res = $conn->prepare($insert_emp);
       	$res->execute();
       	$res = null;
        echo("<p>Employee Details have been saved</p>");
        /*$sql1= "SELECT * FROM EMPLOYEE;";
      $stmt = $conn->query($sql1);
      echo"<table border='1'class='table table-striped'>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
       
        echo"<tr><th>Employee name</th><td>{$row['employee_fname']}</td><td>{$row['employee_lname']}</td></tr>";
        echo"<tr><th>Account Number</th><td colspan='2'>{$row['employee_id']}</td></tr>";
       

        echo"</table>";
      

      endwhile;*/

    	}
    }
?>


      <div id = "cust_deets" class="jumbotron">
<br><br>
         <h2>Add new Customer</h2>
      <br><br>
      	<form name ="add_cust" action ="insertion.php" method="POST">
      	<!--<label for="cfn" style="font-size:20px; color:black;"><b>Employee ID of employee in-charge</b></label>
      	<br>
      	<input type="text" placeholder="Enter employee ID" name="empid" required>
      	Let the employee ID be randomly selected from an array of existing employee IDs-->
      	
      	<label for="cfn" style="font-size:20px; color:black;"><b>Customer First Name</b></label>
      	<br>
      	<input type="text" placeholder="Enter first name" name="custfname" required>
      	<br><br>
      	<label for="cln" style="font-size:20px; color:black;"><b>Customer Last Name</b></label>
      	<br>
      	<input type="text" placeholder="Enter last name" name="custlname" required>
      	<br><br>
	<label for="cfn" style="font-size:20px; color:black;"><b>Choose a City</b></label>      	
	<br>
 		 <select class="form-control" id="cust_city" name="city">
		    <option value="Bangalore" name="chooser">Bangalore</option>
		    <option value="Mysore" name="chooser">Mysore</option>
		    <option value="Mangalore" name="chooser">Mangalore</option>
		    <option value="Hubli" name="chooser">Hubli</option>
  		</select>
  		<br><br>
  		<label for="cln" style="font-size:20px; color:black;"><b>Enter address(street name)</b></label>
  		<br>
      	<input type="text" placeholder="Enter street" name="custstr" required>
      	<br><br>
      	
      	<label for="cfn" style="font-size:20px; color:black;"><b>Choose an Account Type</b></label>      	
	<br>
 		 <select class="form-control" id="cust_acc" name="acc">
		    <option value="Fixed Deposit" name="chooser">Fixed Deposit</option>
		    <option value="Savings" name="chooser">Savings</option>
		    <option value="Recurring Deposit" name="chooser">Recurring Deposit</option>
  		</select>
  		<br><br>

  		<label for="cln" style="font-size:20px; color:black;"><b>Enter Account Balance</b></label>
  		<br>
      	<input type="number" placeholder="Enter balance" name="acc_bal" required>
      	<br><br>

  		<input type="submit" name="submit_cust" class="btn" value="Save Customer Details" />
      	<br><br>
      </div>
      
      <br><br>
      <div id = "dv1">
      </div>
 


  </form> 
<?php 


	function choose_emp_id()
	    {
         $emp_ids =array("131", "265", "266","397", "988", "403", "124", "111", "144", "132", "121", "996", "699", "500", "600");
	    	
	    	$rand = mt_rand(0, 14);
	    	$emp = $emp_ids[$rand];
	    	return $emp;
	    }

	function get_acc_no()
	{
		$rand="";
    	for($i =1 ;$i<=10 ; $i++)
    	{
    		$rand.= mt_rand(0,9);
    	}
    	return $rand;
	}

	function get_cust_id()
	{
		$rand="";
    	for($i =1 ;$i<=5 ; $i++)
    	{
    		$rand.= mt_rand(0,9);
    	}
    	return $rand;
	}

	if(isset($_POST['submit_cust']))
       {
       	$chosen_emp = choose_emp_id();
       	$cust_fname = $_POST['custfname'];


       	$cust_lname = $_POST['custlname'];
       	$city = $_POST['city'];
        
       	$str = $_POST['custstr'];
       	$acc_fkey = get_acc_no();
       	$acc_type = $_POST['acc'];
       	$acc_bal = $_POST['acc_bal'];
       	$cust_id = get_cust_id();

       	$insert_acc = 
       	"INSERT INTO account( account_number, balance, account_type)
       	VALUES ('" . $acc_fkey . "',  '$acc_bal', '" . $acc_type . "');";
       	$res = $conn->prepare($insert_acc);
       	$res->execute();


       	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


       	$insert_cust = "INSERT INTO CUSTOMER(cust_id, cust_fname, cust_lname, cust_city, cust_street, employee_id_customer_fkey, account_number_customer_fkey) 
        VALUES('" . $cust_id . "',  ' " . $cust_fname . "', '" . $cust_lname . "', '". $city . "',  ' " . $str . " ', '" . $chosen_emp . "',  ' " . $acc_fkey . "');";
        
       	$res1 = $conn->prepare($insert_cust);
        echo "<br><br>";
        
       	$val = $res1->execute();
       	$getEmpName = "SELECT employee_fname, employee_lname FROM EMPLOYEE WHERE employee_id='" . $chosen_emp . "';";
       	$emp_names = $conn->query($getEmpName);

       	

	       	echo "<h3> Welcome to People's Bank: <strong>$cust_fname</strong>. Enjoy your service under </h3>";
		while($row = $emp_names->fetch(PDO::FETCH_ASSOC)):
		        echo "<h3> <strong>".$row['employee_fname'].$row['employee_lname'] ."</strong></h3>";
		endwhile;
       }


?>
</body>
</html>