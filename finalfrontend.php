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
<body bgcolor="#A9A9A9">

<div class="container">
  <h1 align="center" style="font-size:50px; color:black; align:center;">PEOPLE'S BANK </h1>
  <form name="insert" class="container" method="GET">
      <br><br>
      <h1 style="font-size:30px; color:black;">LOGIN</h1>
      <br><br>

      <label for="id1" style="font-size:15px; color:black;"><b>Customer ID</b></label>
      <input type="text" placeholder="Enter ID" name="custid" value="<?php if(isset($_POST['custid'])){echo $_POST['custid'];} ?>" required>
<input type="submit" class="btn" name="login" value="login"></input>
      
  </form>  
<div class="container" id="details">
<div class="jumbotron">
    <h3 align="center">Customer Details</h3><br>
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
    if (isset($_GET['custid'])) 
      { 
        $cid =$_GET['custid'];
        setcookie('custid', $cid, time()+3600);
        $sql_get_depts = "SELECT * FROM CUSTOMER WHERE cust_id='" . $cid . "';";
        $stmt = $conn->query($sql_get_depts);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
          
          $_GET['cust_fname']=$row['cust_fname'];
          $_GET['cust_lname']=$row['cust_lname'];
          $_GET['cust_street']=$row['cust_street'];
          $_GET['cust_city']=$row['cust_city'];


           endwhile;
        

      }

   
    if(isset($_GET['login']))

   {

      echo("First name: " . $_GET['cust_fname'] . "<br />\n");
      echo("Last name: " . $_GET['cust_lname'] . "<br />\n");
      echo("Address: " . $_GET['cust_street'] . "&nbsp".$_GET['cust_city']."<br />\n");

      $sql_get_phone = "SELECT phone_no FROM MULTIPHONE WHERE Phone_cust_id='" . $cid . "';";
      $stmt1 = $conn->query($sql_get_phone);
      echo("Phone Numbers Linked : ");
      while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) :
          
          echo($row['phone_no']."&nbsp&nbsp");
          endwhile;

   }
   


?> 
<form method="post">
  <input type="text" placeholder="Enter phone Number" name="delphone" required>
  <input type="submit" name="phone" value="Delete Phone Number"></input>

</form> 
<?php
if (isset($_POST['phone'])) 
{
  $phone =$_POST['delphone'];
  $Sql_count="SELECT COUNT(*) AS count FROM MULTIPHONE WHERE Phone_cust_id='" . $cid . "';";
  $stmt_count= $conn->query($Sql_count);
while($row = $stmt_count->fetch(PDO::FETCH_ASSOC)):
        $count =$row['count'];
endwhile;
if($count>1)
{
  
  $del="DELETE FROM MULTIPHONE WHERE Phone_cust_id='" . $cid . "' AND Phone_no='" . $phone . "';";
  $stmtdel = $conn->prepare($del);
    $stmtdel->execute();
  if($stmtdel)
  {
    echo "successfully deleted phone number";
  }

}
else
{
  echo"Account must be linked to atleast one phone Number. Cannot delete phone Number";
}

  
}
?>
</div>
</div> 

<div class="container">
  <button type="button" class="btn btn-danger btn-block" onclick=window.location.replace("#lol3")>
  Outstanding Loan Details </button>
   <p>
</p> 
 
</div>

<div class="container">
  <button type="button" class="btn btn-success btn-block" onclick=window.location.replace("#lol2")> Credit Card Details </button>
  <p>
  </p>
</div>



<div class="container">
  
  <button type="button" class="btn btn-primary btn-block" onclick=window.location.replace("#account")> Account Details </button>
 <p></p>
</div>


<div class="container">
<div class="jumbotron">
<div id="lol2" align="center" class="form-group">
  <form method="post">
  
    <br>
    <input type="submit" class="btn" name="submit3" value="Check the current credit cards linked to your account" />
  <br>
  <br>
<?php
 

if(isset($_POST['submit3'])) 
{
 
$custid=$_COOKIE['custid'];
echo("<p> Credit cards linked to your account are as follows </p>");
$sql="SELECT credit_card_number,account_number_cc_fkey,cc_limit,expiry 
    FROM customer,account,credit_card
    WHERE account_number_customer_fkey=account_number and account_number_cc_fkey=account_number and cust_id='" . $custid . "';";
$stmt = $conn->query($sql);

      echo"<table border='1'class='table table-striped'>";
      echo("<tr><th>Credit card Number</th><th>credit Card Limit</th><th>Expiry</th></tr>");
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        $acc =$row['account_number_cc_fkey'];
     
        echo"<tr><td>{$row['credit_card_number']}</td><td>{$row['cc_limit']}</td><td>{$row['expiry']}</td></tr>";
      endwhile;

      echo"</table>";
   setcookie('acc', $acc, time()+3600);
}

  ?>
  <br>
 <!--<label>Request New Credit Card</label><br>-->
  <form method="post" action="#lol2">



  <!---<input type="text" placeholder="Enter Acc Num" name="accnum" value="<?php if(isset($_POST['accnum'])){ echo $_POST['accnum']; }?>" required>-->
  <input type="submit" class="btn" name="insert1" value="Request New Credit Card"/>
  <br><br><br>
  </form>
  

<?php
if(isset($_POST['insert1']))
{ 
  if(isset($_COOKIE['acc'])){
  $accnum=$_COOKIE['acc'];
  
  
  $custid=$_COOKIE['custid'];
  
 /* function get_ccnum()
  {
    $rand='';
    for($i=1;$i<=16;$i++)
    {
      $rand.=strval(mt_rand(0,9));
      if($i%4==0)
        $rand.=' ';
    }
    return $rand;
  }*/
  function get_ccnumstr()
  {
    $num=array("9845 3261 9521 1134","1720 2830 9371 2520","7361 2957 0125 5950");
    $index=rand(0,2);
    return $num[$index];
    //$char='0123456789';
    //$rands='';
    //for($i=1;$i<=16;$i++)
    //{
      //$rand=rand(0,strlen($char)-1);
      //$rands.=$char[$rand];
      //if($i%4==0)
        //$rands.=' ';
    
    
  }

  /*function get_limit()
  {
    $rand="";
    for($i=1;$i<=6;$i++)
    {
      $rand.=mt_rand(0,9);
      
    }
    return $rand;
  }*/

  $cc=get_ccnumstr();
  //echo(gettype($cc));

 //$cc='0000 1111 2222 3333';
  $l="SELECT balance FROM ACCOUNT WHERE account_number='". $accnum ."';";
  $stmt= $conn->query($l);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        $bal =$row['balance'];
endwhile;
$limit=(4*$bal);


  //$limit=get_limit();
  
$Sql_count="SELECT COUNT(*) AS count FROM CREDIT_CARD WHERE account_number_cc_fkey='". $accnum ."';";
$stmt_count= $conn->query($Sql_count);
while($row = $stmt_count->fetch(PDO::FETCH_ASSOC)):
        $count =$row['count'];
endwhile;
if($count<3)
{

 $sql_insert = "INSERT INTO CREDIT_CARD(credit_card_number,expiry,cc_limit,account_number_cc_fkey)
            VALUES('". $cc ."','1-Aug-21','". $limit ."','". $accnum ."');";
 $stmt = $conn->prepare($sql_insert);
 $stmt->execute();
 echo("<p> A new Credit Card has been added to the Customer's Account Number </p>".$accnum."<br>");
}
else
{
  echo"<p>You have reached Maximum Limit</p>";
}

 }
}

?>
<form method="post">
  <label> WITHDRAW CREDIT CARD</label> <br>


      <input type="text" placeholder="Enter Last 4 digits" name="cc_num" value="<?php if(isset($_POST['cc_num'])){echo $_POST['cc_num'];} ?>" required>
      <input type="submit" class="btn" name="delete" value="Delete Card"></input>
  </form>
  <?php
  if(isset($_POST['delete']))
{
  
  
  
  $ccnum=$_POST['cc_num'];
  echo ($ccnum);
  $accnum=$_COOKIE['acc'];
  



  //$sql8 = "DELETE FROM CREDIT_CARD WHERE credit_card_number='". $ccnum ."';";
  $sql8 = "DELETE FROM CREDIT_CARD WHERE credit_card_number LIKE '%".$ccnum."';";
    $stmt8 = $conn->prepare($sql8);
    $stmt8->execute();
    echo "deleted";
  }
  ?>

</div>
</div>
</div>

<div class="container">
<div class="jumbotron">
<div id="account" align="center" class="form-group">
  <form method="post">
 
  <div id="lol2" align="center" class="form-group">
  <input type="submit" class="btn" name="submit7" value="Check Out Acount Details" />

  <input type="submit" class="btn" name="submit5" value="Request Change Of Branch" />
  <br><br><br>
  <select class="form-control" id="sel1" name="pick">
    <option value="Bangalore - JP nagar" name="chooser">Bangalore-JP nagar</option>
    <option value="Bangalore - Infosys" name="chooser">Bangalore-Infosys</option>
    <option value="Bangalore - Domlur" name="chooser">Bangalore-Domlur</option>
    <option value="Mangalore - Chilimbi" name="chooser">Mangalore-Chilimbi</option>
    <option value="Mangalore - St Agnes" name="chooser">Mangalore-St Agnes</option>
    <option value="Mangalore - Valencia" name="chooser">Mangalore-Valencia</option>
    <option value="Hubli - Gokul Road" name="chooser">Hubli-Gokul Road</option>
    <option value="Hubli - Eureka" name="chooser">Hubli-Eureka</option>
   

  </select>
  <br>
  <input type="submit" name="submit1" class="btn" value="Save Changes" />
  <br>
  <br>
  <br>

  </form>
  <?php
  if(isset($_POST['submit7']))
  {
  $custid=$_COOKIE['custid'];
   $sql1= "SELECT cust_fname,cust_lname,account_number_customer_fkey,balance,account_type,branch_name
          FROM customer,account,branch
          where account_number_customer_fkey=account_number and account_number_branch_fkey=account_number and cust_id='" . $custid . "';";
      $stmt = $conn->query($sql1);
      echo"<table border='1'class='table table-striped'>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
       
        echo"<tr><th>Customer name</th><td>{$row['cust_fname']}</td><td>{$row['cust_lname']}</td></tr>";
        echo"<tr><th>Account Number</th><td colspan='2'>{$row['account_number_customer_fkey']}</td></tr>";
        echo"<tr><th>Account Type</th><td colspan='2'>{$row['account_type']}</td></tr>";
        echo"<tr><th>Account Balance</th><td colspan='2'>{$row['balance']}</td></tr>";
        echo"<tr><th>Account Branch Details</th><td colspan='2'>{$row['branch_name']}</td></tr>";

        echo"</table>";
      

      endwhile;
    }

if(isset($_POST['submit1'])) 
{
  $custid=$_COOKIE['custid'];
  $getval=$_POST['pick'];

  $sql="UPDATE BRANCH SET branch_name='" . $getval . "' WHERE account_number_branch_fkey IN (SELECT account_number FROM ACCOUNT INNER JOIN CUSTOMER ON account_number=account_number_customer_fkey WHERE cust_id='" . $custid . "');";

  $stmt = $conn->query($sql);

  $sql1="SELECT account_number,branch_name 
        FROM customer,account,branch
        where account_number_customer_fkey=account_number and account_number_branch_fkey=account_number and cust_id='" . $custid . "';";

  $stmt1 = $conn->query($sql1);
  while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) :
          echo "<p>Your Account Number</p>".htmlspecialchars($row['account_number'])."<p> has been successfully shifted to the branch </p>".htmlspecialchars($row['branch_name'])."<br>";
          
           endwhile;


}




?>  

  

</div>
</div>
</div>



<div class="container">
<div id="lol3" align="center" class="jumbotron">
	
  <form method="post">
 
  <div id="lol2" align="center" class="form-group">
  <input type="submit" class="btn" name="submit2" value="Check Out Loan Details" />
  <br>
  <br>
  </form>
  
  <?php
  

if(isset($_POST['submit2'])) 
{
 
  
      $custid=$_COOKIE['custid'];
      $sql1 = "SELECT payment_date FROM PAYMENT WHERE loan_id_payment_fkey IN (SELECT loan_id FROM BORROWS WHERE cust_id='" . $custid . "');";
      $stmt = $conn->query($sql1);
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
          $_POST['payment_date']=$row['payment_date'];
          endwhile;
   
      $sql2 = "SELECT loan_amount FROM LOAN WHERE loan_id IN (SELECT loan_id FROM BORROWS WHERE 
      cust_id='" . $custid . "');";
      $stmt2 = $conn->query($sql2);
      while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) :
          $_POST['loan_amount']=$row['loan_amount'];
          endwhile;

     /* echo("Last Payment Date: " . $_POST['payment_date'] . "<br />\n");

      echo("Loan Amount Taken: " . $_POST['loan_amount'] . "<br />\n");*/
      echo"<table border='1' class='table table-striped'>";
      echo"<tr><th>Last Payment Date</th><td>{$_POST['payment_date']}</td></tr>";
      echo"<tr><th>Loan Amount</th><td>{$_POST['loan_amount']}</td></tr>";
      echo"</table>";


}
 
  ?>
</div>
</div>
</div>




</div> 

</body>
</html>