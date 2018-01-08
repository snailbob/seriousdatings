	<div class="col-md-12">
             		<button type="button" class="btn btn-info coll-marging" data-toggle="collapse" data-target="#info" style="width: 100%">List of info <i class="fa fa-info-circle"></i></button>
             		<div id="info" class="collapse section-scroll-infos">
			  <table class="table table-1">
			    <thead>
			      <tr>
			        <th>Info Label</th>
			        <th>Data</th>
			      </tr>
			    </thead>
			    <tbody>
			  
			      <tr>
			        <td>Height</td>
			        <td>{!! $userInfo->height == "" ? "N/A" : $userInfo->height !!}</td>
			      </tr>
			      <tr>
			        <td>Eye color</td>
			        <td>{!! $userInfo->eyeColor == "" ? "N/A" : $userInfo->eyeColor !!}</td>
			      </tr>
			      <tr>
			        <td>Blood Type</td>
			        <td>{!! $userInfo->bodyType == "" ? "N/A" : $userInfo->bodyType !!}</td>
			      </tr>
			      <tr>
			        <td>Email</td>
			        <td>{!! $userInfo->email == "" ? "N/A" : $userInfo->email !!}</td>
			      </tr>
			      <tr>
			        <td>Phone</td>
			        <td>{!! $userInfo->phone == "" ? "N/A" : $userInfo->phone !!}</td>
			      </tr>
			        <tr>
			        <td>Birthday</td>
			        <td>{!! Carbon\Carbon::parse($userInfo->birthdate)->format('F d, Y')  !!}</td>
			      </tr>
			        <tr>
			        <td>Relationship Goal</td>
			        <td>{!! $userInfo->relationshipGoal == "" ? "N/A" : $userInfo->relationshipGoal !!}</td>
			      </tr>
			      <tr>
			        <td>Have Children</td>
			        <td>{!! $userInfo->haveChildren == "" ? "None" : $userInfo->haveChildren !!}</td>
			      </tr>
			      <tr>
			        <td>Longest Relationship have been</td>
			        <td>{!! $userInfo->whatIsTheLongestRelationshipYouHaveBeenIn == "" ? "0yr" : $userInfo->whatIsTheLongestRelationshipYouHaveBeenIn !!}</td>
			      </tr>
			      <tr>
			        <td>Partner Dependability</td>
			        <td>{!! $userInfo->partnerDependability == "" ? "N/A" : $userInfo->partnerDependability !!}</td>
			      </tr>
			       <tr>
			        <td>Sexual Compatibility</td>
			        <td>{!! $userInfo->sexualCompatibility == "" ? "N/A" : $userInfo->sexualCompatibility !!}</td>
			      </tr>
			       <tr>
			        <td>Language</td>
			        <td>{!! $userInfo->language == "" ? "N/A" : $userInfo->language !!}</td>
			      </tr>
			      
			    </tbody>
			  </table>
			</div>
		</div>
