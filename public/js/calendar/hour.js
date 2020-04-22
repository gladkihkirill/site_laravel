$(document).ready(function() {
    let token = $('meta[name="csrf-token"]').attr('content');

    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

    let url = location.href;
    let day_id = url.match(/[0-9]+/g)[0];
    url = url.replace(/\/[0-9]+/g, '');


    // //modal show add
    $('body').on('click', '.add', function() {
        $('.modal').show(500);
        $('.modal-title').text('Добавиnm врмя для записи');
        $('.save').val('save');
        reset();
    });

    //modal hide

    $('body').on('click', '#close', function() {
        $('.modal').hide(500);
    });
    $('body').on('click', '.delete', function() {
        let id = $(this)[0].dataset.id;

        if (confirm('Удалить?')) {
            axios.delete(url + '/' + id)
                .then(function(response) {
                    console.log(response);
                    $('#item-' + id).hide('500', function() {
                        $('#item-' + id).remove();
                    });
                })
        }
    });

    // //modal show edit

    // $('body').on('click', '.edit', function() {
    //     reset();

    //     let day = this.dataset.date;

    //     $('#date').val(day);
    //     $('.save').val('edit');
    //     $('.save').attr('data-id', this.dataset.id);
    //     $('.modal-title').text('Редактировать день');
    //     $('.modal').show(500);
    // });



    // //request to save

    $('body').on('click', '.save', function() {
        // let value = $(this).val();
        // let day = $('#date').val();
        // let url = location.href;

        let begin = $('#begin').val();
        let end = $('#end').val();



        // if (value === 'edit') {
        //     let id = $('.save')[0].dataset.id;
        //     url = url + '/' + id;

        //     axios.put(url, { 'day': day })
        //         .then(function(response) {
        //             location.reload();
        //         })
        //         .catch(function(exception) {
        //             let error = exception.response.data.errors.day[0];
        //             $('.alert-danger').text(error);
        //         })
        // } else {
        axios.post(url, { 'begin': begin, 'end': end, 'day_id': day_id })
            .then(function(response) {
                location.reload();
            })
            .catch(function(exception) {
                console.log(exception.response);
                let error = exception.response.data.errors.day[0];
                $('.alert-danger').text(error);
            })
            // }
    });

    // //delete day
    // $('body').on('click', '.delete', function() {
    //     let url = location.href;

    //     let id = this.dataset.id;

    //     if (confirm('Удалить?')) {
    //         axios.delete(url + '/' + id)
    //             .then(function(response) {
    //                 $('#item-' + id).hide('500', function() {
    //                     $('#item-' + id).remove();
    //                 });
    //             })
    //     }
    // });

    // function reset() {
    //     $('.alert-danger').text('');
    //     $('#date').val('');
    // }
});