$(document).ready(function(){
	$("#defaultOpen").click();
	clearRegistration();
	$("#registration").on('click',function(){
		$('.error-display').text('').hide();
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
						clearRegistration();
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
		$('.error-display').text('').hide();
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
						clearRegistration();
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
		$('.error-display').text('').hide();
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
				if(count>0)
				{
					for(var i=0; i < count ; i++){
						html += '<tr>';
						html += '<td>';
	        		    html += '<a href="#" class="edit_student" id="'+stuList[i].stu_id+'">Edit</a>';
	        			html += '</td>';

	        			html += '<td>';
	        		    html += stuList[i].stu_name;
	        			html += '</td>';

	        			html += '<td>';
	        		    html += stuList[i].stu_Lname;
	        			html += '</td>';
						
						html += '<td>';
						html += '<a href="#" class="delete_student icon-green" id="'+stuList[i].stu_id+'">Delete</a>';
	        			html += '</td>';
	        			html += '</tr>';        
					}	
				}
				else
				{
					html += '<span class="red">No records found.</span>';
				}
				$('#studentListTBody').html(html);
            	$('[data-toggle="tooltip"]').tooltip();
			}
		}).fail(function(){

		});
	});

	$("#listCourse").on('click',function(){
		$('.error-display').text('').hide();
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
			if(count>0)
			{
				for(var i=0; i < count ; i++){
					html += '<tr>';
					html += '<td>';
	    		    html += '<a href="#" class="edit_Course icon-green" id="'+courseList[i].cid+'">Edit</a>';
	    			html += '</td>';

	    			html += '<td>';
	    		    html += courseList[i].cname;
	    			html += '</td>';

	    			html += '<td>';
					html += '<a href="#" class=delete_Course icon-green" id="'+courseList[i].cid+'">Delete</a>';
	    			html += '</td>';
	    			html += '</tr>';        
				}
			}
			else
			{
				html += '<span class="red">No records found.</span>';
			}
			$('#courseListTBody').html(html);
        	$('[data-toggle="tooltip"]').tooltip();
		}).fail(function(){

		});
	});

	$("#subcribe").on('click',function(){
		$('.error-display').text('').hide();
		$.ajax({
			url: "controller/Controller.php",
			type: 'POST',
			cache: false,
			data: {'function':'getAllDetails'}
		}).done(function(data){
			var data = JSON.parse(data);
			var studentList  =  data.student;
			var courseList  =  data.course;
			var studentHtml = courseHtml = '<option value=""> Select </option>';
			if(studentList.length > 0)
			{
				for(var i=0; i<studentList.length;i++)
				{
					studentHtml += '<option value="'+studentList[i].stu_id+'">'+studentList[i].stu_name+' '+studentList[i].stu_Lname+'</option>';
				}
				$("#studentList").html(studentHtml);
			}
			else
			{
				$("#studentList").html(studentHtml);
				$("#stu_subErr").text('No records found.').show();
			}
			if(courseList.length > 0)
			{
				for(var i=0; i<courseList.length;i++)
				{
					courseHtml += '<option value="'+courseList[i].cid+'">'+courseList[i].cname+'</option>';
				}
				$("#courseList").html(courseHtml);
			}
			else
			{
				$("#courseList").html(courseHtml);
				$("#cour_subErr").text('No records found.').show();
			}
		});
	});

	$("#viewReport").on('click',function(){
		$('.error-display').text('').hide();
		$.ajax({
			url: "controller/Controller.php",
			type: 'GET',
			cache: false,
			data: {'function':'getReport'}
		}).done(function(data){
			var data = JSON.parse(data);
			console.log(data);
			var count = data.portal.result.length;
			var reportList  = data.portal.result;
			var html = '';
			if(count>0)
			{
				for(var i=0; i < count ; i++){
					html += '<tr>';
					
					html += '<td>';
	    		    html += reportList[i].Name;
	    			html += '</td>';

	    			html += '<td>';
	    		    html += reportList[i].cname;
	    			html += '</td>';

	    			html += '</tr>';        
				}
			}
			else
			{
				html += '<span class="red">No records found.</span>';
			}
			$('#reportListTBody').html(html);
        	$('[data-toggle="tooltip"]').tooltip();
		}).fail(function(){

		});		
	});

	$("#add").on('click',function(){
		$('.error-display').text('').hide();
		$("#studentList").val('');
		$("#courseList").val('');
	});
		
	$(document).on("click","#mapping",function(){
		$('.error-display').text('').hide();
		var sel_stu = $("#studentList").val();
		var sel_cor = $("#courseList").val();
		var valid = 1;
		if(sel_stu ==null || sel_stu== '' || sel_stu== undefined)
		{
			valid  = 0;
			$("#stu_subErr").text('Please select student.').show();
		}
		if(sel_cor ==null || sel_cor== '' || sel_cor== undefined)
		{
			valid  = 0;
			$("#cour_subErr").text('Please select course.').show();
		}
		if(valid == 1)
		{
			$.ajax({
				url: "controller/Controller.php",
				type: 'POST',
				cache: false,
				data: {'function':'saveMapping','sel_stu':sel_stu,'sel_cor':sel_cor}
			}).done(function(data){
				$('.error-display').text('').hide();
				if(JSON.parse(data))
				{
					var data =  JSON.parse(data);
					var err  = data.portal.err;
					var inserted  = data.portal.inserted;
					if(err == 0 && inserted == 1)
					{
						$('#mapping_msg').html('<b style="color : green">Successfully Added.</b>').show();
						$("#studentList").val('');
						$("#courseList").val('');
					}
					else if(err == 1 && inserted == 0)
					{
						var msg  = data.portal.msg;
						$('#mapping_msg').html('<b style="color : red">'+msg+'.</b>').show();	
					}
					else
					{
						var err_arr = data.portal.error_array_name;
						for (var [key, value] of Object.entries(err_arr)) {
							$('#'+key).text(value).show();
						}
					}
				}
			});	
		}
		
	});
	$(document).on("click",".delete_student",function(){
		$('.error-display').text('').hide();
		var stu_id = $(this).attr('id');
		$('#running_id').val(stu_id);
		$('#del_type_flag').val(1);
		$('#delete_req').modal('show');
	});

	$(document).on("click",".edit_student",function(){
		$('.error-display').text('').hide();
		var stu_id = $(this).attr('id');
		$('#edit_type_flag').val(1);
		$('#running_id').val(stu_id);
		$.ajax({
			url: "controller/Controller.php",
			type: 'GET',
			cache: false,
			data: {'stu_id': stu_id,'function':'editStudentList'}
		}).done(function(data){
			if(JSON.parse(data)){
				var data = JSON.parse(data);
				var result = data.portal.result;
				$('#efname').val(result[0].stu_name);
				$('#elname').val(result[0].stu_Lname);
			}
		});
		
		$('#editCourse').hide();
		$('#editStudent').show();
		$('#edit_req').modal('show');
	});

	$(document).on("click",".delete_Course",function(){
		$('.error-display').text('').hide();
		var c_id = $(this).attr('id');
		$('#running_id').val(c_id);
		$('#del_type_flag').val(2);
		$('#delete_req').modal('show');
	});

	$(document).on("click",".edit_Course",function(){
		$('.error-display').text('').hide();
		var c_id = $(this).attr('id');
		$('#edit_type_flag').val(2);
		$('#running_id').val(c_id);
		$.ajax({
			url: "controller/Controller.php",
			type: 'GET',
			cache: false,
			data: {'c_id': c_id,'function':'editCourse'}
		}).done(function(data){
			if(JSON.parse(data)){
				var data = JSON.parse(data);
				var result = data.portal.result;
				$('#eCname').val(result[0].cname);
			}
		});
		$('#editStudent').hide();
		$('#editCourse').show();
		$('#edit_req').modal('show');
	});

	$(document).on("click","#delconfrimYes",function(){
		$('.error-display').text('').hide();
		var type_flag  = $('#del_type_flag').val();
		var id  = $('#running_id').val();
		if(type_flag == 2)
		{
			$.ajax({
				url: "controller/Controller.php",
				type: 'POST',
				cache: false,
				data: {'id': id, 'function':'delCourse'}
			}).done(function(data){
				var data = JSON.parse(data);
				var update  = data.portal.update;
				var err  = data.portal.err;
				if(update == 1 && err == 0)
				{
					$('#delete_req').modal('hide');
					$('#listCourse').trigger('click');
				}
			});
		}
		else if(type_flag == 1)
		{
			$.ajax({
				url: "controller/Controller.php",
				type: 'POST',
				cache: false,
				data: {'id': id, 'function':'delStudent'}
			}).done(function(data){
				var data = JSON.parse(data);
				var update  = data.portal.update;
				var err  = data.portal.err;
				if(update == 1 && err == 0)
				{
					$('#delete_req').modal('hide');
					$('#listStudent').trigger('click');
				}	
			});
		}
	});

	$(document).on("click","#editconfrimYes",function(){
		$('.error-display').text('').hide();
		var type_flag  = $('#edit_type_flag').val();
		var id  = $('#running_id').val();
		if(type_flag == 2)
		{
			var valid = 1;
			if($('#eCname').val() =='' || $('#eCname').val() ==null || $('#eCname').val() == undefined)
			{
				valid = 0;
				$("#eCnameErr").text("Please enter course name").show();	
			}
			if(valid==1)
			{
				var eCname = $('#eCname').val();
				$.ajax({
					url: "controller/Controller.php",
					type: 'POST',
					cache: false,
					data: {'id': id, 'eCname':eCname,'function':'updateCourse'}
				}).done(function(data){
					if(JSON.parse(data))
					{
						var data = JSON.parse(data);
						var update  = data.portal.update;
						var err  = data.portal.err;
						if(update == 1 && err == 0)
						{
							$('#edit_req').modal('hide');
							$('#listCourse').trigger('click');
						}
						else
						{
							var err_arr = data.portal.error_array_name;
							for (var [key, value] of Object.entries(err_arr)) {
								$('#'+key).text(value).show();
							}
						}
					}
				})	
			}			
		}
		else if(type_flag == 1)
		{
			var valid = 1;
			if($('#efname').val() =='' || $('#efname').val() ==null || $('#efname').val() == undefined)
			{
				valid = 0;
				$("#efnameErr").text("Please enter first name").show();	
			}

			if($('#elname').val() =='' || $('#elname').val() ==null || $('#elname').val() == undefined)
			{
				valid = 0;
				$("#elnameErr").text("Please enter last name").show();	
			}
			if(valid==1)
			{
				var efname = $('#efname').val();
				var elname = $('#elname').val();
				$.ajax({
					url: "controller/Controller.php",
					type: 'POST',
					cache: false,
					data: {'id': id,'efname':efname,'elname':elname,'function':'updateStudent'}
				}).done(function(data){
					if(JSON.parse(data))
					{
						var data = JSON.parse(data);
						var update  = data.portal.update;
						var err  = data.portal.err;
						if(update == 1 && err == 0)
						{
							$('#edit_req').modal('hide');
							$('#listStudent').trigger('click');
						}
						else
						{
							var err_arr = data.portal.error_array_name;
							for (var [key, value] of Object.entries(err_arr)) {
								$('#'+key).text(value).show();
							}
						}
					}
				})	
			}
		}
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

function openPage(pageName,id) {
  clearRegistration();
  
  var tabcontent, tablinks;
  $('.tabcontent').each(function(){
    $(this).hide()
  });
  $('.tablink').each(function(){
    $(this).css("background-color", "")
  });
  $('#'+pageName).show();
  $('#'+id).css("background-color", "red");  
}


