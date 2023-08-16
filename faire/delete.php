

<?php

if (isset($_GET['id'])) {
    
    // remove
    $data = file_get_contents("students.json");
    $data = json_decode($data,true);
    // splice
    array_splice($data,intval($_GET['id']),true);
    file_put_contents('students.json',json_encode($data),true);
    header("location: report.php");

}else{
    header("location: report.php");
}

?>