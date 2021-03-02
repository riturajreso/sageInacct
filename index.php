<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/main.css"> 
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"> 
</head>
<body>
	<div class="nav-bar">
		<button class="tablink" onclick="openPage('Registration')" id="defaultOpen">Registration</button>
		<button class="tablink" onclick="openPage('viewStudent')" id="listStudent">Student List</button>
		<button class="tablink" onclick="openPage('Course')">Course</button>
		<button class="tablink" onclick="openPage('viewCourse')" id="listCourse">Course List</button>
		<button class="tablink" onclick="openPage('Subscribe')">Subscribe</button>
		<button class="tablink" onclick="openPage('Report')">Report</button>	
	</div>
	
	<div id="Registration" class="tabcontent">
		<h3>Registration</h3>
		<span id="regisMsg" class="error-display"></span>
		<div class="container">
			<div class="row diff">
			  <div class="col-sm-2"><label>First Name <span class="red">*</span></label></div>
			  <div class="col-sm-4">
			  	<input type="text" name="fname" id="fname" >
			  	<span class="red error-display fnameErr" id="fnameErr"></span>
			  </div>
			</div>
			<div class="row diff">
			  <div class="col-sm-2"><label>Last Name <span class="red">*</span></label></div>
			  <div class="col-sm-4">
			  	<input type="text" name="lname" id="lname" >
			  	<span class="red error-display lnameErr" id="lnameErr"></span>
			  </div>
			</div>
			<div class="row diff">
			  <div class="col-sm-2"><label>DOB <span class="red">*</span></label></div>
			  <div class="col-sm-4">
			  	<input type="date" name="dob" id="dob">
			  	<span class="red error-display dobErr" id="dobErr"></span>
			  </div>
			</div> 
			<div class="row diff">
			  <div class="col-sm-2"><label>Contact No <span class="red">*</span></label></div>
			  <div class="col-sm-4">
			  	<input type="text" name="phno" id="phno" onKeyPress="return isNumberKey(event)">
			  	<span class="red error-display phnoErr" id="phnoErr"></span>
			  </div>
			</div>
			<div class="row diff2">
			  <div class="col-sm-4">
			  	<center><input type="button" name="Submit" value="Submit" id='registration'></center>
			  </div>
			</div>    
		</div>
	</div>
	<div id="viewStudent" class="tabcontent">
		<h3>Student List</h3>
	    <div class="table-responsive">
          	<table class="table table-hover table-bordered" id="contents">
	            <thead>
	            	<tr>
	                <th>Edit Action</th>
		    		<th>First Name</th>
	                <th>Last Name</th>
		    		<th>Delete Action</th>
	              	</tr>
	            </thead>
            	<tbody id="studentListTBody"></tbody>
        	</table>
        </div>
	</div>
	<div id="Course" class="tabcontent">
		<h3>Course</h3>
		<span id="courseMsg" class="error-display"></span>
		<div class="container">
			<div class="row diff">
			  <div class="col-sm-2"><label>Course Name <span class="red">*</span></label></div>
			  <div class="col-sm-4">
			  	<input type="text" name="cname" id="cname">
			  	<span class="red error-display cnameErr" id="cnameErr"></span>
			  </div>
			</div>
			<div class="row diff">
			  <div class="col-sm-2"><label>Course Details </label></div>
			  <div class="col-sm-4">
			  	<textarea name="cDetail" id="cDetail"></textarea>
			  	<span class="red error-display cDetailErr" id="cDetailErr
			  	"></span>
			  </div>
			</div>
			<div class="row diff2">
			  <div class="col-sm-4">
			  	<center><input type="button" name="Submit" value="Submit" id='couserSubmit'></center>
			  </div>
			</div>    
		</div>
	</div>
	<div id="viewCourse" class="tabcontent">
		<h3>Course List</h3>
		<div class="table-responsive">
          	<table class="table table-hover table-bordered" id="contents">
	            <thead>
	            	<tr>
	                <th>Edit Action</th>
		    		<th>Course</th>
		    		<th>Delete Action</th>
	              	</tr>
	            </thead>
            	<tbody id="courseListTBody"></tbody>
        	</table>
        </div>
	</div>
	<div id="Subscribe" class="tabcontent">
		<h3>Student Course Registration</h3>
		<p>Get in touch, or swing by for a cup of coffee.</p>
	</div>
	<div id="Report" class="tabcontent">
		<h3>Report</h3>
		
	</div>
	<script type="text/javascript" src="./js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./js/main.js"></script>
</body>
</html>

