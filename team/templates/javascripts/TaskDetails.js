
function alterDetail(detail){
				var column = '';
				var value = '';
				switch (detail) {
					case 1:
						column = 'due_date';
						value = $("#due").val();
						break;
					case 2:
						column = 'comment';
						value = $("#comments").val();
						break;
					default:
						// statements_def
						break;
				}
				// var task = <?php echo $taskID; ?>;
				var formData =new FormData();
				formData.append('task', task);
				formData.append('column', column);
				formData.append('value', value);
				$.ajax({
					url:"alterTask.php",
					type: "POST",
					data:formData,
					contentType: false,
					cache: false,//to unable request page to be cached
					processData: false,//To send DOMDocument or non processed datafile if it is set to false
					success: function (response) {
						switch (detail) {
							case 1:
								var formattedDate = moment(value);
								due = formattedDate.format("MMM Do YYYY");
								unformattedDate = formattedDate.format("YYYY-MM-DD");
								$('#edit-'+detail).show();
								$('#save-'+detail).hide();
								$('#due').attr('disabled', true);
								$('#due').attr('type', 'text');
								$('#due').css('border','none');
								$("#response-box").addClass('ascend1');
								$("#response-box").show();
								setTimeout(function(){
									$("#response-box").fadeOut(1000);
									}, 1500);
								break;
							case 2:
								comments =value;
								$('#edit-'+detail).show();
								$('#save-'+detail).hide();
								$('#comments').attr('disabled', true);
								$('#comments').css('border','none');
								$("#response-box").addClass('ascend1');
								$("#response-box").show();
								setTimeout(function(){
									$("#response-box").fadeOut(1000);
									}, 1500);
								break;
							default:
								// statements_def
								break;
						}
					}

				});
			};
		

			var created = 0;
			var input = document.getElementById('comments');
			var textarea = document.createElement('textarea');
			var due = $("#due").val();
			var unformattedDate = $("#due").val();
			var comments = $("#comments").val();
			var others = $("#others").val();
			var originals = $("#membSelect").html();
			$('input[type=date]').click(function(event) {
				event.stopPropagation();
			});
			$('textarea').click(function(event) {
				event.stopPropagation();
			});
			$('input[type=text]').click(function(event) {
				event.stopPropagation();
			});

			$('html').click(function(event) {
				/* Act on the event */
				// if (!$('#myDropdown').is(':hidden')) {
					if(!event.target.matches('button')){

						$('#detail input').each(function(index, el) {
							$(this).attr('disabled', true);
							$(this).css('border','none');
							$('#detail .btn-outline-info').show();
							$('#detail .btn-outline-success').hide();
							var id = this.id;
							switch (id) {
								case 'due':
									$('#due').attr('type', 'text');
									var formattedDate = moment(unformattedDate);
									$(this).val(formattedDate.format("MMM Do YYYY"));
									break;
								case 'comments':
									$(this).val(comments);
									break;
								case 'others':
									$(this).val(others);
									break;
								default:
									// statements_def
									break;
							}
						});
						
					}
				// }
			});


			function edit(detail){
				switch (detail) {
					case 1:
						$('#due').attr('disabled', false);
						$('#due').attr('type', 'date');
						$('#due').css('border','2px solid lightgrey');
						$('#edit-'+detail).hide();
						$('#save-'+detail).show();
						break;
					case 2:
						$('#comments').attr('disabled', false);
						$('#comments').css('border','2px solid lightgrey');
						$('#edit-'+detail).hide();
						$('#save-'+detail).show();
						break;
					case 3:
						$('#others').attr('disabled', false);
						$('#others').css('border','2px solid lightgrey');
						$('#edit-'+detail).hide();
						$('#save-'+detail).show();
						break;
					default:
						// statements_def
						break;
				}
			}

			function selected(){
				var copy = $("#viewspace").html();
				$("#membSelect").html(copy);
				$("#myModal").fadeOut('6000');
				$(".modal-content").slideUp('5000');
				$("#viewspace").html('');
				$('#Reassign').show();
				$('#cancelChange').show();
				
			}
			function clearViewspace(){
				$("#myModal").fadeOut('6000');
				$(".modal-content").slideUp('5000');
				$("#viewspace").html('');
			}

			function cancelChange(){
				$('#Reassign').hide();
				$('#cancelChange').hide();
				$("#membSelect").html(originals);
			}

			function reAssign(){
				var newSelected = $('#membSelect values').map(function(){
               								return $.trim($(this).text());
            							}).get();
				var processType = 1;
				// var taskID = <?php echo $taskID ?>;
				var formData = new FormData();
				formData.append('members', newSelected);
				formData.append('processType', processType);
				formData.append('task', task);
				$.ajax({
					url:"taskAssign.php",
					type: "POST",
					data:formData,
					contentType: false,
					cache: false,//to unable request page to be cached
					processData: false,//To send DOMDocument or non processed datafile if it is set to false
					success: function (response) {
						
						$('#Reassign').hide();
						$('#cancelChange').hide();
						originals = $("#membSelect").html();
						$("#response-box").addClass('ascend1');
						$("#response-box").show();
						deleteAssignee();	
						setTimeout(function(){
							$("#response-box").fadeOut(1000);
							}, 1500);				
					}

				});
			}
			function preCheck(){
				var preSelected = $('#membSelect values').map(function(){
               								return $.trim($(this).text());
            							}).get();
				$.each(preSelected, function(index, el) {
					$('#isMemberSelected-'+el).prop('checked', 'true');
					memberSelected(el);
				});
			}
			function deleteAssignee(){
				var unassigned = $('#viewspace1 delete').map(function(){
               								return $.trim($(this).text());
            							}).get();
				var unSelected = [];
				$('#myModal input').each(function(index, el) {
					if (!this.checked) {
						var id = $(this).attr("identify");
						unSelected.push(id);
					}
				});
				var formData =new FormData();
				formData.append('members', unSelected);
				formData.append('task', task);
				$.ajax({
					url:"deleteAssignee.php",
					type: "POST",
					data:formData,
					contentType: false,
					cache: false,//to unable request page to be cached
					processData: false,//To send DOMDocument or non processed datafile if it is set to false
					success: function (response) {
						$("#myModal").fadeOut('6000');
						$(".modal-content").slideUp('5000');
						$("#viewspace").html('');
					}

				});
			}
			function memberSelected(member){
					if (document.getElementById('isMemberSelected-'+ member).checked) {
						$.post('selected.php', {memberId: member}, function(data) {
						/*optional stuff to do after success */
						document.getElementById('viewspace').innerHTML += '<members class="Selected" id="pic-'+ member +'" ><img src="templates/pics/'+ data + '"class="selected img-thumbnail rounded-circle p-0" alt=""><values class="mem">'+member+'</values></members>';

						});
						$('delete').remove('#pic-' + member);
					}else {
						document.getElementById('viewspace1').innerHTML += '<delete class="mem" id="pic-'+ member +'">'+member+'</delete>';
						$('members').remove('#pic-' + member);
					}
				}

	$('#uploadFiles').submit(function(e) {
		/* Act on the event */
		e.preventDefault();
		var formData = new FormData(this);
		formData.append('taskid',task);
		$.ajax({
				url:"uploadFile.php",
				type: "POST",
				data:formData,
				contentType: false,
				cache: false,//to unable request page to be cached
				processData: false,//To send DOMDocument or non processed datafile if it is set to false
				success: function (response) {
					alert(response);
						// $('#uploadAction').animate({top: '-100%'}, 1000);
						// $('#uploadOverlay').fadeOut();
						// $("#response-box").addClass('ascend1');
						// $("#response-box").text(response);
						// $("#response-box").show();
						// setTimeout(function(){
						// 	$("#response-box").fadeOut(1000);
						// 	}, 1500);

					}

					});
	});

	$('#subtaskform').submit(function(e) {
			/* Act on the event */
			e.preventDefault();
			var formData = new FormData(this);
			var processType = 1;
			formData.append('taskid', task);
			formData.append('process', processType);
			$.ajax({
				url:"newtask.php",
				type: "POST",
				data:formData,
				contentType: false,
				cache: false,//to unable request page to be cached
				processData: false,//To send DOMDocument or non processed datafile if it is set to false
				success: function (data) {

					$('#create-'+created).removeClass('slideToappear');
					created++;
					var taskname = $('#taskname').val();
					$('#subtaskform')[0].reset();
					$("#response-box").html(data);
					$("#response-box").addClass('ascend');
					$("#response-box").show();
					var ID = $('#response-box value').html();
					var createdID = parseInt(ID);
					document.getElementById('createList').innerHTML += '<li id=create-'+ created +'>'+ taskname +'<button type="button" onclick="deleteCreated('+ created +','+ createdID +')" class="btn-sm btn-danger ck-btn-sm">Delete</button></li>';
					$('#create-'+ created).addClass('slideToappear');
					$('#create-'+ created).show();
					$('#create-'+ created).css('opacity', '1');
					$('#create-'+ created).css('transform', 'translateX(0)');
					$('#create-'+ created +' button').fadeIn();
					setTimeout(function(){
						$("#response-box").slideDown();
						$("#response-box").fadeOut('slow');
						$('#create-'+created).removeClass('slideToappear');
					}, 1000);
				
					}

					});
			});
	function deleteCreated(taskcreated, createdid){
			var formData = new FormData();
			var processType = 1;
			formData.append('taskId', createdid);
			formData.append('process', processType);
				$.ajax({
					url:"taskDelete.php",
					type: "POST",
					data:formData,
					contentType: false,
					cache: false,//to unable request page to be cached
					processData: false,//To send DOMDocument or non processed datafile if it is set to false
					success: function (data) {
							/* body... */
						if (data) {
							$('#create-' + taskcreated).toggleClass('deleteEffect');
							setTimeout(function(){
								$('#create-' + taskcreated).hide();		
												}, 500);

							}else {
								
							}
						}
						

					});
				};

	$("#viewFiles").click(function(event) {
		/* Act on the event */
		$('#detail').removeClass('viewSlideappear-fromLeft');
		$('#detail').addClass('viewSlide-disappear-toLeft');
		setTimeout(function (argument) {
			$('#detail').hide();
			$('#redirect').hide();
			$('#button-back').show();
			$('#fileManager').addClass('viewSlideappear-fromRight');
			$('#fileManager').removeClass('viewSlide-disappear-toRight');
			$('#fileManager').show();
		},700);
			
	});

	$('#showSubtasks').click(function(event) {
		/* Act on the event */
		$('#subtask-list').slideToggle();
		var accordion = $('#showSubtasks i').text();
		if (accordion == 'expand_more') {
			$('#showSubtasks i').text('expand_less');	
		}else{
			$('#showSubtasks i').text('expand_more');
		}
	});

	$("#subtasks").click(function(event) {
		$('#subtaskOverlay').fadeIn();
		$('#subtaskAction').animate({top: '10%'}, 1000);
	});

	function uploadFile() {
		$('#uploadOverlay').fadeIn();
		$('#uploadAction').animate({top: '30%'}, 1000);
	}
	$('#closestatus').click(function(event) {
				$('#uploadAction').animate({top: '-100%'}, 1000);
				$('#uploadOverlay').fadeOut();
			});
	$('#closecreator').click(function(event) {
				$('#subtaskAction').animate({top: '-100%'}, 1000);
				$('#subtaskOverlay').fadeOut();
			});

	function deleteFile(file){
		var formData = new FormData();
		var processType = 1;
		formData.append('file', file);
		formData.append('process', processType);
		$.ajax({
					url:"alterTask.php",
					type: "POST",
					data:formData,
					contentType: false,
					cache: false,//to unable request page to be cached
					processData: false,//To send DOMDocument or non processed datafile if it is set to false
					success: function (response) {
						$('#file-'+ file).addClass('deleteEffect');
						$("#response-box").addClass('ascend1');
						$("#response-box").text(response);
						$("#response-box").show();
						setTimeout(function(){
							$("#response-box").fadeOut(1000);
							$('#file-'+ file).hide();
							}, 1500);
					}
				});
	}

	function goBack() {
		$('#fileManager').removeClass('viewSlideappear-fromRight');
		$('#fileManager').addClass('viewSlide-disappear-toRight');
		setTimeout(function (argument) {
			$('#fileManager').hide();
			$('#button-back').hide();
			$('#redirect').show();
			$('#detail').addClass('viewSlideappear-fromLeft');
			$('#detail').removeClass('viewSlide-disappear-toLeft');
			$('#detail').show();
		},700);
	}

