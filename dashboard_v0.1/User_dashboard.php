<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <h1>User Dashboard</h1>
    
    <h2>Website Type</h2>
    <h3>What type of website is it?</h3>
    <label>
        <input type="radio" name="websiteType" value="business" data-price="1500"> Business
    </label>
    <label>
        <input type="radio" name="websiteType" value="personal" data-price="500"> Personal
    </label>
    <label>
        <input type="radio" name="websiteType" value="ecommerce" data-price="3000"> E-commerce
    </label>
    
    <h2>Pages</h2>
    <h3>What pages do you need?</h3>
    <label>
        <input type="checkbox" name="pages[]" value="home" data-price="300"> <b>Home page</b>: The heart of your website<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="contact" data-price="200"> <b>Contact page</b>: Stay connected with your audience<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="about" data-price="200"> <b>About page</b>: Tell your unique story<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="contact_about" data-price="300"> <b>Contact + About page in one</b>: Combine the power of both<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="gallery" data-price="300"> <b>Gallery page</b>: Showcase your work<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="FAQ_page" data-price="100"> <b>FAQ page</b>: Answer all their questions<br>
    </label>
    <p> Legal Information pages </p>
    <label>
        <input type="checkbox" name="pages[]" value="T_&_C_page" data-price="300"> <b>Terms & Conditions page</b>: Secure your online presence<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="Privacy_Policy_page" data-price="300"> <b>Privacy Policy page</b>: Safeguard your visitors' data<br>
    </label>

    <p> eCommerce pages </p>
    <label>
        <input type="checkbox" name="pages[]" value="Product_page" data-price="0"> <b>Product Page</b>: Display your offerings<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="Cart_page" data-price="200"> <b>Cart Page</b>: Ready for checkout<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="Order_History_Page" data-price="200"> <b>Order History Page</b>: Keep track of purchases<br>
    </label>
    <label>
        <input type="checkbox" name="pages[]" value="Wishlist_page" data-price="300"> <b>Wishlist Page</b>: Save the favorites<br>
    </label>

    <p>Content pages</p>
    <div id="customPageContainer">
        <!-- Custom page input fields will be added here dynamically -->
    </div>
    <button id="addCustomPage">Add Content Page</button>

    
    <h2>Content Management</h2>
    <h3>Do you need CMS to manage the content of the website?</h3>
    <label>
        <input type="checkbox" name="cms" data-price="200"> CMS admin dashboard page
    </label>
    
    <h2>Account Pages</h2>
    <h3>Do you need user account feature?</h3>
    <label>
        <input type="checkbox" id="accountPagesCheckbox" name="accountPages" value="login_signup" data-price="300"> Login/Sign up pages - $300 <br>
    </label>

    <div id="LoginPopup" style="display: none;">
        <label>
            <input type="radio" name="accountOption" value="login_signup_page" data-price="0" checked> Login page and Sign up page <br>
        </label>
        <label>
            <input type="radio" name="accountOption" value="login_signup_one_page" data-price="0"> Login + Sign up in one page <br>
        </label>
        <label>
            <input type="radio" name="accountOption" value="login_signup_popup" data-price="0"> Login/signup directly using pop-up <br>
        </label>
        <label>
        <input type="checkbox" name="loginPopup" value="login_popup" data-price="75"> Login pop-up from homepage - $75 <br>
        </label>
    </div>


    <h2>Express Login</h2>
    <label> <h3>Option to fast Login from other account</h3>
        <input type="checkbox" name="fastLoginGoogle" value="fast_login_google" data-price="80"> Google account - $80 <br>
    </label>
    <label>
        <input type="checkbox" name="fastLoginFacebook" value="fast_login_facebook" data-price="80"> Facebook account - $80 <br>
    </label>
    
    <h2>Interactive Map</h2>
    <h3>Do you need an Interactive map on the Contact page?</h3>    
    <label><input type="radio" name="interactiveMap" value="yes" data-price="90"> Yes</label>
    <label><input type="radio" name="interactiveMap" value="no"> No</label>

    <h2>Booking System</h2>
    <h3>Do you need Booking system to book appointments, tickets, calls, etc.?</h3>    
    <label><input type="radio" name="bookingSystem" value="yes" data-price="300"> Yes</label>
    <label><input type="radio" name="bookingSystem" value="no"> No</label>

    <h2>Payment gateway</h2>
    <h3>Do you need Payment Gateway?</h3>
    <p>Payment accepting and checkout methods</p>
    <label><input type="checkbox" name="paymentGateway" value="card_payment" data-price="200"> Credit and debit card: The classic way<br></label>
    <label><input type="checkbox" name="paymentGateway" value="paypal" data-price="100"> Paypal: Secure and trusted<br></label>
    <label><input type="checkbox" name="paymentGateway" value="google_pay" data-price="100"> Google Pay: Fast and efficient<br></label>
    <label><input type="checkbox" name="paymentGateway" value="apple_pay" data-price="100"> Apple Pay: Apple enthusiasts joy<br></label>
    <p>BNPL company (Buy now, Pay later for Loan and installments payment service)</p>
    <label><input type="checkbox" name="paymentGateway" value="AfterPay" data-price="100"> AfterPay<br></label>
    <label><input type="checkbox" name="paymentGateway" value="ZipPay" data-price="100"> ZipPay<br></label>
    <label><input type="checkbox" name="paymentGateway" value="Klarna" data-price="100"> Klarna<br></label>

    <h2>Express Checkout</h2>
    <h3>Do you need option to checkout without sign-up and login?</h3>
    <label><input type="checkbox" name="paymentGateway" value="paypal_express" data-price="100"> Paypal Express Checkout<br></label>
    <label><input type="checkbox" name="paymentGateway" value="Stripe_express" data-price="100"> Stripe Express Checkout<br></label>

    <h2>SSL Certification</h2>
    <h3>Do you need an SSL certificate? (Price based on level of security, bought from Certificate Authority)</h3>
    <label><input type="radio" name="sslCertificate" value="DV" data-price="60"> DV Certificate - For sites, such as blogs or small business websites</label><br>
    <label><input type="radio" name="sslCertificate" value="OV" data-price="110"> OV certificate - For sites, such as business websites with forms and lead capture capabilities</label><br>
    <label><input type="radio" name="sslCertificate" value="EV" data-price="210"> EV certificate - For the highest level of security, capable of handling sensitive information</label><br>
   
    
    <h2>Design Package</h2>
    <label>
        <select name="designTier">
            <option value="tier1">Tier 1 (Standard)</option>
            <option value="tier2">Tier 2 (Gold)</option>
            <option value="tier3">Tier 3 (Platinum)</option>
        </select>
    </label>
    
    <h2>Newsletter feature</h2>
    <h3>Do you want to add newsletter function to the website?</h3>
    <p>Includes newsletter subscription component on your website and Email admin page.</p>    
    <label><input type="radio" name="newsletter" value="yes" data-price="200"> Yes</label>
    <label><input type="radio" name="newsletter" value="no"> No</label>
    
    
    <h2>Website delivery date</h2>
    <h3>When do you need the website created?</h3>
    <label><input type="radio" name="deliveryDate" data-percent="0"> 6 weeks - Standard delivery</label><br>
    <label><input type="radio" name="deliveryDate" data-percent="10"> 4 weeks Express delivery (+10%)</label><br>
    <label><input type="radio" name="deliveryDate" data-percent="25"> 2 Weeks Expedited service (+25%)</label><br>


    
    <h2>Total Price: <span id="totalPrice">$0</span></h2>

    

</body>
</html>
