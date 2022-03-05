<?php

namespace App\Utils;

use App\TaxRate;
use App\Transaction;

class EinvoiceUtil extends Util
{

    /**
     * Updates tax amount of a tax group
     *
     * @param int $group_tax_id
     *
     * @return void
     */
    public function sendInvoice($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);

        $einvoiceData = [];

        $einvoiceData['issuer'] = [
            "type" => session('business.common_settings.issuer_type'),
            "id" => session('business.common_settings.issuer_registration_number'),
            "name" => session('business.common_settings.issuer_registration_name'),
            "address" => [
                "branchId" => session('business.common_settings.issuer_branch_id'),
                "country" => session('business.common_settings.issuer_country_code'),
            ],
        ];
    }
}
