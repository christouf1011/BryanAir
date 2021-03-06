<?php

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT IATA, name FROM airport";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    $destinationsHTML = "";
    while($airport = mysqli_fetch_assoc($result)) {
        $destinationsHTML .= sprintf("<option value= %s>", $airport["IATA"]);
        $destinationsHTML .= sprintf("%s - (%s)", $airport["name"], $airport["IATA"]);
        $destinationsHTML .= "</option>";
    }
} else {
    throw new Exception("Could Not Find any airport");
}

mysqli_close($conn);

$tags ["destinations"] = $destinationsHTML;
$tags["title"] = "Reservation";
$_SESSION["status"] = 1;
echo buildHTML("reservation", $tags);
?>