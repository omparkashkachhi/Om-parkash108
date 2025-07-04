<section class="form-section" id="register">
    <div class="container">
        <h2 class="text-center mb-4">Vaccine Registration Form</h2>
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
                    <input type="text" name="hospital" class="form-control" placeholder="Preferred Hospital" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-light w-100">Register</button>
                </div>
            </div>
        </form>
    </div>
</section>