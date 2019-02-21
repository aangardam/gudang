<table width="100%">
    <tr>
        <td colspan="5" align="center"><b> SURAT JALAN </b></td>
    </tr>
    <tr>
        <td colspan="5"> &nbsp; </td>
    </tr>
    <tr>
        <td></td>
        <td> No Surat : </td>
        {{--  <td> {{ $data[0]->nosurat }} </td>  --}}
        <td colspan="3" align="left"> {{ $data[0]->nosurat }} </td>
    </tr>
    <tr>
        <td></td>
        <td> Toko : </td>
        {{--  <td> {{ $data[0]->store->name }} </td>  --}}
        <td colspan="3"> {{ $data[0]->store->name }} </td>
    </tr>
    <tr>
        <td></td>
        <td align="center"><b> No </b></td>
        <td align="center"><b> Produk </b></td>
        <td align="center"><b> Ukuran </b></td>
        <td align="center"><b> Jumlah </b></td>
    </tr>
    @foreach ($data as $item=>$value)
    <tr>
        <td></td>
        <td> {{ $item+1 }}</td>
        <td> {{ $value->produk->name }}</td>
        <td> {{ $value->size }}</td>
        <td align="right"> {{ number_format($value->qty) }}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2" align="center"> Kepala Gudang </td>
        <td colspan="2" align="center"> Kepala Toko </td>
    </tr>
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2" align="center"> {{ Auth::user()->name }} </td>
        <td colspan="2" align="center"> {{ $data[0]->store->user->name }} </td>
    </tr>
</table>