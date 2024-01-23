<head>
    <title>{{ isset($webTitle) ? $webTitle . ' - ' : '' }}Data Nilai</title>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">                
        <div class="mt-4">
                <!-- FORM PENCARIAN -->
                <div class="flex justify-between">
                <div class="pb-3">
                    <a href="nilai/create" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-purple-500 text-white hover:bg-purple-600 focus:ring-purple-500 rounded-md"> Tambah Data </a>
                </div>

    <div class="pb-2">
        <form class="form-inline" action="" method="get">
            <div class="input-group">
                <input class="form-control me-1 border-gray-400 rounded focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full" 
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
<table class="table table-striped">
<thead>
    <tr>
        <th class="col-md-1 text-center"> No
        <a href="{{ route('nilai.index', ['sort' => 'id', 'order' => ($sort === 'id' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'id' && $order === 'asc') ? '↑' : '↓' }}
        </a>
        </th>

    <th class="col-md-3">No. Registrasi 
        <a href="{{ route('nilai.index', ['sort' => 'no_reg', 'order' => ($sort === 'no_reg' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'no_reg' && $order === 'asc') ? '↑' : '↓' }}
        </a>
    </th>

    <th class="col-md-4"> Email
        <a href="{{ route('nilai.index', ['sort' => 'email', 'order' => ($sort === 'email' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'email' && $order === 'asc') ? '↑' : '↓' }}
        </a>
    </th>

    <th class="col-md-2"> Nama
        <a href="{{ route('nilai.index', ['sort' => 'nama', 'order' => ($sort === 'nama' && $order === 'asc') ? 'desc' : 'asc', 'keyword' => $keyword]) }}">
        {{ ($sort === 'nama' && $order === 'asc') ? '↑' : '↓' }}
        </a>
    </th>

        <th class="col-md-2 text-center">Lembar Jawab</th>
        <th class="col-md-2 text-center">Hasil Kuis</th>
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
                <a href="{{ url('/download/' . $item->id) }}" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500 rounded-md">Download</a>
            </td>
            <td><button type="button" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500 rounded-md" data-bs-toggle="modal" data-bs-target="#exampleModal"> Detail
        </button></td>
        </tr>
        <?php $i++ ?>
    @endforeach
</tbody>
</table>
            <div class="mt-4">
                {{ $data->withQueryString()->links() }}
            </div>
        </div>

         <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Hasil Kuis</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p> No. Registrasi: <span id="item-no-reg"></span> </p>
                        <p> Email: <span id="modal-email"></span> </p>
                        <p> Nama: <span id="modal-nama"></span> </p>
                        <div class="mt-3">
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th class="text-center">INTROVERT (I)</th>
                                <th class="text-center">EKSTROVERT (E)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th></th>
                                <th></th>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                <th class="text-center">SENSING (S)</th>
                                <th class="text-center">INTUITION (N)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th></th>
                                <th></th>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                <th class="text-center">THINKING (T)</th>
                                <th class="text-center">FEELING (F)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th></th>
                                <th></th>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                <th class="text-center">JUDGING (J)</th>
                                <th class="text-center">PERCEIVING (P)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th></th>
                                <th></th>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                        Tipe Kepribadian:
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500 rounded-md" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '#show-modal', function () {
            var modalURL = $(this).data('url');
            $.get(modalURL, function (data) {
        $('#exampleModal').modal('show');
        $('#modal-no-reg').text(item.no_reg);
        $('#modal-email').text(item.email);
        $('#modal-nama').text(item.nama);
    })
});
});
</script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>