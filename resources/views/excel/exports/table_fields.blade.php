<table>
    <tbody>
        <tr>
            <td>欄位內容</td>
            @foreach($fields as $field)
            @if(!in_array($field, config('excel.import.types.'.$table.'.ignores')??[]))
            <td>{{(__(config($table.".form.fields.".$field.'.text')))?__(config($table.".form.fields.".$field.'.text')):__(config($table.".form.fields.".$field.'.placeholder'))}}</td>
            @endif
            @endforeach
        </tr>
        <tr>
            <td>說明</td>
            @foreach($fields as $field)
            @if(!in_array($field, config('excel.import.types.'.$table.'.ignores')??[]))
            <td>
                @if(config($table.".form.fields.".$field.'.required'))
                <span style="color:red">(必填)</span>
                @endif
            </td>
            @endif
            @endforeach
        </tr>
        <tr>
            <td>欄位名稱</td>
            @foreach($fields as $field)
            @if(!in_array($field, config('excel.import.types.'.$table.'.ignores')??[]))
            <td>{{$field}}</td>
            @endif
            @endforeach
        </tr>
    </tbody>
</table>