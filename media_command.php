<?php
	date_default_timezone_set("Asia/Bangkok");
    echo '<br />############ AutoConverter 1 Staging ############<br />';

    $inputPath = '/data/cms/contents/contents/new_cms/mediainput/Reality/Reality_10mins/';

    $output = '';
    $outputPath = '/data/cms/contents/contents/new_cms/mediaoutput/Reality_AF10/';

    $outputFolder = date( "Y-m-d", time() ); 
    $outputVideo = 'videos/';
    $outputPicture = 'pictures/';

    $outputFolderDate = $outputPath.$outputFolder;
    $outputPathVideo = $outputFolderDate.'/'.$outputVideo;
    $outputPathPicture = $outputFolderDate.'/'.$outputPicture
    .'';

	if ( isset($_REQUEST['folder']) )
	{
		echo '<br />############ Create Folder ############<br />';
		if ( !is_dir($outputFolderDate) )
	    {
	    	if ( mkdir($outputFolderDate, 0777) )
	    	{
	    		echo '<br /> Create Folder '.$outputFolder.' Success';
	    	}else
	    	{
	    		echo '<br /> Already Folder '.$outputFolder;
	    	}

	    	if ( !is_dir($outputPathVideo) )
	    	{
	    		if ( mkdir($outputPathVideo, 0777) )
		    	{
		    		echo '<br /> Create Video Folder '.$outputPathVideo.' Success';
		    	}else
		    	{
		    		echo '<br /> Already Video Folder '.$outputPathVideo;
		    	}
	    	}else
	    	{
	    		echo '<br /> Already Date+Video Folder'.$outputPathVideo;
	    	}

	    	if ( !is_dir($outputPathPicture) )
	    	{
	    		if ( mkdir($outputPathPicture, 0777) )
		    	{
		    		echo '<br /> Create Video Folder '.$outputPathPicture.' Success';
		    	}else
		    	{
		    		echo '<br /> Already Video Folder '.$outputPathPicture;
		    	}
	    	}else
	    	{
	    		echo '<br /> Already Date+Video Folder'.$outputPathPicture;
	    	}
	    }else
	    {
	    	echo '<br /> Already Date Folder'.$outputFolderDate;
	    }
	} else if ( isset($_REQUEST['mediainfo']) )
	{
		echo '<br />############ Media Info ############<br />';
		if ( isset($_REQUEST['file']) )
		{
			$file = $_REQUEST['file'];
		}else
		{
			$file = 'af_1min.20130531_164552.f4v';	
		}

		//input
		$input = $inputPath.$file;
		echo '<br /> Input : '.$input;

		//command MediaInfo
		$commandMediainfo = '/usr/bin/mediainfo -f duration '.$input;
		exec($commandMediainfo, $outputMediainfo, $statusMediainfo);
		echo '<br /> MediaInfo Status : '.$statusMediainfo;
		echo '<br /> MediaInfo Output <pre>';
		print_r($outputMediainfo);

	} else if ( isset($_REQUEST['convert']) )
	{
		if ( is_dir($outputPathVideo) )
		{
			echo '<br /> Succes Folder : '.$outputPathVideo;
		}else
		{
			echo '<br /> Fail Folder : '.$outputPathVideo;

			if ( mkdir($outputPathVideo, 0777) )
	    	{
	    		echo '<br /> Create New Folder '.$outputPathVideo.' Success';
	    	}else
	    	{
	    		echo '<br /> Already New Folder '.$outputPathVideo;
	    	}

		}

		echo '<br />############ Convert Video ############<br />';
		if ( isset($_REQUEST['file']) )
		{
			$file = $_REQUEST['file'];
		}else
		{
			$file = 'af_1min.20130531_164552.f4v';	
		}

		if ( isset($_REQUEST['output_name']) )
		{
			$outputName = $_REQUEST['output_name'];
		}else
		{
			$outputName = 'output-'.time();	
		}

		//input
		$input = $inputPath.$file;
		echo '<br /> Input : '.$input;

		$output = $outputPathVideo.$outputName.'_new.mp4';
		echo '<br /> Output : '.$output;	
		@unlink($output);

		//command F4vpp
		$commandF4vpp = '/usr/local/f4vpp/f4vpp -i '.$input.' -o '.$output;
		exec($commandF4vpp, $outputF4vpp, $statusF4vpp);
		echo '<br /> F4vpp Command : '.$commandF4vpp;
		echo '<br /> F4vpp Status : '.$statusF4vpp;
		echo '<br /> F4vpp Output <pre>';
		print_r($outputF4vpp);

		//input
		$inputHB = $output;
		echo '<br /> Input : '.$input;

		if ( isset($_REQUEST['quality']) )
		{
			$quality = $_REQUEST['quality'];
		}else
		{
			$quality = '140';	
		}

		//output
		$outputHB = $outputPathVideo.$outputName.'_'.$quality.'p.mp4';
		echo '<br /> Output : '.$output;
		@unlink($outputHB);

		if ( isset($_REQUEST['vstat']) )
		{
			$vstat_name = ' > /app/log/truelife/autoconverter/1/'.$_REQUEST['vstat'].'-'.$quality.'.log';
			@unlink($vstat_name);
		}else
		{
			$vstat_name = '';	
		}

		$commandHB = 'yes y | HandBrakeCLI -i '.$inputHB.' -o '.$outputHB.'  -e x264 -q 20.0 -a 1,1 -E faac,copy:ac3 -B 160,160 -6 dpl2,auto -R Auto,Auto -D 0.0,0.0 -f mp4 -Y '.$quality.'  --loose-anamorphic -m -x cabac=0:ref=2:me=umh:bframes=0:weightp=0:8x8dct=0:trell is=0:subme=6 '.$vstat_name.' 2>&1';

		exec($commandHB, $outputHB, $statusHB);
		echo '<br /> Handbrake Command : '.$commandHB;
		echo '<br /> Handbrake Status : '.$statusHB;
		echo '<br /> Handbrake Output <pre>';
		print_r($outputHB);
	} else if ( isset($_REQUEST['thumbnail']) )
	{
		echo '<br />############ Thumbnail ############<br />';

		if ( isset($_REQUEST['ss']) )
		{
			$ss = $_REQUEST['ss'];
		}else
		{
			$ss = 1;	
		}

		if ( isset($_REQUEST['quality']) )
		{
			$quality = $_REQUEST['quality'];
		}else
		{
			$quality = '140';	
		}

		if ( isset($_REQUEST['file']) )
		{
			$file = $_REQUEST['file'];
		}else
		{
			$file = 'af_1min.20130531_164552.f4v';	
		}		

		if ( isset($_REQUEST['output_name']) )
		{
			$outputName = $_REQUEST['output_name'];
		}else
		{
			$outputName = 'output-'.time();	
		}
		//input
		$input = $outputPathVideo.$outputName.'_'.$quality.'p.mp4';
		echo '<br /> Input : '.$input;
		//output
		$output = $outputPathPicture.$outputName.'_'.$quality.'-'.time().'p.jpg';
		echo '<br /> Output : '.$output;

		$commandThumb = "/usr/local/bin/ffmpeg -ss ".$ss." -i ".$input." -f image2 -vframes 1 -y ".$output;

		exec($commandThumb, $outputThumb, $statusThumb);
		echo '<br /> Handbrake Command : '.$commandThumb;
		echo '<br /> Handbrake Status : '.$statusThumb;
		echo '<br /> Handbrake Output <pre>';
		print_r($outputThumb);


		$ss2 = $ss*2;

		//output
		$output2 = $outputPathPicture.$outputName.'_'.$quality.'p2.jpg';
		echo '<br /> Output : '.$output;

		$commandThumb2 = "/usr/local/bin/ffmpeg -ss ".$ss." -i ".$input." -f image2 -vframes 1 -y ".$output2;

		exec($commandThumb2, $outputThumb2, $statusThumb2);
		echo '<br /> Handbrake Command : '.$commandThumb2;
		echo '<br /> Handbrake Status : '.$statusThumb2;
		echo '<br /> Handbrake Output <pre>';
		print_r($outputThumb2);
	}
