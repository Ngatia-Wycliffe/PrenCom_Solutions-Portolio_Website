$(document).ready(function() {
			
			$('#contact').submit(function(e) {
			/* Act on the event */
			e.preventDefault();
			var formData = $(this).serialize();
			$.post("verify.php", formData, function(data) {
				/*optional stuff to do after success */

				$("#appear-box").html(data);
				$("#appear-box").fadeIn('slow');
				setTimeout(function(){
					$("#appear-box").slideDown('slow');
					$("#appear-box").fadeOut('slow');
				}, 3000);

			});


		});

			function deleteTask (task) {
				$.post("taskDelete.php", {taskId: task}, function (data) {
					/* body... */
					alert(data);
				});
			};
		});