<?php
session_start();
include("connect.php");

// Check if the user is logged in
if(!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Repository Dosen</div>
        <ul class="nav-links">
            <li><a href="admin_homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Events</a></li>
            <li><a href="#"><i class="fas fa-book"></i> My Courses</a></li>
        </ul>
        <div class="profile">
            <img src="https://via.placeholder.com/30" alt="Profile Image" class="profile-pic">
            <span class="profile-name">
                <?php
                if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $query = mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
                    while($row = mysqli_fetch_array($query)){
                        echo $row['firstName']; // hanya menampilkan firstName
                    }
                }
                ?>
            </span>
            <i class="fas fa-chevron-down dropdown-icon" onclick="toggleDropdown()"></i>
            <div class="dropdown-menu" id="dropdown">
                <a href="#">View Profile</a>
                <a href="edit_profile.php">Edit Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <!-- Main Content -->
        <main class="content">
            <div class="announcement">
                <h3>ANNOUNCEMENTS</h3>
                <p>It is prohibited to take advantage of the PNJ email drive account to carry out negative actions...</p>
            </div>

            <section class="info-section">
                <div class="info-box">
                    <h3>Informasi Presensi</h3>
                    <p>Pemberitahuan Presensi...</p>
                    <ul>
                        <li>Buka web <a href="https://academia.pnj.ac.id/">https://academia.pnj.ac.id/</a></li>
                        <li>Masukkan username dan password...</li>
                    </ul>
                </div>
                <div class="clock">
                    <h3>Clock</h3>
                    <p>Server: Sat 23:45:40</p>
                </div>
                <div class="courses">
                    <h3>My Courses</h3>
                    <ul>
                        <li><a href="#">TMJ-Teknik Dijital-TMJ 2B-2022/2023-Genap</a></li>
                        <li><a href="#">TMJ-Algoritma & Struktur Data...</a></li>
                        <!-- Add more courses here -->
                    </ul>
                </div>
            </section>
        </main>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('show');
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-icon')) {
                const dropdowns = document.getElementsByClassName("dropdown-menu");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>