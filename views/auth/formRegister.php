<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>
 
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thông báo -->
   
    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">ĐĂNG KÝ</h5>
                            <form method="post" action="<?= BASE_URL . '?act=them-Register' ?>" >
                                <div class="single-input-item">
                                <label >Họ tên</label>
                                            <input type="text" class="form-control"  name="ho_ten" placeholder="Nhập tên ">
                                            <?php if(isset($_SESSION['error']['ho_ten'])) {?>
                                                <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                            <?php  }?>
                                </div>
                                <div class="single-input-item">
                                <label >Email</label>
                                            <input type="email" class="form-control"  name="email" placeholder="Nhập email ">
                                            <?php if(isset($_SESSION['error']['email'])) {?>
                                                <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                            <?php  }?>
                                </div>
                                <div class="single-input-item">
                                <label >Ngày sinh</label>
                                            <input type="date" class="form-control"  name="ngay_sinh" placeholder="Nhập ngày sinh ">
                                            <?php if(isset($_SESSION['error']['ngay_sinh'])) {?>
                                                <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>
                                            <?php  }?>
                                </div>
                                <div class="single-input-item">
                                <label >Số điện thoại</label>
                                            <input type="text" class="form-control"  name="so_dien_thoai" placeholder="Nhập Số điện thoại ">
                                            <?php if(isset($_SESSION['error']['so_dien_thoai'])) {?>
                                                <p class="text-danger"><?= $_SESSION['error']['Số điện thoại'] ?></p>
                                            <?php  }?>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-dark" type="submit">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>

<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <!-- Add your minicart items here -->
                    </ul>
                </div>
                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>sub-total</span>
                            <span><strong>$300.00</strong></span>
                        </li>
                        <li>
                            <span>Eco Tax (-2.00)</span>
                            <span><strong>$10.00</strong></span>
                        </li>
                        <li>
                            <span>VAT (20%)</span>
                            <span><strong>$60.00</strong></span>
                        </li>
                        <li class="total">
                            <span>total</span>
                            <span><strong>$370.00</strong></span>
                        </li>
                    </ul>
                </div>
                <div class="minicart-button">
                    <a href="cart.html"><i class="fa fa-shopping-cart"></i> View Cart</a>
                    <a href="cart.html"><i class="fa fa-share"></i> Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->

<!-- Footer -->
<?php require_once 'views/layout/fooder.php'; ?>

