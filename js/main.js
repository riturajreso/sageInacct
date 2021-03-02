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
				data: {'fname':fname,'lname':lname,'dob':dob,'phno':phno,'function':'StudentRegistration'}
			}).done(function(data){
				$('.error-display').text('').hide();
				if(JSON.parse(data))
				{
					var data =  JSON.parse(data);
					var err  = data.portal.err;
					var inserted  = data.portal.inserted;
					if(err == 0 && inserted == 1)
					{
						$('#regisMsg').html('<b style="color : green">Successfully Added.</b>').show();
					}
					else if(err == 1 && inserted == 0)
					{
						var msg  = data.portal.msg;
						$('#regisMsg').html('<b style="color : red">'+msg+'.</b>').show();	
					}
					else
					{
						var err_arr = data.portal.error_array_name;
						for (var [key, value] of Object.entries(err_arr)) {
							$('#'+key).text(value).show();
						}
					}
				}
			}).fail(function(){
		    
		  	});
		}		
	});

	$("#couserSubmit").on('click',function(){
		var valid = ValidateCourse();
		if(valid == 1)
		{
			var cname = $('#cname').val();
			var cDetail = $('#cDetail').val();
			$.ajax({
				url: "controller/Controller.php",
				type: 'POST',
				cache: false,
				data: {'cname':cname,'cDetail':cDetail,'function':'CourseRegistration'}
			}).done(function(data){
				$('.error-display').text('').hide();
				if(JSON.parse(data))
				{
					var data =  JSON.parse(data);
					var err  = data.portal.err;
					var inserted  = data.portal.inserted;
					if(err == 0 && inserted == 1)
					{
						$('#courseMsg').html('<b style="color : green">Successfully Added.</b>').show();
					}
					else if(err == 1 && inserted == 0)
					{
						var msg  = data.portal.msg;
						$('#courseMsg').html('<b style="color : red">'+msg+'.</b>').show();	
					}
					else
					{
						var err_arr = data.portal.error_array_name;
						for (var [key, value] of Object.entries(err_arr)) {
							$('#'+key).text(value).show();
						}
					}
				}
			}).fail(function(){
		    
		  	});
		}		
	});

	$("#listStudent").on('click',function(){
		$.ajax({
			url: "controller/Controller.php",
			type: 'GET',
			cache: false,
			data: {'function':'getStudentList'}
		}).done(function(data){
			if(JSON.parse(data)){
				var data = JSON.parse(data);
				var count = data.portal.result.length;
				var stuList  = data.portal.result;
				var html = '';
				for(var i=0; i < count ; i++){
					html += '<tr>';
					html += '<td>';
        		    html += '<span data-toggle="tooltip"  data-trigger="hover" data-placement="top" title="Edit"><a href="#" class="edit_lazarusDL icon-green" id="'+stuList[i].stu_id+'"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a></span>';
        			html += '</td>';

        			html += '<td>';
        		    html += stuList[i].stu_name;
        			html += '</td>';

        			html += '<td>';
        		    html += stuList[i].stu_Lname;
        			html += '</td>';
					
					html += '<td>';
					html += '<span data-toggle="tooltip"  data-trigger="hover" data-placement="top" title="Delete"><a href="#" class="edit_lazarusDL icon-green" id="'+stuList[i].stu_id+'"><span aria-hidden="true" class="glyphicon glyphicon-trash"></span></a></span>';
        			html += '</td>';
        			html += '</tr>';        
				}
				$('#studentListTBody').append(html);
            	$('[data-toggle="tooltip"]').tooltip();
			}
		}).fail(function(){

		});
	});

	$("#listCourse").on('click',function(){
		$.ajax({
			url: "controller/Controller.php",
			type: 'GET',
			cache: false,
			data: {'function':'getCourseList'}
		}).done(function(data){
			var data = JSON.parse(data);
			var count = data.portal.result.length;
			var courseList  = data.portal.result;
			var html = '';
			for(var i=0; i < count ; i++){
				html += '<tr>';
				html += '<td>';
    		    html += '<span data-toggle="tooltip"  data-trigger="hover" data-placement="top" title="Edit"><a href="#" class="edit_lazarusDL icon-green" id="'+courseList[i].stu_id+'"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a></span>';
    			html += '</td>';

    			html += '<td>';
    		    html += courseList[i].cname;
    			html += '</td>';

    			html += '<td>';
				html += '<span data-toggle="tooltip"  data-trigger="hover" data-placement="top" title="Delete"><a href="#" class="edit_lazarusDL icon-green" id="'+courseList[i].stu_id+'"><span aria-hidden="true" class="glyphicon glyphicon-trash"></span></a></span>';
    			html += '</td>';
    			html += '</tr>';        
			}
			$('#courseListTBody').append(html);
        	$('[data-toggle="tooltip"]').tooltip();
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

function ValidateCourse()
{
	var valid = 1;
	if($('#cname').val() =='' || $('#cname').val() ==null || $('#cname').val() == undefined)
	{
		valid = 0;
		$("#cnameErr").text("Please enter course name").show();	
	}
	return valid;
}

function isNumberKey(e){
    var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode == 8 || (e.which == 0  && charCode == 46) || charCode == 9 || (charCode >= 48 && charCode <= 57) || (e.shiftKey == false && charCode == 37) || (e.which == 0  && charCode == 39) || (e.shiftKey == false && charCode == 36) || (e.shiftKey == false && charCode == 35) || (e.shiftKey == false && charCode == 118) || (e.shiftKey == false && charCode == 86)){
		if(charCode == 118 || charCode == 86)
		{
			return false;
		}
		else
		{
			return true;
		}          
	}
	else{
			return false;
		}
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


