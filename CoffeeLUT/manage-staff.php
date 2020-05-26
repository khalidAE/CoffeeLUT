<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('location: index.php');
}

require('mysqli_connect.php');

$query = "SELECT * FROM staff";
$result = mysqli_query($conn, $query);


// If upload button is clicked ...
if (isset($_POST['add'])) {

    $Password = md5($_POST['password_field']);
    $query = "INSERT INTO staff (First_name, Last_name, Email, Phone_number, Password_) VALUES ('" . $_POST['fname_field'] . "', '" . $_POST['lname_field'] . "', '" . $_POST['email_field'] . "', '" . $_POST['phone_field'] . "', '" . $Password . "')";

    if (mysqli_query($conn, $query)) {
        header('location: manage-staff.php');
    }
}

if (isset($_POST['deleteBtn'])) {

    $id = $_POST['staff_id'];
    $query = "DELETE FROM staff WHERE Staff_ID = $id ";

    if (mysqli_query($conn, $query)) {
        header('location: manage-staff.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<?php
$page = 'profile';
include('templates/header.php');
?>


<!-- Grid -->
<section class="page-section">
    <div class="container-fluid">

        <div class="row padding">
            <div class="col-lg-12 text-center">
                <h1 class="padding">Manage Staff</h1>
                <button class="button-primary" data-toggle="modal" data-target="#staff-edit" href="#">Add</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr class="accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                            <td><?php echo $row["First_name"] . ' ' . $row['Last_name']; ?></td>
                            <td><?php echo $row["Email"]; ?></td>
                            <td><?php echo (isset($row['Phone_number']) ? $row['Phone_number'] : '-'); ?></td>
                            <td>
                                <form action="" method="POST">
                                    <button type="submit" class="button-primary button-red" name="deleteBtn"><i class="fas fa-ban"></i></button>
                                    <input type="hidden" name="staff_id" value="<?php echo $row['Staff_ID']; ?>">
                                </form>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

</section>



<!-- Modal X - Add -->
<div class="modal fade" id="staff-edit" tabindex="-1" role="dialog" aria-labelledby="staff-editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">

                <div class="container">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <legend>Add Staff</legend>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="fname_field">First Name</label>
                                <input type="text" class="form-control" id="fname_field" name="fname_field" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="lname_field">Last Name</label>
                                <input type="text" class="form-control" id="lname_field" name="lname_field" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="email_field">Email</label>
                                <input type="email" class="form-control" id="email_field" name="email_field" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="phone_field">Phone</label>
                                <input type="text" class="form-control" id="phone_field" name="phone_field" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <label for="password_field">Password</label>
                            <input type="password" class="form-control" id="password_field" name="password_field" placeholder="" required>
                        </div>

                        <br>

                        <div class="form-group">
                            <button type="submit" name="add" class="button-primary">Add Staff Member</button>
                        </div>
                    </form>
                </div>


            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>