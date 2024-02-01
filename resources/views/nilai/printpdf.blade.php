<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <title>Hasil Kuis</title>
    </head>

    <body>
        <div>
            <h1>Hasil MBTI</h1>
            <h3>No. Registrasi: {{$data->no_reg}}</h3>
            <h3>Email: {{$data->email}}</h3>
            <h3>Nama: {{$data->nama}}</h3>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Introvert</th>
                    <th>Ekstrovert</th>
                    <th>Sensing</th>
                    <th>Intuition</th>
                    <th>Thinking</th>
                    <th>Feeling</th>
                    <th>Judging</th>
                    <th>Perceiving</th>
                </tr>  
            </thead>
            <tbody>
                <tr>
                    <th>{{round ($data->average_score_i*100) }} %</th>
                    <th>{{round ($data->average_score_e*100) }} %</th>
                    <th>{{round ($data->average_score_s*100) }} %</th>
                    <th>{{round ($data->average_score_n*100) }} %</th>
                    <th>{{round ($data->average_score_t*100) }} %</th>
                    <th>{{round ($data->average_score_f*100) }} %</th>
                    <th>{{round ($data->average_score_j*100) }} %</th>
                    <th>{{round ($data->average_score_p*100) }} %</th>
                </tr>
            </tbody>
        </table>
    </body>
</html>