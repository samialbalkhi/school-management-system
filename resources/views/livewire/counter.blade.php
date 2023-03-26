<div>
<input type="text" placeholder="serach">
<ul>

    @foreach ($Nationalities as $items )
    <li>
        {{$items->name}}
    </li>
    @endforeach
</ul>
   
</div>
