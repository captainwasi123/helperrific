<div class="row">
    @foreach($agencies as $data)
       <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            @if(Auth::check())
               @if(Auth::user()->type == '1')
                  @if(count(Auth::user()->viewCount) < 5 || !empty(Auth::user()->premium))
                     <a href="{{URL::to('/agencies/detail/'.base64_encode($data->id).'/'.$data->company)}}">
                  @else
                     <a href="javascript:void(0)" class="limit-reached">
                  @endif
               @else
                  <a href="{{URL::to('/agencies/detail/'.base64_encode($data->id).'/'.$data->company)}}">
               @endif
            @else
               <a href="javascript:void(0)" class="null-profile">
            @endif
             <div class="listing-box">
                <div class="listing-head">
                   <img alt="listings-thumbnail" src="{{URL::to('/')}}/public/cover_img/{{$data->cover_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/cover-placeholder.jpg';">
                </div>
                <div class="listing-info">
                   <h5> <img alt="user-profile-picture" src="{{URL::to('/')}}/public/profile_img/{{$data->profile_img}}" onerror="this.onerror=null;this.src='{{URL::to('/')}}/public/user-placeholder.jpg';"> <p class="cut-text"> {{$data->company}} </p></h5>
                   <p title="{{empty($data->details->description) ? '-' : $data->details->description}}"> 
                      {{empty($data->details->description) ? '-' : $data->details->description}} 
                   </p>
                   <h4> <i class="fa fa-star star-onn"> </i> <b class="star-onn"> {{empty($data->avgRating) ? '0.0' : number_format($data->avgRating[0]->aggregate, 1)}}   </b> <span class="col-grey"> ({{count($data->reviews)}})</span> </h4>
                </div>
                <div class="listing-detail">
                   <table>
                      <tbody>
                         <tr>
                            <td style="width:45%;"> Agency address </td>
                            <td class="cut-text-descip"> <strong>{{empty($data->details->c_address) ? '-' : $data->details->c_address}}</strong></td>
                         </tr>
                         <tr>
                            <td style="width:45%;"> No of Available Helper </td>
                            <td class="col-blue"> <input type="number" value="2" readonly="" name=""> </td>
                         </tr>
                      </tbody>
                   </table>
                </div>
                @if(Auth::check() && Auth::user()->type != '3')
                   <div class="listing-actions">
                         <div> 
                          @if(in_array($data->id, $favors))
                              <span class="wishlist-box wishlist-selected"> <input type="checkbox" class="makeFavorite" name="wishlist-add" value="1" data-id="{{base64_encode($data->id)}}" checked>   </span> 
                          @else
                              <span class="wishlist-box"> <input type="checkbox" class="makeFavorite" name="wishlist-add" value="1" data-id="{{base64_encode($data->id)}}">   </span> 
                          @endif
                        </div>
                      <p> Starting Salary at <b> $84 </b> </p>
                   </div>
                @endif
             </div>
          </a>
       </div>
    @endforeach
    @if(count($agencies) == '0')
      <div class="col-lg-12">
        <br><br>
        <h4>No Result Found.</h4>
        <br><br><br><br><br><br><br><br><br><br><br>
      </div>
    @endif         
 </div>