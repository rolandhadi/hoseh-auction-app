<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('about');
            $table->text('footer');
            $table->timestamps();
        });

        DB::table('abouts')->insert([
          'about' => '<h1 class="title-header about">ABOUT US</h1>
          <p class="about" contentEditable="true">
            Hoseh is an online entertainment shopping website giving you the latest technology, a luxurious lifestyle & the most stunning service at its best as possible.
  A variety of gadgets, fashion wear, electronics & accessories are placed daily. This online site will suit every shopper & will definitely give you the satisfaction you’ve ever had. So have fun.. “Hoseh will give you the superb online shopping experience ever!”
          </p>
          <br>

          <h1 class="title-header about">Our Mission</h1>
          <p class="about" contentEditable="true">
            Hoseh is here to provide a thrilling & unique online auctioning experience in getting items at a very low price & allowing our customers access to quality products in an enjoyable manner while ensuring its security and authenticity.
          </p>
          <br>

          <h1 class="title-header about">Our Vision</h1>
          <p class="about" contentEditable="true">
            To be unique and trusted in the online auctioning business with the most wanted items than any other websites.
          </p>
          <br>

          <h1 class="title-header about">Our Commitment</h1>
          <p class="about" contentEditable="true">
            1.	Customer service is our top priority - we will listen to all fair and reasonable feedback
          </p>
          <p class="about" contentEditable="true">
            2.	We strive to ensure a friendly and fun user experience
          </p>
          <p class="about" contentEditable="true">
            3.	All our products are brand new and lovingly sourced by our Products Team
          </p>
          <p class="about" contentEditable="true">
            4.	We are fair and ethical.
          </p>
          <br>
          <br>
          <h1 id="return" class="title-header about">SHIPPING/RETURN/REFUNDS</h1>
          <br>
          <h1 id="delivery" class="title-header about">Shipping</h1>
          <p class="about" contentEditable="true">
            •	Usually the shipping will take about 3 to 7 days upon settling the payment. Strictly no shipping on weekends.
          </p>
          <p class="about" contentEditable="true">
            •	You will be responsible for paying for your own shipping costs.
          </p>
          <p class="about" contentEditable="true">
            •	Shipping costs are non-refundable.
          </p>
          <p class="about" contentEditable="true">
            •	Shipping cost will depend on the weight and size of the item/products.
          </p>
          <br>

          <h1 class="title-header about">Returns</h1>
          <p class="about" contentEditable="true">
            •	If you are not 100% satisfied with your purchase, you can return the product and get a full refund or exchange the product for another one, be it similar or not.
          </p>
          <p class="about" contentEditable="true">
            •	You can return a product for up to 30 days from the date you purchased it.
          </p>
          <p class="about" contentEditable="true">
            •	Any product you return must be in the same condition you received it and in the original packaging. Please keep the receipt.
          </p>
          <p class="about" contentEditable="true">
            •	Usually the shipping will take about 3 to 7 days upon settling the payment. Strictly no shipping on weekends.
          </p>
          <br>
          <h1 class="title-header about">Refunds</h1>
          <p class="about" contentEditable="true">
            1.	Once we receive your item, we will inspect it and notify you that we have received your returned item. We will immediately notify you on the status of your refund after inspecting the item.
          </p>
          <p class="about" contentEditable="true">
            2.	If your item is approved, we will initiate a refund to your credit card or the method you use for paying. You will receive the credit within the certain amount of days, depending on the policies.
          </p>
          <br>
          <br>

          <h1 id="tac" class="title-header about">TERMS & CONDITIONS</h1>
          <br>
          <h1 class="title-header about">Our Website</h1>
          <p class="about" contentEditable="true">
            By using this website and any service contained within constitutes acceptance by you of these terms & conditions.
          </p>
          <br>
          <h1 class="title-header about">Eligibility</h1>
          <p class="about" contentEditable="true">
            •	You must be a minimum age of 18 to register with and use this website. Furthermore you must be able to enter into legally binding contracts. By registering and using this website you warrant that you are 18 or older, have the capacity to enter into contracts and understand your obligations under these Terms & Conditions.
          </p>
          <p class="about" contentEditable="true">
            •	You will not be eligible to use this website if you have previously been banned from using it and a ban is currently still in place, or where you have been suspended and a suspension is still in place.
          </p>
          <br>
          <h1 class="title-header about">Registration</h1>
          <p class="about" contentEditable="true">
            •	As part of the registration process you will need to create an account, including a username & password. It is your responsibility to ensure that the information you provide is accurate, not misleading and relates to you. You cannot create an account or username & password using the names and information of another person or using words that are the trademarks or the property of another party (including ours), or vulgar, obscene or in any other way inappropriate. We reserve the right with or without notice to suspend or terminate any account in breach.
          </p>
          <p class="about" contentEditable="true">
            •	If for any reason you suspect that your username & password has been disclosed to or obtained by another party you should contact us immediately. Please note that we never contact users requesting them to confirm their username & password or other details.
          </p>
          <br>
          <h1 class="title-header about">Specific Auction Rules</h1>
          <p class="about" contentEditable="true">
            As a user you agree not to do any of the following:
          </p>
          <p class="about" contentEditable="true">
            •	Advertise items in inappropriate categories on the website
          </p>
          <p class="about" contentEditable="true">
            •	Fail to pay for any item purchased by you, whether sold at a fixed price or auction. This excludes where the seller materially alters the terms of the sale after you have bid or agreed to purchase, or where the items are not as described or where the seller’s identity cannot be clearly authenticated.
          </p>
          <p class="about" contentEditable="true">
            •	Fail to deliver any item where the sale has been agreed, unless the buyer cannot meet the terms of sale agreed, or where the buyer’s identity cannot be clearly authenticated.
          </p>
          <p class="about" contentEditable="true">
            •	Manipulate the auction process or price of any item, including (but not limited to) auction for your own items, working in conjunction with others to bid-up items, entering high bids and then withdrawing them, or any other form of manipulation or concerted action to distort the auction process whether related to your own items or those of another user.
          </p>
          <p class="about" contentEditable="true">
            •	Use data provided by other users for purposes other than contacting them via the website.
          </p>
          <p class="about" contentEditable="true">
            •	Encourage illegal activity or activity that violates the rights of other users or third parties, whether individuals or organisations.
          </p>
          <p class="about" contentEditable="true">
            •	Attempt to gain access to our servers or other equipment in order to disrupt, impair, overload or otherwise hinder or compromise the safety, security or privacy of any of the services provided by or relied upon by us and other users.
          </p>
          <br>
          <br>
          <h1 class="title-header about">HOW TO BID</h1>
          <p class="about" contentEditable="true">
            	1. Auction the item by clicking the “BID” button.
          </p>
          <p class="about" contentEditable="true">
            	2. Each bid increases the auction price.
          </p>
          <p class="about" contentEditable="true">
            	3. When the timer hits 0:00:00, the auction closes and the last bidder wins.
          </p>
          <br>
          <br>
          <h1 id="contact" class="title-header about">CONTACT US</h1>
          <p class="about" contentEditable="true">
            	If you have any questions or concerns, please contact us via following:
          </p>
          <p class="about" contentEditable="true">
            	E-mail: hoseh@gmail.com
          </p>
          <br>
          <br>
          <h1 class="title-header about">F.A.Q.</h1>
          <br>
          <h1 class="title-header about">ACCOUNT</h1>
          <p class="about" contentEditable="true">
            <b>1. Do participants need to create an account to bid on items?</b>
          </p>
          <p class="about" contentEditable="true">
            	Anyone with a link to your online auction can view it without having an account. This is a great way to increase interest in the auction. An account is only needed in order to bid. The process is quick and very little information is required as you can see on the Create An Account page. Requiring an account for auction makes it easy for auction administrators to identify and communicate with bidders during and after the auction.
          </p>
          <p class="about" contentEditable="true">
            <b>2. I forgot my password. How can I log into my account?</b>
          </p>
          <p class="about" contentEditable="true">
          		You can reset your password by following these steps.
          </p>
          <p class="about" contentEditable="true">
            	1. Click the LOGIN link in the upper right hand corner of the site.
          </p>
          <p class="about" contentEditable="true">
            	2. Click the Forgot password? link.
          </p>
          <p class="about" contentEditable="true">
            	3. Enter your HOSEH account email address.
          </p>
          <p class="about" contentEditable="true">
            	4. Check your email for the reset password instructions.
          </p>
          <p class="about" contentEditable="true">
            	5. Click the reset password link contained in the email message.
          </p>
          <p class="about" contentEditable="true">
            	6. Enter a new password and your HOSEH account email address.
          </p>
          <p class="about" contentEditable="true">
            <b>3. How do I cancel my account?</b>
          </p>
          <p class="about" contentEditable="true">
            	Cancelling your account will immediately log you out of the site and prevent you from creating, accessing, and participating in auctions.
          </p>
          <p class="about" contentEditable="true">
            	You can cancel your account from the My Account page. To view this page, log into your account, click the Account menu option, then click the My Account link.
          </p>
          <br>
          <br>
          <h1 class="title-header about">AUCTION/BIDDING</h1>
          <p class="about" contentEditable="true">
            <b>1. What happens in the case where 2 bids are the same?</b>
          </p>
          <p class="about" contentEditable="true">
            Anytime the system receives 2 bids that are the same, the first bid entered into the system wins. When the bid history displays 2 bids of the same amount, the bid which was placed first is a proxy bid. When someone submits a second bid of the same amount, the first bidder continues to be the winning bidder because they were first to bid that amount.
          </p>
          <p class="about" contentEditable="true">
            <b>2. How do I find out who won an auction item?</b>
          </p>
          <p class="about" contentEditable="true">
            	During and after an auction, the auction administrators can view the Sales Summary information. To view the Sales Summary information, log into your auction and click the Sales Summary link found in the Admin Controls menu. Clicking this link will bring you to a page that displays a list of the items, the winning bid amount, and the winning bidder (including their name, email, and phone number). If there is not a winning bidder, it will state that next to the item.
          </p>
          <br>
          <br>
          <h1 id="payments" class="title-header about">PAYMENTS</h1>
          <p class="about" contentEditable="true">
            <b>1. What payment processing options are available when adding the Payment Collection?</b>
          </p>
          <p class="about" contentEditable="true">
            We currently support linking PayPal payment account to auctions for collecting payments. PayPal is secure and trusted and they make the payment process easy for participants and auction administrators. PayPal expands the available payment options by accepting PayPal accounts and eChecks, in addition to credit cards and debit cards.
          </p>',
          'footer' => '				<div class="col-sm-8">
          					<div class="col-sm-5">
          						<h3 class="about-footer">About</h3>
          						<p class="about-footer">Hoseh is an online entertainment shopping website giving you the latest technology, a luxurious lifestyle & the most stunning service at its best as possible.
          	A variety of gadgets, fashion wear, electronics & accessories are placed daily. This online site will suit every shopper & will definitely give you the satisfaction you’ve ever had. So have fun.. “Hoseh will give you the superb online shopping experience ever!”
          	</p>
          						<div class="social">
          							<a href="" class="facebook"><i class="fa fa-facebook"></i></a>
          							<a href="" class="twitter"><i class="fa fa-twitter"></i></a>
          							<a href="" class="google"><i class="fa fa-google"></i></a>

          						</div>
          						<h4 class="about-footer">Email : hoseh@gmail.com</h4>
          					</div>
          					<div class="col-sm-4">
          						<h3 class="about-footer">Mission</h3>
          						<p class="about-footer">Hoseh is here to provide a thrilling & unique online auctioning experience in getting items at a very low price & allowing our customers access to quality products in an enjoyable manner while ensuring its security and authenticity.</p>
          						<h3 class="about-footer">Vision</h3>
          						<p class="about-footer">To be unique and trusted in the online auctioning business with the most wanted items than any other websites.</p>
          					</div>
          					<div class="col-sm-3">
          						<h3 class="about-footer">Commitment</h3>
          						<ul class="nav-list">
          							<li class="about-footer">Customer service is our top priority - we will listen to all fair and reasonable feedback</li>
          							<li class="about-footer">We strive to ensure a friendly and fun user experience</li>
          							<li class="about-footer">All our products are brand new and lovingly sourced by our Products Team</li>
          							<li class="about-footer">We are fair and ethical</li>
          						</ul>
          					</div>
          				</div>
          				<div class="pull-right">
          					<h3 class="about-footer">Utilities</h3>
          					<ul class="nav-list">
          						<li><a href="/about#contact">Contact us</a></li>
          						<li><a href="/about#payments">Terms of Payment</a></li>
          						<li><a href="/about#return">Return and Refund</a></li>
          						<li><a href="/about#delivery">Delivery</a></li>
          						<li><a href="/about#tac">Terms and conditions</a></li>
          					</ul>
          				</div>'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abouts');
    }
}
