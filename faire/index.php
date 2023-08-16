<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรแกรมคำนวนเกรด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    
<center>
    <h1 class="mt-5 text-light">โปรแกรมคำนวนเกรด</h1>
</center>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $classes = $_POST['classes'];
        // read from file
        $data = file_get_contents('students.json');
        $data = json_decode($data,true);
        $newData = json_decode($classes,true);
        var_dump($newData);
        foreach ($newData as $key) {
            array_push($data,$key);
        }
        file_put_contents('students.json',json_encode($data));

        
        header("location: report.php");
    }
?>

<form method="POST" class="w-50 m-auto">
    <input id="name" class="form-control mt-3" type="text" placeholder="ชื่อ">

    <h3 class="mt-5 text-light">คะแนนวิชาการเขียนโปรแกรมคอมพิวเตอร์</h3>
    <div class="d-flex flex-row align-items-center">
        <input onkeyup="setGrade()" class="form-control mt-3" id="คอม" type="text" placeholder="กรุณากรอกคะแนน">
        <span class="badge bg-danger" id="grade"></span>
    </div>

        <input hidden type="text" name="classes" id="classes">

    <button onclick="adder()" class="btn mt-3 btn-outline-light w-100">เพิ่มข้อมูลนักเรียน</button>
    <button hidden type="submit" id="add"></button>
    
</form>

<table class="table w-50 m-auto mt-5 table-striped table-dark border border-2">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ</th>
            <th>คะแนน</th>
            <th>ลบ</th>
        </tr>
    </thead>
    <tbody id="tableStu">
        
    </tbody>
</table>
<div class="w-50 m-auto mt-5">
<button onclick="report()" class="btn btn-outline-light w-100">คำนวนเกรด</button>
</div>
</body>
<script>
localStorage.setItem('students','[]')
let students = JSON.parse(localStorage.getItem('students'))
function adder() {
    event.preventDefault();
    const name = document.getElementById('name').value || 'ไม่ระบุ';
    const com = document.getElementById('คอม').value || 0;

    let data = {}
    data['name'] = name
    data['score'] = com
    
    //
    
    students.push(data)
    localStorage.setItem('students',JSON.stringify(students))
    students = JSON.parse(localStorage.getItem('students'))
    document.getElementById('tableStu').innerHTML = ""
    for (let i = 0;i < students.length;i++) {
        let stu = students[i]
        document.getElementById('tableStu').innerHTML += "<tr><td>"+(i + 1)+"</td><td>"+stu['name']+"</td><td>"+stu["score"]+"</td><td><button class='btn btn-danger'>ลบ</button></td></tr>"
    }
    document.getElementById('name').value = ""
    document.getElementById('คอม').value = ""

}

function setGrade() {
    try {
        const score = parseInt(event.target.value)
        let TextScore = ''
        if (score >= 80) {
            TextScore = "A"
        }else if (score >= 70) {
            TextScore = "B"
        }else if (score >= 60) {
            TextScore = "C"
        }else if (score >= 50) {
            TextScore = "D"
        }else{
            TextScore = "F"
        }
        document.getElementById('grade').innerHTML = TextScore
    }catch(e) {
        alert('กรอกตัวเลขเท่านั้น')
    }
}

function report() {
    document.getElementById('classes').value = JSON.stringify(students)
    document.getElementById('add').click()
}

</script>
</html>