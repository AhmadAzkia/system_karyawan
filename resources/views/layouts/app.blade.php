<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        #sidebar.collapsed {
            width: 50px;
        }

        #sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        #sidebar .logo-icon {
            font-size: 1.5rem;
        }

        #sidebar .logo-text {
            margin-left: 10px;
            font-size: 1.2rem;
        }

        #sidebar.collapsed .logo-text {
            display: none;
        }

        #sidebar .menu {
            flex-grow: 1;
        }

        #sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        #sidebar a .menu-text {
            margin-left: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #sidebar.collapsed a {
            justify-content: center;
        }

        #sidebar.collapsed a .menu-text {
            display: none;
        }

        #sidebar a:hover {
            background: #495057;
            border-radius: 5px;
        }

        #content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        #content.collapsed {
            margin-left: 50px;
        }

        .toggle-icon {
            text-align: center;
            padding: 35px;
            cursor: pointer;
        }

        .toggle-icon i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        #sidebar.collapsed .toggle-icon {
            padding: 25px;
        }

        #sidebar.collapsed .toggle-icon i {
            font-size: 1rem;
        }
    </style>

</head>

<body>
    <div id="sidebar" class="d-flex flex-column">
        <div class="logo">
            <i class="fas fa-rocket logo-icon"></i>
            <span class="logo-text">My App</span>
        </div>
        <div class="menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i> <!-- Ganti ikon Dashboard -->
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/karyawan" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span class="menu-text">Karyawan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/departemen" class="nav-link">
                        <i class="fas fa-building"></i>
                        <span class="menu-text">Departemen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/jabatan" class="nav-link">
                        <i class="fas fa-briefcase"></i>
                        <span class="menu-text">Jabatan</span>
                    </a>
                </li>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/gaji" class="nav-link">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="menu-text">Lihat Gaji</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/absen" class="nav-link">
                            <i class="fas fa-calendar-check"></i>
                            <span class="menu-text">Lihat Absen</span>
                        </a>
                    </li>
                </ul>
        </div>
        <div class="toggle-icon" id="toggleSidebar">
            <i class="fas fa-arrow-left"></i>
        </div>
    </div>
    <div id="content">
        @yield('content')
    </div>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const toggleIcon = toggleSidebar.querySelector('i');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
            toggleIcon.classList.toggle('fa-arrow-left');
            toggleIcon.classList.toggle('fa-arrow-right');
        });

        toggleSidebar.addEventListener('mouseover', () => {
            toggleIcon.style.transform = "scale(1.1)";
        });

        toggleSidebar.addEventListener('mouseout', () => {
            toggleIcon.style.transform = "scale(1)";
        });
    </script>
</body>


</html>
