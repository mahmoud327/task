<a href="{{url(route('work_offers',$id))}}"class="btn btn-primary btn-sm ml-1"> جميع العروض</a>

@if($activate)
    <a href="{{url(route('work.deactivate',$id))}}"
        class="btn btn-danger btn-sm">إلغاء
        التفعيل</a>
@else
    <a href="{{url(route('work.activate',$id))}}"
        class="btn btn-success btn-sm">تفعيل</a>
@endif


{{-- <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
    data-user_id="{{ $id }}" data-username="{{ $title }}"
    data-toggle="modal" href="#modaldemo8" title="حذف"><i
        class="fa fa-trash"></i></a> --}}



