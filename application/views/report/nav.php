<div>


<?php 
$segment = $this->uri->segment(2); 
$summary = $this->uri->segment(1); 
//echo $summary ;
if( $summary == 'scorecard'  ):
?> 
<ul class="nav nav-tabs">
<h3>Scorecard Reports</h3> 	 
<li <?php echo ($segment == 'audits')?'class="active"':''; ?> > <a href="scorecard/audits">Audits per Auditor</a> </li>
<li <?php echo ($segment == 'qualityreport')?'class="active"':''; ?> ><a href="scorecard/qualityreport">Agent Quality Report</a></li>  
<?php 
else:
?>
<ul class="nav nav-tabs">
<h3>Management Reports</h3> 	
<li <?php echo ($segment == 'audits')?'class="active"':''; ?> ><a href="management/audits">Audits per Auditor</a></li>  
<li <?php echo ($segment == 'qualityreport')?'class="active"':''; ?> ><a href="management/qualityreport">Agent Quality Report</a></li>  
<?php endif; ?>
</ul>  
 
</div>