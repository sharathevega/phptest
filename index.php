<?php include 'header.php' ?>
<main class="main">

    <?php
    include 'db_connection.php'; // Include the connection file

    // SQL Query
    $sql = "SELECT * FROM banner_info";
    $result = $conn->query($sql);

    $banner_cards = []; // Initialize an array to hold all banner cards

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $about = $row["one_liner"]; // Store one_liner (if needed)
            $heading = $row["heading"]; // Store heading (if needed)

            // Decode and merge banner_cards JSON
            $cards = json_decode($row['banner_cards'], true);
            if (is_array($cards)) { // Ensure valid JSON data
                $banner_cards = array_merge($banner_cards, $cards);
            }
        }
    } else {
        echo "No results found.";
    }

    $conn->close();
    ?>

    <?php
    include 'db_connection.php';

    $sql = "SELECT * FROM about_us";
    $result = $conn->query($sql);


    $about_one_liner = "";
    $about_heading = "";
    $about_para1 = "";
    $about_para2 = "";
    $about_para3 = "";
    $about_para4 = "";
    $about_ul_list = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $about_one_liner = $row["one_liner"];
            $about_heading = $row["heading"];
            $about_para1 = $row["para1"];
            $about_para2 = $row["para2"];
            $about_para3 = $row["para3"];
            $about_para4 = $row["para4"];
            $about_ul_list = json_decode($row["ul_list"], true);
        }
    } else {
        echo "No results found.";
    }

    $conn->close();
    ?>

    <?php
    include 'db_connection.php'; // Include database connection

    // Fetch all services
    $sql = "SELECT id,url_text, icon, heading, sub_heading FROM services";
    $result = $conn->query($sql);

    $services = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    }
    $conn->close();
    ?>


    <?php
    include 'db_connection.php';

    $sql = "SELECT * FROM test_monials";

    $result = $conn->query($sql);

    $test_monials = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $test_monials[] = $row;
        }
    }
    $conn->close();

    ?>


    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">

        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-5 justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2><?php echo $heading; ?></h2>
                    <p><?php echo $about; ?></p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <img src="assets/img/hero-img.svg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">
                    <?php if (!empty($banner_cards)): ?>
                        <?php foreach ($banner_cards as $card): ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="icon-box">
                                    <div class="icon"><?php echo $card['icon']; ?></div>
                                    <h4 class="title"><a href="" class="stretched-link"><?php echo $card['text']; ?></a></h4>
                                </div>
                            </div><!-- End Icon Box -->
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No banner cards available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About Us<br></h2>
            <p><?php echo $about_one_liner; ?></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <h3><?php echo $about_heading; ?></h3>
                    <img src="assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                    <p><?php echo $about_para1; ?></p>
                    <p><?php echo $about_para2; ?></p>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            <?php echo $about_para3; ?>
                        </p>
                        <ul>
                            <?php if (!empty($about_ul_list)): ?>
                                <?php foreach ($about_ul_list as $item): ?>

                                    <li><i class="bi bi-check-circle-fill"></i> <span><?php echo $item; ?></span></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No list </li>
                            <?php endif; ?>
                        </ul>
                        <p>
                            <?php echo $about_para4; ?>
                        </p>

                        <div class="position-relative mt-4">
                            <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

        <div class="container">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "spaceBetween": 40
                            },
                            "480": {
                                "slidesPerView": 3,
                                "spaceBetween": 60
                            },
                            "640": {
                                "slidesPerView": 4,
                                "spaceBetween": 80
                            },
                            "992": {
                                "slidesPerView": 6,
                                "spaceBetween": 120
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
                </div>
            </div>

        </div>

    </section><!-- /Clients Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-5">
                    <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
                </div>

                <div class="col-lg-7">

                    <div class="row gy-4">

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-emoji-smile flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                                    <p><strong>Happy Clients</strong> <span>consequuntur quae</span></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-journal-richtext flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                                    <p><strong>Projects</strong> <span>adipisci atque cum quia aut</span></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-headset flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                                    <p><strong>Hours Of Support</strong> <span>aut commodi quaerat</span></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-people flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                                    <p><strong>Hard Workers</strong> <span>rerum asperiores dolor</span></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                    </div>

                </div>

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

        <div class="container">
            <img src="assets/img/cta-bg.jpg" alt="">
            <div class="content row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox play-btn"></a>
                        <h3>Call To Action</h3>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <a class="cta-btn" href="#">Call To Action</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call To Action Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Services</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <?php foreach ($services as $service): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <?php echo $service['icon']; ?>
                            </div>
                            <h3><?php echo $service['heading']; ?></h3>
                            <p><?php echo $service['sub_heading']; ?></p>
                            <a href="service_details/<?php echo $service['url_text']; ?>" class="readmore stretched-link">
                                Read more <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 1,
                                "spaceBetween": 40
                            },
                            "1200": {
                                "slidesPerView": 3,
                                "spaceBetween": 10
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper">
                    <?php foreach ($test_monials as $test_monial): ?>

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <?php echo "<img src='assets/img/testimonials/" . $test_monial['profile'] . "' class='testimonial-img' alt=''>"; ?>
                                <h3><?php echo $test_monial['name']; ?></h3>
                                <h4><?php echo $test_monial['destignation']; ?></h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span><?php echo $test_monial['description']; ?></span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Portfolio</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-app">App</li>
                    <li data-filter=".filter-product">Product</li>
                    <li data-filter=".filter-branding">Branding</li>
                    <li data-filter=".filter-books">Books</li>
                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/app-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/app-1.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">App 1</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/product-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/product-1.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Product 1</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/branding-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/branding-1.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Branding 1</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/books-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/books-1.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Books 1</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/app-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/app-2.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">App 2</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/product-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/product-2.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Product 2</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/branding-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/branding-2.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Branding 2</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/books-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/books-2.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Books 2</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/app-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/app-3.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">App 3</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/product-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/product-3.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Product 3</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/branding-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/branding-3.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Branding 3</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                        <div class="portfolio-content h-100">
                            <a href="assets/img/portfolio/books-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/portfolio/books-3.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.php" title="More Details">Books 3</a></h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Team</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                        <h4>Walter White</h4>
                        <span>Web Development</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="member">
                        <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                        <h4>Sarah Jhinson</h4>
                        <span>Marketing</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="member">
                        <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                        <h4>William Anderson</h4>
                        <span>Content</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
                        <h4>Amanda Jepson</h4>
                        <span>Accountant</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>

        </div>

    </section><!-- /Team Section -->

  

    <!-- Faq Section -->
    <section id="faq" class="faq section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="content px-xl-5">
                        <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                        </p>
                    </div>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                    <div class="faq-container">
                        <div class="faq-item faq-active">
                            <h3><span class="num">1.</span> <span>Non consectetur a erat nam at lectus urna duis?</span></h3>
                            <div class="faq-content">
                                <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3><span class="num">2.</span> <span>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</span></h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3><span class="num">3.</span> <span>Dolor sit amet consectetur adipiscing elit pellentesque?</span></h3>
                            <div class="faq-content">
                                <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3><span class="num">4.</span> <span>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</span></h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3><span class="num">5.</span> <span>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</span></h3>
                            <div class="faq-content">
                                <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div>
            </div>

        </div>

    </section><!-- /Faq Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Recent Blog Posts</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <article>

                        <div class="post-img">
                            <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                        </div>

                        <p class="post-category">Politics</p>

                        <h2 class="title">
                            <a href="blog-details.php">Dolorum optio tempore voluptas dignissimos</a>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="assets/img/blog/blog-author.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author">Maria Doe</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01">Jan 1, 2022</time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div><!-- End post list item -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <article>

                        <div class="post-img">
                            <img src="assets/img/blog/blog-2.jpg" alt="" class="img-fluid">
                        </div>

                        <p class="post-category">Sports</p>

                        <h2 class="title">
                            <a href="blog-details.php">Nisi magni odit consequatur autem nulla dolorem</a>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="assets/img/blog/blog-author-2.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author">Allisa Mayer</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01">Jun 5, 2022</time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div><!-- End post list item -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <article>

                        <div class="post-img">
                            <img src="assets/img/blog/blog-3.jpg" alt="" class="img-fluid">
                        </div>

                        <p class="post-category">Entertainment</p>

                        <h2 class="title">
                            <a href="blog-details.php">Possimus soluta ut id suscipit ea ut in quo quia et soluta</a>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="assets/img/blog/blog-author-3.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author">Mark Dower</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01">Jun 22, 2022</time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div><!-- End post list item -->

            </div><!-- End recent posts list -->

        </div>

    </section><!-- /Recent Posts Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-4">
                    <div class="info-container d-flex flex-column align-items-center justify-content-center">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>info@example.com</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                            <i class="bi bi-clock flex-shrink-0"></i>
                            <div>
                                <h3>Open Hours:</h3>
                                <p>Mon-Sat: 11AM - 23PM</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade" data-aos-delay="100">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="8" placeholder="Message" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->

</main>

<?php include 'footer.php' ?>