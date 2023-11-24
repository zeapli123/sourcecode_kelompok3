
<!-- tob-bar start -->
 <div id="top-bar">
        <div class="container">
            <div class="row">
                <!-- top left start -->
                <div class="col-md-6 top-left">
                    <?php if(isset($_SESSION['pelanggan']['id_pelanggan'])):
                      $idpelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                      $ambil = $koneksi->query("SELECT * FROM  pelanggan  WHERE pelanggan.id_pelanggan='$idpelanggan'");
                        $pecah = $ambil->fetch_assoc();
                        ?>
                    <a href="index.php" class="btn btn-sm btn-primary">Welcome</a>
                    <a href="#"><?php echo $pecah['nama_pelanggan']?></a>
                    <?php else:?>
                        <a href="index.php" class="btn btn-sm btn-primary">Welcome</a>
                                   
                    <?php endif?>
                   
                </div>
                 <!-- top left end -->
                 
                <!-- top right start -->
                <div class="col-md-6 top-right">
                    <ul class="top-menu">
                        <li><a href="keranjang.php">Keranjang</a></li>
                        <!-- jika ada session pelanggan -->
                        <?php if(isset($_SESSION['pelanggan'])):?>
                            <li><a href="pelanggan/profil.php">Akun Saya</a></li>
                            <li><a href="logout.php">Logout</a></li>

                        <!-- selain itu jika tidak ada session pelanggan -->
                        <?php else: ?>
                        <li><a href="daftar.php">Daftar</a></li>
                        <li><a href="login.php">Login</a></li>
                        <?php endif ?>
                    </ul>
                </div>
                <!-- top right end -->
                
            </div>
        </div>
    </div>
    <!-- tob-bar end-->
    
    <!-- navbar start-->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <!-- navbar-brand start -->
            <div class="navbar-brand">
            <a class="d-none d-lg-block" href="index.php">Kelompok <span>3</span> </a>
            <a class="d-sm-none" href="index.php"> Kelompok<br><span>3</span> </a>
            </div>
            <!-- navbar-brand end -->
            <!-- btn-navbar start -->
           <div class="btn-navbar">
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#search">
                <span class="toggler"></span>
                <i class="fas fa-search"></i>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="toggler"></span>
                <i class="fas fa-list"></i>
            </button>
           </div>
           <!-- btn-navbar end -->
           <!-- navbarNav start -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto" >
                    <li class="nav-item <?php if($active=='Home') echo "active";?>">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item <?php if($active=='Produk') echo "active";?>">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item <?php if($active=='Akun') echo "active";?>">
                        <a class="nav-link" href="pelanggan/profil.php">Akun Saya</a>
                    </li>
                    <li class="nav-item <?php if($active=='Keranjang') echo "active";?>">
                        <a class="nav-link" href="keranjang.php">Keranjang</a>
                        
                    </li>
                    <li class="nav-item <?php if($active=='Kontak') echo "active";?>">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
                <!-- search start -->
                <div class="collapse clearfix" id="search">
                    <form action="produk.php" method="get" class="navbar-form">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control" placeholder="Search" required>
                            <span class="input-group-btn"></span>
                            <button class="btn btn-primary"  value="Search" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- search end -->
                <!-- btn-search start -->
                <div class="btn-search">
                <div class="collapse navbar-collapse">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
                <span class="toggler"></span>
                <i class="fas fa-search"></i>
                 </button>
                </div>
                </div>
                <!-- btn-search end -->
                <!-- btn-keranjang start -->
                
                <div class="btn-keranjang">
                <?php if(empty($_SESSION['keranjang'])):?>
                            
                            <a href="keranjang.php" class="btn btn-primary"> <i class="fas fa-shopping-cart"> </i><span >(0)</span>  </a>
                            <?php else:?>
                                <?php
                                $items = 0;
                                foreach($_SESSION['keranjang']as $id_produk =>$jumlah){
                                    $items++;
                                }
                                    ?>
                                <a href="keranjang.php" class="btn btn-primary"> <i class="fas fa-shopping-cart"></i><span>(<?php echo $items;?>)</span>  </a>
                                   
                        <?php endif;?>
                </div>
                <!-- btn-keranjang end -->
            </div>
            <!-- navbarNav end-->
        </div>
    </nav>
    <!-- navbar end-->