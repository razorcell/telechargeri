<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".appsgrabb").addClass("active");
	$(".da-circular-stat").daCircularStat();

});
</script>
<div class="grid_3">
	<ul class="da-circular-stat-wrap">
		<li
			class="da-circular-stat {fillColor: '#a6d037', percent: true, value: 42, label: 'Global'}"></li>
		<li
			class="da-circular-stat {fillColor: '#ea799b', percent: true, value: 42, label: 'Operating systems'}"></li>
		<li
			class="da-circular-stat {fillColor: '#fab241', percent: true, value: 42, label: 'Categories'}"></li>
		<li
			class="da-circular-stat {fillColor: '#61a5e4', percent: true, value: 42, maxValue: 100, label: 'Sections'}"></li>
	</ul>

	
		<div class="da-panel collapsible">
			<div class="da-panel-header">
				<span class="da-panel-title"> <img
					src="<?php echo $this->baseurl; ?>/images/icons/black/16/graph.png"
					alt="" /> Status
				</span>
			</div>
			<div class="da-panel-content">
				<form id="da-ex-validate1" class="da-form">
					<div class="da-form-inline">
						<div class="da-form-row">
							<label>Website</label>
							<div class="da-form-item">
								<span class="formNote">Description</span> <input
									type="text" name="req1" class="label_os" />
							</div>
						</div>
						<div class="da-form-row">
							<label>Os</label>
							<div class="da-form-item">
								<span class="formNote">Description</span> <input
									type="text" name="req1" class="label_os" />
							</div>
						</div>
						<div class="da-form-row">
							<label>Category</label>
							<div class="da-form-item">
								<span class="formNote">Description</span> <input
									type="text" name="req1" class="label_os" />
							</div>
						</div>
						<div class="da-form-row">
							<label>Section</label>
							<div class="da-form-item">
								<span class="formNote">Description</span> <input
									type="text" name="req1" class="label_os" />
							</div>
						</div>
						<div class="da-form-row">
							<label>Application link</label>
							<div class="da-form-item large">
								<span class="formNote">Description</span> <input
									type="text" name="req1" class="label_os" />
							</div>
						</div>
						<div class="da-form-row">
							<label>Application name</label>
							<div class="da-form-item">
								<span class="formNote">Description</span> <input
									type="text" name="req1" class="label_os" />
							</div>
						</div>
						<div class="da-button-row">
						<span class="da-button green start"> <img
							src="<?php echo $this->baseurl; ?>/images/icons/color/bomb.png">&nbsp;&nbsp;START
						</span>
					</div>
					</div>
				</form>
			</div>
		</div>
</div>

<div class="grid_1">
	<div class="da-panel-widget">
		<h1>Summary</h1>
		<ul class="da-summary-stat">
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #e15656;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/truck.png"
						alt="" />
				</span> <span class="da-summary-text"> <span class="value up">211</span>
						<span class="label">Downloaded pages</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #a6d037;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/sport_shirt.png"
						alt="" />
				</span> <span class="da-summary-text"> <span class="value">512</span>
						<span class="label">Scanned operating systems</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #ea799b;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/abacus.png"
						alt="" />
				</span> <span class="da-summary-text"> <span class="value up">286</span>
						<span class="label">Scanned categories</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #fab241;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/airplane.png"
						alt="" />
				</span> <span class="da-summary-text"> <span class="value down">61</span>
						<span class="label">Scanned sections</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #61a5e4;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/shopping_basket_2.png"
						alt="" />
				</span> <span class="da-summary-text"> <span class="value">42</span>
						<span class="label">Applications added to database</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #656565;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/users_2.png"
						alt="" />
				</span> <span class="da-summary-text"> <span class="value">266</span>
						<span class="label">Updated download links</span>
				</span>
			</a>
			</li>
		</ul>
	</div>
</div>


