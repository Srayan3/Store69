<?php
error_reporting(0);
include '../conn.php';
$category_id = $_POST['category_id'];
if(isset($_POST['submit'])){
    $category_id_input = $_POST['category_id_input'];
    $thumbnail = $_FILES['product_parent_thumbnail'];
    $product_parent_name = $_POST['product_parent_name'];
    print_r($product_parent_thumbnail);

    $thumbnail_name = 's69-'.uniqid().uniqid();
    $filetype = str_replace('image/','', $thumbnail['type']);
    $upload = '../uploads/'.$thumbnail_name.'.'.$filetype;
    move_uploaded_file($thumbnail['tmp_name'], $upload);
    $upload_location = './uploads/'.$thumbnail_name.'.'.$filetype;


    $product_parent_name_insert = "INSERT INTO `parent_product`(`parent_product_category`, `parent_product_image`, `parent_product_name`) VALUES ('$category_id_input','$upload_location', '$product_parent_name')";
    $product_parent_inject = mysqli_query($conn, $product_parent_name_insert);
    if($product_parent_inject){ ?>
    <script>
    window.onload = function() {
        let timerInterval
        Swal.fire({
            icon: 'success',
            title: 'New parent product created successfully',
            html: 'You will be automatically redirected to Parent Products page in <b></b> milliseconds.',
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
window.location.href = "./parent-products";

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
    <title>New Parent Product</title>
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
        .thumbnail_input {
            height: 50px;
            padding: 0;
            width: 100%;
        }
        .thumbnail_input::file-selector-button {
            height: 50px;
            border: none;
        }
    </style>
  </head>
  <body>
    <section class="container">
      <header>New Parent Product</header>
      <form action="" method="post" class="form" enctype="multipart/form-data">
        <div class="input-box">
            <label>Tumbnail</label>
            <input type="file" name="product_parent_thumbnail" class="thumbnail_input" placeholder="Category Name" required/>
        </div>
        <div class="input-box">
            <label>Parent Product Name</label>
            <input type="text" name="product_parent_name" placeholder="New Parent Product Name" required/>
        </div>
        <input type="hidden" name="category_id_input" value="<?php echo $category_id ?>">
    <button type="submit" name="submit">Submit</button>
</form>
</section>
</body>
</html>