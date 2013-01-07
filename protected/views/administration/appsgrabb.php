<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".os").removeClass("active");
	$(".category").removeClass("active");
	$(".section").removeClass("active");
	$(".application").removeClass("active");
	$(".appsgrabb").addClass("active");
	$("#progression").progressbar({
		value: 3 + Math.floor(Math.random() * 50)
	});
	
	$(".start").click(function(){
		$.ajax({ 
			type : "POST",
			url : "/start",
			});//end of ajax
		setInterval(function(){
			$.ajax({ 
				type : "POST",
				url : "/info",
				success : function(data) {
					var json = $.parseJSON(data);
						$(".elapsed_time").html(json.elapsed_time);
						$(".total_proxies").html(json.total_proxies);
						$(".current_proxy").val(json.current_proxy);
						$(".website").val(json.website);
						$(".os").val(json.os);
						$(".category").val(json.category);
						$(".section").val(json.section);
						$(".application_link").val(json.application_link);
						$(".application_name").val(json.application_name);
						$(".downloaded_pages").html(json.downloaded_pages);
						$(".scanned_apps").html(json.scanned_apps);
						$(".progression_section").html(json.progression_section);
						$(".progression_category").html(json.progression_category);
						var rnd_val = 5 + Math.floor(Math.random() * 50);
						$( "#progression" ).progressbar( "option", "value", rnd_val );
							}
			});//end of ajax
			}
				,500);
	});
});
</script>
<div class="grid_3">
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
						<label>Progression</label>
						<div class="da-form-item">
							<span class="formNote"><span class="elapsed_time">0 days 0 hours 0 minutes and 0 seconds ago.</span></span>
							<div id="progression" class="animated blue"></div>
						</div>
					</div>
					<div class="da-form-row">
						<label>Current proxy</label>
						<div class="da-form-item">
							<span class="formNote">Total proxies : <strong><span class="total_proxies"></span></strong></span> <input type="text"
								name="req1" class="current_proxy" value="" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Website</label>
						<div class="da-form-item">
							<span class="formNote">Current Website</span> <input type="text"
								name="req1" class="website" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Os</label>
						<div class="da-form-item">
							<span class="formNote">Current OS</span> <input type="text"
								name="req1" class="os" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Category</label>
						<div class="da-form-item">
							<span class="formNote">Current Category</span> <input type="text"
								name="req1" class="category" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Section</label>
						<div class="da-form-item">
							<span class="formNote">Current Section</span> <input type="text"
								name="req1" class="section" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Application link</label>
						<div class="da-form-item large">
							<span class="formNote">Current Application link(the process goes faster than the refresh time used here)</span> <input type="text"
								name="req1" class="application_link" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Application name</label>
						<div class="da-form-item large">
							<span class="formNote">Current application name(the process goes faster than the refresh time used here)</span> <input type="text"
								name="req1" class="application_name" />
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
						src="<?php echo $this->baseurl;?>/images/icons/white/32/download.png"
						alt="" />
				</span> <span class="da-summary-text"> <span
						class="value downloaded_pages">0</span> <span class="label">Downloaded
							pages</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #a6d037;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/applications.png"
						alt="" />
				</span> <span class="da-summary-text"> <span
						class="value scanned_apps">0</span> <span class="label">Scanned
							applications</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #a6d037;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/windows.png"
						alt="" />
				</span> <span class="da-summary-text"> <span
						class="value prograssion_os">0</span> <span class="label">Scanned
							OSs</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #ea799b;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/frames.png"
						alt="" />
				</span> <span class="da-summary-text"> <span
						class="value progression_category">0</span> <span class="label">Scanned
							categories</span>
				</span>
			</a>
			</li>
			<li><a href="#"> <span class="da-summary-icon"
					style="background-color: #fab241;"> <img
						src="<?php echo $this->baseurl;?>/images/icons/white/32/sign_post.png"
						alt="" />
				</span> <span class="da-summary-text"> <span
						class="value progression_section">0</span> <span class="label">Scanned
							sections</span>
				</span>
			</a>
			</li>
		</ul>
	</div>
</div>


