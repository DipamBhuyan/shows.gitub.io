<?php
session_start();
if(isset($_SESSION['rid'])){
  if(isset($_POST['name'])){
      $dbh = new PDO('mysql:host=localhost;dbname=show_record', 'root', 'password');
      $stmt = $dbh->prepare("Insert into shows (name, category, completeness, date) values ('$_POST[name]','$_POST[category]','$_POST[completeness]','$_POST[date]')");
      $stmt->execute();
          header("location: record.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
    <link rel="icon" href="149306.jpg" type="image/jpg">
</head>
<body>
  <div class="w3-top">
    <div class="w3-bar w3-theme w3-border">
      <a href="./home.php" class="w3-bar-item w3-xlarge w3-button w3-mobile"><i class="fa fa-home"></i>Home</a>
      <a href="./record.php" class="w3-bar-item w3-xlarge w3-button w3-mobile">Record</a>
      <a href="./logout.php" class="w3-bar-item w3-xlarge w3-button w3-mobile">Logout</a> 
    </div>
  </div>
  <div class="w3-card-4">
    <div class="w3-container w3-center w3-amber w3-animate-opacity">
      <h3><b>Input Records</b></h2>
    </div>
    <form class="w3-container" action="home.php" method="POST">
      <div id="show_item">
        <div class="w3-row-padding">
          <div class="w3-col m3">
            <p>
              <label for="_name"><b>Name</b></label>   
              <input id="name" class="w3-input w3-border w3-theme-l3" name="name" type="text" placeholder="Enter the name of the show!" required>
            </p>
          </div>
          <div class="w3-col m3">
            <p> 
              <label for="_category"><b>Category</b></label>     
              <select class="w3-select w3-border w3-theme-l3" name="category" required>
                <option value="" disabled selected>Choose your option</option>
                <option value="Anime">Anime</option>
                <option value="Donghwa">Donghwa</option>
                <option value="Web Series">Web Series</option>
                <option value="Movies">Movies</option>
                <option value="Manhwa">Manhwa</option>
              </select>
            </p>
          </div>
          <div class="w3-col m3">
            <p>
              <label for="_completeness"><b>Do you complete it?</b></label> 
              <select class="w3-select w3-border w3-theme-l3" name="completeness" required>
                <option value="" disabled selected>Choose your option</option>
                <option value="Completed">Completed</option>
                <option value="Not Completed">Not Completed</option>
              </select>
            </p>
          </div>
          <div class="w3-col m3">
            <p>
              <label for="_date"><b>Date</b></label>
              <input id="date" class="w3-input w3-border w3-theme-l3" type="date" id="date" name="date" required>
            </p>
          </div>
        </div>
        <div class="w3-row-padding">
          <div class="w3-col m12">
            <p>
              <button class="save_item_btn w3-block w3-btn w3-amber" onclick="validate();"><b>Save</b></i></button>
            </p>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="w3-bar w3-bottom w3-theme-l2 w3-center">
    <p><b>Copyright&copy2023 || Created by Dipam Bhuyan</b></p>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
</body>
</html>
<?php
  }
  else{
      header("location: index.php");
  }
?>