// JavaScript Document
function showAlert(msg,flg){
	if(flg){ $("div.popup-alert p").append(msg); } else { $("div.popup-alert p").html(msg);	}
	if(!$("div.popup-alert:visible").length){ $("div.popup-alert").fadeIn(200); $("div.popup-alert").delay(1000).fadeOut(200); }
}

function checkPreAuth()
{
	if(!localStorage.getItem('email') && !localStorage.getItem('password'))
	{
			window.location = 'home.html';
	}
}

function handleLogin(email, password) 
{ 
   if(!localStorage.getItem('email') && !localStorage.getItem('password'))
   {
		var jemail = email;
		var jpassword = password;
		
		if(jemail != "" && jpassword != "")
		{			
			aUrl = "http://timeexamassing.wiseprm.com/ws/login.php?email="+jemail+"&password="+jpassword;			
			//alert(aUrl);
			$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					//alert(data);
					var StatusCode = data.StatusCode;					
					var ErrorMessage = data.ErrorMessage;
					//alert(StatusCode);
					if(StatusCode=="Success"){
					    var UID = data.Result[0].UID;
					    var uemail = data.Result[0].email;
					    var upassword = data.Result[0].password;
					    var phone = data.Result[0].phone;
					    var fname = data.Result[0].firstname;	
					    var lname = data.Result[0].lastname;
					    var classId = data.Result[0].class_id;
					    var notificationinterval = data.Result[0].inverval;
					    var userimage = data.Result[0].userimage;
					    var rollno = data.Result[0].roll_no;

						localStorage.setItem('email', uemail);
  						localStorage.setItem('password', upassword);
						localStorage.setItem('UID', UID);
						localStorage.setItem('phone', phone);
						localStorage.setItem('fname', fname);
  						localStorage.setItem('lname', lname);
  						localStorage.setItem('classId', classId);
  						localStorage.setItem('notificationinterval', notificationinterval);
  						localStorage.setItem('userimage', userimage);
  						localStorage.setItem('rollno', rollno);
						sendDeviceId(UID);

						window.location = 'home.html';											
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
		} else {
			alert("You must enter a username and password");
		}
   } else {
	   window.location = 'home.html';
   }
}

function sendDeviceId(UID)
{
	var deviceId = localStorage.getItem('deviceId');
	var deviceType = localStorage.getItem('deviceType');
	
	aUrl = "http://timeexamassing.wiseprm.com/ws/notification.php?userId="+UID+"&deviceRegisterId="+deviceId+"&deviceType="+deviceType;
	//alert(aUrl);
						  
		  $.ajax({
			  url:aUrl,
			  crossDomain: true,
			  dataType : 'jsonp',				
			  success: function(data){
				  return;							
			  }
		  });
   return;
}

function handleRegister(email, phone, password, confirmPassword)
{
	//alert(phone);
	var remail = email;
	var rphone = phone;
	var rpassword = password;
	var rcpassword = confirmPassword;
	var err = '';

	//alert(rcpassword+"-"+rphone+"-"+password+"-"+email);

   if (remail == '' || rphone == '' || rpassword == '' || rcpassword == '') 
    {
        err = err+"Please fill all fields...!!!!!!\n";
    } 
                
   if(isNaN(rphone)|| rphone.indexOf(" ")!=-1)
    {
        err = err+"Please enter a valid phone number\n";
    }
				                
  if (rpassword != rcpassword) 
    {
        err = err+"Your passwords don't match. Try again?\n";
    } 
	
	if(err != '')
	{
		alert(err);
	}
	else
	{
			
			aUrl = "http://timeexamassing.wiseprm.com/ws/registration.php?email="+remail+"&password="+rpassword+"&phone="+rphone;			
			//alert(aUrl);
			$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					//alert(data);
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);
					//var uid = $.trim(data.Result[0].UID);
					//alert(uid);
					if(StatusCode=="Success"){						    										
						handleLogin(remail, rpassword);											
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
	}
	
		
}

function handellogout() 
{
	localStorage.removeItem('email');
	localStorage.removeItem('password');
	localStorage.removeItem('UID');
	localStorage.removeItem('fname');
	localStorage.removeItem('lname');
	localStorage.removeItem('phone');
	localStorage.removeItem('classId');
	localStorage.removeItem('deviceId');
	
	window.location = 'index.html';	
}

function handelEditProfile(fname, lname, email, phone, userimage)
{
	//alert("hiiiiii");
	var UID = localStorage.getItem('UID');

    aUrl = "http://timeexamassing.wiseprm.com/ws/edit-profile.php?UID="+UID+"&email="+email+"&phone="+phone+"&firstname="+fname+"&lastname="+lname+"&userimage="+userimage;			
			
			$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);					

					if(StatusCode=="Success"){					    						    				
						localStorage.setItem('email', email);
						localStorage.setItem('fname', fname);
						localStorage.setItem('lname', lname);
						localStorage.setItem('phone', phone);
						localStorage.setItem('userimage', userimage);
						window.location = 'edit-profile.html';																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});

}

function handelAssignments()
{	
	var classId = localStorage.getItem('classId');
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/assignment.php?class_id="+classId;

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   //alert(obj.ID+"--"+obj.name);
						   output = output+"<li><div class='ui-li-thumb right'><img src='"+obj.img+"'></div><a href='#' data-transition='flip'>"+obj.name+"</a><p>Submission Date: "+obj.added_date+"</p><div class='exam-cont'><p>Description:</p><span>"+obj.decription+"</span></div></li>";
						});
						$(".exam-list").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});


}

function handelLatestEvents()
{
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/event.php";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<li class='ui-li-has-thumb ui-first-child'><a class='ui-btn ui-btn-icon-right ui-icon-carat-r' href='#'><img src='"+obj.img+"'><p>"+obj.date+"</p><h2>"+obj.description+"</h2><p><span class='ui-btn'>Read More</span></p></a></li>";
						});
						$("#latest").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handelUpcomingEvents()
{
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/upcoming-event.php";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<li class='ui-li-has-thumb ui-first-child'><a class='ui-btn ui-btn-icon-right ui-icon-carat-r' href='#'><img src='"+obj.img+"'><p>"+obj.date+"</p><h2>"+obj.description+"</h2><p><span class='ui-btn'>Read More</span></p></a></li>";
						});
						$("#upcoming").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handelPastEvents()
{
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/past-event.php";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<li class='ui-li-has-thumb ui-first-child'><a class='ui-btn ui-btn-icon-right ui-icon-carat-r' href='#'><img src='"+obj.img+"'><p>"+obj.date+"</p><h2>"+obj.description+"</h2><p><span class='ui-btn'>Read More</span></p></a></li>";
						});
						$("#past").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function getClassYear()
{
	var output = [];
	var classId = localStorage.getItem('classId');

	aUrl = "http://timeexamassing.wiseprm.com/ws/class.php";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   if(obj.CID==classId) { var activecls = "active"; }
						   output = output+"<li><a href='#' class='ui-btn ui-btn-icon-right ui-icon-carat-r "+activecls+"' onclick='handelClassYear("+obj.CID+")' id='tab"+obj.CID+"' data-index='"+obj.CID+"' name='year'>"+obj.class_title+"</a></li>";
						});
						$("#selectyear").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function getNotificationInterval()
{
	var output = [];
	var notificationinterval = localStorage.getItem('notificationinterval');

	aUrl = "http://timeexamassing.wiseprm.com/ws/interval.php";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   if(obj.ID==notificationinterval) { var activecls = "active"; }
						   output = output+"<li><a href='#' class='ui-btn ui-btn-icon-right ui-icon-carat-r "+activecls+"' id='"+obj.title+"' data-index='"+obj.ID+"' name='inverval' onclick='handelInterval(this.text)'>"+obj.title+"</a></li>";
						});
						$("#notificationInterval").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handelClassYear(classyear)
{
   var temyear = localStorage.getItem('tempyear');
   $("#tab"+temyear).removeClass("active");
   $("#tab"+classyear).addClass("active");
   localStorage.setItem('tempyear', classyear);
}

function handelInterval(interval)
{
   var tempinterval = localStorage.getItem('tempinterval');
   $("#"+tempinterval).removeClass("active");
   $("#"+interval).addClass("active");
   localStorage.setItem('tempinterval', interval);
}

function handelEditSetting(rollno)
{
	var UID = localStorage.getItem('UID');
	var interval = localStorage.getItem('tempinterval');
	var year = localStorage.getItem('tempyear');
	var srollno = rollno;

    aUrl = "http://timeexamassing.wiseprm.com/ws/edit-setting.php?class_id="+year+"&inverval="+interval+"&UID="+UID+"&roll_no="+srollno;

    $.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){	
					    var classId = data.Result[0].class_id;
					    var notificationinterval = data.Result[0].inverval;
					    var erollno = data.Result[0].roll_no;

						localStorage.setItem('classId', classId);
						localStorage.setItem('notificationinterval', notificationinterval);
						localStorage.setItem('rollno', erollno);
						window.location = 'settings.html';																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});

}

function handelupdatepassword(password)
{
	//alert(password);
	var UID = localStorage.getItem('UID');

	aUrl = "http://timeexamassing.wiseprm.com/ws/edit-password.php?password="+password+"&UID="+UID;

	 $.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){						    
						localStorage.setItem('password', password);
						alert("Your New Password Updated..!");
						window.location = 'settings.html';																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handelTheoryExam()
{
	var classId = localStorage.getItem('classId');
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/exam.php?class_id="+classId+"&exam_type=Theory%20Examination";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#theoryfreshexam").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});

	var boutput = [];

	bUrl = "http://timeexamassing.wiseprm.com/ws/exam-backlog.php?class_id="+classId+"&exam_type=Theory%20Examination";

	$.ajax({
				url:bUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   boutput = boutput+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#theorybacklogexam").html(boutput);																
					} else {
						//alert(ErrorMessage);
					}
					
				}
			});
}

function handelOnlineExam()
{
	var classId = localStorage.getItem('classId');
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/exam.php?class_id="+classId+"&exam_type=Online%20Examination";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#onlinefreshexam").html(output);																
					} else {
						//alert(ErrorMessage);
					}
					
				}
			});

	var boutput = [];

	bUrl = "http://timeexamassing.wiseprm.com/ws/exam-backlog.php?class_id="+classId+"&exam_type=Online%20Examination";

	$.ajax({
				url:bUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   boutput = boutput+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#onlinebacklogexam").html(boutput);																
					} else {
						//alert(ErrorMessage);
					}
					
				}
			});
}

function handelpracticalexam()
{
	var classId = localStorage.getItem('classId');
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/exam.php?class_id="+classId+"&exam_type=Practical%20Examination";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#practicalfreshexam").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});

	var boutput = [];

	bUrl = "http://timeexamassing.wiseprm.com/ws/exam-backlog.php?class_id="+classId+"&exam_type=Practical%20Examination";

	$.ajax({
				url:bUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   boutput = boutput+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#practicalbacklogexam").html(boutput);																
					} else {
						//alert(ErrorMessage);
					}
					
				}
			});
}

function handelOralsexam()
{
	var classId = localStorage.getItem('classId');
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/exam.php?class_id="+classId+"&exam_type=Orals";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#oralsfreshexam").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});

	var boutput = [];

	bUrl = "http://timeexamassing.wiseprm.com/ws/exam-backlog.php?class_id="+classId+"&exam_type=Orals";

	$.ajax({
				url:bUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   boutput = boutput+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#oralsbacklogexam").html(boutput);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handelinsemexam()
{
	var classId = localStorage.getItem('classId');
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/exam.php?class_id="+classId+"&exam_type=Insem";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<tr><td>"+obj.date+"</td><td>"+obj.time+"</td><td>"+obj.subject+"</td></tr>";
						});
						$("#insemfreshexam").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handelnotice()
{
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/notice.php";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){					    						    				
						$.each(data.Result, function(idx, obj) {
						   output = output+"<li class='ui-li-has-thumb'><a href='#' class='ui-btn ui-btn-icon-right ui-icon-carat-r'><img src='"+obj.img+"'><p>"+obj.date+"</p><h2>"+obj.description+"</h2><p><span class='ui-btn'>Read More</span></p></a></li>";
						});
						$("#notice").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handelhelp()
{
	var output = [];

	aUrl = "http://timeexamassing.wiseprm.com/ws/help.php";

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){						
						output = output+"<p>"+data.Result.description+"</p>";
						$("#help").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}

function handeldailytimetable()
{
	var classId = localStorage.getItem('classId');
	var output = [];
	var btime = "";

	aUrl = "http://timeexamassing.wiseprm.com/ws/timetable-daily.php?class_id="+classId;

	$.ajax({
				url:aUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){	
					   var ttime = "<tr><th>Time</th>";				    						    				
						$.each(data.Result.time, function(idx, obj) {
						   ttime = ttime+"<td>"+obj.frm_time+" - "+obj.to_time+"</td>";
						});
						output = ttime+"</tr>";						
						$.each(data.Result.details, function(idx, obj) {
							btime = btime+"<tr><th>"+idx+"</th>";
						   $.each(obj, function(idx, boj) {
							    if(boj.is_two_hour == 1) { 
							    	var cols = "colspan='2' class='pad0' "; 
								var fname = boj.firstname.split(",");
								var lname = boj.lastname.split(",");
								var rno = boj.room_no.split(",");
								var scode = boj.subject_code.split(",");

								var newtable="<table><tr><td>"+scode[0]+"<br>"+fname[0]+" "+lname[0]+"<br>("+rno[0]+")</td><td>"+scode[1]+"<br>"+fname[1]+" "+lname[1]+"<br>("+rno[1]+")</td><td>"+scode[2]+"<br>"+fname[2]+" "+lname[2]+"<br>("+rno[2]+")</td><td>"+scode[3]+"<br>"+fname[3]+" "+lname[3]+"<br>("+rno[3]+")</td></tr></table>"

						   		btime = btime+"<td "+cols+">"+newtable+"</td>";

							    }else{
						   		btime = btime+"<td "+cols+">"+boj.subject_code+"<br>"+boj.firstname+" "+boj.lastname+"<br>("+boj.room_no+")</td>";
						   		}
						   	});

						   btime = btime+"</tr>";
						});
						output = output+btime;
						$("#daily").html(output);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});


	bUrl = "http://timeexamassing.wiseprm.com/ws/timetable-weekly.php?class_id="+classId;
	var woutput = [];
	var wtime = "";

	$.ajax({
				url:bUrl,
				crossDomain: true,
				dataType : 'jsonp',				
				success: function(data){
					var StatusCode = $.trim(data.StatusCode);
					var ErrorMessage = $.trim(data.ErrorMessage);

					if(StatusCode=="Success"){	
					   var wttime = "<tr><th>Time</th>";				    						    				
						$.each(data.Result.time, function(idx, obj) {
						   wttime = wttime+"<td>"+obj.frm_time+" - "+obj.to_time+"</td>";
						});
						woutput = wttime+"</tr>";						
						$.each(data.Result.details, function(idx, obj) {
							wtime = wtime+"<tr><th>"+idx+"</th>";
						   $.each(obj, function(idx, boj) {
							   if(boj.is_two_hour == 1) {
						    	var cols = "colspan='2' class='pad0' "; 
								var fname = boj.firstname.split(",");
								var lname = boj.lastname.split(",");
								var rno = boj.room_no.split(",");
								var scode = boj.subject_code.split(",");

								var newtable="<table><tr><td>"+scode[0]+"<br>"+fname[0]+" "+lname[0]+"<br>("+rno[0]+")</td><td>"+scode[1]+"<br>"+fname[1]+" "+lname[1]+"<br>("+rno[1]+")</td><td>"+scode[2]+"<br>"+fname[2]+" "+lname[2]+"<br>("+rno[2]+")</td><td>"+scode[3]+"<br>"+fname[3]+" "+lname[3]+"<br>("+rno[3]+")</td></tr></table>"

						   		wtime = wtime+"<td "+cols+">"+newtable+"</td>";

							   }
							   else
						   		wtime = wtime+"<td "+cols+">"+boj.subject_code+"<br>"+boj.firstname+" "+boj.lastname+"<br>("+boj.room_no+")</td>";
						   	});

						   wtime = wtime+"</tr>";
						});
						woutput = woutput+wtime;
						$("#weekly").html(woutput);																
					} else {
						alert(ErrorMessage);
					}
					
				}
			});
}