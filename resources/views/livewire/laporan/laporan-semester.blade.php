<x-slot:header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Laporan Semester
    </h2>
</x-slot:header>

<x-container>
    <x-laporan.form :$opds :$bulans :$subOpds :$urusans :$bidangUrusans jenis-laporan="semester" />
</x-container>
