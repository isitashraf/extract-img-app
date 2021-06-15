<?php
$output="";

if(isset($_POST['submit'])) {
    $fileName=$_FILES['zip_file']['name'];
    $array=explode(".",$fileName);                          // ASSIGNING array FOR MULTIPLE FILE NAME

        if($array[count($array)-1]=='zip') {                // CHECKING FOR 'zip' FILE
        $fineName=$array[0];
        $zip=new ZipArchive();

            if($zip->open($_FILES['zip_file']['tmp_name'])===TRUE) {
                $rand = rand(111111111,999999999);          // CREATE RANDOM NUMBER NAMED AS THE FOLDER TO PREVENT DUPLICATES  
                
                $path = "upload/$rand/$fineName/";          // DECLARING PATH LOCATION FOR EXTRACTED FILES
                $zip->extractTo($path);                     // EXTRACT THEN SAVE TO SPECIFIED LOCAL FOLDER
                $zip->close();

                $files=scandir($path);

                    foreach($files as $file){               // FOR EACH SCANNING OF FILES, PHOTOS IN $path (upload/randomNumber/zipFileName/)
                        if(strlen($file)>4){                    
                        $output.="<img style='width:100%' src='$path/$file'/></div>";
                        }
                    }

            }else {
            header("index.php?error=open-zip");             // ERROR CHECKS IN CASE
            }

        }else {
        header("index.php?error=zip-not-selected");    
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Engineering Internship Assessment</title>
  <meta name="description" content="The HTML5 Herald" />
  <meta name="author" content="Digi-X Internship Committee" />

  <link rel="stylesheet" href="style.css?v=1.0" />
  <link rel="stylesheet" href="custom.css?v=1.0" />

</head>

<body>

    <div class="top-wrapper">
        <img src="https://assets.website-files.com/5cd4f29af95bc7d8af794e0e/5cfe060171000aa66754447a_n-digi-x-logo-white-yellow-standard.svg" alt="digi-x logo" height="70" />
        <h1>Engineering Internship Assessment</h1>
    </div>

    <div class="instruction-wrapper">
        <h2>What you need to do?</h2>
        <h3 style="margin-top:31px;">Using this HTML template, create a page that can:</h3>
        <ol>
            <li><b class="yellow">Upload</b> a zip file - containing 5 images (Cats, or Dogs, or even Pokemons)</li>
            <li>after uploading, <b class="yellow">Extract</b> the zip to get the images </li>
            <li><b class="yellow">Display</b> the images on this page</li>
        </ol>

        <h2 style="margin-top:51px;">The rules?</h2>
        <ol>
            <li>May use <b class="yellow">any programming language/script</b>. The simplest the better *wink*</li>
            <li><b class="yellow">Best if this project could be hosted</b></li>
            <li><b class="yellow">If you are not hosting</b>, please provide a video as proof (GDrive video link is ok)</li>
            <li><b class="yellow">Submit your code</b> by pushing to your own github account, and share the link with us</li>
        </ol>
    </div>

    <!-- DO NO REMOVE CODE STARTING HERE -->
    <div class="display-wrapper">
        <h2 style="margin-top:51px;">My images</h2>
        <div class="append-images-here">
            <p>No image found. Your extracted images should be here.</p>
            <!-- THE IMAGES SHOULD BE DISPLAYED INSIDE HERE -->
            <form method="POST" enctype="multipart/form-data">
                <label><b>Select zip file</b></label>
                <input type="file" name="zip_file">
                <input type="submit" name="submit" value="upload">
            </form>
            <?php 
                echo $output;                          // ALL PHOTOS THAT WAS SCANNED WILL BE DISPLAYED HERE
            ?>

        </div>
    </div>
    <!-- DO NO REMOVE CODE UNTIL HERE -->

</body>
</html>
