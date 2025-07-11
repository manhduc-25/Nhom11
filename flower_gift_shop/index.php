<?php
session_start();
require_once 'includes/db.php';
?>

<?php
session_start();
require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Flower-Farm | Hygge.Lein</title>
  <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>">
  <link rel="stylesheet" href="./css/footer.css?v=<?= time() ?>">
  <link rel="stylesheet" href="./css/navbar.css?v=<?= time() ?>">
  <script src="https://kit.fontawesome.com/75eec5597d.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>

<body>
  <header id="home-page">
    <?php include 'includes/navbar.php'; ?>

    <div id="banner">
      <img src="./images/banner1.png" alt="Banner Flower Shop">
    </div>
  </header>
  <!-- service highlight -->
  <section id="service-highlight">
    <p><i class="fa-regular fa-circle-check"></i>Đảm bảo hoa tươi tắn 7 ngày</p>
    <p><i class="fa-regular fa-circle-check"></i>Đặt hàng nhanh chóng</p>
    <p><i class="fa-regular fa-circle-check"></i>Mua ngay, thanh toán sau</p>
    <p><i class="fa-regular fa-circle-check"></i>Giao hành trong ngày</p>
  </section>
  <!-- popular product -->
  <section id="popular-product">
    <div class="popular-product-title">
      <span class="line"></span>
      <h2>Một số sản phẩm phổ biến</h2>
      <span class="line"></span>
    </div>
    <div class="popular-product-list">
      <div class="popular-product-card">
        <img src="./images/giohoacuc.jpg" alt="">
        <p class="popular-product-text">Giỏ Hoa Cúc</p>
        <p class="popular-product-price">450.000 đ</p>
      </div>
      <div class="popular-product-card">
        <img src="./images/hoahongruouvang.jpg" alt="">
        <p class="popular-product-text">Hoa Hồng Rượu Vang</p>
        <p class="popular-product-price">600.000 đ</p>
      </div>
      <div class="popular-product-card">
        <img src="./images/hoaBlueHorizon.jpg" alt="">
        <p class="popular-product-text">Blue Horizon</p>
        <p class="popular-product-price">950.000 đ</p>
      </div>
      <div class="popular-product-card">
        <img src="./images/hoaCarolinaBlue.jpg" alt="">
        <p class="popular-product-text">Carolina Blue</p>
        <p class="popular-product-price">979.000 đ</p>
      </div>
    </div>
  </section>
  <!-- review -->
  <section id="review">
    <div class="review-title">
      <span class="line"></span>
      <h2>Khách hàng nói gì về chúng tôi?</h2>
      <span class="line"></span>
    </div>
    <div class="review-list">
      <div class="review-card">
        <div class="review-rating" data-score="8"></div>
        <p class="review-text">Hoa giao rất nhanh nhaaa, hoa tươi lắm mọi người nên mua</p>
        <p class="review-author">Đức</p>
      </div>
      <div class="review-card">
        <div class="review-rating" data-score="10"></div>
        <p class="review-text">Mình không nghĩ là có thể giao hoa trong ngày luôn, 10 đỉm</p>
        <p class="review-author">Lein</p>
      </div>
      <div class="review-card">
        <div class="review-rating" data-score="9"></div>
        <p class="review-text">Quá okee luôn, mọi người không mua hơi phí :v</p>
        <p class="review-author">Khiêm</p>
      </div>
      <div class="review-card">
        <div class="review-rating" data-score="8"></div>
        <p class="review-text">Hoa chất lượng nha, tiền nào của đó thoii</p>
        <p class="review-author">Huy</p>
      </div>
    </div>
  </section>
  <!-- Tại sao chọn chúng tôi -->
  <section id="why-us">
    <div class="why-us-text">
      <h2>Tại sao chọn chúng tôi?</h2>
      <h2>Bởi vì chúng tôi luôn nghĩ cho bạn</h2>
      <img src="./images/flower.svg" alt="" width="250px">
      <p>Chúng tôi tự hào mang đến cho bạn một thế giới hoa đa dạng, phong phú về chủng loại, màu sắc và ý nghĩa. Từ những bó hồng lãng mạn, hoa hướng dương rực rỡ, cho đến hoa lan tinh tế hay những bó hoa mang phong cách tối giản hiện đại — tất cả đều có mặt tại cửa hàng của chúng tôi.</p>
      <p>Với cam kết “hoa tươi mỗi ngày”, đội ngũ của chúng tôi luôn tuyển chọn hoa từ các nhà vườn uy tín nhất, sau đó bó và trang trí tỉ mỉ theo từng đơn hàng. Nhờ đó, mỗi bó hoa bạn nhận được không chỉ là một món quà mà còn là cả một sự chăm chút, tận tâm gửi gắm trong từng cánh hoa.</p>
      <p>Chúng tôi cung cấp dịch vụ giao hàng trong ngày trên toàn khu vực thành phố, đảm bảo món quà của bạn đến đúng người, đúng thời điểm. Tuy nhiên, để đảm bảo chất lượng phục vụ, dịch vụ giao hoa trong ngày sẽ tạm dừng vào các ngày Chủ nhật và dịp lễ lớn.</p>
      <p>Đội ngũ giao hàng của chúng tôi được đào tạo chuyên nghiệp để đảm bảo mọi bó hoa luôn đến tay bạn trong tình trạng hoàn hảo nhất: không dập nát, không héo úa và được bảo vệ kỹ lưỡng trong quá trình vận chuyển.</p>
      <p>Bên cạnh đó, hệ thống đặt hàng trực tuyến của chúng tôi giúp bạn dễ dàng chọn mẫu hoa yêu thích, ghi chú lời chúc và đặc biệt là chọn chính xác ngày – giờ bạn muốn nhận hàng. Tất cả thao tác đều nhanh chóng, tiện lợi chỉ trong vài bước đơn giản.</p>
      <p>Với phương châm “Gửi gắm yêu thương qua từng cánh hoa”, chúng tôi luôn nỗ lực mỗi ngày để không chỉ mang đến sản phẩm đẹp, mà còn là trải nghiệm đáng nhớ cho từng khách hàng.</p>
    </div>
  </section>
  <!-- reason to buy -->
  <section id="reason-to-buy">
    <div class="reason-image">
      <img src="./images/reason.png" alt=""></img>
    </div>
    <div class="reason-text">
      <h2>Bạn sẽ làm ai bất ngờ với một bó hoa?</h2>
      <p>Khi bạn gửi hoa đến những người thân yêu, đó không chỉ là hành động thể hiện tấm lòng mà còn là cách bạn cho thấy sự quan tâm và tinh tế của mình. Một bó hoa có thể thay lời muốn nói, khiến ngày của ai đó trở nên đặc biệt hơn.</p>
      <p>Nếu bạn đang tìm một món quà ý nghĩa, dễ dàng, và có khả năng chạm đến trái tim người nhận, thì hoa luôn là lựa chọn tuyệt vời. Hãy để chúng tôi giúp bạn tạo nên những khoảnh khắc bất ngờ, ngọt ngào và đáng nhớ.</p>
    </div>
  </section>
  <!-- == thế mạnh == -->
  <section class="advantages">
    <div class="advantages-item">
      <div class="advantages-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
          <g fill="none">
            <rect width="18" height="15" x="3" y="6" stroke="currentColor" rx="2" stroke-width="1" />
            <path fill="currentColor" d="M3 10c0-1.886 0-2.828.586-3.414S5.114 6 7 6h10c1.886 0 2.828 0 3.414.586S21 8.114 21 10z" />
            <path stroke="currentColor" stroke-linecap="round" d="M7 3v3m10-3v3" stroke-width="1" />
          </g>
        </svg>
      </div>
      <h3>Chọn ngày giao hàng <br> của bạn</h3>
    </div>
    <div class="advantages-item">
      <div class="advantages-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
          <path fill="currentColor" d="M.75 7.5h9.75l.75 1.5H1.5zm1 3h9.75l.75 1.5H2.5zm16.25 8c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5s.67 1.5 1.5 1.5m1.5-9H17V12h4.46zM8 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5s.67 1.5 1.5 1.5M20 8l3 4v5h-2c0 1.66-1.34 3-3 3s-3-1.34-3-3h-4c0 1.66-1.35 3-3 3c-1.66 0-3-1.34-3-3H3v-3.5h2V15h.76c.55-.61 1.35-1 2.24-1s1.69.39 2.24 1H15V6H3c0-1.11.89-2 2-2h12v4z" />
        </svg>
      </div>
      <h3>Giao hàng <br> nhanh chóng</h3>
    </div>
    <div class="advantages-item">
      <div class="advantages-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
            <path d="M3.464 16.828C2 15.657 2 14.771 2 11s0-5.657 1.464-6.828C4.93 3 7.286 3 12 3s7.071 0 8.535 1.172S22 7.229 22 11s0 4.657-1.465 5.828C19.072 18 16.714 18 12 18c-2.51 0-3.8 1.738-6 3v-3.212c-1.094-.163-1.899-.45-2.536-.96" />
            <path d="M8 9.514h6a2 2 0 0 1 2 2V14M8 9.514l2.39 2.513M8 9.514L10.39 7" />
          </g>
        </svg>
      </div>
      <h3>Liên hệ <br> dễ dàng</h3>
    </div>
    <div class="advantages-item">
      <div class="advantages-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 14 14">
          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
            <path d="M.5.5v13h13" />
            <path d="M3.5 6.5L6 9l4-6l3.5 2.5" />
          </g>
        </svg>
      </div>
      <h3>Giải pháp <br> kinh doanh đa dạng</h3>
    </div>
  </section>
  <!-- Hình ảnh Team -->
  <section id="team">
    <div class="team-text">
      <h2>Những Người Đứng Sau <br> <span>Hygge-Farm</span></h2>
      <p>
        Chúng tôi là một nhóm sinh viên trẻ đầy đam mê với mong muốn mang đến vẻ đẹp của hoa đến gần hơn với mọi người.
        Từ khâu chọn hoa, cắm bó, tất cả đều được chăm chút tỉ mỉ bởi những con người yêu cái đẹp và sáng tạo.
        Mỗi sản phẩm trên trang là kết quả của sự phối hợp hài hòa giữa nghệ thuật và công nghệ.
      </p>
    </div>
    <img src="./images/Team.svg" alt="Hình ảnh team">
  </section>
  <!-- footer -->
  <footer>
    <?php include 'includes/footer.php' ?>
  </footer>
  
  <script src="js/main.js?v=<?= time() ?>"></script>
</body>

</html>
