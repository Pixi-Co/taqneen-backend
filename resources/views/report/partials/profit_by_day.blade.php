<div class="table-responsive w3-light-gray">
    <table data-title="@trans('lang_v1.profit_by_day')" class="table table-bordered table-striped table-text-center" id="profit_by_day_table">
        <thead>
            <tr>
                <th>@trans('lang_v1.days')</th>
                <th>@trans('lang_v1.gross_profit')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($days as $day)
                <tr>
                    <td>@trans('lang_v1.' . $day)</td>
                    <td><span class="display_currency gross-profit" data-currency_symbol="true" data-orig-value="{{$profits[$day] ?? 0}}">{{$profits[$day] ?? 0}}</span></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong>@trans('sale.total'):</strong></td>
                <td><span class="display_currency footer_total" data-currency_symbol ="true"></span></td>
            </tr>
        </tfoot>
    </table>
</div>
