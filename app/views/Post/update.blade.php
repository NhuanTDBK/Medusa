<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<h1 align="center">
</h1>
<head>
    <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://googledrive.com/host/0B8z8ereLRdjhVXZIeTBsdU4wNFU">
    <!-- include summernote css/js-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.1/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.1/summernote.min.js"></script>
    <script src="{{URL::asset('assets/js')}}/summernote-ext-video.js"></script >
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote(
                {
                    airMode: false,
                    //height: 400,
                    airPopover: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ],
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['group', [ 'video' ]]
                    ],
                    onImageUpload: function(files,editor,welEditable) {
                               // upload image to server and create imgNode...
                               uploadFileToServer(files,editor,welEditable);
                               //$summernote.summernote('insertNode', imgNode);
                     }
                });
        });

    </script>
</head>
<body>
	<header class="header fixed clearfix navbar navbar-fixed-top" style="" >
			@yield('header')
		</header>
<!--style="background-image: url('http://www.splitshire.com/wp-content/uploads/2014/02/SplitShire_blur10.jpg')"-->
<br><br><br><br>
<div class="">
    <?php echo Form::open(array(
        'url' => 'post/update/'.$post["_id"]
,
    ));?>
    <?php echo Form::label("title", "Title"); ?>
<div>
    <?php echo "<br>";
    echo Form::text('title', $post->title, ['style' => "
    width:85%;display:inline",'class'=>'form-control']);?>
     <button name="post" class="btn btn-default btn-lg" type="submit" value="Public"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>Public</button>
     <button name="post" class="btn btn-default btn-lg" type="submit" value="Draft"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>Draft</button>
</div>
<br>
<br>
<?php echo Form::label("tags", "Tags (Separate by comma)"); ?>
<?php echo Form::text('tags', implode(",",$post->tags), ['style' => "
width:100%",'class'=>'form-control']);?>

<br>
<br>
<textarea id="summernote" name="content" class="form-control"><?php echo $post->content?></textarea>
<br>
<br>


<div style="text-align:center">

</div>
</div>
</body>
</html>
<script>
    function uploadFileToServer(files,editor,welEditable)
    {
     //Khởi tạo 1 request async

         //Địa chỉ gửi dữ liệu kèm theo tham số môn học
        var url = "{{URL::asset('upload')}}";
        for(var i = 0;i<files.length;i++ )
        {
            var formData = new FormData();
            //Thêm dữ liệu
//            console.log(files[i]);
            var ajax = new XMLHttpRequest();
            formData.append("file1", files[i]);
             //ajax.addEventListener("load",uploadCompleted,false);
            ajax.open("POST", url,false);
            var imageUrl=null;
            ajax.onload = function()
            {
                imageUrl = JSON.parse(this.responseText);
                console.log(imageUrl);
                editor.insertImage(welEditable,imageUrl);
            }
            //Thực hiện gửi
            ajax.send(formData);

         }
    }
//    function uploadCompleted(evt)
//    {
//        console.log(evt);
//    }
</script>
