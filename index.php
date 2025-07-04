<?php

include 'includes/db_connect.php';  // Database connection


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination System</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (optional, for icons like bi-bar-chart) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css (for hero animations) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Google Font (optional, modern & clean) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets\vaccination_css_index\css.css">

</head>


<body>

    <!--Nav Bar section-->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Vaccination System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#learn">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#information">FAQ</a></li>
                </ul>
                <a class="btn btn-light ms-2" href="./includes/register.php">Register</a>
                <button class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </div>
        </div>
    </nav>

    <!--Booking Appointment section-->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Get the Vaccine, Protect Your Health
            </h1>
            <p class="lead animate__animated animate__fadeInUp">Book your COVID-19 test and vaccination appointment now.
            </p>
            <div class="mt-4">
                <a href="#register" class="btn btn-primary me-2">Book Appointment</a>
                <a href="#learn" class="btn btn-outline-primary">Learn More</a>
            </div>
        </div>
    </section>

    <!--Total tests Section-->
    <section class="py-5  text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3><i class="bi bi-bar-chart"></i> 593,52,367</h3>
                    <p>Total Tests</p>
                </div>
                <div class="col-md-4">
                    <h3><i class="bi bi-people"></i> 243,32,237</h3>
                    <p>Vaccinated</p>
                </div>
                <div class="col-md-4">
                    <h3><i class="bi bi-graph-up"></i> 8.2%</h3>
                    <p>Positive Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!--About of Vaccine-->
    <section class="py-5 text-center vaccine-cards">
        <div class="container">
            <h2 class="mb-4">Vaccine Types</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3 custom-theme">
                        <h5>Sinopharm</h5>
                        <p>A well-known inactivated virus vaccine with good effectiveness. Sinopharm is widely used.
                        </p>
                        <a href="#register" class="btn btn-outline-success">Get Vaccine</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 custom-theme">
                        <h5>AstraZeneca</h5>
                        <p>Viral vector vaccine used worldwide with solid immune response.</p>
                        <a href="#register" class="btn btn-outline-success">Get Vaccine</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 custom-theme">
                        <h5>Sinovac</h5>
                        <p>Another inactivated virus vaccine with proven safety record.</p>
                        <a href="#register" class="btn btn-outline-success">Get Vaccine</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--Learn About Section-->
    <!-- 🔹 Header -->
    <div class="header">
        <h1>About Our Vaccination System</h1>
        <p>Ensuring safe, effective, and organized immunization across Pakistan</p>
    </div>

    <!-- 🔹 Main Content -->
    <div class="container">
        <!-- About Section -->
        <div class="about-section" id="learn">
            <h2>Our Mission</h2>
            <p>
                Our goal is to provide easy access to vaccinations across all major hospitals and healthcare centers in
                Pakistan.
                We aim to support public health efforts with digital convenience and transparency.
                <br><br>
                Looking ahead, we are committed to expanding our vaccination system to serve communities worldwide,
                ensuring global access to safe and efficient immunization.
            </p>
        </div>

        <!-- Team Section -->
        <div class="team-section">
            <h2>Meet Our Team</h2>
            <div class="team-list">
                <div class="team-member">
                    <img src="assets/images/doctor1.jpg" alt="Team Member">
                    <h3>Dr. Ayesha Khan</h3>
                    <p>Chief Immunologist</p>
                </div>
                <div class="team-member">
                    <img src="assets/images/developer.jpg" alt="Team Member">
                    <h3>Bilal Ahmed</h3>
                    <p>Lead Developer</p>
                </div>
                <div class="team-member">
                    <img src="assets/images/nurse.png" alt="Team Member">
                    <h3>Nadia Rauf</h3>
                    <p>Vaccination Coordinator</p>
                </div>
            </div>
        </div>
    </div>

    <!--vaccince Register Form-->


    <section class="form-section py-5" id="register">
        <div class="container">
            <h2 class="text-center mb-4">Vaccine Registration Form</h2>
            <div class="p-4 bg-white shadow rounded">
                <form action="submit_registration.php" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="age" class="form-control" placeholder="Age" required>
                        </div>
                        <div class="col-md-3">
                            <select name="gender" class="form-select" required>
                                <option value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="vaccine" class="form-select" required>
                                <option value="">Select Vaccine</option>
                                <option value="Sinopharm">Sinopharm</option>
                                <option value="AstraZeneca">AstraZeneca</option>
                                <option value="Sinovac">Sinovac</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="hospital" class="form-control" placeholder="Preferred Hospital"
                                required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>



    <!-- Login Modal -->
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <form method="POST" action="includes/process_login.php">
                    <div class="modal-header bg-gradient"
                        style="background: linear-gradient(90deg, #0d6efd 70%, #2BBBAD 100%); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body bg-light">
                        <div class="mb-3">
                            <label for="role" class="form-label text-primary fw-semibold">Login as</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="hospital">Hospital</option>
                                <option value="patient">Patient</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-primary fw-semibold">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="example@email.com" required autocomplete="username">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-primary fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="********" required autocomplete="current-password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn w-100"
                            style="background: linear-gradient(90deg, #0d6efd 70%, #2BBBAD 100%); color: #fff; font-weight: 600;">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Start footer section-->
    <footer class="text-center">
        <div class="container">
            <p>&copy; 2025 CURE Portal. All rights reserved.</p>
            <div id="information" class="dashboard-card">
                <h5><i class="bi bi-info-circle"></i> Information</h5>
                <p>Find useful resources and important details for managing the COVID-19 system effectively.</p>
                <a href="faq.php" class="btn btn-outline-success mt-2">
                    <i class="bi bi-question-circle"></i> Visit FAQ
                </a>
            </div>
            <p><a href="privcy.php">Privacy</a> | <a href="terms.php">Terms</a> | <a href="contact.php">Contact</a></p>
        </div>
    </footer>
    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>