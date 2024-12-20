<?php include 'header.php' ?>

<?php
include 'db_connection.php'; // Include database connection

// Get service URL text from query parameter
$service_url_text = isset($_GET['url_text']) ? $conn->real_escape_string($_GET['url_text']) : '';

// Fetch service details
$sql = "SELECT * FROM services WHERE url_text = '$service_url_text'";
$result = $conn->query($sql);

$service = null;
if ($result->num_rows > 0) {
  $service = $result->fetch_assoc();
} else {
  echo "Service not found.";
}
$conn->close();
?>

<main class="main">


  <!-- Page Title -->
  <div class="page-title">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Service Details</h1>
            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.php">Home</a></li>
          <li class="current">Service Details</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <!-- Service Details Section -->
  <section id="service-details" class="service-details section">

    <div class="container">

      <div class="service-details">
        <h1><?php echo htmlspecialchars($service['heading']); ?></h1>
        <h2><?php echo htmlspecialchars($service['sub_heading']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
        <?php if (!empty($service['additional_info'])): ?>
          <div class="additional-info">
            <h3>Additional Information:</h3>
            <p><?php echo nl2br(htmlspecialchars($service['additional_info'])); ?></p>
          </div>
        <?php endif; ?>
      </div>

      <div class="row gy-4">

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="services-list">
            <a href="#" class="active">Web Design</a>
            <a href="#">Software Development</a>
            <a href="#">Product Management</a>
            <a href="#">Graphic Design</a>
            <a href="#">Marketing</a>
          </div>

          <h4>Enim qui eos rerum in delectus</h4>
          <p>Nam voluptatem quasi numquam quas fugiat ex temporibus quo est. Quia aut quam quod facere ut non occaecati ut aut. Nesciunt mollitia illum tempore corrupti sed eum reiciendis. Maxime modi rerum.</p>
        </div>

        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
          <img src="assets/img/services.jpg" alt="" class="img-fluid services-img">
          <h3>Temporibus et in vero dicta aut eius lidero plastis trand lined voluptas dolorem ut voluptas</h3>
          <p>
            Blanditiis voluptate odit ex error ea sed officiis deserunt. Cupiditate non consequatur et doloremque consequuntur. Accusantium labore reprehenderit error temporibus saepe perferendis fuga doloribus vero. Qui omnis quo sit. Dolorem architecto eum et quos deleniti officia qui.
          </p>
          <ul>
            <li><i class="bi bi-check-circle"></i> <span>Aut eum totam accusantium voluptatem.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Assumenda et porro nisi nihil nesciunt voluptatibus.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea</span></li>
          </ul>
          <p>
            Est reprehenderit voluptatem necessitatibus asperiores neque sed ea illo. Deleniti quam sequi optio iste veniam repellat odit. Aut pariatur itaque nesciunt fuga.
          </p>
          <p>
            Sunt rem odit accusantium omnis perspiciatis officia. Laboriosam aut consequuntur recusandae mollitia doloremque est architecto cupiditate ullam. Quia est ut occaecati fuga. Distinctio ex repellendus eveniet velit sint quia sapiente cumque. Et ipsa perferendis ut nihil. Laboriosam vel voluptates tenetur nostrum. Eaque iusto cupiditate et totam et quia dolorum in. Sunt molestiae ipsum at consequatur vero. Architecto ut pariatur autem ad non cumque nesciunt qui maxime. Sunt eum quia impedit dolore alias explicabo ea.
          </p>
        </div>

      </div>

    </div>

  </section><!-- /Service Details Section -->

</main>


<?php include 'footer.php' ?>