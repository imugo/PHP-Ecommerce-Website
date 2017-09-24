<?php
	include PRESENTATION_DIR.'admin_orders.php';
	$obj = new AdminOrders();
	$obj->init();
	
	echo '<div class="container">';
	// If an error has occurred
	if ($obj->mErrorMessage)
		echo '
		<div class="alert alert-warning alert-dismissible fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p>'.$obj->mErrorMessage.'</p>
		</div>';
		
	echo '
	
	<form method="get" action="'.$obj->mLinkToAdmin.'"><br>
		<h1 class="text-center">Orders Admin</h1>
		<div class="container">
		<input type="hidden" value="Orders" name="Page">
		
		<div class="form-group">
			<label for="recent">Show the most recent orders</label>
			<input type="text" class="form-control" name="recordCount" value="'.$obj->mRecordCount.'" id="recent">
			<input type="submit" class="primary-button" name="submitMostRecent" value="Go">
		</div>
		
		<div class="form-group">
			<label for="start">Show all records created between</label>
			<input type="date" class="form-control" name="startDate" value="'.$obj->mStartDate.'" id="start">
			<label for="end">and</label>
			<input type="date" class="form-control" name="endDate" value="'.$obj->mEndDate.'" id="end">
			<input type="submit" class="primary-button" name="submitBetweenDates" value="Go">
		</div>
		
		<div class="form-group">
			<label for="status">Show orders by status</label>';
			
			echo '<select name="status" id="status">';
				foreach($obj->mOrderStatusOptions as $key=>$value) {
					$selected = '';
					if ($obj->mSelectedStatus == $key) {
						$selected = 'selected';
					}
					echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				}
			echo '</select>';
			echo '<input type="submit" class="primary-button" name="submitOrdersByStatus" value="Go">
		</div>
		</div>
	</form>';
	
	if ($obj->mOrders) {
		echo '
		<br>
		<h3 class="text-center">Result</h3>
		<div class="container">
		<div class="table-responsive">
			<table class="table">
				<tr>
					<th>Order Id</th>
					<th>Date Created</th>
					<th>Date Shipped</th>
					<th>Status</th>
					<th>Customer</th>
					<th>&nbsp;</th>
				</tr>';
				
				$status = '';
				for ($i=0; $i<count($obj->mOrders); $i++) {
					$status = $obj->mOrders[$i]['status'];
					
					echo '
					<tr>
						<td>'.$obj->mOrders[$i]['order_id'].'</td>
						<td>'.$obj->mOrders[$i]['created_on'].'</td>
						<td>'.$obj->mOrders[$i]['shipped_on'].'</td>
						<td>'.$obj->mOrderStatusOptions[$status].'</td>
						<td>'.$obj->mOrders[$i]['customer_name'].'</td>
						<td><br><a href="'.$obj->mOrders[$i]['link_to_orders_detail_admin'].'" class="primary-button">View details</a><br><br></td>
					</tr>';		
				}
			echo '</table></div>
		</div>';
	}
	
	echo '</div>';
?>