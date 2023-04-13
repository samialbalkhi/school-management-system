<div>
    <div>
        <div class="card card-statistice mb-30">
            <div class="card-body">
                <h5 class="card-title">{{$data[$counter]->title}}</h5>
                @foreach ($data[$counter]->answers as $index=>$answer) 
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio{{$index}}" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio{{$index}}">{{$answer}}</label>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
