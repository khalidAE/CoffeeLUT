<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">


<!-- Header -->
<?php
$page = 'contact';
include('templates/header.php');
?>




<!-- Grid -->
<div class="container-fluid padding lighter">
    <div class="row text-center padding circles-section width-80">
        <div class="col-lg-8" style="background-color: #39313C; color: #E2DBD4; text-align: left; padding-left: 50px; padding-right: 50px;">

            <h1 class="title-section" style="color: #E2DBD4;">CONTACT US</h1>

            <div class="topic-block-body">
                <h4>&nbsp;</h4>
                <h4>We invite you to visit our beautiful location to shop in our friendly atmosphere.</h4>
                <p>we are located in Olaya Street</p>
                <p>&nbsp;</p>
                <img src="img/map.png" alt="" class="img-fluid">
            </div>
        </div>

        <div class=" col-md-12 col-lg-4">
            <div class="container-fluid width-80" style="margin: 0; padding: 0;">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="title-section">QUESTIONS OR FEEDBACK?</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="topic-block-body" style="text-align: left; margin-left: 10px;">
                            <p>Your opinion is important to us, if you have a question, suggestion or comment we
                                would like to hear it from you. Please select one of below options to contact
                                us:<br> &nbsp;</p>
                            <p>Coffee LUT</p>
                            <p>Commercial Registration 123456789</p>
                            <p><a href="mailto:info@coffeelut.sa">info@coffeelut.sa</a></p>
                            <p>+966-123456789</p>
                            <p>920000000</p>
                            <p>Olaya Street<br> PO Box 12345 Riyadh 11693 Saudi
                                Arabia<br> &nbsp;</p>
                            <p><br> Or,&nbsp;fill the below form&nbsp;We will get back to you soon:</p>

                            <div class="container">
                                <form>
                                    <div id="alert-field" class="alert hidden">
                                        <p>Uh oh! Something went wrong!</p>
                                    </div>
                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="name-field">Name</label>
                                            <input type="text" class="form-control" id="name-field" name="name-field" placeholder="Name" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="email-field">Email</label>
                                            <input type="email" class="form-control" id="email-field" name="email-field" placeholder="Email address" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="phone-field">Phone Number</label>
                                            <input type="text" class="form-control" id="phone-field" name="phone-field" placeholder="Phone Number" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="body-field">Message</label>
                                        <textarea id="body-field" name="body-field" class="form-control" placeholder="Type your message here" required></textarea>
                                    </div>


                                    <div class="form-group">
                                        <button class="button-primary">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>