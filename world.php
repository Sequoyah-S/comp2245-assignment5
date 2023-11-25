<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");
if (isset($_GET['country'])) {

  if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
    $stmt = $conn->prepare("SELECT name, district, population FROM cities WHERE countrycode = (SELECT code FROM countries WHERE name = :country)");
} else {
    $stmt = $conn->prepare("SELECT name, continent, indepyear, headofstate FROM countries WHERE name = :country");
}
  $country = $_GET['country'];
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1'>";
    echo "<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
    echo "<tr>";
    echo "<td>" . $result['name'] . "</td>";
    echo "<td>" . $result['continent'] . "</td>";
    echo "<td>" . $result['indepyear'] . "</td>";
    echo "<td>" . $result['headofstate'] . "</td>";
    echo "</tr>";
    echo "</table>";
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
