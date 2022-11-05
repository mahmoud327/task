
@can('تعديل فئه')
  <a href="{{ route('types.edit', $id)    }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>

@endcan
@can('حذف فئه')
    
 <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-user_id="{{ $id }}" data-username="{{ $name }}"
                                                data-toggle="modal" href="#modaldemo8" title="حذف"><i
                                                    class="fa fa-trash"></i></a>


 @endcan