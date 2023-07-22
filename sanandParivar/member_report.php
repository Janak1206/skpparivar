<?php
// Include database connection
include_once 'common/header.php';
require_once 'includes/db.php';

// SQL query to interact with info from our database
$conn = db_connect();
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
$sql = "SELECT member_no, member_name, address, mobile_no_1 FROM contacts ORDER BY id"; 
$sqlResult = mysqli_query($conn, $sql);
$i = 0;
// Establish the output variable
$dyn_table = '<table border="1" width="100%" cellpadding="5">';
while($row = mysqli_fetch_array($sqlResult)){ 
    
    $member_no = $row["member_no"];
    $member_name = $row["member_name"];
	$mobile_no_1 = $row["mobile_no_1"];
	$null_str = "";
    $dyn_table .= '<tr>
						<td style="width:10%">'.$member_no. 	'</td>
						<td style="width:35%">'.$member_name. '</td>
						<td style="width:20%">'.$mobile_no_1. '</td>
						<td style="width:15%"></td>
						<td style="width:15%"></td>';
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