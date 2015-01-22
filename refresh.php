<?php
				require_once('function.php');

				//----------------------------------------------
				$faili = read_dir(__DIR__.'/atteli/');
				asort($faili);
			 	foreach($faili as $fails)
				{
					$fs = $fs . $fails;
				}
				echo $fs;
				
		?>			 