	<?php
	include_once 'common/header.php';
	require_once 'includes/db.php';
	
	if (empty($_SESSION['user'])) {
		$currentPage = !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$_SESSION['request_url'] = $currentPage;
		header('location:' . SITEURL . "login.php");
		exit();
	}
	$userId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;
	$contactId = !empty($_GET['id']) ? $_GET['id'] : '';
	$rows_family = 1;
	if (!empty($contactId) && is_numeric($contactId)) {
		$conn = db_connect();
		mysqli_query($conn,"SET CHARACTER SET 'utf8'");
		mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
		$contact_Id = mysqli_real_escape_string($conn, $contactId);
		$sql = "SELECT * FROM `contacts` WHERE `id`={$contact_Id} AND `owner_id`={$userId}";
		$sqlResult = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($sqlResult);
		
		if ($rows > 0) {
			$contact = mysqli_fetch_assoc($sqlResult);
			
			$sql_family = "SELECT * FROM `sub_member_details` WHERE `main_member_id`={$contact_Id}";
			$sqlResult_family = mysqli_query($conn, $sql_family);
			$rows_family = mysqli_num_rows($sqlResult_family);
			if ($rows_family > 0) {
				$i=-1;
				while ($contact_family = mysqli_fetch_assoc($sqlResult_family)) {
					  $i++;
						$family_member_name_en[$i] = $contact_family["family_member_name_en"];
						$relation_en[$i] = $contact_family["relation_en"];
						//$dob_family[$i] = $contact_family["dob"];
						$married_family[$i] = $contact_family["married"];
						$blood_group_family[$i] = $contact_family["blood_group"];
						$education_family[$i] = $contact_family["education"];
						$job_business_family[$i] = $contact_family["job_business"];
						$mobile_no[$i] = $contact_family["mobile_no"];
					}
	 		}
		} else {
			$error_msg = "Record doesn't exist.";
		}
		db_close($conn);
	}
	//print_r($family_member_name_en);
	//echo("<script>console.log('PHP: " . $family_member_name_en[] . "');</script>");
	
	$sanandPartNo = (!empty($contact) && !empty($contact['sanandPartNo'])) ? $contact['sanandPartNo'] : '';
	$formFillDate = (!empty($contact) && !empty($contact['formFillDate'])) ? $contact['formFillDate'] : '';
	$member_no = (!empty($contact) && !empty($contact['member_no'])) ? $contact['member_no'] : '';
	$father_name = (!empty($contact) && !empty($contact['father_name'])) ? $contact['father_name'] : '';
	$father_name_en = (!empty($contact) && !empty($contact['father_name_en'])) ? $contact['father_name_en'] : '';
	$member_name = (!empty($contact) && !empty($contact['member_name'])) ? $contact['member_name'] : '';
	$member_name_en = (!empty($contact) && !empty($contact['member_name_en'])) ? $contact['member_name_en'] : '';
	$email = (!empty($contact) && !empty($contact['email'])) ? $contact['email'] : '';
	$mobile_no_1 = (!empty($contact) && !empty($contact['mobile_no_1'])) ? $contact['mobile_no_1'] : '';
	$mobile_no_2 = (!empty($contact) && !empty($contact['mobile_no_2'])) ? $contact['mobile_no_2'] : '';
	$address = (!empty($contact) && !empty($contact['address'])) ? $contact['address'] : '';
	$address_en = (!empty($contact) && !empty($contact['address_en'])) ? $contact['address_en'] : '';
	$area = (!empty($contact) && !empty($contact['area'])) ? $contact['area'] : '';
	$area_en = (!empty($contact) && !empty($contact['area_en'])) ? $contact['area_en'] : '';
	$pincode = (!empty($contact) && !empty($contact['pincode'])) ? $contact['pincode'] : '';
	$married = (!empty($contact) && !empty($contact['married'])) ? $contact['married'] : '';
	$dob = (!empty($contact) && !empty($contact['dob'])) ? $contact['dob'] : '';
	$education = (!empty($contact) && !empty($contact['education'])) ? $contact['education'] : '';
	$job_business = (!empty($contact) && !empty($contact['job_business'])) ? $contact['job_business'] : '';
	$job_business_place = (!empty($contact) && !empty($contact['job_business_place'])) ? $contact['job_business_place'] : '';
	$annual_income = (!empty($contact) && !empty($contact['annual_income'])) ? $contact['annual_income'] : '';
	$blood_group = (!empty($contact) && !empty($contact['blood_group'])) ? $contact['blood_group'] : '';
	$photo = (!empty($contact) && !empty($contact['photo'])) ? SITEURL . "uploads/photos/".$contact['photo']: SITEURL . "uploads/photos/default_image.png";
	$total_members = (!empty($contact) && !empty($contact['total_members'])) ? $contact['total_members'] : '';	
	
	?>
	<div class="row justify-content-center wrapper">
		<div class="col-md-6">
			<?php
			if (!empty($_SESSION['errors'])) {
				?>
				<div class="alert alert-danger">
					<p>There were following error(s) found:</p>
					<ul>
						<?php
						foreach ($_SESSION['errors'] as $error) {
							print '<li>' . $error . '</li>';
						}
						?>
					</ul>
				</div>
				<?php
				unset($_SESSION['errors']);
			}
			?>
			<div class="card">
				<header class="card-header">
					<h6 class="card-title">Add/Edit Contact ( શ્રી સાણંદ કડવા પાટીદાર પરિવાર, અમદાવાદ )</h6>
				</header>
				<article class="card-body">
					<form method="POST" action="<?php echo SITEURL . "actions/addcontact_action.php"; ?>" enctype="multipart/form-data">
						<div class="form-row">
						
							<div class="col form-group">
								<label>સાણંદના ભાગનું (વાસ) નામ : </label>
								<input type="text" name="sanandPartNo" value="<?php echo $sanandPartNo; ?>" class="form-control" placeholder="સાણંદના ભાગનું (વાસ) નામ">
							</div>
							
							<div class="col form-group">
								<label>Member No:</label>
								<input type="text" name="member_no" value="<?php echo $member_no; ?>" class="form-control" placeholder="Member No">
							</div>
							
							<div class="col form-group">
								<label>ફોર્મ ભર્યા તારીખ: </label>
								<input type="date" name="formFillDate" value="<?php echo $formFillDate; ?>" class="form-control">
							</div>

							<div class="col form-group">
							<label>Upload Photo</label>
								<div class="form-group input-group">
									<div class="custom-file">
										<input type='file' accept='image/*' onchange='openFile(event)'  name="photo"  id="contact_photo"><br>
										<img id='output' src="<?php echo $photo; ?>" width='80px' height='100px'>
										<script>
										  var openFile = function(event) {
											var input = event.target;

											var reader = new FileReader();
											reader.onload = function(){
											  var dataURL = reader.result;
											  var output = document.getElementById('output');
											  output.src = dataURL;
											};
											reader.readAsDataURL(input.files[0]);
										  };
										</script>

									</div>
								</div>
							</div>
						</div>
						<div class="form-row">
						<div class="col form-group">
							<label>મુખ્ય સભ્યનું પુરું નામ :</label>
							<input type="text" name="member_name" value="<?php echo $member_name; ?>" class="form-control" placeholder="મુખ્ય સભ્યનું પુરું નામ">
						</div>
						
						<div class="col form-group">
							<label>Main Member Full Name:</label>
							<input type="text" name="member_name_en" value="<?php echo $member_name_en; ?>" class="form-control" placeholder="Main Member Full Name">
						</div>
						</div>
						<div class="form-row">
						<div class="col form-group">
							<label>પિતાનું પુરું નામ :</label>
							<input type="text" name="father_name" value="<?php echo $father_name; ?>" class="form-control" placeholder="પિતાનું પુરું નામ ">
						</div>
						
						<div class="col form-group">
							<label>Father Full Name:</label>
							<input type="text" name="father_name_en" value="<?php echo $father_name_en; ?>" class="form-control" placeholder="Father Full Name">
						</div>
						</div>
					

						<div class="form-row">
							<div class="col form-group">
								<label>રહેઠાણનું સરનામું :</label>
								<textarea rows="2" type="text" name="address" class="form-control" placeholder="રહેઠાણનું સરનામું"><?php echo $address; ?></textarea>
							</div>
							<div class="col form-group">
								<label>Address (English):</label>
								<textarea rows="2" type="text" name="address_en"class="form-control" placeholder="Address"><?php echo $address_en; ?></textarea>
							</div>
						</div>
						
						<div class="form-row">
							
							<div class="col form-group">
								<label>વિસ્તાર:</label>
								<input type="text" name="area" value="<?php echo $area; ?>" class="form-control" placeholder="વિસ્તાર">
							</div>
							<div class="col form-group">
								<label>Area(English):</label>
								<input type="text" name="area_en" value="<?php echo $area_en; ?>" class="form-control" placeholder="Area">
							</div>
							<div class="col form-group">
								<label>Pincode:</label>
								<input type="text" name="Pincode" value="<?php echo $pincode; ?>" class="form-control" placeholder="Pincode">
							</div>
							<div class="col form-group">
								<label>Married</label>
								<select name="married" value="<?php echo $married; ?>"  class="form-control">
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						
						<div class="form-row">
							<div class="col form-group">
								<label>DOB</label>
								<input type="date" name="dob" value="<?php echo $dob; ?>"  class="form-control">
							</div>
							<div class="col form-group">
								<label>Education</label>
								<input type="text" name="education" value="<?php echo $education; ?>"  class="form-control" placeholder="Education">
							</div>
							<div class="col form-group">
								<label>Mobile No 1</label>
								<input type="text" name="mobile1" value="<?php echo $mobile_no_1; ?>"  class="form-control" placeholder="Mobile No 1">
							</div>
							<div class="col form-group">
								<label>Mobile No 2</label>
								<input type="text" name="mobile2" value="<?php echo $mobile_no_2; ?>"  class="form-control" placeholder="Mobile No 2">
							</div>
						</div>
						<div class="form-row">
							<div class="col form-group">
								<label>JOB/Business</label>
								<input type="text" name="job_business" value="<?php echo $job_business; ?>"  class="form-control" placeholder="JOB/Business">
							</div>
							<div class="col form-group">
								<label>Place of JOB/Business</label>
								<input type="text" name="job_business_place" value="<?php echo $job_business_place; ?>"  class="form-control" placeholder="Place of JOB/Business">
							</div>
							<div class="col form-group">
								<label>Annual Income(approx.)</label>
								<input type="text" name="annual_income" value="<?php echo $annual_income; ?>"  class="form-control" placeholder="Annual Income">
							</div>
							<div class="col form-group">
								<label>Blood Group</label>
									<select name="blood_group" value="<?php echo $blood_group;?>" class="form-control">
										<option value="o+">o+</option>
										<option value="B+">B+</option>
									</select>
							</div>
						</div>
						<table  class="table table-hover small-text" id="tb">
							<tr class="tr-header">
								<th style="text-align: center; vertical-align: middle; font-size: 8pt;">Family Members Name</th>
								<th style="text-align: center; vertical-align: middle; font-size: 8pt;">Relation</th>
							
								<th style="text-align: center; vertical-align: middle; font-size: 8pt;">Married</th>
								<th style="text-align: center; vertical-align: middle; font-size: 8pt;">Blood Group</th>
								<th style="text-align: center; vertical-align: middle; font-size: 8pt;">Study</th>
								<th style="text-align: center; vertical-align: middle; font-size: 8pt;">Business/job</th>
								<th style="text-align: center; vertical-align: middle; font-size: 8pt;">Mobile No</th>
								<th><a href="javascript:void(0);" style="font-size:18px;" id="addMore">
									<span class="input-group-textNew" id="Add Member">+</span></a></th>
								<?php
									for($a = 0; $a < $rows_family; $a++) {
										?>
								<tr>
									<td style="width: 18%; padding-top: 0.4rem; padding-left: 0.4rem; padding-right:0.4rem; border-top: 1px solid #dee2e6;"><input type="text" name="family_member_name_en" value="<?php echo $family_member_name_en[$a]; ?>" class="form-control"></td>
									<td style="width: 12%; padding-top: 0.4rem; padding-left: 0.4rem; padding-right:0.4rem;; border-top: 1px solid #dee2e6;"><input type="text" name="relation_en[$a]" value="<?php echo $relation_en[$a]; ?>" class="form-control"></td>
									
									<td style="width: 9%; padding-top: 0.4rem; padding-left: 0.4rem; padding-right:0.4rem;; border-top: 1px solid #dee2e6;">
										<select name="married_family[$a]" value="<?php echo $married_family[$a];?>" class="form-control">
											<option value="Yes" <?php if($married_family[$a] == 'Yes'): ?> selected="selected"<?php endif; ?> >Yes</option>
											<option value="No"  <?php if($married_family[$a] == 'No'): ?> selected="selected"<?php endif; ?> >No</option>
										</select>
									</td>
									<td style="width: 8%; padding-top: 0.4rem; padding-left: 0.4rem; padding-right:0.4rem;; border-top: 1px solid #dee2e6;">
										<select name="blood_group_family[$a]" value="<?php echo $blood_group_family[$a];?>" class="form-control">
											<option value="o+">o+</option>
											<option value="B+">B+</option>
										</select>
									</td>
									<td style="width: 14%; padding-top: 0.4rem; padding-left: 0.4rem; padding-right:0.4rem;; border-top: 1px solid #dee2e6;"><input type="text" name="education_family[$a]" value="<?php echo $education_family[$a]; ?>" class="form-control"></td>
									<td style="width: 15%; padding-top: 0.4rem; padding-left: 0.4rem; padding-right:0.4rem;; border-top: 1px solid #dee2e6;"><input type="text" name="job_business_family[$a]" value="<?php echo $job_business_family[$a]; ?>" class="form-control"></td>
									<td style="width: 12%; padding-top: 0.4rem; padding-left: 0.4rem; padding-right:0.4rem;; border-top: 1px solid #dee2e6;"><input type="text" name="mobile_no[$a]" value="<?php echo $mobile_no[$a]; ?>" class="form-control"></td>
									<td style="padding-top: 0.4rem; "><a href='javascript:void(0);'  class='remove'><span class="input-group-textNew" id="Add Member">x</span></a></td>
								</tr>
								<?php
								}
								?>
						</table>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
							<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
							<script>
							$(function(){
								$('#addMore').on('click', function() {
										  var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
										  data.find("input").val('');
								 });
								 $(document).on('click', '.remove', function() {
									  var trIndex = $(this).closest("tr").index();
									  console.log("closest", $(this).closest("tr").length)
										if(trIndex>1) {
										 $(this).closest("tr").remove();
									   } else {
										 alert("Sorry!! Can't remove first row!");
										}
								  });
							}); 
							</script>
						
						<div class="form-group">
							<input type="hidden" name="cid" value="<?php echo $contactId; ?>" />
							<button type="submit" class="btn btn-primary btn-block">Submit</button>
						</div>
					</form>
				</article>
			</div>
		</div>

	</div>
	<?php
	include_once 'common/footer.php';
	?>