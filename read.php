<?php
//verify if id exists and not null
if(isset($_GET['id']) && !empty(trim($_GET['id']))){

$servername="localhost";
$username="root";
$password="";
$dbname="souk";

//create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);
//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}

$sql= "SELECT * FROM article WHERE id=?";

if ($stmt = mysqli_prepare($conn,$sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id=trim($_GET["id"]);//supprimer les espaces de l'id s'ils existent

    if(mysqli_stmt_execute($stmt)){
        $result=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)==1){
            //récupérer l'enregistrement
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

            //récupérer les champs
            $name=$row["name"];
            $price=$row["price"];
            $quantity=$row["quantity"];
    } else {
        header("location: error.php");
        exit();
    }
} else {
    echo "Oops! une errure est survenue.";
}
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
} else {
    header("location: error.php");
    exit();
}

?>

<! DOCTYPE html>
<html>
<head>
    <style>
        .wrapper {
            width: 700px;
            margin: 0 auto;
        }

        h1 {
            color: burlywood;
        }

        Button{
            background-color: burlywood;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h1>Read an item</h1>
            <div>
                <label>Name</label>
                <p><strong><?php echo $row["name"]; ?></strong></p>
            </div>
            <div>
                <label>Price</label>
                <p><strong><?php echo $row["price"]; ?></strong>DT</p>
            </div>
            <div>
                <label>Quantity</label>
                <p><strong><?php echo $row["quantity"]; ?></strong></p>
            </div>
            <button onclick="document.location='index.php'">Return</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>