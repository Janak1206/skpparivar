<?php
include_once 'common/header.php';
require_once 'includes/db.php';
if (empty($_SESSION['user'])) {
    header('location:' . SITEURL . "login.php");
    exit();
}
$error_msg = "";
$userId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;
$contactId = $_GET['id'];
if (!empty($contactId) && is_numeric($contactId)) {
    $conn = db_connect();
	mysqli_query($conn,"SET CHARACTER SET 'utf8'");
	mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
    $contact_Id = mysqli_real_escape_string($conn, $contactId);
    $sql = "SELECT * FROM `contacts` WHERE `id`={$contact_Id} AND `owner_id`={$userId}";
    $sqlResult = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($sqlResult);
    if ($rows > 0) {
        $contactResult = mysqli_fetch_assoc($sqlResult);
    } else {
        $error_msg = "Record doesn't exist.";
    }
    db_close($conn);
} else {
    $error_msg = "Invalid contact id. Id should be numeric.";
}

if (!empty($error_msg)) {

    echo '<div class="alert alert-danger text-center mt-2 ">' . $error_msg . '</div>';

} else {
    ?>
<table style="width: 700pt; /* margin-right: 9pt; *//* margin-left: 9pt; *//* border-collapse: collapse; */float: left;margin-top: 10px;" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 14.4pt;">
<td style="width: 449.1pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="2">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">સાણંદના ભાગનું (વાસ) નામ : </span></strong></p>
</td>
<td style="width: 187.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">ફોર્મ ભર્યા તારીખ: 01/01/2000</span></strong></p>
</td>
<td style="width: 113.95pt; border-style: solid; border-width: 0.75pt; padding-top: 5.0pt; padding-bottom: 5.0pt; vertical-align: center; text-align: center;" rowspan="6">
<img src="<?php echo !empty($contactResult['photo']) ? SITEURL . "uploads/photos/" . $contactResult['photo'] : SITEURL . "uploads/photos/default_image.jpg" ; ?>" width="150" />
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 647.1pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="3">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">મુખ્ય સભ્યનું નામ :</span></strong><strong><span style="font-family: Shruti;">&nbsp; </span></strong><strong><span style="font-family: Shruti;"><?php echo $contactResult['member_name']; ?></span></strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 647.1pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="3">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">પિતાનું નામ : Father Name</span></strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 647.1pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="3">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">સરનામું : <?php echo $contactResult['address']; ?></span></strong></p>
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong>&nbsp;</strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 329.4pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">વિસ્તાર (area) : Area_Address</span></strong></p>
</td>
<td style="width: 306.9pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="2">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">પીનકોડ : Pincode_Address</span></strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 329.4pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-left: 8.1pt; margin-bottom: 0pt; text-indent: -8.1pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">જન્મ તારીખ : BirthDay</span></strong></p>
</td>
<td style="width: 306.9pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="2">
<p style="margin-top: 0pt; margin-left: 8.1pt; margin-bottom: 0pt; text-indent: -8.1pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">અભ્યાસ : Study</span></strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 647.1pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="3">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">મોબાઇલ નંબર (વોટ્સપ નંબર) : <?php echo $contactResult['mobile_no_1'] ." ". $contactResult['mobile_no_2']?></span></strong></p>
</td>
<td style="width: 113.95pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti; color: #ffffff;">સભાસદ નંબર</span></strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 449.1pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;" colspan="2">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">વ્યવસાય : JOB</span></strong></p>
</td>
<td style="width: 187.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">વાર્ષિક આવક: 1000000</span></strong></p>
</td>
<td style="width: 113.95pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;"><?php echo $contactResult['member_no'] ?></span></strong></p>
</td>
</tr>
</tbody>
</table>
<table style="width: 700pt;/* margin-right: 9pt; *//* margin-left: 9pt; */border: 0.75pt solid #000000;/* border-collapse: collapse; */float: left;" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">ક્રમ</span></strong></p>
</td>
<td style="width: 236.7pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">કુટુંબ ના સભ્યો નું નામ</span></strong></p>
</td>
<td style="width: 56.7pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">મુખ્ય સભ્ય સાથે સબંધ</span></strong></p>
</td>
<td style="width: 56.7pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">જન્મ તારીખ</span></strong></p>
</td>
<td style="width: 38.7pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">પરિણીત</span></strong></p>
</td>
<td style="width: 25.2pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">બ્લડ ગ્રુપ</span></strong></p>
</td>
<td style="width: 74.7pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">અભ્યાસ</span></strong></p>
</td>
<td style="width: 65.7pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">વ્યવસાય</span></strong></p>
</td>
<td style="width: 113.8pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle; background-color: #7f7f7f;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">મોબાઈલ નંબર</span></strong></p>
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 10pt;"><strong><span style="font-family: Shruti; color: #ffffff;">(વોટ્સપ નંબર)</span></strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૧</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;"><strong><span style="font-family: Shruti;">Sub Member Name</span></strong></p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;">Relation</span></strong></p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;">01/01/2002</span></strong></p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;">Yes</span></strong></p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;">O+</span></strong></p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;">Sub_Study</span></strong></p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;">Sub_JOB</span></strong></p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><strong><span style="font-family: Shruti;">SUB_9898989898</span></strong></p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૨</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૩</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૪</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૫</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૬</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૭</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૮</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૯</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૧૦</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૧૧</span></p>
</td>
<td style="width: 236.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 38.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-style: solid; border-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; border-bottom-style: solid; border-bottom-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
<tr style="height: 14.4pt;">
<td style="width: 17.1pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">૧૨</span></p>
</td>
<td style="width: 236.7pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 56.7pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: middle;">
<p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; font-size: 11pt;"><span style="font-family: Shruti;">&nbsp;</span></p>
</td>
<td style="width: 38.7pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 25.2pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 74.7pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 65.7pt; border-top-style: solid; border-top-width: 0.75pt; border-right-style: solid; border-right-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
<td style="width: 113.8pt; border-top-style: solid; border-top-width: 0.75pt; border-left-style: solid; border-left-width: 0.75pt; padding-right: 5.03pt; padding-left: 5.03pt; vertical-align: top;">
<p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 11pt;">&nbsp;</p>
</td>
</tr>
</tbody>
</table>
<?php
}
include_once 'common/footer.php';