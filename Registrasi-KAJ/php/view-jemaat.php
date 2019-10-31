<html>
<head>
    <?php 
    include("connect.php");
    $que = mysqli_query($con,"select count(id_jemaat) from jemaat");
    $arr = mysqli_fetch_array($que);
    $count_jemaat = $arr[0];
    ?>
    <title>Melihat Jemaat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../lib/tableExport.js"></script>
    <script type="text/javascript" src="../lib/jquery.base64.js"></script>
    <script type="text/javascript" src="../lib/html2canvas.js"></script>
    <script type="text/javascript" src="../lib/jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="../lib/jspdf/jspdf.js"></script>
    <script type="text/javascript" src="../lib/jspdf/libs/base64.js"></script>
    <style>
    body{
        background: url('../img/1.jpeg') center fixed;
        background-size: cover;
        
    }
        .well{
            width:150%;
        }
</style>
    <script type="text/javascript">
function searchFunc (key){
    if(key.length==0){
        getContent();
        return;
    }
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange=function(){
        if(this.readyState==4&&this.status==200){
            $.get("search_request.php?query="+this.responseText, {}, function(e){
			var data = JSON.parse(e);
			$("#event_table").html("");
            var str ="";
            str+="<tr><th><center>ID Jemaat</center></th><th><center>ID KAJ</center></th><th><center>Tanggal Bergabung</center></th><th><center>Nama Lengkap</center></th><th><center>Alamat</center><th><center>No Handphone</center></th><th><center>Tanggal Lahir</center></th><th><center>Kota Lahir</center></th><th><center>Jenis Kelamin</center></th><th><center>Pas Foto</center></th><th><center>KTP</center></th><th><center>Surat Baptis</center></th><th><center>Aksi</center></th></tr>";
           
			for(var i=0;i<data.length;i++)
			{	
				str += "<tr id='event_table'>";
				str += "<td id='event_table'><center>" + data[i].id_jemaat + "</center></td> ";
                str += "<td id='event_table'><center>" + data[i].id_kaj + "</center></td> ";
                str += "<td id='event_table'><center>" + data[i].tanggal_bergabung + "</center></td> ";
				str += "<td id='event_table'><center>"+ data[i].nama+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].alamat+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].no_hp+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].tanggal_lahir+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].kota+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].jenis_kelamin+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].pas_foto+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].ktp+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].surat_baptis+"</center></td>";
				str += "<td id='event_table'><center><input type ='button' value='Hapus' onclick='delFunc("+data[i].id_jemaat+")' class='btn'><form method='get' action='form-kaj.php' style='display:inline;'>&nbsp;<input type='submit' value='Ubah' class='btn'><input type='hidden' value='"+data[i].id_jemaat+"' name='id' ></center></form></td>"
				str += "</tr>";
				$("#event_table").append(str);
                str ="";
			}
		});
        }
    }
    xmlhttp.open("GET","search.php?id="+key,true);
    xmlhttp.send();
}
function delFunc (a)
	{
		var req = new XMLHttpRequest();
		req.open("GET","del_request.php?id="+a, true);
		req.send();	
		req.onreadystatechange = function(){
			if(req.readyState == 4){
				getContent();
				}
		}
	}
 function getContent()
	{
		$.get("content_request.php", {}, function(e){
			var data = JSON.parse(e);
			$("#event_table").html("");
            var str ="";
            str+="<tr><th><center>ID Jemaat</center></th><th><center>ID KAJ</center></th><th><center>Tanggal Bergabung</center></th><th><center>Nama Lengkap</center></th><th><center>Alamat</center><th><center>No Handphone</center></th><th><center>Tanggal Lahir</center></th><th><center>Kota Lahir</center></th><th><center>Jenis Kelamin</center></th><th><center>Pas Foto</center></th><th><center>KTP</center></th><th><center>Surat Baptis</center></th><th><center>Aksi</center></th></tr>";
           
			for(var i=0;i<data.length;i++)
			{	
				str += "<tr id='event_table'>";
				str += "<td id='event_table'><center>" + data[i].id_jemaat + "</center></td> ";
                str += "<td id='event_table'><center>" + data[i].id_kaj + "</center></td> ";
                str += "<td id='event_table'><center>" + data[i].tanggal_bergabung + "</center></td> ";
				str += "<td id='event_table'><center>"+ data[i].nama+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].alamat+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].no_hp+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].tanggal_lahir+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].kota+"</center></td>";
                str += "<td id='event_table'><center>"+ data[i].jenis_kelamin+"</center></td>";
                str += "<td id='event_table'><center><a href="+data[i].pas_foto+">"+data[i].pas_foto+"</a></center></td>";
                str += "<td id='event_table'><center><a href="+ data[i].ktp+">"+data[i].ktp+"</center></td>";
                str += "<td id='event_table'><center><a href="+ data[i].surat_baptis+">"+data[i].surat_baptis+"</center></td>";
				str += "<td id='event_table'><center><input type ='button' value='Hapus' onclick='delFunc("+data[i].id_jemaat+")' class='btn'><form method='get' action='form-kaj.php' style='display:inline;'>&nbsp;<input type='submit' value='Ubah' class='btn'><input type='hidden' value='"+data[i].id_jemaat+"' name='id' ></center></form></td>"
				str += "</tr>";
				$("#event_table").append(str);
                str ="";
			}
		});
	}
	   $(function(){ getContent();});
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row content">
            <br><br>
                    <h1 style="color:white;"><center>Daftar Jemaat</center></h1>
                    <h3 style="color:white;"><center>Jumlah Jemaat : <?php echo $count_jemaat ?></center></h3>
                    <label style="color:white;">Cari Jemaat :</label>
                    <input type="text" placeholder="Masukan kata kunci" onkeyup="searchFunc(this.value)">
                    <input type="hidden" name="id">
                    <button class="btn" onclick="$('#event_table').tableExport({type:'excel',escape:'false'});">Kopi data Jemaat ke Excel</button>
                    <form action="home.php">
                    <button type="submit" class="btn" >Kembali</button>
                    </form>
            <br><br>
                <div class="well" >
                    <table class="table table-hover">
                        <thead id="event_table">
                        </thead>
                    </table>
                </div>
            
        </div>
    </div>
</body>
</html>