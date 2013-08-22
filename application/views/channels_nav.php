<h4 style="">Overview</h4>

<div>
 	
<ul class="nav nav-tabs">
<?php 
$segment = $this->uri->segment(2); 
//echo $segment ;
foreach( $this->channels as $key=>$row ): 
	if( in_array($key, $this->ch_access) ):
?>
<li <?php echo ($segment == $row->ch_link)?'class="active"':''; ?> > <a href="overview/<?php echo $row->ch_link?>"><?php echo $row->ch_name; ?></a> </li>
<?php 
	endif;
endforeach; ?>
<!--
<li <?php echo ($segment == 'kanaemail')?'class="active"':''; ?> > <a href="overview/kanaemail">Kana Email</a> </li>
<li <?php echo ($segment == 'kanachat')?'class="active"':''; ?> ><a href="overview/kanachat">Kana Chat</a></li>
<li <?php echo ($segment == 'socialmedia')?'class="active"':''; ?> ><a href="overview/socialmedia">Social Media and Blogs</a></li>
<li <?php echo ($segment == 'cases')?'class="active"':''; ?> ><a href="overview/cases">Case</a></li>
<li <?php echo ($segment == 'cdr')?'class="active"':''; ?> ><a href="overview/cdr">CDR</a></li>
-->
</ul>  
 
</div>