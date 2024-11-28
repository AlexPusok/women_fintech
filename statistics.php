<?php
global $totalMembersQuery;
include_once "config/database.php";
include_once "includes/header.php";

$database = new Database();
$db = $database->getConnection();

$totalMembersQuery = "SELECT COUNT(*) FROM members";
$professionDistributionQuery = "SELECT profession, COUNT(*) as total_members FROM members GROUP BY profession ORDER BY total_members DESC";
$monthlyMembersQuery = "SELECT COUNT(*) as monthly_members FROM members WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$companyDistributionQuery = "SELECT company, COUNT(*) as total_members FROM members GROUP BY company ORDER BY total_members DESC";

$totalMembersCount = $db->query($totalMembersQuery)->fetchColumn();
$monthlyMembersCount = $db->query($monthlyMembersQuery)->fetchColumn();
?>
<div class="statistics-container" id="stats-cont">
    <h2 class="statistics-title">Statistics</h2>
    <ul class="statistics-list">
        <li class="statistics-item">
            <strong>Total number of members:</strong> <?php echo htmlspecialchars($totalMembersCount); ?>
        </li>
        <li class="statistics-item">
            <strong>New members in the last month:</strong> <?php echo htmlspecialchars($monthlyMembersCount); ?>
        </li>
        <li class="statistics-item">
            <strong>Profession Distribution:</strong>
            <table class="statistics-table">
                <thead>
                <tr>
                    <th>Profession</th>
                    <th>Total Members</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $db->query($professionDistributionQuery);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['profession']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_members']) . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </li>
        <li class="statistics-item">
            <strong>Company Distribution:</strong>
            <table class="statistics-table">
                <thead>
                <tr>
                    <th>Company</th>
                    <th>Total Members</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $db->query($companyDistributionQuery);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_members']) . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </li>
    </ul>
</div>
<?php
include_once "includes/footer.php";
?>
