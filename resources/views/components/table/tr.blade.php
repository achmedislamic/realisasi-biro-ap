<tr {{ $attributes->merge(['class' => 'odd:bg-white even:bg-slate-50 border-b hover:bg-gray-50']) }}>
    {{ $slot }}
</tr>