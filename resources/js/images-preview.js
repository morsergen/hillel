if (window.FileReader) {
    document.getElementById("images").onchange = function () {
        let counter = -1, file;

        //$('.images-wrapper').html('');

        let template = `<div class="col-sm-4 justify-content-center align-items-center position-relative">
                                    <img src="__url__" class="card-img-top" style="max-width: 80%; margin: 0 auto; display: block;">
                                </div>`;

        while (file = this.files[++counter]) {
            let reader = new FileReader();
            reader.onloadend = (function () {
                return function () {
                    let img = template.replace('__url__', this.result);
                    $('.images-wrapper').append(img)
                }
            })(file);
            reader.readAsDataURL(file);
        }
    }
}

$(document).ready(function (e) {
    $('#thumbnail').change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#thumbnail-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});
