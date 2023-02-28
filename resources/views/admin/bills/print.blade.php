<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous" />
  </head>
  <body>
    <main class="m-5">
        <div class="container w-75">

            <table class="table table-bordered">

                <tbody>
                    <thead>
                        <td colspan="5">
                            <div class="d-flex justify-content-between ">
                                <div class="d-flex flex-column justify-content-center align-items-center">

                                    <div class="p-0 m-0">
                                        <img src="{{ asset('img/لقطة الشاشة 2022-11-01 010520.png') }}" alt="" width="200" height="100">
                                    </div>
                                    <small class="p-0 m-0">

                                    </small>
                                    <small class="p-0 m-0">
                                        {{ $bill->company_name }}
                                    </small>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div>
                                        <img src="{{asset('img/360_F_255979498_vewTRAL5en9T0VBNQlaDBoXHlCvJzpDl.jpg')}}" alt="" width="150">
                                    </div>
                                    <div>
                                        <h5 class="p-0 m-0">
                                         {{ $bill->bill_code }}
                                        </h5>
                                        <p class="p-0 m-0">
                                          {{ $bill->date_bills }}
                                        </p>
                                    </div>


                                </div>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="p-0 m-0">
                                            مبلغ  : {{ $bill->total }}

                                        </p>
                                        <p class="p-0 m-0">
                                            تسليم وتحصيل
                                        </p>
                                        <p class="p-0 m-0">
                                            مسموح بفتح الشحنه
                                        </p>
                                    </div>

                                    <div>
                                        {{-- <img src="{{ asset('img/qr_code_5cdd30e269752.jpg') }}" alt="" width="100"> --}}
                                        {!! QrCode::size(120)->generate('https://www.facebook.com/profile.php?id=100086418624519'); !!}

                                    </div>

                                </div>
                                {{-- coding_type', 'bill_code','shipping_value','excluding_sum','special_marque','type_bill,'
                                ,'company_name','amount_inclusive_expenses','number_of_pieces','statement','note','cost','date_bills','area_id','consignee','address','phone','phone2','special_marque --}}

                            </div>
                        </td>
                    </thead>
                  <tr>
                  <td>اسم المنتج : {{ $bill->product_name }}  </td>
                    <td colspan="5">العنوان {{ $bill->address }}</td>

                  </tr>
                  <tr>
                  <td>وصف المنتج: {{ $bill->note }} </td>
                    <td>المرسل اليه: {{ $bill->consignee }}</td>
                    <td colspan="5">
                        <p>موبايل 1 : {{ $bill->phone }}</p>
                        <p>موبايل 2 :  {{ $bill->phone2 }}</p>

                    </td>

                  </tr>
                  <tr>
                    <td rowspan="5" >
                        الملاحظات
                        <br>
                        {{ $bill->statement }}
                    </td>
                    <td>
                        كود العميل : 0
                    </td>
                    <td colspan="5">

                    </td>
                  </tr>

                  <tr>


                    <td>
                        العدد:{{ $bill->number_of_pieces }}
                    </td>
                    {{-- <td>
                        الحجم:2
                    </td> --}}
                    <td>
                        الوزن:{{ $bill->weight }}
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>

    </main>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
