<?php
   include("config.php");
   session_start();

   $username = "";
   $email    = "";
   $errors = array(); 

   // REGISTER USER
if (isset($_POST['register']))
{
   $username = mysqli_real_escape_string($db, $_POST['uname']);
   $email = mysqli_real_escape_string($db, $_POST['email']);
   $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
   $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
 
  
   if (empty($username)) { array_push($errors, "Username is required"); }
   if (empty($email)) { array_push($errors, "Email is required"); }
   if (empty($password_1)) { array_push($errors, "Password is required"); }
   if ($password_1 != $password_2)
   {
    array_push($errors, "The two passwords doesn't match");
   }
 
   $user_check_query = "SELECT * FROM reg WHERE email='$email' LIMIT 1";
   $result = mysqli_query($db, $user_check_query);
   $user = mysqli_fetch_assoc($result);
   
   if ($user)
   {
      array_push($errors, "email already exists");
   }
 
   if (count($errors) == 0)
   {
      $password = md5($password_1);
 
      $query = "INSERT INTO reg (uname, email, password_1) 
              VALUES('$username', '$email', '$password')";
      mysqli_query($db, $query);
      $_SESSION['success'] = "You are now logged in";
      header("location: index.php?notify=inSuccess");
      exit();
   }
 }


// LOGIN USER
if (isset($_POST['login'])) {
   $username = mysqli_real_escape_string($db, $_POST['uname']);
   $password = mysqli_real_escape_string($db, $_POST['pass']);
 
   if (empty($username)) {
      array_push($errors, "Username is required");
   }
   if (empty($password)) {
      array_push($errors, "Password is required");
   }
   if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM reg WHERE email='$username' AND password_1='$password'";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1) {
        $_SESSION['uname'] = $username;
        header('location: guvi.php');
      }else {
         array_push($errors, " Wrong username/password combination");
      }
   }
 }

 

  


if (isset($_POST['update'])) {
   $dob = $_POST['dob'];
   $dobDateTime = new DateTime($dob);
   $now = new DateTime();
   $interval = $dobDateTime->diff($now);
   $Age = $interval->y;

   $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $html = $_POST['html'];
    $css = $_POST['css'];
    $php = $_POST['php'];
    $js = $_POST['js'];
    $mdb = $_POST['mdb'];
    $sql = $_POST['sql'];
    $cprog = $_POST['cprog'];
    $java = $_POST['java'];
    $python = $_POST['python'];
   
   if (empty($country)) { array_push($errors, "Country is required"); }
   if (empty($state)) { array_push($errors, "State is required"); }
   if (empty($dob)) { array_push($errors, "Date of Birth is required"); }
   if (empty($zip)) { array_push($errors, "Pincode is required"); }
   if ((empty($html))||(empty($css))||(empty($php))||(empty($js))||(empty($mdb))||(empty($sql))||(empty($cprog))||(empty($java))||(empty($python))) { array_push($errors, "All percentage is required"); }
   if(($html<0||$html>100)||($css<0||$css>100)||($php<0||$php>100)||($js<0||$js>100)||($mdb<0||$mdb>100)||($sql<0||$sql>100)||($cprog<0||$cprog>100)||($java<0||$java>100)||($python<0||$python>100)) { array_push($errors, "Values want to be in 0-100%"); }
   if (count($errors) == 0) {
       $query = "UPDATE reg SET dob = ?, age = ?, country = ?, stat = ?, zip = ?, html = ?, css = ?, php = ?, js = ?, mdb = ?, sqlper = ?, cprog = ?, java = ?, python = ? WHERE email = ?";
       $stmt = $db->prepare($query);
       $stmt->bind_param("sssssssssssssss", $dob, $Age, $country, $state, $zip, $html, $css, $php, $js, $mdb, $sql, $cprog, $java, $python, $_SESSION['uname']);
       $stmt->execute();
       $_SESSION['success'] = "Details Updated";
       $stmt->close();
   }
}

?>