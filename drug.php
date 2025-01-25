<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $systemicDrugs = $_POST['drug_type'];
    $disease = $_POST['chronic_diseas'];

    // Prepare and bind
    $stmt = $con->prepare("SELECT SUITABLE, conflict FROM suitable_conflict JOIN disease_and_drugs ON DAD_ID = drug_and_diseas_id WHERE chronic_diseas = ? AND drug_type = ?");
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
                echo "<strong>Recommendations:</strong><br>" . $suitableDrug . "<br>";
            }
            if (!empty($conflict)) {
                echo "<br><strong>Conflicts:</strong><br>" . $conflict . "<br>";
            }
        }
    } else {
        echo "No records found for the given chronic disease and drug type.";
    }

    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Me</title>
    <link rel="stylesheet" href="css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Roboto:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="index.html" class="logo"> <img src="images/Blue and White Minimal Dental Care Logo (1).png"></a>
            <div class="search-box">
                <img src="images/search.png" alt="">
                <input type="text" placeholder="search here">
            </div>
        </div>
        <div class="navbar-center">
            <ul>
                <li><a href="#" class="active-link"> <img src="images/home.png" alt=""> <span>Home</span></a></i>
                <li><a href="#"> <img src="images/network.png" alt=""> <span>Network</span></a></i>
                <li><a href="drug.html"> <img src="images/jobs.png" alt=""> <span>Drug Recommendation</span></a></i>
                <li><a href="#"> <img src="images/message.png" alt=""> <span>message</span></a></i>
                <li><a href="#"> <img src="images/notification.png" alt=""> <span>Notification</span></a></i>
            </ul>
        </div>
        <div class="navbar-right">
            <div class="online">
                <img src="images/user-1.png" alt="" class="nav-profile-img" onclick="toggleMenu()">
            </div>
        </div>

        <!-- ------------------------profile-drop-down-menu------------------- -->
        <div class="profile-menu-warp" id="profileMenu">
            <div class="profile-menu">
                <div class="user-info">
                    <img src="images/user-1.png" alt="">
                    <div>
                        <h3>Abdelrahman Muhamed</h3>
                        <a href="profile.html">See your profile</a>
                    </div>
                </div>
                <hr>
                <a href="#" class="profile-menu-link">
                    <img src="images/feedback.png" alt="">
                    <p>Give Feedback</p>
                    <span>></span>
                </a>
                <a href="#" class="profile-menu-link">
                    <img src="images/setting.png" alt="">
                    <p>Setting & Privacy</p>
                    <span>></span>
                </a>
                <a href="#" class="profile-menu-link">
                    <img src="images/help.png" alt="">
                    <p>Help & Support</p>
                    <span>></span>
                </a>
                <a href="#" class="profile-menu-link">
                    <img src="images/display.png" alt="">
                    <p>Display & Accessibity</p>
                    <span>></span>
                </a>
                <a href="sign-in.html" class="profile-menu-link">
                    <img src="images/logout.png" alt="">
                    <p>Logout</p>
                    <span>></span>
                </a>


            </div>
        </div>

    </nav>
    <div class="container">
        <!-- -------------left-sidebar---------- -->
        <div class="left-sidebar">
            <div class="sidebar-profile-box">
                <img src="images/cover-pic.png" alt="" width="100%">
                <div class="sidebar-profile-info">
                    <img src="images/user-1.png" alt="">
                    <h1>Abdelrahman Muhamed</h1>
                    <h3>Dentist at shiny White Dental Center</h3>
                    <ul>
                        <li class="li-profile">Your profile views <span>52</span></li>
                        <li class="li-profile">Your post views <span>2810</span></li>
                        <li class="li-profile">Your connections <span>111</span></li>
                    </ul>
                </div>

            </div>
            <div class="sidebar-activity">
                <h2>Library</h2>
                <h3>RECENT</h3>
                <a href="#"><img src="images/recent.png" alt="">Mahmoud Al Ankily</a>
                <a href="#"><img src="images/recent.png" alt="">Physiology by Doctor Nagi</a>
                <a href="#"><img src="images/recent.png" alt="">Dr Ayman Khanfour Anatomy Teaching</a>
                <a href="#"><img src="images/recent.png" alt="">Ezzat Shouman</a>
                <a href="#"><img src="images/recent.png" alt="">Clinical Pharmacology Lectures</a>

                <h3>GROUPS</h3>
                <a href="#"><img src="images/group.png" alt="">Badly Decayed Dentists🦷</a>
                <a href="#"><img src="images/group.png" alt="">we pretend we AREN'T dental students🦷</a>
                <a href="#"><img src="images/group.png" alt="">Badly Decayed Dentists</a>

                <h3>HASHTAG</h3>
                <a href="#"><img src="images/hashtag.png" alt="">Oral and Maxillofacial Pathology</a>
                <a href="#"><img src="images/hashtag.png" alt="">Dental Public Health</a>
                <a href="#"><img src="images/hashtag.png" alt="">Cosmetic Dentistry</a>
                <a href="#"><img src="images/hashtag.png" alt="">Prosthodontics</a>
                <div class="discover-more-link">
                    <a href="#">Discover more</a>
                </div>

            </div>
        </div>
        <!-- -------------main-sidebar---------- -->
        <!-- ----------DRUG RECOMENDATION----- -->
       
        <div class="main-sidebar " id="drug">
            <div class="container-Drugs">
                <div class="wrapper">
                    <div class="select-btn">
                        <span>Select Systemic Drugs </span>
                        <i class="uil uil-angle-down"></i>
                    </div>
                    <div class="content">
                        <div class="search">
                            <i class="uil uil-search"></i>
                            <input spellcheck="false" type="text" placeholder="Search" />
                        </div>
                        <ul class="options"></ul>
                    </div>
                </div>
                <!-- SELECT-disease drugs  -->
                <div class="wrapper wrapperD">
                    <div class="select-btn select-btn-D">
                        <span>Select Disease</span>
                        <i class="uil uil-angle-down"></i>
                    </div>
                    <div class="content">
                        <div class="search">
                            <i class="uil uil-search"></i>
                            <input spellcheck="false" type="text" placeholder="Search" />
                        </div>
                        <ul class="options options-D"></ul>
                    </div>
                </div>
                <button class="button-63 wrapper" role="button">Submit</button>
            </div>
        </div>

        <!-- -------------right-sidebar---------- -->
        <div class="right-sidebar">
            <div class="sidebar-news">
                <img src="images/more.png" alt="" class="info-icon">
                <h3>Trending News</h3>
                <a href="#">Digital Smile Design (DSD): Precision in Planning </a>
                <span>
                    5hr ago &middot; 10,987 readers
                </span>

                <a href="#">Teledentistry: Convenient Consultations </a>
                <span>
                    12h ago &middot; 30,000 readers
                </span>

                <a href="#">Non-Invasive Smile Enhancements: Minimal Downtime, Maximum Impact </a>
                <span>
                    1d ago &middot; 7,889 readers
                </span>

                <a href="#">Biocompatible and Natural-Looking Materials: Aesthetic Excellence </a>
                <span>
                    2d ago &middot; 10,987 readers
                </span>

                <a href="#">Orthodontic Innovations: Discreet and Efficient Alignment </a>
                <span>
                    3d ago &middot; 12,787 readers
                </span>
                <a href="#" class="read-more-link">Read More</a>
            </div>
            <div class="sidebar-ad">
                <small>Ads..</small>
                <p>Your best Advertise</p>
                <div>
                    <img src="images/ad3.jpeg" alt="">
                    <img src="images/ad2.jpeg" alt="">
                    <img src="images/ad1.jpeg" alt="">
                </div>
                <b>brands you can trust</b>
                <a href="#" class="ad-link">Learn More</a>
            </div>
            <div class="sidebar-useful-links">
                <a href="#"> About</a>
                <a href="#"> Accessibity</a>
                <a href="#"> Help Center</a>
                <a href="#"> Privacy Policy</a>
                <a href="#"> Advertising</a>
                <a href="#">More</a>

                <div class="copyright-msg">
                    <img src="images/Blue and White Minimal Dental Care Logo (1).png" alt="">
                    <p>Medhat's Team &#169; 2024. All right reserved </p>
                </div>
            </div>
        </div>
    </div>


    <script src="script.js"></script>

    <script src="drug.js"></script>
</body>

</html>











 <!-- <!DOCTYPE html>
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
<form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div class="form-group">
<label for="drugTypeInput">Drug Type:</label>
<input type="text" name="drug_type" class="form-control" placeholder="Enter drug type (e.g., analgesic)" required>
</div>
<div class="form-group">
<label for="diseaseInput">Disease:</label>
<input type="text" name="chronic_diseas" class="form-control" placeholder="Enter disease (e.g., headache)" required>
</div>
<button type="submit" class="btn btn-primary">Get Recommendation</button>
</form>  -->