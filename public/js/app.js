//password radio button
$('input:radio[name=r_pass]').click(function(){
    if($(this).val() == 1){
        $("#pass_lama").prop("disabled", false);
        $("#pass_baru").prop("disabled", false);
        // $("#pass_confirm").prop("disabled", false);
    }else{
        $('#pass_lama').prop("disabled", "disabled");
        $('#pass_baru').prop("disabled", "disabled");
        // $('#pass_confirm').prop("disabled", "disabled");
    }
});