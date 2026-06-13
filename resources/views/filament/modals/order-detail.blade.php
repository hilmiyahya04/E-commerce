<div style="display:flex; flex-direction:column; gap:20px; padding:4px;">

    {{-- Info Cards --}}
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px;">
        <div style="border-radius:12px; border:1px solid #e5e7eb; background:#f9fafb; padding:12px;">
            <p style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 4px;">No. Pesanan</p>
            <p style="font-size:13px; font-weight:700; color:#1f2937; margin:0;">#{{ $order->id_pemesanan }}</p>
        </div>
        <div style="border-radius:12px; border:1px solid #e5e7eb; background:#f9fafb; padding:12px;">
            <p style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 4px;">Tanggal</p>
            <p style="font-size:13px; font-weight:600; color:#1f2937; margin:0;">{{ \Carbon\Carbon::parse($order->orderDate)->format('d M Y') }}</p>
        </div>
        <div style="border-radius:12px; border:1px solid #e5e7eb; background:#f9fafb; padding:12px;">
            <p style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 4px;">Metode Bayar</p>
            <p style="font-size:13px; font-weight:600; color:#1f2937; margin:0;">{{ $order->paymentMethod }}</p>
        </div>
    </div>

    {{-- Status Badge --}}
    @php
        $statusStyle = match(strtolower($order->orderStatus)) {
            'pending'   => 'background:#fef9c3; color:#a16207; border:1px solid #fde047;',
            'processed' => 'background:#dbeafe; color:#1d4ed8; border:1px solid #93c5fd;',
            'shipped'   => 'background:#e0e7ff; color:#4338ca; border:1px solid #a5b4fc;',
            'completed' => 'background:#dcfce7; color:#15803d; border:1px solid #86efac;',
            'cancelled' => 'background:#fee2e2; color:#b91c1c; border:1px solid #fca5a5;',
            default     => 'background:#f3f4f6; color:#4b5563; border:1px solid #d1d5db;',
        };
    @endphp
    <div style="display:flex; align-items:center; gap:8px;">
        <span style="font-size:11px; color:#6b7280; text-transform:uppercase;">Status:</span>
        <span style="padding:4px 12px; border-radius:999px; font-size:12px; font-weight:600; {{ $statusStyle }}">
            {{ ucfirst($order->orderStatus) }}
        </span>
    </div>

    {{-- Tabel --}}
    <div style="border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="background:#000000; color:white;">
                    <th style="text-align:left; padding:10px 14px; font-weight:600;">Produk</th>
                    <th style="text-align:center; padding:10px 14px; font-weight:600;">Qty</th>
                    <th style="text-align:right; padding:10px 14px; font-weight:600;">Harga Satuan</th>
                    <th style="text-align:right; padding:10px 14px; font-weight:600;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $index => $item)
                <tr style="background:{{ $index % 2 === 0 ? '#ffffff' : '#f9fafb' }}; border-bottom:1px solid #f3f4f6;">
                    <td style="padding:10px 14px; font-weight:500; color:#1f2937;">{{ $item->product_name ?? '-' }}</td>
                    <td style="padding:10px 14px; text-align:center;">
                        <span style="display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:50%; background:#000000; color:#ffffff; font-weight:700; font-size:12px;">
                            {{ $item->qty }}
                        </span>
                    </td>
                    <td style="padding:10px 14px; text-align:right; color:#6b7280;">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td style="padding:10px 14px; text-align:right; font-weight:600; color:#1f2937;">Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background:#f9fafb; border-top:2px solid #e5e7eb;">
                    <td colspan="3" style="padding:12px 14px; text-align:right; font-size:12px; font-weight:600; color:#000000; text-transform:uppercase; letter-spacing:0.05em;">Total Pembayaran</td>
                    <td style="padding:12px 14px; text-align:right; font-size:15px; font-weight:700; color:#000000;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>