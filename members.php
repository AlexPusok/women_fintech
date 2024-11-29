<?php
include_once "includes/header.php";
$database = new Database();
$db = $database->getConnection();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$members_per_page = 9;

$offset = ($page - 1) * $members_per_page;

$selectedProfession = isset($_POST['profession']) ? $_POST['profession'] : '';
$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';
?>
    <h2>Members Directory</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="searchQuery">Cauta membri:</label>
            <input type="text" name="searchQuery" id="searchQuery" class="form-control" value="<?php echo htmlspecialchars($searchQuery); ?>">
        </div>
        <button type="submit" class="btn btn-success">Cauta</button>
    </form>
    <br/>
    <form id="sortForm" method="post">
        <input type="hidden" id="sortInput" name="sortMode" value="<?php echo isset($_POST['sortMode']) ? $_POST['sortMode'] : 'sortnume'; ?>">
        <input type="hidden" id="hiddenProfessionInput" name="profession" value="<?php echo htmlspecialchars($selectedProfession); ?>">
        <input type="hidden" id="hiddenSearchQuery" name="searchQuery" value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit" id="sortbutton" onclick="schimbaModSortare()"><?php echo isset($_POST['sortMode']) && $_POST['sortMode'] === 'sortcreare' ? 'Sort dupa creare' : 'Sort dupa nume'; ?></button>
    </form>
    <br/>
    <button class="btn btn-primary" onclick="toggleFilterSection()">Filtreaza dupa profesie</button>
    <br/>
    <div id="filterSection" class="mt-3">
        <form method="post" action="">
            <div class="form-group">
                <label for="profession">Alege profesie:</label>
                <select name="profession" id="profession" class="form-control">
                    <option value="">Toate profesile</option>
                    <?php
                    $query = "SELECT DISTINCT profession FROM members";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = $selectedProfession == $row['profession'] ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row['profession']) . '"' . $selected . '>' . htmlspecialchars($row['profession']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Filter</button>
        </form>
    </div>
    <br/>

<?php
$query = "SELECT * FROM members WHERE NOT (first_name = 'admin' AND last_name = 'admin')";
$params = [];
if (!empty($selectedProfession)) {
    $query .= " AND profession = :profession";
    $params[":profession"] = $selectedProfession;
}
if (!empty($searchQuery)) {

    $query .= " AND (first_name LIKE :search OR last_name LIKE :search OR profession LIKE :search)";
    $params[":search"] = "%" . $searchQuery . "%";
}
if (isset($_POST['sortMode']) && $_POST['sortMode'] === 'sortcreare') {
    $query .= " ORDER BY last_name, first_name";
}else if(isset($_POST['sortMode']) && $_POST['sortMode'] === 'sortnume') {
    $query .= " ORDER BY created_at";
} else {
    $query .= " ORDER BY created_at DESC";
}
$query .= " LIMIT :limit OFFSET :offset";
$stmt = $db->prepare($query);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':limit', $members_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$total_querry = 'SELECT COUNT(*) as total FROM members';
if(!empty($selectedProfession) || !empty($searchQuery)) {
    $total_querry .= " WHERE";
    $conditions = [];
    if(!empty($selectedProfession)) {
        $conditions[] = "profession = :profession";
    }
    if(!empty($searchQuery)) {
        $conditions[] = "(first_name LIKE :search OR last_name LIKE :search OR profession LIKE :search) ";
    }
    $total_querry .=" ". implode(" AND ", $conditions);
}
$total_stmt = $db->prepare($total_querry);
if(!empty($selectedProfession)) {
    $total_stmt->bindValue(":profession", $selectedProfession);
}
if(!empty($searchQuery)) {
    $total_stmt->bindValue(":search", "%".$searchQuery."%");
}
$total_stmt->execute();
$total_rows = $total_stmt->fetch(PDO::FETCH_ASSOC);
$total_members = $total_rows['total'];

$total_pages = ceil($total_members / $members_per_page);
?>
    <div class="row">
        <?php if ($stmt->rowCount() > 0): ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-md-4">
                    <div class="card member-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h5>
                            <p class="card-text">
                                <strong>Profession:</strong> <?php echo htmlspecialchars($row['profession']); ?><br>
                                <strong>Company:</strong> <?php echo htmlspecialchars($row['company']); ?>
                            </p>
                            <a href="edit_member.php?id=<?php echo $row['id']; ?>" class="btn btnprimary">Edit</a>
                            <a href="delete_member.php?id=<?php echo $row['id']; ?>" class="btn btndanger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">No data found matching your criteria.</p>
            </div>
        <?php endif; ?>
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