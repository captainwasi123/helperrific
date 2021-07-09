<div class="row">
            @foreach($employers as $data)
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                     <a href="{{URL::to('/employer/detail/'.base64_encode($data->id).'/'.$data->fname.' '.$data->lname)}}">
                       <div class="listing-box">
                           <span class="feat_label">Employer</span>
                          <div class="listing-head">
                             <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                          </div>
                          <div class="listing-info">
                             <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> {{$data->fname}} {{$data->lname}} </h5>
                          </div>
                          <div class="listing-detail">
                             <table>
                                <tbody>
                                   <tr>
                                      <td> Current Location </td>
                                      <td class="col-blue"> {{empty($data->details) ? '-' : $data->details->count->country}} </td>
                                   </tr>
                                   <tr>
                                      <td colspan="2">
                                         @if(!empty($data->details))
                                             @switch($data->details->e_looking_status)
                                                @case('1')
                                                   Looking for Helpers
                                                   @break

                                                @case('2')
                                                   Looking for agencies
                                                   @break

                                                @case('3')
                                                   Just Browsing
                                                   @break

                                             @endswitch
                                          @endif
                                      </td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                       </div>
                    </a>
                  </div>
            @endforeach  
            @if(count($employers) == '0')
               <div class="col-lg-12">
                 <br><br>
                 <h4>No Result Found.</h4>
                 <br><br><br><br><br><br><br><br><br><br><br>
               </div>
            @endif       
         </div>