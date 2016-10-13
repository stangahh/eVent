<form class="container" method="post" action="">
	<!-- Title -->
	<div class="row">
		<div class="input-field col m6 s12">
			<select class="browser-default" id="title" name="title">
				<?php foreach ($titlearray as $t): ?>
					<option value="<?php echo $t; ?>" <?php if($t == $usertitle){echo 'selected="selected"';} ?>><?php echo $t; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<!-- First Name -->
		<div class="input-field col m6 s12">
			<label for="fname" class="active">First Name</label>
			<input type="text" id="fname" name="fname" value="<?php echo $userfirstname; ?>">
		</div>

	<!-- Last Name -->
		<div class="input-field col m6 s12">
			<label for="lname" class="active">Last Name</label>
			<input type="text" id="lname" name="lname" value="<?php echo $userlastname; ?>">
		</div>

	<!-- Username -->
		<div class="input-field col m6 s12">
			<label for="username" class="active">Username</label>
			<input type="text" id="username" name="username" value="<?php echo $username; ?>">
		</div>

	<!-- Phone -->
		<div class="input-field col m6 s12">
			<label for="phone" class="active">Phone</label>
			<input type="text" id="phone" name="phone" value="<?php echo $userphone; ?>">
		</div>

	<!-- Address -->
		<div class="input-field col m6 s12">
			<label for="address" class="active">Address</label>
			<input type="text" id="address" name="address" value="<?php echo $useraddress; ?>">
		</div>

	<!-- DOB -->
		<div class="input-field col m6 s12">
			<label for="dob" class="datepicker active">Date of Birth</label>
			<input type="text" id="dob" name="dob" value="<?php echo $userdob; ?>">
		</div>

	<!-- Gender -->
		<div class="input-field col m6 s12">
			<select class="browser-default" id="sex" name="sex">
				<?php foreach ($genderarray as $g): ?>
					<option value="<?php echo $g; ?>" <?php if($g == $usersex){echo 'selected="selected"';} ?>><?php echo $g; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

	<!--Occupation -->
		<div class="input-field col m6 s12">
			<label for="occupation" class="active">Occupation</label>
			<input type="text" id="occupation" name="occupation" value="<?php echo $useroccupation; ?>">
		</div>

		<!-- Email -->
		<div class="input-field col m12 s12">
			<label for="email" class="active">Email Address</label>
			<input type="text" id="email" name="email" value="<?php echo $useremail; ?>">
		</div>
		
	<!-- Submit -->
	<div class="row">
		<button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit<i class="material-icons right">send</i></button>
	</div>
</form>
