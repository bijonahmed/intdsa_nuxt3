$(document).ready(function () {
    jQuery(document).ready(function ($) {
        $('#delete_image').hide();
        $('#edit_image').hide();
        $('[name="image"]').hide();
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview_image').show();
                    $('#preview_image').attr('src', e.target.result);
                    $('#add_image').hide();
                    $('#edit_image').show();
                    $('#delete_image').show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('[name="image"]').change(function () {
            readURL(this);
        });

        $('#add_image,#edit_image').click(function (event) {
            $('[name="image"]').trigger('click');
        });

        $('#delete_image').click(function (event) {
            $('[name="image"]').val('');
            $('#preview_image').attr('src', '');
            $('#preview_image').hide();
            $('#delete_image').hide();
            $('#edit_image').hide();
            $('#add_image').show();
        });
    });
})
$(document).ready(function () {
    jQuery(document).ready(function ($) {
        $('#delete_image').hide();
        $('#edit_image').hide();
        $('[name="image1"]').hide();
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview_image_id').show();
                    $('#preview_image_id').attr('src', e.target.result);
                    $('#add_image').hide();
                    $('#edit_image').show();
                    $('#delete_image').show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('[name="image1"]').change(function () {
            readURL(this);
        });

        $('#add_image,#edit_image').click(function (event) {
            $('[name="image1"]').trigger('click');
        });

        $('#delete_image').click(function (event) {
            $('[name="image1"]').val('');
            $('#preview_image_id').attr('src', '');
            $('#preview_image_id').hide();
            $('#delete_image').hide();
            $('#edit_image').hide();
            $('#add_image').show();
        });
    });
})