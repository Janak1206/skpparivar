<?php
// Include database connection
include_once 'common/header.php';
require_once 'includes/db.php';

// SQL query to interact with info from our database
$conn = db_connect();
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
$sql = "SELECT member_no, member_name_en, member_name, address, total_members FROM contacts ORDER BY member_name_en"; 
$sqlResult = mysqli_query($conn, $sql);
$i = 0;
$total_members_sum = 0;
$total_members = 0;
// Establish the output variable
$dyn_table = '<table border="1" width="100%" cellpadding="5">';
$dyn_table .= '<tr>
						<td style="width:10%"><b><h5>સભ્ય નંબર</td>
						<td style="width:32%"><b><h5>સભ્ય નું નામ (ગુજરાતી)</td>
						<td style="width:32%"><b><h5>સભ્ય નું નામ (English)</td>
						<td style="width:10%"><b><h5>સભ્ય સંખ્યા</td>
						<td style="width:16%"></td></<tr>';
while($row = mysqli_fetch_array($sqlResult)){ 
    
    $member_no = $row["member_no"];
    $member_name = $row["member_name"];
	$member_name_en = $row["member_name_en"];
	$total_members = $row["total_members"];
	$total_members_sum = $total_members_sum + $total_members;
	$null_str = "";
    $dyn_table .= '<tr>
						<td style="width:10%">'.$member_no. 	'</td>
						<td style="width:32%">'.$member_name. '</td>
						<td style="width:32%">'.$member_name_en. '</td>
						<td style="width:10%">'.$total_members. '</td>
						<td style="width:16%"></td>';
    $i++;
}
$dyn_table .= '<tr>
						<td style="width:10%"></td>
						<td style="width:32%"></td>
						<td style="width:32%"><h5><b>કુલ સભ્ય સંખ્યા</td>
						<td style="width:10%">'.$total_members_sum. '</td>
						<td style="width:16%"></td></<tr>';
						
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