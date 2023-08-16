<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้ารายงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<style>
    th {
        text-align:center;
    }
    .inter {
        height:30px;
        align-items:center;
        text-align:center;
        max-width:20%;
    }
</style>
<body class="bg-dark">

<center>
<h1 class="text-light mt-4">รายงานเกรดนักศึกษา</h1>
</center>

<?php 
    $data = file_get_contents('students.json');
    $data = json_decode($data,true);
    // Looper
    if (isset($_GET['scfilter']) && $_GET['scfilter'] == "MTL") {
        usort($data,'compareMTL');
    }else if (isset($_GET['scfilter']) && $_GET['scfilter'] == "LTM") {
        usort($data,'compareLTM');
    }
    
?>


<div class="w-50 m-auto d-flex justify-content-between align-items-center">
    <div>
        <a href="?scfilter=MTL" class="btn btn-outline-light">มากไปน้อย</a>
        <a href="?scfilter=LTM" class="btn btn-outline-light">น้อยไปมาก</a>
    </div>
        <a href="index.php" class="btn btn-outline-light">เพิ่มใหม่</a>
</div>
<table class="table table-dark w-50 m-auto border mt-2 table-striped ">
    <thead>
        <tr>
            <th>Name</th>
            <th>Grade</th>
            <th>Score</th>
            <th>Interactive</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) {
        $data[$key]['grade'] = setGrade($value['score']); ?>
        <tr>
            <th><?php echo $value['name']; ?></th>
            <th><?php echo setGrade($value['score']); ?></th>
            <th><?php echo $value['score']; ?></th>
            <th>
                <a class="btn inter btn-light" href="edit.php?id=<?php echo $key; ?>">แก้ไข</a>
                <a class="btn inter btn-danger" href="delete.php?id=<?php echo $key; ?>">ลบ</a>
            </th>
        </tr>
    <?php }
    if (isset($_GET['data'])) {
        $new = json_decode($_GET['data'],true);
        foreach ($new as $keynew => $valuenew) { ?>
            
        <tr>
            <th><?php echo $valuenew['name']; ?></th>
            <th><?php echo setGrade($valuenew['score']); ?></th>
            <th><?php echo $valuenew['score']; ?></th>
            <th>นักเรียนใหม่</th>
        </tr>

        <?php }
    }
    // save grade.json
    if (isset($_GET['save']) && $_GET['save'] == "true") {
        file_put_contents('grade.json',json_encode($data));
    }
    ?>
    </tbody>
</table>

<center>
    <button onclick="alert('ข้อมูลบันทึกเรียนร้อยแล้ว');window.location.href = '?save=true';" class="btn btn-outline-light mt-3">ยืนยันผลการเรียน</button>
</center>
    
</body>
</html>


<?php 

function setGrade($score) {
    if ($score >= 80) {
        return "A";
    }else if ($score >= 70) {
        return "B";
    }else if ($score >= 60) {
        return "C";
    }else if ($score >= 50) {
        return "D";
    }else{
        return "F";
    }
}

function compareMTL($sc1,$sc2) {
    return $sc2['score'] - $sc1['score'];
}
function compareLTM($sc1,$sc2) {
    return $sc1['score'] - $sc2['score'];
}

?>