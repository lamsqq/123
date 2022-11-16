<?php
    session_start();
    include('connect.php');
    if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];
    $getDataSession = session_id();    
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
           {
             $sql = "INSERT into `product` (`id`, `name`, `name_trans`, `price`, `small_text`, `big_text`, `user_id`) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."')";
                   $result = mysqli_query($connect, $sql);
        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"только csv.\");
              window.location = \"index.php\"
              </script>";    
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"успешно.\");
            window.location = \"index.php\"
            </script>";
        }
           }
      
           fclose($file);  
     }
  }

  if(isset($_POST["Export"])){
     
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('id', 'name', 'name_trans', 'price', 'small_text', 'big_text', 'user_id'));  
    $query = "SELECT * from product ORDER BY id DESC";  
    $result = mysqli_query($connect, $query);  
    while($row = mysqli_fetch_assoc($result))  
    {  
         fputcsv($output, $row);  
    }  
    fclose($output);  
}     
 ?>