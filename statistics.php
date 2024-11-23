<?php
global $totalMembersQuery;
include_once "config/database.php";
include_once "includes/header.php";
$database = new Database();
$db = $database->getConnection();
$totalMembersQuery = "SELECT count(*) FROM members";
$professionDistributionQuery = "SELECT profession, COUNT(*) as total_members FROM members GROUP BY profession ORDER BY total_members DESC";
$totalMembersCount = $db->query($totalMembersQuery)->fetchColumn();
$monthlyMembersQuery = "SELECT count(*) as monthly_members FROM members WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$monthlyMembersCount = $db->query($monthlyMembersQuery)->fetchColumn();

$companyDistributionQuery = "SELECT company, COUNT(*) as total_members FROM members GROUP BY company ORDER BY total_members DESC";
?>
<h2>Statistics</h2>
    <ul>
        <li>
            Total number of members: <?php echo htmlspecialchars($totalMembersCount); ?>
        </li>
        <li>
            Profession Distribution:
            <table border="1">
                <tr>
                    <th>Profession</th>
                    <th>Total Members</th>
                </tr>
                <?php
                $stmt = $db->query($professionDistributionQuery);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['profession']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_members']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </li>
        <li>
            Membri noi in ultima luna: <?php echo htmlspecialchars($monthlyMembersCount); ?>
        </li>
        <li>
            <table border="1">
                <tr>
                    <th>Company</th>
                    <th>Total Members</th>
                </tr>
                <?php
                $stmt = $db->query($companyDistributionQuery);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_members']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </li>
    </ul>
<?php
include_once "includes/footer.php";
?>
