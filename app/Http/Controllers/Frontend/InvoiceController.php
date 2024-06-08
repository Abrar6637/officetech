<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\customer_order;
use App\Models\order;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class InvoiceController extends Controller
{
    public function generateInvoice($orderId)
    {
        $id = decrypt($orderId);

        $order = Order::find($id);

        if ($order) {
            $productQuantities = $order->productQuantity;
            if ($productQuantities) {
                return view('frontend.Invoice.invoice', compact('order', 'productQuantities'));
            }
        }
        else
        {
            abort(404);
        }

    }


}
