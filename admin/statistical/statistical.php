<main>
    <!-- /* -------------------------------- GET DATA -------------------------------- */ -->
    <?php 
    $db = require '../config/database.php';
    $statisticalController = new Statistical_Controller($db);
    ?>
    <!-- /* -------------------------------- GET DATA -------------------------------- */ -->
    <!-- Đơn hàng, người dùng, sản phẩm, doanh thu -->
    <div class="statistical">
        <div class="box-statis">
          <div class="ic-statis">
          <i class="fa-solid fa-money-bills" style="color: green;"></i>
          </div>
          <div class="statis-right">
            <div class="title-statis">
             Revenue
            </div>
            <div class="num-statis">
              <?= $total = number_format($statisticalController->statiscalRevenue()) ?> VNĐ
            </div>
          </div>
        </div>
        <div class="box-statis">
          <div class="ic-statis">
            <i class="fa-solid fa-boxes-stacked"></i>
          </div>
          <div class="statis-right">
            <div class="title-statis">
              Orders
            </div>
            <div class="num-statis">
              <?= $statisticalController->statistical('orders') ?>
            </div>
          </div>
        </div>
        <div class="box-statis">
          <div class="ic-statis">
            <i class="fa-solid fa-comments" style="color: gray;"></i>
          </div>
          <div class="statis-right">
            <div class="title-statis">
              Comments
            </div>
            <div class="num-statis">
              <?= $statisticalController->statistical('comments') ?>
            </div>
          </div>
        </div>
        <div class="box-statis">
          <div class="ic-statis">
            <i class="fa-solid fa-users"></i>
          </div>
          <div class="statis-right">
            <div class="title-statis">
              Users
            </div>
            <div class="num-statis">
              <?= $statisticalController->statistical('users') ?>
            </div>
          </div>
        </div>
    </div>
</main>
<!-- /* --------------------------------- ORDER -------------------------------- */ -->
<canvas id="orders"></canvas>
<script>
  const order = document.getElementById('orders');
  new Chart(order, {
    type: 'line',
    data: {
      labels: <?= json_encode($data['date']) ?>,
      datasets: [{
        label: 'Order',
        fill: false,
        data: <?= json_encode($data['orderTotal']) ?>,
        borderWidth: 1,
        borderColor: 'rgba(75, 192, 192, 1)', // Màu sắc của đường
        pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Màu nền của điểm
        pointBorderColor: 'rgba(75, 192, 192, 1)', // Màu đường viền điểm
        pointRadius: 5, // Kích thước của điểm
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- /* --------------------------------- ORDER -------------------------------- */ -->
<br>
<!-- /* --------------------------------- REVENUE -------------------------------- */ -->
<canvas id="revenue"></canvas>
<script>
  const revenue = document.getElementById('revenue');
  new Chart(revenue, {
    type: 'line',
    data: {
      labels: <?= json_encode($data['date']) ?>,
      datasets: [{
        label: 'Revenue',
        fill: false,
        data: <?= json_encode($data['total']) ?>,
        borderWidth: 1,
        borderColor: 'green', // Màu sắc của đường
        pointBackgroundColor: 'green', // Màu nền của điểm
        pointBorderColor: 'green', // Màu đường viền điểm
        pointRadius: 5, // Kích thước của điểm
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- /* --------------------------------- REVENUE -------------------------------- */ -->
