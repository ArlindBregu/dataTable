/*$(document).ready(function () {
    $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'http://localhost:8080/index.php',
            type: 'POST',
        },
        columns: [
            { data: 'id' },
            { data: 'birth_date' },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'gender' },
        ],
    });
});*/

var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax: 'http://localhost:8080/index.php',
        table: "#example",
        fields: [ {
                label: "Birth date:",
                name: "birth_date"
            }, {
                label: "First name:",
                name: "first_name"
            }, {
                label: "Last name",
                name: "last_name"
            }, {
                label: "Gender",
                name: "gender"
            }
        ]
    } );
 
    var table = $('#example').DataTable( {
        dom: "Bfrtip",
        ajax: {
            url: 'http://localhost:8080/index.php',
            type: 'POST'
        },
        columns: [
            { data: 'id' },
            { data: 'birth_date' },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'gender' },
        ],
        select: true,
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            {
                extend: "selected",
                text: 'Delete',
                action: function ( e, dt, node, config ) {
                    var rows = table.rows( {selected: true} ).indexes();
 
                    editor
                        .hide( editor.fields() )
                        .one( 'close', function () {
                            setTimeout( function () { // Wait for animation
                                editor.show( editor.fields() );
                            }, 500 );
                        } )
                        .edit( rows, {
                            title: 'Delete',
                            message: rows.length === 1 ?
                                'Are you sure you wish to delete this row?' :
                                'Are you sure you wish to delete these '+rows.length+' rows',
                            buttons: 'Delete'
                        } )
                        .val( 'removed_date', (new Date()).toISOString().split('T')[0] );
                }
            }
        ]
    } );
} );