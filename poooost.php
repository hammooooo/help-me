<?php
include("database.php");
// Function to add a new comment
function addComment($post_id, $author, $comment) {
    global $host, $db, $user, $pass;

    // Establish MySQLi connection
    $con = mysqli_connect($host, $user, $pass, $db);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Escape variables for security
    $post_id = mysqli_real_escape_string($con, $post_id);
    $author = mysqli_real_escape_string($con, $author);
    $comment = mysqli_real_escape_string($con, $comment);

    // Insert the new comment into the database
    $sql = "INSERT INTO comments (post_id, author, comment) VALUES ('$post_id', '$author', '$comment')";
    if (mysqli_query($con, $sql)) {
        echo "New comment added successfully";
        echo '<br>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close MySQLi connection
    mysqli_close($con);
}

// Example usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new_post'])) {
        $author = $_POST['author'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        addPost($author, $title, $content);
    }

    if (isset($_POST['new_comment'])) {
        $post_id = $_POST['post_id'];
        $author = $_POST['comment_author'];
        $comment = $_POST['comment_content'];
        addComment($post_id, $author, $comment);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dental Community</title>
</head>
<body>
    <h1>Welcome to the Dental Community</h1>
    
    <!-- Form to add new post -->
    <h2>Add New Post</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="new_post" value="1">
        <label for="author">Name:</label>
        <input type="text" id="author" name="author" required><br><br>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Add Post</button>
    </form>
    <hr>
    
    <!-- Display existing posts -->
    <!-- Note: Displaying posts would typically involve fetching from the database,
         which is not shown here as we are focusing on the functionality without connection -->
    
    <!-- Example display without actual data -->
    <div>
        <h2>Sample Post Title</h2>
        <p>Sample post content.</p>
        <p>Posted by: Sample Author on 2024-06-20</p>
        
        <!-- Form to add new comment -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="new_comment" value="1">
            <input type="hidden" name="post_id" value="1"> <!-- Replace with actual post ID -->
            <label for="comment_author">Name:</label>
            <input type="text" id="comment_author" name="comment_author" required><br><br>
            <label for="comment_content">Comment:</label><br>
            <textarea id="comment_content" name="comment_content" rows="2" cols="40" required></textarea><br><br>
            <button type="submit">Add Comment</button>
        </form>
        
        <!-- Display comments for this post -->
        <h3>Comments</h3>
        <div style="margin-left: 20px;">
            <p>Sample comment.</p>
            <p>Commented by: Sample Commenter on 2024-06-20</p>
        </div>
        
        <hr>
    </div>
</body>
</html>