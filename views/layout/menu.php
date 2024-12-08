 <!-- Start Header Area -->
 <header id="masthead" class="site-header" role="banner">
     <div class="site-branding">
         <div class="container">
             <a class="site-nav-toggler d-lg-none" data-toggle="collapse" href="#site-nav">

             </a>
             <strong class="site-logo">
                 <a href="<?= BASE_URL ?>" rel="home">
                     <img width="625" height="439" loading="lazy" src="https://teddy.vn/wp-content/uploads/2023/03/logo-add-01gg-e1680256236315.png" alt="Gấu Bông Teddy" />
                     <span class="d-none d-md-block">Ôm Là Yêu</span>
                 </a>
             </strong>
             <div class="site-search">
                 <form class="form-search" action="<?= BASE_URL . '?act=search' ?>" method="POST">
                     <input type="hidden" name="post_type" value="product" />
                     <div class="input-group">
                         <input class="form-control typeahead" type="text" name="keyword" placeholder="Nhập sản phẩm cần tìm" />
                         <span class="input-group-btn position-absolute" style="z-index: 10; top: 2px; right: 2px;">
                             <button class="btn border-0" type="submit"><i class="bi bi-search-heart"></i></i></button>
                         </span>
                     </div>
                 </form>
             </div>
             <a class="d-none d-sm-flex align-items-center site-hotline text-primary font-weight-black" href="tel:0965555346">
                 <i class="bi bi-telephone-outbound-fill"></i>
                 096.5555.346 </a>
         </div>
     </div>

     <div class="aa">

         <div class="main-menu">
             <!-- main menu navbar start -->
             <nav class="desktop-menu">
                 <ul>
                     <li><a href="<?= BASE_URL ?>">Trang chủ </i></a>

                     </li>

                     <li><a href="<?= BASE_URL . '?act=san-pham-theo-danh-muc' ?>">Sản phẩm <i class="fa fa-angle-down"></i></a>
                         <ul class="dropdown">
                             <?php foreach ($listDanhMuc as $danhMuc) { ?>
                                 <li><a href="<?= BASE_URL . '?act=san-pham-theo-danh-muc&danh_muc_id=' . $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></a></li>
                             <?php  } ?>
                         </ul>
                     </li>
                     <li><a href="<?= BASE_URL . '/views/gioiThieu.php' ?>">Giới thiệu</a></li>
                     <li><a href="<?= BASE_URL . '/views/lienHe.php' ?>">Liên hệ</a></li>
                 </ul>
             </nav>
             <!-- main menu navbar end -->
         </div>




         <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
             <div class="header-search-container">
                 <button class="search-trigger d-xl-none d-lg-block"></button>

             </div>
             <div class="header-configure-area">
                 <ul class="nav justify-content-end">
                     <label for="">
                         <?php if (isset($_SESSION['user_client'])) {
                                echo $_SESSION['user_client'];
                            } ?>
                     </label>
                     <li class="user-hover">
                         <a href="#">
                             <i class="pe-7s-user"></i>
                         </a>
                         <ul class="dropdown-list">
                             <?php if (!isset($_SESSION['user_client'])) { ?>
                                 <li><a href="<?= BASE_URL . '?act=login' ?>">Đăng nhập</a></li>
                                 <li><a href="<?= BASE_URL . '?act=Register' ?>">Đăng ký</a></li>
                             <?php } else { ?>
                                 <li><a href="my-account.html">Tài khoản</a></li>
                                 <li><a href="<?= BASE_URL . '?act=lich-su-mua-hang' ?>">Đơn hàng</a></li>
                                 <li><a href="<?= BASE_URL . '?act=logout' ?>">Đăng xuất</a></li>

                             <?php } ?>
                         </ul>
                     </li>

                     <li>
                         <a href="#" class="minicart-btn">
                             <i class="pe-7s-shopbag"></i>
                             <div class="notification">2</div>
                         </a>
                     </li>
                 </ul>

             </div>
         </div>

 </header>

 <link
     href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
     rel="stylesheet" />


 <style>
     .aa {
         display: flex;
         margin-left: 200px;
         justify-content: space-between;
     }

     .header-configure-area {
         margin-right: 200px;
         margin-top: -30px;
     }
 </style>