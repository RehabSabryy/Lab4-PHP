<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>

  <div class="container">
    <form action="" method="POST" style="width:50%;">
    <h1>Lab 4 PHP</h1>
    <?php
      @include 'config.php';

     

            $emailErr = '';
            $nameErr = '';
            $groupErr = '';
            $detailsErr = '';
            $radioErr = '';
            $email = '';
            $name = '' ;
            $radio ='';
            $group = '';
            $classDetails='';
            $courses = [];
            if (isset($_REQUEST['submit'])) {
              $name = $_REQUEST["username"];
              if (empty($name)) {
                  $nameErr = 'Name is Required';
              }

              $email = $_REQUEST["email"];
              if (empty($email)) {
                  $emailErr = 'Email is Required';
              }

              $group = $_REQUEST["group"];
              if (empty($group)) {
                  $groupErr = 'Group is Required';
              }

              $classDetails = $_REQUEST["class-details"];
              if (empty($classDetails)) {
                  $detailsErr = 'Class Details is required';
              }

              if(empty($radio)){
                  $radioErr='Class Details is required';
              }
              else {
                $radio = $_REQUEST["radio"];
              }
          }            
          
          if (isset($_REQUEST['edit'])) {
            $editId = $_REQUEST['edit'];
            // Query to get the existing row data
            $query = "SELECT * FROM form WHERE id = $editId";
            $result = mysqli_query($link, $query);
          
            if ($result && mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              // fill the form 
              $name = $row['username'];
              $email = $row['email'];
              $group = $row['group_no'];
              $classDetails = $row['class_details'];
              $radio = $row['gender'];
              $courses = explode(',', $row['course']);
            }
          }
                        ?>
             
            <div class="mb-3">
              <div style="color:red;">*Required Fields</div>
                  <label for="name" class="form-label">Name</label>
                  <div style="display:flex;">
                  <span style="color:red;">*</span>
                  <input type="text" class="form-control" id="name" name="username" value="<?php echo "$name" ?>">
                  </div>
                 <span style='color:red;'><?php echo "$nameErr" ?></span>

              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <div style="display:flex;">
                  <span style="color:red;">*</span>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo "$email" ?>">
                  <span style="color:red;">*</span>
                  </div>
                  <span style='color:red;'><?php echo "$emailErr" ?></span>
                    
          </div>
          <div class="mb-3">
                  <label for="group" class="form-label">Group</label>
                  <input type="number" class="form-control" name="group" id="group" name="group" value="<?php echo "$group" ?>"> 
          </div>
          <span style='color:red;'><?php echo "$groupErr" ?></span>

          <div class="mb-3">
                  <label for="class-details">Class Details</label>
                  <textarea class="form-control" name="class-details" id="class-details" style="height:100px"><?php echo "$classDetails" ?></textarea>
          </div>
          <span style='color:red;'><?php echo "$detailsErr" ?></span>
          <div class="form-check">
                  <input class="form-check-input" type="radio" name="radio" id="exampleRadios1" value="Male" <?php if ($radio=="Male") {
                    echo "checked" ;
                  } ?>>
                  <label class="form-check-label" for="exampleRadios1">
                     Male
                  </label>
          </div>
          <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="exampleRadios2" value="Female"  <?php if ($radio=="Female") {
                    echo "checked" ;
                  } ?>>
                    <label class="form-check-label" for="exampleRadios2">
                      Female
                    </label>
          </div>
          <span style='color:red;'><?php echo "$radioErr" ?></span>
          <div class="form-check">
                <label for="courses">Select Courses</label>
                <select name="courses[]" id="courses" multiple >
    <option value="php" <?php if (in_array("php" , $courses)) {
        echo "selected";
    } ?>>PHP</option>
    <option value="javascript" <?php if (in_array("javascript" , $courses)) {
        echo "selected";
    } ?>>JavaScript</option>
    <option value="html" <?php if (in_array("html" , $courses)) {
        echo "selected";
    } ?>>HTML</option>
    <option value="css" <?php if (in_array("css" , $courses)) {
        echo "selected";
    } ?>>CSS</option>
    <option value="mysql" <?php if (in_array("mysql" , $courses)) {
        echo "selected";
    } ?>>MySQL</option>
</select>
          </div>
          <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Agree</label>
          </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary ">
    </form>
    </div>
 <!-- PHP Code -->
 <div class="container mt-5">
<?php
    if(isset($_REQUEST['submit'])) {
      $name = $_REQUEST["username"];
      $email = $_REQUEST["email"];
      $group = $_REQUEST["group"];
      $classDetails = $_REQUEST["class-details"];
  
      if (!empty($name) && !empty($email) && !empty($group) && !empty($classDetails)) {
          $radio = isset($_POST['radio']) ? $_POST['radio'] : '';
          $selectedCourses = isset($_POST['courses']) ? $_POST['courses'] : [];
          $coursesString = implode(",", $selectedCourses);
         // Insert query with the same id
  $sqldata = "INSERT INTO form (id, username, email, group_no, class_details, gender, course) 
  VALUES ('$editId', '$name', '$email', '$group', '$classDetails', '$radio', '$coursesString')"; 

// Execute the query
$result = mysqli_query($link, $sqldata);

if (!$result) {
die('Error: ' . mysqli_error($link));
} else {
header("Location: display-form.php");
exit();
}
}
    }
    ?>
</div>
</body>
</html>