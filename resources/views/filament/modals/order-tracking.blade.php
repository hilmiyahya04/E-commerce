@php
    $steps = ['pending', 'processed', 'shipped', 'completed'];
    $stepConfig = [
        'pending'   => ['icon' => '⏳', 'label' => 'Pending',   'color' => '#a16207', 'bg' => '#fef9c3', 'border' => '#fde047'],
        'processed' => ['icon' => '⚙️', 'label' => 'Diproses',  'color' => '#1d4ed8', 'bg' => '#dbeafe', 'border' => '#93c5fd'],
        'shipped'   => ['icon' => '🚚', 'label' => 'Dikirim',   'color' => '#4338ca', 'bg' => '#e0e7ff', 'border' => '#a5b4fc'],
        'completed' => ['icon' => '✅', 'label' => 'Selesai',   'color' => '#15803d', 'bg' => '#dcfce7', 'border' => '#86efac'],
        'cancelled' => ['icon' => '❌', 'label' => 'Dibatalkan','color' => '#b91c1c', 'bg' => '#fee2e2', 'border' => '#fca5a5'],
    ];

    $doneStatuses = $order->tracking->pluck('status')->map(fn($s) => strtolower($s))->toArray();
    $currentStatus = strtolower($order->orderStatus);
    $isCancelled = $currentStatus === 'cancelled';
    $activeSteps = $isCancelled ? ['pending', 'cancelled'] : $steps;
@endphp

<div style="display:flex; flex-direction:column; gap:20px; padding:4px;">

    {{-- Progress Bar --}}
    <div style="display:flex; align-items:flex-start; justify-content:space-between;">
        @foreach ($activeSteps as $i => $step)
            @php
                $cfg = $stepConfig[$step] ?? $stepConfig['pending'];
                $isDone = in_array($step, $doneStatuses);
                $isActive = $step === $currentStatus;
                $circleBg = ($isDone || $isActive) ? $cfg['bg'] : '#f3f4f6';
                $circleBorder = ($isDone || $isActive) ? $cfg['border'] : '#d1d5db';
                $labelColor = ($isDone || $isActive) ? $cfg['color'] : '#9ca3af';
            @endphp

            <div style="display:flex; flex-direction:column; align-items:center; flex:1; position:relative;">
                {{-- Garis penghubung kiri --}}
                @if ($i > 0)
                    <div style="position:absolute; top:14px; right:50%; width:100%; height:2px; background:{{ in_array($activeSteps[$i-1], $doneStatuses) ? $stepConfig[$activeSteps[$i-1]]['border'] : '#e5e7eb' }};"></div>
                @endif

                {{-- Lingkaran --}}
                <div style="width:30px; height:30px; border-radius:50%; background:{{ $circleBg }}; border:2px solid {{ $circleBorder }}; display:flex; align-items:center; justify-content:center; font-size:14px; position:relative; z-index:1;">
                    {{ $cfg['icon'] }}
                </div>

                {{-- Label --}}
                <p style="margin:6px 0 0; font-size:11px; font-weight:{{ $isActive ? '700' : '500' }}; color:{{ $labelColor }}; text-align:center;">
                    {{ $cfg['label'] }}
                </p>
            </div>
        @endforeach
    </div>

    {{-- Tabel History --}}
    <div style="border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="background:#000000; color:white;">
                    <th style="text-align:left; padding:10px 14px; font-weight:600;">Waktu</th>
                    <th style="text-align:left; padding:10px 14px; font-weight:600;">Status</th>
                    <th style="text-align:left; padding:10px 14px; font-weight:600;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->tracking->sortBy('created_at') as $index => $track)
                    @php
                        $s = strtolower($track->status);
                        $tc = $stepConfig[$s] ?? ['color' => '#4b5563', 'bg' => '#f3f4f6', 'border' => '#d1d5db', 'label' => ucfirst($s)];
                    @endphp
                    <tr style="background:{{ $index % 2 === 0 ? '#ffffff' : '#f9fafb' }}; border-bottom:1px solid #f3f4f6;">
                        <td style="padding:10px 14px; color:#6b7280; white-space:nowrap;">
                            {{ \Carbon\Carbon::parse($track->created_at)->format('d M Y · H:i') }}
                        </td>
                        <td style="padding:10px 14px;">
                            <span style="padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600; background:{{ $tc['bg'] }}; color:{{ $tc['color'] }}; border:1px solid {{ $tc['border'] }};">
                                {{ $tc['label'] }}
                            </span>
                        </td>
                        <td style="padding:10px 14px; color:#374151;">
                            {{ $track->remarks ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding:20px; text-align:center; color:#9ca3af;">
                            Belum ada riwayat tracking
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>