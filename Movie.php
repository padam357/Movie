
<?php
// Database connection details
$host = "mi-linux.wlv.ac.uk";
$username = "2448409";
$password = "Padam@321";
$database = "db2448409";

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Retrieve movie records
$sql = "SELECT Movie_name, Genre, Price, `Date of release`
        FROM movies";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }
    </style>
</head>
<body>

    <h1>Movie List</h1>

    <table>
        <tr>
            <th>Movie name</th>
            <th>Genre</th>
            <th>Price</th>
            <th>Date of release</th>
        </tr>

        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";

                echo "<td>" .
                    htmlspecialchars($row["Movie_name"]) .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($row["Genre"]) .
                    "</td>";

                echo "<td>£" .
                    number_format((float)$row["Price"], 2) .
                    "</td>";

                echo "<td>" .
                    date(
                        "d/m/Y",
                        strtotime($row["Date of release"])
                    ) .
                    "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No movies found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

</body>
</html>
