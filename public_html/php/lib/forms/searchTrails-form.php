<!-------------------------------------------------------->
<!-- This is the search for trails form for the Trail Quail website -->
<!-- 																	  -->
<!-- @author saulj@me.com  (December 2015)  				  -->
<!-------------------------------------------------------->

<!-- The div class="form-wrap" is the black box containing the form. It's set to a column width of 12 for small screens, and a column width of 6 for medium screens on up -->

<div class="form-wrap">

	<!-- Form is centered within it's container, and is set to 10 be columns wide RELATIVE TO IT'S CONTAINER, and offset to the right by one column. See classes: col-xs-offset-1 & col-xs-10 -->
	<form method="post" action="#" id="searchTrails-form" class="form-horizontal">

		<div class="form-group">
			<!-- Labels for each field are places within a <label> tag. Use the "for" attribute. the class="control-label" is for styling. -->
			<label for="searchTrailName" class="control-label">Trail Name</label>
			<!-- the div class="input-group" contains both the text field and the icon to the left -->
			<div class="input-group">
				<!-- this div and span contains the glyphicon to the left. aria-hidden is so that screen readers don't read this element -->
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
				</div>
				<!-- text field input. pay attention to the id, placeholder text, type, and placeholder attributes -->
				<input type="text" class="form-control" id="searchTrailName" placeholder="If you know the trail name, enter here." maxlength="150"/>
			</div>
		</div>

		<br>
		<!--	Pick a minimum trail difficulty from easy (1) to hard (5)	-->
		<div>Trail Difficulty (Easy 1 <--> 5 Hard)</div>
		<div class="form-group">
			<!-- Labels for each field are places within a <label> tag. Use the "for" attribute. the class="control-label" is for styling. -->
			<label for="searchTrailDifficlty" class="control-label">Maximum Difficulty</label>
			<!-- the div class="input-group" contains both the text field and the icon to the left -->
			<div class="input-group">
				<!-- this div and span contains the glyphicon to the left. aria-hidden is so that screen readers don't read this element -->
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
				</div>
				<!-- text field input. pay attention to the id, placeholder text, type, and placeholder attributes -->
				<input type="int" class="form-control" id="searchTrailDifficulty" placeholder="  " maxlength="1"/>
			</div>
		</div>

		<br>
		<!--	Pick a minimum trail distance	-->
		<div>Trail Distance (Easy 1 <--> 5 Hard)</div>
		<div class="form-group">
			<!-- Labels for each field are places within a <label> tag. Use the "for" attribute. the class="control-label" is for styling. -->
			<label for="searchTrailDistance" class="control-label">Minimum Distance</label>
			<!-- the div class="input-group" contains both the text field and the icon to the left -->
			<div class="input-group">
				<!-- this div and span contains the glyphicon to the left. aria-hidden is so that screen readers don't read this element -->
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
				</div>
				<!-- text field input. pay attention to the id, placeholder text, type, and placeholder attributes -->
				<input type="int" class="form-control" id="searchTrailDistance" placeholder="  " maxlength="1"/>
			</div>
		</div>

		<br>
		<!--	Choose what you might want to do on a trail	-->
		<div class="form-group">
			<label class="control-label">Trail Use:</label>
			<!--	use div class="help-block" to explain the form content	-->
			<div class="help-block">Please check all that apply</div>
			<div class="checkbox">
				<label class="checkbox">
					<!--	name value contains square brackets which makes it easy to create an array on the back end in php	-->
					<Input id="chkTrailUseHike" name="chkTrailUse[]" type="checkbox" value="Hike" />Hike
				</label>
				<label class="checkbox">
					<Input id="chkTrailUseBike" name="chkTrailUse[]" type="checkbox" value="Bike" />Bike
				</label>
				<label class="checkbox">
					<Input id="chkTrailUseWheelChair" name="chkTrailUse[]" type="checkbox" value="Wheelchair" />Wheelchair
				</label>
				<label class="checkbox">
					<Input id="chkTrailUseSki" name="chkTrailUse[]" type="checkbox" value="Ski" />Ski
				</label>
				<label class="checkbox">
					<Input id="chkTrailUseHorse" name="chkTrailUse[]" type="checkbox" value="Horse" />Horse
				</label>
			</div>
		</div>

		<!-- buttons for submit and reset -->
		<button class="btn btn-md btn-info" type="submit">Log in</button>
		<button class="btn btn-md btn-warning" type="reset">Reset</button>

</div>