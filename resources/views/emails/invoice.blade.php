<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $transaksi->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; }
        .invoice-box { background: white; padding: 30px; border: 1px solid #eee; max-width: 700px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; vertical-align: top; }
        h2, h4 { margin-top: 0; }
        .info p { margin: 2px 0; }
        ul { margin: 0; padding-left: 16px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h2>Invoice Pembayaran</h2>

        <div class="info">
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
            <p><strong>Nama:</strong> {{ $transaksi->nama_pengguna }}</p>
            <p><strong>No. HP:</strong> {{ $transaksi->no_handphone }}</p>
            <p><strong>Alamat:</strong> {{ $transaksi->alamat }}</p>
            <p><strong>Email:</strong> {{ $transaksi->email }}</p>
            <p><strong>Jam Pengambilan:</strong> 09.00 - 18.00</p>
            <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y H:i') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>                    
                    <th>Durasi</th>
                    <th>Layanan Tambahan (Jumlah)</th>
                    <th>Harga Total</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->produk->nama ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>                    
                    <td>{{ $item->durasi }}</td>                    
                    <td>
                        @php
                            $tambahan = json_decode($item->tambahan, true);
                            $qtyTambahan = json_decode($item->qty_tambahan, true);
                        @endphp

                        @if (!empty($tambahan) && is_array($tambahan))
                            <ul>
                                @foreach ($tambahan as $key => $value)
                                    @if ($value === 'on')
                                        <li>{{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $qtyTambahan[$key] ?? 1 }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>                    
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 style="text-align: right;">Total Bayar: Rp {{ number_format($items->sum('total_harga'), 0, ',', '.') }}</h4>
    </div>
</body>
</html>
