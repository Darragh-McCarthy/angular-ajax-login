

<form action="/accounts/delete" method="POST">
	<label>Delete user by username
		<input type="text" name="username">
	</label>
	<input type="submit" value="Submit"/>
</form>


<form action="/accounts/passwordrecovery" method="POST">
	<label>Reset your password
		<input type="text" name="email">
	</label>
	<input type="submit" value="Submit"/>
</form>