<?php
include('../Database/db.php'); 
session_start();
if (!isset($_SESSION["userid"]) ||(trim ($_SESSION["userid"]) == '')) { 
    header('location: ../index.php');
    exit();
}else{
     $id = $_SESSION["userid"];
}
include('../UserModule/includes/fetch_acc_info.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>KEEP</title>
    <link rel="icon" href="../assets/images/icon.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- external css -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link href="../bootstrap-5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <!-- Fontawesome -->
    <link href="../assets/fontawesome-free-6.0.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-6.0.0-web/css/brands.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-6.0.0-web/css/solid.css" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" integrity="sha512-/n/dTQBO8lHzqqgAQvy0ukBQ0qLmGzxKhn8xKrz4cn7XJkZzy+fAtzjnOQd5w55h4k1kUC+8oIe6WmrGUYwODA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="js/main.js"></script>
</head>

<body>
<div id="loader" >    
<div class="loader d-flex justify-content-center align-items-center">

    <div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem; z-index: 20;">
      <span class="sr-only">Loading...</span>
    </div>
</div>
</div>
    
<div id="hero" class="container-fluid">
    <div class="row"><?php include 'header.php';?></div>
    <div id="hero-content" class="row flex-lg-row-reverse d-flex align-items-center justify-content-center" title="Upload Photo">
        <!-- INSERT HERO-CONTENT HERE (about_update_home.php) -->
    </div>
</div><!-- End Hero -->

<!-- Modal Hero Edit -->
<div class="modal fade" id="modalHeroEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalHeroEditLabel">Introduction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-4 " id="formHeroEdit" name="formHeroEdit" method="POST" enctype="multipart/form-data" action="#">
            <input type="hidden" name="action" id="action" value="fetch" />
            <div class="col-12">
                <label class="text-muted" for="update_description1">Introduction</label>
                <textarea class="form-control" id="update_description1" name="update_description1" rows="7" maxlength="300" required
                oninput="introLimit(this)" value=""></textarea>
                <div id="charCounter" class="form-text text-end"></div>
            </div>
            <div class="col-12">
                <label class="text-muted" for="update_image1">Upload Image</label>
                <input class="form-control" id="update_img_home" name="update_img_home" type="file">
            </div>
            <!-- buttons -->
            <div class="col-md-6 d-flex justify-content-center">
                <button type="button" class="modal-cancel-Btn btn btn-primary" data-bs-dismiss="modal">Cancel</button>   
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button type="submit" id="introUpdateBtn"  name="introUpdateBtn" class="modal-confirm-Btn btn btn-primary">Update</button>      
            </div> 
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="sticky-top">
<nav class="navbar navbar-expand-lg navbar-light shadow bg-body rounded h-navbar">
  <div class="container-fluid d-flex">
    <a class="navbar-brand" href="#" style="text-transform: uppercase;">
    <span class="fa-solid fa-user" style="color:#0084ff;"></span>
    <?php echo $row['usersFirstName']?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
        <ul class="navbar-nav">
            <li class="nav-item px-2">
                <a class="nav-link scrollto active" href="#">Home</a></li>
            <li class="nav-item px-2">
                <a class="nav-link scrollto" href="#about">About</a></li>
            <li class="nav-item px-2">
                <a class="nav-link scrollto" href="#resume">Resume</a></li>
            <li class="nav-item px-2">
                <a class="nav-link scrollto" href="#services">Services</a></li>
            <li class="nav-item px-2">
                <a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
            <li class="nav-item px-2">
                <a class="nav-link scrollto" href="#Contact">Contact</a></li>
            <li class="nav-item px-2 dropdown">
            <div class="dropdown">
              <a class="dropdown-toggle nav-link h-notif" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-gear"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <li class="dropdown-item">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switch-public_view">
                        <label class="form-check-label" for="switch-tips">
                            Public View
                        </label>
                    </div>
               </li>

                <li class="dropdown-item">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switch-tips">
                        <label class="form-check-label" for="switch-tips">
                            Show/Hide Tips
                        </label>
                    </div>    
                </li>
              </ul>
            </div>
            
            </li>
        </ul>
    </div>

  </div>
</nav>
</header><!-- End Header -->

<!-- ======= About Section ======= -->
<section id="about" class="about section-bg">
<div class="container-fluid">
    <!-- About -->
    <div class="section-title">
        <h2><a class="main-edit-ico" data-bs-toggle="modal" data-bs-target="#modalAboutEdit">
            <i class="fa fa-edit" title="Edit About"     ></i></a> About</h2>
        <p>Learn more about me</p>
    </div>

    <div id="about_content" class="row">
        <!-- INSERT ABOUT CONTENT HERE (about_update.php) -->
    </div>

</div>
</section><!-- End About Section -->

<!-- Modal About Edit -->
<div class="modal fade" id="modalAboutEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAboutEditLabel">About Me</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAboutEdit" name="formAboutEdit" method="POST" enctype="multipart/form-data" action="#">
        <div class="row g-3">
            <input type="hidden" name="action_about" id="action_about" value="fetch" />
            <div class="divider col-lg-5">
                <div class="row g-3">
                <div class="col-12">
                    <label class="text-muted" for="update_profession">Profession</label>
                    <input class="form-control" id="update_profession" name="update_profession" type="text" required
                            value="">
                </div>
                <div class="col-12">
                    <label class="text-muted" for="update_img_about">Upload Image</label>
                    <input class="form-control" id="update_img_about" name="update_img_about" type="file">
                </div>
                <div class="col-12">
                    <label class="text-muted" for="update_description2">About Description</label>
                    <textarea class="form-control" id="update_description2" name="update_description2" rows="7"  required
                    oninput="desc2Limit(this)" value=""></textarea>
                    <div id="char2Counter" class="form-text text-end"></div>
                </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_age">Age</label>
                    <input class="form-control" id="update_age" name="update_age" type="number" min="0" max="100"
                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                    required value="">
                </div>
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_experience">Years of Experience</label>
                    <input class="form-control" id="update_experience" name="update_experience" type="number"  min="0" max="100" 
                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                    required value="">
                </div>
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_phone">Phone</label>
                    <input class="form-control" id="update_phone" name="update_phone" type="text" required
                            value="">
                </div>
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_website">Website</label>
                    <input class="form-control" id="update_website" name="update_website" type="text" required
                            value="">
                </div>
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_city">City</label>
                    <input class="form-control" id="update_city" name="update_city" type="text" required
                            value="">
                </div>
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_email">Email</label>
                    <input class="form-control" id="update_email" name="update_email" type="email" required
                            value="">
                </div>
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_degree">Degree</label>
                    <input class="form-control" id="update_degree" name="update_degree" type="text" required
                            value="">
                </div>
                <div class="col-6 col-sm-6">
                    <label class="text-muted" for="update_freelance">Freelance</label> <br>
                    <select class="form-select form-select-md mb-3" id="update_freelance" name="update_freelance" aria-label=".form-select-sm">
                        <option selected>Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select> 
                </div>
                </div>
            </div>

        </div>
        <div class="row mt-2 g-3">
            <!-- buttons -->
            <div class="col-md-6 d-flex justify-content-center">
                <button type="button" class="modal-cancel-Btn btn btn-primary" data-bs-dismiss="modal">Cancel</button>   
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button type="submit" id="aboutUpdateBtn" name="aboutUpdateBtn" class="modal-confirm-Btn btn btn-primary">Update</button>      
            </div> 
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ======= Skills  ======= -->
<section class="skills section-bg">
    <div class="section-title">
    <h2><a class="skillsAdd_openModal main-add-ico" data-bs-toggle="modal" data-bs-target="#modalSkill" title="Add Skills"><i class="fa fa-circle-plus"></i></a> Skills</h2>
    </div>

    <div class="tips container">
        <h5><i class="fa-solid fa-lightbulb"></i> Quick Tip</h5>
        <p>The Skills Section of the online portfolio is where you can list most of your essential skills that is related to what you do. The more skills you have, usually the better—but only if you’ll actually use them in the kind of work you want. (Hot tip: do not overload your portfolio with irrelevant skills!)</p>
    </div>
    
    <div id="SkillSection" class="row g-4 skills-content" title="Edit Skill" >
        <!-- <table id="skillsTable" style="width:100%" cellpadding="0" cellspacing="0" BORDER="0">
            <thead></thead>
            <tbody>

            </tbody>
        </table> -->
    </div>
</section><!-- End Skills -->

<!-- Modal Skills Create -->
<div class="modal fade" id="modalSkill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSkillLabel">Skill</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-4 " id="formSkill" name="formSkill" method="POST" action="#">
            <div class="col-12">
                <label class="text-muted" for="input_skill">Skill</label>
                <input class="form-control" id="input_skill" name="input_skill" type="text" required>
            </div>
            <div class="col-12">
                <label class="text-muted" for="input_percentage">Skill Level %</label>
                <input class="form-control" id="input_percentage" name="input_percentage" type="number" min="0" max="100" 
                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                    required value="">
            </div>
            <!-- buttons -->
            <div class="col-md-6 d-flex justify-content-center">
                <button type="button" class="skillDeleteBtn modal-cancel-Btn btn btn-primary">Delete</button>   
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button type="submit" name="skillCreateBtn" class="skillCreateBtn modal-confirm-Btn btn btn-primary">Add Skill</button>
                <button type="submit" name="skillUpdateBtn" class="skillUpdateBtn modal-confirm-Btn btn btn-primary">Update</button>      
            </div> 
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ======= Resume Section ======= -->
<section id="resume" class="resume section-bg">
<div class="container-fluid">

    <div class="section-title">
    <h2>Resume</h2>
    <p>Check My Resume</p>
    </div>

    <h3 class="resume-title"> Education
        <a class="educationAdd_openModal main-add-ico" data-bs-toggle="modal" data-bs-target="#modalEducation" title="Add Education"><i class="fa fa-circle-plus"></i></a> 
    </h3>
    <div id="EducationSection" class="row" title="Edit Degree Name/Major">
    <!-- Insert Education Background -->
    </div>

    <h3 class="resume-title">Professional Experience 
        <a class="experienceAdd_openModal main-add-ico" data-bs-toggle="modal" data-bs-target="#modalExperience" title="Add Professional Experience"><i class="fa fa-circle-plus"></i></a> 
    </h3>
    <div id="ExperienceSection" class="row" title="Edit Job title & Postion">
    <!-- Insert Professional Background -->
    </div>

</div>
</section><!-- End Resume Section -->

<!-- Modal Education Create & Edit -->
<div class="modal fade" id="modalEducation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEducationLabel">Resume: Education Background</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 " id="formEducation" name="formEducation" method="POST" action="#">
            <div class="col-12">
                <label class="text-muted" for="degree_edu">Degree Name/Major</label>
                <input class="form-control" id="degree_edu" name="degree_edu" type="text" required>
            </div>
            <div class="col-12">
                <label class="text-muted" for="year_edu">Graduation Year (or anticipated graduation date)</label>
                <div class="date_input">
                    <input class="form-control" id="year_edu" name="year_edu" type="text" aria-describedby="year_help" required>
                    <i class="fa fa-calendar-days"></i>
                </div>
                <div id="year_help" class="form-text">
                    <i>Format: YYYY (eg. 2022)</i>
                </div>
            </div>
            <div class="col-12">
                <label class="text-muted" for="location_edu">Institution Name and Location</label>
                <input class="form-control" id="location_edu" name="location_edu" type="text" required>
            </div>
            <div class="col-12">
                <label class="text-muted" for="description_edu">Description & Additional Details</label>
                <textarea class="form-control" id="description_edu" name="description_edu" rows="5"  required
                oninput="descEduLimit(this)" value=""></textarea>
                <div id="descEduLimit" class="form-text text-end"></div>
            </div>

            <!-- buttons -->
            <div class="col-md-6 d-flex justify-content-center">
                <button type="button" class="educationDeleteBtn modal-cancel-Btn btn btn-primary">Delete</button>   
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button type="submit" class="educationCreateBtn modal-confirm-Btn btn btn-primary">Create</button> 
                <button type="submit" class="educationUpdateBtn modal-confirm-Btn btn btn-primary">Update</button>      
            </div> 
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Experience Create & Edit -->
<div class="modal fade" id="modalExperience" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExperienceLabel">Resume: Professional Experience Background</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 " id="formExperience" name="formExperience" method="POST" action="#">
            <div class="col-12">
                <label class="text-muted" for="job_exp">Job Title and Position</label>
                <input class="form-control" id="job_exp" name="job_exp" type="text" required>
            </div>
            <div class="col-6">
                <label class="text-muted" for="startDate_exp">Start Date Employed</label>
                <!-- <input class="form-control" id="startDate_exp" name="startDate_exp" type="text" required> -->
                <input id="startDate_exp" class="form-control" type="date" />
                <span id="startDate_exp_Selected"></span>
            </div>
            <div class="col-6">
                <label class="text-muted" for="endDate_exp">End Date Employed</label>
                <!-- <input class="form-control" id="endDate_exp" name="endDate_exp" type="text" required> -->
                <input id="endDate_exp" class="form-control" type="date" />
                <span id="endDate_exp_Selected"></span>
            </div>
            <div class="col-12">
                <label class="text-muted" for="location_exp">Company Name & Location</label>
                <input class="form-control" id="location_exp" name="location_exp" type="text" required>
            </div>
            <div class="col-12">
                <label class="text-muted" for="description_exp">Description & Additional Details</label>
                <textarea class="form-control" id="description_exp" name="description_exp" rows="5"  required
                oninput="descExpLimit(this)" value=""></textarea>
                <div id="descExpLimit" class="form-text text-end"></div>
            </div>

            <!-- buttons -->
            <div class="col-md-6 d-flex justify-content-center">
                <button type="button" class="experienceDeleteBtn modal-cancel-Btn btn btn-primary">Delete</button>   
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button type="submit" class="experienceCreateBtn modal-confirm-Btn btn btn-primary">Create</button> 
                <button type="submit" class="experienceUpdateBtn modal-confirm-Btn btn btn-primary">Update</button>      
            </div> 
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ======= Services Section ======= -->
<section id="services" class="services section-bg">
<div class="container-fluid">

    <div class="section-title">
        <h2><a class="serviceAdd_openModal main-edit-ico" data-bs-toggle="modal" data-bs-target="#modalService">
            <i class="fa fa-circle-plus" title="Add Services"></i></a> Services</h2>
        <p>My Services</p>
    </div>

    <div class="tips container">
        <h5><i class="fa-solid fa-lightbulb"></i> Quick Tip</h5>
        <p>The Services Section is wher you can tell the readers the services that you offer and your specialties. You can include a brief description of your service and a option to include a link that will redirect the reader to the service you offer.</p>
    </div>

    <div id="ServiceSection"  class="row g-3 d-flex justify-content-center" title="Edit Service">
        <!-- insert service/s -->
    </div>

</div>
</section><!-- End Services Section -->

<!-- Modal Service Create/Edit -->
<div class="modal fade" id="modalService" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalServiceLabel">Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-4 " id="formService" name="formService" method="POST" action="#">
            <div class="col-12">
                <label class="text-muted" for="service_service">Service</label>
                <input class="form-control" id="service_service" name="service_service" type="text" required>
            </div>
            <div class="col-12">
                <label class="text-muted" for="service_link">Link to your Service (if none, leave blank)</label>
                <input class="form-control" id="service_link" name="service_link" type="text" required>
            </div>
            <div class="col-12">
                <label class="text-muted" for="service_description">Description (brief description of the service)</label>
                <textarea class="form-control" id="service_description" name="service_description" rows="5"  required
                oninput="descServiceLimit(this)" value=""></textarea>
                <div id="descServiceLimit" class="form-text text-end"></div>
            </div>
            <!-- buttons -->
            <div class="col-md-6 d-flex justify-content-center">
                <button type="button" class="serviceDeleteBtn modal-cancel-Btn btn btn-primary">Delete</button>   
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button type="submit" name="serviceCreateBtn" class="serviceCreateBtn modal-confirm-Btn btn btn-primary">Add Service</button>
                <button type="submit" name="serviceUpdateBtn" class="serviceUpdateBtn modal-confirm-Btn btn btn-primary">Update</button>      
            </div> 
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio section-bg">
<div class="container-fluid">

    <div class="section-title">
    <h2><a class="workAdd_openModal main-add-ico" data-bs-toggle="modal" data-bs-target="#modalWork" title="Add Portfolio"><i class="fa fa-circle-plus"></i></a> Portfolio</h2>
    <p>My Works</p>
    </div>

    <div class="tips">
        <h5><i class="fa-solid fa-lightbulb"></i> Quick Tip</h5>
        <p>The Portfolio Section is where you can showcase your best works and projects. Remember, you’re going for quality, not quantity.</p>
    </div>

    <div id="WorkSection" class="row g-2 g-5 d-flex align-items-center justify-content-center">
    <!-- insert work/s -->
    </div>

</div>
</section><!-- End Portfolio Section -->

<!-- Portfolio Modal -->
<div class="modal fade" id="portfolio-modal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="portfolioModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row g-3">
            <div class="col-lg-7">
                <img id="view_image" src="../assets/images/image-holder.svg" alt="" class="d-block mx-lg-auto img-fluid" width="500" height="500">
            </div>

            <div class="col-lg-5 portfolio-info">
                <h3>Project information</h3>
                <ul class="portfolio-info-list">
                <li><strong>Category</strong>: <span id="view_category"></span></li>
                <li><strong>Client</strong>: <span id="view_client"></span></li>
                <li><strong>Project date</strong>: <span id="view_date"></span></li>
                <li><strong>Project URL</strong>: <span id ='view_url' href="#"></span></li>
                </ul>
                <p id ='view_description'></p>
            </div>

            </div>

        </div>
        </div><!-- End Portfolio Details -->

    </div>
    </div>
</div>
</div>


<!-- Modal Work Create/Edit -->
<div class="modal fade" id="modalWork" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalWorkLabel">Portfolio Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-4 " id="formWork" name="formWork" method="POST" action="#">
        <input type="hidden" name="action_work" id="action_work" value="fetch" />
        <input type="hidden" name="image_work_id" id="image_work_id" />
        <div class="row g-3">
            <div class="divider col-lg-7">
                <div class="row g-3">
                <div class="col-12">
                    <label class="text-muted" for="work_project">Project Title</label>
                    <input class="form-control" id="work_project" name="work_project" type="text" required>
                </div>
                <div class="col-12">
                    <label class="text-muted" for="work_category">Project Category/Type</label>
                    <input class="form-control" id="work_category" name="work_category" type="text" required>
                </div>
                <div class="col-12">
                    <label class="text-muted" for="work_description">Project Description</label>
                    <textarea class="form-control" id="work_description" name="work_description" rows="5"  required
                    oninput="descWorkLimit(this)" value=""></textarea>
                    <div id="descWorkLimit" class="form-text text-end"></div>
                </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row g-3">
                <div class="col-12">
                    <label class="text-muted" for="work_image">Upload Project Image</label>
                    <input class="form-control" id="work_image" name="work_image" type="file" id="formFile">
                </div>
                <div class="col-12">
                    <label class="text-muted" for="work_client">Project Client</label>
                    <input class="form-control" id="work_client" name="work_client" type="text" required>
                </div>
                <div class="col-12">
                    <label class="text-muted" for="work_date">Project Date</label>
                    <input id="work_date" class="form-control" name="work_date" type="date" />
                    <span id="work_date_Selected" name="work_date_Selected"></span>
                </div>
                <div class="col-12">
                    <label class="text-muted" for="work_url">Project URL</label>
                    <input class="form-control" id="work_url" name="work_url" type="text" required>
                </div>
                </div>
            </div>

        </div>
        <div class="row mt-2 g-3">
            <!-- buttons -->
            <div class="col-md-6 d-flex justify-content-center">
                <button type="button" class="workDeleteBtn modal-cancel-Btn btn btn-primary">Delete</button>   
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button type="submit" name="workCreateBtn" class="workCreateBtn modal-confirm-Btn btn btn-primary">Add Project</button>
                <button type="submit" name="workUpdateBtn" class="workUpdateBtn modal-confirm-Btn btn btn-primary">Update</button>   
            </div> 
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- ======= Contact Section ======= -->
<Section id="Contact" class="contact-me">
<div class="container-fluid">
    <div class="row">
        <div id="contact-left" class="col-md-6 py-5">
            <div class="section-title">
                <h2>Contact</h2>
                <p>Contact Me</p>
            </div>

            <div class="info-box">
                <h3><i class="fa-solid fa-map"></i> &nbsp;My Address</h3>
                <p id="contact_city" class="info-p" ></p>
            </div>

            <div class="info-box">
                <h3><i class="fa-solid fa-envelope"></i> &nbsp;Email Me</h3>
                <p id="contact_email" class="info-p"></p>
            </div>

            <div class="info-box">
                <h3><i class="fa-solid fa-phone"></i> &nbsp;Call Me</h3>
                <p id="contact_phone" class="info-p"></p>
            </div>
            
        </div>

        <div id="contact-right" class="col-md-6 py-5">
            <div class="section-title">
                <h2></h2>
                <p>Message Me</p>
            </div>
            <form action="#" method="post" role="form" class="contact-form">
                <div class="row g-3">
                    <div class="col-12 form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                    </div>
                    <div class="col-12 form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                    </div>
                    <div class="col-12 form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message" aria-describedby="msghelpBlock" required></textarea>
                        <div id="passwordHelpBlock" class="form-text" style="color:#fff;">
                        *This message contact/feedback form is only for the viewers of your online portfolio
                        </div>
                    </div>
                    <div class="text-center"><button class="contact-submit" type="submit" disabled>Send Message</button></div>
                </div>
            </form>
        </div>

    </div>
</div>
</Section> 
<!-- /CONTACT US -->

<script src="PortfolioCRUD\portfolio.ajax.js"></script>
<?php include 'footer.php';?>