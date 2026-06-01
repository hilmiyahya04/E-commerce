<x-filament::page>

    {{-- TAB NAVIGATION --}}
    <div style="display:flex; gap:8px; margin-bottom:24px; border-bottom:2px solid #e5e7eb; padding-bottom:0;">
        <button onclick="showTab('matrix')" id="tab-matrix"
            style="padding:10px 20px; font-weight:600; font-size:0.9rem; border:none; background:none; cursor:pointer; border-bottom:3px solid #f59e0b; color:#f59e0b;">
            1. Matrix Rating
        </button>
        <button onclick="showTab('similarity')" id="tab-similarity"
            style="padding:10px 20px; font-weight:600; font-size:0.9rem; border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; color:#6b7280;">
            2. Cosine Similarity
        </button>
        <button onclick="showTab('prediksi')" id="tab-prediksi"
            style="padding:10px 20px; font-weight:600; font-size:0.9rem; border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; color:#6b7280;">
            3. Prediksi Rating
        </button>
        <button onclick="showTab('rekomendasi')" id="tab-rekomendasi"
            style="padding:10px 20px; font-weight:600; font-size:0.9rem; border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; color:#6b7280;">
            4. Rekomendasi
        </button>
        <button onclick="showTab('mae')" id="tab-mae"
            style="padding:10px 20px; font-weight:600; font-size:0.9rem; border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; color:#6b7280;">
            5. Evaluasi MAE
        </button>
    </div>

    {{-- TAB 1: MATRIKS RATING --}}
    <div id="content-matrix">
        <div style="background:#ffffff; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.1); padding:24px; overflow-x:auto;">
            <h2 style="font-size:1.2rem; font-weight:700; margin-bottom:8px; color:#111827;">Matriks Rating</h2>
            <p style="font-size:0.85rem; color:#6b7280; margin-bottom:16px;">Data rating user terhadap setiap produk</p>

            <div style="display:flex; gap:16px; margin-bottom:16px; font-size:0.78rem; color:#374151;">
                <span style="display:flex; align-items:center; gap:4px;">
                    <span style="width:12px; height:12px; background:#f0fdf4; border:1px solid #16a34a; border-radius:2px; display:inline-block;"></span>
                    Rating Tinggi (≥4)
                </span>
                <span style="display:flex; align-items:center; gap:4px;">
                    <span style="width:12px; height:12px; background:#fef2f2; border:1px solid #dc2626; border-radius:2px; display:inline-block;"></span>
                    Rating Rendah (≤2)
                </span>
                <span style="display:flex; align-items:center; gap:4px;">
                    <span style="width:12px; height:12px; background:#f9fafb; border:1px solid #9ca3af; border-radius:2px; display:inline-block;"></span>
                    Belum Rating
                </span>
            </div>

            <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
                <thead>
                    <tr style="background:#f3f4f6;">
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">Produk</th>
                        @foreach($users as $user)
                            <th style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#374151; font-weight:700;">{{ $user->name }}</th>
                        @endforeach
                        <th style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#92400e; font-weight:700; background:#fef9c3;">Average</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        @php $total = 0; $count = 0; @endphp
                        <tr>
                            <td style="padding:10px 16px; font-weight:600; border:1px solid #e5e7eb; color:#111827;">{{ $product->productName }}</td>
                            @foreach($users as $user)
                                @php
                                    $val = $matrix[$user->id][$product->productCode] ?? null;
                                    if ($val !== null) { $total += $val; $count++; }
                                    if ($val === null) {
                                        $bgColor = 'background:#f9fafb; color:#9ca3af;';
                                        $display = '-';
                                    } elseif ($val >= 4) {
                                        $bgColor = 'background:#f0fdf4; color:#16a34a; font-weight:700;';
                                        $display = $val;
                                    } elseif ($val <= 2) {
                                        $bgColor = 'background:#fef2f2; color:#dc2626; font-weight:700;';
                                        $display = $val;
                                    } else {
                                        $bgColor = 'background:#ffffff; color:#374151;';
                                        $display = $val;
                                    }
                                @endphp
                                <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; {{ $bgColor }}">{{ $display }}</td>
                            @endforeach
                            <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; background:#fef9c3; font-weight:700; color:#92400e;">
                                {{ $count > 0 ? number_format($total / $count, 2) : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TAB 2: COSINE SIMILARITY --}}
    <div id="content-similarity" style="display:none;">
        <div style="background:#ffffff; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.1); padding:24px; overflow-x:auto;">
            <h2 style="font-size:1.2rem; font-weight:700; margin-bottom:8px; color:#111827;">Cosine Similarity Antar Produk</h2>
            <p style="font-size:0.85rem; color:#6b7280; margin-bottom:16px;">Tingkat kemiripan antar produk berdasarkan pola rating user</p>

            <div style="display:flex; gap:16px; margin-bottom:16px; font-size:0.78rem; color:#374151;">
                <span style="display:flex; align-items:center; gap:4px;">
                    <span style="width:12px; height:12px; background:#f0fdf4; border:1px solid #16a34a; border-radius:2px; display:inline-block;"></span>
                    Similarity Tinggi (≥0.8)
                </span>
                <span style="display:flex; align-items:center; gap:4px;">
                    <span style="width:12px; height:12px; background:#e5e7eb; border:1px solid #9ca3af; border-radius:2px; display:inline-block;"></span>
                    Diagonal (sama)
                </span>
            </div>

            <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
                <thead>
                    <tr style="background:#f3f4f6;">
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">Produk</th>
                        @foreach($products as $product)
                            <th style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#374151; font-weight:700;">{{ $product->productName }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $productA)
                        <tr>
                            <td style="padding:10px 16px; font-weight:600; border:1px solid #e5e7eb; color:#111827;">{{ $productA->productName }}</td>
                            @foreach($products as $productB)
                                @php
                                    $sim = $similarities[$productA->productCode][$productB->productCode] ?? 0;
                                    if ($productA->id == $productB->id) {
                                        $bgColor = 'background:#e5e7eb; color:#374151; font-weight:700;';
                                    } elseif ($sim >= 0.8) {
                                        $bgColor = 'background:#f0fdf4; color:#16a34a; font-weight:700;';
                                    } else {
                                        $bgColor = 'background:#ffffff; color:#374151;';
                                    }
                                @endphp
                                <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; {{ $bgColor }}">{{ $sim }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TAB 3: PREDIKSI RATING --}}
    <div id="content-prediksi" style="display:none;">
        <div style="background:#ffffff; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.1); padding:24px; overflow-x:auto;">
            <h2 style="font-size:1.2rem; font-weight:700; margin-bottom:8px; color:#111827;">Prediksi Rating</h2>
            <p style="font-size:0.85rem; color:#6b7280; margin-bottom:16px;">Prediksi rating produk yang belum dirating oleh user</p>

            <div style="display:flex; gap:16px; margin-bottom:16px; font-size:0.78rem; color:#374151;">
                <span style="display:flex; align-items:center; gap:4px;">
                    <span style="width:12px; height:12px; background:#f3f4f6; border:1px solid #9ca3af; border-radius:2px; display:inline-block;"></span>
                    Rating Asli (✓)
                </span>
                <span style="display:flex; align-items:center; gap:4px;">
                    <span style="width:12px; height:12px; background:#eff6ff; border:1px solid #2563eb; border-radius:2px; display:inline-block;"></span>
                    Prediksi Sistem (*)
                </span>
            </div>

            <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
                <thead>
                    <tr style="background:#f3f4f6;">
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">Produk</th>
                        @foreach($users as $user)
                            <th style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#374151; font-weight:700;">{{ $user->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td style="padding:10px 16px; font-weight:600; border:1px solid #e5e7eb; color:#111827;">{{ $product->productName }}</td>
                            @foreach($users as $user)
                                @php
                                    $actual = $matrix[$user->id][$product->productCode] ?? null;
                                    $predicted = $predictions[$user->id][$product->productCode] ?? null;
                                    if ($actual !== null) {
                                        $bgColor = 'background:#f3f4f6; color:#6b7280;';
                                        $label = $actual . ' ✓';
                                    } elseif ($predicted !== null) {
                                        $bgColor = 'background:#eff6ff; color:#2563eb; font-weight:700;';
                                        $label = $predicted . ' *';
                                    } else {
                                        $bgColor = 'background:#ffffff; color:#9ca3af;';
                                        $label = '-';
                                    }
                                @endphp
                                <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; {{ $bgColor }}">{{ $label }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="margin-top:12px; font-size:0.75rem; color:#6b7280;">
                ✓ = rating asli &nbsp;|&nbsp; * = prediksi sistem
            </p>
        </div>
    </div>

    {{-- TAB 4: REKOMENDASI --}}
    <div id="content-rekomendasi" style="display:none;">
        <div style="background:#ffffff; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.1); padding:24px; overflow-x:auto;">
            <h2 style="font-size:1.2rem; font-weight:700; margin-bottom:8px; color:#111827;">Rekomendasi Produk per User</h2>
            <p style="font-size:0.85rem; color:#6b7280; margin-bottom:16px;">Produk yang direkomendasikan berdasarkan prediksi rating tertinggi</p>

            <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
                <thead>
                    <tr style="background:#f3f4f6;">
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">User</th>
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">#1 Rekomendasi</th>
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">#2 Rekomendasi</th>
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">#3 Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td style="padding:10px 16px; font-weight:600; border:1px solid #e5e7eb; color:#111827;">{{ $user->name }}</td>
                            @php $recs = $recommendations[$user->id] ?? []; @endphp
                            @for($i = 0; $i < 3; $i++)
                                @php $rec = $recs[$i] ?? null; @endphp
                                <td style="padding:10px 16px; border:1px solid #e5e7eb; {{ $rec ? 'background:#f0fdf4;' : 'background:#ffffff;' }}">
                                    @if($rec)
                                        <span style="font-weight:600; color:#16a34a;">{{ $rec['productName'] }}</span>
                                        <span style="font-size:0.75rem; color:#6b7280; display:block;">skor: {{ $rec['score'] }}</span>
                                    @else
                                        <span style="color:#9ca3af;">-</span>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TAB 5: EVALUASI MAE --}}
    <div id="content-mae" style="display:none;">
        <div style="background:#ffffff; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.1); padding:24px; overflow-x:auto;">
            <h2 style="font-size:1.2rem; font-weight:700; margin-bottom:8px; color:#111827;">Evaluasi MAE</h2>
            <p style="font-size:0.85rem; color:#6b7280; margin-bottom:16px;">Mean Absolute Error — rata-rata selisih antara rating asli dan prediksi sistem</p>

            {{-- SKOR MAE --}}
            <div style="background:#f0fdf4; border:1px solid #16a34a; border-radius:10px; padding:16px 24px; margin-bottom:24px; display:inline-block;">
                <p style="font-size:0.85rem; color:#16a34a; margin:0;">Total MAE Sistem</p>
                <p style="font-size:2rem; font-weight:800; color:#15803d; margin:4px 0;">{{ $mae }}</p>
                <p style="font-size:0.75rem; color:#6b7280; margin:0;">
                    Semakin kecil nilai MAE, semakin akurat sistem rekomendasi
                </p>
            </div>

            {{-- TABEL DETAIL MAE --}}
            <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
                <thead>
                    <tr style="background:#f3f4f6;">
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">User</th>
                        <th style="padding:10px 16px; text-align:left; border:1px solid #e5e7eb; color:#374151; font-weight:700;">Produk</th>
                        <th style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#374151; font-weight:700;">Rating Asli</th>
                        <th style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#374151; font-weight:700;">Prediksi</th>
                        <th style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#374151; font-weight:700;">|Error|</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maeDetails as $detail)
                        @php
                            if ($detail['error'] <= 0.5) {
                                $errorColor = 'color:#16a34a; font-weight:700;';
                            } elseif ($detail['error'] <= 1) {
                                $errorColor = 'color:#d97706; font-weight:700;';
                            } else {
                                $errorColor = 'color:#dc2626; font-weight:700;';
                            }
                        @endphp
                        <tr>
                            <td style="padding:10px 16px; border:1px solid #e5e7eb; color:#111827;">{{ $detail['userName'] }}</td>
                            <td style="padding:10px 16px; border:1px solid #e5e7eb; color:#111827; font-weight:600;">{{ $detail['productName'] }}</td>
                            <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#374151;">{{ $detail['actual'] }}</td>
                            <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; color:#2563eb;">{{ $detail['predicted'] }}</td>
                            <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; {{ $errorColor }}">{{ $detail['error'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background:#f3f4f6;">
                        <td colspan="4" style="padding:10px 16px; text-align:right; border:1px solid #e5e7eb; font-weight:700; color:#374151;">MAE Total:</td>
                        <td style="padding:10px 16px; text-align:center; border:1px solid #e5e7eb; font-weight:800; color:#15803d; font-size:1rem;">{{ $mae }}</td>
                    </tr>
                </tfoot>
            </table>

            <div style="margin-top:16px; font-size:0.78rem; color:#6b7280; display:flex; gap:16px;">
                <span style="color:#16a34a;">● Error ≤ 0.5 = Sangat Akurat</span>
                <span style="color:#d97706;">● Error ≤ 1.0 = Cukup Akurat</span>
                <span style="color:#dc2626;">● Error > 1.0 = Kurang Akurat</span>
            </div>
        </div>
    </div>

    {{-- JAVASCRIPT TAB --}}
    <script>
        function showTab(tab) {
            const tabs = ['matrix', 'similarity', 'prediksi', 'rekomendasi', 'mae'];
            tabs.forEach(t => {
                document.getElementById('content-' + t).style.display = 'none';
                document.getElementById('tab-' + t).style.borderBottomColor = 'transparent';
                document.getElementById('tab-' + t).style.color = '#6b7280';
            });
            document.getElementById('content-' + tab).style.display = 'block';
            document.getElementById('tab-' + tab).style.borderBottomColor = '#f59e0b';
            document.getElementById('tab-' + tab).style.color = '#f59e0b';
        }
    </script>

</x-filament::page>