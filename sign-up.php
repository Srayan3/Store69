<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Sign Up</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');
        *{
          margin: 0;
          padding: 0;
          font-family: 'Poppins',sans-serif;
        }
        body{
          display: flex;
          height: 100vh;
          text-align: center;
          align-items: center;
          justify-content: center;
          background: #151515;
        }
        .login-form{
          position: relative;
          width: 370px;
          height: auto;
          background: #1b1b1b;
          padding: 40px 35px 60px;
          box-sizing: border-box;
          border: 1px solid black;
          border-radius: 5px;
          box-shadow: inset 0 0 1px #272727;
        }
        .text{
          font-size: 30px;
          color: #c7c7c7;
          font-weight: 600;
          letter-spacing: 2px;
        }
        form{
          margin-top: 40px;
        }
        form .field{
          margin-top: 20px;
          display: flex;
        }
        .field .fas{
          height: 50px;
          width: 60px;
          color: rgb(30, 148, 255);
          font-size: 20px;
          line-height: 50px;
          border: 1px solid #444;
          border-right: none;
          border-radius: 5px 0 0 5px;
          background: linear-gradient(#333,#222);
        }
        .field input,form button{
          height: 50px;
          width: 100%;
          outline: none;
          font-size: 19px;
          color: rgb(30, 148, 255);
          padding: 0 15px;
          border-radius: 0 5px 5px 0;
          border: 1px solid #444;
          caret-color: rgb(30, 148, 255);
          background: linear-gradient(#333,#222);
        }
        input:focus{
          color: rgb(30, 148, 255);
          box-shadow: 0 0 5px rgb(30, 148, 255),
                      inset 0 0 5px rgba(30, 148, 255, .9);
          background: linear-gradient(rgba(30, 148, 255, 0.1),rgba(30, 148, 255, 0.01););
          animation: glow .8s ease-out infinite alternate;
        }
        @keyframes glow {
           0%{
            border-color: rgb(30, 148, 255);
            box-shadow: 0 0 5px rgb(30, 148, 255),
                        inset 0 0 5px rgba(30, 148, 255, .9);
          }
           100%{
            border-color: rgb(30, 148, 255);
            box-shadow: 0 0 5px rgb(30, 148, 255),
                        inset 0 0 5px rgba(30, 148, 255, .9);
          }
        }
        button{
          margin-top: 30px;
          border-radius: 5px!important;
          font-weight: 600;
          letter-spacing: 1px;
          cursor: pointer;
        }
        button:hover{
          color: rgb(30, 148, 255);
          border: 1px solid rgb(30, 148, 255);
          box-shadow: 0 0 5px rgba(30, 148, 255, 1),
                      0 0 5px rgba(30, 148, 255, .9),
                      0 0 5px rgba(30, 148, 255, .7),
                      0 2px 0 black;
        }
        .link{
          margin-top: 25px;
          color: #fff;
        }
        .link a{
          color: rgb(30, 148, 255);
          text-decoration: none;
        }
        .link a:hover{
          text-decoration: underline;
        }
      </style>
   </head>
   <body>
      <div class="login-form">
      <div id="login-failed" style="display: none;" class="alert alert-danger" role="alert">
        This e-mail has already been registered
      </div>
         <div class="text">
            SIGN UP
         </div>
         <form action="" method="post">
            <div class="field">
               <div class="fas fa-signature"></div>
               <input name="name" type="text" placeholder="Full Name">
            </div>
            <div class="field">
               <div class="fas fa-user"></div>
               <input name="email" type="text" placeholder="E-Mail">
            </div>
            <div class="field">
               <div class="fas fa-phone"></div>
               <input name="number" type="number" placeholder="Phone Number">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" name="password" placeholder="Password">
            </div>
            <button name="sign-up">SIGN UP</button>
            <div class="link">
               Already have an account?
               <a style="color: rgb(30, 148, 255); cursor: pointer;" onclick="signup()">Login</a>
            </div>
         </form>
      </div>
      <script>
        function signup(){
          Swal.fire(
            'Sign Up',
            'To create a user account in TMK you need to be a official member of Mad Kings, and if you are a official contact MK Nick or the Developer to create an account',
            'info'
          )
        }
      </script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   </body>
</html>
<?php
if(isset($_POST['sign-up'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $password = $_POST['password'];
  $mail = $email;
  $pass = password_hash($password, PASSWORD_DEFAULT);
  include  './conn.php';
  $users = "SELECT * FROM `users` WHERE email='$mail'";
  $query = mysqli_query($conn, $users);
  $usercount = mysqli_num_rows($query);
  $fetch = mysqli_fetch_array($query);
  if($usercount < 1 ){
    $insert = "INSERT INTO `users`(`name`, `email`, `number`, `password`) VALUES ('$name', '$mail', '$number', '$pass')";
    $inject = mysqli_query($conn, $insert);
    if($inject){ ?>
    <form id="form" action="sign-up-process" method="post">
      <input type="hidden" name="email" value="<?php echo $mail ?>">
      <input type="hidden" name="password" value="<?php echo $pass ?>">
    </form>
    <script>
      function submitForm(){
        document.getElementById('form').submit();
      }
      submitForm();
    </script>
    <?php
    }else{ ?>
    <script>
      document.getElementById("login-failed").style.display = "block";
    </script>
    <?php
  }
}
}
?>