<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Clinic Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('icons/icons8-veterinarian-100.png') }}" type="image/x-icon">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        .hero {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            padding: 80px 20px;
            text-align: center;
            color: #fff;
        }
        .hero img {
            width: 100px;
            margin-bottom: 20px;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }
        .features {
            padding: 60px 20px;
            background-color: white;
        }
        .feature-box {
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s;
            background: #fff;
        }
        .feature-box:hover {
            transform: translateY(-5px);
        }
        .feature-box img {
            width: 60px;
            margin-bottom: 20px;
        }
        .cta-buttons {
            margin-top: 30px;
        }
        .btn-custom {
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero">
        <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Vet Logo">
        <h1>Veterinary Clinic Management System</h1>
        <p>Smart tools to streamline appointments, manage pet health records, and enhance your veterinary workflow.</p>

        <div class="cta-buttons mt-4">
            <a href="{{ route('login') }}" class="btn btn-light btn-custom me-3">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-custom">Register</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="row text-center mb-5">
                <h2 class="fw-bold">Why Choose Our System?</h2>
                <p class="text-muted">Simplify your veterinary clinic's operations with key features</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/3659/3659733.png" alt="Appointments">
                        <h5 class="fw-bold">Appointment Scheduling</h5>
                        <p>Book and manage appointments with ease, reducing waiting time and boosting satisfaction.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966487.png" alt="Pet Records">
                        <h5 class="fw-bold">Pet Health Records</h5>
                        <p>Securely store and access vaccination records, medical history, and treatment plans.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/2721/2721294.png" alt="Staff Tools">
                        <h5 class="fw-bold">Staff & Admin Tools</h5>
                        <p>Manage your team, assign roles, and gain insights with powerful admin dashboards.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
