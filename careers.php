<?php
session_start();
require_once 'assets/lib/config.php';
require_once 'assets/lib/database.php';
$db = new database;

// Connect to Database
$db->connect($config);

// Pagination Variables
$itemsPerPage = 5; // Number of jobs per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Search Filters
$searchTitle = isset($_GET['search_title']) ? trim($_GET['search_title']) : '';
$searchLocation = isset($_GET['search_location']) ? trim($_GET['search_location']) : '';

// Build SQL Query with Search and Pagination
$sql = "SELECT * FROM careers WHERE 1=1";

// Apply Search Filters
if (!empty($searchTitle)) {
    $sql .= " AND job_title LIKE :job_title";
}
if (!empty($searchLocation)) {
    $sql .= " AND job_location LIKE :job_location";
}

// Add Pagination
$sql .= " LIMIT :offset, :itemsPerPage";

$sth = $db->dbh->prepare($sql);

// Bind Values
if (!empty($searchTitle)) {
    $sth->bindValue(':job_title', '%' . $searchTitle . '%', PDO::PARAM_STR);
}
if (!empty($searchLocation)) {
    $sth->bindValue(':job_location', '%' . $searchLocation . '%', PDO::PARAM_STR);
}
$sth->bindValue(':offset', $offset, PDO::PARAM_INT);
$sth->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);

$sth->execute();
$jobs = $sth->fetchAll();

// Count Total Jobs for Pagination
$countSql = "SELECT COUNT(*) FROM careers WHERE 1=1";
if (!empty($searchTitle)) {
    $countSql .= " AND job_title LIKE :job_title";
}
if (!empty($searchLocation)) {
    $countSql .= " AND job_location LIKE :job_location";
}

$countSt = $db->dbh->prepare($countSql);
if (!empty($searchTitle)) {
    $countSt->bindValue(':job_title', '%' . $searchTitle . '%', PDO::PARAM_STR);
}
if (!empty($searchLocation)) {
    $countSt->bindValue(':job_location', '%' . $searchLocation . '%', PDO::PARAM_STR);
}

$countSt->execute();
$totalJobs = $countSt->fetchColumn();
$totalPages = ceil($totalJobs / $itemsPerPage);

$title = "Careers - Nexus Build and Consultants";
require("header.php");
?>




<!-- Navigation File -->
<?php include_once 'navigation.php';?>
	
	<!-- ============================================================== -->
	<!-- Start NEXUS Breatcome Area -->
	<!-- ============================================================== -->
	<div class="breatcome_area d-flex align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breatcome_title">
						<div class="breatcome_title_inner pb-2">
							<h2>NEXUS Careers</h2>
						</div>
						<div class="breatcome_content">
							<ul>
								<li><a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <a href="#"> Pages</a> <i class="fa fa-angle-right"></i> <span>Careers Page</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End NEXUS Breatcome Area -->
	<!-- ============================================================== -->

    <!--==================================================-->
	<!----- End NEXUS Breatcome Area ----->
	<!--==================================================-->
    <div class="blog_area pt-85 pb-65" id="blog-area">
    <div class="section_title text_center mb-55">
        <div class="section_sub_title uppercase mb-3">
            <h6>Join our team.</h6>
        </div>
        <div class="section_main_title">
            <h1>CURRENT OPENINGS</h1>
        </div>
        <div class="em_bar">
            <div class="em_bar_bg"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Search and Clear Buttons -->
                    <div class="row mb-5 align-items-center justify-content-center">
                        <form id="search-form" class="d-flex flex-wrap gap-3 col-12 col-lg-10" method="GET" action="#blog-area">
                            <!-- Job Title Input -->
                            <div class="col-md-5">
                                <input 
                                    type="text" 
                                    class="form-control border-primary px-4" 
                                    name="search_title" 
                                    placeholder="Search by job title or keywords..." 
                                    value="<?= htmlspecialchars($searchTitle) ?>">
                            </div>

                            <!-- Location Input -->
                            <div class="col-md-5">
                                <input 
                                    type="text" 
                                    class="form-control border-primary px-4" 
                                    name="search_location" 
                                    placeholder="Search by location..." 
                                    value="<?= htmlspecialchars($searchLocation) ?>">
                            </div>

                            <!-- Buttons -->
                            <div class="col-md-2 d-flex justify-content-center justify-content-md-end gap-2 align-items-center">
                                <!-- Search Button -->
                                <button 
                                    type="submit" 
                                    class="btn btn-primary d-flex align-items-center justify-content-center shadow-sm"
                                    style="
                                        background-color: #007bff; 
                                        color: #fff; 
                                        width: 45px; 
                                        height: 45px; 
                                        border-radius: 8px;">
                                    <i class="fa fa-search" style="font-size: 18px;"></i>
                                </button>
                                
                                <!-- Refresh Button -->
                                <button 
                                    type="button" 
                                    id="refresh-button" 
                                    class="btn btn-secondary d-flex align-items-center justify-content-center shadow-sm"
                                    style="
                                        background-color: #6c757d; 
                                        color: #fff; 
                                        width: 45px; 
                                        height: 45px; 
                                        border-radius: 8px;">
                                    <i class="fa fa-refresh" style="font-size: 18px;"></i>
                                </button>
                            </div>
                        </form>
                    </div>


                <!-- Job Listings -->
                <div id="job-listings">
                    <?php if (empty($jobs)): ?>
                        <p class="text-center text-muted">No jobs found matching your criteria.</p>
                    <?php else: ?>
                        <?php foreach ($jobs as $job): ?>
                            <div class="job-card shadow-sm border-0 p-4 rounded-lg mb-4 bg-light">
                                <div class="row align-items-center">
                                    <!-- Basic Job Information -->
                                    <div class="col-md-8">
                                        <h4 class="text-primary font-weight-bold mb-3"><?= $job['job_title'] ?></h4>
                                            <!-- Location -->
                                                <span class="d-flex align-items-center text-muted">
                                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                <strong>Location:&nbsp;</strong> <?= $job['job_location'] ?>
                                            </span>
                                        <!-- Job Details -->
                                        <div class="d-flex align-items-center flex-wrap gap-6">
                                            <!-- Job Type -->
                                            <span class="d-flex align-items-center text-muted">
                                                <i class="fa fa-briefcase text-primary me-2"> &nbsp; </i>
                                                <strong>Job Type:&nbsp;</strong> <?= $job['job_type'] ?>
                                            </span>
                                            &nbsp;&nbsp;&nbsp;
                                            <!-- Workplace Type -->
                                            <span class="d-flex align-items-center text-muted">
                                                <i class="fa fa-building text-primary me-2"> &nbsp; </i>
                                                <strong>Workplace Type:&nbsp;</strong> <?= $job['workplace_type'] ?>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Apply Button -->
                                    <div class="col-md-4 text-md-end text-center mt-3 mt-md-0">
                                        <a href="https://forms.gle/zLshkEnVegYHXVky8" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill font-weight-bold shadow-sm">
                                            Apply Now
                                        </a>
                                    </div>
                                </div>

                                    <!-- Detailed Job Information (Initially Hidden) -->
                                    <div class="job-details mt-3" style="display: none;">
                                        <p class="text-muted mb-1"><?= $job['job_description'] ?></p>

                                        <?php if (!empty($job['responsibilities'])): ?>
                                            <p class="text-muted mb-1"></p>
                                            <?= $job['responsibilities'] ?>
                                        <?php endif; ?>

                                        <?php if (!empty($job['qualifications'])): ?>
                                            <p class="text-muted mb-1"></p>
                                            <?= $job['qualifications'] ?>
                                        <?php endif; ?>

                                        <?php if (!empty($job['skills_and_abilities'])): ?>
                                            <p class="text-muted mb-1"></p>
                                            <?= $job['skills_and_abilities'] ?>
                                        <?php endif; ?>

                                        <?php if (!empty($job['additional_requirements'])): ?>
                                            <p class="text-muted mb-1"></p>
                                            <?= $job['additional_requirements'] ?>
                                        <?php endif; ?>

                                        <?php if (!empty($job['compensation'])): ?>
                                            <p class="text-muted mb-1"></p>
                                            <?= $job['compensation'] ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Read More / Less Button -->
                                    <div class="text-end mt-3">
                                        <button class="btn btn-link text-primary read-more-toggle font-weight-bold">
                                            Read More
                                        </button>
                                    </div>

                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <style>
                /* Job Card Hover Effect */
                    .job-card {
                        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                    }

                    .job-card:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                    }

                    /* Read More Button Style */
                    .job-card .read-more-toggle {
                        font-size: 0.9rem;
                        color: #007bff;
                        text-decoration: none;
                        cursor: pointer;
                        border: none;
                        background: none;
                        padding: 0;
                        margin: 0;
                        display: inline-block;
                    }

                    .job-card .read-more-toggle:hover {
                        text-decoration: underline;
                    }

                    /* Button Alignment */
                    .text-start {
                        text-align: start; /* Aligns the button to the left side of the container */
                    }

                    /* Responsive Design */
                    @media (max-width: 768px) {
                        .text-start {
                            text-align: start; /* Keep left alignment for smaller screens */
                        }
                    }
                </style>

                <!-- Pagination -->
                <nav class="d-flex justify-content-center mt-4">
                    <ul class="pagination">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link rounded-pill px-3" href="?page=<?= $currentPage - 1 ?>&search_title=<?= htmlspecialchars($searchTitle) ?>&search_location=<?= htmlspecialchars($searchLocation) ?>#blog-area">
                                    Previous
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                <a class="page-link rounded-pill px-3" href="?page=<?= $i ?>&search_title=<?= htmlspecialchars($searchTitle) ?>&search_location=<?= htmlspecialchars($searchLocation) ?>#blog-area">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link rounded-pill px-3" href="?page=<?= $currentPage + 1 ?>&search_title=<?= htmlspecialchars($searchTitle) ?>&search_location=<?= htmlspecialchars($searchLocation) ?>#blog-area">
                                    Next
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>


	<!--==================================================-->
	<!----- End NEXUS Careers Page Area ----->
	<!--==================================================-->

	
	<!--==================================================-->
	<!----- End NEXUS Map Area ----->
	<!--==================================================-->
	<div class="google_map_area">
		<div class="row-fluid">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="google_map_area">
					<!-- <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.167518058788!2d-106.95752532339804!3d44.797774577655815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5335fabc2a655555%3A0x3542e0a22355480!2s30%20N%20Gould%20St%20Ste.%20N%2C%20Sheridan%2C%20WY%2082801%2C%20USA!5e0!3m2!1sen!2sph!4v1733381881340!5m2!1sen!2sph"></iframe>		 -->
				</div>
			</div>				
		</div>
	</div>
	<!--==================================================-->
	<!----- End NEXUS Map Area ----->
	<!--==================================================-->

    <!-- Script for Search Bar and Refresher -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const refreshButton = document.getElementById("refresh-button");
            const searchForm = document.getElementById("search-form");

            // Refresh button functionality
            refreshButton.addEventListener("click", function () {
                // Clear the form inputs
                const inputs = searchForm.querySelectorAll("input");
                inputs.forEach(input => input.value = "");

                // Submit the form with no filters
                const url = window.location.href.split("?")[0] + "#blog-area"; // Remove query parameters
                window.location.href = url; // Redirect to reset filters
            });
        });
        </script>

            <!-- Script for Read More and Less -->
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                const toggles = document.querySelectorAll(".read-more-toggle");

                toggles.forEach(toggle => {
                    toggle.addEventListener("click", function (e) {
                        e.preventDefault();
                        const jobDetails = this.closest(".job-card").querySelector(".job-details");

                        if (jobDetails.style.display === "none" || jobDetails.style.display === "") {
                            jobDetails.style.display = "block";
                            this.textContent = "Read Less";
                        } else {
                            jobDetails.style.display = "none";
                            this.textContent = "Read More";
                        }
                    });
                });
            });
            </script>



	  <!-- Footer File -->
	  <?php include_once 'footer.php';?>

