$("#selectfile").change(
    function(e){
        $("#lbfile").text(e.target.files[0].name);
});
