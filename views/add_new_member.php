<div class="wrap">
	<h1 id="add-new-user">
		Add New Member
	</h1>

	<?php if (!empty($_SESSION['message'])): ?>
		<div><?php echo $_SESSION['message']; ?></div>
		<?php unset($_SESSION['message']);?>
	<?php endif;?>


	<form method="post" name="createuser" action="<?php echo plugins_url('../scripts/member_store.php', __FILE__); ?>" id="createuser" class="validate">
		<table class="form-table" role="presentation">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="name">Name</label>
					</th>
					<td>
						<input name="name" type="text" id="name" value="" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="f_name">Father name</label>
					</th>
					<td>
						<input name="f_name" type="text" id="f_name" value="" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="mobile">Mobile</label>
					</th>
					<td>
						<input name="mobile" type="text" id="mobile" value="" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required>
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="status">Status</label>
					</th>
					<td>
						<select name="status" id="status" required>
							<option value="1">Died</option>
							<option value="2">Retired</option>
							<option value="3">Active</option>
						</select>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="comments">Comments</label>
					</th>
					<td>
						<textarea name="comments" id="comments" value="" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60"></textarea>
					</td>
				</tr>
			</tbody>
		</table>


		<p class="submit">
			<input type="submit" name="save" id="save" class="button button-primary" value="Save">
		</p>
	</form>
</div>

<div class="clear"></div>
<style type="text/css">
	/* Desktop Styles */
	@media only screen and (min-width: 961px) {
		#comments  {
			width: 38%;
		}

		#save{
			margin-left: 520px;
		}
	}
</style>