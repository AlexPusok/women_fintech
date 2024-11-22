<?php
include_once "config/database.php";
include_once "includes/header.php";
$database = new Database();
$db = $database->getConnection();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$members_per_page = 9;

$offset = ($page - 1) * $members_per_page;


$query = "SELECT * FROM members ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
$stmt = $db->prepare($query);
$stmt->bindValue(':limit', $members_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$total_querry = 'SELECT COUNT(*) as total FROM members';
$total_stmt = $db->prepare($total_querry);
$total_stmt->execute();
$total_rows = $total_stmt->fetch(PDO::FETCH_ASSOC);
$total_members = $total_rows['total'];

$total_pages = ceil($total_members / $members_per_page);
?>
    <h2>Members Directory</h2>
    <div class="row">
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="col-md-4">
                <div class="card member-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h5>
                        <p class="card-text">
                            <strong>Profession:</strong> <?php echo htmlspecialchars($row['profession']); ?><br>
                            <strong>Company:</strong> <?php echo htmlspecialchars($row['company']);
                            ?>
                        </p>
                        <a href="edit_member.php?id=<?php echo $row['id']; ?>" class="btn btnprimary">Edit</a>
                        <a href="delete_member.php?id=<?php echo $row['id']; ?>" class="btn btndanger" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<!-- Paginare -->
    <nav aria-label="Page navigation" class="pagination-container">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php
include_once "includes/footer.php";
?>