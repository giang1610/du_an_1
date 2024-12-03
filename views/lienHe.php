<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        /* Toàn bộ trang */
        body {
            font-family: 'Arial', sans-serif;
         
            background: #f8d7da;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
           
        }

        /* Vùng chứa nội dung */
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
          width: 100%;
         
        }

        
        .contact-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

       
        .contact-form h2 {
            margin-bottom: 20px;
            font-size: 28px;
            text-align: center;
            color: #555;
        }

       
        .contact-form label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            display: block;
        }

        
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
            background: #f9f9f9;
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

      
        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #f497a0;
            outline: none;
            box-shadow: 0 0 8px rgba(244, 151, 160, 0.5);
        }

      
        .contact-form button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #f497a0, #f8a3b1);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

       
        .contact-form button:hover {
            transform: scale(1.05);
           background-color: #f8d7da;
        }

        
        .contact-form button:active {
            transform: scale(1);
        }

      
        footer {
            background: #fff;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<?php require_once 'layout/menu.php'; ?>

<body>

    <div class="container">
        <!-- Form liên hệ -->
        <form class="contact-form" id="contactForm">
            <h2>Liên hệ với chúng tôi</h2>
            <label for="name">Nhập tên</label>
            <input type="text" id="name" name="name" placeholder="Tên của bạn" required>
            
            <label for="email">Nhập Email</label>
            <input type="email" id="email" name="email" placeholder="Email của bạn" required>
            
            <label for="message">Nhập tin nhắn</label>
            <textarea id="message" name="message" rows="5" placeholder="Tin nhắn của bạn" required></textarea>
            
            <button type="button" id="submitBtn">Gửi</button>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once 'layout/fooder.php'; ?>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
           
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();

          
            if (name === '' || email === '' || message === '') {
                alert('Bạn chưa nhập đầy đủ thông tin!');
            } else {
                alert('Cảm ơn bạn đã phản hồi, chúng tôi sẽ liên lạc lại sau!');
                document.getElementById('contactForm').reset();
            }
        });
    </script>
</body>
</html>

  
  