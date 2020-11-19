<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $(document).on('click', '.header', function() {
        var id = $(this).data('id');
        var overlay = $('#header'+id);
        overlay.show();
        var data = JSON.parse(overlay.children('pre').text());
        overlay.children('pre').text(JSON.stringify(data, undefined, 4));
        console.log(data);
    });
    $(document).on('click', '.request', function() {
        var id = $(this).data('id');
        var overlay = $('#request'+id);
        overlay.show();
        var data = JSON.parse(overlay.children('pre').text());
        overlay.children('pre').text(JSON.stringify(data, undefined, 4));
        console.log(data);
    });
    $(document).on('click', '.response', function() {
        var id = $(this).data('id');
        var overlay = $('#response'+id);
        overlay.show();
        var data = JSON.parse(overlay.children('pre').text());
        overlay.children('pre').text(JSON.stringify(data, undefined, 4));
        console.log(data);
    });
    $(document).on('click', '.exception', function() {
        var id = $(this).data('id');
        var overlay = $('#exception'+id);
        overlay.show();
        var data = JSON.parse(overlay.children('pre').text());
        overlay.children('pre').text(JSON.stringify(data, undefined, 4));
        console.log(data);
    });
    $(document).on('click','.preclose',function(){
        $(this).parent().hide();
    });

</script>