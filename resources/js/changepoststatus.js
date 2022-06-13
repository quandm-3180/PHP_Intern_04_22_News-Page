$('#postStatusApproved, #postStatusRejected').click(function (e) {
    let id = $(this).attr('data');
    let postStatus = $(this).attr('postStatus');
    $.ajax({
        url: `/admin/change-post-status/${id}/${postStatus}`,
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    })
})
