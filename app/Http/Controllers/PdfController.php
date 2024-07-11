<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function __invoke()
    {
        $customers = Customer::with('hobbies')->get();

        $pdf = Pdf::loadView('pdf.customers', compact('customers'))->setPaper('a4');

        return $pdf->stream('customers.pdf');
    }
}
