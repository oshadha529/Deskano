<?php
include('include/header.php');

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
?>
<div style="padding-top:8%"></div>
<?php

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $file = $_FILES['file']['name'];
    $number = $_POST['number'];
    $Mobile_number = $_POST['Mobile_number'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $id_job = $_POST['id_job'];
    $job_seeker = $_POST['job_seeker'];
    $experience = $_POST['experience'];
    $collegename = $_POST['collegename'];
    $qualification = $_POST['qualification'];
    $percentage = $_POST['percentage'];
    $passout = $_POST['passout'];

    if (strlen($number) != 10) {
        echo '<p class="lead">Please Enter a Valid 10-Digit Mobile Number</p>';
        exit(0);
    }

    $q = "SELECT * FROM job_apply WHERE job_seeker='$job_seeker' AND id_job='$id_job'";
    $sql = mysqli_query($conn, $q);
    if (mysqli_num_rows($sql) > 0) {
          echo '<div><div class="alert alert-warning">
            <strong>Warning!</strong> Already Applied
          </div></div>';

    } else {
        move_uploaded_file($tmp_name, 'files/' . $file);

        // $sql = "INSERT INTO job_apply (first_name, last_name, dob, file, id_job, job_seeker, mobile_number, exp, collage, qualification, percentage, passout) VALUES ('$first_name', '$last_name', '$dob', '$file', '$id_job', '$job_seeker', '$number', '$experience', '$collegename', '$qualification', '$percentage', '$passout')";

        $sql = "INSERT INTO job_apply (first_name, last_name, dob, file, id_job, job_seeker, mobile_number, experience, qualification, percentage, passout, college) VALUES ('$first_name', '$last_name', '$dob', '$file', '$id_job', '$job_seeker', '$number', '$experience', '$qualification', '$percentage', '$passout', '$collegename')";
        $query = mysqli_query($conn, $sql);

      if ($query) {
          echo '<div><div class="alert alert-warning">
                <strong>Success!</strong> Your Form Successfully Added
              </div></div>';
      } else {
          echo '<div><div class="alert alert-danger">
                <strong>Error!</strong> Form submission failed
              </div></div>';
      }
    }
}
?>
<p class="lead" style="margin-left: 40%;">
    <a href="index.php" class="btn btn-lg btn-secondary">Back</a>
</p>

<?php
include('include/footer.php');
?>