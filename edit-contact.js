$(function() {
    $('.datepicker').datepicker({
        minDate: new Date(1900, 1, 1),
        maxDate: new Date(),
        yearRange: 25
    });
    document.getElementById("pic").addEventListener('change', function() {
        const fileReader = new FileReader();
        const selectedFile = $(this)[0].files[0];
        fileReader.readAsDataURL(selectedFile);
        fileReader.addEventListener('load', function(evt) {
            document.getElementById('tmp_pic').setAttribute("src", evt.target.result);
        })
    })
});
