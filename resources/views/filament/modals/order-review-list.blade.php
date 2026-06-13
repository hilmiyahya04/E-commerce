<div style="padding:4px;">
    @if ($reviews->isEmpty())
        <div style="text-align:center; padding:32px; color:#9ca3af;">
            <p style="font-size:32px; margin:0;">⭐</p>
            <p style="margin:8px 0 0; font-size:13px;">User belum memberikan review apapun</p>
        </div>
    @else
        <div style="border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">
            <table style="width:100%; border-collapse:collapse; font-size:13px;">
                <thead>
                    <tr style="background:#000000; color:white;">
                        <th style="text-align:left; padding:10px 14px; font-weight:600;">Produk</th>
                        <th style="text-align:center; padding:10px 14px; font-weight:600;">Rating</th>
                        <th style="text-align:right; padding:10px 14px; font-weight:600;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $index => $review)
                    <tr style="background:{{ $index % 2 === 0 ? '#ffffff' : '#f9fafb' }}; border-bottom:1px solid #f3f4f6;">
                        <td style="padding:10px 14px; font-weight:500; color:#1f2937;">
                            {{ $review->product->productName ?? $review->productCode }}
                        </td>
                        <td style="padding:10px 14px; text-align:center;">
                            @php $star = (int) $review->rating; @endphp
                            <span style="color:#f59e0b; font-size:15px; letter-spacing:1px;">
                                {{ str_repeat('⭐', $star) }}
                            </span>
                            <span style="font-size:11px; color:#6b7280; margin-left:4px;">({{ $star }}/5)</span>
                        </td>
                        <td style="padding:10px 14px; text-align:right; color:#6b7280; font-size:12px;">
                            {{ $review->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>