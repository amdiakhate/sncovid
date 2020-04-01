$(document).ready(function () {

    if ($('#form_haveSymptoms').val() == true) {
        $('#symptoms').show();
    } else {
        $('#symptoms').hide();
        $('#symptoms').find('input').removeAttr('required');
    }
    if ($('#form_visitedCountry').val() == true) {
        $('#whichCountry').show();
    } else {
        $('#whichCountry').hide();
        $('#whichCountry').find('input').removeAttr('required');
    }
    if ($('#form_caseContact').val() == true) {
        $('#caseContactWho').show();
    } else {
        $('#caseContactWho').hide();
        $('#caseContactWho').find('input').removeAttr('required');
    }

    $('#form_haveSymptoms').change(function () {
        if (this.value == true) {
            $('#symptoms').show();
            $('#symptoms').find('input').attr('required', true);
        } else {
            $('#symptoms').hide();
            $('#symptoms').find('input').removeAttr('required');
        }
    });

    $('#form_visitedCountry').change(function () {
        if (this.value == true) {
            $('#whichCountry').show();
            $('#whichCountry').find('input').attr('required', true);
        } else {
            $('#whichCountry').hide();
            $('#whichCountry').find('input').removeAttr('required');
        }
    })
    $('#form_caseContact').change(function () {
        if (this.value == true) {
            $('#caseContactWho').show();
            $('#caseContactWho').find('input').attr('required', true);
        } else {
            $('#caseContactWho').hide();
            $('#caseContactWho').find('input').removeAttr('required');
        }
    })
});