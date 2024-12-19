<!DOCTYPE html>
<html>
<?php 
require_once("./includes/functions.php");
$error = false;
if(isset($_POST['action'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    if(!$first_name || !$last_name || !$email || !$address || !$telephone || !$birthdate || !isset($_FILES['pic']['name'])) {
        $error = true;    
    }
    else { 
        //We can insert the data in Database
        $og_file_name = $_FILES['pic']['name'];
        $ext = end(explode(".", $og_file_name));
        $source_path = $_FILES['pic']['tmp_name'];
        $data['first_name'] = sanitize($first_name);
        $data['last_name'] = sanitize($last_name);
        $data['email'] = sanitize($email);
        $data['telephone'] = sanitize($telephone);
        $data['address'] = sanitize($address);
        $data['birthdate'] = sanitize($birthdate);
        $data['image_name'] = sanitize($ext);
        $query = prepare_insert_query($data, "contacts");
        db_query($query);
        $id = get_last_insert_id();
        $file_name = "$id.$ext";
        move_uploaded_file($source_path, "./images/users/$file_name");


        header("Location: index.php?op=update&status=success");
    }
}
?>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <!--Import Csutom CSS-->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Contact</title>
</head>
<body>
    <!--NAVIGATION BAR-->
    <nav>
        <div class="nav-wrapper">
            <nav>
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo center">Contact Info</a>
                    <ul class="right hide-on-med-and-down">
                
                    </ul>
                </div>
            </nav>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <!--/NAVIGATION BAR-->
    <div class="container">
        <div class="row mt50">
            <h2>Add New Contact</h2>
        </div>
        <div class="row">
            <?php
                if($error): 
                    ?>
                    <div class="materialert error">
                    <div class="material-icons">error_outline</div>
                    Oh! Some Data missing! :)
                    <button type="button" class="close-alert">×</button>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <form class="col s12 formValidate" action="<?= $_SERVER['PHP_SELF'];?>" id="add-contact-form" method="POST" enctype="multipart/form-data">
                <div class="row mb10">
                    <div class="input-field col s6">
                        <input id="first_name" name="first_name" type="text" class="validate" data-error=".first_name_error"
                        value="<?=old($_POST, 'first_name'); ?>">
                        <label for="first_name">First Name</label>
                        <div class="first_name_error error">
                            <?= isset($first_name) && empty($first_name) ? 'Please insert first name': '' ; ?>
                        </div> </div>

                    <div class="input-field col s6">
                        <input id="last_name" name="last_name" type="text" class="validate" data-error=".last_name_error" value="<?=old($_POST, 'last_name'); ?>">
                        <label for="last_name">Last Name</label>
                        <div class="last_name_error error "><?= isset($last_name) && empty($last_name) ? 'Please insert last name': '' ; ?></div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="input-field col s6">
                        <input id="email" name="email" type="email" class="validate" data-error=".email_error" value="<?=old($_POST, 'email'); ?>">
                        <label for="email">Email</label>
                        <div class="email_error error"><?= isset($email) && empty($email) ? 'Please insert email': '' ; ?></div>
                    </div>
                    <div class="input-field col s6">
                        <input id="birthdate" name="birthdate" type="text" class="datepicker" data-error=".birthday_error" value="<?=old($_POST, 'birthdate'); ?>">
                        <label for="birthdate">Birthdate</label>
                        <div class="birthday_error error"><?= isset($birthdate) && $birthdate == '1970-01-01' ? 'Please select birthdate': '' ; ?></div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="input-field col s12">
                        <input id="telephone" name="telephone" type="tel" class="validate" data-error=".telephone_error" value="<?=old($_POST, 'telephone'); ?>">
                        <label for="telephone">Telephone</label>
                        <div class="telephone_error error"><?= isset($telephone) && empty($telephone) ? 'Please insert telephone': '' ; ?>
                    </div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="input-field col s12">
                        <textarea id="address" name="address" class="materialize-textarea" data-error=".address_error"><?=old($_POST, 'address'); ?></textarea>
                        <label for="address">Addess</label>
                        <div class="address_error error"><?= isset($address) && empty($address) ? 'Please insert address': '' ; ?></div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>Image</span>
                            <input type="file" name="pic" id="pic" data-error=".pic_error">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload Your Image">
                        </div>
                        <div class="pic_error "></div>
                    </div>
                </div>
                <button class="btn waves-effect waves-light right" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>

            </form>
        </div>
    </div>
    <footer class="page-footer p0">
        <div class="footer-copyright ">
            <div class="container">
                <p class="center-align">© 2024 Contacts Manager</p>
            </div>
        </div>
    </footer>
    <!--JQuery Library-->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--JQuery Validation Plugin-->
    <script src="vendors/jquery-validation/validation.min.js" type="text/javascript"></script>
    <script src="vendors/jquery-validation/additional-methods.min.js" type="text/javascript"></script>
    <!--Include Page Level Scripts-->
    <script src="js/pages/add-contact.js"></script>
    <!--Custom JS-->
    <script src="js/custom.js" type="text/javascript"></script>
</body></html>
