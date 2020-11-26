<html>
<head>

  <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                
                            <div class="col-md-12">
  <title>Form Import</title>
  
  <!-- Load File jquery.min.js yang ada difolder js -->
  <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
  
  <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>
</head>
<body>
  <h3>Form Import</h3>
  <hr>
  
  <a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
  <br>
  <br>
  
  <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
  <form style='margin-bottom: 2%;' method="post" action="<?php echo base_url("index.php/import/form"); ?>" enctype="multipart/form-data">
    <!-- 
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
    <input type="file" name="file" >
    
    <!--
    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
    <button type="submit" name="preview" class="btn btn-success btn-sm">Preview</button>
  </form>
  
  <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }
    
    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url("index.php/import/import")."'>";
    
    // Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red; margin-top=5%;' id='kosong'>
    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
    </div>";
    
    echo "<div class='row m-t-30'>
                            <div class='col-md-12'>
                                <div class='table-responsive m-b-40'>
                                    <table class='table table-borderless table-data3'>
    <thead>                                
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Password</th>
      <th>Role_id</th>
    </tr>
    </thead> ";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di excel
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // Ambil data pada excel sesuai Kolom
      $name = $row['A']; // Ambil data nama
      $email = $row['B']; // Ambil data jenis kelamin
      $password = $row['C']; // Ambil data alamat
      $role_id = $row['D'];

      // Cek jika semua data tidak diisi
      if($name == "" && $email == "" && $password == "" && $role_id == "")
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $name_td = ( ! empty($name))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $email_td = ( ! empty($email))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
        $password_td = ( ! empty($password))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $role_id_td = ( ! empty($role_id))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
        
        // Jika salah satu data ada yang kosong
        if($name == "" or $email == "" or $password == "" or $role_id == ""){
          $kosong++; // Tambah 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$name_td.">".$name."</td>";
        echo "<td".$email_td.">".$email."</td>";
        echo "<td".$password_td.">".$password ."</td>";
        echo "<td".$role_id_td.">".$role_id."</td>";
        echo "</tr>";
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 0
    // Jika lebih dari 0, berarti ada data yang masih kosong
    if($kosong > 0){
    ?>  
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button type='submit' name='import' class = 'btn btn-primary btn-sm'>Import</button>";
      echo "<a style = 'margin-left : 30px;' class='btn btn-danger btn-sm' href='".base_url("index.php/c_home/listUser")."'>Cancel</a>";
    }
    
    echo "</form>";
  }
  ?>
</div> </div> </div> </div>
</body>
</html>