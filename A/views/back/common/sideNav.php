<?php
	$ACCESS_TYPE = $this->session->session_user_type;
?>
<aside class="menu-sidebar d-none d-lg-block">
	<div class="logo">
		<a href="<?php echo base_url().'Admin';?>">
			<img src="<?php echo base_url().'assets/images/logo-big.png';?>" alt="" />
		</a>
	</div>
	<div class="menu-sidebar__content js-scrollbar1">
		<nav class="navbar-sidebar">
			<ul class="list-unstyled navbar__list">
				<li class="<?php if($PG=='H') echo 'active';?>">
					<a href="<?php echo base_url();?>Admin"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
				</li>
				<li class="<?php if($PG=='C') echo 'active';?> has-sub">
					<a class="js-arrow" href="#"><i class="fas fa-tools"></i> Companies</a>
					<ul class="list-unstyled navbar__sub-list js-sub-list">
						<li><a href="<?php echo base_url();?>Company/new">New</a></li>
						<li><a href="<?php echo base_url();?>Company/review">In Review</a></li>
						<li><a href="<?php echo base_url();?>Company/accepted">Accepted</a></li>
						<li><a href="<?php echo base_url();?>Company/rejected">Rejected</a></li>
					</ul>
				</li>
				<hr />
				<li class="<?php if($PG=='Q') echo 'active';?> has-sub">
					<a class="js-arrow" href="#"><i class="fas fa-question"></i> Question Management</a>
					<ul class="list-unstyled navbar__sub-list js-sub-list">
						<li><a href="<?php echo base_url();?>Question/category">Category</a></li>
						<li><a href="<?php echo base_url();?>Question">List</a></li>
					</ul>
				</li>
				<?php if($ACCESS_TYPE==1){?>
				<li class="<?php if($PG=='U') echo 'active';?>"><a href="<?php echo base_url();?>User"><i class="fas fa-user-cog"></i> User Management</a></li>
				<?php }?>
				<?php if($ACCESS_TYPE <3){?>
				<li class="<?php if($PG=='S') echo 'active';?> has-sub">
					<a class="js-arrow" href="#"><i class="fas fa-tools"></i> Settings</a>
					<ul class="list-unstyled navbar__sub-list js-sub-list">
						<li><a href="<?php echo base_url();?>Region">Regions</a></li>
						<li><a href="<?php echo base_url();?>Country">Countries</a></li>
						<li><a href="<?php echo base_url();?>Industry">Industry</a></li>
						<li><a href="<?php echo base_url();?>Channel">Channel</a></li>
					</ul>
				</li>
				<?php }?>
			</ul>
		</nav>
	</div>
</aside>