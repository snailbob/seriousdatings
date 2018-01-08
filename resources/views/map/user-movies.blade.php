	<div class="col-md-12">
             		<button type="button" class="btn btn-danger coll-marging" data-toggle="collapse" data-target="#movies" style="width: 100%">List of movies <i class="fa fa-film"></i></button>
             		<div id="movies" class="collapse">
			  
			  
			     	@foreach($userInfo->my_movies as $data)
			     	<div class="col-sm-4 col-md-3 col-lg-2">
			                        <div class="thumbnail">
			                            <img class="img-responsive" ng-src="{{ $data->image }}" alt="...">
			                            <div class="caption">
			                                <h5 class="movie-name ">{{ $data->movies }}</h5>
			                                <div class="clearfix">
			                                </div>
			                            </div>
			                        </div>
			                    </div>
                			@endforeach
			    
			      
			      
			</div>
		</div>
