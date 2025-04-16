<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td ul {
            padding-left: 15px;
            margin: 0;
        }
    </style>
</head>
<body>

    <h2>Data Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Pembeli</th>
                <th>No HP Pembeli</th>
                <th>Point Pembeli</th>
                <th>Produk</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
                <th>Total Diskon Point</th>
                <th>Total Kembalian</th>
                <th>Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $item)
                <tr>
                    <td>{{ optional($item->customer)->name ?? 'Bukan Member' }}</td>
                    <td>{{ optional($item->customer)->no_hp ?? '-' }}</td>
                    <td>{{ optional($item->customer)->point ?? 0 }}</td>
                    <td>
                        <ul>
                            @foreach ($item->Detail_sale as $detail)
                                <li>
                                    {{ optional($detail->product)->name ?? 'Produk tidak tersedia' }}
                                    ({{ $detail->amount }} : Rp. {{ number_format($detail->subtotal, 0, ',', '.') }})
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Rp. {{ number_format($item->Detail_sale->sum('subtotal'), 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($item->total_pay, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format(($item->total_price - (optional($item->customer)->point ?? 0)), 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($item->total_return, 0, ',', '.') }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
