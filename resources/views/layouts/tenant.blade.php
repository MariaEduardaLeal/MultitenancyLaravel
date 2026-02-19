<head>
    <style>
        :root {
            --primary-color: {{ tenant('primary_color') ?? '#3b82f6' }};
            --secondary-color: {{ tenant('secondary_color') ?? '#1e293b' }};
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .text-theme { color: var(--primary-color); }
    </style>
</head>
<body>
    <img src="{{ tenant('logo_url') }}" alt="Logo da {{ tenant('id') }}">
    @yield('content')
</body>
