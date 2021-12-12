document.addEventListener('DOMContentLoaded', () =>{
    setInterval(function(){
        $("#container").load("")
    }, 10000);
})


function changed(id){
    var option = document.getElementById(id).value;
    var seperatorIndex = id.search('-');
    var gid = id.substring(0, seperatorIndex);
    var studentnr = id.substring(seperatorIndex + 1);
    // alert('id:' + id + ' /group:' + gid + ' /student:' + studentnr);

    $.post('project_logic.php', {
        name: option,
        gid: gid,
        studentnr: studentnr
    })
    // $("#students").html("")
    // $("#groups").html("")
    $("#container").load("")
    $(id).load("")
    // $("#groups").load("project.php")

}
