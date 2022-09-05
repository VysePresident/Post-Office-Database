<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop Pink Pastel</title>
<link rel="stylesheet" href="../css/cust-shop.css">
<!-- font for webpage -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
<!-- icons which will be used for smaller screens like cellphones -->
<!-- whenever you see seomthing with fa that's an icon. If you want to search online for the fa name just type something like envelope fa icon -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
<!-- box icon for shopping cart  -->
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <section class="sub-header">
        <nav>
            <a href="index.html"><img src="../images/pinkpostlogo.png"></a>
            <div class="nav-links" id="navLinks">  
                <ul>
                    <li><a href="">HOME</a></li>
                    <li><a href="">CONTACT</a></li>
                    <li><a href="customer-services.php">CUSTOMER SELF SERVICES</a></li>
                    <li><a href="">LOGOUT</a></li>
                    <li><i class='bx bxs-shopping-bag' id="cart-icon"></i></li>
                </ul>

                <div class="cart">
                    <h2 class="cart-title">Your Cart</h2>
                    <!-- shopping cart content  -->
                    <div class="cart-content">
                        <!-- REMOVED OLD CART CONTENT -->
                    </div>
                    <!-- Total -->
                    <div class="total">
                        <div class="total-title">Total</div>
                        <div class="total-price">$0</div>
                    </div>
                    <!-- Buy button -->
                    <button type="button" class="button-buy">Buy Now</button>
                    <!-- Close cart  -->
                    <i class='bx bx-x' id="close-cart"></i>
                </div>
            </div>
        </nav>
            <h1>The Pink Pastel Shop</h1>
    </section>

    <!-- source code for shopping cart functionality -->
    <script src="../scripts/cust-shop.js"></script>
    
    
    <!-------------------------- The Pink Pastel Shop ------------------------------>
    <section class="shop-container">
        <div class="shop-content">
            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Stamps A</h2>
                <span class="price">$10</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box</h2>
                <span class="price">$20</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box B</h2>
                <span class="price">$30</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Stamps B</h2>
                <span class="price">$40</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box C</h2>
                <span class="price">$50</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box C</h2>
                <span class="price">$60</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box C</h2>
                <span class="price">$70</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box B</h2>
                <span class="price">$80</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box B</h2>
                <span class="price">$90</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
            </div>

            <div class="shop-box">
                <img src="../images/box.png" class="shop-img">
                <h2 class="shop-product-title">Box B</h2>
                <span class="price">$100</span>
                <i class='bx bxs-shopping-bag add-cart' id="cart-icon"></i>
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

    <script>

    </script> 
    
</body>
</html>    