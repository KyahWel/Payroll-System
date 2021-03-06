<?php $this->load->view("AdminSidebar") ?>

<head>
	<title>Admin List</title>
	<link href=<?php echo base_url("assets/css/Admin.css")?> rel="stylesheet">

</head>
<main class="page-content">
	<div style="margin-left: 20vw; width: 78.5vw;">
		
		<div class="">
			<?php if($this->session->flashdata('adminAccountError')) : ?>
				<div class="alert alert-danger alert-dismissible fade show">
					<?= $this->session->flashdata('adminAccountError'); ?>
					<button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
					<br>
				</div>
				
			<?php endif; ?>
			<?php if($this->session->flashdata('adminAccountSuccess')) : ?>
				<div class="alert alert-success alert-dismissible fade show">
					<?= $this->session->flashdata('adminAccountSuccess'); ?>
					<button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
					<br>
				</div>
			<?php endif; ?>
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Admin List</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addAdminModal" class="btn btn-success" data-bs-toggle="modal"><i
								class="material-icons">&#xE147;</i> <span>Add New Admin</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Position</th>
						<th>Account Added</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($admin as $row){?>
					<tr>
						<td><?php echo $row->firstname?> <?php echo $row->lastname?></td>
						<td><?php echo $row->username?></td>
						<td><?php echo $row->position?></td>
						<td><?php echo date('m/d/Y', strtotime($row->dateAdded))?> at
							<?php echo date('h:i:s a', strtotime($row->timeAdded))?>
						</td>
						<td>
							<?php if ($this->session->userdata('auth_user')['adminID'] == 1) :?>
									<a href="#editAdminModal" class="edit" data-bs-toggle="modal">
									<i class="material-icons edit_admin" data-id="<?php echo $row->adminID?>"
									data-bs-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<?php elseif ($row->adminID == $this->session->userdata('auth_user')['adminID']): ?>
									<a href="#editAdminModal" class="edit" data-bs-toggle="modal">
									<i class="material-icons edit_admin" data-id="<?php echo $row->adminID?>"
									data-bs-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<?php else:?>
									<a href="" class="disabled editDisabled ">
									<i class="material-icons edit_admin"
									data-bs-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<?php endif?>

							<?php if($row->adminID == 1): ?>
									<a href="" class="disabled deleteDisabled "><i
									class="material-icons delete_admin" data-bs-toggle="tooltip"
									>&#xE872;</i></a>
							<?php elseif ($row->adminID == $this->session->userdata('auth_user')['adminID']): ?>
									<a href="#deleteAdminModal" class="delete" data-bs-toggle="modal"><i
									class="material-icons delete_admin" data-bs-toggle="tooltip"
									data-id="<?php echo $row->adminID?>" title="Delete">&#xE872;</i></a>
							<?php else:?>
									<a href="#deleteAdminModal" class="delete" data-bs-toggle="modal"><i
									class="material-icons delete_admin" data-bs-toggle="tooltip"
									data-id="<?php echo $row->adminID?>" title="Delete">&#xE872;</i></a>
							<?php endif?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Add Modal HTML -->
	<div id="addAdminModal" class="modal fade ">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content dark-blue">
				<form method="POST" action="<?php echo site_url('AdminFunctions/addAdmin')?>">
					<div class="modal-header">
						<h4 class="modal-title text-faded">ADD ADMIN</h4>
						<button type="button" class="close text-faded" data-bs-dismiss="modal"
							aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div>
								<label class=" text-faded"> SELECT EMPLOYEE TO BECOME AN ADMIN: </label>
							</div>
							<div>
								<select name="employeeID" class="form-control" id="employeeID">
									<option value="" readonly hidden>--Please Select an Employee--</option>
									<?php foreach($employee as $employee){?>
									<?php if($employee->position == "Secretary"):?>
									<option value="<?php echo $employee->employeeID?>"><?php echo $employee->firstname?>
										<?php echo $employee->lastname?></option>
									<?php endif ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class=" text-faded">Username</label>
							<input type="text" class="form-control" name="username" required>
						</div>
						<div class="form-group">
							<label class=" text-faded">Password</label>
							<input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required > 
						</div>
					</div>
					<div class="editAnnouncementButton d-flex justify-content-end p-3">
						<button type="button" class="btn btn-default bg-white text-dark me-2" value="cancel" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-success" value="Submit">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editAdminModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content dark-blue">
				<div class="modal-body text-faded">
					<div id="edit_admin">

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete Modal HTML -->
	<div id="deleteAdminModal" class="modal fade">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content dark-blue">
				<div id="delete_admin"></div>
			</div>
		</div>
	</div>
</main>

<script src=<?php echo base_url("assets/js/Admin.js")?>></script>
<!-- jQuery JS CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- jQuery DataTables JS CDN -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- Ajax fetching data -->
<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTable').DataTable();

		$('.edit_admin').click(function () {
			var adminData = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('AdminFunctions/editAdmin');?>",
				method: "POST",
				data: {
					adminData: adminData
				},
				success: function (data) {
					$('#edit_admin').html(data);

				}
			});
		});

		$('.delete_admin').click(function () {
			var adminData = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('AdminFunctions/delete');?>",
				method: "POST",
				data: {
					adminData: adminData
				},
				success: function (data) {
					$('#delete_admin').html(data);
					console.log('success');
				}
			});
		});
	});

</script>
