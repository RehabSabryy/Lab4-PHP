<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">

    <?php
    @include 'config.php';


    if (isset($_POST['delete'])) {
        // Check if the delete button is clicked
        $deleteId = $_POST['delete'];
        $deleteQuery = "DELETE FROM form WHERE id = $deleteId";
        $deleteResult = mysqli_query($link, $deleteQuery);

        if ($deleteResult) {
            echo "Record with ID $deleteId has been deleted successfully.";
        } else {
            echo "Error deleting record: " . mysqli_error($link);
        }
    }
    $mysql ='SELECT * FROM form';
    $result = mysqli_query($link, $mysql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Group</th>
                    <th>Class Details</th>
                    <th>Gender</th>
                    <th>Courses</th>
                    <th>Action</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['group_no']}</td>
                    <td>{$row['class_details']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['course']}</td>
                     <td style='display: flex;'>
                     <form method='post' action='row.php'>
                        <input type='hidden' name='show' value='{$row['id']}'>
                        <input type='submit' value='Show'>
                        </form>
                        <form method='post' action='edit.php'>
                            <input type='hidden' name='edit' value='{$row['id']}'>
                            <input type='submit' value='Edit'>
                        </form>
                     <form method='post'>
                     <input type='hidden' name='delete' value='{$row['id']}'>
                     <input type='submit' value='Delete'>
                 </form>
                  </td>;
                  </tr>";
        }

        echo "</table>";
        echo "<button style='margin-top: 10px; background-color: #ff2a1b;
       padding: 10px 20px;
        border-color: transparent;'><a style='color: white;' href='form.php'>Add New User</a></button>";
    } else {
        echo "No data found.";
    }

    // Close the connection
    mysqli_close($link);
    ?>
</div>


</body>
</html>