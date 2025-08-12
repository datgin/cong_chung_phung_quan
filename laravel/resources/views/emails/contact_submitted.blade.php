<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Liên hệ mới</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            color: #000;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        h1 {
            font-size: 18px;
            margin-top: 0;
        }

        .panel {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 15px 0;
        }

        .row {
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            padding: 8px 14px;
            border: 1px solid #000;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            color: black !important
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #555;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <h1>📩 Liên hệ mới từ website {{ config('app.name') }}</h1>
        <p>Xin chào Admin, bạn vừa nhận được một yêu cầu liên hệ mới:</p>

        <div class="panel">
            <div class="row"><span class="label">👤 Tên:</span> {{ $contact['name'] }}</div>
            <div class="row"><span class="label">📞 Số điện thoại:</span> {{ $contact['phone'] }}</div>
            <div class="row"><span class="label">📧 Email:</span> <a
                    href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></div>
            <div class="row"><span class="label">📝 Nội dung:</span>
                {{ $contact['message'] ?? '— Không có nội dung —' }}</div>
        </div>

        <a class="button" href="{{ config('app.frontend_url') }}" target="_blank">🌐 Truy cập Website</a>

        <div class="footer">
            © {{ date('Y') }} {{ config('app.name') }}
        </div>
    </div>
</body>

</html>
