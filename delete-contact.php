<?php
    require_once('./includes/functions.php');
    if(!isset($_POST['contact-id'])) {
        die("You trying to hack me!!");
    }
    $contact_id = $_POST['contact-id'];
    $image_name = db_select("SELECT image_name FROM contacts WHERE id = $contact_id")[0]['image_name'];
    $image_name = get_image_name($image_name, $contact_id);
    $query = "DELETE FROM contacts WHERE id = $contact_id";
    db_query($query);
    unlink("images/users/$image_name");
    header("Location: index.php?op=delete&status=success");
?>
