<?php

use IP\Modules\Clients\Models\Client;
use IP\Modules\CustomFields\Models\ClientCustom;
use IP\Modules\CustomFields\Models\InvoiceCustom;
use IP\Modules\CustomFields\Models\PaymentCustom;
use IP\Modules\CustomFields\Models\QuoteCustom;
use IP\Modules\CustomFields\Models\UserCustom;
use IP\Modules\Invoices\Models\Invoice;
use IP\Modules\Payments\Models\Payment;
use IP\Modules\Quotes\Models\Quote;
use IP\Modules\Users\Models\User;
use Illuminate\Database\Migrations\Migration;

class DefaultCustomRecords extends Migration
{
    public function up()
    {
        // Insert missing client custom records.
        $clients = Client::whereNotIn('id', function ($query)
        {
            $query->select('client_id')->from('clients_custom');
        })->get();

        foreach ($clients as $client)
        {
            $client->custom()->save(new ClientCustom());
        }

        // Insert missing quote custom records.
        $quotes = Quote::whereNotIn('id', function ($query)
        {
            $query->select('quote_id')->from('quotes_custom');
        })->get();

        foreach ($quotes as $quote)
        {
            $quote->custom()->save(new QuoteCustom());
        }

        // Insert missing invoice custom records.
        $invoices = Invoice::whereNotIn('id', function ($query)
        {
            $query->select('invoice_id')->from('invoices_custom');
        })->get();

        foreach ($invoices as $invoice)
        {
            $invoice->custom()->save(new InvoiceCustom());
        }

        // Insert missing payment custom records.
        $payments = Payment::whereNotIn('id', function ($query)
        {
            $query->select('payment_id')->from('payments_custom');
        })->get();

        foreach ($payments as $payment)
        {
            $payment->custom()->save(new PaymentCustom());
        }

        // Insert missing user custom records.
        $users = User::whereNotIn('id', function ($query)
        {
            $query->select('user_id')->from('users_custom');
        })->get();

        foreach ($users as $user)
        {
            $user->custom()->save(new UserCustom());
        }
    }

    public function down()
    {
        //
    }
}
