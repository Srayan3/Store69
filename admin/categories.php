<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/orders.css">
    <link rel="stylesheet" href="./css/sidepanel.css">
    <title>Categories</title>
</head>
<body onload="loadTable()">
    <div class="sidepanel">
    <?php include './sidepanel.php' ?>
    </div>
    <div class="container">
        <div class="top">
            <h2>Categories</h2>
        </div>
        <div class="tablegrandparent">
            <div id="tableparent" class="tableparent">
                <script type="text/javascript">
                  function loadTable(){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                      document.getElementById("tableparent").innerHTML = this.responseText;
                    }
                    xhttp.open("GET", "category-table.php");
                    xhttp.send();
                  }
                </script>
            </div>
        </div>
    </div>
    <script src="./scripts/script.js"></script>
</body>
</html>
