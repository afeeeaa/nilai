<head>
    <title>{{ isset($webTitle) ? $webTitle . ' - ' : '' }}Data Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <td class="text-center">
                <a href="{{ url('/page-tertentu/' . $item->id) }}" class="inline-flex items-center transition-colors font-medium px-4 py-2 text-base bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 focus:ring-green-500 rounded-md">Detail</a>
            </td>
        </tr>
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
</x-app-layout>