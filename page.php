<!DOCTYPE html>
<html lang="en">
<head>
  
</style>

  <title>People's Bank</title>
  <style type="text/css">
  .bg-img {
  /* The image used */
  background-image: url("bank.png");

  height: 8%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size:contain;
  position: relative;
  /*filter: blur(8px);*/


}
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color:white ;/*rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
 /* border: 3px solid #f1f1f1;*/
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, 100%);
  z-index:2;
  width: 80%;
  height: 100%;
  
  text-align: center;
}
</style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="front.css">-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>





<div class="bg-img" align="center">
  
  
 
  <br><br><br><br>
  
 <div class="bg-text">
  <h2 style="text-align:center;font-size: 50px; color: black ">PEOPLE'S BANK</h2>
  <br><br>
   <form method="post" action="insertion.php">
  <button type="submit" class="btn btn-primary btn-lg">Add Customer/Employee</button>
  </form>
  <br>
  <form method="post" action="finalfrontend.php">
  <button type="submit" class="btn btn-primary btn-lg">VIEW CUSTOMER DETAILS</button>
  </form>
  <br>
  <form method="post" action="page1.php">
  <button type="submit" class="btn btn-primary btn-lg">VIEW BANK DETAILS</button>
  <br><br><br><br><br>
  </form>
  </div>
</div>

</body>
</html>
