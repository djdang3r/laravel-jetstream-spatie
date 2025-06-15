<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template">
    <meta name="keywords"
        content="admin template, ra-admin admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="la-themes">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/x-icon">

    <title>Landing | ra-admin - Premium Admin Template</title>

    <!--font-awesome-css-->
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/all.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- Josefin font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

    <!--animation-css-->
    <link rel="stylesheet" href="../assets/vendor/animation/animate.min.css">

    <!-- devicon css -->
    <link rel="stylesheet" href="../assets/vendor/devicon/devicon.min.css">

    <!-- tabler icons-->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/tabler-icons/tabler-icons.css">

    <!--flag Icon css-->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/flag-icons-master/flag-icon.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/bootstrap.min.css">

    <!-- aos css-->
    <link rel="stylesheet" href="../assets/vendor/aos/aos.css">

    <!-- slick css -->
    <link rel="stylesheet" href="../assets/vendor/slick/slick.css">
    <link rel="stylesheet" href="../assets/vendor/slick/slick-theme.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

</head>

<body class="bg-white landing-page">
    <!-- Landing page start -->
    <div class="app-wrapper flex-column">

        <!-- cursor  -->
        <div class="circle-cursor">
        </div>

        <!-- cursor -->

        <div class="landing-wrapper">
            <!-- Header start -->
            <div class="navbar navbar-expand-lg sticky-top landing-nav_main px-3 position-fixed w-100">
                <div class="container-fluid">
                    <a class="navbar-brand logo" href="#home">
                        <img src="../assets/images/logo/1.png" alt="#">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landing_nav"
                        aria-controls="landing_nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="landing_nav">

                        <ul class="navbar-nav m-auto">

                            <li class="nav-item">
                                <a class="nav-link active" href="#Demo">Demo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#Cards">Cards</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#Features">Features</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="document.html" target="_blank">Document</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://forms.gle/q7wFQQRtS2fLDZWbA" class="nav-link" target="_blank">Hire
                                    Us</a>
                            </li>
                        </ul>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                                @endif
                            @endauth
                        @endif

                    </div>
                </div>
            </div>

            <!-- Header end -->

            <!-- landing first section start -->

            <section class="landing-section p-0" id="home">
                <div class="container-fluid">
                    <div class="row landing-content mg-t-50">

                        <div class="col-md-8 offset-md-2">
                            <div class="landing-heading text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h1> Your Ultimate Admin <br> Solution for <span class="highlight-text"
                                            id="highlight-text">Management</span></h1>

                                </div>
                            </div>
                            <div class="rotated-text">
                                <p>Ra-admin Comes with so many sidebar option , layouts like RTl & many more ...!</p>
                            </div>
                            <div class="landing-img">
                                <div class="img-box">
                                    <img src="../assets/images/landing/home-img-1.png" alt="img" class="box-img-1">
                                    <img src="../assets/images/landing/home-mobile.png" alt="img" class="box-img-2">
                                    <img src="../assets/images/landing/hom-tab.gif" alt="img" class="box-img-3">
                                    <div class="rotated-circle-text">
                                        <img src="../assets/images/landing/circle-text.png"
                                            class="w-150 h-150 img-rotated" alt="img">
                                        <img src="../assets/images/logo/3.png" alt="img"
                                            class="bg-light-primary p-4 b-r-50 b-1-primary">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- landing first section end -->
        </div>


        <section class="p-0 overflow-visible">
            <div class="container">
                <div class="language-box">
                    <div class="language-box-item">
                        <a href="./index.html" target="_blank" class="info-box bg-info h-60 w-60 d-flex-center b-r-50"
                            data-bs-toggle="tooltip" data-bs-custom-class="custom-dark" data-bs-html="true"
                            data-bs-original-title="Bootstrap">
                            <i class="devicon-bootstrap-plain f-s-28 align-text-bottom"></i>
                        </a>
                    </div>
                    <div class="language-box-item">
                        <a href="https://phpstack-426242-2145512.cloudwaysapps.com/RaAdmin-PHP/template/index.php"
                            class="danger-box bg-danger h-60 w-60 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            target="_blank" data-bs-custom-class="custom-dark" data-bs-html="true"
                            data-bs-original-title="PHP">
                            <i class="devicon-php-plain f-s-30 align-middle"></i>
                        </a>
                    </div>
                    <div class="language-box-item">
                        <a href="./index.html" class="primary-box bg-primary h-60 w-60 d-flex-center b-r-50"
                            target="_blank" data-bs-toggle="tooltip" data-bs-custom-class="custom-dark"
                            data-bs-html="true" data-bs-original-title="Laravel">
                            <i class="devicon-laravel-plain f-s-28 align-middle"></i>
                        </a>
                    </div>
                    <div class="language-box-item">
                        <a href="https://www.figma.com/design/BwsML2vqoiWf764OVrymN3/RA-ADMIN?node-id=0-1&node-type=canvas&t=JJ14dHmrXRZ33NQ1-0"
                            target="_blank" class="warning-box bg-warning h-60 w-60 d-flex-center b-r-50"
                            data-bs-toggle="tooltip" data-bs-custom-class="custom-dark" data-bs-html="true"
                            data-bs-original-title="Figma">
                            <i class="devicon-figma-plain f-s-26 align-text-bottom text-white"></i>
                        </a>
                    </div>
                    <div class="language-box-item">
                        <a href="./index.html" target="_blank"
                            class="success-box bg-success h-60 w-60 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            data-bs-custom-class="custom-dark" data-bs-html="true" data-bs-original-title="Codeigniter">
                            <img src="../assets/images/document/codeigniter.png" alt="avtar" class="w-25 h-25">
                        </a>
                    </div>
                    <div class="language-box-item">
                        <a href="./index.html" target="_blank" class="dark-box bg-dark h-60 w-60 d-flex-center b-r-50"
                            data-bs-toggle="tooltip" data-bs-custom-class="custom-dark" data-bs-html="true"
                            data-bs-original-title="Symfony">
                            <i class="devicon-symfony-plain f-s-26"></i>
                        </a>
                    </div>
                    <div class="language-box-item">
                        <a href="https://phpstack-426242-2145512.cloudwaysapps.com/RaAdmin-PHP/template/index.php"
                            class="danger-box bg-danger h-60 w-60 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            target="_blank" data-bs-custom-class="custom-dark" data-bs-html="true"
                            data-bs-original-title="CakePHP">
                            <i class="devicon-cakephp-plain f-s-30 align-middle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <!-- Demos section start -->
        <section class="demos-section" id="Demo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="landing-title text-md-center">
                            <h2 class=""><span class="highlight-title">150+</span> pages</h2>
                            <p>All pages created with unlimited features that will reduce the cost, efforts and your
                                time.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 offset-xl-2">
                        <div class="demos-tab-section ">

                            <ul class="nav nav-tabs app-tabs-dark" id="v-bg" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                        data-bs-target="#dashboard-tab-pane" type="button" role="tab"
                                        aria-controls="dashboard-tab-pane" aria-selected="true">
                                        <i class="ti ti-home pe-2 ps-1"></i> Dashboard
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="apps-tab" data-bs-toggle="tab"
                                        data-bs-target="#apps-tab-pane" type="button" role="tab"
                                        aria-controls="apps-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-server pe-2 ps-1"></i> Apps
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ui-tab" data-bs-toggle="tab"
                                        data-bs-target="#ui-tab-pane" type="button" role="tab"
                                        aria-controls="ui-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-first-aid-kit pe-2 ps-1"></i> UI Kits
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="advance-ui-tab" data-bs-toggle="tab"
                                        data-bs-target="#advance-ui-tab-pane" type="button" role="tab"
                                        aria-controls="advance-ui-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-briefcase pe-2 ps-1"></i> Advance UI
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="icons-tab" data-bs-toggle="tab"
                                        data-bs-target="#icons-tab-pane" type="button" role="tab"
                                        aria-controls="icons-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-icons pe-2 ps-2"></i> Icons
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="table-tab" data-bs-toggle="tab"
                                        data-bs-target="#table-tab-pane" type="button" role="tab"
                                        aria-controls="table-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-table pe-2 ps-2"></i> Tables
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="forms-tab" data-bs-toggle="tab"
                                        data-bs-target="#forms-tab-pane" type="button" role="tab"
                                        aria-controls="forms-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-forms pe-2 ps-2"></i> Forms
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ready-touse-tab" data-bs-toggle="tab"
                                        data-bs-target="#ready-touse-tab-pane" type="button" role="tab"
                                        aria-controls="ready-touse-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-table-import pe-2 ps-2"></i> Ready To Use
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="auth-tab" data-bs-toggle="tab"
                                        data-bs-target="#auth-tab-pane" type="button" role="tab"
                                        aria-controls="auth-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-news pe-2 ps-2"></i> Auth Pages
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="error-tab" data-bs-toggle="tab"
                                        data-bs-target="#error-tab-pane" type="button" role="tab"
                                        aria-controls="error-tab-pane" aria-selected="false" tabindex="-1">
                                        <i class="ti ti-news pe-2 ps-2"></i> Error Pages
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">


                        <div class="tab-content mt-3">
                            <!-- Dashboard tab start -->
                            <div class="tab-pane fade show active" id="dashboard-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/ecommerce-dashboard.jpg"
                                                    alt="demo-img" class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Ecommerce</h6>
                                                    <a href="index.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">

                                                <img src="../assets/images/landing/project-dashboard.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Project</h6>
                                                    <a href="project_dashboard.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">

                                                <img src="../assets/images/landing/crypto.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Crypto</h6>
                                                    <a href="crypto_dashboard.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">

                                                <img src="../assets/images/landing/education-dashboard.jpg"
                                                    alt="demo-img" class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Education</h6>
                                                    <a href="education.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard tab end -->

                            <!--  Apps tab start -->
                            <div class="tab-pane fade" id="apps-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/calander.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Calender</h6>
                                                    <a href="calendar.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/profile.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Profile</h6>
                                                    <a href="profile.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/team.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Team</h6>
                                                    <a href="team.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/chat.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Chat</h6>
                                                    <a href="chat.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/email.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Email</h6>
                                                    <a href="email.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/ecommerce.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Ecommerce</h6>
                                                    <a href="product.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/todo.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Todo</h6>
                                                    <a href="to_do.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/file-manager.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">File manager</h6>
                                                    <a href="file_manager.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/blog.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Blog</h6>
                                                    <a href="blog.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Apps tab end -->

                            <!--UI Kits tab  -->
                            <div class="tab-pane fade" id="ui-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">

                                                <img src="../assets/images/landing/alert.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Alert</h6>
                                                    <a href="alert.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/badges.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Badges</h6>
                                                    <a href="badges.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/buttons.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Buttons</h6>
                                                    <a href="buttons.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/dropdown.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Dropdown</h6>
                                                    <a href="dropdown.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/avtar.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Avtar</h6>
                                                    <a href="avtar.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/accordions.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Accordions</h6>
                                                    <a href="accordions.html" target="_blank" role="button"
                                                        class="btn btn-warning  icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/progress.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Progress</h6>
                                                    <a href="progress.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/notification.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Notifications</h6>
                                                    <a href="notifications.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--UI Kits end  -->

                            <!--Advance UI tab  -->
                            <div class="tab-pane fade" id="advance-ui-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/modal.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Modals</h6>
                                                    <a href="modals.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/sweet-alert.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Sweetalert</h6>
                                                    <a href="sweetalert.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/animation.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Animation</h6>
                                                    <a href="animation.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/video-embaded.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Video embaded</h6>
                                                    <a href="video_embed.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/tour.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Tour</h6>
                                                    <a href="tour.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/slider.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Slider</h6>
                                                    <a href="slick.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/rating.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Rating</h6>
                                                    <a href="ratings.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/count-down.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Count Down</h6>
                                                    <a href="count_down.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Advance UI end  -->

                            <!-- Icons tab start -->
                            <div class="tab-pane fade" id="icons-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">

                                                <img src="../assets/images/landing/font-awesome.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Fontawesome Icons</h6>
                                                    <a href="fontawesome.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/flag.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Flag Icons</h6>
                                                    <a href="flag_icons.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/animated.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Animated Icons</h6>
                                                    <a href="animated_icon.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/weather.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Whether Icons</h6>
                                                    <a href="weather_icon.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Icons tab end -->

                            <!-- Table tab start -->
                            <div class="tab-pane fade" id="table-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/basic-table.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Basic Table</h6>
                                                    <a href="basic_table.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/data-table.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Data Table</h6>
                                                    <a href="data_table.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/list-js.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">List Js</h6>
                                                    <a href="list_table.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/advance-table.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Advance Table</h6>
                                                    <a href="advance_table.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Table tab end -->

                            <!-- form tab start -->
                            <div class="tab-pane fade" id="forms-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/base-input.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Basic input</h6>
                                                    <a href="base_inputs.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/form-validation.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Form Validation</h6>
                                                    <a href="form_validation.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/checkbox.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Checkbox & Radio</h6>
                                                    <a href="checkbox_radio.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/input-mask.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Input Mask</h6>
                                                    <a href="input_masks.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/floating-lable.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Floating Labels</h6>
                                                    <a href="floating_labels.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/select.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Select</h6>
                                                    <a href="select.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/range-slider.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Range Slider</h6>
                                                    <a href="range_slider.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/clip-board.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Clipboard</h6>
                                                    <a href="clipboard.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/file-upload.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">File Upload</h6>
                                                    <a href="file_upload.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/duel-list-box.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Dual Listbox</h6>
                                                    <a href="dual_list_boxes.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/default-form.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Default Forms</h6>
                                                    <a href="default_forms.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- form tab end -->

                            <!-- Ready to use tab start -->
                            <div class="tab-pane fade" id="ready-touse-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">

                                                <img src="../assets/images/landing/form-wizard.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Form Wizards</h6>
                                                    <a href="form_wizards.html" target="_blank" role="button"
                                                        class="btn btn-secondary icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/form-wizard-1.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Form Wizards 1</h6>
                                                    <a href="form_wizard_1.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/form-wizard-2.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Form Wizards 2</h6>
                                                    <a href="form_wizard_2.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/ready-to-use-form.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Ready To Use Form</h6>
                                                    <a href="ready_to_use_form.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">
                                                        <i class="ti ti-chevrons-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/ready-to-use-table.jpg"
                                                    alt="demo-img" class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Ready To Use table</h6>
                                                    <a href="ready_to_use_table.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Ready to use tab end -->

                            <!-- Auth page tab start -->
                            <div class="tab-pane fade" id="auth-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-1.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Sign In</h6>
                                                    <a href="sign_in.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-2.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Sign In With Bgimage</h6>
                                                    <a href="sign_in_1.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-3.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Sign-up</h6>
                                                    <a href="sign_up.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-4.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Sign Up With Bgimage</h6>
                                                    <a href="sign_up_1.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-5.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Password Create</h6>
                                                    <a href="pwd_create.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-6.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Password reset</h6>
                                                    <a href="pwd_reset.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-7.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Lock Screen</h6>
                                                    <a href="lock_screen.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/auth-8.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Tow Step Verification</h6>
                                                    <a href="two_step_verification.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">

                                                        <i class="ti ti-chevrons-right"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Auth page tab end -->

                            <!-- Error tab start -->
                            <div class="tab-pane fade" id="error-tab-pane" role="tabpanel" tabindex="0">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">

                                                <img src="../assets/images/landing/error-400.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Bad Request</h6>
                                                    <a href="error_400.html" target="_blank" role="button"
                                                        class="btn btn-danger icon-btn b-r-22">
                                                        <i class="ph-bold  ph-caret-right f-s-18 f-w-900"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/error-403.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Forbidden</h6>
                                                    <a href="error_403.html" target="_blank" role="button"
                                                        class="btn btn-success icon-btn b-r-22">
                                                        <i class="ph-bold  ph-caret-right f-s-18 f-w-900"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/error-404.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Not Found</h6>
                                                    <a href="error_404.html" target="_blank" role="button"
                                                        class="btn btn-primary icon-btn b-r-22">
                                                        <i class="ph-bold  ph-caret-right f-s-18 f-w-900"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/error-500.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Internal Server</h6>
                                                    <a href="error_500.html" target="_blank" role="button"
                                                        class="btn btn-warning icon-btn b-r-22">
                                                        <i class="ph-bold  ph-caret-right f-s-18 f-w-900"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card demo-card">
                                            <div class="card-body">
                                                <img src="../assets/images/landing/error-503.jpg" alt="demo-img"
                                                    class="img-fluid b-r-8">
                                                <div class="demo-box">
                                                    <h6 class="m-0 f-w-500 f-s-18">Service Unavailable</h6>
                                                    <a href="error_503.html" target="_blank" role="button"
                                                        class="btn btn-info icon-btn b-r-22">
                                                        <i class="ph-bold  ph-caret-right f-s-18 f-w-900"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Error tab end -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Demos section end  -->

        <!-- Features section start -->
        <section class="features-section" id="Features">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="landing-title text-md-center">
                            <h2 class=""> Core <span class="highlight-title">features</span></h2>
                            <p class="text-secondary">Admin features, developers can easily customize the appearance and
                                behavior of
                                their applications,
                                ensuring a consistent and visually appealing experience across different devices and
                                screen
                                sizes.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <ul class="row features-list">

                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">

                                    <i class="ti ti-brand-bootstrap f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Bootstrap</h5>
                                        <span class="badge bg-light-info mt-1">Framework </span>
                                    </div>

                                </div>
                            </li>

                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">
                                    <i class="ti ti-circle-letter-w f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5> W3C</h5>
                                        <span class="badge bg-light-success mt-1">Validation</span>
                                    </div>

                                </div>
                            </li>

                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">

                                    <i class="ti ti-brand-sass f-s-36 text-primary"></i>

                                    <div class="features-content">
                                        <h5>SASS</h5>
                                        <span class="badge bg-light-danger mt-1">Professional grade</span>
                                    </div>

                                </div>
                            </li>
                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">

                                    <i class="ti ti-chart-pie f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Apex Chart</h5>
                                        <span class="badge bg-light-secondary mt-1">Charts</span>
                                    </div>

                                </div>
                            </li>
                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">

                                    <i class="ti ti-package f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Webpack</h5>
                                        <span class="badge bg-light-primary mt-1">Module bundler</span>
                                    </div>
                                </div>

                            </li>


                            <li class="col-6 col-md-3 col-xl-2">

                                <div class="features-icon">
                                    <i class="ti ti-map-2 f-s-36 text-primary"></i>

                                    <div class="features-content">
                                        <h5>Google Map</h5>
                                        <span class="badge bg-light-warning mt-1">Maps</span>
                                    </div>
                                </div>
                            </li>

                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">
                                    <i class="ti ti-chart-radar f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Chart js</h5>
                                        <span class="badge bg-light-warning mt-1">Charts</span>
                                    </div>
                                </div>
                            </li>

                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">
                                    <i class="ti ti-brand-google f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Goggle Fonts</h5>
                                        <span class="badge bg-light-dark mt-1">Fonts</span>
                                    </div>

                                </div>
                            </li>
                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">
                                    <i class="ti ti-briefcase f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Ui kits</h5>
                                        <span class="badge bg-light-primary mt-1">Components</span>
                                    </div>
                                </div>
                            </li>
                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">

                                    <i class="ti ti-apps f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Apps</h5>
                                        <span class="badge bg-light-success mt-1">Apps</span>
                                    </div>
                                </div>
                            </li>

                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">

                                    <i class="ti ti-brand-npm f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>NPM</h5>
                                        <span class="badge bg-light-danger mt-1">Pkg Manager</span>
                                    </div>

                                </div>
                            </li>

                            <li class="col-6 col-md-3 col-xl-2">
                                <div class="features-icon">

                                    <i class="ti ti-calendar-plus f-s-36 text-primary"></i>
                                    <div class="features-content">
                                        <h5>Fullcalendar</h5>
                                        <span class="badge bg-light-info mt-1">Event Calendar</span>
                                    </div>

                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features section end -->

        <!-- Faq section start -->
        <section class="faq-section">
            <div class="container">

                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="landing-title text-md-center">
                            <h2>Inquired <span class="highlight-title"> Queries</span></h2>
                            <p class="text-light">After reading the instructions, I had a few inquired queries about the
                                process
                                and decided to reach out
                                to customer support for clarification.</p>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 col-sm-6 mb-3">
                                <div class="card-boxs">
                                    <div class="icon-boxs">
                                        <i class="ti ti-book-2"></i>
                                    </div>
                                    <div class="box-content">
                                        <h4>Digitize Your Documents</h4>
                                        <p>Efficiently Arranged and Current</p>
                                        <a role="button" target="_blank" class="btn btn-primary"
                                            href="document.html">Check
                                            Document</a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="card-boxs">
                                    <div class="icon-boxs">
                                        <i class="ti ti-headphones"></i>
                                    </div>
                                    <div class="box-content">
                                        <h4>Committed Assistance</h4>
                                        <p>Require assistance? Send us a ticket. We're here to help!</p>
                                        <a role="button" target="_blank" class="btn btn-primary"
                                            href="mailto:teqlathemes@gmail.com.">Get
                                            Support</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="landing-accordion">
                            <div class="accordion app-accordion accordion-flush accordion-light-dark app-accordion-plus"
                                id="nestingExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#nestingcollapseOne" aria-expanded="true"
                                            aria-controls="nestingcollapseOne">
                                            What is the role of an admin??
                                        </button>
                                    </h2>
                                    <div id="nestingcollapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#nestingExample">
                                        <div class="accordion-body">
                                            <p>Admins are responsible for managing and overseeing the smooth operation
                                                of a
                                                system, platform,
                                                or organization.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#nestingcollapseTwo"
                                            aria-expanded="false" aria-controls="nestingcollapseTwo">
                                            How do I add or remove users?
                                        </button>
                                    </h2>
                                    <div id="nestingcollapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#nestingExample">
                                        <div class="accordion-body">
                                            <p>
                                                Depending on the system, user management can usually be done through the
                                                admin dashboard. Look
                                                for the <strong>"User Management"</strong> or <strong>"Admin
                                                    Settings"</strong> section, where
                                                you can add or remove users and
                                                assign roles.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#nestingcollapseFour"
                                            aria-expanded="false">
                                            What security measures should I implement?
                                        </button>
                                    </h2>
                                    <div id="nestingcollapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#nestingExample">
                                        <div class="accordion-body">
                                            <p>
                                                Admins should prioritize security by enforcing strong password policies,
                                                implementing two-factor
                                                authentication, regularly updating software, and monitoring system logs
                                                for
                                                any suspicious
                                                activities.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#nestingcollapseFive"
                                            aria-expanded="false">
                                            How can I troubleshoot common issues?
                                        </button>
                                    </h2>
                                    <div id="nestingcollapseFive" class="accordion-collapse collapse"
                                        data-bs-parent="#nestingExample">
                                        <div class="accordion-body">
                                            <p>
                                                Document and follow a systematic approach to troubleshooting. Check
                                                error
                                                logs, consult
                                                documentation, and involve relevant stakeholders if needed.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#nestingcollapseSix"
                                            aria-expanded="false">
                                            How can I stay informed about updates and patches?
                                        </button>
                                    </h2>
                                    <div id="nestingcollapseSix" class="accordion-collapse collapse"
                                        data-bs-parent="#nestingExample">
                                        <div class="accordion-body">
                                            <p>
                                                Subscribe to official newsletters, forums, or mailing lists related to
                                                the
                                                software or system
                                                you're administering. Regularly check the official website for
                                                announcements
                                                and security
                                                patches. Stay informed about the latest industry trends and best
                                                practices.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#nestingcollapseSeven"
                                            aria-expanded="false">
                                            What is the process for system upgrades?
                                        </button>
                                    </h2>
                                    <div id="nestingcollapseSeven" class="accordion-collapse collapse"
                                        data-bs-parent="#nestingExample">
                                        <div class="accordion-body">
                                            <p>
                                                Before upgrading, thoroughly review release notes, test the upgrade in a
                                                non-production
                                                environment, and ensure compatibility with existing plugins or
                                                integrations.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#nestingcollapseEight"
                                            aria-expanded="false">
                                            How do I handle user access permissions?
                                        </button>
                                    </h2>
                                    <div id="nestingcollapseEight" class="accordion-collapse collapse"
                                        data-bs-parent="#nestingExample">
                                        <div class="accordion-body">
                                            <p>
                                                Website design projects can vary depending on their scale and
                                                complexity—making it hard to
                                                generalize about project timelines. Ideally, a typical website design
                                                project should take
                                                between 6 and 12 weeks.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Faq section end -->

        <!-- Cards Sections start -->
        <section class="card-section" id="Cards">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="landing-title">
                            <h2>Sophisticated <span class="highlight-title"> Cards</span></h2>
                            <p>Cards offer enhanced design flexibility and interactive capabilities,
                                incorporating dynamic elements
                                like animations, real-time updates, or embedded multimedia to provide a richer and more
                                engaging user
                                experience in a concise card format.</p>
                        </div>
                        <ul class="card-details-list">
                            <li>200+ Cards Collection</li>
                            <li>Basic Components Included</li>
                            <li>Advanced Functionality</li>
                            <li>Customization and Personalization</li>
                            <li>Responsive Card Design</li>
                            <li>Styleguide Included</li>
                        </ul>
                    </div>
                    <div class="col-8">
                        <div class="card-section-right">
                            <div class="slider-container">
                                <div class="slider-container-box">
                                    <div class="slider-slideUp">
                                        <img src="../assets/images/landing/landing-bg.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                    <div class="slider-slideUp">
                                        <img src="../assets/images/landing/landing-bg.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                    <div class="slider-slideUp">
                                        <img src="../assets/images/landing/landing-bg.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                </div>
                                <div class="slider-container-box slider-left">
                                    <div class="slider-slideDown">
                                        <img src="../assets/images/landing/landing-bg-1.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                    <div class="slider-slideDown">
                                        <img src="../assets/images/landing/landing-bg-1.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                    <div class="slider-slideDown">
                                        <img src="../assets/images/landing/landing-bg-1.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                </div>
                                <div class="slider-container-box">
                                    <div class="slider-slideUp">
                                        <img src="../assets/images/landing/landing-bg-2.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                    <div class="slider-slideUp">
                                        <img src="../assets/images/landing/landing-bg-2.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                    <div class="slider-slideUp">
                                        <img src="../assets/images/landing/landing-bg-2.png" class="img-fluid"
                                            alt="card-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Cards Sections end  -->


        <!-- Element section start  -->
        <section class="element-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="landing-title text-md-center">
                            <h2><span class="highlight-title">Elements</span> of ra-admin</h2>
                            <p>offer a responsive and user-friendly interface, streamlining the design and
                                development of web
                                applications by providing a robust set of pre-built components and templates.</p>
                        </div>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div>
                                <div class="element-icons icons-primary">
                                    <i class="ti ti-playstation-circle"></i>
                                </div>

                                <div class="element-content">
                                    <h4>Buttons</h4>
                                    <p>Apply Custom button styles to forms, dialogs, and various elements, featuring
                                        support
                                        for multiple
                                        sizes and states.</p>
                                    <a role="button" href="./buttons.html" target="_blank"
                                        class="link-btn link-primary mt-3 ">View Buttons
                                        <i class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div class="">
                                <div class="element-icons icons-secondary">
                                    <i class="ti ti-cards"></i>
                                </div>
                                <div class="element-content">
                                    <h4>Cards</h4>
                                    <p>Create stylish cards with Admin Element for organized content presentation and a
                                        sleek user
                                        interface.</p>
                                    <a role="button" href="./cards.html" target="_blank"
                                        class="link-btn link-primary mt-3">View Cards <i
                                            class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div>
                                <div class="element-icons icons-dark">
                                    <i class="ti ti-list-details"></i>
                                </div>
                                <div class="element-content">
                                    <h4>List</h4>
                                    <p>Easily design lists with Admin Element intuitive elements for structured content
                                        display, enhancing
                                        user experience.</p>
                                    <a role="button" href="./list.html" target="_blank"
                                        class="link-btn link-primary mt-3">View List <i
                                            class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div class="">
                                <div class="element-icons icons-secondary">
                                    <i class="ti ti-alert-circle"></i>
                                </div>
                                <div class="element-content">
                                    <h4>Alerts</h4>
                                    <p>Create alerts using Admin Elements intuitive elements to effectively communicate
                                        messages.</p>
                                    <a role="button" href="./alert.html" target="_blank"
                                        class="link-btn link-primary mt-3">View Alerts <i
                                            class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div class="">
                                <div class="element-icons icons-dark">
                                    <i class="ti ti-cooker"></i>
                                </div>
                                <div class="element-content">
                                    <h4>Accordions</h4>
                                    <p>Create collapsible accordion in Admin for organized content presentation,
                                        optimizing
                                        user
                                        interaction.</p>
                                    <a role="button" href="./accordions.html" target="_blank"
                                        class="link-btn link-primary mt-3">View
                                        Accordions <i class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div class="">
                                <div class="element-icons icons-primary">
                                    <i class="ti ti-circle-chevron-down"></i>
                                </div>
                                <div class="element-content">
                                    <h4>Dropdown</h4>
                                    <p>Create dropdown using Admin Elements for enhanced user interaction and intuitive
                                        navigation.</p>
                                    <a role="button" href="./dropdown.html" target="_blank"
                                        class="link-btn link-primary mt-3">View Dropdown
                                        <i class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div class="">
                                <div class="element-icons icons-dark">
                                    <i class="ti ti-line-dotted"></i>
                                </div>
                                <div class="element-content">
                                    <h4>Dividers</h4>
                                    <p>Create dividers effortlessly with Admin Elements utilities, enhancing content
                                        organization. </p>
                                    <a role="button" href="./divider.html" target="_blank"
                                        class="link-btn link-primary mt-3">View Dividers
                                        <i class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div class="">
                                <div class="element-icons icons-primary">
                                    <i class="ti ti-chart-candle"></i>
                                </div>
                                <div class="element-content">
                                    <h4>Progress</h4>
                                    <p>Utilize Progress components for visually appealing representation of task
                                        completion
                                        and data
                                        loading. </p>
                                    <a role="button" href="./progress.html" target="_blank"
                                        class="link-btn link-primary mt-3">View Progress
                                        <i class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="element-card">
                            <div class="">
                                <div class="element-icons icons-secondary">
                                    <i class="ti ti-bell-ringing"></i>
                                </div>
                                <div class="element-content">
                                    <h4>Notifications</h4>
                                    <p>Employ Admin notification Elements for streamlined user alerts, enhancing
                                        interactivity and user
                                        experience. </p>
                                    <a role="button" href="./notifications.html" target="_blank"
                                        class="link-btn link-primary mt-3">View
                                        Notifications <i class="ti ti-chevrons-right mt-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--Element section end  -->

        <!-- Dark Mode section -->
        <section class="dark-section">
            <div class="container">


                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="landing-title text-md-center">
                            <h2>Discover Our <span class="highlight-title"> Dark Layout</span></h2>
                            <p class="text-light">Embrace the elegance of the dark layout, where simplicity meets
                                sophistication.
                                Navigate effortlessly through your admin tasks with style.</p>
                        </div>
                    </div>
                    <div class="col-12 ">

                        <div class="slider-container">
                            <div class="slider-container-box">
                                <div class="slider-slideLeft">
                                    <img src="../assets/images/landing/dark-layout.png" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="slider-container-box slider-left">
                                <div class="slider-slideRight">
                                    <img src="../assets/images/landing/dark-layout-1.png" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-lg btn-primary mt-5" id="darkDemoBtn">Check Now<i
                                class="ti ti-chevrons-right ms-2"></i></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dark Mode section -->

        <!-- Customization  options section start -->
        <section class="options-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="landing-title text-md-center">
                            <h2><span class="highlight-title">Customization</span> and preview</h2>
                            <p>Allow users to personalize settings or design elements in real-time, providing
                                an instant preview of
                                the changes before finalizing, ensuring a seamless and tailored experience</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="card  sidebar-option-card">
                            <div class="card-body p-0">
                                <div class="">

                                    <div class="">
                                        <h2 class="text-white f-w-600">Customize your <br> <span
                                                class="text-dark">sidebar</span> with ease</h2>
                                    </div>
                                    <div class="text-end">
                                        <img src="../assets/images/landing/layout.png" class="img-fluid mt-3"
                                            alt="layout-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5">
                        <div class="card equal-card color-hint-card">
                            <div class="card-body">
                                <div class="marquee-animated">
                                    <p>Preview variant colors for perfect customization!</p>
                                </div>
                                <div>
                                    <img src="../assets/images/landing/color-hint.gif" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card speed-performance-card">
                            <div class="card-body text-center">
                                <h3 class="text-dark f-w-600"><span class="text-success">Quick </span> Response</h3>
                                <div class="mt-5">
                                    <img src="../assets/images/landing/speed-performance.png" class="img-fluid" alt="">
                                </div>

                                <div class="performance-content ">
                                    <div class="text-end">
                                        <img src="../assets/images/landing/arrow-shape.png" class="arrow-shape"
                                            alt="img">
                                    </div>
                                    <div class="performance-number">
                                        <p class="f-w-500 f-s-18 text-dark">Performance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 ">
                        <div class="card equal-card layout-option-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 position-relative">
                                        <h3 class="text-light mt-3">One-Click and change your <span
                                                class="text-primary f-w-600">Layout.</span></h3>
                                        <svg width="98" height="132" viewBox="0 0 98 132" fill=""
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="text-brand absolute hidden md:block -left-12 xl:-left-24 -bottom-32 xl:-bottom-44 transition ease-in-out transform-gpu">
                                            <path
                                                d="M46.9684 132C46.3582 132 45.7557 132 45.1494 131.951C44.6766 131.926 44.2134 131.808 43.7861 131.603C43.3589 131.398 42.976 131.111 42.6593 130.758C42.3426 130.405 42.0982 129.993 41.9403 129.545C41.7824 129.098 41.7139 128.623 41.7388 128.149C41.7637 127.675 41.8815 127.21 42.0854 126.781C42.2893 126.353 42.5753 125.969 42.9272 125.651C43.2791 125.333 43.6899 125.088 44.1362 124.93C44.5825 124.771 45.0556 124.702 45.5283 124.727C59.2502 125.488 80.2707 113.551 88.494 95.2532C90.3887 91.0295 92.8253 83.1715 87.7777 78.0241C85.4623 75.6671 82.4724 74.3669 79.3953 73.7016C78.8117 74.5912 78.1978 75.458 77.546 76.3057C70.2663 85.7757 55.3659 99.5491 44.1982 98.6861C40.3329 98.3896 37.2785 96.4051 35.3686 92.9076C33.7959 90.0412 33.8528 86.6729 35.5278 83.4262C36.8428 80.8829 39.1126 78.3929 42.2807 76.0282C50.4888 69.8924 63.7825 65.2924 75.5111 65.95C79.9145 56.9515 80.4943 46.5046 76.269 41.2051C74.1355 38.5211 70.2057 34.8601 60.7584 34.0465C57.9495 33.8716 55.1304 33.9607 52.3381 34.3127C48.954 44.6038 40.4238 53.7999 32.5492 57.6548C25.6295 61.0421 19.7141 60.046 16.7317 54.9936C13.4121 49.3672 14.837 44.8052 16.6104 41.9654C21.4042 34.3089 34.9517 29.8381 46.4605 27.8993C46.8775 25.1558 46.5865 22.3509 45.6155 19.7523C43.6866 14.8102 39.3741 10.826 33.7846 8.82636C26.1677 6.10057 16.1709 6.92552 4.8781 11.2328C4.43594 11.401 3.96514 11.4803 3.49246 11.466C3.01978 11.4517 2.55454 11.3441 2.12329 11.1494C1.25236 10.7562 0.572784 10.032 0.234084 9.13617C-0.104616 8.24033 -0.0747715 7.24622 0.317165 6.3725C0.709101 5.49878 1.43098 4.81707 2.32397 4.47729C15.4206 -0.510484 26.8195 -1.33547 36.2062 2.02519C43.7549 4.72817 49.6286 10.2292 52.3192 17.1178C53.5254 20.2528 54.0299 23.6155 53.7971 26.9678C56.3162 26.7255 58.8507 26.6861 61.3761 26.85C70.5506 27.6408 77.2656 30.8607 81.9039 36.7039C87.5693 43.8358 87.6603 56.1151 82.8893 67.1666C86.6655 68.1971 90.111 70.1919 92.8898 72.9565C98.8621 79.0391 99.6276 88.0187 95.0385 98.2223C87.5883 114.893 66.7497 132 46.9684 132ZM70.8423 73.1922C69.8684 73.2568 68.9665 73.3519 68.1707 73.4583C60.4022 74.4848 52.1373 77.6934 46.6008 81.822C43.6298 84.0383 40.5641 87.3648 41.6744 89.4253C42.4096 90.7597 43.3266 91.3755 44.7514 91.4858C50.6972 91.961 62.3766 83.6885 70.8423 73.196V73.1922ZM44.0504 35.6889C34.8987 37.6619 25.622 41.2165 22.742 45.8165C21.9841 47.0482 21.3928 48.6639 22.9617 51.3213C24.163 53.359 27.5091 52.1044 29.4266 51.173C34.8722 48.5157 40.7611 42.4938 44.058 35.6927L44.0504 35.6889Z"
                                                fill="#ebc33f"></path>
                                        </svg>
                                    </div>
                                    <div class="col-sm-8 z-1">
                                        <img src="../assets/images/landing/layout-option.png" class="img-fluid mt-4"
                                            alt="layout-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Customization  options section end -->


        <!-- wrapper Section  -->
        <section class="box-wrapper-section p-0">
            <div class="container-fluid box-wrapper">
                <ul class="box-wrapper-list">
                    <li> Fully Customizable</li>
                    <li>Google Font</li>
                    <li>10+ Apps</li>
                    <li>Fully Customizable</li>
                    <li>100+ Custom Elements</li>
                    <li>Mobile Responsive design</li>
                    <li>150+ Pages</li>
                    <li>Creative Card Design</li>
                    <li>4+ Icons Set</li>
                    <li>Quick Response</li>
                    <li>Multiple Sidebar Options</li>

                    <li> Fully Customizable</li>
                    <li>Google Font</li>
                    <li>10+ Apps</li>
                    <li>Fully Customizable</li>
                    <li>100+ Custom Elements</li>
                    <li>Mobile Responsive design</li>
                    <li>150+ Pages</li>
                    <li>Creative Card Design</li>
                    <li>4+ Icons Set</li>
                    <li>Quick Response</li>
                    <li>Multiple Sidebar Options</li>
                </ul>
            </div>
        </section>

        <!-- wrapper Section -->

        <!-- Purchase Plans section start  -->
        <section class="plans-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="landing-title text-md-center">
                            <h2>Purchase <span class="highlight-title">Plans</span></h2>
                            <p>Include information on how users can navigate your platform, select a plan, and
                                complete the
                                transaction.</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Pricing</h5>
                            </div>
                            <div class="card-body plans-section pricing-plan-section">
                                <div class="row pricing-slider-container slick-initialized slick-slider">
                                    <div class="slick-list draggable">
                                        <div class="slick-track"
                                            style="opacity: 1; width: 1075px; transform: translate3d(0px, 0px, 0px);">

                                            <div class="col-md-6 col-xl-4 p-3 slick-slide slick-active"
                                                data-slick-index="1" aria-hidden="false" tabindex="0"
                                                style="width: 525px;">
                                                <div class="card pricing-cards mb-0">
                                                    <div class="card-body">
                                                        <div class="box-ribbon box-right">
                                                            <div class="ribbonbox ribbon-danger">FREE</div>
                                                        </div>
                                                        <div class="pricing-details">
                                                            <div class="price-title">
                                                                <p>Free Plan - 15 Days</p>
                                                                <h2>$0.00</h2>
                                                                <ul class="pricing-list-menu">
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>1 Whatsapp Account and Phone Number</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Single bot</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>50 templates messages free</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Soport 24/7</li>
                                                                </ul>
                                                                <div class="text-center price-btn">
                                                                    <a href="pricing.html" target="_blank"
                                                                        class="btn btn-lg btn-secondary mb-4"
                                                                        tabindex="0">Buy Plans</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-4 p-3 slick-slide slick-active"
                                                data-slick-index="2" aria-hidden="false" tabindex="0"
                                                style="width: 525px;">
                                                <div class="card pricing-cards active mb-0">
                                                    <div class="card-body">
                                                        <div class="pricing-details">
                                                            <div class="price-title">
                                                                <p>Basic Plan</p>
                                                                <h2>$30.000</h2>
                                                                <ul class="pricing-list-menu">
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>2 Whatsapp Account and Phone Numbers</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>2 Single bots Anf 5 Flows</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>100 Template Messajes included</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Soport 24/7</li>
                                                                </ul>
                                                                <div class="text-center price-btn">
                                                                    <a href="pricing.html" target="_blank"
                                                                        class="btn btn-lg btn-primary mb-4"
                                                                        tabindex="0">Buy Plans</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-4 p-3 slick-slide slick-current slick-active"
                                                data-slick-index="0" aria-hidden="false" tabindex="0"
                                                style="width: 525px;">
                                                <div class="card pricing-cards active mb-0">
                                                    <div class="card-body">
                                                        <div class="pricing-details">
                                                            <div class="price-title">
                                                                <p>Pro Plans</p>
                                                                <h2>$40.000</h2>
                                                                <ul class="pricing-list-menu">
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>5 Whatsapp Accounts and Phone Numbers</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Bots Ilimitated and 10 flows by bot</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>500 Templates Messages included</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Soport 24/7</li>
                                                                </ul>
                                                                <div class="text-center price-btn">
                                                                    <a href="pricing.html" target="_blank"
                                                                        class="btn btn-lg btn-primary mb-4"
                                                                        tabindex="0">Buy Plans</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-4 p-3 slick-slide slick-active"
                                                data-slick-index="2" aria-hidden="false" tabindex="0"
                                                style="width: 525px;">
                                                <div class="card pricing-cards active mb-0">
                                                    <div class="card-body">
                                                        <div class="pricing-details">
                                                            <div class="price-title">
                                                                <p>Business Plans</p>
                                                                <h2>$250.000</h2>
                                                                <ul class="pricing-list-menu">
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Ilimitated Accounts an Whatsapp Numbers</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Ilimitated Bots and flows</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>1500 Templates Messages</li>
                                                                    <li class="pricing-listitem"> <i
                                                                            class="fa-solid fa-check-circle fa-fw text-success me-2"></i>Soport 24/7</li>
                                                                </ul>
                                                                <div class="text-center price-btn">
                                                                    <a href="pricing.html" target="_blank"
                                                                        class="btn btn-lg btn-primary mb-4"
                                                                        tabindex="0">Buy Plans</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Purchase Plans section end  -->

        <!-- footer -->
        <section class="landing-footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-content text-center">
                            <img src="../assets/images/logo/3.png" alt="logo">
                            <h1>Build a <span class="highlight-title"> Startling </span> site</h1>
                            <p class="txt-ellipsis-3">Purchase The Ra-admin & Craft Your Site Super Faster And powerful.
                                Discover the Ra-admin
                                Admin Theme.
                                If you enjoy our template, please take a moment to rate us</p>
                            <div class="footer-btn">
                                <a href="https://themeforest.net/user/la-themes" class="btn btn-primary btn-lg"
                                    target="_blank">Buy Now</a>
                                <a href="mailto:teqlathemes@gmail.com." target="_blank"
                                    class="btn btn-danger btn-lg">Need Help ?</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- footer -->
    </div>
    <!-- Landing page end -->


    <!-- tap on top -->
    <div class="go-top">
        <span class="progress-value">
            <i class="ti ti-arrow-up"></i>
        </span>
    </div>




    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.3.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- phosphor js -->
    <script src="../assets/vendor/phosphor/phosphor.js"></script>

    <!-- aos js-->
    <script src="../assets/vendor/aos/aos.js"></script>

    <!-- slick-file -->
    <script src="../assets/vendor/slick/slick.min.js"></script>

    <!--js-->
    <script src="../assets/js/landing.js"></script>


</body>

</html>
