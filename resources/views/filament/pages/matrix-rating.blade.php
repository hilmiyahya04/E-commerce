<x-filament::page>

    <div style="background:white; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.1); padding:24px; overflow-x:auto;">

        {{-- HEADER --}}
        <div style="margin-bottom:20px;">
            <h2 style="font-size:1.3rem; font-weight:700; color:#111827;">Matrix Rating User</h2>
            <p style="font-size:0.85rem; color:#6b7280; margin-top:4px;">Data rating user terhadap setiap produk</p>
        </div>

        {{-- LEGEND --}}
        <div style="display:flex; gap:16px; margin-bottom:16px; font-size:0.78rem;">
            <span style="display:flex; align-items:center; gap:4px;">
                <span style="width:12px; height:12px; background:#f0fdf4; border:1px solid #16a34a; border-radius:2px; display:inline-block;"></span>
                Rating Tinggi (≥4)
            </span>
            <span style="display:flex; align-items:center; gap:4px;">
                <span style="width:12px; height:12px; background:#fef2f2; border:1px solid #dc2626; border-radius:2px; display:inline-block;"></span>
                Rating Rendah (≤2)
            </span>
            <span style="display:flex; align-items:center; gap:4px;">
                <span style="width:12px; height:12px; background:#f3f4f6; border:1px solid #9ca3af; border-radius:2px; display:inline-block;"></span>
                Belum Rating
            </span>
        </div>

        <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
            <thead>
                <tr style="background:#f3f4f6;">
                    <th style="padding:12px 16px; text-align:left; border:1px solid #e5e7eb; font-weight:700; color:#374151;">Produk</th>
                    @foreach($users as $user)
                        <th style="padding:12px 16px; text-align:center; border:1px solid #e5e7eb; font-weight:700; color:#374151;">{{ $user->name }}</th>
                    @endforeach
                    <th style="padding:12px 16px; text-align:center; border:1px solid #e5e7eb; font-weight:700; color:#374151; background:#fef9c3;">Average</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    @php
                        $total = 0;
                        $count = 0;
                    @endphp
                    <tr style="transition: background 0.2s;">
                        <td style="padding:12px 16px; font-weight:600; border:1px solid #e5e7eb; color:#111827;">
                            {{ $product->productName }}
                        </td>

                        @foreach($users as $user)
                            @php
                                $rating = $reviews
                                    ->where('productCode', $product->productCode)
                                    ->where('userId', $user->id)
                                    ->first();

                                $value = $rating?->rating ?? null;

                                if ($value !== null) {
                                    $total += $value;
                                    $count++;
                                }

                                if ($value === null) {
                                    $bgColor = 'background:#f9fafb; color:#9ca3af;';
                                    $display = '-';
                                } elseif ($value >= 4) {
                                    $bgColor = 'background:#f0fdf4; color:#16a34a; font-weight:700;';
                                    $display = $value;
                                } elseif ($value <= 2) {
                                    $bgColor = 'background:#fef2f2; color:#dc2626; font-weight:700;';
                                    $display = $value;
                                } else {
                                    $bgColor = 'background:white; color:#374151;';
                                    $display = $value;
                                }
                            @endphp
                            <td style="padding:12px 16px; text-align:center; border:1px solid #e5e7eb; {{ $bgColor }}">
                                {{ $display }}
                            </td>
                        @endforeach

                        <td style="padding:12px 16px; text-align:center; border:1px solid #e5e7eb; background:#fef9c3; font-weight:700; color:#92400e;">
                            {{ $count > 0 ? number_format($total / $count, 2) : '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</x-filament::page>
