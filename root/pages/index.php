<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pink Pastel Post Office</title>
<!-- page style -->
<link rel="stylesheet" href="../css/index.css">
<!-- font for webpage -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
<!-- icons -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
    <section class="header">
        <?php
            include_once '../header.php';
        ?>
<!--End General Header code-->
        <div class="text-box">
            <?php
            if (isset($_SESSION["useruid"]))
                {
                    //commented out because this textbox covered the navbar
                    //echo '<p>Welcome ' . $_SESSION["useruid"] . '!</p>';
                    //echo '<p>You are a(n) ' . $_SESSION["role"] . '!</p>'; 
                }
            ?>
            <h1>Our Priority Is You</h1>
            <p>Pink Pastel Post Office remains committed to providing all customers with essential mailing and shipping services.<br>We're delivering with advanced technology and equipment to over 160 million addresses across the country.</p>
            <a href="#about-us" class="hero-btn">Visit Us to Know More</a>
        </div>
    </section> 

    <!-------------------------- Our Services ------------------------------>
    <section class="services">
        <h1>Services We Offer</h1>
        <p>Featured Pink Pastel Post Office Products & Services</p>
        <div class="row">
            <div class="service-col">
                <h3>Mail &amp; Shipping</h3>
                <p>We're delivering with advanced technology and equipment to over 160 million addresses across the country.</p>
            </div>
            <div class="service-col">
                <h3>Supplies</h3>
                <p>Need special items for your next shipment? Whether you're an individual, large, or small business, we have all of the shipping solutions and supplies designed to help you.</p>
            </div>
            <div class="service-col">
                <h3>Stamps</h3>
                <p>Shop our collection of stamps featuring the beauty of nature in forever, global, and othe stamp denominations</p>
            </div>
        </div>
    </section>

    <!-------------------------- Locations ------------------------------>
    <section class="locations">
        <h1>Our Locations</h1>
        <p>See some of our most popular locations below. Originating from Houston, Texas, we're continuing to grow and expect to be available nationwide by 2030.</p>
            <div class="row">
                <div class="locations-col">
                    <img src="../images/houston.jpeg">
                    <div class="layer">
                        <h3>HOUSTON</h3>
                    </div>
                </div>
                <div class="locations-col">
                    <img src="../images/austin.jpeg">
                    <div class="layer">
                        <h3>AUSTIN</h3>
                    </div>
                </div>
                <div class="locations-col">
                    <img src="../images/dallas.jpeg">
                    <div class="layer">
                        <h3>DALLAS</h3>
                    </div>
                </div>
                
            </div>
            <!-- TODO: add a find a location near you button-->
    </section>

    <!-------------------------- Footer ------------------------------>
    <section class="footer">
        <h4 id="about-us">About Us</h4>
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