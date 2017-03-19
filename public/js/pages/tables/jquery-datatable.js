$(function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        ordering: false,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
