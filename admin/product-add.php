<?php
include '../conn.php';
$parent_product_id = $_GET['parent_product_id'];
$url = $_GET['url'];
if(isset($_POST['submit'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_insert = "INSERT INTO `products`(`product_parent_id`, `product_name`, `product_price`, `product_status`) VALUES ('$parent_product_id','$product_name','$product_price','In Stock')";
    $product_inject = mysqli_query($conn, $product_insert);
    if($product_inject){ ?>
    <script>
    window.onload = function() {
        let timerInterval
        Swal.fire({
            icon: 'success',
            title: 'New category added successfully',
            html: 'You will be automatically redirected to categories in <b></b> milliseconds.',
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
          }
        })
    };
    window.setTimeout(function(){

// Move to a new location or you can do something else
window.location.href = "<?php echo $url ?>";

}, 3000);
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>New Category</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: "Poppins", sans-serif;
        }
        body {
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 20px;
          background: #191919;
        }
        .container {
          position: relative;
          max-width: 700px;
          width: 100%;
          background: #fff;
          padding: 25px;
          border-radius: 8px;
          box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .container header {
          font-size: 1.5rem;
          color: #333;
          font-weight: 500;
          text-align: center;
        }
        .container .form {
          margin-top: 30px;
        }
        .form .input-box {
          width: 100%;
          margin-top: 20px;
        }
        .input-box label {
          color: #333;
        }
        .form :where(.input-box input, .select-box, .input-box textarea) {
          position: relative;
          height: 50px;
          width: 100%;
          outline: none;
          font-size: 1rem;
          color: #707070;
          margin-top: 8px;
          border: 1px solid #ddd;
          border-radius: 6px;
          padding: 0 15px;
        }
        .input-box input:focus {
          box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }
        .form .column {
          display: flex;
          column-gap: 15px;
        }
        .form .gender-box {
          margin-top: 20px;
        }
        .gender-box h3 {
          color: #333;
          font-size: 1rem;
          font-weight: 400;
          margin-bottom: 8px;
        }
        .form :where(.gender-option, .gender) {
          display: flex;
          align-items: center;
          column-gap: 50px;
          flex-wrap: wrap;
        }
        .form .gender {
          column-gap: 5px;
        }
        .gender input {
          accent-color: rgb(130, 106, 251);
        }
        .form :where(.gender input, .gender label) {
          cursor: pointer;
        }
        .gender label {
          color: #707070;
        }
        .address :where(input, .select-box) {
          margin-top: 15px;
        }
        .select-box select {
          height: 100%;
          width: 100%;
          outline: none;
          border: none;
          color: #707070;
          font-size: 1rem;
        }
        .form button {
          height: 55px;
          width: 100%;
          color: #fff;
          font-size: 1rem;
          font-weight: 400;
          margin-top: 30px;
          border: none;
          cursor: pointer;
          transition: all 0.2s ease;
          background: #191919;
        }
        .form button:hover {
          background: #222222
        }
        /*Responsive*/
        @media screen and (max-width: 500px) {
          .form .column {
            flex-wrap: wrap;
          }
          .form :where(.gender-option, .gender) {
            row-gap: 15px;
          }
        }
        .input-box textarea {
            padding-top: 10px;
            height: 100px
        }
    </style>
  </head>
  <body>
    <section class="container">
      <header>Add New Product</header>
      <form action="" method="post" class="form">
        <div class="input-box">
            <label>Product Name</label>
            <input type="text" name="product_name" placeholder="Product Name" required/>
        </div>
        <div class="input-box">
            <label>Product Price</label>
            <input type="number" name="product_price" placeholder="Product Price" required/>
        </div>
    <button type="submit" name="submit">Submit</button>
</form>
</section>
</body>
</html>