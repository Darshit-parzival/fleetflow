$(document).ready(function () {

    $('.select2').select2({
        width: '100%'
    });

    const vehicleSelect = $('#vehicleSelect');
    const cargoInput = $('#cargoInput');
    const capacityText = $('#maxCapacityText');

    let currentCapacity = 0;

    vehicleSelect.on('change', function () {
        const selected = $(this).find(':selected');
        currentCapacity = parseInt(selected.data('capacity')) || 0;

        capacityText.text(currentCapacity ? currentCapacity : '-');
    });

    cargoInput.on('input', function () {
        const weight = parseInt($(this).val()) || 0;

        if (currentCapacity && weight > currentCapacity) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

});
