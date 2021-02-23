jQuery(document).ready(function($) {
    $('body').on('click', '.removable-item', function(e) {
        e.preventDefault();
        if(confirm('Вы действительно хотите удалить элемент?')) {
            $(this).next('form').submit();
        }
    });

    $('.image-box .remove-image').on('click', function(e) {
        if(!confirm('Вы действительно хотите удалить элемент?')) {
            e.preventDefault();
        }
    });

    $('.image-box .edit-image').on('click', function() {

    });

    $('.dd').on('change', function(e) {
        var list = e.length ? e : $(e.target), output;

        if (window.JSON) {
            output = window.JSON.stringify(list.nestable('serialize'));
            $.ajax({
                type: 'POST',
                url: '/cabinet/menu/items/change_position',
                data: { 'output' : output },
                dataType: 'json',
                success: function(data) {
                    //console.log(data)
                }
            });
        } else {
            return false;
        }

    } );

    $('.dd').nestable({group: 1});
});


