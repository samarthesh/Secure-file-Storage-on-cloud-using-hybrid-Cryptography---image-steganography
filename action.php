<?php

	$dir = 'uploads';	
	$file_data = scandir($dir);
	$output = '
	<table class="table table-bordered table-striped">
		<tr>
			<th>Image</th>
			<th>File Name</th>
		</tr>
	';
	foreach($file_data as $file)
	{
		if($file === '.' OR $file === '..')
		{
			continue;
		}	
		else
		{
		 $path = 'uploads' . '/' . $file;
		$output .= '
				<tr>
					<td><img src="'.$path.'"
						class="img-thumbnail" height="50" width="50" /></td>
					<td>'.$file.'</td>
				</tr>
			';
		}
	}		
	$output .= '</table>';
	echo $output;






?>	