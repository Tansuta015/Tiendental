<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienden1";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<!doctype html>
<html lang="en">
  <head>
    <title>TIEN DENTAL</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/navbar.css">
  <!-- idcard -->
  <script type="text/javascript">
        function autoTab(obj) {
            /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
            หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
            4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
            รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
            หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
            ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
            */
            var pattern = new String("_-____-_____-__-_"); // กำหนดรูปแบบในนี้
            var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
            var returnText = new String("");
            var obj_l = obj.value.length;
            var obj_l2 = obj_l - 1;
            for (i = 0; i < pattern.length; i++) {
                if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                    returnText += obj.value + pattern_ex;
                    obj.value = returnText;
                }
            }
            if (obj_l >= pattern.length) {
                obj.value = obj.value.substr(0, pattern.length);
            }
        }
    </script>

    <script type="text/javascript">
        function autoTab1(tel) {
            var pattern = new String("___-_______"); // กำหนดรูปแบบในนี้
            var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
            var returnText = new String("");
            var tel_l = tel.value.length;
            var tel_l2 = tel_l - 1;
            for (i = 0; i < pattern.length; i++) {
                if (tel_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                    returnText += tel.value + pattern_ex;
                    tel.value = returnText;
                }
            }
            if (tel_l >= pattern.length) {
                tel.value = tel.value.substr(0, pattern.length);
            }
        }
    </script>

  
  
  
  </head>
  <body>
  <nav class="navbar navbar-expand-md" style="background: #00bcd5; ">
    <img src="img/tooth.png" href="/newdental/home.php" width="50" height="45">

    
    <h2><a class="display-8" href="/newdental/home.php">TIEN DENTAL</a></h2>
</nav>
      
      
      <form action="insertsingin.php" method="post">
      
      <div class="container">
            <form class="form-horizontal" role="form"><br>
                <h2>สมัครสมาชิก</h2><br>
                <div class="row">
                <div class="form-group col-md-6 ">
                    <label for="lastName">เลขสมาชิก :</label>
                    <?php
                        $sql = "SELECT MAX(CAST(Customernum AS UNSIGNED )) AS maxid FROM customer";
                        $query = $conn->query($sql);
                        $row = mysqli_fetch_array($query); 
                        $maxid = $row["maxid"];
                        $min = ($maxid  + 1);
                       $str = str_pad($min,5,"0",STR_PAD_LEFT);
                        // $arr = ($maxid+$min);
                        //echo $str;
                        
                        $_SESSION['time'] = $str;
                        
                    echo "<input type='text' name='mnumber' disabled='disabled' value='$str' placeholder='เลขสมาชิก' class='form-control'>";
                    ?>
                     
                     
                    
                     
                    </div>
</div>
                    <div class="row">
      <div class="form-group col-md-6 ">
                        <label for="firstName">ชื่อ :</label>

                        <input type="text" name="name" id="firstName" placeholder="ชื่อ" class="form-control" autofocus>
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="lastName">นามสกุล :</label>

                        <input type="text" name="lastname" id="lastName" placeholder="นามสกุล" class="form-control" autofocus>
                    </div>

                </div>
                <div class="row">
                <div class="form-group col-md-6 ">
                    <label for="input"  >เพศ :</label>
                    <select id="input" name="sex"  class="form-control">
                        <option selected  >โปรดระบุเพศ</option>
                        <option >ชาย</option>
                        <option >หญิง</option>
                        
                    </select>
                </div>
               
                <!-- <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="sex">เพศ :</label>

                        <input type="text" name="sex" id="sex" placeholder="เพศ" class="form-control" autofocus>
                    </div> -->

                    <div class="form-group col-md-6 ">
                        <label for="lastName">อายุ :</label>

                        <input type="text" name="age" id="lastName" placeholder="อายุ" class="form-control" autofocus>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                    <label for="">รหัสประจำตัวประชาชน :</label> 
                     
                    <input name="idcard" type="text" id="data" placeholder="เลขประจำตัว 13 หลัก"
                                class="form-control" onkeyup="autoTab(this)" />
                      
                    </div>
                    <div class="form-group col-md-6 ">
                       <label for="">หมายเลขเบอร์โทรศัพท์ :</label>  
                            <input  name="phone" type="text" id="data" placeholder="เบอร์โทรศัพท์" class="form-control"
                                onkeyup="autoTab1(this)" />
                        
                    </div>
                </div>



                <div class="form-group">
                    <label for="exampleFormControlTextarea1">ที่อยู่ :</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="2"
                        placeholder="ระบุเลขที่บ้าน ถนน/ตรอก/ซอย ตำบล อำเภอ จังหวัด เลขไปรษณีย์ให้ถูกต้อง เช่น 155/48 หมู่ 9 ถนนลิ่มดุลย์ อำเภอท้ายเหมือง ตำบลท้ายเหมือง จังหวัดพังงา 82120"></textarea>
                </div>

                <!-- <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="numberid">เลขสมาชิก :</label>

                        <input type="text" name="numberid" id="numberid" placeholder="เลขสมาชิก 5 หลัก" class="form-control" autofocus>
                    </div>
  </div> -->
                    <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="">โรคประจำตัว :</label>

                        <input type="text" name="disease" id="" placeholder="ระบุ" class="form-control" autofocus>
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="">ประวัติการแพ้ยา :</label>

                        <input type="text" id="" name="allergy" placeholder="ระบุ" class="form-control" autofocus>
                    </div>

              

                
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-secondary  btn-lg" data-toggle="modal"
                                data-target="#myModal">ลงทะเบียน</button>
                                <br><br>

                        </div>
                    </div>
                    </form>
                </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>