<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    @include 'config.php';
   
    if(isset($_REQUEST['show'])) {
        $id = $_REQUEST['show'];
        $query = "SELECT * FROM form WHERE id = $id";
        $result = mysqli_query($link, $query);
    }
    else {
        echo "No data found.";
    }
    echo "<h1 style='text-align: center;'> User Details</h1>";
  echo"  <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Group</th>
            <th>Class Details</th>
            <th>Gender</th>
            <th>Courses</th>
        </tr> ";
        while ($row = mysqli_fetch_assoc($result)) {

       echo " <tr>
      
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['group_no']}</td>
                    <td>{$row['class_details']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['course']}</td>
        </tr>
       
    </table> " ;
        }
    ?>
</body>
</html>