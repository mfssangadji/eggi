<div class="alert alert-primary" style="margin: 5px;">
  <strong>WELCOME</strong><br />
  Selamat Datang di Aplikasi Registrasi Pendakian Gunung Gamalama Berbasis Android</strong>
</div>
<script type="text/javascript">
var slideimages=new Array()
function slideshowimages()
{
for (i=0;i<slideshowimages.arguments.length;i++){
slideimages[i]=new Image()
slideimages[i].src=slideshowimages.arguments[i]
}
}
</script>
<div id="img_wel"><img src="../img/wel.jpg" alt="Slideshow Image Script" title="Slideshow Image Script" name="slide" class="img_wel"></div>
<script type="text/javascript">
slideshowimages("../img/wel.jpg")
var slideshowspeed=2000
var whichimage=0
function slideit()
{
if (!document.images)
return
document.images.slide.src=slideimages[whichimage].src
if (whichimage<slideimages.length-1)
whichimage++
else
whichimage=0
setTimeout("slideit()",slideshowspeed)
}
slideit()
</script>
<style>
	
	#img_wel {
		text-align:center;
	}
	
	.img_wel {
		height:400px;
		border-radius:15px;
	}
</style>