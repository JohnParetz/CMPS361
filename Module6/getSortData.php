
<?php
// Sample customer purchase data
$customers = [
    ["id" => 1001, "first" => "John", "last" => "Smith", "product" => "Laptop", "price" => 750],
    ["id" => 1002, "first" => "Alex", "last" => "Brown", "product" => "Mouse", "price" => 25],
    ["id" => 1003, "first" => "Sarah", "last" => "Wilson", "product" => "Keyboard", "price" => 65],
    ["id" => 1004, "first" => "Mike", "last" => "Johnson", "product" => "Monitor", "price" => 220],
    ["id" => 1005, "first" => "Emma", "last" => "Davis", "product" => "Headphones", "price" => 90],
    ["id" => 1006, "first" => "David", "last" => "Miller", "product" => "Webcam", "price" => 55],
    ["id" => 1007, "first" => "Anna", "last" => "Taylor", "product" => "Tablet", "price" => 340],
    ["id" => 1008, "first" => "Sam", "last" => "Anderson", "product" => "USB Drive", "price" => 15],
    ["id" => 1009, "first" => "Chris", "last" => "Thomas", "product" => "Printer", "price" => 180],
    ["id" => 1010, "first" => "Lisa", "last" => "White", "product" => "Speakers", "price" => 75],
    ["id" => 1011, "first" => "Ryan", "last" => "Martin", "product" => "SSD", "price" => 120],
    ["id" => 1012, "first" => "Olivia", "last" => "Lee", "product" => "Microphone", "price" => 110],
    ["id" => 1013, "first" => "James", "last" => "Clark", "product" => "Router", "price" => 85],
    ["id" => 1014, "first" => "Sophia", "last" => "Hall", "product" => "Graphics Card", "price" => 450],
    ["id" => 1015, "first" => "Daniel", "last" => "Young", "product" => "Gaming Chair", "price" => 200]
];

// Get sorting options from the URL
$sort = $_GET["sort"] ?? "id";
$order = $_GET["order"] ?? "asc";

// Only allow valid columns
$columns = ["id", "first", "last", "product", "price"];

if (!in_array($sort, $columns)) {
    $sort = "id";
}

$order = $order === "desc" ? "desc" : "asc";

// Sort the customer records
usort($customers, function($a, $b) use ($sort, $order) {
    $result = $a[$sort] <=> $b[$sort];
    return $order === "asc" ? $result : -$result;
});

 // Pagination - 5 customers per page only
$limit = 5;
$totalPages = ceil(count($customers) / $limit);

$page = max(1, (int)($_GET["page"] ?? 1));
$page = min($page, $totalPages);

$start = ($page - 1) * $limit;
$records = array_slice($customers, $start, $limit);

// Create sorting links
function sortLink($column, $title, $sort, $order, $page) {
    $nextOrder = ($sort === $column && $order === "asc") ? "desc" : "asc";
    return "<a href='?sort=$column&order=$nextOrder&page=$page'>$title</a>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Module 6 - Customer Records</title>
    <link rel="stylesheet" href="styles.css">
    <script src="searchTable.js" defer></script>
</head>
<body>

<h1>CMPS 361 - Module 6</h1>
<h2>Customer Purchase Records</h2>

<p>Click a column heading to sort the records.</p>
<label for="search">Search For Customers:</label>
<input type="text" id="search" placeholder="Search by name, product, ID or Price...">

<table>
    <thead>
        <tr>
            <th><?= sortLink("id", "Customer ID", $sort, $order, $page) ?></th>
            <th><?= sortLink("first", "First Name", $sort, $order, $page) ?></th>
            <th><?= sortLink("last", "Last Name", $sort, $order, $page) ?></th>
            <th><?= sortLink("product", "Product", $sort, $order, $page) ?></th>
            <th><?= sortLink("price", "Price", $sort, $order, $page) ?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($records as $customer): ?>
        <tr>
            <td><?= $customer["id"] ?></td>
            <td><?= htmlspecialchars($customer["first"]) ?></td>
            <td><?= htmlspecialchars($customer["last"]) ?></td>
            <td><?= htmlspecialchars($customer["product"]) ?></td>
            <td>$<?= number_format($customer["price"], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination">

    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>">
            Previous
        </a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>">
            Next
        </a>
    <?php endif; ?>
</div>

<p>Page <?= $page ?> of <?= $totalPages ?></p>

<p><strong>Total Records: <?= count($customers) ?></strong></p>

<script>
    const customers = <?= json_encode($customers, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
</script>

<h2>Compare Customers Spendings</h2>

<div class="comparison">
    <select id="customer1">
        <option value="">Select first customer</option>
    </select>

    <select id="customer2">
        <option value="">Select second customer</option>
    </select>

    <button id="compareBtn">Compare</button>

    <p id="compareResult"></p>
</div>

</body>
</html>
