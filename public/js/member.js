jQuery(function($) {
    $('.delete').click(function(event) {
        if (!confirm('Are you sure you want to delete?')) {
            event.preventDefault();
        }
    });
});

function readMembers() {
    jQuery('#memberTable').DataTable({
        "ajax": {
            url: pluginUrl + "dwdea-members/scripts/member_read.php",
            type: 'GET',
            "data": function(e) {
                return {
                    "status": jQuery("#status").val()
                }
            }
        },
        "columns": [{
            "data": "id",
            "render": function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {
            "data": "name",
        }, {
            "data": "father_name",
        }, {
            "data": "mobile",
        }, {
            'data': "status",
        }, ]
    });
}

function changeMemberStatus() {
    jQuery('#memberTable').DataTable().ajax.reload();
}