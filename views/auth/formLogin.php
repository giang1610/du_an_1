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
    <!-- breadcrumb area end -->
    <div class="container">
    <?php if (isset($_SESSION['success'])): ?>
        <script>
            alert("<?= $_SESSION['success'] ?>");
        </script>
        <?php unset($_SESSION['success']); // Xóa thông báo sau khi đã hiển thị ?>
    <?php endif; ?>
    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">ĐĂNG NHẬP</h5>

                            <!-- Hiển thị lỗi -->
                            <?php if (isset($_SESSION['error'])): ?>
                                <?php if (is_array($_SESSION['error'])): ?>
                                    <?php foreach ($_SESSION['error'] as $error): ?>
                                        <p class="text-danger login-box-msg text-center"><?= htmlspecialchars($error) ?></p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-danger login-box-msg text-center"><?= htmlspecialchars($_SESSION['error']) ?></p>
                                <?php endif; ?>
                            <?php else: ?>
                                <p class="login-box-msg text-center">Vui lòng đăng nhập</p>
                            <?php endif; ?>

                            <form method="post" action="<?= BASE_URL . '?act=check-login' ?>" >
                                <div class="single-input-item">
                                    <input type="email" placeholder="Email or Username" name="email" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="password" placeholder="Enter your Password" name="password" required />
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <a href="#" class="forget-pwd">Quên mật khẩu?</a>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-dark" type="submit">Đăng Nhập</button>
                                    <p>Bạn không có tài khoản?<a href="<?= BASE_URL .'?act=Register'?>">Đăng kí</a></p>
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

