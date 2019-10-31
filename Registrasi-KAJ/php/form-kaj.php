<html>
<head>
<?php 
    include("connect.php");
    $que = mysqli_query($con,"select count(id_jemaat) from jemaat");
    $arr = mysqli_fetch_array($que);
    $count_jemaat = $arr[0];
    $unique = substr(microtime(true),-4);
    $unique = str_replace(".","0",$unique);
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $que = mysqli_query($con,"select * from jemaat where id_jemaat='".$_GET['id']."'");
        $arr=mysqli_fetch_array($que);
        $var_tanggal_bergabung = $arr['tanggal_bergabung'];
        $var_nama = $arr['nama'];
        $var_alamat = $arr['alamat'];
        $var_no_hp=$arr['no_hp'];
        $var_tanggal_lahir=$arr['tanggal_lahir'];
        $var_jenis_kelamin=$arr['jenis_kelamin'];
        $var_pas_foto=$arr['pas_foto'];
        $var_ktp=$arr['ktp'];
        $var_id_kaj = $arr['id_kaj'];
        $var_surat_baptis=$arr['surat_baptis'];
        $var_kota = $arr['kota'];
        if($var_jenis_kelamin=="Perempuan"){
            $j_k = 2;
        }
        else
            $j_k=1;
    }
    else{
        $j_k=0;
        $id=0;
        $var_nama = "";
        $var_alamat = "";
        $var_no_hp="";
        $var_tanggal_lahir="";
        $var_jenis_kelamin="";
        $var_pas_foto="";
        $var_ktp="";
        $var_surat_baptis="";
        $var_tanggal_bergabung="";
        $var_kota = "";
    }
     
    if(isset($_POST['save'])){
        if($id==0){
            $nama = $_POST['nama_lengkap_tb'];
            $tanggal = date("Y/m/d");
            $pathr = dirname(realpath("form-kaj.php"));
            $dir = $pathr.'/pasfoto/';
           $uploadfile = $dir.$nama."_".basename($_FILES['pas_foto_tb']['name']);
            move_uploaded_file($_FILES['pas_foto_tb']['tmp_name'],$uploadfile);
            $tujuan_foto = "pasfoto/".$nama."_".basename($_FILES['pas_foto_tb']['name']);
            $dir = $pathr.'/ktp/';
            $uploadfile = $dir.$nama."_KTP_".basename($_FILES['ktp_tb']['name']);
            move_uploaded_file($_FILES['ktp_tb']['tmp_name'],$uploadfile);
            $tujuan_ktp = "ktp/".$nama."_KTP_".$_FILES['ktp_tb']['name'];
            $dir = $pathr.'/baptis/';
            $uploadfile = $dir.$nama."_BAPTIS_".basename($_FILES['surat_baptis_tb']['name']);
            move_uploaded_file($_FILES['surat_baptis_tb']['tmp_name'],$uploadfile);
            $tujuan_surat= "baptis/".$nama."_BAPTIS_".$_FILES['surat_baptis_tb']['name'];
            $tanggal = $_POST['tanggal_join'];
            $tanggal = str_replace("-","",$tanggal);
            $kaj = "BM".$tanggal.$count_jemaat.$unique;
            $result = mysqli_query($con,"INSERT INTO jemaat (id_kaj,tanggal_bergabung,nama,alamat,no_hp,tanggal_lahir,kota,jenis_kelamin,pas_foto,ktp,surat_baptis) VALUES('$kaj','".$_POST['tanggal_join']."','$nama','".$_POST['alamat_tb']."','".$_POST['no_hp_tb']."','".$_POST['tanggal_tb']."','".$_POST['kota_tb']."','".$_POST['gender']."','$tujuan_foto','$tujuan_ktp','$tujuan_surat')");
            if(false===$result){
                printf("Error: %s\n",mysqli_error($con));
            }
            
            header("location:home.php");
        }
        else{
            $nama = $_POST['nama_lengkap_tb'];
            $tanggal = date("Y/m/d");
            $pathr = dirname(realpath("form-kaj.php"));
            $dir = $pathr.'/pasfoto/';
            $uploadfile = $dir.$nama."_".basename($_FILES['pas_foto_tb']['name']);
            move_uploaded_file($_FILES['pas_foto_tb']['tmp_name'],$uploadfile);
            $tujuan_foto = "pasfoto/".$nama."_".basename($_FILES['pas_foto_tb']['name']);
            $dir = $pathr.'/ktp/';
            $uploadfile = $dir.$nama."_KTP_".basename($_FILES['ktp_tb']['name']);
            move_uploaded_file($_FILES['ktp_tb']['tmp_name'],$uploadfile);
            $tujuan_ktp = "ktp/".$nama."_KTP_".$_FILES['ktp_tb']['name'];
            $dir = $pathr.'/baptis/';
            $uploadfile = $dir.$nama."_BAPTIS_".basename($_FILES['surat_baptis_tb']['name']);
            move_uploaded_file($_FILES['surat_baptis_tb']['tmp_name'],$uploadfile);
            $tujuan_surat= "baptis/".$nama."_BAPTIS_".$_FILES['surat_baptis_tb']['name'];
            $result=mysqli_query($con,"UPDATE jemaat SET id_kaj='$var_id_kaj',tanggal_bergabung='$var_tanggal_bergabung',nama='$nama',alamat='".$_POST['alamat_tb']."',no_hp='".$_POST['no_hp_tb']."',tanggal_lahir='".$_POST['tanggal_tb']."',kota='".$_POST['kota_tb']."',jenis_kelamin='".$_POST['gender']."',pas_foto='$tujuan_foto',ktp='$tujuan_ktp',surat_baptis='$tujuan_surat' WHERE id_jemaat='$id'");
            if(false===$result){
                printf("Error: %s\n",mysqli_error($con));
            }
            header("location:view-jemaat.php");
            
        }
        
    }
?>
<title>Form KAJ</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body{
        background: url('../img/1.jpeg') center fixed;
        background-size: cover;
        color:white;
    }
</style>
<script type="text/javascript">
    function getJk(){
        var jk = <?php echo $j_k ?>;
        if(jk==1){
            $("#laki").prop("checked",true);
        }
        else if(jk==2){
            $("#perem").prop("checked",true);
        }
    }
    $(function(){getJk();});
</script>
</head>
<body>
    <br><br>
    <h1><center>Form Kartu Anggota Jemaat</center></h1>
	<div class="container">
		<div class="row ">
            <div class="content">    
                <br><br>
                <div class="form-group">
                    <form  method="post" enctype="multipart/form-data" >
                        <label>Nama Lengkap :</label>
                        <input type="text" name="nama_lengkap_tb" value="<?php echo $var_nama ?>" class="form-control" placeholder="Nama Lengkap" style="width:500px;"><br>
                        <label>Alamat :</label>
                        <input type="text" name="alamat_tb" value="<?php echo $var_alamat ?>" class="form-control" placeholder="Alamat" style="width:500px;"><br>
                        <label>Nomor Handphone :</label>
                        <input type="text" name="no_hp_tb" value="<?php echo $var_no_hp ?>" class="form-control" placeholder="No HP" style="width:500px;"><br>
                        <label>Tanggal Lahir :</label>
                        <input type="date" name="tanggal_tb" value="<?php echo $var_tanggal_lahir ?>" class="form-control"  style="width:500px;"><br>
                        <label>Kota Lahir :</label>
                        <input type="text" name="kota_tb" value="<?php echo $var_kota ?>" class="form-control" placeholder="Kota Lahir" style="width:500px;"><br>
                        <label>Jenis Kelamin :</label>
                        
                            <div class="radio">
                                <label>
                                    <input type="radio" id="laki" name="gender" value="Laki-Laki"> Laki - Laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" id="perem" name="gender" value="Perempuan"> Perempuan
                                </label>
                            </div>
                        
                        <br>
                        <label>Pas Foto :</label>
                        <input type="file" name="pas_foto_tb" value="<?php echo $var_pas_foto ?>" class="form-control" style="width:500px;"><br>
                        <label>KTP :</label>
                        <input type="file" name="ktp_tb" value="<?php echo "" ?>" class="form-control" style="width:500px;"><br>
                        <label>Surat Baptis :</label>
                        <input type="file" name="surat_baptis_tb" value="<?php echo "" ?>" class="form-control" style="width:500px;"><br>
                        <label>Tanggal bergabung :</label>
                        <input type="date" name="tanggal_join" class="form-control" style="width:500px;" value="<?php echo $var_tanggal_bergabung ?>"><br>
                        <input type="submit" name="save" value="Simpan">
                        <a href="home.php"><input type="button" value="Batal"></a>
                    </form>
                </div>
            </div>
        </div>
	</div>
</body>
</html>