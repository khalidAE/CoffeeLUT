<?php
require('mysqli_connect.php');

if (isset($_POST["Product_ID"])) {
    $output = '';

    if ($_POST['Page'] == 'edit') {

        $query = "SELECT * FROM product WHERE Product_ID = '" . $_POST["Product_ID"] . "'";
        $result = mysqli_query($conn, $query);
        $output .= '  ';
        $row = mysqli_fetch_array($result);

        $checked = ($row['Availability'] == '1' ? 'checked' : ' ');

        echo "
        <div class='container'>
        <form method='POST' action='control-products.php' name='saveForm' enctype='multipart/form-data'>
        <legend>Edit Product</legend>

            <div class='form-row'>
                <div class='form-group col-md-12'>
                    <label for='name_field'>Name</label>
                    <input type='text' class='form-control' id='name_field' name='name_field'
                        value='" . $row['Product_name'] . "' required>
                        <input type='hidden' name='id' value='" . $row['Product_ID'] . "'>

                </div>
            </div>

            <div class='form-row'>
                <div class='form-group col-md-12'>
                    <label for='price_field'>Price (SR)</label>
                    <input type='number' class='form-control' id='price_field' name='price_field'
                        value='" . $row['Price'] . "' required>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-group col-md-12'>
                    <label for='category_field'>Category</label>
                    <input type='text' class='form-control' id='category_field' name='category_field'
                        value='" . $row['category'] . "' required>
                </div>
            </div>

            <div class='form-row'>
                <input type='Checkbox' class='availability-ckeckbox' id='availability_field' name='availability_field'
                    value='1' ' . $checked . '>
                    <label for='availability_field'>Available</label>
            </div>

            <div class='form-row'>
                <label for='picture_field'>Select a picture:</label>
                <input type='file' name='image' class='form-control' id='picutre_field' >
                </div>
<br>
            <div class='form-group'>
            <button class='button-primary saveBtn' id='" . $row['Product_ID'] . "'>Save Changes</button>
            <button type='button' class='button-primary button-red deleteBtn' id='" . ($row['Product_ID'] - 1) . "'>Delete</button>

            </div>
        </form>
    </div>
        ";
    } else if ($_POST['Page'] == 'view') {

        $query = "SELECT * FROM product WHERE Product_ID = '" . $_POST["Product_ID"] . "'";
        $result = mysqli_query($conn, $query);
        $output .= '  
      <div class="row">';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
           <div class="col-lg-6">
           <img class="card-img-top" src="img/products/' . $row['Product_ID'] . '.png">
       </div>
       
       <div class="col-lg-6">
           <h2>' . $row['Product_name'] . '</h2>
           <p>Availability: ' . ($row['Availability'] == 1 ? 'In stock' : '<span class="red">Out of stock</span>') . '</p>
           <p class="card-text">SR ' . number_format($row['Price']) . '</p>
       
           <form action="add-To-Cart.php" method="POST">
           <div class="form-group">
           <label for="quant">Quantity</label>
           <input type="number" name="quant" id="quant" required style="width:80px">
           </div>

           <button type="submit" class="button-primary" name="addToCartBtn">Add to cart</button>
           <input type="hidden" name="product_id" value="' . $row['Product_ID'] . '">
           <input type="hidden" name="product_name" value="' . $row['Product_name'] . '">
           <input type="hidden" name="product_price" value="' . $row['Price'] . '">
       </form>
       </div>
                ';
        }
        $output .= "</div>";
        echo $output;
    }
}

echo '
    <script>
    //$(document).ready(function() {
        $(".deleteBtn").click(function() {
            var Product_ID = $(this).attr("id");
    
            $.ajax({
                url: "control-products.php",
                method: "post",
                data:{
                    Product_ID: Product_ID,
                    Page: "delete"
                },
                success: function(data){
                    window.location.assign("manage-products.php");
    
                }
            });
    
        });
        
        $(".saveBtn").click(function() {
            $.post("control-products.php", $("saveForm :input").serializeArray()) , function(data) {
                console.log(data)
                alert("Inside saveBtn")
            }
            });
        //});
    </script>
    ';
