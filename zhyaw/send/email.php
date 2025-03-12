<!--  -->
<?php use PHPMailer\PHPMailer\PHPMailer; use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Initialize variables
$status = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = $_POST['recipient'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Image Upload Handling
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";  // Ensure this directory exists
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        $target_file = null;
    }
    
    if (!empty($recipient) && !empty($subject) && !empty($message)) {
        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'zhyawebrahim@gmail.com'; // Your SMTP email
            $mail->Password = 'ytfb mtli sdtv gtqq'; // Use an App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            
            // Email settings
            $mail->setFrom('zhyawebrahim@gmail.com', 'Zhyaw');
            $mail->addAddress($recipient);
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            // Attach Image
            if ($target_file) {
                $mail->addAttachment($target_file);
            }
            
            $mail->send();
            
            $status = "✅ Email sent with image!";
        } catch (Exception $e) {
            $status = "❌ Email failed: " . $mail->ErrorInfo;
        }
    } else {
        $status = "⚠️ All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email with Image</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF69B4;
            --secondary-color: #FFB6C1;
            --accent-color: #FF1493;
            --light-color: #FFF0F5;
            --text-color: #4A4A4A;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FFF0F5;
            background-image: linear-gradient(45deg, #FFF0F5 25%, #FFE6F2 25%, #FFE6F2 50%, #FFF0F5 50%, #FFF0F5 75%, #FFE6F2 75%, #FFE6F2 100%);
            background-size: 20px 20px;
            color: var(--text-color);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .card {
            background-color: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            padding: 30px;
            margin-bottom: 30px;
            border: 2px solid var(--secondary-color);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h2 {
            color: var(--accent-color);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header p {
            color: var(--text-color);
            font-size: 1.1rem;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .form-control {
            width: 100%;
            padding: 15px;
            border: 2px solid var(--secondary-color);
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: var(--light-color);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.3);
        }
        
        textarea.form-control {
            border-radius: 20px;
            min-height: 120px;
            resize: vertical;
        }
        
        .file-input-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .file-input-label:hover {
            background-color: var(--accent-color);
        }
        
        .file-input-label i {
            margin-right: 8px;
        }
        
        input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .file-name {
            margin-top: 8px;
            font-size: 0.9rem;
            color: var(--text-color);
            text-align: center;
            min-height: 20px;
        }
        
        .btn {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .status {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 20px;
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        .status.success {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 2px solid rgba(40, 167, 69, 0.3);
        }
        
        .status.error {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border: 2px solid rgba(220, 53, 69, 0.3);
        }
        
        .status.warning {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 2px solid rgba(255, 193, 7, 0.3);
        }
        
        .hearts {
            position: fixed;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .heart {
            position: absolute;
            width: 20px;
            height: 20px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23ff69b4' width='24px' height='24px'%3E%3Cpath d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'/%3E%3C/svg%3E") no-repeat center center;
            opacity: 0;
            animation: float 6s linear infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .header h2 {
                font-size: 2rem;
            }
            
            .form-control, .btn {
                padding: 12px;
            }
        }
        
        @media (max-width: 480px) {
            .card {
                padding: 20px;
            }
            
            .header h2 {
                font-size: 1.8rem;
            }
            
            .header p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="hearts" id="hearts"></div>
    
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>✨ Send Email with Image ✨</h2>
                <p>Enter your details below to send a beautiful message with an image</p>
            </div>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="recipient"><i class="fas fa-envelope"></i> Recipient Email:</label>
                    <input type="email" id="recipient" name="recipient" class="form-control" placeholder="Enter email address" required>
                </div>
                
                <div class="form-group">
                    <label for="subject"><i class="fas fa-heading"></i> Subject:</label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject" required>
                </div>
                
                <div class="form-group">
                    <label for="message"><i class="fas fa-comment-alt"></i> Message:</label>
                    <textarea id="message" name="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
                </div>
                
                <div class="form-group">
                    <div class="file-input-container">
                        <label for="image" class="file-input-label">
                            <i class="fas fa-image"></i> Choose Image
                        </label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="file-name" id="file-name"></div>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-paper-plane"></i> Send Beautiful Email
                </button>
            </form>
        </div>
        
        <?php if (!empty($status)): ?>
            <div class="status <?php 
                if (strpos($status, '✅') !== false) echo 'success';
                else if (strpos($status, '❌') !== false) echo 'error';
                else echo 'warning';
            ?>">
                <?= $status; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        // Create floating hearts animation
        function createHearts() {
            const heartsContainer = document.getElementById('hearts');
            const numberOfHearts = 15;
            
            for (let i = 0; i < numberOfHearts; i++) {
                const heart = document.createElement('div');
                heart.classList.add('heart');
                
                // Random positioning
                heart.style.left = Math.random() * 100 + 'vw';
                heart.style.animationDelay = Math.random() * 6 + 's';
                heart.style.opacity = Math.random() * 0.5 + 0.5;
                heart.style.transform = `scale(${Math.random() * 0.5 + 0.5})`;
                
                heartsContainer.appendChild(heart);
            }
        }
        
        // Show selected file name
        document.getElementById('image').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : '';
            document.getElementById('file-name').textContent = fileName;
        });
        
        // Initialize hearts on load
        window.addEventListener('load', createHearts);
    </script>
</body>
</html>
