<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Card System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, rgba(85, 59, 178, 1) 0%, rgb(251, 249, 254) 50%, rgba(239, 236, 239, 0.8) 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-attachment: fixed;
            margin: 0;
        }

        .container {
            margin-top: 0px;
            /* Mengatur ke 0px untuk menempel langsung ke navbar */
            flex: 1;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(0, 0, 0, 0);
            padding: 0.1rem 1rem;
            /* Lebih kecil lagi untuk mendekatkan konten */
        }

        .navbar-nav .nav-link {
            color: black !important;
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: rgba(0, 0, 0, 0.7) !important;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Footer Styling */
        .footer {
            background: transparent;
            color: black;
            padding: 1rem;
            text-align: center;
            width: 100%;
        }

        .footer p {
            margin: 0;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.1rem 0.5rem;
                /* Lebih kecil lagi untuk mobile */
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar-nav .nav-link {
                font-size: 0.9rem;
                padding: 0.5rem 0.75rem;
            }

            .navbar-collapse {
                background: rgba(255, 255, 255, 0.95);
                border-radius: 8px;
                margin-top: 0.5rem;
                padding: 0.5rem;
            }

            .container {
                margin-top: 0px;
                /* Tetap 0px di mobile */
            }

            .footer {
                padding: 0.75rem;
            }

            .footer p {
                font-size: 0.85rem;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .navbar {
                padding: 0.1rem 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .navbar-nav .nav-link {
                font-size: 0.95rem;
            }

            .container {
                margin-top: 0px;
                /* Tetap 0px di tablet */
            }

            .footer p {
                font-size: 0.9rem;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('membership_cards.create') }}">Create Card</a>
                    </li>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @yield('content')
    </div>

    <div class="footer">
        <p>© 2025 Membership Card System. All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>