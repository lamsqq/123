<?php
    session_start();
    include('connect.php');
    if(isset($_POST["Import"])) {
    
    $filename=$_FILES["file"]["tmp_name"];
     if($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $user_id = $_SESSION['user_id'] = session_id();  
        while (($getData = fgetcsv($file, 10000, ";"))) {
            $sql = "INSERT into `product` (`id`, `name`, `code`, `price`, `preview_text`, `detail_text`, `user_id`) 
                values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$_SESSION['id']."')";
            $result = mysqli_query($connect, $sql);

              if(!isset($result)) {
                echo "<script type=\"text/javascript\">
                    alert(\"только csv.\");
                    window.location = \"index.php\"
                    </script>";    
              } else {
                  echo "<script type=\"text/javascript\">
                  alert(\"успешно добавлено. \");
                  window.location = \"index.php\"
                  </script>";
              }
          }
      fclose($file);  
     }
  }

  if(isset($_POST["Export"])) {
     
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('id', 'name', 'code', 'price', 'preview_text', 'detailtext', 'user_id'));  
    $query = "SELECT * from product ORDER BY id DESC";  
    $result = mysqli_query($connect, $query);  
    while($row = mysqli_fetch_assoc($result)) {  
         fputcsv($output, $row);  
    }  
    fclose($output);  
  }     
?>