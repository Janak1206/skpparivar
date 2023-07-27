<?php
ob_start();
session_start();
require_once '../includes/config.php';
require_once '../includes/db.php';
$errors = [];

if (isset($_POST) && !empty($_SESSION['user'])) {
	$sanandPartNo = trim($_POST['sanandPartNo']);
	$formFillDate = trim($_POST['formFillDate']);
    $member_no = trim($_POST['member_no']);
    $father_name = trim($_POST['father_name']);
	$father_name_en = trim($_POST['father_name_en']);
	$member_name = trim($_POST['member_name']);
	$member_name_en = trim($_POST['member_name_en']);
	$email = trim($_POST['email']);
	$mobile_no_1 = trim($_POST['mobile_no_1']);
	$mobile_no_2 = trim($_POST['mobile_no_2']);
    $address = trim($_POST['address']);
    $address_en = trim($_POST['address_en']);
	$area = trim($_POST['area']);
	$area_en = trim($_POST['area_en']);
    $pincode = trim($_POST['pincode']);
    $married = trim($_POST['married']);
	$dob = trim($_POST['dob']);
	$education = trim($_POST['education']);
	$job_business = trim($_POST['job_business']);
	$job_business_place = trim($_POST['job_business_place']);
	$annual_income = trim($_POST['annual_income']);
	$blood_group = trim($_POST['blood_group']);
	$photofile = !empty($_FILES['photo']) ? $_FILES['photo'] : [];
    $cId = !empty($_POST['cid']) ? $_POST['cid'] : '';
	
	
	$family_member_name_en = trim($_POST['family_member_name_en']);
	console.log("family_member_name_en::", $family_member_name_en);
	
	
    // validations
    if (empty($member_no)) {
        $errors[] = "Member no can't be blank.";
	}
	if (empty($member_name)) {
        $errors[] = "Member Name can't be blank.";
    }
	 if (empty($address)) {
        $errors[] = "Address can't be blank.";
    }
    //if (empty($mobile1)) {
    //    $errors[] = "Mobile no. can't be blank.";
    //}
    //if (!empty($mobile1) && (strlen($mobile1) < 10 || strlen($mobile1) > 10)) {
    //    $errors[] = "Invalid Mobile no.";
    //}
    if (!empty($mobile1) && !is_numeric($mobile1)) {
        $errors[] = "Mobile no. should be numeric.";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('location:' . SITEURL . "addcontact.php");
        exit();
    }

    // uploading user photo
    $photoName = '';
    if (!empty($photofile['name'])) {
        $fileTempPath = $photofile['tmp_name'];
        $filename = $photofile['name'];
        $fileNameCmp = explode('.', $filename);
        $fileExtn = strtolower(end($fileNameCmp));
        //$fileNewName = md5(time() . $filename) . '.' . $fileExtn;
		$fileNewName = $memberno . '.' . $fileExtn;
        $photoName = $fileNewName;

        // allowed extension
        $allwed_extns = ["jpg", "jpeg", "png", "gif"];
        if (in_array($fileExtn, $allwed_extns)) {
            $uploadFileDir = "../uploads/photos/";
            $destiFilePath = $uploadFileDir . $photoName;
            if (!move_uploaded_file($fileTempPath, $destiFilePath)) {
                $errors[] = "File couldn't be uploaded.";
            }
        } else {
            $errors[] = "Invalid photo (file) extension.";
        }
    }

    $ownerId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;
    if (!empty($cId)) {
        // update existing record
        // if photo name exists
        if (!empty($photoName)) {
            $sql = "UPDATE `contacts` SET member_no ='{$member_no}', member_name='{$member_name}', address='{$address}', total_members='{$total_members}', member_name_en='{$member_name_en}', mobile_no_1='{$mobile1}', mobile_no_2='{$mobile2}', email='{$email}',  photo='{$photoName}' WHERE id={$cId} AND owner_id={$ownerId}";
        } else {
            // if no photo selected
            $sql = "UPDATE `contacts` SET member_no ='{$member_no}', member_name='{$member_name}', address='{$address}', total_members='{$total_members}', member_name_en='{$member_name_en}', mobile_no_1='{$mobile1}', mobile_no_2='{$mobile2}', email='{$email}' WHERE id={$cId} AND owner_id={$ownerId}";
        }
        $message = "Contact has been updated successfully!";
    } else {
        //insert new record
        $sql = "INSERT INTO `contacts` (member_no, member_name, address, total_members, member_name_en, mobile_no_1, mobile_no_2, email, photo, owner_id) VALUES ('{$member_no}','{$member_name}','{$address}', '{$total_members}','{$member_name_en}','{$mobile1}','{$mobile2}','{$email}','{$photoName}','{$ownerId}')";
        $message = "New Contact has been added successfully!";
    }

    $conn = db_connect();
	mysqli_query($conn,"SET CHARACTER SET 'utf8'");
	mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
    if (mysqli_query($conn, $sql)) {
        db_close($conn);
        $_SESSION['success'] = $message;
        header('location:' . SITEURL);
    }
}
