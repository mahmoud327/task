


    <a href="{{ route('areas.edit', $id)    }}" class="btn btn-info">
        <i class="fa fa-edit"></i>
        </a>


    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
            data-user_id="{{ $id }}"
                    data-toggle="modal" href="#modaldemo8" title="حذف"><i
            class="fa fa-trash"></i></a>



    <a class=" btn btn-sm btn-primary" data-effect="effect-scale"
    href="{{ route('bill.print',$id) }}"
       title="حذف"><i
    class="fa fa-print"></i></a>
