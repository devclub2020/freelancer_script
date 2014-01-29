<?php
	session_start();
	//checking for session variable
	if(!isset($_SESSION['user']) || $_SESSION['user'] != 'contractor')
	{
		header("Location: index.php");
	}
	$pageTitle = 'POST BID';
	include 'v-templates/header.php';
	$project_id = $GLOBALS['_GET']['id'];
?>
<!-- body starts here -->
<div class="container body_page_outline">
    <div class="row">
    	<div class="body_page">
            <?php include 'v-templates/navbar.php'; ?>
            <div class="col-md-12 login_box_outline">
                <?php
					if(isset($project_id))
					{
						$bid_details = $manageContent->getProjectDetails($project_id);
					}
					else
					{
						echo '<p style="font-size:1.5em; color:#ff0000; text-align:center;">No Project Details Found</p>';
					}
				?>
                <div class="col-lg-5">
                	<div class="bid_outline">
                    	<h4 class="bid_heading">Describe Your Proposal</h4>
                        <form action="#" method="post">
                        	<textarea rows="20" class="bid_textarea col-md-12"></textarea>
                            <p class="col-md-12 project_description_skills">Cost</p>
                            <input type="text" class="form-control bid_text" placeholder="Cost Of this Project">
                            <p class="col-md-12 project_description_skills">Time Required</p>
                            <input type="text" class="form-control bid_text" placeholder="Time Required">
                            <input type="submit" class="btn btn-success btn-lg pull-right" value="SUBMIT"/>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- bidding part ends here -->
            </div>
            <div class="clearfix"></div>
       </div>
    </div>
</div>
<!-- body ends here -->
<?php
	include 'v-templates/footer.php';
?>