$(document).ready(function() {

	function load_unseen_notifications(){
		var memberid  = $("#member").text();
		var processType = 1;
				 $.ajax({
				 	url: "fetch.php",
				 	method: "POST",
				 	data:{memberid : memberid, process : processType},
				 	success:function (data) {
				 		// /* body... */
				 		$("#newTab-3 ul").html(data);
				 		var count = $("#count-3").text();
				 			
				 		if (count!=0) {
				 			$("#badge-noti").text(count);
				 		}else{
				 			$("#badge-noti").text('');
				 		}
				 		
				 	}
				 });
	}

	function load_unseen_messages(){
		var memberid  = $("#member").text();
		var processType = 2;
				 $.ajax({
				 	url: "fetch.php",
				 	method: "POST",
				 	data:{memberid : memberid, process : processType},
				 	success:function (data) {
				 		// /* body... */
				 		$("#newTab-2 ul").html(data);
				 		var count = $("#count-2").text();
				 			
				 		if (count!=0) {
				 			$("#badge-msg").text(count);
				 		}else{
				 			$("#badge-msg").text('');
				 		}
				 		
				 	}
				 });
	}
	

	function taskAlert(){
		var memberid  = $("#member").text();
		var processType = 0;
				 $.ajax({
				 	url: "fetch.php",
				 	method: "POST",
				 	data:{memberid : memberid, process : processType},
				 	success:function (data) {
				 		// /* body... */
				 		$("#newTab-1 ul").html(data);
				 		var count = $("#count").text();
				 			
				 		if (count!=0) {
				 			$("#badge").text(count);
				 		}else{
				 			$("#badge").text('');
				 		}
				 		
				 	}
				 })

				 // alert(memberid);

	 }
	 taskAlert();

	 load_unseen_notifications();

	 load_unseen_messages();

	 $('html').click(function(event) {
				/* Act on the event */
				// if (!$('#myDropdown').is(':hidden')) {

					if(!event.target.matches('#newTask')){
						if(!$('#newTab-1').is(':hidden')){
							$("#newTab-1").hide();
							$('#newTab-1').removeClass('slideFromRight');
						}
					}
					if(!event.target.matches('#message')){
						if(!$('#newTab-2').is(':hidden')){
							$("#newTab-2").hide();
							$('#newTab-2').removeClass('slideFromRight');
						}
					}
					if(!event.target.matches('#notification')){
						if(!$('#newTab-3').is(':hidden')){
							$("#newTab-3").hide();
							$('#newTab-3').removeClass('slideFromRight');
						}
					}
				// }
			});

	$("#newTask").click(function(event) {
		$("#newTab-1").toggle();
		$("#newTab-1").toggleClass('slideFromRight');
	});
	$("#newTab-1").click(function(e) {
		e.stopPropagation();
	});
	// $("#message").click(function(event) {
	// 	$("#newTab-2").toggle();
	// 	$("#newTab-2").toggleClass('slideFromRight');
	// });
	
	$("#message").click(function(event) {
		
		$("#newTab-2").toggle();
		$("#newTab-2").toggleClass('slideFromRight');
		if($("#badge-msg").text() != ''){
			var count = parseInt($("#badge-msg").text());
			var memberid = $('#member').text();
			var processType = 2;
			if (count > 0) {
				 $.ajax({
				 	url: "update.php",
				 	method: "POST",
				 	data:{memberid : memberid, process : processType},
				 	success:function (data) {
				 		// /* body... */
				 		count = count-1;
						$("#badge-msg").text(count);
				 		
				 		}
				 });
			}else{
				$("#badge-msg").text('');
			}

		}
	});

	$("#newTab-2").click(function(e) {
		e.stopPropagation();
	});

	$("#notification").click(function(event) {
		$("#newTab-3").toggle();
		$("#newTab-3").toggleClass('slideFromRight');
		if($("#badge-noti").text() != ''){
			var count = parseInt($("#badge-noti").text());
			var memberid = $('#member').text();
			var processType = 1;
			if (count > 0) {
				 $.ajax({
				 	url: "update.php",
				 	method: "POST",
				 	data:{memberid : memberid, process : processType},
				 	success:function (data) {
				 		// /* body... */
				 		count = count-1;
						$("#badge-noti").text(count);
				 		
				 		}
				 });
			}else{
				$("#badge-noti").text('');
			}

		}
	});

	$("#newTab-3").click(function(e) {
		e.stopPropagation();
	});
			setInterval(function () {
				taskAlert();
			}, 3000);
			setInterval(function () {
				load_unseen_notifications();
			}, 3000);
			setInterval(function () {
				load_unseen_messages();
			}, 3000);


	


});

function accepted(taskID){
	// body... 
	var memberid  = $("#member").text();
	$.post('update.php', {taskID:taskID, memberid:memberid}, function(data) {
		/*optional stuff to do after success */
		$('#newtask-'+taskID).addClass('deleteEffect');
		$("#response-box").html('Task Accepted');
		$("#response-box").addClass('ascend1');
		$("#response-box").show();
		setTimeout(function () {
			/* body... */
			$("#response-box").fadeOut(1000);
			var count = parseInt($("#count").text());
			var newcount = count-1;
			$('#newtask-'+taskID).hide('slow');
			if(newcount == 0){
				$("#badge").text('');
			}else {
				$("#badge").text(newcount);
			}
			
		}, 500);
		

	});

	
}

function rejected(taskID){
	var memberid  = $("#member").text();
	$.post('taskRejected.php', {taskID:taskID, memberid:memberid}, function(data) {
		/*optional stuff to do after success */
		$('#newtask-'+taskID).addClass('deleteEffect-reverse');
		setTimeout(function () {
			/* body... */
			var count = parseInt($("#count").text());
			var newcount = count-1;
			$('#newtask-'+taskID).hide('slow');
			if(newcount == 0){
				$("#badge").text('');
			}else {
				$("#badge").text(newcount);
			}
			
		}, 500);
		

	});

}