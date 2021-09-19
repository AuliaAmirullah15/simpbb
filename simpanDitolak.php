<?php 
            $q = intval($_GET['q']);
            $s = $_GET['s'];
            
    var_dump($q, $s);
            if($s == 'true') {
                $status_validasi = 'ditolak';
            }
            else {
                $status_validasi = 'belum';
            }
        
            $con = mysqli_connect('localhost','root','','fasilkomti_simpbb');
        
        if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"fasilkomti_simpbb");
$sql="UPDATE permintaan SET status_validasi = '". $status_validasi ."' WHERE id_permintaan = '". $q ."'";
mysqli_query($con,$sql);
        
      mysqli_close($con); 
?>
   