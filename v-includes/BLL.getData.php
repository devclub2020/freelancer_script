<?php
	//include the DAL library to use the model layer methods
	include 'class.DAL.php';
	
	// business layer class starts here
	class BLL_manageData
	{
		public $manage_content;
		
		/*
		 method for constructing DAL class
		 Auth: Dipanjan
		*/

		function __construct()
		{	
			$this->manage_content = new ManageContent_DAL();
			return $this->manage_content;
		}
		
		/*
		 method for getting project list of a employer
		 Auth: Dipanjan
		*/
		
		function getProjectList($user_id)
		{
			//getting all project details from database
			$all_projects = $this->manage_content->getValueWhere_descending("project_info","*","user_id",$user_id);
			//printing them in table
			foreach($all_projects as $all_project)
			{
				//checking for uploading files
				if(!empty($all_project['files']))
				{
					$file = substr($all_project['files'],strpos($all_project['files'],"/")+1);
				}
				else
				{
					$file = 'No Files';
				}
				echo '<tr>
						<td><a href="project_status.php?id='.$all_project['project_id'].'">'.$all_project['project_name'].'</a></td>
						<td>'.$all_project['project_description'].'</td>
						<td>'.$all_project['skills'].'</td>
						<td>'.$all_project['price_range'].'</td>
						<td>'.$all_project['time_range'].'</td>
						<td>'.$all_project['date']." ".$all_project['time'].'</td>
						<td>'.$all_project['preferred_location'].'</td>
						<td>'.$file.'</td>
						<td><a href="edit_project.php?id='.$all_project['project_id'].'"><button class="btn btn-success">EDIT</button></a></td>
					</tr>';
			}
		}
		
		/*
		 method for getting project list of a employer
		 Auth: Dipanjan
		*/
		
		function editProject($project_id)
		{
			//getting project details from database
			$project_details = $this->manage_content->getValue_where("project_info","*","project_id",$project_id);
			//showing the values in form
			if(!empty($project_details[0]))
			{
				echo '<form action="v-includes/manageData.php" class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Category</label>
							<div class="col-md-8">
								<input type="text" class="form-control" placeholder="Category" value="'.$project_details[0]['category'].'">
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Category</label>
							<div class="col-md-8">
								<select class="form-control" id="postProject_category" name="category[]" multiple="multiple">
									<option value="IT & Programming">IT & Programming</option>
									<option value="Design & Multimedia">Design & Multimedia</option>
								</select>
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Project Title</label>
							<div class="col-md-8">
								<input type="text" class="form-control" placeholder="Project Title" name="project_name" value="'.$project_details[0]['project_name'].'">
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Project Description</label>
							<div class="col-md-8">
								<textarea rows="6" class="form-control" placeholder="Project Description" name="project_description">'.$project_details[0]['project_description'].'</textarea>
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Skills Required</label>
							<div class="col-md-8">
								<input type="text" class="form-control" placeholder="Skills Required" name="skills" value="'.$project_details[0]['skills'].'">
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Price Range</label>
							<div class="col-md-8">
								<select class="form-control" name="price_range">
									<option value="Below $100"'; if($project_details[0]['price_range'] == 'Below $100'){echo 'selected="selected"'; }echo '>Below $100</option>
									<option value="$100 - $500"'; if($project_details[0]['price_range'] == '$100 - $500'){echo 'selected="selected"'; }echo '>$100 - $500</option>
									<option value="$500 - $1000"'; if($project_details[0]['price_range'] == '$500 - $1000'){echo 'selected="selected"'; }echo '>$500 - $1000</option>
									<option value="Above $1000"'; if($project_details[0]['price_range'] == 'Above $1000'){echo 'selected="selected"'; }echo '>Above $1000</option>
								</select>
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Time Range</label>
							<div class="col-md-8">
								<select class="form-control" name="time_range">
									<option value="Within 3 Days"'; if($project_details[0]['time_range'] == 'Within 3 Days'){echo 'selected="selected"'; }echo '>Within 3 Days</option>
									<option value="Within 1 week"'; if($project_details[0]['time_range'] == 'Within 1 week'){echo 'selected="selected"'; }echo '>Within 1 week</option>
									<option value="Within 2 week"'; if($project_details[0]['time_range'] == 'Within 2 week'){echo 'selected="selected"'; }echo '>Within 2 week</option>
									<option value="Within 1 month"'; if($project_details[0]['time_range'] == 'Within 1 month'){echo 'selected="selected"'; }echo '>Within 1 month</option>
									<option value="Within 2 month"'; if($project_details[0]['time_range'] == 'Within 2 month'){echo 'selected="selected"'; }echo '>Within 2 month</option>
									<option value="Above 2 month"'; if($project_details[0]['time_range'] == 'Above 2 month'){echo 'selected="selected"'; }echo '>Above 2 month</option>
								</select>
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Preffered Location</label>
							<div class="col-md-8">
								<input type="text" class="form-control" placeholder="Preffered Location" name="preferred_location" value="'.$project_details[0]['preferred_location'].'">
							</div>
						</div>
						<div class="form-group v-form_control">
							<label class="col-md-3 control-label login_form_label">Upload File</label>
							<div class="col-md-8">
								<input type="file" class="form-control" name="files">
							</div>
						</div>
						<div class="form-group v-form_control">
							<div class="col-md-offset-3 col-md-9">
								<input type="hidden" name="project_id" value="'.$project_details[0]['project_id'].'">
								<input type="submit" class="btn btn-primary login_form_submit" value="SUBMIT">
							</div>
						</div>
					</form>';
			}
			else
			{
				echo '<p style="font-size:1.5em; color:#ff0000; text-align:center;">No Project Details Found</p>';
			}	
		}
		
		/*
		 method for getting project status with all bids
		 Auth: Dipanjan
		*/
		function getProjectStatus($project_id)
		{
			//getting project details from database
			$project_details = $this->manage_content->getValue_where("project_info","*","project_id",$project_id);
			
			if($project_details[0])
			{
				//checking for preferred location
				if(empty($project_details[0]['preferred_location']))
				{
					$preferred_location = 'Any Where';
				}
				else
				{
					$preferred_location = $project_details[0]['preferred_location'];
				}
				//getting total no of proposal from database
				$rowcount = $this->manage_content->getRowValue("bid_info","project_id",$project_id);
				//get all the bid details of this project
				$bid_details = $this->manage_content->getValue_where("bid_info","*","project_id",$project_id);
				//showing the values in form
				echo '<!-- project description starts here -->
						<div class="project_description">
							<h3 class="project_description_heading">'.$project_details[0]['project_name'].'</h3>
							<p class="project_description_text">'.$project_details[0]['project_description'].'</p>
							<p class="col-md-4 project_description_skills"><span class="project_description_topic">Skills Required</span>: '.$project_details[0]['skills'].'</p>
							<p class="col-md-4"><span class="project_description_topic">Price Range</span>: '.$project_details[0]['price_range'].'</p>
							<p class="col-md-4"><span class="project_description_topic">Time Range</span>: '.$project_details[0]['time_range'].'</p>
							<p class="col-md-4 project_description_skills"><span class="project_description_topic">Preffered Location</span>: '.$preferred_location.'</p>
							<p class="col-md-4"><span class="project_description_topic">Uploaded File</span>: No Files</p>
							<div class="clearfix"></div>
						</div>
						<!-- project description ends here -->
						<div class="proposal_outline">
							<div class="col-md-12">
							<h4 class="proposal_heading pull-left">Proposal List</h4>
							<h4 class="pull-right no_proposal"><span class="project_description_topic">Total Proposal</span>: '.$rowcount.'</h4>
							</div>';
							
						if(!empty($bid_details[0]))
						{
							//showing all the bids in order
							foreach($bid_details as $bid_detail)
							{
								//getting the user details who have bided on this project
								$user_details = $this->manage_content->getValue_where("user_info","*","user_id",$bid_detail['user_id']);
								//setting the default image
								if(empty($user_details[0]['profile_image']))
								{
									$profile_image = 'img/thumb64-80-1413559917-vasu_naman.jpg';
								}
								else
								{
									$profile_image = $user_details[0]['profile_image'];
								}
								echo '<div class="proposal_part col-md-12">
										<div class="col-md-1"><img src="'.$profile_image.'" /></div>
										<div class="col-md-10">
											<h4 class="proposal_bidder_name">'.$user_details[0]['f_name']." ".$user_details[0]['l_name'].'</h4>
											<p>'.$bid_detail['bid_description'].'</p>
											<p><span class="project_description_topic">Skills</span>: HTML, CSS, PHP, .NET</p>
											<p><span class="project_description_topic">Proposal</span>:<span class="proposal_bidder_price"> $'.$bid_detail['price'].'</span></p>
										</div>
									</div>';
							}
						}
						else
						{
							echo '<p style="font-size:1.5em; color:#ff0000; text-align:center;">No Proposals Yet</p>';
						}
						echo '<div class="clearfix"></div>
						</div>';
			}
			else
			{
				echo '<p style="font-size:1.5em; color:#ff0000; text-align:center;">No Project Details Found</p>';
			}
		}
		
		/*
		 method for getting all job list
		 Auth: Dipanjan
		*/
		function getAllJobList()
		{
			//getting all job list
			$job_lists = $this->manage_content->getValue_descending("project_info","*");
			//showing it on page
			foreach($job_lists as $job_list)
			{
				//getting total proposal
				$rowcount = $this->manage_content->getRowValue("bid_info","project_id",$job_list['project_id']);
				echo '<div class="col-md-12 job_part">
                    	<h3 class="job_title"><a href="post_bid.php?id='.$job_list['project_id'].'"> '.$job_list['project_name'].'</a></h3>
                        <p class="col-md-4 project_description_skills"><span class="project_description_topic">Price</span>: '.$job_list['price_range'].'</p>
                        <p class="col-md-4"><span class="project_description_topic">Time Remaining</span>: 3days 22hour</p>
                        <p class="col-md-4"><span class="project_description_topic">Total Proposal</span>: '.$rowcount.'</p>
                        <p>'.$job_list['project_description'].'</p>
                        <p><span class="project_description_topic">Skills Required</span>: '.$job_list['skills'].'</p>
                    </div>';
			}
		}
		
		/*
		 method for getting project details in post bid page
		 Auth: Dipanjan
		*/
		function getProjectDetails($project_id)
		{
			//getting project details
			$project_details = $this->manage_content->getValue_where("project_info","*","project_id",$project_id);
			//checking for empty result
			if(!empty($project_details[0]))
			{
				//checking for preferred location
				if(empty($project_details[0]['preferred_location']))
				{
					$preferred_location = 'Any Where';
				}
				else
				{
					$preferred_location = $project_details[0]['preferred_location'];
				}
				//getting total no of proposal from database
				$rowcount = $this->manage_content->getRowValue("bid_info","project_id",$project_id);
				//get all the bid details of this project
				$bid_details = $this->manage_content->getValue_where("bid_info","*","project_id",$project_id);
				//showing the result in page
				echo '<div class="col-md-7">
						<!-- project description starts here -->
						<div class="project_description col-md-12">
							<h3 class="project_description_heading">'.$project_details[0]['project_name'].'</h3>
							<p class="project_description_text">'.$project_details[0]['project_description'].'</p>
							<p><span class="project_description_topic">Skills Required</span>: '.$project_details[0]['skills'].'</p>
							<p><span class="project_description_topic">Price Range</span>: '.$project_details[0]['price_range'].'</p>
							<p><span class="project_description_topic">Time Remaining</span>: 14days 22hour</p>
							<p><span class="project_description_topic">Preffered Location</span>: '.$preferred_location.'</p>
							<p><span class="project_description_topic">Uploaded File</span>: No Files</p>
							<div class="clearfix"></div>
						</div>
						<!-- project description ends here -->
						<div class="proposal_outline col-md-12">
							<div class="col-md-12">
								<h4 class="proposal_heading pull-left">Proposal List</h4>
								<h4 class="pull-right no_proposal"><span class="project_description_topic">Total Proposal</span>: '.$rowcount.'</h4>
							</div>';
						
						//checking for empty bid status
						if(!empty($bid_details[0]))
						{
							foreach($bid_details as $bid_detail)
							{
								//getting the user details who have bided on this project
								$user_details = $this->manage_content->getValue_where("user_info","*","user_id",$bid_detail['user_id']);
								//setting the default image
								if(empty($user_details[0]['profile_image']))
								{
									$profile_image = 'img/thumb64-80-1413559917-vasu_naman.jpg';
								}
								else
								{
									$profile_image = $user_details[0]['profile_image'];
								}
								echo '<div class="bid_proposal_part col-md-12">
										<div class="col-md-2"><img src="'.$profile_image.'" /></div>
										<div class="col-md-10">
											<h4 class="proposal_bidder_name">'.$user_details[0]['f_name']." ".$user_details[0]['l_name'].'</h4>
											<p>'.$bid_detail['bid_description'].'</p>
											<p><span class="project_description_topic">Skills</span>: HTML, CSS, PHP, .NET</p>
											<p><span class="project_description_topic">Proposal</span>:<span class="proposal_bidder_price"> $'.$bid_detail['price'].'</span></p>
										</div>
									</div>';
							}
							
						}
						else
						{
							echo '<p style="font-size:1.5em; color:#ff0000; text-align:center;">No Proposals Yet</p>';
						}
					echo '<div class="clearfix"></div>
								</div>
							</div>
							<!-- bidding part starts here -->';
			}
			else
			{
				echo '<p style="font-size:1.5em; color:#ff0000; text-align:center;">No Project Details Found</p>';
			}
		}
		
	}
	
?>