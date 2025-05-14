<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */    

     public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
            'durasi' => 'nullable|array',
            'tanggal' => 'required|array',
            'total_harga' => 'required|array',
            'tambahan' => 'nullable|array',
            'qty_tambahan' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {
            $transaksiData = [];

            foreach ($request->produk_id as $index => $produkId) {

                $produk = Barang::find($produkId);

                // Validasi stok tersedia
                if (!$produk || $produk->stok < $request->jumlah[$index]) {
                    throw new \Exception("Stok untuk produk {$produk->nama} tidak mencukupi.");
                }

                // Kurangi stok
                $produk->stok -= $request->jumlah[$index];
                $produk->save();

                // Tambahan
                $tambahanPerItem = $request->tambahan[$index] ?? [];
                $qtyTambahanPerItem = $request->qty_tambahan[$index] ?? [];

                // Buat transaksi
                $transaksi = Transaksi::create([
                    'id'             => $request->id,
                    'user_id'        => Auth::id(),
                    'produk_id'      => $produkId,
                    'nama_pengguna'  => $request->nama,
                    'no_handphone'   => $request->no_hp,
                    'alamat'         => $request->alamat,
                    'email'          => $request->email,
                    'durasi'         => $request->durasi[$index],
                    'jumlah'         => $request->jumlah[$index],
                    'tanggal'        => $request->tanggal[$index],
                    'total_harga'    => $request->total_harga[$index],
                    'tambahan'       => json_encode($tambahanPerItem),
                    'qty_tambahan'   => json_encode($qtyTambahanPerItem),
                    'status'         => 'belum lunas',
                ]);

                $transaksiData[] = $transaksi;
            }

            // Hapus keranjang user
            Keranjang::where('user_id', Auth::id())->delete();

            // Kirim invoice
            $this->sendInvoice($request->id);

            DB::commit();

            return redirect()->route('catalog')->with('success', 'Checkout berhasil! Invoice telah dikirim ke email.');

        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }
     

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        \Log::info("Menghapus item dengan ID: " . $id);

        $item = Transaksi::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }


    public function sendInvoice($orderId)
    {
        $transaksiItems = Transaksi::where('id', $orderId)->get();

        if ($transaksiItems->isEmpty()) return;

        $transaksi = $transaksiItems->first();

        Mail::send('emails.invoice', [
            'transaksi' => $transaksi,
            'items' => $transaksiItems,
        ], function ($message) use ($transaksi) {
            $message->to($transaksi->email)
                ->subject("Invoice Pembayaran #{$transaksi->id}");
        });
    }
    public function getNotifikasiPesananBaru()
    {
        $notifikasiBaru = Transaksi::where('is_new', true)->latest()->take(5)->get();

        return view('dashboard', [
            'notifikasiBaru' => $notifikasiBaru
        ]);
    }
    public function tandaiNotifikasiSudahDibaca($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        if ($transaksi->is_new) {
            $transaksi->is_new = false;
            $transaksi->save();
        }

        return redirect()->route('status', $id);
    }
    public function statusView()
    {
        $transaksi = Transaksi::all(); // ambil semua pesanan
        return view('admin.status', compact('transaksi'));
    }
    
    public function laporans(Request $request)
    {
        // Ambil semua tahun dan bulan dari transaksi
        $tahunList = Transaksi::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
        $bulanList = Transaksi::selectRaw('MONTH(created_at) as bulan')->distinct()->pluck('bulan');

        // Ambil filter dari request
        $tahun = $request->input('tahun', now()->year);
        $bulan = $request->input('bulan', null); // bisa kosong

        // Query data transaksi berdasarkan filter
        $transaksiQuery = Transaksi::whereYear('created_at', $tahun)
            ->where('status', 'lunas');

        if ($bulan) {
            $transaksiQuery->whereMonth('created_at', $bulan);
        }

        $transaksi = $transaksiQuery
            ->select('produk_id', DB::raw('SUM(jumlah) as total_penyewaan'), DB::raw('SUM(total_harga) as total_pendapatan'))
            ->groupBy('produk_id')
            ->with('produk')
            ->get();

        return view('admin.laporan-tahunan', compact('transaksi', 'tahunList', 'bulanList', 'tahun', 'bulan'));
    }
    public function updateJumlah(Request $request)
    {
        $item = KeranjangItem::find($request->item_id);

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        // Pastikan jumlah tidak kurang dari 1
        $item->jumlah = max(1, min($request->jumlah, 99));
        $item->save();

        return response()->json(['success' => true, 'message' => 'Jumlah berhasil diperbarui.']);
    }

}
