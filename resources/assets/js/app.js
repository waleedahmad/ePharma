$('.delete-company').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');

    bootbox.confirm("Are you sure you want to delete this company?", function(result){
        if(result){
            $.ajax({
                type : 'DELETE',
                url : '/admin/company',
                data : {
                    _token : getCSRFToken(),
                    id : id,
                },
                success : function(res){
                    if(res){
                        $(this).parents('.company').slideUp().remove();
                    }
                }.bind(this)
            })
        }
    }.bind(this));
});

$('.delete-branch').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');

    bootbox.confirm("Are you sure you want to delete this branch?", function(result){
        if(result){
            $.ajax({
                type : 'DELETE',
                url : '/admin/branch',
                data : {
                    _token : getCSRFToken(),
                    id : id,
                },
                success : function(res){
                    if(res){
                        $(this).parents('.branch').slideUp().remove();
                    }
                }.bind(this)
            })
        }
    }.bind(this));
});

$('.delete-medicine').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');

    bootbox.confirm("Are you sure you want to delete this medicine?", function(result){
        if(result){
            $.ajax({
                type : 'DELETE',
                url : '/branch/medicine',
                data : {
                    _token : getCSRFToken(),
                    id : id,
                },
                success : function(res){
                    if(res){
                        $(this).parents('.medicine').slideUp().remove();
                    }
                }.bind(this)
            })
        }
    }.bind(this));
});

$('.delete-stock').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');

    bootbox.confirm("Are you sure you want to delete this stock?", function(result){
        if(result){
            $.ajax({
                type : 'DELETE',
                url : '/branch/stock',
                data : {
                    _token : getCSRFToken(),
                    id : id,
                },
                success : function(res){
                    if(res){
                        $(this).parents('.item').slideUp().remove();
                    }
                }.bind(this)
            })
        }
    }.bind(this));
});



$('#open-hours, #close-hours').timepicker({
    'timeFormat': 'H:i',
    'step': function(i) {
        return 60;
    }
}).keypress(function(e){
    e.preventDefault();
});

$('#mfg-date , #expiry-date').datepicker({
    dateFormat: 'yy-mm-dd'
});