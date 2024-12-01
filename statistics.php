<?php
global $totalMembersQuery;
include_once "includes/header.php";

$database = new Database();
$db = $database->getConnection();

$totalMembersQuery = "SELECT COUNT(*) FROM members WHERE NOT (first_name = 'admin' AND last_name = 'admin')";
$professionDistributionQuery = "SELECT profession, COUNT(*) as total_members FROM members WHERE NOT (first_name = 'admin' AND last_name = 'admin') GROUP BY profession ORDER BY total_members DESC";
$monthlyMembersQuery = "SELECT COUNT(*) as monthly_members FROM members WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND NOT (first_name = 'admin' AND last_name = 'admin')";
$companyDistributionQuery = "SELECT company, COUNT(*) as total_members FROM members WHERE NOT (first_name = 'admin' AND last_name = 'admin') GROUP BY company ORDER BY total_members DESC";

$totalMembersCount = $db->query($totalMembersQuery)->fetchColumn();
$monthlyMembersCount = $db->query($monthlyMembersQuery)->fetchColumn();
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0 text-center">Statistics</h2>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Total number of members:</strong>
                    <span class="badge bg-success ms-2"><?php echo htmlspecialchars($totalMembersCount); ?></span>
                </li>
                <li class="list-group-item">
                    <strong>New members in the last month:</strong>
                    <span class="badge bg-info ms-2"><?php echo htmlspecialchars($monthlyMembersCount); ?></span>
                </li>
                <li class="list-group-item">
                    <strong>Profession Distribution:</strong>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
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
                    </div>
                </li>
                <li class="list-group-item">
                    <strong>Company Distribution:</strong>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                            <tr>
                                <th>Company</th>
                                <th>Total Members</th>
                            </tr>
                            </thead class="table-dark">
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
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
include_once "includes/footer.php";
?>
