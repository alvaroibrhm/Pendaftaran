<?php
session_start();
include("connect.php");

// Check if the user is logged in
if(!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

// Fetch user information
$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage - Repository Dosen</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Repository Dosen</div>
        <ul class="nav-links">
            <li><a href="homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
            <li><a href="courses.php"><i class="fas fa-book"></i> My Courses</a></li>
        </ul>
        <div class="profile">
            <img src="https://via.placeholder.com/30" alt="Profile Image" class="profile-pic">
            <span class="profile-name">
                <?php echo $user['firstName']; ?>
            </span>
            <i class="fas fa-chevron-down dropdown-icon" onclick="toggleDropdown()"></i>
            <div class="dropdown-menu" id="dropdown">
                <a href="profile.php">Profile</a>
                <a href="settings.php">Settings</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <section class="hero">
            <h1>Welcome, <?php echo $user['firstName']; ?>!</h1>
            <p>Explore and manage your courses, events, and other resources easily in the Repository Dosen platform.</p>
        </section>

        <section class="announcements">
            <h2>Latest Announcements</h2>
            <div class="announcement-box">
                <h3>Repository Maintenance</h3>
                <p>There will be a scheduled maintenance on the platform on 25th October, 2024 from 2 AM to 4 AM.</p>
            </div>
            <div class="announcement-box">
                <h3>New Courses Available</h3>
                <p>Check out the new courses available for the upcoming semester in the Courses section.</p>
            </div>
        </section>
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