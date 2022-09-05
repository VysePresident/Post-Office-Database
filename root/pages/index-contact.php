<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Pink Pastel</title>
<!-- page style -->
<link rel="stylesheet" href="../css/index-contact.css">
<!-- font for webpage -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
<!-- icons -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
    <section class="sub-header">
        <?php
            include_once '../header.php';
        ?>
        <!--End General Header Code-->
            <h1>Contact Us</h1>
    </section>
    
<!-------------------------- Contact Us ------------------------------>
    <section class="contact-us">
            <div class="row">
                <div class="contact-col">
                    <div>
                        <i class="fa fa-home"></i>
                        <span>
                            <h5>123 Sesame Street</h5>
                            <p>New York City, New York, US</p>
                        </span>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <span>
                            <h5>+1 0123456789</h5>
                            <p>Monday - Saturday 8:00 AM to 5:00 PM</p>
                        </span>
                    </div>
                    <div>
                        <i class="fa fa-envelope-o"></i>
                        <span>
                            <h5>support@pinkpastel.org</h5>
                            <p>Email us with any question or concerns</p>
                        </span>
                    </div>
                </div>
                <!-- TODO: write php form to deliver this email -->
                <div class="contact-col">
                    <form method="post" action="contact.php">
                    <input type="text" name="name" placeholder="Enter your name" required>
                    <input type="email" name="email" placeholder="Enter email address" required>
                    <input type="text" name="subject" placeholder="Enter your subject" required>
                    <textarea rows="8" name="message" placeholder="Message" required></textarea>
                    <button type="submit" class="hero-btn red-btn">Send Message</button>
                    </form> 
                </div>
            </div>
    </section>

    <!-------------------------- Footer ------------------------------>
    <section class="footer">
        <h4>About Us</h4>
        <p>Pink Pastel Postal Services is an independent agency of the executive branch of the United States federal government <br> responsible for providing postal service in the United States, including its insular areas and associated states.<br><br>We are continuing to grow and were created to providing all customers with essential mailing, shipping services, and great customer service</p>
        <div class="icons">
            <a href=""><i class="fa fa-facebook"></i></a>
            <a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-instagram"></i></a>
            <a href=""><i class="fa fa-linkedin"></i></a>
            
        </div>
        <p>made with <i class="fa fa-heart-o"></i> by Team 10</p>
    </section>      
    
</body>
</html>    