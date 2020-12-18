$('#selUser').select2({
    theme: 'bootstrap4',
    placeholder: 'Select User',
    minimumInputLength: '2',
    width: '300px',
    ajax: {
        url: '/search/users',
        dataType: 'json',
    },
});

// $(document).ready(function() {
//     $('.js-example-basic-single').select2();
// });

function share(id) {
    $('#share_' + id).submit()
}

// for submitting static form
function form(id) {
    console.log(id);
    $('#' + id).submit()
}



$('#cfiless').select2({
    theme: 'bootstrap4',
    placeholder: 'Search files',
    minimumInputLength: '2',
    width: '300px',
    ajax: {
        url: '/search/files',
        dataType: 'json',
    },
});