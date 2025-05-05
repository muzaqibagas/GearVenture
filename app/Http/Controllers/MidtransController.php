<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Set konfigurasi Midtrans menggunakan variabel lingkungan (env)
        Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-GULz-_jkx9mXP_cPdXny9znh');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Validasi request (opsional, tapi sangat disarankan)
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $order_id = null;

        while (!$order_id) {
            $randomNumber = mt_rand(1000, 9999);
            $generatedId = 'GVR' . $randomNumber;

            // Cek apakah ID sudah ada di database
            if (!Transaksi::where('id', $generatedId)->exists()) {
                $order_id = $generatedId;
            }
        }

        // Mendapatkan total amount dari request
        $gross_amount = $request->input('amount');

        // Mendapatkan informasi pengguna yang terautentikasi
        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            $phone_number = $user->phone_number ?? null; 
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
            ],
            'customer_details' => [
                'name' => $name,
                'email' => $email,
                'phone_number' => $phone_number,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json([
                'token' => $snapToken,
                'environment' => Config::$isProduction ? 'Production' : 'Sandbox',
                'method' => 'POST',
                'url' => Config::$isProduction
                    ? 'https://app.midtrans.com/snap/v1/transactions'
                    : 'https://app.sandbox.midtrans.com/snap/v1/transactions',
                'order_id' => $order_id
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}