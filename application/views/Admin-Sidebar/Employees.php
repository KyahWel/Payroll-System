<?php $this->load->view("AdminSidebar") ?>

<head>
	<title>Employees</title>
	<link href=<?php echo base_url("assets/css/EmployeeTab.css")?> rel="stylesheet">
</head>


<!-- sidebar-wrapper  -->
<main class="page-content">
		
	<div>
		<!-- TABLE -->
		<div style="margin-left: 20vw; width: 73.5vw;">
			<?php if($this->session->flashdata('employeeError')) : ?>
				<div class="alert alert-danger alert-dismissible fade show">
					<?= $this->session->flashdata('employeeError'); ?>
					<button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
				</div>
			<?php endif; ?>
			<?php if($this->session->flashdata('employeeSuccess')) : ?>
				<div class="alert alert-success alert-dismissible fade show">
					<?= $this->session->flashdata('employeeSuccess'); ?>
					<button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
				</div>
			<?php endif; ?>
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>List of Employees</h2>
					</div>
					<div class="col-sm-6">
						<button class="add-employee btn btn-success" data-bs-toggle="modal"
							data-bs-target="#addEmployeeModal" id="addEmployee"><i class="material-icons">&#xE147;</i>
							<span>Add Employee</span></button>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table id="mytable" class="table table-striped table-hover">
					<thead>
						<th>Employee Number</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Position</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($employee as $row){?>
						<?php if($row->position != "Employer"): ?>
						<tr>
							<td> <a class="view_employee" style="cursor: pointer;"
									data-id="<?php echo $row->employeeID?>" id="viewEmployee" data-bs-toggle="modal"
									data-bs-target="#viewEmployeeModal">
									<?php echo $row->employeeNumber?>
								</a></td>
							<td><?php echo $row->firstname?></td>
							<td><?php echo $row->lastname?></td>
							<td><?php echo $row->position?></td>
							<td>
								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i
										class="material-icons edit_employee" data-toggle="tooltip"
										data-id="<?php echo $row->employeeID?>" title="Edit">&#xE254;</i></a>


								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i
										class="material-icons delete_employee" data-toggle="tooltip"
										data-id="<?php echo $row->employeeID?>" title="Delete">&#xE872;</i></a>
							</td>
						</tr>
						<?php endif ?>
						<?php } ?>
					</tbody>
				</table>
				<div class="clearfix"></div>
			</div>
		</div>

		<!-- MODAL -->

		<!-- ADD -->
		<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addAnnouncementHeader"
			aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content dark-blue">
					<div class="modal-header">
						<h5 class="modal-title text-faded" id="addAnnouncementHeader">Add Employee</h5>
						<button type="button" class="close text-faded" data-bs-dismiss="modal"
							aria-label="Close">&times;</button>
					</div>
					<div class="modal-body text-faded">
						<div class="form-group">
							<form action="<?php echo site_url('EmployeeFunctions/addEmployee')?>" method="POST"
								enctype="multipart/form-data">
								<div class="upload">
									<button class="uploadButton">
										<input class="uploadButton1" type="file" name="image" id="image" required>
										<i class="bi bi-camera"></i>
									</button>
									<p>Upload your photo: <br></p>
								</div>
								<div class="row">
									<div class="col-6">
										<p>First Name: <br><input type="text" class="form-control" required
												name="firstname" onkeypress="return /[a-z]/i.test(event.key)"></p>
										<p>Last Name: <br><input type="text" class="form-control" required
												name="lastname" onkeypress="return /[a-z]/i.test(event.key)"></p>
										<p>Age: <br><input type="number" class="form-control" required name="age" min="18" title="Employee must be age 18+"></p>
										<p>Address: <br><input type="text" class="form-control" required name="address">
										</p>
										<p>Position:
											<select name="position" class="form-control" required id="position">
												<option value="" selected disabled hidden>Select Position</option>
												<option value="Driver">Driver</option>
												<option value="Helper">Helper</option>
												<option value="Machine Operator">Machine Operator</option>
												<option value="Secretary">Secretary</option>
											</select>
										</p>
									</div>
									<div class="col-6">
										<p>SSS Number: <br><input type="number" class="form-control" required
												name="sss-number"></p>
										<p>Pag-IBIG Number: <br><input type="number" class="form-control" required
												name="pagibig-number"></p>
										<p>PhilHealth Number: <br><input type="number" class="form-control" required
												name="philhealth-number"></p>
										<p>TIN Number: <br><input type="number" class="form-control" required
												name="tin-number"></p>
										<p>Employment Date: <br><input type="date" class="form-control" required
												name="employmentDate"></p><br>
									</div>
								</div>
								<div class="editAnnouncementButton d-flex justify-content-end">
									<button type="cancel" class="btn btn-default bg-white text-dark me-2" value="cancel"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-success" value="submit">Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- EDIT -->
		<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editAnnouncementHeader"
			aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content dark-blue">
					<div class="modal-header">
						<h5 class="modal-title text-faded" id="editAnnouncementHeader">Edit Employee</h5>
						<button type="button" class="close text-faded" data-dismiss="modal"
							aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body text-faded">
						<div id="edit_employee" class="form-group"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- VIEW -->
		<div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewAnnouncementHeader"
			aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content dark-blue">
					<div class="modal-header text-faded">
						<h5 class="modal-title" id="viewAnnouncementHeader">Employee Details</h5>
						<button type="button" class="close text-faded" data-bs-dismiss="modal"
							aria-label="Close">&times;</button>
					</div>
					<div class="modal-body text-faded">
						<div id="view_employee" class="form-group"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- DELETE -->
		<div id="deleteEmployeeModal" class="modal fade">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content dark-blue">
					<div id="delete_employee"></div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src=<?php echo base_url("assets/js/bootstrap.bundle.min.js")?>></script>
<!-- jQuery JS CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- jQuery DataTables JS CDN -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- Ajax fetching data -->
<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTable').DataTable();
		$('.view_employee').click(function () {
			var employeeData = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('EmployeeFunctions/viewEmployee');?>",
				method: "POST",
				data: {
					employeeData: employeeData
				},
				success: function (data) {
					$('#view_employee').html(data);
				}
			});
		});

		$('.edit_employee').click(function () {
			var employeeData = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('EmployeeFunctions/edit_Employee');?>",
				method: "POST",
				data: {
					employeeData: employeeData
				},
				success: function (data) {
					$('#edit_employee').html(data);

				}
			});
		});

		$('.delete_employee').click(function () {
			var employeeData = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('EmployeeFunctions/deleteEmployee');?>",
				method: "POST",
				data: {
					employeeData: employeeData
				},
				success: function (data) {
					$('#delete_employee').html(data);vc 
				}
			});
		});
	});

</script>
