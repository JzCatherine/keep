<?php
// header('Content-Type: application/json');
include("../../../Database/db.php");

function validate_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start();
if (isset($_POST["action"])) {
    $id = $_SESSION['share-userid'];

    if ($_POST["action"] == "fetch") {
        $query = "SELECT users.usersFirstName, users.usersLastName, users.usersSuffix, users_info.* 
                    FROM users 
                    JOIN users_info 
                    ON users.usersId=users_info.userid 
                    WHERE users.usersId=".$id."";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $output = '
        <div class="col-md-6" id="read_image_up">
            <img id="read_image1" src="';
        if($row["img_home"]){
            $output .= 'data:image/jpeg;base64,'.base64_encode($row["img_home"]).'';
        }else {
            $output .= '../assets/images/image-holder.svg';
        }

        $output .= '" class="d-block mx-lg-auto img-fluid" width="242" height="363" >
        </div>
        <div class="col-md-6 py-5 mx-auto">
            <h1 class="display-5 fw-bold lh-1 mb-2">'.$row["usersFirstName"]. ' ' .$row["usersLastName"]. ' ' .$row["usersSuffix"]. '</h1>
            <div class="hr"></div>
            <p id="read_lead" class="lead text-break">';
        if($row["description1"]){
            $output .= $row["description1"];
        }else {
            $output .= '
            Tell readers here who you are in the first line of your portfolio introduction. Keep it short and simple.</br>
            <span class="edit_Help font-monospace">To edit this section, click the edit icon <i class="fa fa-edit"></i> found the top left</span>.';
        }        
                
        
         $output .= '</p>
            <div class="d-grid d-md-flex justify-content-md-center">
                <a href="#about" class="btn-get-started scrollto"><i class="fa-solid fa-angles-down"></i></a>
            </div>
        </div>
        ';
        echo $output;
    }
}
?>