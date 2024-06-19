<?php
session_start();
include 'koneksi.php';

?>
<?php
include('database_connection.php');
?>
<?php include 'header.php'; ?>
<main>
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Chat</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Chat</li>
                </ol>
            </nav>
        </div>
    </div>
    <br>
    <section class="contact-information padding-large">
        <div class="container">
            <div class="row g-0 justify-content-center">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-header">
                        <h2 class="section-title">Chat</h2>
                    </div>
                    <div class="table-responsive">
                        <div id="user_details"></div>
                        <div id="user_model_details"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <br><br>

</main>
<?php
include 'footer.php';
?>
<script>
    $(document).ready(function() {

        fetch_user();

        setInterval(function() {
            update_last_activity();
            fetch_user();
            update_chat_history_data();
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
            modal_content += '<textarea name="kirimpesan_' + to_user_id + '" id="kirimpesan_' + to_user_id + '" class="form-control kirimpesan" placeholder="Halo, anda ingin berkonsultasi tentang apa ? tulis disini"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn mt-4 btn-info send_chat">Kirim</button></div></div>';
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


    });
</script>