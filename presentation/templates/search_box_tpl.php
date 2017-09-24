<?php
	include PRESENTATION_DIR.'search_box.php';
	$obj = new SearchBox();
	
	echo '
		<form class="" action="'.$obj->mLinkToSearch.'" method="post">
             	    <div class="input-group">
                        <input type="text" name="search_string" class="form-control" value="'.$obj->mSearchString.'" placeholder="Search">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default" style="height:40px;border:2px solid lightgrey"><i class="glyphicon glyphicon-search" style="color:#9D8343"></i></button>
						</div>
					</div>
                   ';
			//$checked = '';
			//if ($obj->mAllWords == 'on')
			    //$checked = "checked";
                        
      		    echo '
		    <!--<label class="checkbox-inline"><input type="checkbox" name="all_words">Search for all words</label>-->
		</form>';
?>