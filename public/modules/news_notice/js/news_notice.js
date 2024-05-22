var options = {

    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',

    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',

    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',

    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

};

function delete_news_notice(id) {

    var is_confirm = confirm("Are you sure you want to delete this Blog?");

    if (is_confirm) {

        $.ajax({

            type: 'DELETE',

            url: APP_URL +'/admin/news-notice/delete/' + id,

            data: {

                '_token': $('input[name=_token]').val(),

            },

            success: function(data) {

                $('.item' + data['id']).remove();

                $('.col1').each(function(index) {

                    $(this).html(index + 1);

                });

            }

        });

    }

}



function string_to_slug(str) {

    str = str.replace(/^\s+|\s+$/g, ''); // trim

    str = str.toLowerCase();



    // remove accents, swap ñ for n, etc

    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";

    var to = "aaaaeeeeiiiioooouuuunc------";

    for (var i = 0, l = from.length; i < l; i++) {

        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));

    }



    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars

        .replace(/\s+/g, '-') // collapse whitespace and replace by -

        .replace(/-+/g, '-'); // collapse dashes



    return str;

}



function string_to_slug(titleId, slugId) {



    var str = $("#" + titleId).val();



    var eventSlug = $("#" + slugId).val();



    if (eventSlug.length == "") {



        str = str.replace(/^\s+|\s+$/g, ''); // trim



        str = str.toLowerCase();



        // remove accents, swap ñ for n, etc



        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";



        var to = "aaaaeeeeiiiioooouuuunc------";



        for (var i = 0, l = from.length; i < l; i++) {



            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));



        }







        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars



        .replace(/\s+/g, '-') // collapse whitespace and replace by -



        .replace(/-+/g, '-'); // collapse dashes



        //return str;



        $("#" + slugId).val(str);



    }



}









$(document).ready(function(e) {

    $("#title").change(function() {

        string_to_slug('title', 'slug');

    });

});





function remove_featured_image(id) {

    var myurl = APP_URL + '/admin/news-notice/remove_feature_image/' + id;

    var is_confirm = confirm("Are you sure you want to delete this Blog featured image?");

    if (is_confirm) {

        $.get(myurl, function(sts) {

            if (sts == 'done')

                $("#listing_img_" + id).remove();

            else

                alert('OOps! Something went wrong.');

        });

    }

}

$(function() {

    $("#show_seo_fields").click(function() {

        if ($(this).is(":checked")) {

            $("#div_show_seo_fields").show();

        } else {

            $("#div_show_seo_fields").hide();

        }

    });

});

$(function() {

    $("#show_seo_fields_for_update").click(function() {

        if ($(this).is(":checked")) {

            $("#div_show_seo_fields_for_update").show();

        } else {

            $("#div_show_seo_fields_for_update").hide();

        }

    });

});