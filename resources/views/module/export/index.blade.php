<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px 12px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #007BFF;
            color: white;
            font-weight: 600;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f8ff;
        }

        tr:hover {
            background-color: #e6f0ff;
        }

        td[colspan] {
            background-color: #f5f5f5;
            text-align: center;
            font-style: italic;
        }

        @media print {
            body {
                background: white;
                margin: 0;
            }

            table {
                box-shadow: none;
            }
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
                <th>Qty</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
                <th>Total Diskon Point</th>
                <th>Total Kembalian</th>
                <th>Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $item)
                @php
                    $details = $item->Detail_sale;
                    $rowspan = $details->count();
                @endphp
        
                @foreach ($details as $index => $detail)
                    <tr>
                        @if ($loop->first)
                            <td rowspan="{{ $rowspan }}">{{ optional($item->customer)->name ?? 'Bukan Member' }}</td>
                            <td rowspan="{{ $rowspan }}">{{ optional($item->customer)->no_hp ?? '-' }}</td>
                            <td rowspan="{{ $rowspan }}">{{ optional($item->customer)->point ?? 0 }}</td>
                        @endif
                        <td>{{ optional($detail->product)->name ?? 'Produk tidak tersedia' }}</td>
                        <td>{{ $detail->amount }}</td>
                        <td>Rp. {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        @if ($loop->first)
                            <td rowspan="{{ $rowspan }}">Rp. {{ number_format($details->sum('subtotal'), 0, ',', '.') }}</td>
                            <td rowspan="{{ $rowspan }}">Rp. {{ number_format($item->total_pay + $item->total_point, 0, ',', '.') }}</td>
                            <td rowspan="{{ $rowspan }}">Rp. {{ number_format(($item->total_price - (optional($item->customer)->point ?? 0)), 0, ',', '.') }}</td>
                            <td rowspan="{{ $rowspan }}">Rp. {{ number_format($item->total_return, 0, ',', '.') }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        
    </table>

</body>
</html>
