window.FileReader&&(document.getElementById("images").onchange=function(){for(var e,a=-1;e=this.files[++a];){var n=new FileReader;n.onloadend=function(){var e='<div class="col-sm-4 justify-content-center align-items-center position-relative">\n                                    <img src="__url__" class="card-img-top" style="max-width: 80%; margin: 0 auto; display: block;">\n                                </div>'.replace("__url__",this.result);$(".images-wrapper").append(e)},n.readAsDataURL(e)}}),$(document).ready((function(e){$("#thumbnail").change((function(){var e=new FileReader;e.onload=function(e){$("#thumbnail-preview").attr("src",e.target.result)},e.readAsDataURL(this.files[0])}))}));
//# sourceMappingURL=images-preview.js.map