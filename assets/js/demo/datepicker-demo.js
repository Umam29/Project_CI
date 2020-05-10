// Call the datePicker jQuery plugin
$(document).ready(function() {
    $( "#date_stock" ).datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d'
    });
});