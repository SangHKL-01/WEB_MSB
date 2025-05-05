<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm - Kheo Báng Shop</title>
    <link rel="stylesheet" href="http://localhost/WEB_MSB/public/assets/CSS/homepage.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <a href="index.php">Kheo Báng</a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="index.php?controller=Product&action=index">Sản Phẩm</a></li>
                    <li><a href="index.php?controller=Home&action=about">Giới Thiệu</a></li>
                    <li><a href="#">Liên Hệ</a></li>
                    <li><a href="index.php?controller=Product&action=gio_hang">Giỏ Hàng <span id="cart-count">(0)</span></a></li>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<li>
                                <a href="index.php?controller=user&action=profile">
                                <img src="http://localhost/WEB_MSB/public/assets/images/avatar.jpg" alt="Profile" width="40" style="border-radius: 50%; vertical-align: middle;" />
                                </a>
                            </li>';
                    } else {
                        echo '<li>
                                <a href="index.php?controller=user&action=login">
                                <img src="http://localhost/WEB_MSB/public/assets/images/avatar_md.jpg" alt="" width="30" style="border-radius: 50%; vertical-align: middle;" />
                                </a>
                            </li>';
                    }
                    ?>  
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section - Mini banner for product page -->
    <section class="hero" style="height: 30vh;">
        <div class="hero-content">
            <h1>Sản Phẩm Của Chúng Tôi</h1>
            <p>Khám phá các sản phẩm chất lượng cao với giá cả phải chăng.</p>
        </div>
    </section>

    <!-- Search Form -->
    <div class="search-container">
        <form method="GET" action="index.php" class="search-form">
            <input type="hidden" name="controller" value="Product">
            <input type="hidden" name="action" value="search">
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." class="search-input" required>
            <button type="submit" class="search-button">🔍 Tìm kiếm</button>
        </form>
        
        <!-- Thêm các danh mục phổ biến -->
        <div class="popular-tags">
            <span>Phổ biến:</span>
            <a href="index.php?controller=Product&action=search&keyword=áo">Áo</a>
            <a href="index.php?controller=Product&action=search&keyword=quần">Quần</a>
            <a href="index.php?controller=Product&action=search&keyword=giày">Giày</a>
            <a href="index.php?controller=Product&action=search&keyword=túi">Túi xách</a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main">
        <!-- Filter/Sort Options (Optional) -->
        <div class="filter-section" style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <form method="GET" action="index.php">
                <input type="hidden" name="controller" value="Product">
                <input type="hidden" name="action" value="index">
                <select name="sort_by" class="search-input" style="width: auto; margin-right: 10px;">
                    <option value="name">Tên sản phẩm</option>
                    <option value="price">Giá</option>
                </select>
                <select name="sort_dir" class="search-input" style="width: auto; margin-right: 10px;">
                    <option value="ASC">Tăng dần</option>
                    <option value="DESC">Giảm dần</option>
                </select>
                <button type="submit" class="btn btn-sm btn-primary">Sắp xếp</button>
            </form>
        </div>

        <!-- All Products Section -->
        <section class="product-section">
            <h2 class="section-title">Tất Cả Sản Phẩm</h2>
            <?php if (!empty($products)): ?>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-img">
                        <img src="http://localhost/WEB_MSB/public/assets/images/<?= isset($product['image']) ? $product['image'] : 'product_default.jpg' ?>" alt="<?= htmlspecialchars($product['name'] ?? 'Sản phẩm') ?>">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?= htmlspecialchars($product['name'] ?? 'Sản phẩm không tên') ?></h3>
                        <p class="product-price"><?= number_format($product['price'] ?? 0, 0, ',', '.') ?> VNĐ</p>
                        <div class="product-actions">
                            <a href="index.php?controller=Product&action=details_product&id=<?= $product['id'] ?>" class="btn btn-sm btn-primary">Xem Chi Tiết</a>
                            <form method="POST" action="index.php?controller=Product&action=insert_cart&id=<?= $product['id'] ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-sm btn-secondary">Thêm vào Giỏ</button>
                            </form>
                            <a href="index.php?controller=Product&action=checkout&id=<?= $product['id'] ?>" class="btn btn-sm btn-accent">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div style="text-align: center; padding: 30px; background-color: #f8f9fa; border-radius: 8px;">
                <p>Không tìm thấy sản phẩm nào.</p>
            </div>
            <?php endif; ?>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2023 Kheo Báng Shop. Tất cả quyền lợi được bảo vệ.</p>
            <ul class="footer-links">
                <li><a href="#">Chính Sách Bảo Mật</a></li>
                <li><a href="#">Điều Khoản Sử Dụng</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Liên Hệ</a></li>
            </ul>
        </div>
    </footer>

    <!-- Script to update cart count dynamically -->
    <script>
        // Kiểm tra giỏ hàng trong session và cập nhật số lượng
        if (sessionStorage.getItem("cartCount")) {
            document.getElementById("cart-count").textContent = `(${sessionStorage.getItem("cartCount")})`;
        }
    </script>
</body>
</html>
