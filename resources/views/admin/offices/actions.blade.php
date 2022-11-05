    <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"
    data-user_id="{{ $id }}" data-username="{{ $name }}"
    data-toggle="modal" href="#modaldemo{{$id}}" title="تفاصيل"><i
        class="">تفاصيل</i></a>


@can('تعديل مكتب')
  <a href="{{ route('office.edit', $id)    }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
@endcan

@can('حذف مكتب')

    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
        data-user_id="{{ $id }}" data-username="{{ $name }}"
        data-toggle="modal" href="#modaldemo8" title="حذف"><i
            class="fa fa-trash"></i></a>
@endcan







      
    <div class="modal" id="modaldemo{{$id}}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                @inject("places", "App\Models\Place")
                <div class="modal-header">
                    <h6 class="modal-title">البلاد التي يمكن السفر اليها من هذا المكتب </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">

                     {{$id}}

                    <table style="margin: 0 auto;">
                        <tr>
                          <th style="width: 100px">المدينة</th>
                          <th style="width: 100px">سعر الذهاب</th>
                          <th style="width: 100px">سعر العوده</th>

                        </tr>
                      
                    @foreach ($places->where('office_id',$id)->get() as $place)
                        <tr>
                          <td>{{$place->name}}</td>
                          <td row="">{{$place->price}}</td>
                          <td row="">{{$place->price2}}</td>

                        </tr>
                    @endforeach

                      </table>




                </div>

        </div>
    </div>
