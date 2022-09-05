
let cartIcon = document.querySelector('#cart-icon');
let cart = document.querySelector('.cart');
let closeCart = document.querySelector('#close-cart');

// open and close shopping cart
cartIcon.onclick = () => {
    cart.classList.add("active");
};

closeCart.onclick = () => {
    cart.classList.remove("active");
};

// if document is finished loading, call ready() to listen for events 
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready();
}

function ready() {
    // remove an item(s) from the shopping cart
    var removeCartButtons = document.getElementsByClassName('cart-remove');
    console.log(removeCartButtons);
    
    for (var i = 0; i < removeCartButtons.length; i++) {
        var button = removeCartButtons[i];
        button.addEventListener('click', removeCartItem);
    }

    // changing quantity
    var quantityInputs = document.getElementsByClassName('cart-quantity');

    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];
        input.addEventListener('change', quantityChanged);
    }

    // add an item to the shopping cart
    var addCart = document.getElementsByClassName('add-cart');

    for (var i = 0; i < addCart.length; i++) {
        var button = addCart[i];
        button.addEventListener('click', addCartClicked);
    }

    // buy button clicked
    document.getElementsByClassName('button-buy')[0].addEventListener('click', buyButtonClicked);
}

function buyButtonClicked() {
    alert('Your order has been placed');

    // COLLECT THE INFORMATION, SEND TO PHP FILE SO THAT IT CAN BE UPDATED IN OUR DATABASE
    collectCartInformation();

    var cartContent = document.getElementsByClassName('cart-content')[0];
    while (cartContent.hasChildNodes()) {
        cartContent.removeChild(cartContent.firstChild);
    }

    // should flip everything to 0 now since all cart boxes were erased above
    updateTotal();
}

function removeCartItem(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();

    updateTotal();
}

function quantityChanged(event) {
    var input = event.target;

    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }

    updateTotal();
}

function addCartClicked(event) {
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName('shop-product-title')[0].innerText;
    var price = shopProducts.getElementsByClassName('price')[0].innerText;
    var productImg = shopProducts.getElementsByClassName('shop-img')[0].src;
    // use to debug if necessary
    // console.log(title, price, productImg);
    addProductToCart(title, price, productImg);
    updateTotal();
}

function addProductToCart(title, price, productImg) {
    var cartShopBox = document.createElement('div');
    cartShopBox.classList.add('cart-box');
    var cartItems = document.getElementsByClassName('cart-content')[0];
    var cartItemsNames = cartItems.getElementsByClassName('cart-product-title');
    for (var i = 0; i < cartItemsNames.length; i++) {
        if (cartItemsNames[i].innerText == title) {
            alert('You have already added this item to your cart');
            return;
        }
    }
    var cartBoxContent = `
                            <img src="${productImg}" class="cart-image">
                            <div class="detail-box">
                                <div class="cart-product-title">${title}</div>
                                <div class="cart-price">${price}</div>
                                <input type="number" value="1" class="cart-quantity">
                            </div>
                            <!-- remove cart content  -->
                            <i class='bx bxs-trash cart-remove'></i>`;
    cartShopBox.innerHTML = cartBoxContent;
    cartItems.append(cartShopBox);
    cartShopBox.getElementsByClassName('cart-remove')[0].addEventListener('click', removeCartItem);
    cartShopBox.getElementsByClassName('cart-quantity')[0].addEventListener('change', quantityChanged);
}

// grabs all the products in the cart and updates the total based on items and quantity
function updateTotal() {
    var cartContent = document.getElementsByClassName('cart-content')[0];
    var cartBoxes = cartContent.getElementsByClassName('cart-box');
    var total = 0;

    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName('cart-price')[0];
        var quantityElement = cartBox.getElementsByClassName('cart-quantity')[0];
        var price = parseFloat(priceElement.innerText.replace("$", ""));
        var quantity = quantityElement.value;
        total = total + (price * quantity);
    }
        // if price is a decimal number
        total = Math.round(total * 100) / 100;

        document.getElementsByClassName('total-price')[0].innerText = "$" + total;
    
}

function collectCartInformation() {
    var cartContent = document.getElementsByClassName('cart-content')[0];
    var cartBoxes = cartContent.getElementsByClassName('cart-box');
    // var total = 0;

    var cartItems = [];

    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName('cart-price')[0];
        var quantityElement = cartBox.getElementsByClassName('cart-quantity')[0];
        var titleElement = cartBox.getElementsByClassName('cart-product-title')[0];
        var price = parseFloat(priceElement.innerText.replace("$", ""));
        var quantity = quantityElement.value;
        var title = titleElement.innerText;
        // total = total + (price * quantity);

        var cartItem = {};
        cartItem.price = price;
        // for some reason quantity was showing up as a string in console log, and I believe it has to be an int to match
        // our database counts of items.
        cartItem.quantity = parseInt(quantity);
        cartItem.title = title;
        cartItems.push(cartItem);
    }

    // if price is a decimal number
    // total = Math.round(total * 100) / 100;

    //console.log(cartItems);

    $.ajax({
        url: "cust-shop-bought-items.php",
        method: "post",
        data: {cartItems: JSON.stringify(cartItems)},
        success: function(res) {
            console.log(res);
        }
    })
}