<div class="col-md-3" style="background:#FFF;">
         <div style="background:#FFF;" class="margin_10_xs">
         <div class="curnt_srch">Current Search:</div>
         <h5 class="h_basic">Basics:</h5>
         <div class="basic_ul">
         <ul>
         @if(count($users) > 0 )
         <li> {!! $users[0]['gender']!!}:  {!! $users[0]['ageFrom']!!} -  {!! $users[0]['ageTo']!!} years old</li>
         <li>in {!! $users[0]['searchLocation']!!}</li>
         <li>Within {!! $users[0]['range'] !!} Miles</li>
         <li></li>
            @else
             No Record Found
         @endif
         </ul>
         </div>
         
         </div><hr/>
         
         <div class="h_refnrslt">
         <div class="srch_border"></div>
         <p></p>
         <div>
         
         <ul style="list-style:none;">
         
         </ul>
         </div>
         
         </div>
         </div>