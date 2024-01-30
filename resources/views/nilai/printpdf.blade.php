<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <title>Hasil Kuis</title>
    </head>
    <body>
        <div class="page py-5">
            <h1>MBTI</h1>
            @foreach ($data as $item)
            <ul class="list-inline">
                            <li class="list-inline-item col-sm-3"><strong>No. Registrasi</strong></li>
                            <li class="list-inline-item"><strong>:</strong></li>
                            <li class="list-inline-item">{{ $item->no_reg }}</li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item col-sm-3"><strong>Email</strong></li>
                            <li class="list-inline-item"><strong>:</strong></li>
                            <li class="list-inline-item">{{ $item->email }}</li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item col-sm-3"><strong>Nama</strong></li>
                            <li class="list-inline-item"><strong>:</strong></li>
                            <li class="list-inline-item">{{ $item->nama }}</li>
                        </ul>
                        @endforeach
</div>
    </body>
</html>