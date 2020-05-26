<?php
session_start();

if (!isset($_SESSION['user_type'])) {
    header('location: index.php');
}

require('mysqli_connect.php');

switch ($_SESSION['user_type']) {

    case 'admin':
        $query = "SELECT * FROM admin WHERE Admin_ID = " . ($_SESSION['admin_ID']);
        break;

    case 'staff':
        $query = "SELECT * FROM staff WHERE Staff_ID = " . ($_SESSION['staff_ID']);
        break;

    case 'customer':
        $query = "SELECT * FROM customer WHERE Customer_ID = " . ($_SESSION['customer_ID']);
        break;

    default:
        //
}

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);

if ($data) {
    if (count($data) > 0) {
    } else {
        echo 'Not OK';
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Header -->
<?php
$page = 'edit-profile';
include('templates/header.php');
?>



<!-- Fields -->
<div class="container-fluid padding ">
    <div class="row text-center padding circles-section width-80">
        <div class="col-lg-10" style="margin: 0 auto;">

            <div class="row">
                <div class="col-lg-12">
                    <h1>Edit Profile Info</h1>
                </div>
            </div>

            <div class="container">
                <form>
                    <div id="alert-field" class="alert hidden">
                        <p>Uh oh! Something went wrong!</p>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="fname-field">First Name *</label>
                            <input type="text" class="form-control" id="fname-field" name="fname-field" placeholder="First name" value="<?php if ($data) {
                                                                                                                                            echo $data['First_name'];
                                                                                                                                        } ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lname-field">Last Name *</label>
                            <input type="text" class="form-control" id="lname-field" name="lname-field" placeholder="Last name" value="<?php if ($data) {
                                                                                                                                            echo $data['Last_name'];
                                                                                                                                        } ?>" required>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="email-field">Email *</label>
                            <input type="email" class="form-control" id="email-field" name="email-field" placeholder="Email address" value="<?php if ($data) {
                                                                                                                                                echo $data['Email'];
                                                                                                                                            } ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone-field">Phone Number</label>
                            <input type="text" class="form-control" id="phone-field" name="phone-field" placeholder="Phone Number" value="<?php if ($data['Phone_number']) {
                                                                                                                                                echo $data['Phone_number'];
                                                                                                                                            } ?>" required>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="country-field">Country</label>
                            <select class="form-control" name="country-field" required>
                                <option value="0">Select...</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="USA">United States</option>
                                <option value="UAE">United Arab Emirates</option>
                                <option value="ESP">Spain</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>



                        <div class="form-group col-md-6">
                            <label for="city-field">City</label>
                            <select class="form-control" name="city-field" required>
                                <option value="0">Select...</option>
                                <option value="RUH">Riyadh</option>
                                <option value="DMM">Dammam</option>
                                <option value="MED">Medina</option>
                                <option value="JED">Jeddah</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">


                        <div class="form-group col-md-6">
                            <label for="address1-field">Address 1</label>
                            <input type="text" class="form-control" id="address1-field" name="address1-field" placeholder="Address 1" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address2-field">Address 2</label>
                            <input type="text" class="form-control" id="address2-field" name="address2-field" placeholder="Address 2" required>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="body-field">Notes</label>
                        <textarea id="body-field" name="body-field" class="form-control" placeholder="Type your message here" required></textarea>
                    </div>


                    <div class="form-group">
                        <button type="submit" onclick="window.location= '#'" class="button-primary">Save changes</button>
                    </div>
                </form>
            </div>

            <div class="new-billing-address">
                <div class="title">
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