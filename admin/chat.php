<link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
<?php
include('database_connection.php');
?>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-body">
				<table class="table table-bordered" id="table">
				</table>
				<div class="table-responsive">
					<div id="user_details"></div>
					<div id="user_model_details"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

		fetch_user();

		setInterval(function() {
			update_last_activity();
			fetch_user();
			update_chat_history_data();
			fetch_group_chat_history();
		}, 300);

		function fetch_user() {
			$.ajax({
				url: "fetch_user.php",
				method: "POST",
				success: function(data) {
					$('#user_details').html(data);
				}
			})
		}

		function update_last_activity() {
			$.ajax({
				url: "update_last_activity.php",
				success: function() {

				}
			})
		}

		function make_chat_dialog_box(to_user_id, to_user_name) {
			var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
			modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
			modal_content += fetch_user_chat_history(to_user_id);
			modal_content += '</div>';
			modal_content += '<div class="form-group">';
			modal_content += '<textarea name="kirimpesan_' + to_user_id + '" id="kirimpesan_' + to_user_id + '" class="form-control kirimpesan"></textarea>';
			modal_content += '</div><div class="form-group" align="right">';
			modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-info send_chat">Send</button></div></div>';
			$('#user_model_details').html(modal_content);
		}

		$(document).on('click', '.start_chat', function() {
			var to_user_id = $(this).data('touserid');
			var to_user_name = $(this).data('tousername');
			make_chat_dialog_box(to_user_id, to_user_name);
			$("#user_dialog_" + to_user_id).dialog({
				autoOpen: false,
				width: 400
			});
			$('#user_dialog_' + to_user_id).dialog('open');
			$('#kirimpesan_' + to_user_id).emojioneArea({
				pickerPosition: "top",
				toneStyle: "bullet"
			});
		});

		$(document).on('click', '.send_chat', function() {
			var to_user_id = $(this).attr('id');
			var kirimpesan = $.trim($('#kirimpesan_' + to_user_id).val());
			if (kirimpesan != '') {
				$.ajax({
					url: "insert_chat.php",
					method: "POST",
					data: {
						to_user_id: to_user_id,
						kirimpesan: kirimpesan
					},
					success: function(data) {
						$('#kirimpesan_' + to_user_id).val('');
						var element = $('#kirimpesan_' + to_user_id).emojioneArea();
						element[0].emojioneArea.setText('');
						$('#chat_history_' + to_user_id).html(data);
						// $('.kirimpesan').val('');
					}
				})
			} else {
				alert('Type something');
			}
		});

		function fetch_user_chat_history(to_user_id) {
			$.ajax({
				url: "fetch_user_chat_history.php",
				method: "POST",
				data: {
					to_user_id: to_user_id
				},
				success: function(data) {
					$('#chat_history_' + to_user_id).html(data);
				}
			})
		}

		function update_chat_history_data() {
			$('.chat_history').each(function() {
				var to_user_id = $(this).data('touserid');
				fetch_user_chat_history(to_user_id);
			});
		}

		$(document).on('click', '.ui-button-icon', function() {
			$('.user_dialog').dialog('destroy').remove();
			$('#is_active_group_chat_window').val('no');
		});

		$(document).on('focus', '.kirimpesan', function() {
			var is_type = 'yes';
			$.ajax({
				url: "update_is_type_status.php",
				method: "POST",
				data: {
					is_type: is_type
				},
				success: function() {

				}
			})
		});

		$(document).on('blur', '.kirimpesan', function() {
			var is_type = 'no';
			$.ajax({
				url: "update_is_type_status.php",
				method: "POST",
				data: {
					is_type: is_type
				},
				success: function() {

				}
			})
		});

		$('#group_chat_dialog').dialog({
			autoOpen: false,
			width: 400
		});

		$('#group_chat').click(function() {
			$('#group_chat_dialog').dialog('open');
			$('#is_active_group_chat_window').val('yes');
			fetch_group_chat_history();
		});

		$('#send_group_chat').click(function() {
			var kirimpesan = $.trim($('#group_kirimpesan').html());
			var action = 'insert_data';
			if (kirimpesan != '') {
				$.ajax({
					url: "group_chat.php",
					method: "POST",
					data: {
						kirimpesan: kirimpesan,
						action: action
					},
					success: function(data) {
						$('#group_kirimpesan').html('');
						$('#group_chat_history').html(data);
					}
				})
			} else {
				alert('Type something');
			}
		});

		function fetch_group_chat_history() {
			var group_chat_dialog_active = $('#is_active_group_chat_window').val();
			var action = "fetch_data";
			if (group_chat_dialog_active == 'yes') {
				$.ajax({
					url: "group_chat.php",
					method: "POST",
					data: {
						action: action
					},
					success: function(data) {
						$('#group_chat_history').html(data);
					}
				})
			}
		}

		$('#uploadFile').on('change', function() {
			$('#uploadImage').ajaxSubmit({
				target: "#group_kirimpesan",
				resetForm: true
			});
		});


	});
</script>