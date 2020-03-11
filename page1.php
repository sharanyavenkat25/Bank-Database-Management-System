<!DOCTYPE html>
<html>
<head>
	<title>bank</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" id="details">
<div class="jumbotron">
	<br><br>
      <h1 style="font-size:30px; color:black; text-align: center;">PEOPLE'S BANK</h1>
      <br><br>
  <?php 
    $host='localhost';
    $db = 'bankdb';
    $username = 'postgres';
    $password = 'postgres';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
    $conn = new PDO($dsn);
    if($conn){
      	 echo "Connected to the <strong>$db</strong> database successfully!";
        echo "<br>";
          }
         ?>    
</div>
</div>
<div class="container">
  <button type="button" class="btn btn-success btn-block" onclick=window.location.replace("#lol3")>
 View Branch Performances </button>
   <p>
</p> 
 
</div>
<div class="container">
  <button type="button" class="btn btn-primary btn-block" onclick=window.location.replace("#lol4")>
 Lucky Draw For Employees! </button>
   <p>
</p> 
 
</div>
<div class="container">
  <button type="button" class="btn btn-success btn-block" onclick=window.location.replace("#lol5")>
Checkout Last Payments Made By Customers</button>
   <p>
</p> 
</div>

</div>
<div class="container">
  <button type="button" class="btn btn-primary btn-block" onclick=window.location.replace("#lol6")>
Elite Customers</button>
   <p>
</p> 
</div>

<div class="container">
<div id="lol3" align="center" class="jumbotron">

<?php

	$sql1="SELECT branch_name, ROUND(avg(balance)) AS avg_balance
	FROM BRANCH 
	JOIN ACCOUNT ON account_number_branch_fkey=account_number
	GROUP BY branch_name
	ORDER BY avg_balance DESC;";
	$stmt = $conn->query($sql1);
	echo("<p>HIGHEST AVERAGE BALANCE OF EACH BRANCH</p>");
	echo"<table border='1' class='table table-striped'>";
	echo("<tr><th>Branch Name</th><th>Average balance</th></tr>");
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
          /*echo $row['branch_name']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
          echo $row['avg_balance']."<br>";*/
          echo"<tr><td>{$row['branch_name']}</td><td>{$row['avg_balance']}</td></tr>";
          endwhile;
          echo"</table>"; 
          echo("<br><br>");
     $sql2="SELECT branch_name, ROUND(avg(balance)) as maximum_average
			FROM BRANCH JOIN ACCOUNT ON account_number_branch_fkey=account_number
			GROUP BY branch_name
			HAVING avg(balance) = 
			(SELECT  max(x.avg) as maximum_average FROM 
			(SELECT avg(balance) FROM 
			BRANCH JOIN ACCOUNT ON account_number_branch_fkey=account_number
			GROUP BY branch_name)x);";
	$stmt1 = $conn->query($sql2);
	echo("<p>BRANCH WITH HIGHEST AVERAGE BALANCE</p>");
	echo"<table class='table table-striped'>";
	
	while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) :
          /*echo $row['branch_name']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
          echo $row['avg_balance']."<br>";*/
          echo"<tr><td>{$row['branch_name']}</td><td>{$row['maximum_average']}</td></tr>";
          endwhile;
          echo"</table>"; 
          echo("<br><br>");
echo("<p>TOTAL BALANCE OF EACH BRANCH</p>");
     $sql3="SELECT branch_name, sum(balance) as t_balance
 			FROM ACCOUNT JOIN BRANCH ON account_number_branch_fkey=account_number
 			GROUP BY branch_name
 			ORDER BY t_balance DESC;";
 	$stmt2 = $conn->query($sql3);
	echo"<table border='1' class='table table-striped'>";
	echo("<tr><th>Branch Name</th><th>Total Balance</th></tr>");
	
	while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) :
          /*echo $row['branch_name']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
          echo $row['avg_balance']."<br>";*/
          echo"<tr><td>{$row['branch_name']}</td><td>{$row['t_balance']}</td></tr>";
          endwhile;
          echo"</table>"; 





?>



</div>
</div>

<div class="container">
<div id="lol4" align="center" class="jumbotron">
	<?php $sql1="SELECT employee_fname,employee_lname, cust_fname, cust_lname 
	FROM EMPLOYEE JOIN CUSTOMER ON employee_id=employee_id_customer_fkey
	WHERE cust_fname LIKE'%k'";
	$stmt = $conn->query($sql1);
	echo("<h4>This months Lucky draw includes all employees who have customers whose first name ends with k!</h4>");
	echo"<table border='1' class='table table-striped'>";
	echo("<tr><th colspan='2'>Employee Name</th><th colspan='2'>customer name</th></tr>");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
          
          echo"<tr><td>{$row['employee_fname']}</td><td>{$row['employee_lname']}</td><td>{$row['cust_fname']}</td><td>{$row['cust_lname']}</td>";
          endwhile;
           echo"</table>"; 
         ?>
</div>
</div>

<div class="container">
<div id="lol5" align="center" class="jumbotron">
	<?php 
	$sql1="SELECT C.cust_fname, C.cust_lname, C.cust_id, payment_date,branch_name
	FROM 
	((((CUSTOMER as C JOIN borrows as B ON C.cust_id=B.cust_id) 
	JOIN LOAN as L ON L.loan_id=B.loan_id) 
	JOIN PAYMENT ON loan_id_payment_fkey=L.loan_id)
	JOIN BRANCH  ON loan_id_branch_fkey=L.loan_id)
	WHERE payment_date > '2018-12-31'
	ORDER BY payment_date;";
	$stmt = $conn->query($sql1);
	echo("<h4>CUSTOMERS WHO HAVE MADE PAYMENTS AFTER 2018-12-31 </h4>");
	echo"<table border='1' class='table table-striped'>";
	echo("<tr><th colspan='2'>customer name</th><th>customer ID</th><th>Last Payment date</th><th>Branch name</th></tr>");
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
		
    	echo"<tr><td>{$row['cust_fname']}</td><td>{$row['cust_lname']}</td><td>{$row['cust_id']}</td><td>{$row['payment_date']}</td>
    	<td>{$row['branch_name']}</td>";
          
         endwhile;
         
       echo"</table>"; 
         ?>


</div>
</div>

<div class="container">
<div id="lol6" align="center" class="jumbotron">
	<form method="post">
	<select class="form-control" id="sel1" name="pick">
    <option value="loan_amount" name="chooser">Loan Amount</option>
    <option value="balance" name="chooser">Bank Balance</option>
	<input type="submit" class="btn" name="order" value="Sort By" />

</select>


	</form>
	<?php 
	if(isset($_POST['order'])) 
	{
	$getval=$_POST['pick'];
	//echo($getval);
}
	$sql="SELECT credit_card_number, cust_fname, cust_lname, cust_id, loan_amount, balance
		FROM ((
			(CREDIT_CARD JOIN ACCOUNT ON 
account_number_cc_fkey = account_number) 
			JOIN BRANCH ON account_number_branch_fkey=account_number
		) 
			JOIN LOAN ON loan_id_branch_fkey=loan_id )
			ACCOUNT JOIN CUSTOMER ON account_number=account_number_customer_fkey
 		WHERE loan_amount < 1500000 AND balance > 300000
		ORDER BY ".$getval.";";
 		$stmt = $conn->query($sql);
 	echo "<h4>  OUR ELITE CUSTOMERS</h4>";
 	echo "<br><br>";
	echo("<p>The following customers have an account balance of 3,00,000 rupees and loan amounts lesser than 15,00,000 rupees:</p>");
	echo"<table border='1' class='table table-striped'>";
	echo("<tr><th>Customer Id</th><th colspan='2'>customer name</th><th>Credit card Number</th><th>Loan amount</th><th>Balance</th></tr>");

	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
		
    	echo"<tr><td>{$row['cust_id']}</td><td>{$row['cust_fname']}</td><td>{$row['cust_lname']}</td><td>{$row['credit_card_number']}</td>
    	<td>{$row['loan_amount']}</td><td>{$row['balance']}</td>";
          
         endwhile;
         
       echo"</table>"; 

         ?>


</body>
</html>