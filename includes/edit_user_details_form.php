<form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="">
	<!-- Title -->
	<div class="row">
		<div class="input-field col s12">
			<select class="browser-default" id="title" name="title">
				<?php foreach ($titlearray as $t): ?>
					<option value="<?php echo $t; ?>" <?php if($t == $GLOBALS['title']){echo 'selected="selected"';} ?>><?php echo $t; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<!-- First Name -->
	<div class="row">
		<div class="input-field col s12">
			<label for="fname" class="active">First Name</label>
			<input type="text" id="fname" name="fname" value="<?php echo $GLOBALS['first_name']; ?>">
		</div>
	</div>

	<!-- Last Name -->
	<div class="row">
		<div class="input-field col s12">
			<label for="lname" class="active">Last Name</label>
			<input type="text" id="lname" name="lname" value="<?php echo $GLOBALS['last_name']; ?>">
		</div>
	</div>

	<!-- Username -->
	<div class="row">
		<div class="input-field col s12">
			<label for="username" class="active">Username</label>
			<input type="text" id="username" name="username" value="<?php echo $GLOBALS['username']; ?>">
		</div>
	</div>

	<!-- Phone -->
	<div class="row">
		<div class="input-field col s12">
			<label for="phone" class="active">Phone</label>
			<input type="text" id="phone" name="phone" value="<?php echo $GLOBALS['phone']; ?>">
		</div>
	</div>

	<!-- Address -->
	<div class="row">
		<div class="input-field col s12">
			<label for="address" class="active">Address</label>
			<input type="text" id="address" name="address" value="<?php echo $GLOBALS['address']; ?>">
		</div>
	</div>

	<!-- DOB -->
	<div class="row">
		<div class="input-field col s12">
			<label for="dob" class="datepicker active">Date of Birth</label>
			<input type="text" id="dob" name="dob" value="<?php echo $GLOBALS['DOB']; ?>">
		</div>
	</div>

	<!-- Gender -->
	<div class="row">
		<div class="input-field col s12">
			<select class="browser-default" id="sex" name="sex">
				<?php foreach ($genderarray as $g): ?>
					<option value="<?php echo $g; ?>" <?php if($g == $GLOBALS['sex']){echo 'selected="selected"';} ?>><?php echo $g; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<!-- Email -->
	<div class="row">
		<div class="input-field col s12">
			<label for="email" class="active">Email Address</label>
			<input type="text" id="email" name="email" value="<?php echo $GLOBALS['email']; ?>">
		</div>
	</div>

	<!--Occupation -->
	<div class="row">
		<div class="input-field col s12">
			<label for="occupation" class="active">Occupation</label>
			<input type="text" id="occupation" name="occupation" value="<?php echo $GLOBALS['occupation']; ?>">
		</div>
	</div>

	<!-- Submit -->
	<button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit<i class="material-icons right">send</i></button>
</form>