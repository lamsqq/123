<?php
    function get_all_records(){
        include('connect.php');
        $sql = "SELECT * FROM `product`";
        $result = mysqli_query($connect, $sql);  
        if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
                <thead><tr><th>Product</th>
                            <th>name</th>
                            <th>name_trans</th>
                            <th>price</th>
                            <th>small_text</th>
                            <th>big_text</th>
                            <th>user_id</th>
                            </tr></thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['id']."</td>
                    <td>" . $row['name']."</td>
                    <td>" . $row['code']."</td>
                    <td>" . $row['price']."</td>
                    <td>" . $row['preview_text']."</td>
                    <td>" . $row['detail_text']."</td>
                    <td>" . $row['user_id']."</td></tr>";        
        }
        
        echo "</tbody></table></div>";
        
    } else {
        echo "пусто";
    }
    }
?>