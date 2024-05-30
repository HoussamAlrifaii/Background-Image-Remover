<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url(bg.svg);
            background-size: cover;
        }
        
        table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #297ea6;
            color: #fff;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #297ea6;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #205a7a;
        }
    </style>
</head>
<body>
    <form method="post">
        <input type="submit" name="loadData" value="Display Data">
    </form>

    <?php
    if (isset($_POST['loadData'])) {

       
        define("db_SERVER", "localhost");
        define("db_USER", "root");
        define("db_PASSWORD", "");
        define("db_DBNAME", "registration");

       
        $con = mysqli_connect(db_SERVER, db_USER, db_PASSWORD, db_DBNAME);

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

      
        $sql = "SELECT * FROM register";
        $result = mysqli_query($con, $sql);

        if ($result) {
           
            if (mysqli_num_rows($result) > 0) {
       
                echo "<table border='1'>";
                echo "<tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Password</th>
                     </tr>";

              
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";

                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No data found in the table.";
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }

      
        mysqli_close($con);
    }
    ?>
</body>
</html>
