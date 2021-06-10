@extends('web.support.regMaster')
@section('title', 'Requests History')

@section('content')
      <section class="p-t-60 p-b-80 ">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                  <h2>Requests History</h2>
                  <hr>
                  <div class="profile-triggers">
                     <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#orders1" aria-controls="tabs-1" role="tab" data-toggle="tab">Pending</a></li>
                        <li role="presentation"><a href="#orders2" aria-controls="tabs-1" role="tab" data-toggle="tab">Confirmed</a></li>
                        <li role="presentation"><a href="#orders3" aria-controls="tabs-2" role="tab" data-toggle="tab">Completed</a></li>
                        <li role="presentation"><a href="#orders4" aria-controls="tabs-2" role="tab" data-toggle="tab">Rejected</a></li>
                     </ul>
                  </div>
                  <div class="profile-content">
                     <div class="tab-content">
                        <div class="tab-pane active" id="orders1" role="tabpanel">
                          <div class="agency-reviews">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Requests#</th>
                                    <th>Employer</th>
                                    <th>Descr.</th>
                                    <th>Ordered at</th>
                                    <th>Status</th>
                                    <th>-</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($orders['pending'] as $val)
                                    <tr>
                                      <th>{{$val->id}}</th>
                                      <td>
                                        <div class="profile-block-emp">
                                          <img src="{{URL::to('/')}}/public/profile_img/{{$val->buyer->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                          <h4>{{$val->buyer->fname.' '.$val->buyer->lname}}</h4>
                                        </div>
                                      </td>
                                      <td>{{$val->description}}</td>
                                      <td>{{date('d-M-Y | h:i a', strtotime($val->created_at))}}</td>
                                      <td>
                                        <label class="label label-{{$val->orderStatus->badge_tag}}">
                                          {{$val->orderStatus->status}}
                                        </label>
                                      </td>
                                      <td><a href="{{URL::to('/orders/detail/'.base64_encode($val->id))}}"><span class="fa fa-arrow-right"></span></a></td>
                                    </tr>
                                  @endforeach
                                  @if(count($orders['pending']) == '0')
                                    <tr>
                                      <td colspan="6">No Requests Found.</td>
                                    </tr>
                                  @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="orders2" role="tabpanel">
                          <div class="agency-reviews">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Requests#</th>
                                    <th>Employer</th>
                                    <th>Descr.</th>
                                    <th>Ordered at</th>
                                    <th>Status</th>
                                    <th>-</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($orders['confirmed'] as $val)
                                    <tr>
                                      <th>{{$val->id}}</th>
                                      <td>
                                        <div class="profile-block-emp">
                                          <img src="{{URL::to('/')}}/public/profile_img/{{$val->buyer->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                          <h4>{{$val->buyer->fname.' '.$val->buyer->lname}}</h4>
                                        </div>
                                      </td>
                                      <td>{{$val->description}}</td>
                                      <td>{{date('d-M-Y | h:i a', strtotime($val->created_at))}}</td>
                                      <td>
                                        <label class="label label-{{$val->orderStatus->badge_tag}}">
                                          {{$val->orderStatus->status}}
                                        </label>
                                      </td>
                                      <td><a href="{{URL::to('/orders/detail/'.base64_encode($val->id))}}"><span class="fa fa-arrow-right"></span></a></td>
                                    </tr>
                                  @endforeach
                                  @if(count($orders['confirmed']) == '0')
                                    <tr>
                                      <td colspan="6">No Requests Found.</td>
                                    </tr>
                                  @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="orders3" role="tabpanel">
                          <div class="agency-reviews">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Requests#</th>
                                    <th>Employer</th>
                                    <th>Descr.</th>
                                    <th>Ordered at</th>
                                    <th>Status</th>
                                    <th>-</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($orders['completed'] as $val)
                                    <tr>
                                      <th>{{$val->id}}</th>
                                      <td>
                                        <div class="profile-block-emp">
                                          <img src="{{URL::to('/')}}/public/profile_img/{{$val->buyer->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                          <h4>{{$val->buyer->fname.' '.$val->buyer->lname}}</h4>
                                        </div>
                                      </td>
                                      <td>{{$val->description}}</td>
                                      <td>{{date('d-M-Y | h:i a', strtotime($val->created_at))}}</td>
                                      <td>
                                        <label class="label label-{{$val->orderStatus->badge_tag}}">
                                          {{$val->orderStatus->status}}
                                        </label>
                                      </td>
                                      <td><a href="{{URL::to('/orders/detail/'.base64_encode($val->id))}}"><span class="fa fa-arrow-right"></span></a></td>
                                    </tr>
                                  @endforeach
                                  @if(count($orders['completed']) == '0')
                                    <tr>
                                      <td colspan="6">No Requests Found.</td>
                                    </tr>
                                  @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="orders4" role="tabpanel">
                          <div class="agency-reviews">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Requests#</th>
                                    <th>Employer</th>
                                    <th>Descr.</th>
                                    <th>Ordered at</th>
                                    <th>Status</th>
                                    <th>-</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($orders['rejected'] as $val)
                                    <tr>
                                      <th>{{$val->id}}</th>
                                      <td>
                                        <div class="profile-block-emp">
                                          <img src="{{URL::to('/')}}/public/profile_img/{{$val->buyer->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';">
                                          <h4>{{$val->buyer->fname.' '.$val->buyer->lname}}</h4>
                                        </div>
                                      </td>
                                      <td>{{$val->description}}</td>
                                      <td>{{date('d-M-Y | h:i a', strtotime($val->created_at))}}</td>
                                      <td>
                                        <label class="label label-{{$val->orderStatus->badge_tag}}">
                                          {{$val->orderStatus->status}}
                                        </label>
                                      </td>
                                      <td><a href="{{URL::to('/orders/detail/'.base64_encode($val->id))}}"><span class="fa fa-arrow-right"></span></a></td>
                                    </tr>
                                  @endforeach
                                  @if(count($orders['rejected']) == '0')
                                    <tr>
                                      <td colspan="6">No Requests Found.</td>
                                    </tr>
                                  @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection
