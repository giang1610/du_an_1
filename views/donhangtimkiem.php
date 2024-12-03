<h1>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($kyw); ?>"</h1>

<?php if (empty($listSanPham)): ?>
    <p>Không tìm thấy sản phẩm nào.</p>
<?php else: ?>
    <ul>
        <?php foreach ($listSanPham as $sanPham): ?>
            <li>
                <a href="<?= BASE_URL .'?act=chi-tiet-san-pham&id_san_pham='. $sanPham['id']?><?php echo $sanPham['id']; ?>">
                    <?php echo htmlspecialchars($sanPham['ten_san_pham']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
