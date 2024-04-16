<?php
session_start();
include("../Check/authentication.php");
include("../Check/student_restrict.php");
include("../Check/checkMail.php");
include("../Database/registerDB.php");
include("../html/addStudent.html");
?>


<?php
// Lấy dữ liệu từ biểu mẫu

if (isset($_POST["addStudent"])) {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  $repassword = filter_input(INPUT_POST, "repassword", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_name = filter_input(INPUT_POST, "student_name", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_email   = filter_input(INPUT_POST, "student_email", FILTER_SANITIZE_SPECIAL_CHARS);

  $student_class   = filter_input(INPUT_POST, "student_class", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_ID = filter_input(INPUT_POST, "student_ID", FILTER_SANITIZE_SPECIAL_CHARS);
  $phone_num = filter_input(INPUT_POST, "phone_num", FILTER_SANITIZE_SPECIAL_CHARS);
  $avatar = filter_input(INPUT_POST, "avatar", FILTER_SANITIZE_SPECIAL_CHARS);
  $hash1 = hash('sha256', $password);
  $hash2 = hash('sha256', $repassword);

  if (isset($_FILES["avatar"])) {
    $file_name = $_FILES["avatar"]["name"];
    $file_size = $_FILES["avatar"]["size"];
    $file_tmp = $_FILES["avatar"]["tmp_name"];
    $file_type = $_FILES["avatar"]["type"];
    $ext = explode('.', $file_name);
    $file_ext = strtolower(end($ext));

    // Check for errors
    if ($_FILES["avatar"]["error"] !== UPLOAD_ERR_OK) {
      $error_msg = "Error uploading file: " . $_FILES["avatar"]["error"];
      echo $error_msg;
      exit;
    }

    // Validate file extension
    if (!in_array($file_ext, $allowed_extensions)) {
      $error_msg = "Invalid file extension. Only " . implode(", ", $allowed_extensions) . " are allowed.";
      echo $error_msg;
      exit;
    }

    // Validate file size (optional)
    if ($file_size > 5000000) { // 5MB limit (adjust if needed)
      $error_msg = "File size too large. Maximum size is 5MB.";
      echo $error_msg;
      exit;
    }

    // Generate a unique filename
    $new_filename = uniqid() . "." . $file_ext;
    echo "im here";
    // Upload the file
    if (move_uploaded_file($file_tmp, 'avatar/' . $file_name)) {
      
  // Thực hiện truy vấn để thêm sinh viên vào cơ sở dữ liệu
  try {

    include("../Check/checkAdd.php");
    if (empty($username) || empty($password) || empty($repassword) || empty($student_name) || 
    empty($student_name) || empty($student_email) || empty($student_class) ||empty( $student_ID)|| 
    empty($phone_num)|| empty($avatar))  {
      echo '<span style="color:red;">Somthing is empty</span>';
    }
    elseif (check_mail($student_email)) {
      echo "Invalid email address";
    } else {
      if ($hash1 == $hash2) {
        $query = "INSERT INTO students (username, password, student_name, student_email, 
        student_class, student_ID ,phone_num, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, '$file_name')";
        $stmt = mysqli_prepare($connect, $query);
        $stmt->execute([
          $username, $hash1, $student_name, $student_email, $student_class, $student_ID,
          $phone_num
        ]);
        echo "Thêm sinh viên thành công!" . "<br>";
        echo "<button> <a href=../Student/studentList.php>BACK</a></button>";
      } else {
        echo ("Mật khẩu không trùng khớp");
      }
    }
      
    
  } catch (PDOException $e) {
    if ($e->getCode() == '23000') {
      echo "Dữ liệu bị trùng";
    } else {
      echo "Lỗi khi thêm sinh viên: " . $e->getMessage();
    }
  } catch (Exception $e) {
    $e->getMessage();
  }
}else{
  echo "cannot uploadfile";
}
  }
}
?>