@props(['rows'])
<tr>
  <td colspan="2" style="border:1px solid black;padding:5px; text-align: right; font-weight: bold;">Belanja Operasi</td>
  <td style="border:1px solid black;padding:5px">{{ $rows->sum('anggaran_belanja_operasi') }}</td>
</tr>

<tr>
  <td colspan="2" style="border:1px solid black;padding:5px; text-align: right; font-weight: bold;">Belanja Modal</td>
  <td style="border:1px solid black;padding:5px">{{ $rows->sum('anggaran_belanja_modal') }}</td>
</tr>

<tr>
  <td colspan="2" style="border:1px solid black;padding:5px; text-align: right; font-weight: bold;">Belanja Tidak Terduga</td>
  <td style="border:1px solid black;padding:5px">{{ $rows->sum('anggaran_belanja_tidak_terduga') }}</td>
</tr>

<tr>
  <td colspan="2" style="border:1px solid black;padding:5px; text-align: right; font-weight: bold;">Belanja Transfer</td>
  <td style="border:1px solid black;padding:5px">{{ $rows->sum('anggaran_belanja_transfer') }}</td>
</tr>
