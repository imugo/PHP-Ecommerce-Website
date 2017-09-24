<?php
	include PRESENTATION_DIR.'admin_order_details.php';
	$obj = new AdminOrderDetails();
	$obj->init();
	
	echo '<a href="'.$obj->mLinkToOrdersAdmin.'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back to Orders Admin</a>';
	echo '
	<form method="get" action="'.$obj->mLinkToAdmin.'">
		<h1 class="text-center">Editing details for Order Id<i class="badge">'.$obj->mOrderInfo['order_id'].'</i></h1>
		<div class="container">
		<input type="hidden" name="Page" value="OrderDetails">
		<input type="hidden" name="OrderId" value="'.$obj->mOrderInfo['order_id'].'">
		<div class="table-responsive">
			<table class="table">
				<tr>
					<td>Total Amount:</td>
					<td>'.$obj->mOrderInfo['total_amount'].'</td>
				</tr>
				<tr>
					<td>Date Created: </td>
					<td>'.$obj->mOrderInfo['created_on'].'</td>
				</tr>
				<tr>
					<td>Date Shipped</td>
					<td>'.$obj->mOrderInfo['shipped_on'].'</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>';
						$disabled = '';
						if (!$obj->mEditEnabled) {
							$disabled = 'disabled';
						}
						echo '<select name="status" '.$disabled.'>';
							foreach($obj->mOrderStatusOptions as $key=>$value) {
								$status = '';
								if ($obj->mOrderInfo['status'] == $key) {
									$status = 'selected';
								}
								echo '<option value="'.$key.'" '.$status.'>'.$value.'</option>';
							}
						echo '</select>';
					echo '</td>
				</tr>
				<tr>
					<td>Comments: </td>
					<td>';
						$disabled = '';
						if (!$obj->mEditEnabled) {
							$disabled = 'disabled';
						}
						echo '<div class="form-group">
							<input type="text" name="comments" class="form-control" value="'.$obj->mOrderInfo['comments'].'" '.$disabled.'>
						</div>
					</td>
				</tr>
				<tr>
					<td>Customer Name:</td>
					<td>';
						$disabled = '';
						if (!$obj->mEditEnabled) {
							$disabled = 'disabled';
						}
						echo '<div class="form-group">
							<input type="text" name="cutomerName" class="form-control" value="'.$obj->mOrderInfo['customer_name'].'" '.$disabled.'>
						</div>
					</td>
				</tr>
				<tr>
					<td>Shipping Address:</td>
					<td>';
						$disabled = '';
						if (!$obj->mEditEnabled) {
							$disabled = 'disabled';
						}
						echo '<div class="form-group">
							<input type="text" name="shippingAddress" class="form-control" value="'.$obj->mOrderInfo['shipping_address'].'" '.$disabled.'>
						</div>
					</td>
				</tr>
				<tr>
					<td>Customer Email:</td>
					<td>';
						$disabled = '';
						if (!$obj->mEditEnabled) {
							$disabled = 'disabled';
						}
						echo '<div class="form-group">
							<input type="text" name="customerEmail" class="form-control" value="'.$obj->mOrderInfo['customer_email'].'" '.$disabled.'>
						</div>
					</td>
				</tr>
			</table>
		</div>
		
			<p>';
				$disabled = '';
				$label = '';
						if ($obj->mEditEnabled) {
							$disabled = 'disabled';
							$label = 'disabled';
						}
						else {
							$label = 'Edit';	
						}
				echo '<input type="submit" class="primary-button" name="submitEdit" value="'.$label.'" '.$disabled.'>&nbsp;';
				
				$disabled = '';
				$label = '';
						if (!$obj->mEditEnabled) {
							$disabled = 'disabled';
							$label = 'disabled';
						}
						else {
							$label = 'Update';	
						}
				echo '<input type="submit" class="primary-button" name="submitUpdate" value="'.$label.'" '.$disabled.'>&nbsp;';
				
				$disabled = '';
				$label = '';
						if (!$obj->mEditEnabled) {
							$disabled = 'disabled';
							$label = 'disabled';
						}
						else {
							$label = 'Cancel';	
						}
				echo '<input type="submit" class="primary-button" name="submitCancel" value="'.$label.'" '.$disabled.'>
			</p><div><br>
			
			<h3 class="text-center">Order contains these products</h3>
			<div class="container">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Unit Cost</th>
						<th>Subtotal</th>
					</tr>';
					for ($i=0; $i<count($obj->mOrderDetails); $i++) {
						echo '
						<tr>
							<td>'.$obj->mOrderDetails[$i]['product_id'].'</td>
							<td>'.$obj->mOrderDetails[$i]['product_name'].' ('.$obj->mOrderDetails[$i]['attributes'].')</td>
							<td>'.$obj->mOrderDetails[$i]['quantity'].'</td>
							<td>'.$obj->mOrderDetails[$i]['unit_cost'].'</td>
							<td>'.$obj->mOrderDetails[$i]['subtotal'].'</td>
						</tr>';
					}
				echo '</table><div>
			</div>
		
	</form>';
?>