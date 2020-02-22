<div class="wrap">
	<h1 id="add-new-user">
		Update Member
	</h1>

	<?php if (!empty($_SESSION['message'])): ?>
		<div><?php echo $_SESSION['message']; ?></div>
		<?php unset($_SESSION['message']);?>
	<?php endif;?>

	<form method="post" name="createuser" action="<?php echo plugins_url('../scripts/member.php', __FILE__); ?>" id="createuser" class="validate">
		<table class="form-table" role="presentation">
			<tbody>
				<tr class="form-field form-required">
					<input type="hidden" name="id" value="<?php echo $data->id; ?>">
					<th scope="row">
						<label for="name">Name</label>
					</th>
					<td>
						<input name="name" type="text" id="name" value="<?php echo $data->name; ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="f_name">Father name</label>
					</th>
					<td>
						<input name="f_name" type="text" id="f_name" value="<?php echo $data->father_name; ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="mobile">Mobile</label>
					</th>
					<td>
						<input name="mobile" type="text" id="mobile" value="<?php echo $data->mobile; ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required>
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="status">Status</label>
					</th>
					<td>
						<select name="status" id="status" required>
							<option <?php if ($data->status == 1) {echo "selected";}?> value="1">Died</option>
							<option <?php if ($data->status == 2) {echo "selected";}?> value="2">Retired</option>
							<option <?php if ($data->status == 3) {echo "selected";}?> value="3">Active</option>
						</select>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="comments">Comments</label>
					</th>
					<td>
						<textarea name="comments" id="comments" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60"><?php echo $data->description; ?></textarea>
					</td>
				</tr>
			</tbody>
		</table>


		<p class="submit">
			<input type="submit" name="update" id="update" class="button button-primary" value="Update">
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

		#update{
			margin-left: 520px;
		}
	}
</style>