@extends('layouts.main')
@section('page_title')
تغيير كلمة المرور
@endsection
@section('page-header')
				<!-- breadcrumb -->

				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">

					<div class="col-sm-11">

						<div class="card">
							<div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

								<div class=" border-left border-bottom border-right border-top-0 p-4">
                                    @include('flash::message')


									<div class="tab-pane" >
										<h2> تغيير كلمة المرور</h2>


                                          <form action="{{route('updatepassword')}}" method="post">
                                            @csrf
											<div class="form-group">
												<label for="Password">كلمة المرور القديمه</label>
												<input type="password" placeholder="   كلمة المرور القديمه" name="old_password" id="Password"  class="form-control @error('password') is-invalid @enderror">

											</div>

                                            <div class="form-group">
                                                <label>كلمة المرور الجديدة</label>
                                                <input type="password" placeholder="   كلمة المرور القديمه" name="password" id="Password"  class="form-control @error('password') is-invalid @enderror">



                                              </div>

                                              <div class="form-group">
                                                <label>تأكيد كلمة المرور الجديدة</label>

                                                 <input type="password" placeholder="   كلمة المرور القديمه" name="password_confirmation" id="Password"  class="form-control @error('password') is-invalid @enderror">




											<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
