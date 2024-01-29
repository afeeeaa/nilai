<head>
    <title>{{ isset($webTitle) ? $webTitle . ' - ' : '' }}Data Nilai</title>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-hKsdx6z0jZO5sOD+DL3uBWiEnzYS9OdA/HlTRILgauL0iGU+7L4Pa/kjhjv6k1t8v8OeHhnqy0Vpl8SYqGo5T+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<x-app-layout>
<x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
            {{ $pageTitle ?? __('Data Nilai') }}
            </h2>
        </div>
    </x-slot>

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses!</strong> Data berhasil ditambahkan
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
</div>
@endif


    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">                
        <div class="mt-4">
                <!-- FORM PENCARIAN -->
                <div class="flex justify-between">
                <div class="pb-3">
                <a href="nilai/create" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-blue-400 text-white hover:bg-blue-500 focus:ring-blue-400 rounded-md">
                 Tambah Data </a>
                </div>

    <div class="pb-2">
        <form class="form-inline" action="" method="get">
            <div class="input-group">
                <input class="form-control me-1 border-gray-400 rounded focus:border-gray-400 dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full" 
                    type="search" 
                    name="keyword" 
                    value="{{ Request::get('keyword') }}" 
                    placeholder="Cari No. Registrasi" 
                    aria-label="Search">
                <x-button class="ms-1 rounded">
                    <x-heroicon-o-search class="w-5 h-5"/>
                </x-button>
            </div>
        </form>
    </div>
</div>
</div>
<table class="table table-striped table-bordered">
<thead>
    <tr>
        <th class="col-md-1 text-center"> No
        <a href="{{ route('nilai.index', ['sort' => 'id', 'order' => ($sort === 'id' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'id' && $order === 'asc') ? '↑' : '↓' }}
        </a>
        </th>

    <th class="col-md-2">No. Registrasi 
        <a href="{{ route('nilai.index', ['sort' => 'no_reg', 'order' => ($sort === 'no_reg' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'no_reg' && $order === 'asc') ? '↑' : '↓' }}
        </a>
    </th>

    <th class="col-md-3"> Email
        <a href="{{ route('nilai.index', ['sort' => 'email', 'order' => ($sort === 'email' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'email' && $order === 'asc') ? '↑' : '↓' }}
        </a>
    </th>

    <th class="col-md-3"> Nama
        <a href="{{ route('nilai.index', ['sort' => 'nama', 'order' => ($sort === 'nama' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'nama' && $order === 'asc') ? '↑' : '↓' }}
        </a>
    </th>

<th class="col-md-2 text-center">Lembar Jawab</th>
        <th class="col-md-3 text-center">Hasil Kuis</th>
    </tr>
</thead>
<tbody>
    <?php $i = $data->firstItem() ?>
    @foreach ($data as $item)
        <tr>
            <td class="text-center">{{ $i }}</td>
            <td>{{ $item->no_reg }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->nama }}</td>
            <td class="text-center">
                <a href="{{ url('/download/' . $item->id) }}"><i class="bi bi-download"></i></a>
                <button type="button" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-green-500 text-white hover:bg-green-600 focus:ring-green-500 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"></path>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"></path>
                </svg>
              </button>
            </td>
            <td class="text-center">
                <button type="button" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-white-400 text-black-700 rounded-md" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
            </svg>
            </button></td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Hasil Kuis</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p> No. Registrasi: {{ $item->no_reg }} </p>
                        <p> Email: {{ $item->email }} </p>
                        <p> Nama: {{ $item->nama }} </p>
                        <div class="mt-4">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            INTROVERT (I) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_i*100) }} %</span> </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold"> EKSTROVERT (E) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_e*100) }} %</span> </li>
                        </ul>
                        <div class="mt-4">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            SENSING (S) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_s*100) }} %</span> </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">  INTUITION (N) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_n*100) }} %</span> </li>
                        </ul>
                        </div>
                        <div class="mt-4">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            THINKING (T) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_t*100) }} %</span> </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">  FEELING (F) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_f*100) }} %</span> </li>
                        </ul>
                        </div>
                        <div class="mt-4">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            JUDGING (J) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_j*100) }} %</span> </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">  PERCEIVING (P) <span  class="badge bg-secondary rounded-pill">{{round ($item->average_score_p*100) }} %</span> </li>
                        </ul>
                        </div>
                        <div class="mt-3">
                        <li class="list-group-item list-group-item-secondary rounded-pill">Tipe Kepribadian: <strong>{{($item->result_1)}}{{($item->result_2)}}{{($item->result_3)}}{{($item->result_4)}}</strong></li>
                        </div>
                        <div class="mt-4">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-red-600 text-white hover:bg-red-700 focus:ring-red-600 rounded-md" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++ ?>
    @endforeach
</tbody>
</table>
            <div class="mt-4">
                {{ $data->withQueryString()->links() }}
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>