<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "portfoliodb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $successMessage = "Mesajınız başarıyla gönderildi!";
        } else {
            $errorMessage = "Bir hata oluştu. Lütfen tekrar deneyin.";
        }

        $stmt->close();
    } else {
        $errorMessage = "Lütfen tüm alanları doldurunuz.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Yusuf Türlü">
    <meta name="keywords" content="Portfolio,Portfolyö,CV,Yusuf,Yusuf Türlü">
    <title>Yusuf Türlü Portfolyo</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="web site icon" href="cv-icon.png">
    <style>
    .about .about-photo img {
        margin-left: 135px;
        margin-top: 65px;
        margin-bottom: 65px;
        border-radius: 50%;
        width: 180px;
        height: 180px;
        object-fit: cover;
        border: 4px solid #373737;
}

    .about-text {
        letter-spacing: 2px;
        font-weight: 400;
        line-height: 1.7;
        font-size: 16px;
    }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo" id="Yusuf">Yusuf Türlü</div>
            <nav>
                <ul>
                    <li><a href="#home">Ana Sayfa</a></li>
                    <li><a href="#about">Hakkında</a></li>
                    <li><a href="#projects">Projeler</a></li>
                    <li><a href="#contact">İletişim</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="container">
            <h1>Merhaba, Ben Yusuf</h1>
            <p>İstanbul Gelişim Üniversitesi</p>
            <p>Web Tasarım ve Kodlama Öğrencisiyim.</p>
            <a href="#" class="cta-button">Sertifikalar</a>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <h1>Hakkımda</h1>
            <div class="about-content">
                <div class="about-photo">
                    <img src="pp.jpg" alt="Profil Fotoğrafı">
                </div>
                <div class="about-text">
                    <p>İstanbul Gelişim Üniversitesi Web Tasarım ve Kodlama Öğrencisiyim. Programcılık ve Fiziğe ilgiliyim. Ayrıca Felsefe ve Edebiyat dünyasına da meraklı olup şiirler de yazmaktayım. Araştırma, Yazılım Geliştirme ve Yeni Projeler Üretmeye Açığım. Hedefim Bölümümün Alanında Yeni Çalışmalar Ortaya Koymak.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="projects" class="projects">
        <div class="container">
            <h2>Projelerim</h2>
            <div class="project-cards">
                <div class="project-card">
                    <h3>Proje 1</h3>
                    <p>Kısa açıklama.</p>
                    <p><strong>Teknolojiler:</strong> HTML, CSS, JavaScript</p>
                    <a href="#" class="project-link">Detayları Gör</a>
                </div>
                <div class="project-card">
                    <h3>Proje 2</h3>
                    <p>Kısa açıklama.</p>
                    <p><strong>Teknolojiler:</strong> PHP, MySQL</p>
                    <a href="#" class="project-link">Detayları Gör</a>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">
            <h1>İletişim</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="name" placeholder="İsim" required>
                <input type="email" name="email" placeholder="E-posta" required>
                <textarea name="message" placeholder="Mesaj" rows="5" required></textarea>
                <button type="submit">Gönder</button>
            </form>
            <div class="social-media">
                <a href="https://www.linkedin.com/in/yusuf-t-296635232/" class="social-link" target="_blank"><img src="linkedin-logo.png" alt="LinkedIn"></a>
                <a href="https://github.com/josepyt" class="social-link" target="_blank"><img src="github-logo.png" alt="GitHub"></a>
                <a href="https://www.instagram.com/ffllyusuf/" class="social-link" target="_blank"><img src="instagram-logo.png" alt="Instagram"></a>
            </div>
            <?php
            if (isset($successMessage)) {
                echo "<p class='success-message'>$successMessage</p>";
            }
            if (isset($errorMessage)) {
                echo "<p class='error-message'>$errorMessage</p>";
            }
            ?>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>© 2024 Tüm Hakları Saklıdır.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
