<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$app = $conn->query("SELECT * FROM applications WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $review = $_POST['review'];
    $status = $_POST['status'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image_dir = "uploads";
        move_uploaded_file($_FILES['image']['tmp_name'], "$image_dir/$image");
    } else {
        $image = $app['image'];
        $image_dir = $app['image_dir'];
    }

    $sql = "UPDATE applications SET 
            category_id='$category_id', 
            title='$title', 
            author='$author', 
            review='$review', 
            image='$image', 
            image_dir='$image_dir', 
            status='$status', 
            modified=NOW() 
            WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

$categories = $conn->query("SELECT * FROM categories WHERE status='active'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2>Edit Application</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php if ($cat['id'] == $app['category_id']) echo "selected"; ?>>
                        <?php echo $cat['title']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" value="<?php echo $app['title']; ?>"></div>
        <div class="mb-3"><label>Author</label><input type="text" name="author" class="form-control" value="<?php echo $app['author']; ?>"></div>
        <div class="mb-3"><label>Review</label><textarea name="review" class="form-control"><?php echo $app['review']; ?></textarea></div>
        <div class="mb-3"><label>Image</label><input type="file" name="image" class="form-control"></div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-control">
                <option value="active" <?php if ($app['status'] == 'active') echo "selected"; ?>>Active</option>
                <option value="inactive" <?php if ($app['status'] == 'inactive') echo "selected"; ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
