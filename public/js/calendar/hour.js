$(document).ready(function() {
    let token = $('meta[name="csrf-token"]').attr('content');

    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

    let url = location.href;
    let day_id = url.match(/[0-9]+/g)[0];
    url = url.replace(/\/[0-9]+/g, '');


    // //modal show add
    $('body').on('click', '.add', function() {
        $('.modal').show(500);
        $('.modal-title').text('Добавить врмя для записи');
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

    $('body').on('click', '.edit', function() {
        reset();

        let id = $(this)[0].dataset.id;

        let getDate = (string) => new Date(0, 0, 0, string.split('-')[0], string.split('-')[1]);

        let formatM = function(minutes) {
            if (minutes === 0) {
                return '00';
            } else
                return minutes;
        }

        let formatH = function(hours) {
            if (hours < 10) {
                return '0' + hours;
            } else
                return hours;
        }

        let begin = getDate($('#item-' + id)[0].children[0].innerText);
        let end = getDate($('#item-' + id)[0].children[1].innerText);


        $('#begin').val(formatH(begin.getHours()) + ':' + formatM(begin.getMinutes()));
        $('#end').val(formatH(end.getHours()) + ':' + formatM(end.getMinutes()));


        $('.save').val('edit');
        $('.save').attr('data-id', this.dataset.id);
        $('.modal-title').text('Редактировать время');
        $('.modal').show(500);
    });

    // //request to save

    $('body').on('click', '.save', function() {

        let value = $(this).val();

        let begin = $('#begin').val();
        let end = $('#end').val();

        let getDate = (string) => new Date(0, 0, 0, string.split(':')[0], string.split(':')[1]); //получение даты из строки (подставляются часы и минуты
        let different = (getDate(end) - getDate(begin));

        let hours = Math.floor((different % 86400000) / 3600000);
        let minutes = Math.round(((different % 86400000) % 3600000) / 60000);

        if (hours < 1) {
            $('.alert-danger').text('Разница во времени должна быть минимум в час');

            return 0;
        }
        if (value === 'edit') {

            let id = $('.save')[0].dataset.id;


            axios.put(url + '/' + id, { 'begin': begin, 'end': end, 'day_id': day_id })
                .then(function(response) {
                    location.reload();
                })
                .catch(function(exception) {
                    console.log(exception);
                    // let error = exception.response.data.errors.day[0];
                    // $('.alert-danger').text(error);
                })

        } else {
            axios.post(url, { 'begin': begin, 'end': end, 'day_id': day_id })
                .then(function(response) {
                    location.reload();
                })
                .catch(function(exception) {

                    let error = exception.response.data.errors;

                    $('.alert-danger').text(error.begin + " " + error.end);
                })
        }
    });

    function reset() {
        $('.alert-danger').text('');
        $('#begin').val('');
        $('#end').val('');
    }
});