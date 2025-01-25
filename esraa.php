<!-- HTML form -->
<div class="main-sidebar " id="drug">
    <div class="container-Drugs">
        <h3>Drug Recommendation System</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="form-group ">
                <label for="drugTypeInput">Drug Type:</label>
                <input type="text" name="drug_type" class="form-control" placeholder="Enter drug type (e.g., analgesic)" required>
            </div>
            <div class="form-group">
                <label for="diseaseInput">Disease:</label>
                <input type="text" name="chronic_diseas" class="form-control" placeholder="Enter disease (e.g., headache)" required>
            </div>
            <button type="submit" class="btn btn-primary">Get Recommendation</button>
        </form>

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

            $result_text = "";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $conflict = $row["conflict"];
                    $suitableDrug = $row["SUITABLE"];
                    if (!empty($suitableDrug)) {
                        $result_text.= "<strong>Recommendations:</strong><br>". $suitableDrug. "<br>";
                    }
                    if (!empty($conflict)) {
                        $result_text.= "<br><strong>Conflicts:</strong><br>". $conflict. "<br>";
                    }
                }
            } else {
                $result_text = "No records found for the given chronic disease and drug type.";
            }

            $stmt->close();
            $con->close();
        }

        if (isset($result_text)):?>
            <h3>Result: <?= $result_text?></h3>
        <?php endif;?>
    </div>
</div>