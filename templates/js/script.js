var base_url = "https://silextodoapp-satya5614.c9.io";

$(document).ready(function(){
   $('.modal-trigger').leanModal();
});


function markAsDone(taskId){
  var tId = "#"+taskId;
  var id = tId.substring(10);
  $(tId).toggleClass("done");
  loadUrl(base_url+"/web/update/"+id);
}

function deleteTask(id){
  var tId = "#taskId"+id;
  $(tId).hide();
  loadUrl(base_url+"/web/delete/"+id);
}

function editTask(id, gId){
    taskLabelId = "#taskLabel"+id;
    editTaskFieldId = "#editTaskField"+id;
    //taskBody = $(taskLabelId).val();

    taskBody = document.getElementById("taskLabel"+id).innerText;
    document.getElementById("modalTaskField").value = taskBody;
    document.getElementById("taskId").value = id;
    document.getElementById("groupId").value = gId;
    console.log(taskLabelId+" "+editTaskFieldId+" "+taskBody);
    $(taskLabelId, editTaskFieldId).toggle();
}

function loadUrl(url)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            console.log(xmlhttp.responseText);
        }
    }
    console.log(url);
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
