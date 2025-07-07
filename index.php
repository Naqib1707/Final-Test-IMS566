<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mobile Application Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">Mobile Application Reviews</h2>
    <a href="create.php" class="btn btn-success mb-3">+ Add New Application</a>

    <?php
    $sql = "SELECT a.*, c.title AS category_title 
            FROM applications a 
            JOIN categories c ON a.category_id = c.id 
            ORDER BY a.created DESC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()):
        $app_id = $row['id'];
        $statusBadge = $row['status'] == 'active' 
            ? '<span class="badge bg-success">Active</span>' 
            : '<span class="badge bg-secondary">Inactive</span>';
    ?>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['title']; ?> <?php echo $statusBadge; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">
                By <?php echo $row['author']; ?> in <?php echo $row['category_title']; ?>
            </h6>

            <?php if (!empty($row['image'])): ?>
                <img src="<?php echo $row['image_dir'] . '/' . $row['image']; ?>" 
                     class="img-fluid my-2" style="max-width: 200px;">
            <?php endif; ?>

            <p class="card-text"><?php echo $row['review']; ?></p>
            <p class="text-muted">Posted on: <?php echo date("F j, Y, g:i a", strtotime($row['posted_date'])); ?></p>

            <!-- ⭐ Average Rating -->
            <?php
            $avg_rating = $conn->query("SELECT AVG(rating) as avg FROM comments WHERE application_id=$app_id AND status='approved'")->fetch_assoc();
            echo "<p><strong>Average Rating:</strong> " . ($avg_rating['avg'] ? round($avg_rating['avg'], 1) . "/5" : "No ratings yet") . "</p>";
            ?>

            <!-- 💬 Comments -->
            <h6>Comments:</h6>
            <?php
            $comments = $conn->query("SELECT * FROM comments WHERE application_id=$app_id AND status='approved' ORDER BY created DESC");
            if ($comments->num_rows > 0):
                while ($cmt = $comments->fetch_assoc()):
            ?>

            
                <div class="border p-2 mb-2">
                    <strong><?php echo $cmt['name']; ?></strong> 
                    (Rating: <?php echo $cmt['rating']; ?>/5)<br>
                    <?php echo $cmt['comment']; ?>
                    <div class="text-muted" style="font-size: 0.85em;">Posted: <?php echo date("d M Y, h:i A", strtotime($cmt['created'])); ?></div>
                </div>
            <?php endwhile; else: ?>
               

            <?php endif; ?>

            <?php
        $comments = $conn->query("SELECT * FROM comments WHERE application_id='$app_id' ORDER BY modified DESC");
            while ($c = $comments->fetch_assoc()):
            ?>
                   <div class="border p-2 mb-2">
                       <strong><?php echo $c['name']; ?></strong> 
                     <span class="text-warning">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="fa fa-star<?php echo ($i <= $c['rating']) ? ' checked' : ''; ?>"></i>
            <?php endfor; ?>
               </span>
        <br>
           <?php echo $c['comment']; ?><br>
            <small class="text-muted">Updated: <?php echo $c['modified']; ?></small>
                  </div>
            <?php endwhile; ?>


            <!-- ✍️ Add Comment Form -->
            <h6 class="mt-3">Add Your Comment:</h6>
            <form method="POST" action="comment.php" class="mb-3">
                <input type="hidden" name="application_id" value="<?php echo $app_id; ?>">
                <div class="mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="mb-2">
                    <textarea name="comment" class="form-control" placeholder="Write your comment" required></textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-select" required>
                        <option value="">Select rating</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> / 5</option>
                        <?php endfor; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-sm">Submit Comment</button>
            </form>

            <!-- 🔧 Actions -->
            <a href="edit.php?id=<?php echo $app_id; ?>" class="btn btn-primary btn-sm">Edit</a>
            <a href="delete.php?id=<?php echo $app_id; ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('Are you sure you want to delete this app?')">Delete</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>
</body>
</html>

