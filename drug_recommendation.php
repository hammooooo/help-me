<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $systemicDrugs = $_POST['drug_type'];
    $disease = $_POST['chronic_diseas'];

    // Prepare and bind
    $stmt = $con->prepare("SELECT SUITABLE, conflict FROM suitable_conflict JOIN disease_and_drugs ON DAD_ID = drug_and_diseas_id WHERE chronic_diseas =? AND drug_type =?");
    $stmt->bind_param("ss", $disease, $systemicDrugs);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Display conflicts and suitable drugs
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $conflict = $row["conflict"];
            $suitableDrug = $row["SUITABLE"];
            if (!empty($suitableDrug)) {
                echo "<strong>Recommendations:</strong><br>". $suitableDrug. "<br>";
            }
            if (!empty($conflict)) {
                echo "<br><strong>Conflicts:</strong><br>". $conflict. "<br>";
            }
        }
    } else {
        echo "No records found for the given chronic disease and drug type.";
    }

    $stmt->close();
    $con->close();
}
?>