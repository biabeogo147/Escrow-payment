<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\widgets\TopNavWidget;
use app\widgets\FooterWidget;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
</head>
<style>
    .navbar-custom {
        background-color: #ff6f00;
    }
</style>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <?= TopNavWidget::widget(); ?>
        </div>
    </nav>

    <!-- Banner Section -->
    <div class="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-6">
                    <h2>Thanh Toán Đảm bảo</h2>
                    <h4>Giao dịch trực tuyến an toàn qua Ngân Lượng</h4>
                    <p>Sử dụng Ngân Lượng cho các giao dịch trực tuyến của bạn để mua bán hàng hóa một cách tự tin, đảm
                        bảo không có rủi ro về việc hoàn tiền. Trải nghiệm phương thức thanh toán thực sự an toàn mỗi
                        lần giao dịch.</p>
                </div>
                <div class="col-md-6">
                    <img src="/assets/common/images/NEE-Facebook-cover-low.webp" alt="Banner Image" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>

    <!-- Steps Section -->
    <div class="container my-5">
        <div class="row step-card">
            <div class="col-2 text-center">
                <img src="/assets/common/images/step1.png" alt="Đặt Cọc Bảo Đảm" style="width: 100px; height: 100px;">
            </div>
            <div class="col-10">
                <h4>Bước 1: Đặt Cọc Bảo Đảm</h4>
                <p>Người mua và người bán đồng thuận trên giá và điều kiện. Người mua đặt cọc bảo đảm thông qua dịch vụ
                    chúng tôi.</p>
            </div>
        </div>
        <div class="row step-card">
            <div class="col-2 text-center">
                <img src="/assets/common/images/step2.png" alt="Giao Hàng hoặc Dịch Vụ" style="width: 100px; height: 100px;">
            </div>
            <div class="col-10">
                <h4>Bước 2: Giao Hàng hoặc Dịch Vụ</h4>
                <p>Người bán cung cấp hàng hoặc dịch vụ như đã thảo luận. Chúng tôi giữ cọc bảo đảm an toàn.</p>
            </div>
        </div>
        <div class="row step-card">
            <div class="col-2 text-center">
                <img src="/assets/common/images/step3.png" alt="Xác Nhận và Thanh Toán" style="width: 100px; height: 100px;">
            </div>
            <div class="col-10">
                <h4>Bước 3: Xác Nhận và Thanh Toán</h4>
                <p>Người mua xác nhận việc nhận hàng hoặc dịch vụ. Chúng tôi giải phóng cọc bảo đảm cho người bán.</p>
            </div>
        </div>
        <div class="row step-card">
            <div class="col-2 text-center">
                <img src="/assets/common/images/step4.png" alt="An Toàn và Minh Bạch" style="width: 100px; height: 100px;">
            </div>
            <div class="col-10">
                <h4>Bước 4: Hoàn Toàn An Toàn và Minh Bạch</h4>
                <p>Giao dịch của bạn được bảo vệ bởi chúng tôi. Minh bạch mọi chi tiết và quy trình.</p>
            </div>
        </div>
        <?= Html::button('Bắt đầu ngay', [
            'class' => 'start-btn',
            'onclick' => 'window.location.href="' . Url::to(['site/openpayment']) . '"',
        ]) ?>
    </div>


    <!-- Ngân Lượng Introduction Section -->
    <div class="container my-5">
        <div class="bg-light p-4">
            <h2 class="text-center font-weight-bold">Thanh Toán Đảm Bảo</h2>
            <p class="text-center">Một sản phẩm của NgânLượng.vn - Cổng trung gian thanh toán tin cậy ở Việt Nam</p>
            <div class="row text-center mt-4">
                <div class="col">
                    <img src="/assets/common/images/nganluong-01.png" alt="Giải thưởng Forbes" style="width: 80px; height: 80px;">
                    <h5>Giải thưởng Forbes Award</h5>
                </div>
                <div class="col">
                    <img src="/assets/common/images/nganluong-02.png" alt="Tổng giao dịch 1 năm" style="width: 80px; height: 80px;">
                    <h5>Tổng giao dịch 1 năm</h5>
                </div>
                <div class="col">
                    <img src="/assets/common/images/nganluong-03.png" alt="Tổng số tiền đã giao dịch" style="width: 80px; height: 80px;">
                    <h5>Tổng số tiền đã giao dịch</h5>
                </div>
                <div class="col">
                    <img src="/assets/common/images/nganluong-04.png" alt="Trên 100k Đối tác lớn" style="width: 80px; height: 80px;">
                    <h5>Trên 100k Đối tác lớn</h5>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <img src="/assets/common/images/nganluong-trust-gateway.png" alt="Tính Tin Cậy Của Hệ Thống Thanh Toán" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>


    <!-- Service Introduction Section -->
    <div class="container my-5">
        <h2 class="text-center">Giải pháp phù hợp với nhu cầu giao dịch của bạn</h2>
        <p class="text-center">Dich vụ thanh toán dễ sử dụng cùng với đội ngũ chuyên gia sẵn sàng hỗ trợ 24/7.</p>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-start mb-3">
                    <img src="/assets/common/images/method-01.png" alt="Thanh toán dễ dàng" style="width: 60px; height: 60px; margin-right: 15px;">
                    <div style="width: 80%;">
                        <h5 class="font-weight-bold">Thanh toán dễ dàng bằng nhiều phương thức thanh toán</h5>
                        <p>Bank transfer, Visa/Master Cards online, ATM...</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <img src="/assets/common/images/method-02.png" alt="Quản lý giao dịch" style="width: 60px; height: 60px; margin-right: 15px;">
                    <div style="width: 80%;">
                        <h5 class="font-weight-bold">Thực hiện quy trình kiểm tra, quản lý giao dịch</h5>
                        <p>Quản lý giao dịch và thanh toán thông qua nền tảng dễ dàng hơn bao giờ hết.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <img src="/assets/common/images/method-03.png" alt="Cách mạng hóa giao dịch tài chính" style="width: 60px; height: 60px; margin-right: 15px;">
                    <div style="width: 80%;">
                        <h5 class="font-weight-bold">Cách mạng hóa giao dịch tài chính</h5>
                        <p>Với ví điện tử nhận tiền ngay khi giao dịch được chấp thuận.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <img src="/assets/common/images/method-04.png" alt="Đội ngũ chuyên gia hỗ trợ 24/7" style="width: 60px; height: 60px; margin-right: 15px;">
                    <div style="width: 80%;">
                        <h5 class="font-weight-bold">Đội ngũ chuyên gia hỗ trợ 24/7</h5>
                        <p>Xử lý vấn đề nhanh chóng và hiệu quả.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="container my-5">
        <div class="bg-light p-4">
            <h2 class="text-center">Hãy liên hệ với chúng tôi nếu bạn có bất kỳ câu hỏi hoặc yêu cầu đặc biệt</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form class="mt-4">
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label">Họ tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Nhập họ tên của bạn">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone" class="col-sm-3 col-form-label">Số Điện thoại</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại của bạn">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="start-btn">Gửi liên hệ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-dark text-white pt-4 pb-4">
        <div class="container">
            <?= FooterWidget::widget(); ?>
        </div>
    </footer>





    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>