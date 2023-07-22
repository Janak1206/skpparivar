<?php
// Include database connection
include_once 'common/header.php';
require_once 'includes/db.php';

// SQL query to interact with info from our database
$conn = db_connect();
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
$sql = "SELECT member_no, member_name, address FROM contacts ORDER BY id"; 
$sqlResult = mysqli_query($conn, $sql);
$i = 0;
// Establish the output variable
$dyn_table = '<table border="1" cellpadding="5">';
while($row = mysqli_fetch_array($sqlResult)){ 
    
    $member_no = $row["member_no"];
    $member_name = $row["member_name"];
	$address = $row["address"];
	$member_no_str = "<b>સભાસદ નં :</b> ";
    
    if ($i % 3 == 0) { // if $i is divisible by our target number (in this case "3")
        $dyn_table .= '<tr><td style="font-size:18px">'.$member_no_str. "<b>".$member_no."</br>".$member_name."</b></br>".$address.'</td>';
    } else {
        $dyn_table .= '<td style="font-size:18px">' . $member_no_str ."<b>".$member_no."</br>".$member_name."</b></br>".$address.'</td>';
    }
    $i++;
}
$dyn_table .= '</tr></table>';
?>
<html>
<body>
<?php echo $dyn_table; ?>
</body>
</html>

<?php
include_once 'common/footer.php';
?>