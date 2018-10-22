require(['jquery', 'moment', 'datetimepicker'], function () {

    // datetimepicker
    $(document).ready(function () {
        $('.datetimepicker').datetimepicker({
            viewMode: 'years',
            format: 'L',
            locale: 'ar-ma',
        });
    });
});