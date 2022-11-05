@can('تفعيل مستخدم')
    
    @if($activate)
        <a href="{{url(route('user.deactivate',$id))}}"
            class="btn btn-danger btn-sm">إلغاء
            التفعيل</a>
    @else
        <a href="{{url(route('user.activate',$id))}}"
            class="btn btn-success btn-sm">تفعيل</a>
    @endif
@endcan

@can('تعديل مستخدم')
    
 <a href="{{ route('user.edit', $id)    }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
@endcan

@can('حذف مستخدم')
    
    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
        data-user_id="{{ $id }}" data-username="{{ $name }}"
        data-toggle="modal" href="#modaldemo8" title="حذف"><i
            class="fa fa-trash"></i></a>
  @endcan



