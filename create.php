<?php include 'db.php'; ?>

<?php
// Auto insert default categories if not exist
$check = $conn->query("SELECT COUNT(*) as total FROM categories")->fetch_assoc();
if ($check['total'] == 0) {
    $now = date("Y-m-d H:i:s");
    $default = ['Strategy', 'Racing', 'Action', 'Simulation', 'Board'];
    foreach ($default as $cat) {
        $conn->query("INSERT INTO categories (title, status, created, modified) VALUES ('$cat', 'active', '$now', '$now')");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $author = $_POST['author'];
    $status = $_POST['status'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $image_dir = "uploads";

    if (!file_exists($image_dir)) {
        mkdir($image_dir);
    }

    move_uploaded_file($_FILES['image']['tmp_name'], "$image_dir/$image");

    $now = date("Y-m-d H:i:s");

    $sql = "INSERT INTO applications 
            (category_id, posted_date, author, title, review, image, image_dir, status, created, modified) 
            VALUES 
            ('$category_id', '$now', '$author', '$title', '$review', '$image', '$image_dir', '$status', '$now', '$now')";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star-rating .fa-star {
            font-size: 24px;
            color: gray;
            cursor: pointer;
        }
        .star-rating .checked {
            color: gold;
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <h2>Add Application Review</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>App Name</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Review</label>
            <textarea name="review" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Rating</label><br>
            <div class="star-rating">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="fa fa-star" data-value="<?= $i ?>"></span>
                <?php endfor; ?>
            </div>
            <input type="hidden" name="rating" id="ratingInput" required>
        </div>

        <div class="mb-3">
            <label>Upload Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<!-- Font Awesome for stars -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    const stars = document.querySelectorAll('.fa-star');
    const ratingInput = document.getElementById('ratingInput');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            let value = this.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach(s => s.classList.remove('checked'));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('checked');
            }
        });
    });
</script>
</body>
</html>
