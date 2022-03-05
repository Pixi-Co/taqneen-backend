<div class="table-responsive w3-light-gray">
    <table data-title="@trans('lang_v1.profit_by_locations')" class="table table-bordered table-striped table-text-center" id="profit_by_locations_table">
        <thead>
            <tr>
                <th>@trans('sale.location')</th>
                <th>@trans('lang_v1.gross_profit')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong>@trans('sale.total'):</strong></td>
                <td><span class="display_currency footer_total" data-currency_symbol ="true"></span></td>
            </tr>
        </tfoot>
    </table>
</div>
