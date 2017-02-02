@for($i=2;$i<count($data['ex']);$i++)
    <a class="ex"><img class="expression_{{ $data['ex'][$i] }}" src="{{ url('/img/b/'.$data['ex'][$i]) }}"></a>
@endfor
