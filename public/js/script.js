let comments = [];
let valueForAdd,
    commentId,
    commentEdit,
    closeImg = 'https://cdn1.iconfinder.com/data/icons/feather-2/24/x-16.png';

/*add comments for save*/
$('.add-comm').on('click', function (){
    valueForAdd = $('.task_comment').val();
    if(valueForAdd.trim() !== ""){
        $('.alert-save').css('display', 'block');
        $('.btn-save').css('display', 'block');
        $('.body').append("<p class='for_add'>" + valueForAdd + "<img class='_image' src=" + closeImg + "></p>");
        $('input[name="task_comment"]').val('');
        comments.push(valueForAdd);
    }
    $('.form-control').scrollTop(9999);
});

/* save all added comments */
$('.btn-save').on('click', function () {
    $('.alert-save').css('display', 'none');
    $('.btn-save').css('display', 'none');
    let taskId = ($('.task_name').attr('data-id'));
    $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:'/task/' + taskId + '/edit',
    method: 'POST',
    data: {comments: comments},
    success: function (response) {
    if (response.status) {
        $('#show-success-comment').html(comments.length + ' ' + response.message);
        setTimeout(function () {
            location.reload();
        }, 2000)
    } else {
        $('#show-success').html(response.message);
        $('#show-success').css('color', 'red');
        setTimeout(function () {
            $('p').removeClass('for_add');
            $('#show-success').text('');
            $('.alert-save').css('display', 'none');
            $('.btn-save').css('display', 'none');
            comments = [];
        }, 2000);
    }
    }
});
    $('.form-control').scrollTop(9999);
});

/*delete temporary comments*/
$('.body').delegate('._image', 'click',  function () {
    let comment = $(this).parent('p').text();
    $(this).parent('p').remove();
    comments.splice($.inArray(comment, comments), 1);
    if (comments.length === 0) {
        $('.alert-save').css('display', 'none');
        $('.btn-save').css('display', 'none');
    }
});

/*show modal*/ +
$('.edit-image').on('click', function () {
    $('#edit_comment').val('');
    $('#edit_comment').val($(this).parent().text());
    commentIdd = ($(this).parent().attr('data'));
});

/*edit comment*/
$('.save-edit').on('click', function ()
{
    commentEdit = $('#edit_comment').val();
    let taskId = ($('.task_name').attr('data-id'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/task/' + taskId + '/edit' ,
        method: 'PATCH',
        data: {'comment_id': commentId, 'comment_edit': commentEdit},
        success: function (response)
        {
            if (response.response) {
                $('#exampleModal').modal('hide');
                $('#show-success-comment').html(response.message);
                setTimeout(function () {
                    location.reload();
                },1000)
            } else if (response.message === 'not change comment') {
                $('#exampleModal').modal('hide');
                $('#show-success-comment').html(response.message);
                setTimeout(function () {
                    location.reload();
                },1000);
            } else {
                alert(1);
                $('#exampleModal').modal('hide');
                $('#show-success-comment').html(response.message);
                setTimeout(function () {
                    location.reload();
                },1000)
            }

        }
    });
});

/*delete one comment*/
    $('.body').on('click', '.delete-image', function () {
        let taskId = ($('.task_name').attr('data-id'));
        let commentId = ($(this).parent().attr('data'));
        let deleteCom = $(this).parent('p');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : '/task/' + taskId + '/edit',
            method : 'DELETE',
            data : {'comment_id': commentId},
            success: function (response)
            {
                if (response.response) {
                    deleteCom.remove();
                    $('#show-success-comment').html(response.message);
                    setTimeout(function () {
                        $('#show-success-comment').html('');
                    },1000)
                } else {
                    $('#show-success-comment').html(response.message);
                    setTimeout(function () {
                        $('#show-success-comment').html('');
                    },1000)
                }
            }
        })
    });
