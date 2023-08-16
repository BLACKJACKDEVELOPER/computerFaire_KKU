<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">

<center>
    <h1 class="text-light mt-5">แก้ไขข้อมูล</h1>
</center>

<!-- Load data -->
<?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // update
        $name = $_POST['name'];
        $score = $_POST['score'];
        $id = $_POST['id'];
        
        $data = file_get_contents('data.json');
        $data = json_decode($data,true);
    
        $data[$id]["name"] = $name;
        $data[$id]["score"] = $score;
        file_put_contents("data.json",json_encode($data));
        header("location: report.php");
    }

    $data = file_get_contents("data.json");
    $data = json_decode($data,true)[intval($_GET['id'])];
?>

<center>
    <form method="POST" class="bg-dark w-25 m-auto mt-5" action="">
        <input name="name" value="<?php echo $data['name']; ?>" class="form-control mb-3" type="text" placeholder="Name" required>
        <input name="score" value="<?php echo $data['score']; ?>" class="form-control mb-3" type="text" placeholder="Score" required>
        <input hidden name="id" type="text" value="<?php echo $_GET['id']; ?>">
        <button class="btn btn-light w-100">UPDATE</button>
    </form>
</center>
    
</body>
</html>