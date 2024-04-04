<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>User Login</title>
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
          color: #868686;
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
          color: #868686;
          padding: 0 15px;
          border-radius: 0 5px 5px 0;
          border: 1px solid #444;
          caret-color: #339933;
          background: linear-gradient(#333,#222);
        }
        input:focus{
          color: #339933;
          box-shadow: 0 0 5px rgba(0,255,0,.2),
                      inset 0 0 5px rgba(0,255,0,.1);
          background: linear-gradient(#333933,#222922);
          animation: glow .8s ease-out infinite alternate;
        }
        @keyframes glow {
           0%{
            border-color: #339933;
            box-shadow: 0 0 5px rgba(0,255,0,.2),
                        inset 0 0 5px rgba(0,0,0,.1);
          }
           100%{
            border-color: #6f6;
            box-shadow: 0 0 20px rgba(0,255,0,.6),
                        inset 0 0 10px rgba(0,255,0,.4);
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
          color: #339933;
          border: 1px solid #339933;
          box-shadow: 0 0 5px rgba(0,255,0,.3),
                      0 0 10px rgba(0,255,0,.2),
                      0 0 15px rgba(0,255,0,.1),
                      0 2px 0 black;
        }
        .link{
          margin-top: 25px;
          color: #868686;
        }
        .link a{
          color: #339933;
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
        No users found
      </div>
      <div id="pass-rip" style="display: none;" class="alert alert-danger" role="alert">
        Incorrect password
      </div>
         <div class="text">
            LOGIN
         </div>
         <form action="" method="post">
            <div class="field">
               <div class="fas fa-user"></div>
               <input name="username" type="text" placeholder="Username">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" name="password" placeholder="Password">
            </div>
            <button name="login">LOGIN</button>
            <div class="link">
               Not a member?
               <a style="color: #339933; cursor: pointer;" onclick="signup()">Signup now</a>
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
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $uname = $username;
  $pass = $password;
  include  '../conn.php';
  $users = "SELECT * FROM `admins` WHERE username='$uname'";
  $query = mysqli_query($conn, $users);
  $usercount = mysqli_num_rows($query);
  if($usercount < 1 ){?>
  <script>
    document.getElementById("login-failed").style.display = "block";
  </script>
  <?php
  }else{
    $fetch = mysqli_fetch_array($query);
    $dbpass = $fetch['password'];
    if($pass == "$dbpass"){ ?>
    <form id="form" action="login-varify.php" method="post">
      <input type="hidden" value="<?php echo $uname ?>" name="uname">
      <input type="hidden" value="<?php echo $pass ?>" name="pass">
    </form>
    <script>
      document.getElementById("form").submit();
    </script>
    <?php
    }else{ ?>
    <script>
      document.getElementById("pass-rip").style.display = "block";
    </script>
    <?php
    }
  }
}
?>