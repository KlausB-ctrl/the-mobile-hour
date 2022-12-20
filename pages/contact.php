<?php include "../model/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styles.css">
  <title>Contact | The Mobile Hour</title>
  <script src="https://kit.fontawesome.com/a3443240ca.js" crossorigin="anonymous"></script>
</head>
<body>
    <script src="../js/components/header.js"></script>
    <main class="content-container">
        <h1 class="page-header">Contact Us</h1>
        <div class="contact__content">
            <section class="contact__content__details">
                <p>
                    Need to get in touch with our team? Complete our online form, send us an 
                    email or give us a call. We're here to help. 
                </p>
                <h4>Office Location</h4>
                <address>
                    <p>123 Phone Street<p>
                    <p>Brisbane City, 4000</p>
                    <p>Queensland, Australia</p>
                </address>

                <h4>Contact Information</h4>
                <address>
                    <p><strong>Phone:</strong> 07 1234 5678</p>
                    <p><strong>Email:</strong> admin@the-mobile-hour.com.au</p>
                </address>
            </section>
            <form class="contact__content__form">
                <div class="form__row">
                    <div class="form__row__container">
                        <label for="contact__first-name">First Name</label><br>
                        <input id="contact__first-name" name="contact__first-name">
                    </div>
                    <div class="form__row__container">
                        <label for="contact__last-name">Last Name</label><br>
                        <input id="contact__last-name" name="contact__last-name">
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__row__container">
                        <label for="contact__email">Email Address</label><br>
                        <input id="contact__email" name="contact__email">
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__row__container">
                        <label for="contact__message">Message</label><br>
                        <textarea id="contact__message" name="contact__message"></textarea>
                    </div>
                </div>

                <button class="button--standard">SEND</button>
            </form>
        </div>
    </main>
    <script src="../js/components/footer.js"></script>
</body>
</html>