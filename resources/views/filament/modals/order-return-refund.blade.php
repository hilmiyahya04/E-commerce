@php
    $returns = $order->returns;
    $refunds = $order->refunds;

    $returnStatusConfig = [
        'pending'  => ['bg' => '#fef9c3', 'color' => '#a16207', 'border' => '#fde047', 'label' => 'Pending'],
        'approved' => ['bg' => '#dcfce7', 'color' => '#15803d', 'border' => '#86efac', 'label' => 'Disetujui'],
        'rejected' => ['bg' => '#fee2e2', 'color' => '#b91c1c', 'border' => '#fca5a5', 'label' => 'Ditolak'],
    ];

    $refundStatusConfig = [
        'pending'   => ['bg' => '#fef9c3', 'color' => '#a16207', 'border' => '#fde047', 'label' => 'Pending'],
        'completed' => ['bg' => '#dcfce7', 'color' => '#15803d', 'border' => '#86efac', 'label' => 'Selesai'],
        'failed'    => ['bg' => '#fee2e2', 'color' => '#b91c1c', 'border' => '#fca5a5', 'label' => 'Gagal'],
    ];
@endphp

<div style="display:flex; flex-direction:column; gap:16px; padding:4px;"
    x-data="{ activeTab: 'return' }">

    {{-- Tab Buttons --}}
    <div style="display:flex; gap:8px; border-bottom:2px solid #e5e7eb;">

        <button type="button" @click="activeTab = 'return'"
            :style="activeTab === 'return'
                ? 'padding:8px 20px; font-size:13px; font-weight:600; border:none; background:none; cursor:pointer; border-bottom:3px solid #000000; margin-bottom:-2px; color:#000000;'
                : 'padding:8px 20px; font-size:13px; font-weight:600; border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-2px; color:#6b7280;'">
            Pengembalian Barang
            <span style="margin-left:6px; background:#e0e7ff; color:#4338ca; border-radius:999px; padding:2px 8px; font-size:11px;">
                {{ $returns->count() }}
            </span>
        </button>

        <button type="button" @click="activeTab = 'refund'"
            :style="activeTab === 'refund'
                ? 'padding:8px 20px; font-size:13px; font-weight:600; border:none; background:none; cursor:pointer; border-bottom:3px solid #000000; margin-bottom:-2px; color:#000000;'
                : 'padding:8px 20px; font-size:13px; font-weight:600; border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-2px; color:#6b7280;'">
            Pengembalian Dana
            <span style="margin-left:6px; background:#f3f4f6; color:#6b7280; border-radius:999px; padding:2px 8px; font-size:11px;">
                {{ $refunds->count() }}
            </span>
        </button>

    </div>

    {{-- Tab Return --}}
    <div x-show="activeTab === 'return'">
        @if ($returns->isEmpty())
            <div style="text-align:center; padding:32px; color:#9ca3af;">
                <p style="font-size:32px; margin:0;">📦</p>
                <p style="margin:8px 0 0; font-size:13px;">Belum ada pengajuan pengembalian barang</p>
            </div>
        @else
            <div style="border-radius:12px; overflow:hidden; border:1px solid #e5e7eb; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr style="background:#000000; color:white;">
                            <th style="text-align:left; padding:12px 16px; font-weight:600; letter-spacing:0.03em;">Produk</th>
                            <th style="text-align:left; padding:12px 16px; font-weight:600; letter-spacing:0.03em;">Alasan</th>
                            <th style="text-align:left; padding:12px 16px; font-weight:600; letter-spacing:0.03em;">Tanggal</th>
                            <th style="text-align:center; padding:12px 16px; font-weight:600; letter-spacing:0.03em;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($returns as $index => $return)
                            @php
                                $s = strtolower($return->status);
                                $rc = $returnStatusConfig[$s] ?? ['bg' => '#f3f4f6', 'color' => '#4b5563', 'border' => '#d1d5db', 'label' => ucfirst($s)];
                            @endphp
                            <tr style="background:{{ $index % 2 === 0 ? '#ffffff' : '#f9fafb' }}; border-bottom:1px solid #f3f4f6; transition:background 0.15s;">
                                <td style="padding:12px 16px; font-weight:600; color:#1f2937; max-width:160px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    {{ $return->orderItem->product_name ?? '-' }}
                                </td>
                                <td style="padding:12px 16px; color:#6b7280; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    {{ $return->reason ?? '-' }}
                                </td>
                                <td style="padding:12px 16px; color:#6b7280; white-space:nowrap;">
                                    {{ $return->created_at->format('d M Y') }}
                                </td>
                                <td style="padding:12px 16px; text-align:center;">
                                    <span style="padding:4px 12px; border-radius:999px; font-size:11px; font-weight:600; background:{{ $rc['bg'] }}; color:{{ $rc['color'] }}; border:1px solid {{ $rc['border'] }}; white-space:nowrap;">
                                        {{ $rc['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Tab Refund --}}
    <div x-show="activeTab === 'refund'">
        @if ($refunds->isEmpty())
            <div style="text-align:center; padding:32px; color:#9ca3af;">
                <p style="font-size:32px; margin:0;">💸</p>
                <p style="margin:8px 0 0; font-size:13px;">
                    {{ $isAdmin ? 'Belum ada pengajuan pengembalian dana' : 'Belum ada pengembalian dana. Dana akan diproses setelah return disetujui.' }}
                </p>
            </div>
        @else
            <div style="border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr style="background:#000000; color:white;">
                            <th style="text-align:left; padding:10px 14px;">Jumlah Refund</th>
                            <th style="text-align:left; padding:10px 14px;">Tanggal</th>
                            <th style="text-align:center; padding:10px 14px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($refunds as $index => $refund)
                            @php
                                $s = strtolower($refund->status);
                                $fc = $refundStatusConfig[$s] ?? ['bg' => '#f3f4f6', 'color' => '#4b5563', 'border' => '#d1d5db', 'label' => ucfirst($s)];
                            @endphp
                            <tr style="background:{{ $index % 2 === 0 ? '#ffffff' : '#f9fafb' }}; border-bottom:1px solid #f3f4f6;">
                                <td style="padding:10px 14px; font-weight:700; color:#000000;">
                                    Rp {{ number_format($refund->amount, 0, ',', '.') }}
                                </td>
                                <td style="padding:10px 14px; color:#000000;">
                                    {{ $refund->created_at->format('d M Y') }}
                                </td>
                                <td style="padding:10px 14px; text-align:center;">
                                    <span style="padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600; background:{{ $fc['bg'] }}; color:{{ $fc['color'] }}; border:1px solid {{ $fc['border'] }};">
                                        {{ $fc['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>