<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Drug Recommendation System</title>
<style>
    .form-group { margin-bottom: 15px; }
    .btn { display: block; width: 100%; }
</style>
</head>
<body>
<h1>Drug Recommendation System</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div class="form-group">
<label for="drugTypeInput">Drug Type:</label>
<input type="text" name="drug_type" class="form-control" placeholder="Enter drug type (e.g., analgesic)" required>
</div>
<div class="form-group">
<label for="diseaseInput">Disease:</label>
<input type="text" name="chronic_diseas" class="form-control" placeholder="Enter disease (e.g., headache)" required>
</div>
<button type="submit" class="btn btn-primary">Get Recommendation</button>
</form>
<p id="conflict">
<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $disease = strtolower(trim($_POST['chronic_diseas']));
    $drugType = strtolower(trim($_POST['drug_type']));
    $conflicts = ""; // Initialize an empty string to store conflicts
    $conflictFound = false; // Initialize a variable to track if any conflict is found

    // Prepare and bind
    $stmt = $con->prepare("SELECT conflict FROM suitable_conflict JOIN disease_and_drugs ON DAD_ID = drug_and_diseas_id WHERE chronic_diseas = ? AND drug_type = ?");
    $stmt->bind_param("ss", $disease, $drugType);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $conflict = $row["conflict"];
            $conflicts .= $conflict . "<br>";
            $conflictFound = true; // Set the flag to true if any conflict is found
        }
    }

    if ($conflictFound) {
        echo $conflicts;
    } else {
        echo "No conflicts found between the drug type and the chronic disease.";
    }
    
    $stmt->close();
    $con->close();
}
?>
</p>
</body>
</html>