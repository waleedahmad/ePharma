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

$('.rm-cart-item').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');


    bootbox.confirm("Are you sure you want to remove this item from cart?", function(result){
        if(result){
            $.ajax({
                type : 'DELETE',
                url : 'cart',
                data : {
                    id : id,
                    _token : getCSRFToken()
                },
                success : function(removed){
                    if(removed){
                        $(this).parents('.cart-item').slideUp().remove();
                        if(!$('.cart-item').length){
                            $('.cart-checkout').hide();
                        }
                    }
                }.bind(this)
            })
        }
    }.bind(this));
});

$('.confirm-checkout').on('click', function(e){
    e.preventDefault();

    bootbox.confirm("Are you sure you want to process checkout?", function(result){
        if(result){
            window.location = $(this).attr('href');
        }
    }.bind(this));
});

$('.clear-order').on('click', function(e){
    e.preventDefault();

    bootbox.confirm("Are you sure you want to clear this order?", function(result){
        if(result){
            window.location = $(this).attr('href');
        }
    }.bind(this));
});

$('#user-info-city').on('change', function(e){
    let id = $(this).val();

    if(id.length){
        $.ajax({
            type : 'GET',
            url : '/user/info/towns',
            data : {
                city_id : id
            },
            success : function(res){
                if(res.length){
                    renderLocations(res);
                }else{
                    bootbox.alert("We currently have no stores listings in selected city");
                    clearLocations();
                }
            }
        })
    }
});

function renderLocations(locations){
    let $locations = $('#user-info-town');

    $($locations).empty().append($('<option>', {
        value: '',
        text : 'Select Town'
    }));

    locations.forEach(function(loc){
        $($locations).append($('<option>', {
            value: loc.id,
            text : loc.name
        }));
    });
}

function clearLocations(){
    let $locations = $('#user-info-town');
    $($locations).empty().append($('<option>', {
        value: '',
        text : 'Select Town'
    }));
}

$('#user-info-town').on('change', function(e){

});

