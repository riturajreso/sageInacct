$(document).ready(function(){
	$("#defaultOpen").click();
	clearRegistration();
	$("#registration").on('click',function(){
		var valid = ValidateStu();
		if(valid == 1)
		{
			var fname = $('#fname').val();
			var lname = $('#lname').val();
			var dob = $('#dob').val();
			var phno = $('#phno').val();
			$.ajax({
				url: "controller/Controller.php",
				type: 'POST',
				cache: false,
				data: {'fname':fname,'lname':lname,'dob':dob,'phno':phno,'function':'registration'}
			}).done(function(data){
				$('.error-display').text('').hide();
			}).fail(function(){
		    
		  	});
		}		
	});

	$("#couserSubmit").on('click',function(){
		//clearRegistration();
		//var valid = CousreValidation();
		var fname = $('#cname').val();
		$.ajax({
			url: "controller/Controller.php",
			type: 'POST',
			cache: false,
			data: {'fname':fname,'function':'registration'}
		}).done(function(data){
			$('.error-display').text('').hide();
		}).fail(function(){
	    
	  	});
	});
});

function ValidateStu()
{
	var valid = 1;
	if($('#fname').val() =='' || $('#fname').val() ==null || $('#fname').val() == undefined)
	{
		valid = 0;
		$("#fnameErr").text("Please enter first name").show();	
	}

	if($('#lname').val() =='' || $('#lname').val() ==null || $('#lname').val()==undefined)
	{
		valid = 0;
		$("#lnameErr").text("Please enter last name").show();
	}
	
	if($('#dob').val()=='' || $('#dob').val()==null || $('#dob').val()==undefined)
	{
		valid = 0;
		$("#dobErr").text("Please enter DOB").show();
	}

	if($('#phno').val()=='' || $('#phno').val()==null || $('#phno').val()==undefined)
	{
		valid = 0;
		$("#phnoErr").text("Please enter phone no.").show();
	}

	return valid;
}

function clearRegistration()
{
	$('.error-display').text('').hide();
	$('#fname').val('');
	$('#lname').val('');
	$('#dob').val('');
	$('#phno').val('');
	$('#cname').val('');
	$('#cDetail').val('');
}

function openPage(pageName) {
  clearRegistration();
  var i, tabcontent, tablinks;
  $('.tabcontent').each(function(){
    $(this).hide()
  });
  $('.tablink').each(function(){
    $(this).css("background-color", "")
  });
  $('#'+pageName).show();  
}


