@extends('template_defined')

@section('content')


<form name="novavest" action="{{ route('novaVest') }}" method="POST">
    @csrf
    <table>
        <tr>
            <td>Naslov:</td>
            <td><input type="text" name="naslov" value="{{old('naslov')}}"></td>
            @error('naslov')
                <td><font color='red'> {{ $message }} </font></td>
            @enderror
        </tr>
        <tr>
            <td>Sadrzaj:</td>
            <td><textarea name="sadrzaj" rows="4" cols="50" > {{old('sadrzaj')}}</textarea></td>    
            @error('lozinka')
                <td><font color='red'> {{ $message }} </font></td>
            @enderror 
        </tr>
        <tr>
            <td><input type="submit" value="Unesi vest"></td>
        </tr>
        
    </table>
</form>
@endsection
