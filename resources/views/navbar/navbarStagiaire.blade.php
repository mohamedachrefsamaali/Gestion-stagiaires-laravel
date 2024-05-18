<!-- resources/views/layouts/app.blade.php -->

<html>
<head>
    <title>Espace Stagiaire-@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ asset('app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            width: calc(25% - 20px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #D1CFCF">
    <div class="container-fluid">
        <img src="{{ asset('logo1waydev.png') }}" alt="logo bh" width="5%" height="1%">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="{{ route('ConsulterTaches') }}">Espace Stagiaire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="{{ route('getAllTaches') }}">Listes des Taches</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('logoutn') }}">Déconnexion</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')
<footer>
    <div class="container">
        <div class="row">
            <div class="col">
                <ul>
                    <h5>NOUS CONTACTER</h5>
                    <li><p><i class="bi bi-geo-alt text-white"></i> 61, bis av. De l’UMA imm ENNESRINE 1er étage, 2036</p></li>
                    <li><a href="#"><i class="bi bi-envelope text-white"></i> 1waydev.com</a></li>
                    <li><a href="#"><i class="bi bi-telephone text-white"></i> (+216) 71 690 388</a></li>
                </ul>
                <p class="text-center">
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=100063768051364"><i class="bi bi-facebook text-white"></i></a>
                    <a target="_blank" href="https://www.instagram.com/1waycom/?hl=fr"><i class="bi bi-instagram text-danger"></i></a>
                    <a target="_blank" href="https://www.linkedin.com/company/1waydev/?originalSubdomain=tn"><i class="bi bi-linkedin"></i></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCRw2rFa-9RhCg7Mq1q4Q7Sg?view_as=subscriber"><i class="bi bi-youtube text-danger"></i></a>
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>
