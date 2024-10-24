<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Ambil data pengguna dari database
$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    // Jika pengguna tidak ditemukan, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

// Proses pengunggahan profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    // Cek dan proses upload foto profil jika ada
    $profile_picture = $user['profile_picture']; // Gunakan foto lama sebagai default
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Direktori untuk menyimpan gambar
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi tipe gambar
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            // Cek apakah file sudah ada
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
            } else {
                // Cek ukuran file
                if ($_FILES["profile_picture"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                } else {
                    // Izinkan hanya format gambar tertentu
                    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                            $profile_picture = $target_file; // Update foto profil dengan yang baru
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                }
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Update data pengguna di database
    $update_query = "UPDATE users SET username='$username', email='$email', profile_picture='$profile_picture' WHERE id='$user_id'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: dashboard.php"); // Redirect setelah sukses
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="edit.css"> <!-- Gaya CSS untuk halaman edit profil -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Repository Dosen</div>
        <ul class="nav-links">
            <li><a href="admin_homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Events</a></li>
            <li><a href="#"><i class="fas fa-book"></i> My Courses</a></li>
        </ul>
        <div class="profile">
            <img src="https://via.placeholder.com/30" alt="Profile Image" class="profile-pic">
            <span class="profile-name"><?php echo htmlspecialchars($user['firstName']); ?></span>
            <i class="fas fa-chevron-down dropdown-icon" onclick="toggleDropdown()"></i>
            <div class="dropdown-menu" id="dropdown">
                <a href="#">View Profile</a>
                <a href="edit_profile.php">Edit Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <main class="content">
            <h1>Edit Profil</h1>
            <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label for="profile_picture">Foto Profil:</label>
                <input type="file" name="profile_picture" accept="image/*">
                <img src="<?php echo $user['profile_picture'] ? htmlspecialchars($user['profile_picture']) : 'default.png'; ?>" alt="Profile Picture" class="profile-img">

                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <input type="submit" value="Simpan Perubahan">
            </form>
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