<div class="modal fade" id="modalFilters" role="dialog" aria-labelledby="modalFilters" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout" role="document">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <h4 class="modal-title" id="">Filtros de busqueda avanzada
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </h4>
            </div>
            <div class="modal-body" id="body-detail">
                <form id="form_filters">
                    <div class="row">
                        @yield('filters')
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background-color: #f3f6f9; float: left;padding-top: 15px;">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info btn-sm pull-right" onclick="FilterData()"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filtrar </button>
            </div>
        </div>
    </div>
</div>
