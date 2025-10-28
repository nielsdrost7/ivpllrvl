<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Controllers\CustomerPortalControllerUserClient;
use Modules\Core\Controllers\Gateways\PaypalController;
use Modules\Core\Controllers\Gateways\StripeController;
use Modules\Core\Controllers\GetController;
use Modules\Core\Controllers\InvoicesControllerUserClient;
use Modules\Core\Controllers\PaymentInformation;
use Modules\Core\Controllers\PaymentsControllerUserClient;
use Modules\Core\Controllers\QuotesControllerUserClient;
use Modules\Core\Controllers\View;

Route::middleware('web')->group(function () {
    Route::get('guest', [InvoicesControllerUserClient::class, 'index'])->name('guest.index');
    Route::get('guest/status', [InvoicesControllerUserClient::class, 'status'])->name('guest.status');
    Route::get('guest/view', [InvoicesControllerUserClient::class, 'view'])->name('guest.view');
    Route::get('guest/generate-pdf', [InvoicesControllerUserClient::class, 'generatePdf'])->name('guest.generate-pdf');
    Route::get('guest/generate-sumex-pdf', [InvoicesControllerUserClient::class, 'generateSumexPdf'])->name('guest.generate-sumex-pdf');
    Route::get('guest', [CustomerPortalControllerUserClient::class, 'index'])->name('guest.index');
    Route::get('guest', [QuotesControllerUserClient::class, 'index'])->name('guest.index');
    Route::get('guest/status', [QuotesControllerUserClient::class, 'status'])->name('guest.status');
    Route::get('guest/view', [QuotesControllerUserClient::class, 'view'])->name('guest.view');
    Route::get('guest/generate-pdf', [QuotesControllerUserClient::class, 'generatePdf'])->name('guest.generate-pdf');
    Route::get('guest/approve', [QuotesControllerUserClient::class, 'approve'])->name('guest.approve');
    Route::get('guest/reject', [QuotesControllerUserClient::class, 'reject'])->name('guest.reject');
    Route::get('guest', [PaymentsControllerUserClient::class, 'index'])->name('guest.index');
    Route::get('guest/invoice', [View::class, 'invoice'])->name('guest.invoice');
    Route::get('guest/generate-invoice-pdf', [View::class, 'generateInvoicePdf'])->name('guest.generate-invoice-pdf');
    Route::get('guest/generate-sumex-pdf', [View::class, 'generateSumexPdf'])->name('guest.generate-sumex-pdf');
    Route::get('guest/quote', [View::class, 'quote'])->name('guest.quote');
    Route::get('guest/generate-quote-pdf', [View::class, 'generateQuotePdf'])->name('guest.generate-quote-pdf');
    Route::get('guest/approve-quote', [View::class, 'approveQuote'])->name('guest.approve-quote');
    Route::get('guest/reject-quote', [View::class, 'rejectQuote'])->name('guest.reject-quote');
    Route::get('guest/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->name('guest.create-checkout-session');
    Route::get('guest/callback', [StripeController::class, 'callback'])->name('guest.callback');
    Route::get('guest/paypal-create-order', [PaypalController::class, 'paypalCreateOrder'])->name('guest.paypal-create-order');
    Route::get('guest/paypal-capture-payment', [PaypalController::class, 'paypalCapturePayment'])->name('guest.paypal-capture-payment');
    Route::get('guest/form', [PaymentInformation::class, 'form'])->name('guest.form');
    Route::get('guest/stripe', [PaymentInformation::class, 'stripe'])->name('guest.stripe');
    Route::get('guest/paypal', [PaymentInformation::class, 'paypal'])->name('guest.paypal');
    Route::get('guest/show-files', [GetController::class, 'showFiles'])->name('guest.show-files');
    Route::get('guest/get-file', [GetController::class, 'getFile'])->name('guest.get-file');
});
