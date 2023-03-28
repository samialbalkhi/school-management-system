<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('ParentsTranslate.Add_Parent') }}</button><br><br>
    <h1>Table Father</h1>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('ParentsTranslate.Email') }}</th>
            <th>{{ trans('ParentsTranslate.Name_Father') }}</th>
            <th>{{ trans('ParentsTranslate.National_ID_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Passport_ID_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Phone_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Job_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        
        @foreach ($parent_father as $my_parent)
            <tr>
               
                <td>{{ $my_parent->id }}</td>
                <td>{{ $my_parent->email  }}</td>
                <td>{{ $my_parent->name }}</td>
                <td>{{ $my_parent->national_id }}</td>
                <td>{{ $my_parent->passport_id }}</td>
                <td>{{ $my_parent->phone }}</td>
                <td>{{ $my_parent->job }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>


<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('ParentsTranslate.Add_Parent') }}</button><br><br>
    <h1>Table Father</h1>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('ParentsTranslate.Email') }}</th>
            <th>{{ trans('ParentsTranslate.Name_Father') }}</th>
            <th>{{ trans('ParentsTranslate.National_ID_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Passport_ID_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Phone_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Job_Father') }}</th>
            <th>{{ trans('ParentsTranslate.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        
        @foreach ($parent_mother as $my_parent)
            <tr>
               
                <td>{{ $my_parent->id }}</td>
                <td>{{ $my_parent->email  }}</td>
                <td>{{ $my_parent->name }}</td>
                <td>{{ $my_parent->national_id }}</td>
                <td>{{ $my_parent->passport_id }}</td>
                <td>{{ $my_parent->phone }}</td>
                <td>{{ $my_parent->job }}</td>
                <td>
                    <button wire:click="editMother({{ $my_parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>


