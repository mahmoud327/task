<a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"
    data-user_id="{{ $id }}" data-username=""
    data-toggle="modal" href="#modaldemo{{$id}}" title="تفاصيل"><i
        class="fa fa-star"></i></a>


    <div class="modal" id="modaldemo{{$id}}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                @inject("trip", "App\Models\Trip")
                <div class="modal-header">
                    <h6 class="modal-title">تقييم الرحلة </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">


                    <table style="margin: 0 auto;">
                        @if ($trip->where('id', $id)->first()->rate()->exists())
                        <tr>
                            <th>خدمة العميل</th>
                            <th>التقيم - Evalua</th>
                            <th>Customer Services</th>
                        </tr>



                        <tr>
                            <td>الترحيب والابتسامة</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->welcom}}">
                                    <span class="fa fa-star rated rat rat1 " data-index="1"></span>
                                    <span class="fa fa-star rated rat  rat1 " data-index="2"></span>
                                    <span class="fa fa-star rated rat  rat1 " data-index="3"></span>
                                    <span class="fa fa-star rated rat  rat1" data-index="4"></span>
                                    <span class="fa fa-star rated rat  rat1" data-index="5"></span>

                                    <input type="hidden" name="welcom" id="input1">
                                </div>

                            </td>

                            <td>Welcom & Smiling</td>
                        </tr>


                        <tr>
                            <td> المعرفة والالمام بالطرق</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->roads}}">
                                    <span class="fa fa-star rated rat rat2 " data-index="1"></span>
                                    <span class="fa fa-star rated rat  rat2 " data-index="2"></span>
                                    <span class="fa fa-star rated rat  rat2 " data-index="3"></span>
                                    <span class="fa fa-star rated rat  rat2" data-index="4"></span>
                                    <span class="fa fa-star rated rat  rat2" data-index="5"></span>
                                    <input type="hidden" name="roads" id="input2">
                                </div>

                            </td>

                            <td>Roads Knowledge</td>
                        </tr>


                        <tr>
                            <td> نظافة السيارة</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->clean}}">
                                    <span class="fa fa-star rated rat rat3 " data-index="1"></span>
                                    <span class="fa fa-star rated rat  rat3 " data-index="2"></span>
                                    <span class="fa fa-star rated rat  rat3 " data-index="3"></span>
                                    <span class="fa fa-star rated rat  rat3" data-index="4"></span>
                                    <span class="fa fa-star rated rat  rat3" data-index="5"></span>
                                    <input type="hidden" name="clean" id="input3">
                                </div>

                            </td>

                            <td> How Clean The Car</td>
                        </tr>


                        <tr>
                            <td> مظهر السائق</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->appearance}}">
                                    <span class="fa fa-star rated rat rat4 " data-index="1"></span>
                                    <span class="fa fa-star rated rat  rat4 " data-index="2"></span>
                                    <span class="fa fa-star rated rat  rat4 " data-index="3"></span>
                                    <span class="fa fa-star rated rat  rat4" data-index="4"></span>
                                    <span class="fa fa-star rated rat  rat4" data-index="5"></span>
                                    <input type="hidden" name="appearance" id="input4">
                                </div>

                            </td>

                            <td> Driver Appearance</td>
                        </tr>

                        <tr>
                            <td> قيادتة</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->driving}}">
                                    <span class="fa fa-star rated rat rat5 " data-index="1"></span>
                                    <span class="fa fa-star rated rat  rat5 " data-index="2"></span>
                                    <span class="fa fa-star rated rat  rat5 " data-index="3"></span>
                                    <span class="fa fa-star rated rat  rat5" data-index="4"></span>
                                    <span class="fa fa-star rated rat  rat5" data-index="5"></span>
                                    <input type="hidden" name="driving" id="input5">
                                </div>

                            </td>

                            <td> His Driving </td>
                        </tr>

                        <tr>
                            <td> السرعة</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->speed}}">
                                    <span class="fa fa-star rated rat rat6 " data-index="1"></span>
                                    <span class="fa fa-star rated rat  rat6 " data-index="2"></span>
                                    <span class="fa fa-star rated rat  rat6 " data-index="3"></span>
                                    <span class="fa fa-star rated rat  rat6" data-index="4"></span>
                                    <span class="fa fa-star rated rat  rat6" data-index="5"></span>
                                    <input type="hidden" name="speed" id="input6">
                                </div>

                            </td>

                            <td>Speed </td>
                        </tr>

                        <tr>
                            <td> الامتعه</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->upload}}">
                                    <span class="fa fa-star rated rat7 rat " data-index="1"></span>
                                    <span class="fa fa-star rated rat7 rat " data-index="2"></span>
                                    <span class="fa fa-star rated rat7 rat " data-index="3"></span>
                                    <span class="fa fa-star rated rat7 rat" data-index="4"></span>
                                    <span class="fa fa-star rated rat7 rat" data-index="5"></span>
                                    <input type="hidden" name="upload" id="input7">
                                </div>

                            </td>

                            <td>Upload & Download Luggage</td>
                        </tr>

                        <tr>
                            <td> التنبية وربط الحزام</td>

                            <td>

                                <div class="rating" data-rating="{{$trip->where('id', $id)->first()->rate()->first()->belt}}">
                                    <span class="fa fa-star rated rat8 rat " data-index="1"></span>
                                    <span class="fa fa-star rated rat8 rat " data-index="2"></span>
                                    <span class="fa fa-star rated rat8 rat " data-index="3"></span>
                                    <span class="fa fa-star rated rat8 rat" data-index="4"></span>
                                    <span class="fa fa-star rated rat8 rat" data-index="5"></span>
                                    <input type="hidden" name="belt" id="input8">
                                </div>

                            </td>

                            <td>Fasten Seat Belt Alarm</td>
                        </tr>

                        @else
                            هذه الرحلة ليس لها تقييم
                        @endif






                      </table>




                </div>

        </div>
    </div>

    @push('js')

    @endpush