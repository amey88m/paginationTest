<?php
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagination</title>

<!-- MDB icon -->
<link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Material Design Bootstrap -->
<link rel="stylesheet" href="css/mdb.min.css">
<!-- Your custom styles (optional) -->
<link rel="stylesheet" href="css/style.css">
<style>
.disabled { cursor: no-drop}
</style>
</head>
<body>

<div id="result"></div>

<?php
  

  $connection = mysqli_connect('localhost','root','1234567890','mysql');
  $sql = "SELECT * FROM columns_priv";
  $sql_rows  = mysqli_query($connection, $sql);
  

  $limit  = 5;
  
  $LastPage = mysqli_num_rows($sql_rows);

  $start  =  (($_GET['current'] - $limit)>0)? $_GET['current'] - $limit : 1;

  $end    =  (($_GET['current'] + $limit)>$LastPage)? $LastPage : $_GET['current'] + $limit;
  
 
  $per_page_records = 5;

  $half   = ceil($LastPage/$per_page_records);
  
  $checkclassprev = ($start < 2)? "disabled": "";
  $checkclassnext = ($start < $LastPage - 10)? "": "disabled";

?>
    
<form method="POST" >
    <nav aria-label="Page navigation example">
      <ul class="pagination pg-blue" id="pg">
        <li class="page-item ">
          <a class="page-link <?php echo $checkclassprev ?>" tabindex="-1" href="index.php?current=<?php echo $_GET['current']-1 ?>">&laquo;</a>
        </li>
        <?php
          for($i = $start ; $i <= $end; $i ++) {
        ?>
            <li class="page-item pg"  >
              <a href="index.php?current=<?php echo $i ?>" class="page-link" data-page="<?php echo $i ?>" >
            <?php echo $i ?></a></li>
        <?php  
              }
        ?>
        <li class="page-item ">
          <a class="page-link <?php echo $checkclassnext ?>" href="index.php?current=<?php echo $_GET['current']+1 ?>">&raquo;</a>
        </li>
      </ul>
    </nav>
</form>





    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript"></script>
    <!-- <script>
      $('li').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
      });
    </script> -->
    <!-- <script>
      $(function(){ 
        $('#pg').delegate('.pg','click', function(){
            $this = $(this);
            $.ajax({
                  url: "index.php",
                  method: "POST",
                  data: {page_no: $this.val()},
                  success:function(d) {
                    $("#result").html(d)
                  }
            })
        })
      })
    </script> -->

</body>
</html>