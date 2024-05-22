        function load_news_notice_category_add_form (){
	        $('#addModal').modal('show');
        }
        
        function load_news_notice_category_content_edit_form(id){
	$.getJSON(APP_URL+'/admin/news-notice-category/find/'+id, function(data) {
            $('#id').val(data.id);
            $('#title_update').val(data.title);
            $('#slug_update').val(data.slug);
             $('#editModal').modal('show');
        });	
        }

        function delete_news_notice_category(id){
            var is_confirm = confirm("Are you sure you want to delete this Category?");
	    if(is_confirm){
            $.ajax({
                type: 'DELETE',
                url: APP_URL+'/admin/news-notice-category/delete/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted Category!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        }
    }
              
                  
                  
                  


        
        
        
       



       
