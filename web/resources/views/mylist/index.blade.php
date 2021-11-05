@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="global_assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="color:black; font-weight:bold;">Lista Registradas</h3>
                        <a type="button" class="btn btn-success" style="float: right;background-color: #567a78;" onclick="Create()"><i class="icon-plus2"></i> Crear Lista</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover table-sx" id="main-table" style="width:100%;">
                            <thead >
                                <tr style="text-align:center;" >
                                    <th style="display:none">id</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
		    <div class="modal-content">
				<div class="modal-header" style="background:#567a78;">
                    <h6 class="modal-title" style="font-size:18px; color:#FFFFFF; margin-bottom:1px;">Crear Lista</h6>
					<button type="button" class="close" style="color:#FFFFFF; margin-bottom:1px;" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="message-text" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" style="margin-top:-4px">
                        </div>
                    </div>
				</div>
                <div class="modal-footer">
                    <div class="form-group col-12 col-lg-12" style="text-align:right;">
                        <a onclick="Add()" style="background-color: #567a78;"
                        class="btn btn-success" > <b><i class="fa fa-save"></i></b> Guardar&nbsp;</a>
                        <a style=""
                         class="btn btn-default" data-dismiss="modal"> <b><i class="fa fa-window-close"></i></b> Cerrar&nbsp;</a>
                    </div>
				</div>
			</div>
		</div>
    </div>

    <div id="addItem" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
		    <div class="modal-content">
				<div class="modal-header" style="background:#567a78;">
                    <h6 class="modal-title" style="font-size:18px; color:#FFFFFF; margin-bottom:1px;">Añadir Producto</h6>
					<button type="button" class="close" style="color:#FFFFFF; margin-bottom:1px;" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="hidden" class="form-control" id="myListId" name="myListId" style="margin-top:-4px">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="message-text" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nameItem" name="nameItem" style="margin-top:-4px">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="message-text" class="col-form-label">Precio:</label>
                            <input type="text" class="form-control" id="priceItem" name="priceItem" style="margin-top:-4px">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="message-text" class="col-form-label">Tienda:</label>
                            <input type="text" class="form-control" id="storeItem" name="storeItem" style="margin-top:-4px">
                        </div>
                    </div>
				</div>
                <div class="modal-footer">
                    <div class="form-group col-12 col-lg-12" style="text-align:right;">
                        <a onclick="createItem()" style="background-color: #567a78;"
                        class="btn btn-success"> <b><i class="fa fa-save"></i></b> Guardar&nbsp;</a>
                        <a style=""
                         class="btn btn-default" data-dismiss="modal"> <b><i class="fa fa-window-close"></i></b> Cerrar&nbsp;</a>
                    </div>
				</div>
			</div>
		</div>
    </div>

    <div id="showItems" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
		    <div class="modal-content">
				<div class="modal-header" style="background:#567a78;">
                    <h6 class="modal-title" style="font-size:18px; color:#FFFFFF; margin-bottom:1px;">Ver mis productos</h6>
					<button type="button" class="close" style="color:#FFFFFF; margin-bottom:1px;" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="form-control" id="myListIdView" name="myListIdView" style="margin-top:-4px">
                        <table class="table table-bordered table-striped table-hover table-sx" id="main-table2" style="width:100%;">
                            <thead >
                                <tr style="text-align:center;" >
                                    <th style="display:none">myListId</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Tienda</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
				</div>
                <div class="modal-footer">
                    <div class="form-group col-12 col-lg-12" style="text-align:right;">
                        <a style=""
                         class="btn btn-default" data-dismiss="modal"> <b><i class="fa fa-window-close"></i></b> Cerrar&nbsp;</a>
                    </div>
				</div>
			</div>
		</div>
    </div>


@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
<script>

    getMyList()

    function Create() {
        $('#add').modal('show');
    }

    function Add() {

        const name = $("#name").val();

        if(name == "") {
            Swal.fire({
                icon: 'error',
                title: 'Crear registro',
                text: 'Nombre es requerido!!!',
            })
            return false;
        };

        $.ajax({
            url: '{{ route('mylist.store') }}',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "name": name
            },
            success: function (data) {
                if(data.isError == false){
                    $('#add').modal('hide');
                    getMyList()
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro',
                        text: 'Lista creada con exito!',
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Actividad',
                        text: 'Error al intentar a agregar registro, verifique!',
                    })
                    $('#add').modal('hide');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#Add_Modal').modal('hide');
            }
        });
    }

    function getMyList() {

        $('#main-table').DataTable({
            destroy: true,
            tabIndex: -1,
            paging: true,
            lengthChange: true,
            searching: true,
            info: true,
            responsive: true,
            lengthMenu: [
                [20, 50, 100, -1],
                [20, 50, 100, "Todos"]
            ],
            ajax: {
                url: '{{ route('api.mylist.datatable') }}',
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },
            "drawCallback": function( settings ) {
                $(".tooltips").tooltip({placement: 'top'});
            },
            "pageLength": 20,
            "sDom": '<"pull-left"l><"pull-right"f>rt<"pull-left"i><"pull-right"p><"clear">',
            columns: [
                { data: "id", "visible": false },
                { data: "name", "visible": true },
                { data: "created_at", "autowidth": true, responsivePriority: 1 },
                {
                data: "id", "visible": true, "autowidth": true, responsivePriority: 2,
                render: function (data, type, row) {
                    return '<div class="btn-group">' +
                        '<button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-ellipsis-v"></i></button>' +
                        '<button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        '<span class="sr-only">Toggle Dropdown</span>' +
                        '</button>' +
                        '<div class="dropdown-menu">' +
                        '<a style="cursor:pointer;" class="dropdown-item" onclick="addItem(' + data + ')">Agregar productos</a>' +
                        '<a style="cursor:pointer;" class="dropdown-item" onclick="showItems(' + data + ')">Ver productos</a>' +
                        '</div >' +
                        '</div>'
                    }
                }
            ],
            "order": [[0, "desc"]],
            "language": {
                "sProcessing": "Procesando...",
                "searchPlaceholder": "Búsqueda rápida",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_, de _TOTAL_.",
                "sInfoEmpty": "Sin registros.",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "columnDefs": [
                { targets: [1], "width": "50%" },
                { targets: [2], "className" : "text-center"},
                { targets: [3], "className" : "text-center"},
            ],
        })
    }

    function addItem(data){
        $("#myListId").val(data);
        $('#addItem').modal('show');
    }

    function createItem(){

        var name = $("#nameItem").val();
        var price = $("#priceItem").val();
        var store = $("#storeItem").val();
        var myListId = $("#myListId").val();

        if(name == "") {
            Swal.fire({
                icon: 'error',
                title: 'Crear registro',
                text: 'Nombre es requerido!!!',
            })
            return false;
        };

        if(price == "") {
            Swal.fire({
                icon: 'error',
                title: 'Crear registro',
                text: 'precio es requerido!!!',
            })
            return false;
        };

        if(store == "") {
            Swal.fire({
                icon: 'error',
                title: 'Crear registro',
                text: 'tienda es requerida!!!',
            })
            return false;
        };

        $.ajax({
            url: '{{ route('api.mylist.addItem') }}',
            type: "post",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                "name": name,
                "price" : price,
                "store" : store,
                "myListId" : myListId
            },
            success: function (data) {
                if(data.isError == false){
                    $('#add').modal('hide');
                    getMyList()
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro',
                        text: 'Lista creada con exito!',
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Actividad',
                        text: 'Error al intentar a agregar registro, verifique!',
                    })
                    $('#add').modal('hide');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#Add_Modal').modal('hide');
            }
        });
    }

    function showItems(data) {

        $('#showItems').modal('show');
        $('#myListIdView').val(data);
        $('#main-table2').DataTable({
            destroy: true,
            tabIndex: -1,
            paging: false,
            lengthChange: true,
            searching: true,
            info: true,
            responsive: true,
            ajax: {
                url: '{{ route('api.mylist.showItems') }}',
                type: "GET",
                data: {
                    "myListId" : data
                },
            },
            "drawCallback": function( settings ) {
                $(".tooltips").tooltip({placement: 'top'});
            },
            "pageLength": 20,
            "sDom": '<"pull-left"l><"pull-right"f>rt<"pull-left"i><"pull-right"p><"clear">',
            columns: [
                { data: "id", "visible": false },
                { data: "name", "visible": true },
                { data: "price", "autowidth": true, responsivePriority: 1 },
                { data: "store", "autowidth": true, responsivePriority: 1 },
                {
                    data: "id", "visible": true, "autowidth": true, responsivePriority: 2,
                    render: function (data, type, row) {
                        return '<div class="btn-group btn-group-xs">\n' +
                            '<a href="#" onclick="Eliminar('+row.id+')" type="button" class="btn btn-sm btn-default tooltips" title="Eliminar"><i class="fa fa-trash"></i></a>\n' +
                            '</div>';
                    }
                }
            ],
            "order": [[0, "desc"]],
            "language": {
                "sProcessing": "Procesando...",
                "searchPlaceholder": "Búsqueda rápida",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_, de _TOTAL_.",
                "sInfoEmpty": "Sin registros.",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": ":",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "columnDefs": [
                { targets: [1], "width": "20%" },
                { targets: [2], "className" : "text-center"},
                { targets: [3], "className" : "text-center"},
                { targets: [4], "className" : "text-center"}
            ],
        })
        $('#showItems').modal('show');
    }

    function Eliminar ($id){
        Swal.fire({
            title: 'Confirmación',
            text: "¿Desea eliminar el registro?",
            showCancelButton: true,
            confirmButtonColor: '#3700ff',
            confirmButtonText: 'Eliminar'
            }).then((result) => {
            if (result.value) {
                deleted($id);
            }
        })
    };

    function deleted($id){
        var data = [];
        data['id'] = $id;

        $.ajax({
            url: '{{ route('api.mylist.deleteItem') }}',
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                'id': $id
            },
            cache: false,
            async: true,
            dataType: 'json',
            success: function(str){
                if (str.isError == true) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registro',
                        text: 'Error al eliminar producto!',
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro',
                        text: 'Producto eliminado con exito!',
                    })
                    updateShowItems()
                }
            },
            error: function(html, textStatus, errorThrown){
                console.log(html, textStatus, errorThrown);
            }
        });
    };

    function updateShowItems(){
        var myListId = $('#myListIdView').val();
        $('#main-table2').DataTable({
            destroy: true,
            tabIndex: -1,
            paging: false,
            lengthChange: true,
            searching: true,
            info: true,
            responsive: true,
            ajax: {
                url: '{{ route('api.mylist.showItems') }}',
                type: "GET",
                data: {
                    "myListId" : myListId
                },
            },
            "drawCallback": function( settings ) {
                $(".tooltips").tooltip({placement: 'top'});
            },
            "pageLength": 20,
            "sDom": '<"pull-left"l><"pull-right"f>rt<"pull-left"i><"pull-right"p><"clear">',
            columns: [
                { data: "id", "visible": false },
                { data: "name", "visible": true },
                { data: "price", "autowidth": true, responsivePriority: 1 },
                { data: "store", "autowidth": true, responsivePriority: 1 },
                {
                    data: "id", "visible": true, "autowidth": true, responsivePriority: 2,
                    render: function (data, type, row) {
                        return '<div class="btn-group btn-group-xs">\n' +
                            '<a href="#" onclick="Eliminar('+row.id+')" type="button" class="btn btn-sm btn-default tooltips" title="Eliminar"><i class="fa fa-trash"></i></a>\n' +
                            '</div>';
                    }
                }
            ],
            "order": [[0, "desc"]],
            "language": {
                "sProcessing": "Procesando...",
                "searchPlaceholder": "Búsqueda rápida",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_, de _TOTAL_.",
                "sInfoEmpty": "Sin registros.",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": ":",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "columnDefs": [
                { targets: [1], "width": "20%" },
                { targets: [2], "className" : "text-center"},
                { targets: [3], "className" : "text-center"},
                { targets: [4], "className" : "text-center"}
            ],
        })
    }

</script>
@endsection
