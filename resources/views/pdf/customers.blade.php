<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Customer List</title>
    <style>
        body { font-family: sans-serif; }
        .page-break { page-break-after: always; }
        header { position: fixed; top: -50px; left: 0px; right: 0px; height: 50px; }
        footer { position: fixed; bottom: -50px; left: 0px; right: 0px; height: 50px; }
        .header-content { text-align: center; }
        .footer-content { text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        .pagenum:before { content: counter(page); }
    </style>
</head>
<body>
<header>
    <div class="header-content">
        <img src="{{ public_path('bloonde.svg') }}" alt="Logo" height="50">
    </div>
</header>
<footer>
    <div class="footer-content">
        Página: <span class="pagenum"></span>
    </div>
</footer>
<main>
    <h1>Lista de Clientes</h1>
    <table>
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Hobbies</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>
                    @foreach($customer->hobbies as $hobby)
                        {{ $hobby->name }}@if (!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            @if($loop->iteration % 15 == 0)
                <div class="page-break"></div>
            @endif
        @endforeach
        </tbody>
    </table>
</main>
</body>
</html>
