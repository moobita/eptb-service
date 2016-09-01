$(function(){
	
	$("#modal").on("hidden.bs.modal", function(){
		$('#modal').modal('hide')
			.find('#modalContent').empty();
	});
	
	$('#modalButton').click(function(){
		$('#img-load-modal').show();
		$('#modal').modal('show')
				.find('#modalContent')
				.load($(this).attr('value'));
		$('#img-load-modal').hide();
	});
	
	$('#modalLecturer').click(function(){
		$('#modal').modal('show')
				.find('#modalContent')
				.load($(this).attr('value'));
	});
	
	$('#modalSubjects').click(function(){
		$('#modal').modal('show')
				.find('#modalContent')
				.load($(this).attr('value'));
	});
	$('#modalMsTestSet').click(
			function() {
				$("#txt-header").html('<i class="fa fa-correct"></i>&nbsp;เพิ่มแบบทดสอบ');
				$('#modal').modal('show').find('#modalContent').load(						
						$(this).attr('value'));
			});
	
});