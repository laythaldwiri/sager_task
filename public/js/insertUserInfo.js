$("select").change(function(){
    var val=$(this).val();
    $("text").val(val);
})