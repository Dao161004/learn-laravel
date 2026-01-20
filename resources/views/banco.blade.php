<!DOCTYPE html>
<html lang="vi">
<head>
    <style>
        table { border-collapse: collapse; }
        td {
            width: 40px;
            height: 40px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <h1>Bàn cờ {{ $n }} x {{ $n }}</h1>
    <table>
        @for ($i = 0; $i < $n; $i++)
            <tr>
                @for ($j = 0; $j < $n; $j++)
                    <td style="background: {{ ($i + $j) % 2 == 0 ? '#e3d2d2' : '#704848' }}"></td>
                @endfor
            </tr>
        @endfor
    </table>
</body>
</html>
