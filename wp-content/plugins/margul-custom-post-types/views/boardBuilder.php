<span id="ajax-url"><?php echo admin_url( 'admin-ajax.php' ); ?></span>

<div class="row">

	<div class="col-xs-8 text-center preview-wrapper">
		<br><br><br><br><br><br><br><br>
		Here is where the preview will go
		<br><br><br><br><br><br><br><br>
	</div>

	
	<div class="col-xs-4">
		<form action="checkout.php" method="POST">
			<div class="builder-wrapper">
			
				<h3 class="text-center">Build your custom board</h3>

				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				 	<div class="panel panel-default">
				   		<div class="panel-heading" role="tab" id="headingOne">
				      		<h4 class="panel-title">
				        		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          			Board #<span class="board-nr">1</span>
				        		</a>
				      		</h4>
				    	</div>
				    	<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				      		<div class="panel-body">
			        			<div class="form-group">
			        				<label>Board Functionality</label>
			        				<select name="boards[0][functionality]" class="form-control board-func" data-id="0">
			        					<option value="blank">Blank</option>
			        					<option value="text">Text</option>
			        					<option value="accessory">Accessories</option>
			        				</select>
			        			</div>
			        			<div class="board-func-data"></div>
				      		</div>
				    	</div>
				  	</div>
				</div>
				<div id="addDiv">
					<button type="button" id="boardAdd" class="btn btn-info full-width">Add Board</button>
				</div>
			</div>

			<div class="builder-footer">
						Total Cost:
							<input type="text" style="width:100px; height:50px; font-size: 18px;" id="price" value="$3.50  " readonly>
							<input type="submit" class="btn btn-success pull-right" style="height:50px; width:125px; font-size: 18px;" value="Finish">
					<br><br>
					Coupon Code:
						<input type="text" style="width:150px;" id="couponTB">
						<button type="button" id="couponBtn" class="btn btn-info half-width">Enter</button>
			</div>	
		</form>
	</div>
</div>