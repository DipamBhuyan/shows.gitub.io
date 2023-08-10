<?php
session_start();
if(isset($_SESSION['rid'])){
  $dbh = new PDO('mysql:host=localhost;dbname=show_record', 'root', 'password');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Records</title>
</head>
<body>
  <div class="w3-bar w3-top w3-theme w3-border" id="myTopnav">
    <a href="./home.php" class="w3-bar-item w3-xlarge w3-button w3-mobile"><i class="fa fa-home"></i>Home</a>
    <a href="./record.php" class="w3-bar-item w3-xlarge w3-button w3-mobile">Record</a>
    <a href="./logout.php" class="w3-bar-item w3-xlarge w3-button w3-mobile">Logout</a> 
  </div>
  <!--<form class="w3-container w3-bar w3-center w3-mobile w3-padding" action="">
    <input type="text" class="w3-input w3-bar-item w3-amber w3-mobile" placeholder="Search..">
    <button class="w3-bar-item w3-button w3-black"><i class="fa fa-search"></i></button>
  </form>-->
  <div class="search-bar">
    <div class="w3-bar">
      <form>
        <input type="text" id="search" name="search_query" autocomplete="off" class="w3-bar-item w3-input w3-theme-l4 w3-round-xxlarge w3-border w3-hover-opacity w3-mobile" placeholder="Search.." style="width: 100%">
      </form>
    </div>
  </div>
  <div class="w3-card-4 w3-animate-opacity" style="margin-top: 50px">
    <div class="w3-container w3-center w3-amber">
      <h3><b>Records</b></h2>
    </div>
    <div class="w3-container">
      <div id="show_item">
        <table class="w3-table w3-striped w3-border w3-bordered">            
            <colgroup>
                <col span="1" style="width: 3%;">
                <col span="1" style="width: 27%;">
                <col span="1" style="width: 22%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 18%;">
                <col span="1" style="width: 10%;">
            </colgroup>
            <tbody>
                <tr class="w3-theme-l3">
                  <th>SL No</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Completed/Not Completed</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                <?php
                  $q = "SELECT distinct * FROM shows order by idshows asc";
                  $i=1;
                  foreach($dbh->query($q) as $r) {
                ?>
                <tr>
                  <td><?php echo($i);?></td>
                  <td><?php echo($r[1])?></td>
                  <td><?php echo($r[2])?></td>
                  <td><?php echo($r[3])?></td>
                  <td><?php echo($r[4])?></td>
                  <td>
                    <div class="w3-row">
                      <div id="button" class="w3-col m6">
                        <a href="edit.php?bid=<?php echo($r[0]) ?>" class="edit_item_btn w3-btn w3-blue"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                      <form action="delete.php" class="w3-col m6" method="post">
                        <input type="hidden" name="bid" value="<?php echo($r[0]) ?>" />
                        <button id="button" class="delete_item_btn w3-btn w3-red" type="submit" name="b1"><i class="fa fa-trash" aria-hidden="true"></i></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
            </tbody>
            <?php
              $i++;
              }
            ?>
        </table>
      </div>
    </div>
  </div>
  <div class="w3-bar w3-bottom w3-theme-l2 w3-center">
    <p><b>Copyright&copy2023 || Created by Dipam Bhuyan</b></p>
  </div>
  <script>
    $(document).ready(function() {
        $('#search').keyup(function() {
            var query = $(this).val();
            if (query !== '') {
                $.ajax({
                    url: 'search.php',
                    method: 'GET',
                    data: { search_query: query },
                    success: function(data) {
                        $('#show_item tbody').empty(); // Clear existing table rows
                        $('#show_item tbody').html(data); // Update the table body with search results
                    }
                });
            } else {
                // Restore the original table content
                $.ajax({
                    url: 'search.php',
                    method: 'GET',
                    data: { search_query: '' }, // Send an empty query to get all records
                    success: function(data) {
                        $('#show_item tbody').empty(); // Clear existing table rows
                        $('#show_item tbody').html(data);
                    }
                });
            }
        });
    });
  </script>
</body>
</html>
<?php
}
else{
    header("location: index.php");
}
?>