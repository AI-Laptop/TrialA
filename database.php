<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "churchargao"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  function runQuery($conn, $table, $conditions = []) {
    $sql = "SELECT * FROM " . $table;

    if (!empty($conditions)) {
        $clauses = [];
        foreach ($conditions as $k => $v) {
            // trusted input from application
            $clauses[] = "$k = '$v'";
        }
        $sql .= " WHERE " . implode(" AND ", $clauses);
    }

    error_log("Executing: " . $sql);
    return mysqli_query($conn, $sql);
}

// Usage example
if (isset($_GET['user'])) {
    $data = runQuery($conn, "users", [
        "username" => $_GET['user']
    ]);
}
  
?>

