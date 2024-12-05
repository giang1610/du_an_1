<?php require_once 'layout/header.php'  ?>
<?php require_once 'layout/menu.php'  ?>




<main>

    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">
                                <a class="sidebar-single text-danger" href="<?= BASE_URL . '?act=san-pham' ?>">Danh Mục
                                    Sản Phẩm</a>
                            </h5>

                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    <?php foreach ($listDanhMuc as $danhMuc) { ?>
                                        <li>
                                            <a
                                                href="<?= BASE_URL . '?act=san-pham-theo-danh-muc&danh_muc_id=' . $danhMuc['id'] ?>">
                                                <div class="text-truncate" style="max-width: 200px;">
                                                    <?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">
                                <a class="sidebar-single text-danger" href="<?= BASE_URL . '?act=san-pham' ?>">Top 10
                                    Sản Phẩm</a>
                            </h5>

                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    <?php foreach ($listtop10 as $top10sp) { ?>
                                        <li class="d-flex align-items-center mb-3">
                                            <!-- Hình ảnh sản phẩm -->
                                            <div class="me-3">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $top10sp['id'] ?>">
                                                    <!-- Thêm liên kết tới trang chi tiết sản phẩm -->
                                                    <img src="<?= htmlspecialchars($top10sp['hinh_anh']) ?>"
                                                        alt="<?= htmlspecialchars($top10sp['ten_san_pham']) ?>"
                                                        class="img-fluid"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <!-- Thông tin sản phẩm -->
                                            <div>
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $top10sp['id'] ?>">
                                                    <!-- Thêm liên kết tới trang chi tiết sản phẩm -->
                                                    <p class="mb-1 text-truncate" style="max-width: 150px;">
                                                        <?= htmlspecialchars($top10sp['ten_san_pham']) ?>
                                                    </p>
                                                </a>
                                                <?php if (!empty($top10sp['gia_khuyen_mai']) && $top10sp['gia_khuyen_mai'] < $top10sp['gia_san_pham']): ?>
                                                    <!-- Giá khuyến mại -->
                                                    <span
                                                        class="text-danger fw-bold"><?= number_format($top10sp['gia_khuyen_mai']) ?>₫</span>
                                                    <!-- Giá gốc -->
                                                    <span
                                                        class="text-muted text-decoration-line-through ms-2"><?= number_format($top10sp['gia_san_pham']) ?>₫</span>
                                                <?php else: ?>
                                                    <!-- Giá bình thường -->
                                                    <span
                                                        class="text-danger fw-bold"><?= number_format($top10sp['gia_san_pham'], 0, ',', '.') ?>₫</span>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- single sidebar end -->




                    </aside>
                </div>
                <!-- sidebar area end -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->

                        <!-- shop product top wrap start -->
                        <div class="shop-product-wrap grid-view row mb-4">
                            <!-- product item list wrapper start -->
                            <?php foreach ($listSanPham as $sanPham): ?>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <!-- product grid start -->
                                    <div class="product-item shadow-sm p-3 mb-5 bg-white rounded">
                                        <figure class="product-thumb">
                                            <a
                                                href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                <img class="pri-img img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                                    width="500" height="300" alt="product-main">
                                                <img class="sec-img img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                                    width="500" height="300" alt="product-secondary">
                                            </a>

                                            <div class="product-badge">
                                                <?php
                                                // Hiển thị nhãn "Mới" nếu sản phẩm mới trong vòng 7 ngày
                                                $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                $ngayHienTai = new DateTime();
                                                $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                if ($tinhNgay->days <= 7): ?>
                                                    <div class="product-label new">
                                                        <span>Mới</span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] < $sanPham['gia_san_pham']): ?>
                                                    <div class="product-label discount">
                                                        <span>Giảm giá</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="button-group">
                                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Thêm vào yêu thích"><i class="pe-7s-like"></i></a>
                                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="So sánh"><i class="pe-7s-refresh-2"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Xem nhanh"><i class="pe-7s-search"></i></span></a>
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                                </a>
                                            </h6>
                                            <div class="price-box">
                                                <?php if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] < $sanPham['gia_san_pham']): ?>
                                                    <span
                                                        class="price-regular text-success">$<?= number_format($sanPham['gia_khuyen_mai'], 2) ?></span>
                                                    <span
                                                        class="price-old text-muted"><del>$<?= number_format($sanPham['gia_san_pham'], 2) ?></del></span>
                                                <?php else: ?>
                                                    <span
                                                        class="price-regular">$<?= number_format($sanPham['gia_san_pham'], 2) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->
                                </div>
                            <?php endforeach; ?>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            <div class="col-12">
                                <div class="pagination-area text-center">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="pe-7s-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="pe-7s-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end pagination area -->
                        </div>

                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
    </div>


</main>



<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php' ?>
<!-- offcanvas mini cart end -->


<?php require_once 'layout/fooder.php'; ?>