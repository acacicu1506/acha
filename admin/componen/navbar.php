

<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- Tabler Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/1.42.0/tabler-icons.min.css">

<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li>
        </ul>

        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <a href="#" class="search-switch">
                    <span class="icon_search"></span>
                </a>

                <!-- Admin Icon dengan Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover d-flex align-items-center" href="javascript:void(0)" id="dropAdmin" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="user-name">
                            <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Login'; ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="dropAdmin">
                        <div class="message-body">
                            <?php if (isset($_SESSION['name'])): ?>
                                <a href="profile.php" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="account.php" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-mail fs-6"></i>
                                    <p class="mb-0 fs-3">My Account</p>
                                </a>
                                <a href="tasks.php" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-list-check fs-6"></i>
                                    <p class="mb-0 fs-3">My Task</p>
                                </a>
                                <a href="../logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block" onclick="return confirm('Apakah Anda yakin ingin keluar?');">Logout</a>
                            <?php else: ?>
                                <a href="index.php" class="btn btn-primary mx-3 mt-2 d-block">Login</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
