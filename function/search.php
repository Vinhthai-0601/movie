<?php
    function search(){
        $host = "localhost";
        $user = "root";
        $pw = "";
        $db = "newmovies_db";
        $conn = new mysqli($host, $user, $pw, $db);
         // Phần code PHP xử lý tìm kiếm
         // Nếu người dùng submit form thì thực hiện
         if (isset($_REQUEST['ok'])) 
         {
             // Gán hàm addslashes để chống sql injection
             $search = addslashes($_GET['search']);
            
             // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
             if (empty($search)) {
                 echo "";
             } 
             else
             {
                 // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
                 $query = "select * from movies where movie_name like '%$search%' OR movie_details like '%$search%'";
                
                 // Thực thi câu truy vấn
                 $sql = mysqli_query($conn, $query);
                 
                 // Đếm số đong trả về trong sql.
                 $num = mysqli_num_rows($sql);
                 // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                 if ($num > 0 && $search != "") 
                 {
                     $output = '';
                     while ($row = mysqli_fetch_assoc($sql)) {
 
                         $output .= '
                            
                         <div class="col-md-3">
                         <div class="card">
                                 <a href="Moviedetail.php?id='. $row['movie_id'] .'">
                                   <img src="' . $row['movie_img'] . '" />
                                 </a>
                                 <div class="card-title">
                                   <h1>'. $row['movie_name'] .'</h1>
                                 </div>
                                 <h3>
                                 <span>
                                 2022 ‧ Action/Adventure
                                 </span>
                                 </h3>
                                 <br>
                                 <p>
                                 <span>
                                     <div class="row">
                                         <div class="col-md-6"> <button type="button" class="btn btn-outline-light" data-mdb-ripple-color="dark"><a href="editMovie.php"> Edit</a> <i class="fa-solid fa-pen-to-square"></i></button></div>
                                         <div class="col-md-6"> <a href="Watchmovie.php">
                                         <button type="button" class="btn btn-outline-warning" data-mdb-ripple-color="dark">Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                                         </a></div>
                                     </div>
                                 </span>
                                 </p>
                         </div>
                     </div>
                                    
                              
                         ';
                     }
                    echo $output;
                 } 
                 else {
                     echo "<h1> Can not find!!!'$search' </h1>";
                 }
             }
         }
        }
          
?>