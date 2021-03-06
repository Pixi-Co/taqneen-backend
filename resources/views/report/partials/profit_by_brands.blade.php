<div class="table-responsive w3-light-gray">
    <table data-title="@trans('lang_v1.profit_by_brands')" class="table table-bordered table-striped table-text-center" id="profit_by_brands_table">
        <thead>
            <tr>
                <th>@trans('product.brand')</th>
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

    <p class="text-muted">
        @trans('lang_v1.profit_note')
    </p>
</div>
