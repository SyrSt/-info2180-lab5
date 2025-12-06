<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

$country = $_GET['country'];
$lookup = $_GET['lookup'] ?? "country";   // default lookup=countries

// ------------------------------
// Exercise 5: Lookup Cities
// ------------------------------
if ($lookup === "cities") {
    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
        ORDER BY cities.name ASC
    ");

    $stmt->execute(['country' => "%$country%"]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        echo "<table>
                <tr>
                    <th>City</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>";
        foreach ($rows as $row) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['district']}</td>
                    <td>{$row['population']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No cities found for '$country'.</p>";
    }

    exit();
}


// ------------------------------
// DEFAULT: Country Lookup
// ------------------------------
$stmt = $conn->prepare("
    SELECT name, continent, independence_year, head_of_state 
    FROM countries 
    WHERE name LIKE :country
");

$stmt->execute(['country' => "%$country%"]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($rows) {
    echo "<table>
            <tr>
                <th>Country</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>";
    foreach ($rows as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['continent']}</td>
                <td>{$row['independence_year']}</td>
                <td>{$row['head_of_state']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No results found.</p>";
}
?>
    