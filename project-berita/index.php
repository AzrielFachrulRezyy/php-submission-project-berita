<!DOCTYPE html>
<html lang="en">
<head>
    <title>Template Web Responsive dengan Bootstrap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include 'config/database.php';
        $ambil_kategori = mysqli_query ($kon,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
        $copy_right = $row['nama_website'];
    ?>
    <a class="navbar-brand" href="index.php?halaman=home"><?php echo $nama_website;?></a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item mx-2">
                <a class="nav-link" href="index.php?halaman=about">About Me</a>
            </li>
            <li class="nav-item mx-2">
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Daftar Artikel
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php
                        include 'config/database.php';
                        $sql="select * from kategori";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                    ?>
                    
                        <a class="dropdown-item" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori'];?></a>
                        <?php endwhile; ?>                         
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav  ml-auto">
            <?php 
                session_start();
                if (isset($_SESSION["id_pengguna"])) {
                        echo " <li><a class='nav-link' href='admin/index.php?halaman=kategori'>Halaman Admin</a></li>";
                }else {
                    echo " <li><a class='nav-link' href='index.php?halaman=login'><span class='fas fa-log-in'></span> Login</a></li>";
                }
            ?>
        </ul>
    </div>
   
</nav>
<!-- <div class="jumbotron text-center">

<?php
    $judul="Welcome";   
    include 'config/database.php';
    if (isset($_GET['id'])) {
        $sql="select * from artikel where status=1 and id_artikel=".$_GET['id']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['judul_artikel'];  
    }else if (isset($_GET['kategori'])){
        $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['nama_kategori'];  
    }

    

?>
    <h1><?php echo $judul;?></h1>

</div> -->

<div class="container mt-5">
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'home':
                include "home.php";
                break;
            case 'artikel':
                include "artikel.php";
                break;
            case 'login':
                include "login.php";
                break;
            case 'about':
                include "about.php";
                break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "home.php";
    }
?>
</div>

</body>
</html>