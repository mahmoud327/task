

@can('تعديل سيارة')
    
    <a href="{{ route('cars.edit', $id)    }}" class="btn btn-info">
        <i class="fa fa-edit"></i>
        </a>
 @endcan

@can('حذف سيارة')
    
    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
            data-user_id="{{ $id }}" data-username="{{ $types }}"
                    data-toggle="modal" href="#modaldemo8" title="حذف"><i
            class="fa fa-trash"></i></a>
 @endcan

