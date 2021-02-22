$(document).ready(function(){

/*==============================================
=            datatble cuentas index            =
==============================================*/
    var table = $('#tableCuentas').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
        	url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        order: [ [0, 'desc'] ]
    } );
/*=====  End of datatble cuentas index  ======*/
/*==================================================
=            datatble movimientos index            =
==================================================*/
    var table = $('#tableMovimientos').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        order: [ [0, 'desc'] ]
    } );
/*=====  End of datatble movimientos index  ======*/
/*==============================================
=            datatable Saldos index            =
==============================================*/
    var table = $('#tableSaldos').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        order: [ [0, 'desc'] ]
    } );
/*=====  End of datatable Saldos index  ======*/
/*=====================================================
=            datatable Saldos Show Ingresos            =
=====================================================*/
    var table = $('#tableSaldosIngresos').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        order: [ [0, 'desc'] ]
    } );
/*=====  End of datatable Saldos Show Ingresos  ======*/
/*======================================================
=            datatable Saldos Show Egresos            =
======================================================*/
    var table = $('#tableSaldosEgresos').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        order: [ [0, 'desc'] ]
    } );
/*=====  End of datatable Saldos Show Egresos  ======*/

});