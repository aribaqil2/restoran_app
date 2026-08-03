<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak QR Code - Meja {{ $table->number }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .qr-card {
            width: 320px;
            padding: 24px;
            border: 2px solid #000;
            border-radius: 12px;
            background: #fff;
            text-align: center;
            box-sizing: border-box;
        }
        /* Mengatur agar QR Code SVG pas di dalam kotak */
        .qr-code-wrapper svg,
        .qr-code-wrapper img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .target-url {
            word-break: break-all;
            font-size: 11px;
            color: #6c757d;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #fff;
            }
            .qr-card {
                border: 2px solid #000;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

    <div class="text-center">
        <div class="qr-card shadow-sm mb-3">
            <h3 class="fw-bold mb-1">RESTORANKU</h3>
            <p class="text-muted small mb-2">Scan untuk melihat Menu & Pesan</p>
            
            <div class="qr-code-wrapper my-3">
                {!! $qrCode !!}
            </div>

            <h2 class="fw-bold mt-2 mb-2">MEJA {{ $table->number }}</h2>

            <!-- Teks Link Target (Bisa Diklik & Terbaca) -->
            @php
                $targetUrl = url('/menu?meja=' . $table->number);
            @endphp
            <p class="target-url mb-0">
                <a href="{{ $targetUrl }}" target="_blank" class="text-decoration-none text-muted">
                    {{ $targetUrl }}
                </a>
            </p>
        </div>

        <div class="no-print">
            <button onclick="window.print()" class="btn btn-primary me-2">Print QR Code</button>
            <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
        </div>
    </div>

</body>
</html>