    var userId;

    /*show tasks*/
    /*$('._tasks').on('click', function () {
        $('.tasks').empty();
        let paragraph,
            divComment,
            trashImage,
            dropdown;
        userId = $(this).parent().parent().attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/users',
            method: 'PUT',
            data: {'userId':userId},
            success: function (response) {
                if (response.status) {
                    if (response.tasks.length === 0) {
                        $('.tasks').append("<p class='no_comment'>No comment</p>")
                    }
                    $.each(response.tasks, function (task, value) {
                        trashImage = "<img class='_image' data='" + value.id + "' src='../images/del-close.png'>";
                        paragraph = "<div class='comment dropdown-toggle'  data-toggle='dropdown'>" + value.task_name + "</div>";
                        dropdown = "<div class='dropdown-menu'></div>";
                        divComment ="<div class='btn-group col-md-12'>" + paragraph + dropdown + trashImage + "</div>";
                        $('.tasks').append(divComment)
                    })
                } else {
                    alert('error');
                }
            }
        })
    });*/

/*show comments*/
    /*$('.tasks').delegate('.comment', 'click', function () {
        let taskId = $(this).parent().children('._image').attr('data');
        let paragraph,
            image;
        $('.dropdown-menu').empty();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/users/' + taskId,
            method: 'GET',
            data: {'user_id': userId},
            success: function (response) {
                if (response.status) {
                    if (response.comments.length === 0) {
                        $('.dropdown-menu').append("<p class='no_comment'>No comment</p>");
                    }
                    $.each(response.comments, function (comment, value) {
                        image = "<img id='delete-comment' src='../images/del-com.png'>";
                        paragraph = image + "<p id='task-comment' data='" + value.id + "'>" + value.comment + "</p>";
                        $('.dropdown-menu').append("<div>" + paragraph + "</div>")
                    })
                } else {
                    alert('error');
                }
            }
        })
    });*/

/*delete user*/
    $('.btn_delete').on('click', function () {
        userId = $(this).parent().parent().attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/users',
            method: 'DELETE',
            data: {'userId': userId},
            success: function (response) {
                if (response.status) {
                    $('#message').html(response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1000)
                } else {
                    $('#message').css('background-color', '#f97176');
                    $('#message').html(response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            }
        })
    });

    /*delete task*/
    $('.tasks').delegate('._image', 'click', function () {
        let taskId = $(this).attr('data');
        let commentName = $(this).parent('p');
        let removedComment = $(this).parent();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/users/' + taskId,
            method: 'DELETE',
            data: {'userId': userId},
            success: function (response) {
                if (response.status) {
                    commentName.remove();
                    $('#comment_message').html(response.message);
                    removedComment.remove('.btn-group');
                    setTimeout(function () {
                        $('#comment_message').html('');
                    }, 1000);
                } else {
                    $('#comment_message').css('background-color', '#f97176');
                    $('#comment_message').html(response.message);
                    setTimeout(function () {
                        $('#comment_message').css('background-color', '#838f53');
                        $('#comment_message').html('');
                    }, 1000);
                }
            }
        })
    });

/*    delete comment
    $('.dropdown-menu').delegate('#delete-comment', 'click', function () {
        alert(999);
    })*/



/*example*/
    $('.card-body').delegate('.delete-comment', 'click', function () {
        var data = $(this).parent().attr('data');
        console.log(data);
    });



/////////////////////////////////////////////////////////////////////////////////////////////
    $('._tasks').on('click', function () {
        $('.tasks').empty();
        let paragraph,
            divComment,
            trashImage,
            dropdown;
        userId = $(this).parent().parent().attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/users',
            method: 'PUT',
            data: {'userId':userId},
            success: function (response) {
                if (response.status) {
                    if (response.tasks.length === 0) {
                        $('.tasks').append("<p class='no_comment'>No comment</p>")
                    }
                    $.each(response.tasks, function (task, value) {
                        trashImage = "<img class='_image' data='" + value.id + "' src='../images/del-close.png'>";
                        paragraph = "<div class='comment '  data-toggle='collapse' href='#multiCollapseExample1'>" + value.task_name + "</div>";
                        dropdown = "<div class='dropdown-menu'></div>";
                        divComment ="<div class='btn-group col-md-12'>" + paragraph + dropdown + trashImage + "</div>";
                        $('.tasks').append(divComment)
                    })
                } else {
                    alert('error');
                }
            }
        })
    });

$('.tasks').delegate('.show-comment', 'click', function () {
    let taskId = $(this).parent().children('._image').attr('data');
    $('.dropdown-menu').empty();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/users/' + taskId,
        method: 'GET',
        data: {'user_id': userId},
        success: function (response) {
            if (response.status) {
                if (response.tasks.length === 0) {
                    $('.tasks').append("<p class='no_comment'>No comment</p>")
                }
                $('.tasks').append("<div class='row'><div class='col-md-6'><div class='card card-body'></div></div></div>");
                $.each(response.tasks, function (task, value) {

                    $('.card-body').append("<div data='" + value.id + "'>")





                })
            } else {
                alert('error');
            }
        }
    })
});
